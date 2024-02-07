<?php
include_once 'config.php';

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
function createBook($mysqli, $titolo, $autore, $anno_pubb, $genere){
    $sql = "INSERT INTO libri (titolo, autore, anno_pubblicazione, genere_id)
        VALUES ('$titolo', '$autore', '$anno_pubb', '$genere')";

if(!$mysqli->query($sql)) { die($mysqli->connect_error); }
header('Location: ../pages/index.php');
}

// elimina libro
function deleteBook($mysqli, $id){
    $sql = 'DELETE FROM libri WHERE id = '.$id;
    if(!$mysqli->query($sql)){ echo($mysqli->connect_error); }
    else { echo 'Libro eliminato con successo!!!';}
}

// modifica libro
function updateBook($mysqli, $id, $titolo, $autore, $anno_pubb, $genere){
    $sql = "UPDATE libri SET
        titolo = '" . $titolo . "',
        autore = '" . $autore . "',
        anno_pubblicazione = '" . $anno_pubb . "',
        genere = '" . $genere . "'
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