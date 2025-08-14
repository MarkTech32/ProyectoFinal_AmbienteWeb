<?php


// Conexion a la base de datos
$conn = new mysqli("localhost", "root", "", "AmbWeb");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


if (isset($_GET['page']) && $_GET['page'] === 'Search' && !empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];


    $keyword = trim($keyword);
    $searchTerm = "%{$keyword}%";

    $sql = "SELECT * FROM servicios WHERE id_tipo = 2 AND (titulo LIKE ? OR descripcion LIKE ?) AND estado = 'activo'";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h2>Resultados para: " . htmlspecialchars($keyword) . "</h2>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='tutoria-card'>";
            echo "<h3>" . htmlspecialchars($row['titulo']) . "</h3>";
            echo "<p>" . nl2br(htmlspecialchars($row['descripcion'])) . "</p>";
            echo "<p><strong>Precio por hora:</strong> $" . number_format($row['precio_por_hora'], 2) . "</p>";
            echo "<p><strong>Modalidad:</strong> " . htmlspecialchars($row['modalidad']) . "</p>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>No se encontraron tutorias que coincidan con la búsqueda.</p>";
    }

    $stmt->close();
}

$conn->close();
?>
