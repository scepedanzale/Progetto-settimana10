<?php
include_once 'config.php';


// LIBRI

function getAllBooks($mysqli){
    $sql = 'SELECT libri.*, generi_letterari.nome as genere FROM libri INNER JOIN generi_letterari ON libri.genere_id = generi_letterari.id;';
    $books = [];
    $res = $mysqli->query($sql);
    if($res) {
        while($row = $res->fetch_assoc() ) { 
            array_push($books, $row); 
        }
    }
    return $books;
}

// crea libro
function createBook($mysqli, $titolo, $autore, $anno_pubb, $genere_id){
    $sql = "INSERT INTO libri (titolo, autore, anno_pubblicazione, genere_id)
        VALUES ('$titolo', '$autore', '$anno_pubb', '$genere_id')";
    if(!$mysqli->query($sql)) { die($mysqli->connect_error); }
    else { echo 'Libro creato con successo!!!';}
}
// elimina libro
function deleteBook($mysqli, $id){
    $sql = 'DELETE FROM libri WHERE id = '.$id;
    if(!$mysqli->query($sql)){ echo($mysqli->connect_error); }
    else { echo 'Libro eliminato con successo!!!';}
}
// modifica libro
function updateBook($mysqli, $id, $titolo, $autore, $anno_pubb, $genere_id){
    $sql = "UPDATE libri SET
        titolo = '" . $titolo . "',
        autore = '" . $autore . "',
        anno_pubblicazione = '" . $anno_pubb . "',
        genere_id = '" . $genere_id . "'
        WHERE id = " . $id;
    if(!$mysqli->query($sql)){ echo($mysqli->connect_error); }
    else { echo 'Libro modificato con successo!!!';}
}

// selezione dei generi letterari
function getGenres($mysqli){
    $sql = 'SELECT * FROM generi_letterari';
    $result = [];
    $res = $mysqli->query($sql);
    if($res){
        while($row = $res->fetch_assoc()){
            array_push($result, $row);
        }
    }
    return $result;
}
// descrizione genere letterario
function genreDescription($mysqli, $id){
    $sql = 'SELECT * FROM generi_letterari WHERE id = ' . $id;
    $response = $mysqli->query($sql);
    if($response){
        $result = $response->fetch_assoc();
    }
    return $result;
}



// UTENTI

function getAllUsers($mysqli){
    $sql = 'SELECT * FROM utenti';
    $users = [];
    $res = $mysqli->query($sql);
    if($res) {
        while($row = $res->fetch_assoc() ) { 
            array_push($users, $row); 
        }
    }
    return $users;
}
// crea utenti
function addUser($mysqli, $nome, $cognome, $telefono, $email, $password, $img){
    $sql = "INSERT INTO utenti (nome, cognome, telefono, email, password, img)
            VALUES ('$nome', '$cognome', '$telefono', '$email', '$password', '$img')";
    if(!$mysqli->query($sql)) { die($mysqli->connect_error); }
    
}
// modifica dati utente
function updateUserData($mysqli, $id, $nome, $cognome, $telefono, $email, $img){
    $sql = "UPDATE utenti SET
        nome = '" . $nome . "',
        cognome = '" . $cognome . "',
        telefono = '" . $telefono . "',
        email = '" . $email . "',
        img = '" . $img . "'
        WHERE id = " . $id;
    if(!$mysqli->query($sql)){ die($mysqli->connect_error); }
}
//elimina utente
function deleteUser($mysqli, $id, $img){
    $sql = 'DELETE FROM utenti WHERE id = '.$id;
    if(!$mysqli->query($sql)){ die($mysqli->connect_error); }
    else if($img !== 'usersImg/default.png'){ 
        unlink($img)
    ;}
}

//modifica immagine
function updateUserImg($mysqli, $id, $img){
    $sql = "UPDATE utenti SET img = '" . $img . "' WHERE id = " . $id;
    if(!$mysqli->query($sql)){ die($mysqli->connect_error); }
}

// login
function login($mysqli, $email, $password) {
    $sql = "SELECT * FROM utenti WHERE email = '$email'";
    $res = $mysqli->query($sql);
    if($res) { 
        $result = $res->fetch_assoc(); 
    }
    if(password_verify($password, $result['password'])){
        $_SESSION['userLogin'] = $result;
        session_write_close();
        exit(header('Location: index.php'));
    } else {
        echo 'Password errata!!';
    }
}