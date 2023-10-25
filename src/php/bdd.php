<?php


$dsn = 'mysql:host=localhost;dbname=piedballon2;charset=utf8';
$username = 'root';
$password = '';
$db = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


