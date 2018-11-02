<?php
// Class db digunakan untuk melakukan koneksi ke databse
class DB {
    function __construct() 
    { 
       global $db;

    }

    function connect()
    {
        global $db;
        try {
            
            // blok ini digunakn untuk melakukan koneksi ke databse
            $conn = new PDO("mysql:host={$db['host']};port={$db['port']};dbname={$db['database']}", $db['username'], $db['password']);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }
}