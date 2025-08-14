<?php
// API para obtener las categorias
header('Content-Type: application/json');


//Conexcion a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'AmbWeb');

if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}


//Consulta para obtener las categorias
$sql = "SELECT id, nombre FROM categorias";
$resultado = $conexion->query($sql);



// array para almacenar las categorias
$categorias = []; 



// Recorrer los resultados y agregarlos al array
while ($fila = $resultado->fetch_assoc()) {  
    $categorias[] = [
        'id' => $fila['id'],
        'nombre' => $fila['nombre']
    ];
}


echo json_encode($categorias);
