<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../../backoffice/');
    exit();
}

$mensajeError = '';

if (isset($_SESSION['error']['login'])) {
    $mensajeError = $_SESSION['error']['login'];
    unset($_SESSION['error']['login']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Categorías</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body class="login-page">

    <div class="login-card">

        <div class="login-header">
            <h1>Categorías</h1>
            <p>Mantenedor Individual</p>
        </div>

        <div class="login-content">

            <h2>Iniciar sesión</h2>
            <p class="subtitle">Ingrese sus credenciales para acceder al sistema.</p>

            <?php if ($mensajeError !== ''): ?>
                <div class="alert">
                    <?php echo htmlspecialchars($mensajeError); ?>
                </div>
            <?php endif; ?>

            <form action="../auth/" method="POST">

                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input 
                        type="text" 
                        name="usuario" 
                        id="usuario" 
                        placeholder="Ingrese su usuario"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Ingrese su contraseña"
                        required
                    >
                </div>

                <button type="submit" class="btn-login">
                    Ingresar
                </button>

            </form>

        </div>

    </div>

</body>
</html>