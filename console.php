<?php


if (isset($argv[1])) {

    if ($argv[1] === "list") {

        $json = @file_get_contents('https://api.thedogapi.com/v1/breeds');

        $array = decode($json);
    
        listNames($array); 
    
    } elseif ($argv[1] === "search" && isset($argv[2]) && is_string($argv[2]) && ctype_alpha($argv[2]) && strlen($argv[2]) > 1 && strlen($argv[2] < 100)) {

        $json = file_get_contents('https://api.thedogapi.com/v1/breeds/search?q=' . $argv[2]);

        $array = decode($json);
    
        listNames($array); 

    }

} else {
    
    echo "Type in list or search!\n";

}


function decode($json) {

    if ($json === false) {
        echo "Error!\n";
        die;
    }

    $array = json_decode($json, TRUE);


    if ($array === null) {
        echo "Incorrect data!\n"; 
        die;
    }

    return $array;

}

function listNames($array) {

    foreach ($array as $item) {
        echo $item["name"] . "\n";
        }

}

?>