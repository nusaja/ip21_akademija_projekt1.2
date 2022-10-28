<?php

require_once('lib/model.php');
require_once('views/consoleView.php');


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

?>