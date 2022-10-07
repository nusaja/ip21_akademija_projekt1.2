<?php


if (isset($argv[1]) && is_string($argv[1]) && ctype_alpha($argv[1]) && strlen($argv[1]) > 1 && strlen($argv[1] < 100)) {

    $json = file_get_contents('https://api.thedogapi.com/v1/breeds/search?q=' . $argv[1]);

    if ($json === false) {
        echo "Error!\n";
        die;
    }

    if (empty($json)) {
        echo "No results.\n";
    }

    $array = json_decode($json, TRUE);

    if ($array === null) {
        echo "Incorrect data!\n"; 
        die;
    }

    listNames($array); 

     
} else {

    $json = @file_get_contents('https://api.thedogapi.com/v1/breeds');

    if ($json === false) {
        echo "Error!\n";
        die;
    }

    $array = json_decode($json, TRUE);


    if ($array === null) {
        echo "Incorrect data!\n"; 
        die;
    }

    listNames($array); 

}




function listNames($array) {

    foreach ($array as $item) {
        echo $item["name"] . "\n";
        }

}

?>