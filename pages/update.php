<?php include_once 'header.php' ?>
<?php include_once 'navbar.php' ?>
<?php require_once '../logic/config.php' ?>

<?php

    $sql = 'SELECT * FROM libri WHERE id=' . $_REQUEST['id'];
   
    $response = $mysqli->query($sql);
    if($response){
        $result = $response->fetch_assoc();
    }
?>

<h1 class="my-3 mx-5">Modifica Libro</h1>

<div class="container p-3 ">
    <form action="../logic/controller.php?action=update&id=<?=$result['id']?>" method="POST" class="">
        <div class="input-group mb-3">
            <div class="input-group-text">Titolo</div>
            <input type="text" id="titolo" value=<?=$result['titolo']?> name="titolo" class="form-control" placeholder="titolo..." required minlength="1">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-text">Autore</div>
            <input type="text" value=<?=$result['autore']?> name="autore" class="form-control" placeholder="autore..." required minlength="2">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-text">Anno di Pubblicazione</div>
            <input type="number" value=<?=$result['anno_pubblicazione']?> name="anno_pubb" class="form-control" placeholder="anno di pubblicazione..." required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-text">Genere</div>
            <input type="text" value=<?=$result['genere']?> name="genere" class="form-control" placeholder="genere..." required>
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn green-bg w-50">Modifica</button>
        </div>
    </form>
</div>



<?php include_once 'footer.php' ?>
