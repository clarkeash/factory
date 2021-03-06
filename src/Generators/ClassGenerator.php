<?php

namespace Factory\Generators;

class ClassGenerator extends BaseGenerator
{
    public function make()
    {
        return $this->generate('class.txt', [
            'abstract' => boolval($this->data['abstract']),
        ]);
    }
}
