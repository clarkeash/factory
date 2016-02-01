<?php

use Factory\Application;
use Factory\Console\Make\InterfaceCommand;
use Symfony\Component\Console\Tester\CommandTester;

class ConsoleMakeInterfaceCommandTest extends TestCase
{
    /**
     * @var Application
     */
    protected $app;

    public function setUp()
    {
        $this->app = new Application('Test Machine');
        $this->app->add($this->app->container->make(InterfaceCommand::class));
    }

    /**
     * @test
     */
    public function it_makes_a_basic_interface()
    {
        $command = $this->app->find('make:interface');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/BasicInterface'
        ]);

        $this->assertFileExists(__DIR__ . '/../src/Tests/BasicInterface.php');
        $this->assertFileEquals(__DIR__ . '/stubs/BasicInterface.txt', __DIR__ . '/../src/Tests/BasicInterface.php');
    }

    /**
     * @test
     * @expectedException \League\Flysystem\FileExistsException
     */
    public function it_wont_overwrite_a_file_by_default()
    {
        mkdir(__DIR__ . '/../src/Tests');
        touch(__DIR__ . '/../src/Tests/BasicInterface.php');
        $this->assertFileExists(__DIR__ . '/../src/Tests/BasicInterface.php');

        $command = $this->app->find('make:interface');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/BasicInterface'
        ]);

        $this->assertEmpty(file_get_contents(__DIR__ . '/../src/Tests/BasicInterface.php'));
    }

    /**
     * @test
     */
    public function it_can_be_forced_to_overwrite_a_file()
    {
        mkdir(__DIR__ . '/../src/Tests');
        touch(__DIR__ . '/../src/Tests/BasicInterface.php');
        $this->assertFileExists(__DIR__ . '/../src/Tests/BasicInterface.php');

        $command = $this->app->find('make:interface');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/BasicInterface',
            '--force' => true,
        ]);

        $this->assertFileExists(__DIR__ . '/../src/Tests/BasicInterface.php');
        $this->assertFileEquals(__DIR__ . '/stubs/BasicInterface.txt', __DIR__ . '/../src/Tests/BasicInterface.php');
    }
}
