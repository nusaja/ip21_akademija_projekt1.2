<?php

// * MODEL SE UKVARJA SAMO S PRIDOBIVANJEM IN OBDELAVO PODATKOV *

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
















?>
