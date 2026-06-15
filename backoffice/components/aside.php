<?php
if (!isset($baseUrl)) {
    $baseUrl = '/Mantenedor-Categorias/';
}
?>

<div class="card-main">
    <h3>Menú</h3>

    <p>
        <a class="btn-primary-main" href="<?php echo $baseUrl; ?>backoffice/dashboard.php">
            Dashboard
        </a>
    </p>

    <p>
        <a class="btn-primary-main" href="<?php echo $baseUrl; ?>backoffice/categorias/">
            Mantenedor de categorías
        </a>
    </p>
</div>