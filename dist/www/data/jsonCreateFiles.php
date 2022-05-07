<?php

createJSONfromMock();

function createJSONfromMock(){

    $mock_content = file_get_contents('./MOCK_DATA.json');
    $json_contents = json_decode($mock_content);

    foreach ($json_contents as $key => $content){
        $file = fopen('./json_files/'.$key.'.json', 'w');
        fwrite($file, json_encode($content));
        fclose($file);
    }


}





?>