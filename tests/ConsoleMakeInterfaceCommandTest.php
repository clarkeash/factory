<?php

use Factory\Application;
use Factory\Console\Make\InterfaceCommand;

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
    public function it_works()
    {
        $this->assertTrue(true);
    }
}
