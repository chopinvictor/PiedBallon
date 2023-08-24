<?php

function getDb(){
    $db = new PDO('mysql:host=localhost;dbname=piedballon-last;charset=utf8','root');
    return $db;
}

/******************************** Utilisateurs ********************************/

function isValidEmail($email){ 
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function GetAllUtilisateurs(){
    $db = getDb();
    $r = $db->query("SELECT * FROM Utilisateurs");
    return $r->fetchAll();
}

function CreateUtilisateur($nom, $prenom, $email, $mdp, $admin){
    $db = getDb();
    $r = "INSERT INTO utilisateurs(nom, prenom, adresse_mail, mot_de_passe, est_admin) VALUES (:nom, :prenom, :email, :mdp, :est_admin)";
    $req = $db->prepare($r);
    $valeurs = [':nom'=>$nom, ':prenom'=>$prenom , ':email'=>$email, ':mdp'=>$mdp, ':est_admin'=>$admin];
    $req->execute($valeurs);
}

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




