<?php 

require_once('lib/model.php');

$model = new Model();

define("TYPE_DOG", "dog");
define("TYPE_CAT", "cat");
define("TYPE_BOTH", "both");

define("TYPES", [
    TYPE_CAT,
    TYPE_DOG, 
    TYPE_BOTH
  ]);

$type = "both";

$data = $model->getSortedData($type);
var_dump($data); 
