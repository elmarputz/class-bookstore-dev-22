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
    public const CC_NUMBER = 'cardNumber';
    public const CC_NAME = 'nameOnCard';
    public const ACTION_ORDER = 'placeOrder';


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
                AuthenticationManager::signOut();
                Util::redirect();
                break;

            case self::ACTION_ORDER: 
                $user = AuthenticationManager::getAuthenticatedUser();
                if ($user == null) {
                    $this->forwardRequest(['Not logged in']);
                }
                if (!$this->processCheckout($_POST[self::CC_NAME], $_POST[self::CC_NUMBER])) {
                    $this->forwardRequest(['Checkout failed']);
                }
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

    protected function processCheckout(string $nameOnCard = null, string $cardNumber = null) : bool {

        $errors = [];

        if ($nameOnCard == null || strlen($nameOnCard) == 0) {
            $errors[] = 'Invalid name on card';
        }
        if ($cardNumber == null || strlen($cardNumber) != 16 
            || !ctype_digit($cardNumber)) {
                $errors[] = 'Invalid card number, 16 digits required';
            }

        if (sizeof($errors) > 0) {
            $this->forwardRequest($errors);
            return false; 
        }

        if (ShoppingCart::size() == 0) {
            $this->forwardRequest(['Shopping cart is empty']);
            return false;
        }

        $user = AuthenticationManager::getAuthenticatedUser();
        $orderId = \Data\DataManager::createOrder(
            $user->getId(), 
            ShoppingCart::getAll(), 
            $nameOnCard,
            $cardNumber
        );
        if (!$orderId) {
            $this->forwardRequest(['Could not create order']);
            return false;
        }
        ShoppingCart::clear();
        Util::redirect('index.php?view=success&orderId=' . rawurlencode($orderId));
        return true;

    }

}