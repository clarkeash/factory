<?php

use Factory\Application;
use Factory\Console\Make\TraitCommand;
use Symfony\Component\Console\Tester\CommandTester;

class ConsoleMakeTraitCommandTest extends TestCase
{
    /**
     * @var Application
     */
    protected $app;

    public function setUp()
    {
        $this->app = new Application('Test Machine');
        $this->app->add($this->app->container->make(TraitCommand::class));
    }

    /**
     * @test
     */
    public function it_makes_a_basic_trait()
    {
        $command = $this->app->find('make:trait');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/BasicTrait'
        ]);

        $this->assertFileExists(__DIR__ . '/../src/Tests/BasicTrait.php');
        $this->assertFileEquals(__DIR__ . '/stubs/BasicTrait.txt', __DIR__ . '/../src/Tests/BasicTrait.php');
    }

    /**
     * @test
     * @expectedException \League\Flysystem\FileExistsException
     */
    public function it_wont_overwrite_a_file_by_default()
    {
        mkdir(__DIR__ . '/../src/Tests');
        touch(__DIR__ . '/../src/Tests/BasicTrait.php');
        $this->assertFileExists(__DIR__ . '/../src/Tests/BasicTrait.php');

        $command = $this->app->find('make:trait');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/BasicTrait'
        ]);

        $this->assertEmpty(file_get_contents(__DIR__ . '/../src/Tests/BasicTrait.php'));
    }

    /**
     * @test
     */
    public function it_can_be_forced_to_overwrite_a_file()
    {
        mkdir(__DIR__ . '/../src/Tests');
        touch(__DIR__ . '/../src/Tests/BasicTrait.php');
        $this->assertFileExists(__DIR__ . '/../src/Tests/BasicTrait.php');

        $command = $this->app->find('make:trait');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'name' => 'Tests/BasicTrait',
            '--force' => true,
        ]);

        $this->assertFileExists(__DIR__ . '/../src/Tests/BasicTrait.php');
        $this->assertFileEquals(__DIR__ . '/stubs/BasicTrait.txt', __DIR__ . '/../src/Tests/BasicTrait.php');
    }
}
