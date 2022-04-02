<?php 
namespace Bookshop;


class Controller {

    public const ACTION = 'action';
    public const PAGE = 'page';
    public const ACTION_ADD = 'addToCart';
    public const ACTION_REMOVE = 'removeFromCart';
    public const ACTION_LOGIN = 'login';
    public const ACTION_LOGOUT = 'logout';
    public const USER_NAME = 'userName';
    public const USER_PASSWORD = 'password';


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

            case self::ACTION_LOGIN: 
                if (!AuthenticationManager::authenticate(
                    $_REQUEST[self::USER_NAME], $_REQUEST[self::USER_PASSWORD])) {
                        $this->forwardRequest(array('Invalid username or password'));
                    }
                Util::redirect();
                break;

            case self::ACTION_LOGOUT:
                break;

            default : 
                throw new \Exception('Unknown controller action ' . $action);
        }

    }

    
    protected function forwardRequest(array $errors = null, string $target = null) : never {
        if ($target == null)  {
            if (!isset($_REQUEST[self::PAGE])) {
                throw new \Exception(('missing target for forward'));
            }
            $target = $_REQUEST[self::PAGE];    
        }
        
        if (count($errors) > 0) {
            $target .= '&errors=' . urlencode(serialize($errors));
        }
        header('location: ' . $target);
        exit();

    }

}