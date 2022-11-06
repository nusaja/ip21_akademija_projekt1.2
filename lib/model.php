<?php

// * MODEL SE UKVARJA SAMO S PRIDOBIVANJEM IN OBDELAVO PODATKOV *

class ConsoleModel {

    public function getData(string $type, ?string $query = null) : array {
        
        if ($type === TYPE_BOTH) {

            return array_merge(
                $this->callApi(TYPE_DOG, $query), 
                $this->callApi(TYPE_CAT, $query)
            );
        }

        return $this->callApi($type, $query);

    }

    public function getSortedData(string $type, ?string $query = null) : array {

        $data = $this->getData($type, $query); 

        $newData = [];

        foreach ($data as $value) {
            $newData[$value["name"]] = $value;
        }

        ksort($newData);

        return $newData;

    }

    private function callApi(string $type, ?string $query = null) : array {

        $url = "https://api.the" . $type . "api.com/v1/breeds" . $query;

        $json = @file_get_contents($url); 

        if ($json === false) {
            throw new Exception("API returned invalid data.");
        }
        
        $data = $this->decode($json);

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

        if (empty($data)) {
            throw new Exception("No results.");
        }


        return $data;

    }

}















?>
