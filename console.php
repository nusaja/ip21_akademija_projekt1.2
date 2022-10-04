<?php

$json = file_get_contents('https://api.thedogapi.com/v1/breeds');

$array = json_decode($json, TRUE);

var_dump($array);

foreach ($array as $item) {
    echo $item["name"];
}













?>