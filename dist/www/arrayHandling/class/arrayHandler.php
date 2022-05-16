<?php

class arrayHandler
{


    function __construct()
    {

    }

    /**
     *
     * Generate random integer array
     *
     * @param $array_min_size
     * @param $array_max_size
     * @param $array_min_value
     * @param $array_max_value
     * @param bool $sort
     * @return array|int[]
     */
    static function arrayCreate($array_min_size, $array_max_size, $array_min_value, $array_max_value, $sort = true)
    {

        //generate random integer array mapping the array with random numbers in specified range
        $random_number_array = array_map(function () use ($array_min_value, $array_max_value) {
            return rand($array_min_value, $array_max_value);
        }, array_fill(0, rand($array_min_size, $array_max_size), null));

        //sort if requested (default option)
        if ($sort) {
            sort($random_number_array);
        }

        return $random_number_array;
    }

    /**
     *
     * Perform a binary search through array
     * It will return the first match found (if duplicated, it doesn't mean it is the first (asc) value index as this
     * is not a linear search)
     *
     * @param int $value
     * @param array $array
     * @param $max_length
     * @param $min_length
     * @return int
     */
    static function arraySearch(int $value, array $array, $max_length, $min_length)
    {
        //return value if no item is found
        $key = -1;

        // if min_length is < then max_length it means we didn't find the value
        while ($max_length >= $min_length) {
            // Find the middle index.
            $mid = (int)floor(($max_length + $min_length) / 2);
            //if item is in second part of array
            if ($value > $array[$mid]) {
                $min_length = $mid + 1;
            } elseif ($value < $array[$mid]) {//if item is in first part of array
                $max_length = $mid - 1;
            } else {
                //we found a match
                $key = $mid;
                break;
            }

        }

        return $key;
    }


}