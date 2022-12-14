<?php

// * VIEW SE UKVARJA SAMO S PRIKAZOVANJEM PODATKOV *

class ConsoleView {

    public function listNames(array $data) : void {

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
            echo $type . $value["name"] . "\n";
        }

    }

}


?>
