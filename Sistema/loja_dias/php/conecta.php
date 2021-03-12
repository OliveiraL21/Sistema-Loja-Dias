<?php 
 define('HOST', 'localhost');
 define('USER', 'root' );
 define('PASSWORD','');
 define('DB_Name', 'lojaDias' );

 $pdo = new PDO( 'mysql:host='. HOST . ';dbname=' .DB_Name, USER, PASSWORD);


?>