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

    /**
     * Extract the CSV to Vertices Map and list of vertices
     *
     * eg) For the file
     * A,B,10
     * B,C,20,
     * A,C,30
     *
     * the result would be
     * array(
     *      array(
     *          'A' => array('B' => 10, 'C' => 30),
     *          'B' => array('C' => 20),
     *      ),
     *      array(
     *          'A' => 1, 'B' => 1, 'C' => 1
     *      )
     * )
     * @param $filename
     * @return array
     */
    public function extractVerticesAndMap($filename){
        $verticesMap = [];
        $vertices = [];
        $file = fopen($filename, 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            $verticesMap[$line[0]][$line[1]] = $line[2];
            // Let PHP builtin do the data-deduplication rather than an IF validation
            $vertices[$line[0]] = 1;
            $vertices[$line[1]] = 1;
        }
        fclose($file);
        return array($verticesMap, $vertices);
    }
}