<?php 

namespace Bookshop;

class Util {

    public static function escape(string $string) : string {
        return nl2br(htmlentities($string));
    }


}