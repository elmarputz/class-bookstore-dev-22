<?php 

namespace Bookshop;


class SessionContext {


    private static $exists = false; 

    public static function create() : bool {
        if (!self::$exists) {
            self::$exists = session_start();
        }
        return self::$exists;
    }

}