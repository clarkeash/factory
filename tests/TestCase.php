<?php

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        if(file_exists(__DIR__ . '/../src/Tests'))
        {
            $files = glob(__DIR__ . '/../src/Tests/*'); // get all file names
            foreach($files as $file) // iterate files
            {
                if(is_file($file))
                {
                    unlink($file); // delete file
                }
            }

            rmdir(__DIR__ . '/../src/Tests'); // delete folder
        }
    }
}
