<?php
header('Content-Type: application/json');

$conexion = new mysqli('localhost', 'root', '', 'AmbWeb');
if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}

$keyword = isset($_GET['keyword']) ? $conexion->real_escape_string($_GET['keyword']) : '';
$keywordSQL = "%$keyword%";

if ($keyword !== '') {
  
    $sql = "SELECT 
            s.titulo,
            s.descripcion,
            s.precio_por_hora,
            s.modalidad,
            s.fecha_creacion,
            ts.nombre AS tipo_nombre,
            c.nombre AS categoria_nombre
        FROM servicios s
        JOIN tipos_servicio ts ON s.id_tipo = ts.id
        JOIN categorias c ON s.id_categoria = c.id
        WHERE s.id_tipo = 2 
          AND (s.titulo LIKE ? OR s.descripcion LIKE ?)
        ORDER BY s.fecha_creacion DESC";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ss', $keywordSQL, $keywordSQL);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
   
    $sql = "SELECT 
              s.titulo,
              s.descripcion,
              s.precio_por_hora,
              s.modalidad,
              s.fecha_creacion,
              ts.nombre AS tipo_nombre,
              c.nombre AS categoria_nombre
            FROM servicios s
            JOIN tipos_servicio ts ON s.id_tipo = ts.id
            JOIN categorias c ON s.id_categoria = c.id
            WHERE s.id_tipo = 2
            ORDER BY s.fecha_creacion DESC
            LIMIT 6";
    $resultado = $conexion->query($sql);
}

if (!$resultado) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en consulta']);
    exit;
}

$tutorias = [];
while ($fila = $resultado->fetch_assoc()) {
    $tutorias[] = $fila;
}

echo json_encode($tutorias);
