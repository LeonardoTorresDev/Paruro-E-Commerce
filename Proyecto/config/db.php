<?php

    class Database{
        public static function connect(){
            $db=new mysqli('localhost','administrador','thedarksideofthemoon','tienda','3308');
            $db->query("SET NAMES utf8");
            return $db;
        }
    }

?>