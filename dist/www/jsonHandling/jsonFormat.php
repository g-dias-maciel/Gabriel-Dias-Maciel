<?php
require('./jsonHandling/class/jsonHandler.php');


//run "php jsonFormat.php" on php container
__init();


function __init()
{

    print "JSON parsing basic skills \n\r";

    //test json files dir
    $json_dir = './jsonHandling/data/json_files/';
    //load all *.json files in folder
    $json_files = jsonHandler::jsonLoadFiles($json_dir);

    $data = new stdClass();

    //decode all json files to objects
    foreach ($json_files as $key => $file) {
        $data->{$key} = json_decode(jsonHandler::jsonGetContent($file));
    }
    //format json files as a table in the console
    jsonHandler::jsonFormat($data);

}


?>
