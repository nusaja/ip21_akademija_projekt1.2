<?php

// * VIEW SE UKVARJA SAMO S PRIKAZOVANJEM PODATKOV *

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
