<?php
require_once 'config.php';
include_once 'functions.php';
 
session_start();

// creazione tabella utenti
/* $sql = 'CREATE TABLE utenti (
    id  INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR (100) NOT NULL,
    cognome VARCHAR (100) NOT NULL,
    telefono  VARCHAR (100) NOT NULL UNIQUE,
    email VARCHAR (100) NOT NULL UNIQUE,
    password VARCHAR (100) NOT NULL,
    img VARCHAR (100) NOT NULL,
)'; */
/* if(!$mysqli->query($sql)){die($mysqli->connect_error);} */


if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'addUser') {
    // aggiunta utente
    $target_dir = 'usersImg/';
    $img = $target_dir.'default.png';

    $nome = strlen(htmlspecialchars(trim($_REQUEST['nome']))) > 1 ? htmlspecialchars(trim($_REQUEST['nome'])) : exit();
    $cognome = strlen(htmlspecialchars(trim($_REQUEST['cognome']))) > 1 ? htmlspecialchars(trim($_REQUEST['cognome'])) : exit(); 

    if(!empty($_FILES['image'])) {
        if($_FILES['image']["type"] === 'image/png' || $_FILES['image']["type"] === 'image/jpg' || $_FILES['image']["type"] === 'image/jpeg') {
            if($_FILES['image']["size"] < 4000000) {
                if(is_uploaded_file($_FILES['image']["tmp_name"]) && $_FILES['image']["error"] === UPLOAD_ERR_OK) {
                    if(move_uploaded_file($_FILES['image']["tmp_name"], $target_dir.str_replace(' ', '', $nome) .'-'.str_replace(' ', '', $cognome))) {
                        $img = $target_dir.str_replace(' ', '', $nome) .'-'.str_replace(' ', '', $cognome);
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

    $regexTel = '/(?:([+]\d{1,4})[-.\s]?)?(?:[(](\d{1,3})[)][-.\s]?)?(\d{1,4})[-.\s]?(\d{1,4})[-.\s]?(\d{1,9})/';
    preg_match_all($regexTel, htmlspecialchars($_REQUEST['telefono']), $matchesTel, PREG_SET_ORDER, 0);
    $regexEmail = '/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/m';
    preg_match_all($regexEmail, htmlspecialchars($_REQUEST['email']), $matchesEmail, PREG_SET_ORDER, 0);
    $regexPass = '/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/';
    preg_match_all($regexPass, htmlspecialchars($_REQUEST['password']), $matchesPass, PREG_SET_ORDER, 0);

    $telefono = $matchesTel ? htmlspecialchars($_REQUEST['telefono']) : exit();
    $email = $matchesEmail ? htmlspecialchars($_REQUEST['email']) : exit();
    $pass = $matchesPass ? htmlspecialchars($_REQUEST['password']) : exit(); 
    $password = password_hash($pass , PASSWORD_DEFAULT);

    addUser($mysqli, $nome, $cognome, $telefono, $email, $password, $img);
    include_once 'mail.php';
    

}else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'updateUserData') { 
    // modifica dati personali
    $target_dir = 'usersImg/';

    $id = $_REQUEST['id'];
    $nome = strlen(htmlspecialchars(trim($_REQUEST['nome']))) > 1 ? htmlspecialchars(trim($_REQUEST['nome'])) : exit();
    $cognome = strlen(htmlspecialchars(trim($_REQUEST['cognome']))) > 1 ? htmlspecialchars(trim($_REQUEST['cognome'])) : exit(); 

    $regexTel = '/(?:([+]\d{1,4})[-.\s]?)?(?:[(](\d{1,3})[)][-.\s]?)?(\d{1,4})[-.\s]?(\d{1,4})[-.\s]?(\d{1,9})/';
    preg_match_all($regexTel, htmlspecialchars($_REQUEST['telefono']), $matchesTel, PREG_SET_ORDER, 0);
    $regexEmail = '/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/m';
    preg_match_all($regexEmail, htmlspecialchars($_REQUEST['email']), $matchesEmail, PREG_SET_ORDER, 0);

    $telefono = $matchesTel ? htmlspecialchars($_REQUEST['telefono']) : exit();
    echo $telefono . '<br>';
    $email = $matchesEmail ? htmlspecialchars($_REQUEST['email']) : exit();
    echo $email . '<br>';

    $password = $_SESSION['userLogin']['password'];

    $img = $_REQUEST['userImg'];
    if($img !== $target_dir.'default.png'){
        $nuovoNomeImg = $target_dir . str_replace(' ', '', $nome) . '-' . str_replace(' ', '', $cognome);
        $img = rename($img, $nuovoNomeImg) ? $nuovoNomeImg : exit();
    }

    $newUser = [
        'id' => $id,
        'nome' => $nome,
        'cognome' => $cognome,
        'telefono' => $telefono,
        'email' => $email,
        'password' => $password, 
        'img' => $img
    ];
    session_unset();

    $_SESSION['userLogin'] = $newUser;

    updateUserData($mysqli, $id, $nome, $cognome, $telefono, $email, $img);
    exit(header('Location: profile.php'));

}else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'updateUserImg') {
    // modifica immagine utente
    $target_dir = 'usersImg/';
    $img = $_REQUEST['userImg'];

    if(!empty($_FILES['image'])) {
        if($_FILES['image']["type"] === 'image/png' || $_FILES['image']["type"] === 'image/jpg' || $_FILES['image']["type"] === 'image/jpeg') {
            if($_FILES['image']["size"] < 4000000) {
                if(is_uploaded_file($_FILES['image']["tmp_name"]) && $_FILES['image']["error"] === UPLOAD_ERR_OK) {
                    
                    
                    if (file_exists($img)) {
                        if($img === $target_dir.'default.png'){
                            if(move_uploaded_file($_FILES['image']["tmp_name"], $target_dir.str_replace(' ', '', $_REQUEST['userName']) .'-'.str_replace(' ', '', $_REQUEST['userSurname']))) {
                                $img = $target_dir.str_replace(' ', '', $_REQUEST['userName']) .'-'.str_replace(' ', '', $_REQUEST['userSurname']);
                                updateUserImg($mysqli, $_REQUEST['id'], $img);
                                $_SESSION['userLogin']['img'] = $img;
                                exit(header('Location: profile.php'));
                                echo 'Caricamento avvenuto con successo';
                            } else {
                                echo 'Errore!!!';
                            }
                        }else if (unlink($img)) { // Elimina il file precedente, se esiste
                            echo "Il file precedente è stato eliminato con successo.";
                            if (move_uploaded_file($_FILES['image']["tmp_name"], $img)) {
                                exit(header('Location: profile.php'));
                                echo 'Caricamento avvenuto con successo';
                            } else {
                                echo 'Errore durante il caricamento del nuovo file';
                            }
                        } else {
                            echo "Si è verificato un errore durante l'eliminazione del file precedente.";
                        }
                    }
                }
            } else {
                echo 'FileSize troppo grande';
            }
        } else {
            echo 'FileType non supportato';
        } 
    }
}else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'deleteUser') {
    deleteUser($mysqli, $_REQUEST['id'], $_REQUEST['img']);
    session_unset();
    exit(header('Location: login.php'));
}


// login e logout
if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'login') {
    login($mysqli, $_REQUEST['email'], $_REQUEST['password']);
} else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'logout') {
    session_unset();
    exit(header('Location: login.php'));
}