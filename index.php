<?php include_once 'header.php' ?>
<?php include_once 'navbar.php' ?>
<?php include_once 'logic/functions.php' ?>


<div class="container p-3 text-center">

    <button class="btn violet-bg my-3 w-50" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <span class>Aggiungi un nuovo libro</span>
    </button>
    <div class="collapse" id="collapseExample">
        <form action="logic/controller.php?action=create" method="POST" class="text-center">
        <div class="input-group mb-3">
                <input type="text" id="titolo" name="titolo" class="form-control" placeholder="titolo..." required minlength="1">
            </div>
            <div class="input-group mb-3">
                <input type="text" name="autore" class="form-control" placeholder="autore..." required minlength="2">
            </div>
            <div class="input-group mb-3">
                <input type="number" name="anno_pubb" class="form-control" placeholder="anno di pubblicazione..." required>
            </div>
            <div class="input-group mb-3">
                <select name='genere' id="" class="form-control">
                    <option value="">genere...</option>
                    <?php
                        $generi = getGenres($mysqli);
                        if($generi){
                            foreach($generi as $key => $genere){
                                echo "<option value='{$genere['id']}'>{$genere['nome']}</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn w-50 green-bg">Inserisci</button>
            </div>
        </form>
    </div>
</div>


<!-- crea card libri -->
<div class="container-fluid table ">
   <div class="row">
       <?php
           $libri = getAllBooks($mysqli);
           if($libri){?>
               <?php foreach($libri as $key => $book){?>
                <div class="col-6 my-3">
                    <div class="card border-violet">
                        <div class="card-body">
                            <h5 class="card-title no-br"><nobr><?=$book['titolo']?></nobr></h5>
                            <p class="card-text no-br"><nobr>Author: <?=$book['autore']?></nobr></p>
                            <p class="card-text no-br"><nobr>Year: <?=$book['anno_pubblicazione']?></nobr></p>
                            <p class="card-text no-br"><nobr>Genre: <?=$book['genere']?></nobr></p>
                            <a href="logic/controller.php?action=delete&id=<?= $book['id'] ?>" class=" my-1" role="button"><i class="bi bi-trash"></i></a>
                            <a href="update.php?action=update&id=<?= $book['id'] ?>" class=" my-1"><i class="bi bi-pencil"></i></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </table>
            <?php } ?>
        </div>
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