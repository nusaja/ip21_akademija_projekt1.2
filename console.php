<?php

require_once('lib/model.php');
require_once('views/consoleView.php');

$view = new ConsoleView();
$model = new ConsoleModel();



$action = $argv[1] ?? null;
$type = $argv[2] ?? null;
$search = $argv[3] ?? null;

define("ACTION_LIST", "list");
define("ACTION_SEARCH", "search");

define("ACTIONS", [
    ACTION_LIST,
    ACTION_SEARCH
]);

define("TYPE_DOG", "dog");
define("TYPE_CAT", "cat");
define("TYPE_BOTH", "both");

define("TYPES", [
    TYPE_CAT,
    TYPE_DOG, 
    TYPE_BOTH
  ]);
  

if (!in_array($action, ACTIONS)) {
    echo "Action invalid.\n";
    die;
} 

if (!in_array($type, TYPES)) {
    echo "Type invalid.\n";
    die;
} 


switch ($action) {
    case "list":
        try {
            $data = $model->getData($type);
            $view->listNames($data);    
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            die;
        }
        
        break;
    case "search":
        if (isset($search) && is_string($search) && ctype_alpha($search) && strlen($search) > 1 && strlen($search < 100)) {
            try {
                $data = $model->getData($type, "/search?q=" . $search);
                $view->listNames($data);    
            } catch (\Exception $e) {
                echo $e->getMessage() . "\n";
                die;
            }
        } else {
            echo "Invalid search!\n";
        }
}

?>