<?php
$host = 'localhost';
$dbname = 'AmbWeb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<script>console.log('✅ Conexión a la base de datos exitosa');</script>";
    
} catch(PDOException $e) {
    
    echo "<script>console.log('❌ Error de conexión: " . $e->getMessage() . "');</script>";
    die("Error de conexión: " . $e->getMessage());
}
?>