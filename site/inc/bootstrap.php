<?php 
declare(strict_types=1);
error_reporting(E_ALL);

$default_view = 'welcome';

// very simple classloader
spl_autoload_register(function ($class) {
    $filename = __DIR__ . '/../lib/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($filename)) {
        include($filename);
    }


});

// datamanager dependency injection 
$mode = 'mock';

require_once(__DIR__ . '/../lib/Data/DataManager_' . $mode . '.php');