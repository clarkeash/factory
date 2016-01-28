<?php

namespace Factory\Generators;

class InterfaceGenerator extends BaseGenerator
{
    public function make()
    {
        return $this->generate('interface.txt', []);
    }
}
