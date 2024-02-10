<?php
require_once 'config.php';
include_once 'functions.php';

//$sql = 'CREATE DATABASE IF NOT EXISTS gestione_libreria';

/*$sql = 'CREATE TABLE IF NOT EXISTS libri ( 
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(255) NOT NULL,
    autore VARCHAR(255) NOT NULL,
    anno_pubblicazione INT UNSIGNED NOT NULL,
    genere INT NOT NULL
)'; */

/* $sql = 'CREATE TABLE IF NOT EXISTS generi_letterari ( 
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    descrizione TEXT(1000) NOT NULL
)';  */

/* $sql = "INSERT INTO generi_letterari (nome, descrizione)
        VALUES 
        ('Fantasy', 'In questo genere letterario a prevalere sono gli elementi fantastici, non spiegabili razionalmente. L’ambientazione è anch’essa frutto della più fervida immaginazione dell’autore e spesso rappresenta dei paesaggi naturali popolati da figure mitologiche o fantastiche, come elfi, fate, streghe, o addirittura inventate dall’autore, come gli hobbit.'),
        ('Romantico', 'L’elemento centrale della trama è una storia d’amore, rigorosamente a lieto fine. '),
        ('Horror', 'I romanzi horror sfruttano le paure innate dei lettori per creare una trama terrifica, macabra e coinvolgente. L’ambientazione è necessariamente tenebrosa, buia e claustrofobica.'),
        ('Avventura', 'La trama si sviluppa intorno a una missione da compiere, spesso in località esotiche o lontane, che mette alla prova le capacità di sopravvivenza del protagonista.'),
        ('Thriller', 'I libri che appartengono a questo genere sono quelli che tengono sempre il lettore con il fiato sospeso, in uno stato costante di tensione, creata appositamente tramite i procedimenti narrativi del climax e della suspense.'),
        ('Fantascienza', 'I romanzi che appartengono a questo genere hanno come elemento centrale una tecnologia, reale o fittizia, con un forte impatto sulla vita dell’uomo. Spesso l’ambientazione è futuristica, ma può anche rappresentare un presente alternativo.')
"; */
/* $sql = 'ALTER TABLE libri ADD CONSTRAINT fk_genere
FOREIGN KEY (genere_id) REFERENCES generi_letterari(id);'; */
if(!$mysqli->query($sql)){die($mysqli->connect_error);}


// eliminazione singolo libro
if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'delete') {
    deleteBook($mysqli, $_REQUEST['id']);
    exit(header('Location: index.php'));
} else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'update') { // modifica libro
    $titolo = strlen(htmlspecialchars(trim($_REQUEST['titolo']))) > 0 ? htmlspecialchars(trim($_REQUEST['titolo'])) : exit();
    $autore = strlen(htmlspecialchars(trim($_REQUEST['autore']))) > 1 ? htmlspecialchars(trim($_REQUEST['autore'])) : exit();
    $anno_pubb = filter_var($_REQUEST['anno_pubb'], FILTER_VALIDATE_INT) ? $_REQUEST['anno_pubb'] : exit();
    $genere_id = filter_var($_REQUEST['genere'], FILTER_VALIDATE_INT) ? $_REQUEST['genere'] : exit();

    updateBook($mysqli, $_REQUEST['id'], $titolo, $autore, $anno_pubb, $genere_id);
    exit(header('Location: index.php'));
    
} else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'create') { // creazione libro
    $titolo = strlen(htmlspecialchars(trim($_REQUEST['titolo']))) > 0 ? htmlspecialchars(trim($_REQUEST['titolo'])) : exit();
    $autore = strlen(htmlspecialchars(trim($_REQUEST['autore']))) > 1 ? htmlspecialchars(trim($_REQUEST['autore'])) : exit();
    $anno_pubb = filter_var($_REQUEST['anno_pubb'], FILTER_VALIDATE_INT) ? $_REQUEST['anno_pubb'] : exit();
    $genere_id = filter_var($_REQUEST['genere'], FILTER_VALIDATE_INT) ? $_REQUEST['genere'] : exit();
    
    createBook($mysqli, $titolo, $autore, $anno_pubb, $genere_id);
}
