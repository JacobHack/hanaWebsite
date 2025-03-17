<?php
function connect_db(){
    define('DBHOST', 'localhost');
    define('DBNAME', 'test');
    define('DBUSER', 'root');
    define('DBPASS', '');
    //define('DBCONNSTRING','sqlite:./art.db');
    define('DBCONNSTRING',"mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4;");

    try{
        $con = new pdo(DBCONNSTRING, DBUSER, DBPASS);
    }
    catch(PDOException $e){
        die($e->getMessage()); 
    }
    return $con;
}
?>