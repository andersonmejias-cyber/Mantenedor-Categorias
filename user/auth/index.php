<?php

session_start();

require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error']['login'] = 'Acceso no permitido.';
    header('Location: ../login/');
    exit();
}

$usuario = trim($_POST['usuario'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($usuario === '' || $password === '') {
    $_SESSION['error']['login'] = 'Debe completar todos los campos.';
    header('Location: ../login/');
    exit();
}

try {
    $stmt = $pdo->prepare('SELECT * FROM usuarios_sistema WHERE usuario = ? LIMIT 1');
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error']['login'] = 'Usuario o contraseña incorrectos.';
        header('Location: ../login/');
        exit();
    }

    if (!password_verify($password, $user['password'])) {
        $_SESSION['error']['login'] = 'Usuario o contraseña incorrectos.';
        header('Location: ../login/');
        exit();
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['usuario'] = $user['usuario'];

    unset($_SESSION['error']['login']);

    header('Location: ../../backoffice/');
    exit();

} catch (Exception $e) {
    $_SESSION['error']['login'] = 'Error interno del sistema.';
    header('Location: ../login/');
    exit();
}