<?php
require_once __DIR__ . '/../../config/db.php';

class Servicio {
    public static function guardar($id_usuario, $id_categoria, $titulo, $descripcion, $precio_por_hora, $modalidad, $id_tipo): bool {
        global $conn;

        try {
            $sql = "INSERT INTO servicios (id_usuario, id_categoria, titulo, descripcion, precio_por_hora, modalidad, id_tipo)
                    VALUES ('$id_usuario', '$id_categoria', '$titulo', '$descripcion', '$precio_por_hora', '$modalidad','$id_tipo')";
            return $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }
}
