<?php include_once 'header.php' ?>
<?php include_once 'navbar.php' ?>
<?php include_once '../logic/functions.php' ?>

<h1 class="m-5">Cielo's Books</h1>
<div class="container p-3 bg-secondary rounded-4">
    <form action="../logic/controller.php" method="POST" class="text-center">
        <div class="mb-3">
            <input type="text" name="titolo" class="form-control" placeholder="titolo..." required minlength="1">
        </div>
        <div class="mb-3">
            <input type="text" name="autore" class="form-control" placeholder="autore..." required minlength="2">
        </div>
        <div class="mb-3">
            <input type="number" name="anno_pubb" class="form-control" placeholder="anno di pubblicazione..." required>
        </div>
        <div class="mb-3">
            <input type="text" name="genere" class="form-control" placeholder="genere..." required>
        </div>
        <button type="submit" class="btn btn-outline-light w-50">Inserisci</button>
    </form>
</div>
<div class="container-fluid p-5">
   
        <?php
            $libri = getAllBooks($mysqli);
            if($libri){?>
                <table class="table table-secondary table-striped">
                    <tr class="text-center">
                        <th>Titolo</th>
                        <th>Autore</th>
                        <th>Anno di Pubblicazione</th>
                        <th>Genere</th>
                        <th></th>
                    </tr>
                    <?php foreach($libri as $key => $book){?>
                        <tr>
                            <td><?=$book['titolo']?></td>
                            <td><?=$book['autore']?></td>
                            <td class="text-center"><?=$book['anno_pubblicazione']?></td>
                            <td><?=$book['genere']?></td>
                            <td>
                                <a href="../logic/controller.php?action=delete&id=<?= $book['id'] ?>" class="btn btn-outline-dark my-1" role="button"><i class="bi bi-trash"></i></a>
                                <a href="update.php?action=update&id=<?= $book['id'] ?>" class="btn btn-outline-dark my-1"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                <?php } ?>

                </table>
            <?php } ?>
</div>

<?php include_once 'footer.php' ?>





<!-- 

Si desidera creare un'applicazione web per la gestione di una libreria. 
L'applicazione dovrà consentire agli utenti di visualizzare i libri disponibili, 
aggiungere nuovi libri, modificare i dettagli dei libri esistenti e rimuovere i 
libri. 
I dettagli dei libri includono il titolo, l'autore, l'anno di pubblicazione e il genere.


1.Pagina principale: 
    1. Mostra un elenco di tutti i libri disponibili con i dettagli di ciascun libro (titolo, autore, anno di pubblicazione, genere). 
    2. Permette agli utenti di aggiungere un nuovo libro tramite un modulo. 
2.Aggiunta di un nuovo libro: 
    1. Crea un modulo che consenta agli utenti di inserire i dettagli di un nuovo libro (titolo, autore, anno di pubblicazione, genere). 
    2. Quando il modulo viene inviato, i dati del libro devono essere salvati nel database. 
3.Modifica dei dettagli del libro: 
    1. Permette agli utenti di modificare i dettagli di un libro esistente selezionando il libro dalla lista e compilando un modulo con i nuovi dettagli. 
    2. Quando il modulo viene inviato, i dati del libro devono essere aggiornati nel database. 
4.Rimozione di un libro: 
    1. Permette agli utenti di rimuovere un libro esistente selezionandolo dalla lista.

Struttura del database: 
•Crea un database chiamato gestione_libreria. 
•Crea una tabella chiamata libri con i seguenti campi: 
    • id (int, auto-increment, chiave primaria) 
    • titolo (varchar) 
    • autore (varchar) 
    • anno_pubblicazione (int) 
    • genere (varchar)

-->