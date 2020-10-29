<?php

require_once './vendor/autoload.php';

use \SubscribeHR\Parser\CSVParser;
use \SubscribeHR\Graph\Graph;

const QUIT = 'QUIT';

if($argc != 2){
    echo "Incorrect no.of Arguments. Please use `php npf.php testfile.csv` format".PHP_EOL;
    die;
}

$filename = $argv[1];
$csvParser = new CSVParser();
if($csvParser->isValidCSVFile($filename)){
    $userInput = readUserInput("Please enter signal path to test for(eg. A F 1200) or QUIT to exit: ");

    if($userInput === QUIT){
        echo "Bye Bye".PHP_EOL;
        exit(0);
    }

    list($source, $destination, $weightLimit) = validateUserInput($userInput);

    list($verticesMap, $vertices) = $csvParser->extractVerticesAndMap($filename);
    $graph = new Graph($verticesMap, $vertices);
    $isReachable = $graph->isReachable($source,$destination);
    if($isReachable) {
        $path = $graph->getPath();
        $weight = $graph->getWeight($destination);
        if($weight <= $weightLimit){
            foreach ($path as $vertex){
                echo "$vertex => ";
            }
            echo $weight.PHP_EOL;
            exit(0);
        }
    }
    echo "Path not found".PHP_EOL;
    exit(0);
}else{
    echo "File is unreadable. Please make sure file is readable and not empty".PHP_EOL;
    die;
}

function readUserInput($lineText){
    // Get the input from user
    $fh = fopen('php://stdin', 'r');
    echo $lineText;
    $userInput = trim(fgets($fh));
    fclose($fh);
    return $userInput;
}

function validateUserInput($userInput){
    $parts = explode(" ", $userInput);
    if(!isset($parts[0]) || !isset($parts[1]) || !isset($parts[2])){
        echo "Signal path is incorrect. Please use `A F 1200` format.".PHP_EOL;
        die;
    }
    $source = trim($parts[0]);
    $destination = trim($parts[1]);
    $weight = trim($parts[2]);
    if(!is_numeric($weight)){
        echo "Weight is incorrect. Please use integer value.".PHP_EOL;
        die;
    }
    return array($source, $destination, $weight);
}