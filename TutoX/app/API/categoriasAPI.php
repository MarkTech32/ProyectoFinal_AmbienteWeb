<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'AmbWeb');

if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}

$sql = "SELECT id, nombre FROM categorias";
$resultado = $conexion->query($sql);

$categorias = [];

while ($fila = $resultado->fetch_assoc()) {
    $categorias[] = [
        'id' => $fila['id'],
        'nombre' => $fila['nombre']
    ];
}

echo json_encode($categorias);
