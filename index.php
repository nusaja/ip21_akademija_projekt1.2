<?php 

require_once './vendor/autoload.php';
require_once('lib/model.php');

$loader = new \Twig\Loader\FilesystemLoader('./views/templates');
$twig = new \Twig\Environment($loader, [
    //'cache' => './cache',
    'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

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

echo $twig->render('list.html.twig', ['data' => $data]);    
