<?php

$config = [
    'mysqli_host' => 'localhost',
    'mysqli_user' => 'root',
    'mysqli_password' => ''
];

$mysqli = new mysqli($config['mysqli_host'], $config['mysqli_user'], $config['mysqli_password']);

$sql = 'USE gestione_libreria';
$mysqli->query($sql);