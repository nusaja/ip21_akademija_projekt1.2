<?php

if (isset($argv[1])) {

    $json = file_get_contents('https://api.thedogapi.com/v1/breeds/search?q=' . $argv[1]);
    $array = json_decode($json, TRUE);

    foreach ($array as $item) {
        echo $item["name"] . "\n";
    }

     
} else {

    $json = file_get_contents('https://api.thedogapi.com/v1/breeds');

    $array = json_decode($json, TRUE);

    foreach ($array as $item) {
    echo $item["name"] . "\n";
    }

}


?>