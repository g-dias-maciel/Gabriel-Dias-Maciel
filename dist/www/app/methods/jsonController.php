<?php


class jsonController
{

    function __construct()
    {

    }

    /**
     * Loads all JSON files from specific folder
     * if no file is found return false
     *
     * @param $folder
     * @return array|false
     * @throws Exception
     */
    static function jsonLoadFiles($folder)
    {

        //get all json files from directory
        $json_files = glob($folder . '*.json');

        //if an error happens while trying to read the directory
        if (!$json_files) {
            throw new Exception('An error occurred while searching for *.json files on the directory: ' . $folder);
        }

        //if no json file is found
        if (empty($json_files)) {
            return false;
        }

        return $json_files;


    }

    /**
     * Read contents of a JSON file
     * throw exception if file_get_contents() fails to get contents of file
     *
     * @param $json_file
     * @return string
     * @throws Exception
     */
    static function jsonGetContent($json_file)
    {

        //get json file content as string
        $json_content = file_get_contents($json_file);

        if ($json_content === false) {
            throw new Exception('Unable to get contents of file: ' . $json_file);
        }

        //return json file content
        return $json_content;
    }

    /**
     * Format json object as a table displayed in the console
     *
     * |key   |key   |key   |key   |
     * |value |value |value |value |
     * |value |value |value |value |
     *
     * @param $json_object
     */
    static function jsonFormat($json_object)
    {

        $header = false; //table header check
        $mask = "|%-20s "; //table print mask

        foreach ($json_object as $object) {
            if (!$header) {
                $keys = self::setTableHeader($object, $mask); //print header based on objects key if not printed yet
                $header = true;
            }
            //print the correct object attribute following the header order
            for ($i = 0; $i < count($keys); $i++) {
                printf($mask, $object->{$keys[$i]});
            }

            print("|\n");

        }

    }

    /**
     *
     * Set table header for jsonFormat() function
     *
     * @param $object
     * @param $mask
     * @param bool $close_table
     * @return int[]|string[]
     */
    static private function setTableHeader($object, $mask, $close_table = true)
    {
        $array = get_object_vars($object);
        $keys = array_keys($array);

        foreach ($keys as $key => $item) {
            printf($mask, (string)$item);
        }
        if ($close_table) {
            print('|');
        }
        print("\n");

        return $keys;
    }


}