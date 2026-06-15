<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error']['login'] = 'Debe iniciar sesión para acceder al sistema.';
    header('Location: ../../user/login/');
    exit();
}

$baseUrl = '/Mantenedor-Categorias/';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mantenedor de Categorías</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<?php include __DIR__ . '/../components/navbar.php'; ?>

<div class="container-main">

    <div class="categorias-top">
        <h2>Mantenedor de Categorías</h2>

        <a class="btn-volver" href="../dashboard.php">
            Volver al dashboard
        </a>
    </div>

    <div id="mensaje-sistema" class="mensaje-sistema"></div>

    <div class="categorias-grid">

        <div class="categorias-card">
            <h3>Agregar categoría</h3>

            <form id="form-categoria">

                <div class="form-group">
                    <label for="nombre">Nombre de la categoría</label>

                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        placeholder="Ej: Productos especiales"
                        required
                    >
                </div>

                <button type="submit" class="btn-guardar">
                    Guardar categoría
                </button>

            </form>
        </div>

        <div class="categorias-card">
            <h3>Listado de categorías</h3>

            <table class="table-categorias">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody id="tabla-categorias">
                    <tr>
                        <td colspan="4">Cargando registros...</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>

<?php include __DIR__ . '/../components/footer.php'; ?>

<script>
    const BASE_URL = "<?php echo $baseUrl; ?>";
</script>

<script src="<?php echo $baseUrl; ?>assets/js/categorias.js"></script>

</body>
</html>