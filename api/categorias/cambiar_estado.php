<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'No autorizado. Debe iniciar sesión.'
    ]);

    exit();
}

require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);

    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido.'
    ]);

    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

$id = intval($input['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'ID inválido.'
    ]);

    exit();
}

try {
    $sqlBuscar = "SELECT id, activo 
                  FROM categorias 
                  WHERE id = :id 
                  LIMIT 1";

    $stmtBuscar = $pdo->prepare($sqlBuscar);
    $stmtBuscar->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtBuscar->execute();

    $categoria = $stmtBuscar->fetch(PDO::FETCH_ASSOC);

    if (!$categoria) {
        http_response_code(404);

        echo json_encode([
            'success' => false,
            'message' => 'Categoría no encontrada.'
        ]);

        exit();
    }

    $nuevoEstado = $categoria['activo'] == 1 ? 0 : 1;

    $sqlActualizar = "UPDATE categorias
                      SET activo = :activo
                      WHERE id = :id";

    $stmtActualizar = $pdo->prepare($sqlActualizar);
    $stmtActualizar->bindParam(':activo', $nuevoEstado, PDO::PARAM_INT);
    $stmtActualizar->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtActualizar->execute();

    echo json_encode([
        'success' => true,
        'message' => 'Estado actualizado correctamente.',
        'nuevo_estado' => $nuevoEstado
    ]);

} catch (Exception $e) {
    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Error al cambiar el estado de la categoría.',
        'error' => $e->getMessage()
    ]);
}