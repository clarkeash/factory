<?php

namespace Factory\Generators;

class TraitGenerator extends BaseGenerator
{
    public function make()
    {
        return $this->generate('trait.txt', []);
    }
}
