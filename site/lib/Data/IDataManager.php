<?php 
namespace Data;
use \Bookshop\User;

interface IDataManager {

    public static function getCategories() : array;
    public static function getBooksByCategory(int $categoryId) : array;
    public static function getUserById (int $userId) : ?User;
    public static function getUserByUserName (string $userName) : ?User;
    public static function createOrder (int $userId, array $bookIds, string $nameOnCard, string $cardNumber) : int;
    public static function getBooksForSearchCriteria (string $term) : array;


}