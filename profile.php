<?php include_once 'header.php' ?>
<?php include_once 'navbar.php' ?>
<?php include_once 'config.php' ?>
<?php include_once 'functions.php' ?>

<?php
    session_start();
    if(!isset($_SESSION['userLogin'])){
        exit(header('Location: index.php'));
    }
    $loggedUser = $_SESSION['userLogin'];
?>


<div class="container-fluid my-3">
    <div class="row">
        <div class="col-12 my-3 d-flex align-items-start justify-content-between">
            <h1><?=$loggedUser['nome'].' '.$loggedUser['cognome'] ?></h1>

            <div class="dropdown">
                <i class="bi bi-gear" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                
                <ul class="dropdown-menu">
                    <li type="button" class="soft-violet-bg rounded-0 btn w-100" data-bs-toggle="modal" data-bs-target="#logoutModal"><!-- logout -->
                        Logout
                    </li>
                    <li type="button" class="soft-violet-bg rounded-0 btn w-100" data-bs-toggle="modal" data-bs-target="#deleteUserModal"><!-- elimina profilo -->
                        Elimina profilo
                    </li>
                </ul>
            </div>
            <!-- modale logout -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Vuoi disconnetterti?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <a href="controllerReg.php?action=logout" type="button" class="btn green-bg w-25 me-2">si</a>
                            <a type="button" class="btn violet-bg w-25" data-bs-dismiss="modal">no</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modale elimina profilo -->
            <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Vuoi eliminare il tuo profilo?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <a href="controllerReg.php?action=deleteUser&id=<?=$loggedUser['id']?>&img=<?=$loggedUser['img']?>" type="button" class="btn green-bg w-25 me-2">si</a>
                            <a type="button" class="btn violet-bg w-25" data-bs-dismiss="modal">no</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row  px-3">
        <div class="col-12 d-flex align-items-center justify-content-center soft-green-bg rounded-3 py-2">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-4 col-md-2">
                    <!-- modifica immagine -->
                    <button type="button" class="btn violet-bg my-3 w-100" data-bs-toggle="modal" data-bs-target="#userUpdateImg">
                        <img src=<?=$loggedUser['img']?> alt="" class="w-100">
                    </button>

                    <div class="modal fade" id="userUpdateImg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cambia immagine profilo</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="controllerReg.php?action=updateUserImg&id=<?=$loggedUser['id']?>&userName=<?=$loggedUser['nome']?>&userSurname=<?=$loggedUser['cognome']?>&userImg=<?=$loggedUser['img']?>" method="POST" enctype="multipart/form-data" >
                                        <div class="input-group">
                                            <input type="file" title="Scegli un'immgaine profilo" accept = "image/png, image/jpg, image/jpeg" name="image" class="form-control" required>
                                            <button type="submit" class="btn green-bg">Salva</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-md-4 px-2">
                    <p><?=$loggedUser['nome']?></p>
                    <p><?=$loggedUser['cognome']?></p>
                    <p><b>Tel:</b> <?=$loggedUser['telefono']?></p>
                    <p><b>Email:</b> <?=$loggedUser['email']?></p>
                </div>
                <div class="col-12 col-md-6 text-center">
                    <!-- modifica dati personali -->
                    <div>
                        <button class="btn violet-bg my-2 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFormUpdateUser" aria-expanded="false" aria-controls="collapseExample">
                            <span class>Modifica i tuoi dati</span>
                        </button>
                        <div class="collapse" id="collapseFormUpdateUser">
                            <form action="controllerReg.php?action=updateUserData&id=<?=$loggedUser['id']?>&userName=<?=$loggedUser['nome']?>&userSurname=<?=$loggedUser['cognome']?>&userImg=<?=$loggedUser['img']?>" method="POST" class="">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">Nome</div>
                                    <input type="text" id="nome" value='<?=$loggedUser['nome']?>' name="nome" class="form-control" placeholder="nome..." required minlength="2">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-text">Cognome</div>
                                    <input type="text" value='<?=$loggedUser['cognome']?>' name="cognome" class="form-control" placeholder="cognome..." required minlength="2">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-text">Telefono</div>
                                    <input type="tel" value='<?=$loggedUser['telefono']?>' name="telefono" class="form-control" placeholder="telefono..." required minlength="2">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-text">Email</div>
                                    <input type="email" value='<?=$loggedUser['email']?>' name="email" class="form-control" placeholder="email..." required minlength="2">
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn green-bg w-50">Salva</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- lista degli utenti -->
        <div class="col-12 my-5 p-0">
            <h3 class="text-center">Lista Utenti</h3>
            <table class="w-100 text-center">
                <thead>
                    <tr class="violet-bg">
                        <th scope="col"></th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Telefono</th>
                        <th scope="col" class="d-none d-md-block">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                     $users = getAllUsers($mysqli);
                    if($users){
                    foreach ($users as $key => $user) { 
                        if($user['id'] === $_SESSION['userLogin']['id']){?>
                            <tr class="soft-green-bg">
                                <td><img src=<?= $user['img'] ?> width="50" ></td>
                                <td><?= $user['nome'] ?></td>
                                <td><?= $user['cognome'] ?></td>
                                <td><?= $user['telefono'] ?></td>
                                <td class="d-none d-md-table-cell"><?= $user['email'] ?></td>
                            </tr>
                    <?php }else{ ?>
                        <tr class="bg-body-tertiary">
                            <td><img src=<?= $user['img'] ?> width="50" ></td>
                            <td><?= $user['nome'] ?></td>
                            <td><?= $user['cognome'] ?></td>
                            <td><?= $user['telefono'] ?></td>
                            <td class="d-none d-md-table-cell"><?= $user['email'] ?></td>
                        </tr>
                    <?php } }}?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
<?php include_once 'footer.php' ?>