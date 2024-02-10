<?php include_once 'header.php' ?>
<?php include_once 'navbar.php' ?>

<?php

    session_start();
    if(isset($_SESSION['userLogin'])){
        exit(header('Location: index.php'));
    }
?>

<h1 class="my-3 mx-5">Registrati</h1>
    <div class="container p-3 text-center">
        <form action="controllerReg.php?action=addUser" method="POST" enctype="multipart/form-data" class="text-center">
            <div class="input-group mb-3">
                <input type="text" name="nome" class="form-control" placeholder="nome..." required minlength="2">
            </div>
            <div class="input-group mb-3">
                <input type="text" name="cognome" class="form-control" placeholder="cognome..." required minlength="2">
            </div>
            <div class="input-group mb-3">
                <input type="tel" name="telefono" class="form-control" placeholder="telefono..." required minlength="2">
            </div>
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="email..." required>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="password..." required minlength="8">
            </div>
            <div class="input-group mb-3">
                <input type="file" title="Scegli un'immgaine profilo" accept = "image/png, image/jpg, image/jpeg" name="image" class="form-control" placeholder="image...">
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn w-50 green-bg">Registrati</button>
            </div>
        </form>
    </div>
<?php include_once 'footer.php' ?>