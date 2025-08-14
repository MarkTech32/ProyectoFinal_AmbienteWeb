<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "AmbWeb", 3306);
if ($mysqli->connect_error) {
	die("Error de conexión: " . $mysqli->connect_error);
}




// Recibir datos del formulario
$id_tutoria = $_POST['id_tutoria'] ?? null;
$fecha_solicitada = $_POST['fecha_solicitada'] ?? null;
$hora_solicitada = $_POST['hora_solicitada'] ?? null;
$mensaje = $_POST['mensaje'] ?? '';
$estado = 'pendiente';
$fecha_solicitud = date('Y-m-d');




// Obtener el id del usuario desde la sesion
if (isset($_SESSION['usuario_id'])) {
	$id_solicitante = $_SESSION['usuario_id'];
} else {
	echo "No has iniciado sesión.";
	exit;
}

if ($id_tutoria && $id_solicitante && $fecha_solicitada && $hora_solicitada) {
	$sql = "INSERT INTO solicitudes_tutorias (id_tutoria, id_solicitante, fecha_solicitada, hora_solicitada, mensaje, estado, fecha_solicitud) VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("iisssss", $id_tutoria, $id_solicitante, $fecha_solicitada, $hora_solicitada, $mensaje, $estado, $fecha_solicitud);
	if ($stmt->execute()) {
		echo "Reserva guardada correctamente.";
	} else {
		echo "Error al guardar la reserva: " . $stmt->error;
	}
	$stmt->close();
} else {
	echo "Faltan datos para la reserva.";
}
$mysqli->close();
?>

