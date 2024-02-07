<?php
require_once 'config.php';
include_once 'functions.php';

//$sql = 'CREATE DATABASE IF NOT EXISTS gestione_libreria';

/*$sql = 'CREATE TABLE IF NOT EXISTS libri ( 
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(255) NOT NULL,
    autore VARCHAR(255) NOT NULL,
    anno_pubblicazione INT UNSIGNED NOT NULL,
    genere VARCHAR(100) NOT NULL
)'; */


// eliminazione singolo libro
if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'delete') {
    deleteBook($mysqli, $_REQUEST['id']);
    exit(header('Location: ../pages/index.php'));
} else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'update') {
    $titolo = strlen(htmlspecialchars(trim($_REQUEST['titolo']))) > 0 ? htmlspecialchars(trim($_REQUEST['titolo'])) : exit();
    $autore = strlen(htmlspecialchars(trim($_REQUEST['autore']))) > 1 ? htmlspecialchars(trim($_REQUEST['autore'])) : exit();
    $anno_pubb = filter_var($_REQUEST['anno_pubb'], FILTER_VALIDATE_INT) ? $_REQUEST['anno_pubb'] : exit();
    $genere = strlen(htmlspecialchars(trim($_REQUEST['genere']))) > 1 ? htmlspecialchars(trim($_REQUEST['genere'])) : exit();

    updateBook($mysqli, $_REQUEST['id'], $titolo, $autore, $anno_pubb, $genere);
    exit(header('Location: ../pages/index.php'));
} else {
    $titolo = strlen(htmlspecialchars(trim($_POST['titolo']))) > 0 ? htmlspecialchars(trim($_POST['titolo'])) : exit();
    $autore = strlen(htmlspecialchars(trim($_POST['autore']))) > 1 ? htmlspecialchars(trim($_POST['autore'])) : exit();
    $anno_pubb = filter_var($_POST['anno_pubb'], FILTER_VALIDATE_INT) ? $_POST['anno_pubb'] : exit();
    $genere = strlen(htmlspecialchars(trim($_POST['genere']))) > 1 ? htmlspecialchars(trim($_POST['genere'])) : exit();
    
    createBook($mysqli, $titolo, $autore, $anno_pubb, $genere);
}
