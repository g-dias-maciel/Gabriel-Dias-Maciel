<?php
require('vendor/autoload.php');
require_once './app/methods/arrayController.php';

use PHPUnit\Framework\TestCase;


class arrayControllerTest extends TestCase
{
    /**
     * test case where we look for a value that is not in the array
     */
    public function testCase1()
    {
        print "\r\n";
        print "Running test case - Value not included on array \n\r";

        $search_value = -10;

        $array = arrayController::generateIntArray(10e4, 10e5, 0, 10e6);

        print "\r\n";
        print "Random array created\r\n";
        print "Array size: " . count($array) . "\r\n";
        print "Searching for value: " . $search_value . "\r\n";
        $actual = arrayController::arraySearch($search_value, $array, count($array), 0);

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

        $array = arrayController::generateIntArray(10e4, 10e5, 0, 10e4);

        print "\r\n";
        print "Random array created\r\n";
        print "Array size: " . count($array) . "\r\n";
        print "Searching for value: " . $search_value . "\r\n";
        $actual = arrayController::arraySearch($search_value, $array, count($array), 0);

        print "Search result (-1 if not found) else item index: \r\n";
        print_r($actual);

        $this->assertEquals($search_value, $array[$actual]);
    }
}