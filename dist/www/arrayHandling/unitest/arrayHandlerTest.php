<?php
require('./vendor/autoload.php');
require_once './arrayHandling/class/arrayHandler.php';

use PHPUnit\Framework\TestCase;


class arrayHandlerTest extends TestCase
{
    /**
     * test case where we look for a value that is not in the array
     */
    public function testCase1()
    {
        print "\r\n";
        print "Running test case - Value not included on array \n\r";

        $search_value = -10;

        $array = arrayHandler::arrayCreate(10e4, 10e5, 0, 10e6);

        print "\r\n";
        print "Random array created\r\n";
        print "Array size: " . count($array) . "\r\n";
        print "Searching for value: " . $search_value . "\r\n";
        $actual = arrayHandler::arraySearch($search_value, $array, count($array), 0);

        print "Search result (-1 if not found): \r\n";
        print_r($actual);
        print "\r\n";
        $expected = -1;
        $this->assertEquals($expected, $actual);
    }

    /**
     * test case where we look for a value that most likely is in the array
     */
    public function testCase2()
    {
        print "\r\n";
        print "Running test case - Value included on array \n\r";

        $search_value = 1337;

        $array = arrayHandler::arrayCreate(10e4, 10e5, 0, 10e4);

        print "\r\n";
        print "Random array created\r\n";
        print "Array size: " . count($array) . "\r\n";
        print "Searching for value: " . $search_value . "\r\n";
        $actual = arrayHandler::arraySearch($search_value, $array, count($array), 0);

        print "Search result (-1 if not found) else item index: \r\n";
        print_r($actual);

        //if value not found by arraySearch() assert it doesn't cotains the value
        if ($actual == -1){
            print "\r\n".'Asserting that the array does not contain the searched value';
            $this->assertNotContains($search_value, $array);
        }else{
            print "\r\n".'Asserting that the array contains the searched value';
            $this->assertContains($search_value, $array);
        }
    }

    /**
     * test case where we look for a value that might exist or not in the array
     */
    public function testCase3()
    {
        print "\r\n";
        print "Running test case - Value included on array \n\r";

        $search_value = 233700;

        $array = arrayHandler::arrayCreate(10e4, 10e5, 0, 10e5);

        print "\r\n";
        print "Random array created\r\n";
        print "Array size: " . count($array) . "\r\n";
        print "Searching for value: " . $search_value . "\r\n";
        $actual = arrayHandler::arraySearch($search_value, $array, count($array), 0);

        print "Search result (-1 if not found) else item index: \r\n";
        print_r($actual);

        //if value not found by arraySearch() assert it doesn't cotains the value
        if ($actual == -1){
            print "\r\n".'Asserting that the array does not contain the searched value';
            $this->assertNotContains($search_value, $array);
        }else{
            print "\r\n".'Asserting that the array contains the searched value';
            $this->assertContains($search_value, $array);
        }
    }
}