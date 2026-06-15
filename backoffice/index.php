<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error']['login'] = 'Debe iniciar sesión para acceder al sistema.';
    header('Location: ../user/login/');
    exit();
}

header('Location: dashboard.php');
exit();