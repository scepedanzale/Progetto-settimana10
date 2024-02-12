<?php include_once 'header.php' ?>
<?php include_once 'navbar.php' ?>
<?php include_once 'config.php' ?>
<?php include_once 'functions.php' ?>

<?php
    session_start();
    if(!isset($_SESSION['userLogin'])){
        exit(header('Location: login.php'));
    }

    $genereSelezionato = genreDescription($mysqli, $_REQUEST['genereId']);
    $generi = getGenres($mysqli);
?>
<div class="container-fluid p-4">
    <h1><?=$genereSelezionato['nome']?></h1>
    <p><?=$genereSelezionato['descrizione']?></p>
</div>
<div class="container-fluid p-4">
    <h3><i>Altri generi letterari...</i></h3>
    <?php
        if($generi){
            foreach($generi as $key => $genere){
                if($genere['id'] !== $genereSelezionato['id']){?>
                    <p class="my-3"><b><?=$genere['nome']?>:</b>
                        <?=$genere['descrizione']?>
                    </p>
                <?php }
            }
        }
    ?>
</div>


<?php include_once 'footer.php' ?>