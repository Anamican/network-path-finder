<?php


namespace SubscribeHR\Parser;


class CSVParser extends FileParser
{
    public function isValidCSVFile($filename){
        if(!$this->isFileReadable($filename)){
            return false;
        }

        $file = fopen($filename, 'r');
        $line = fgetcsv($file);
        fclose($file);

        // Check if the line CSV format is STRING,STRING,NUMERIC
        // We could do a lot more checks here like
        // checking for string, check the entire file before doing anything etc..
        // for the sake of brevity only checking the first line and assume there wont be header
        if(empty($line[0]) || empty($line[1]) || !isset($line[2]) || !is_numeric($line[2])){
            return false;
        }
        return true;
    }
}