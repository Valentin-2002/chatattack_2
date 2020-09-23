<?php

const hostname = 'localhost';
const username = 'root';
const password = '';
const dbname = 'm151_chatattack_db';

try{

    $pdo = new PDO("mysql:host=" . hostname . ";dbname=" . dbname, username, password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){

    die("ERROR: Could not connect. " . $e->getMessage());

}

?>