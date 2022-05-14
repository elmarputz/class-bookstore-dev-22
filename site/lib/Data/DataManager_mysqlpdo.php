<?php 

namespace Data;

use Bookshop\Category;
use Bookshop\Book;
use Bookshop\User;


class DataManager implements IDataManager {

    private static $__connection;


    private static function getConnection() {
      if (!isset(self::$__connection)) {
        $type = 'mysql';
        $host = 'db';
        $name = 'db';
        $user = 'db';
        $pass = 'db';

        self::$__connection = new \PDO($type . ':host='. $host . ';dbname=' . $name . ';charset=utf8', 
          $user, $pass);

      }

      return self::$__connection;

    }

    public static function exposeConnection() {
      return self::getConnection();
    }


    private static function query ($connection, $query, $parameters = []) {
      $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $statement = $connection->prepare($query);
      try {
        $i = 1;
        foreach ($parameters as $param) {
          if (is_int($param)) {
            $statement->bindValue($i, $param, \PDO::PARAM_INT);
          }
          if (is_string($param)) {
            $statement->bindValue($i, $param, \PDO::PARAM_STR);
          }
          $i++;
        }
        $statement->execute();
      }
      catch (\Exception $e) {
        die ($e->getMessage());
      }
      return $statement;
    }


    private static function lastInsertId($connection) {
      return $connection->lastInsertId();
    }

    private static function fetchObject($cursor) {
      return $cursor->fetchObject();
    }

    private static function close($cursor)  {
      $cursor->closeCursor();
    }

    private static function closeConnection() {
      self::$__connection = null;
    }



    public static function getCategories() : array {
      $categories = [];
      $con = self::getConnection();
      $res = self::query($con, "
        SELECT id, name 
        FROM categories;  
      ");
      while ($cat = self::fetchObject($res)) {
        $categories[] = new Category($cat->id, $cat->name);
      }
      self::close($res);
      self::closeConnection();
      return $categories;
    }

    public static function getBooksByCategory(int $categoryId) : array {
        return [];
    }


    public static function getBooksForSearchCriteria (string $term) : array {
       return [];
   
    }

    public static function getUserById (int $userId) : ?User {
      return null;
    }

    public static function getUserByUserName (string $userName) : ?User {
       return null;
    }


    public static function createOrder (int $userId, array $bookIds, string $nameOnCard, string $cardNumber) : int {
        return rand();
    }




}