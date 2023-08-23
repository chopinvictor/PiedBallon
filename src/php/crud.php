<?php

function DataBaseConnexion(){
    try{
    $user = "root";
    $pass = "";
    $pdo = new PDO('mysql:host=localhost;dbname=PiedBallon',$user,$pass);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $pdo;
    } catch(PDOException $e){
        print "Erreur !:".$e->getMessage()."<br/>";
    }
}


function CreateMatch($name,$location,$first_team,$seconde_team){


}


function UpdateMatch($id,$name,$location,$first_team,$seconde_team){

}


function DeleteMatch($id){

}


