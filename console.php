<?php

$action = $argv[1] ?? null;
$breed = $argv[2] ?? null;
$search = $argv[3] ?? null;

$url = "https://api.the" . $breed . "api.com/v1/breeds";


switch ($action) {
    case "list":
        $array = callApi($url);
        listNames($array);
        break;
    case "search":
        if (isset($search) && is_string($search) && ctype_alpha($search) && strlen($search) > 1 && strlen($search < 100)) {
            $array = callApi($url . '/search?q=' . $search);
            listNames($array); 
        } else {
            echo "Invalid search!\n";
        }
        break;
    default:
        echo "Type in list or search!\n";

}


function callApi($url) {

    $json = @file_get_contents($url); 
    
    $array = decode($json);

    return $array;

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