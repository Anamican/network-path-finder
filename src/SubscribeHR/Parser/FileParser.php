<?php

namespace SubscribeHR\Parser;

class FileParser
{
    public function isFileReadable($filename){
        // In order for a file to be readable it needs to have read access
        // and should not be empty
        return is_readable($filename) && (filesize($filename) !== 0);
    }
}