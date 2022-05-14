<?php
    class connection{

        protected function connect(){

        try {
            $username = "root";
         $password = "";
         $host = "localhost";
         $dbname = "pdoaral";
         $dsn = "mysql:host=$host;dbname=$dbname";


         $pdo = new PDO($dsn,$username,$password);
         $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
         echo "SUCCESS"."<br>";
         return $pdo;
         
        } catch (PDOException $th) {
            $th->getMessage();
        }
         
        }

    }
?>