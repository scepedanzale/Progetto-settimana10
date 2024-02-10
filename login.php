<?php include_once 'header.php' ?>
<?php include_once 'navbar.php' ?>

<?php

    session_start();
    if(isset($_SESSION['userLogin'])){
        exit(header('Location: index.php'));
    }
?>

<h1 class="my-3 mx-5">Login</h1>
    <div class="container p-3 text-center">
        <form action="controllerReg.php?action=login" method="POST" enctype="multipart/form-data" class="text-center">
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="email..." required>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="password..." required minlength="8">
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn w-50 green-bg">Accedi</button>
            </div>
        </form>
    </div>
<?php include_once 'footer.php' ?>