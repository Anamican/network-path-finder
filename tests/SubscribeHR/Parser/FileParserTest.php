<?php


namespace SubscribeHR\Parser;


use PHPUnit\Framework\TestCase;

class FileParserTest extends TestCase
{
    const TEST_FILES_DIR = './tests/resources/test_files/';

    public function testCheckEmptyFilePath(){
        $fParser = new FileParser();
        $isReadable = $fParser->isFileReadable('');
        $this->assertFalse($isReadable);
    }

    public function testCheckIncorrectFilePath(){
        $fParser = new FileParser();
        $isReadable = $fParser->isFileReadable('some-random-garbase-ajfjfwebfw-file.csv');
        $this->assertFalse($isReadable);
    }

    public function testCheckEmptyFile(){
        $fParser = new FileParser();
        $isReadable = $fParser->isFileReadable(self::TEST_FILES_DIR.'empty_file.csv');
        $this->assertFalse($isReadable);
    }

    public function testCheckNonEmptyFile(){
        $fParser = new FileParser();
        $isReadable = $fParser->isFileReadable(self::TEST_FILES_DIR.'non_empty_file.csv');
        $this->assertTrue($isReadable);
    }
}