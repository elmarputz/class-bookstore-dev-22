<?php 
require_once('inc/bootstrap.php');
// test

$view = $default_view;

if (isset($_REQUEST['view']) && 
    file_exists(__DIR__ . '/views/' . strtolower($_REQUEST['view']) . '.php'))  {

        $view = $_REQUEST['view'];

    }


require_once('views/' . $view . '.php');