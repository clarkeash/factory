<?php

use Factory\Application;
use Factory\Console\Make\ClassCommand;
use Symfony\Component\Console\Tester\CommandTester;

class ConsoleMakeClassCommandTest extends TestCase
{
    /**
     * @var Application
     */
    protected $app;

    public function setUp()
    {
        $this->app = new Application('Test Machine');
        $this->app->add($this->app->container->make(ClassCommand::class));
    }

    /**
     * @test
     */
    public function it_makes_a_basic_class()
    {
        $command = $this->app->find('make:class');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/Basic'
        ]);

        $this->assertFileExists(__DIR__ . '/../src/Tests/Basic.php');
        $this->assertFileEquals(__DIR__ . '/stubs/Basic.txt', __DIR__ . '/../src/Tests/Basic.php');
    }

    /**
     * @test
     */
    public function it_makes_an_abstract_class()
    {
        $command = $this->app->find('make:class');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/Basic',
            '--abstract' => true,
        ]);

        $this->assertFileExists(__DIR__ . '/../src/Tests/Basic.php');
        $this->assertFileEquals(__DIR__ . '/stubs/Abstract.txt', __DIR__ . '/../src/Tests/Basic.php');
    }

    /**
     * @test
     * @expectedException \League\Flysystem\FileExistsException
     */
    public function it_wont_overwrite_a_file_by_default()
    {
        mkdir(__DIR__ . '/../src/Tests');
        touch(__DIR__ . '/../src/Tests/Basic.php');
        $this->assertFileExists(__DIR__ . '/../src/Tests/Basic.php');

        $command = $this->app->find('make:class');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/Basic'
        ]);

        $this->assertEmpty(file_get_contents(__DIR__ . '/../src/Tests/Basic.php'));
    }

    /**
     * @test
     */
    public function it_can_be_forced_to_overwrite_a_file()
    {
        mkdir(__DIR__ . '/../src/Tests');
        touch(__DIR__ . '/../src/Tests/Basic.php');
        $this->assertFileExists(__DIR__ . '/../src/Tests/Basic.php');

        $command = $this->app->find('make:class');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/Basic',
            '--force' => true,
        ]);

        $this->assertFileExists(__DIR__ . '/../src/Tests/Basic.php');
        $this->assertFileEquals(__DIR__ . '/stubs/Basic.txt', __DIR__ . '/../src/Tests/Basic.php');
    }
}
