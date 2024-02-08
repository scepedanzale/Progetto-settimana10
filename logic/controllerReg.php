<?php
require_once 'config.php';
 
/* $sql = 'CREATE TABLE utenti (
    id  INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR (100) NOT NULL,
    cognome VARCHAR (100) NOT NULL,
    telefono  INT NOT NULL UNIQUE,
    email VARCHAR (100) NOT NULL UNIQUE,
    password VARCHAR (100) NOT NULL,
    img VARCHAR (100) NOT NULL,
)'; */
if(!$mysqli->query($sql)){die($mysqli->connect_error);}

$target_dir = "assets/";
$image = $target_dir.'avatar.png';

if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'addUser') {

    if(!empty($_FILES['image'])) {
       //print_r($_FILES['image']);
        if($_FILES['image']["type"] === 'image/png' || $_FILES['image']["type"] === 'image/jpg' || $_FILES['image']["type"] === 'image/jpeg') {
            if($_FILES['image']["size"] < 4000000) {
                if(is_uploaded_file($_FILES['image']["tmp_name"]) && $_FILES['image']["error"] === UPLOAD_ERR_OK) {
                    if(move_uploaded_file($_FILES['image']["tmp_name"], $target_dir.$_REQUEST['firstname'].'-'.$_REQUEST['lastname'])) {
                        $image = $target_dir.$_REQUEST['firstname'].'-'.$_REQUEST['lastname'];
                        echo 'Caricamento avvenuto con successo';
                    } else {
                        echo 'Errore!!!';
                    }
                }
            } else {
                echo 'FileSize troppo grande';
            }
        } else {
            echo 'FileType non supportato';
        } 
    }

    $firstname = strlen(htmlspecialchars(trim($_REQUEST['firstname']))) > 1 ? htmlspecialchars(trim($_REQUEST['firstname'])) : exit();
   $lastname = strlen(htmlspecialchars(trim($_REQUEST['lastname']))) > 1 ? htmlspecialchars(trim($_REQUEST['lastname'])) : exit(); 
/*  
    /* $titolo = strlen(htmlspecialchars(trim($_REQUEST['titolo']))) > 0 ? htmlspecialchars(trim($_REQUEST['titolo'])) : exit();
    $autore = strlen(htmlspecialchars(trim($_REQUEST['autore']))) > 1 ? htmlspecialchars(trim($_REQUEST['autore'])) : exit();
    $anno_pubb = filter_var($_REQUEST['anno_pubb'], FILTER_VALIDATE_INT) ? $_REQUEST['anno_pubb'] : exit();
    $genere = strlen(htmlspecialchars(trim($_REQUEST['genere']))) > 1 ? htmlspecialchars(trim($_REQUEST['genere'])) : exit(); */

    echo $firstname;
    echo $lastname;
     echo '<img src=' . $image . '>'; 
}