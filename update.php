<?php include_once 'header.php' ?>
<?php include_once 'navbar.php' ?>
<?php require_once 'config.php' ?>
<?php require_once 'functions.php' ?>

<?php
    session_start();
    if(!isset($_SESSION['userLogin'])){
        exit(header('Location: login.php'));
    }

    $sql = 'SELECT libri.*, generi_letterari.nome as genere FROM libri INNER JOIN generi_letterari ON libri.genere_id = generi_letterari.id  WHERE libri.id=' . $_REQUEST['id'];
   
    $response = $mysqli->query($sql);
    if($response){
        $result = $response->fetch_assoc();
    }
?>

<h1 class="my-3 mx-5">Modifica Libro</h1>

<div class="container p-3 ">
    <form action="controller.php?action=update&id=<?=$result['id']?>" method="POST" class="">
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
            <select name='genere' id="" class="form-control">
                    <option value=<?=$result['genere_id']?>><?=$result['genere']?></option>
                    <?php
                        $generi = getGenres($mysqli);
                        if($generi){
                            foreach($generi as $key => $genere){
                                if($genere['nome']!==$result['genere']){
                                    echo "<option value='{$genere['id']}'>{$genere['nome']}</option>";
                                }
                            }
                        }
                    ?>
                </select>
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn green-bg w-50">Modifica</button>
        </div>
    </form>
</div>




<?php include_once 'footer.php' ?>
