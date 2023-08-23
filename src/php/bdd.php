<?php

function getDb(){
    $db = new PDO('mysql:host=localhost;dbname=piedballon;charset=utf8','root');
    return $db;
}

