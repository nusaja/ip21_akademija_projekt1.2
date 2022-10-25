<?php

$action = $argv[1] ?? null;
$type = $argv[2] ?? null;
$search = $argv[3] ?? null;

define("TYPE_DOG", "dog");
define("TYPE_CAT", "cat");
define("TYPE_BOTH", "both");

define("TYPES", [
    TYPE_CAT,
    TYPE_DOG, 
    TYPE_BOTH
  ]);
  

if (!in_array($type, TYPES)) {
    echo "Type invalid.\n";
    die;
} 


switch ($action) {
    case "list":
        try {
            $data = getData($type);
            listNames($data);    
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            die;
        }
        
        break;
    case "search":
        if (isset($search) && is_string($search) && ctype_alpha($search) && strlen($search) > 1 && strlen($search < 100)) {
            try {
                $data = getData($type, "/search?q=" . $search);
                listNames($data);    
            } catch (\Exception $e) {
                echo $e->getMessage() . "\n";
                die;
            }
        } else {
            echo "Invalid search!\n";
        }
        break;
    default:
        echo "Type in list or search!\n";

}


function getData(string $type, ?string $query = null) : array {
    
    if ($type === TYPE_BOTH) {

        return array_merge(
            callApi(TYPE_DOG, $query), 
            callApi(TYPE_CAT, $query)
        );
    }

    return callApi($type, $query);

}

function callApi(string $type, string $query) : array {

    $url = "https://api.the" . $type . "api.com/v1/breeds" . $query;

    $json = @file_get_contents($url); 

    if ($json === false) {
        throw new Exception("API returned invalid data.");
    }
    
    $data = decode($json);

    foreach ($data as $key => $value) {
        $data[$key]["type"] = $type; 
    }

    return $data;

}


function decode(string $json) : array {

    $data = json_decode($json, TRUE);

    if ($data === null) {
        throw new Exception("Incorrect data.");
    }

    return $data;

}

function listNames(array $data) : void {

    $newData = [];

    foreach ($data as $value) {
        $newData[$value["name"]] = $value;
    }

    ksort($newData);

    foreach ($newData as $value) {
        if ($value["type"] === TYPE_DOG) {
            $type = "(d) ";
        } else {
            $type = "(c) ";
        }
    }

    foreach ($newData as $item) {
        echo $type . $item["name"] . "\n";
        }

}

?>