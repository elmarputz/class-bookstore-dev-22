<?php 
namespace Bookshop;


class Controller {

    public const ACTION = 'action';
    public const PAGE = 'page';
    public const ACTION_ADD = 'addToCart';
    public const ACTION_REMOVE = 'removeFromCart';


    private static $instance = false;

    private function __construct() { }

    public static function getInstance() : Controller {
        if (!self::$instance) {
            self::$instance = new Controller();
        }
        return self::$instance;
    }


    public function invokePostAction() : never {

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            throw new \Exception('Controller only accepts POST request');
        }
        elseif (!isset($_REQUEST[self::ACTION])) {
            throw new \Exception(self::ACTION . 'not specified');
        }

        $action = $_REQUEST[self::ACTION];

        switch ($action) {

            case self::ACTION_ADD: 
                ShoppingCart::add((int) $_REQUEST['bookId']);
                Util::redirect();
                break;

            case self::ACTION_REMOVE: 
                ShoppingCart::remove((int) $_REQUEST['bookId']);
                Util::redirect();
                break;

            default : 
                throw new \Exception('Unknown controller action ' . $action);
        }
    }

}