<?php

try{
    $host = HOST;
    $dbname = DB_NAME;
    $username = USERNAME;
    $password = PASSWORD;

    $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
}catch(Exception $e){
    echo $e->getMessage();
}