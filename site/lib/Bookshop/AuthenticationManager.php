<?php 
namespace Bookshop;

SessionContext::create();

class AuthenticationManager {

    public static function authenticate(string $userName, string $password) : bool {
        $user = \Data\DataManager::getUserByUserName($userName);
        if ($user != null && 
            $user->getPasswordHash() == hash('sha1', $userName . '|' . $password)) {
                $_SESSION['user'] = $user->getId();
                return true;
            }
        self::signOut();
        return false;
    }

    public static function isAuthenticated(): bool {
        return isset($_SESSION['user']);
    }

    public static function getAuthenticatedUser() : ?User {
        return self::isAuthenticated() ? \Data\DataManager::getUserById($_SESSION['user']) : null;
    } 

    public static function signOut() : void {
        unset($_SESSION['user']);
    }


}