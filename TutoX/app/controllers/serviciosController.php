<?php

require_once __DIR__ . '/../models/servicios.php';

// Recibe datos del formulario
$id_usuario = $_POST['id_usuario'] ?? null;
$id_categoria = $_POST['id_categoria'] ?? null;
$titulo = $_POST['titulo'] ?? null;
$descripcion = $_POST['descripcion'] ?? '';
$precio_por_hora = $_POST['precio_por_hora'] ?? null;
$modalidad = $_POST['modalidad'] ?? null;
$id_tipo = $_POST['id_tipo'] ?? null;

// Validación de campos requeridos
$campos_faltantes = [];

if (empty($id_usuario)) $campos_faltantes[] = "ID de usuario";
if (empty($id_categoria)) $campos_faltantes[] = "Categoría";
if (empty($titulo)) $campos_faltantes[] = "Título";
if (empty($modalidad)) $campos_faltantes[] = "Modalidad";
if (empty($id_tipo)) $campos_faltantes[] = "Tipo de servicio";

if (!empty($campos_faltantes)) {
    echo "Completa los siguientes campos: " . implode(", ", $campos_faltantes);
    exit();
}

// Guardar servicio
$resultado = Servicio::guardar(
    $id_usuario,
    $id_categoria,
    $titulo,
    $descripcion,
    $precio_por_hora,
    $modalidad,
    $id_tipo
);

// Verificar resultado
if ($resultado) {
    header("Location: index.php?page=tutorias");
    exit();
} else {
    echo "Error al guardar el servicio.";
}
