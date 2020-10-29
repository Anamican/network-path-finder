<?php


namespace SubscribeHR\Parser;


use PHPUnit\Framework\TestCase;

class CSVParserTest extends TestCase
{
    const TEST_FILES_DIR = './tests/resources/test_files/';

    public function testCheckEmptyFilePath(){
        $csvParser = new CSVParser();
        $isValid = $csvParser->isValidCSVFile('');
        $this->assertFalse($isValid);
    }

    public function testCheckIncorrectFilePath(){
        $csvParser = new CSVParser();
        $isValid = $csvParser->isValidCSVFile('some-random-garbase-ajfjfwebfw-file.csv');
        $this->assertFalse($isValid);
    }

    public function testCheckEmptyFile(){
        $csvParser = new CSVParser();
        $isValid = $csvParser->isValidCSVFile(self::TEST_FILES_DIR.'empty_file.csv');
        $this->assertFalse($isValid);
    }

    public function testCheckNonEmptyFile(){
        $csvParser = new CSVParser();
        $isValid = $csvParser->isValidCSVFile(self::TEST_FILES_DIR.'non_empty_file.csv');
        $this->assertFalse($isValid);
    }

    public function testCheckIsNotValidFile(){
        $csvParser = new CSVParser();
        $isValid = $csvParser->isValidCSVFile(self::TEST_FILES_DIR.'invalid.csv');
        $this->assertFalse($isValid);
    }

    public function testCheckIsValidFile(){
        $csvParser = new CSVParser();
        $isValid = $csvParser->isValidCSVFile(self::TEST_FILES_DIR.'valid.csv');
        $this->assertTrue($isValid);
    }

    public function testTransformCSVToGraphEmptyValue(){
        $csvParser = new CSVParser();
        list($verticesMap, $vertices) = $csvParser->extractVerticesAndMap(self::TEST_FILES_DIR.'empty_file.csv');
        $this->assertEmpty($verticesMap);
        $this->assertEmpty($vertices);
    }

    public function testTransformCSVToGraphValidGraph(){
        $csvParser = new CSVParser();
        $expectedResult = array(
            array(
               'A' => array('B' => 1000, 'D' => 30),
               'C' => array('D' => 20, 'B' => 20)
            ),
            array(
                'A' => 1,
                'B' => 1,
                'C' => 1,
                'D' => 1
            )
        );
        $result = $csvParser->extractVerticesAndMap(self::TEST_FILES_DIR.'test_graph.csv');
        $this->assertEquals($expectedResult, $result);
    }
}