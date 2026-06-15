<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error']['login'] = 'Debe iniciar sesión para acceder al sistema.';
    header('Location: ../user/login/');
    exit();
}

$baseUrl = '/Mantenedor-Categorias/';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Categorías</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include __DIR__ . '/components/navbar.php'; ?>

<div class="container-main">

    <div class="card-main">
        <h2>Dashboard</h2>

        <p>
            Bienvenida/o, 
            <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>.
        </p>

        <p>
            Este sistema corresponde al mantenedor individual de 
            <strong>categorías</strong>.
        </p>

        <a class="btn-primary-main" href="categorias/">
            Ir al mantenedor de categorías
        </a>
    </div>

    <br>

    <?php include __DIR__ . '/components/aside.php'; ?>

</div>

<?php include __DIR__ . '/components/footer.php'; ?>

</body>
</html>