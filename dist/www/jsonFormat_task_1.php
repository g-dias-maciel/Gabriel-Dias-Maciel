<?php
require('app/methods/jsonController.php');


//run "php jsonFormat_task_1.php" on php container
__init();


function __init()
{

    print "JSON parsing basic skills \n\r";

    //test json files dir
    $json_dir = './data/json_files/';
    //load all *.json files in folder
    $json_files = jsonController::jsonLoadFiles($json_dir);

    $data = new stdClass();

    //decode all json files to objects
    foreach ($json_files as $key => $file) {
        $data->{$key} = json_decode(jsonController::jsonGetContent($file));
    }
    //format json files as a table in the console
    jsonController::jsonFormat($data);

}


?>
