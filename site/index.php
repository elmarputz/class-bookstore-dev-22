<?php 
require_once('inc/bootstrap.php');
// test

$view = $default_view;

if (isset($_REQUEST['view']) && 
    file_exists(__DIR__ . '/views/' . strtolower($_REQUEST['view']) . '.php'))  {

        $view = $_REQUEST['view'];

    }

// wenn post action, dann controller aktivieren
$postAction = $_REQUEST[Bookshop\Controller::ACTION] ?? null;
if ($postAction) 
    Bookshop\Controller::getInstance()->invokePostAction();



require_once('views/' . $view . '.php');