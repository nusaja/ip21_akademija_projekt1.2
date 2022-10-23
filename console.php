<?php

$action = $argv[1] ?? null;
$breed = $argv[2] ?? null;
$search = $argv[3] ?? null;


switch ($action) {
    case "list":
        $array = getData($breed, "");
        listNames($array);
        break;
    case "search":
        if (isset($search) && is_string($search) && ctype_alpha($search) && strlen($search) > 1 && strlen($search < 100)) {
            $array = getData($breed, "/search?q=" . $search);
            listNames($array); 
        } else {
            echo "Invalid search!\n";
        }
        break;
    default:
        echo "Type in list or search!\n";

}


function getData($breed, $query) {
    
    if ($breed === "both") {

        return array_merge(
            callApi("dog", $query), 
            callApi("cat", $query)
        );
    }

    return callApi($breed, $query);

}

function callApi($breed, $query) {

    $url = "https://api.the" . $breed . "api.com/v1/breeds" . $query;

    $json = @file_get_contents($url); 
    
    $array = decode($json);

    foreach ($array as $key => $value) {
        $array[$key]["type"] = $breed; 
    }

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

    $newArray = [];

    foreach ($array as $value) {
        $newArray[$value["name"]] = $value;
    }

    ksort($newArray);

    foreach ($newArray as $value) {
        if ($value["type"] === "dog") {
            $type = "(d) ";
        } else {
            $type = "(c) ";
        }
    }

    foreach ($newArray as $item) {
        echo $type . $item["name"] . "\n";
        }

}

?>