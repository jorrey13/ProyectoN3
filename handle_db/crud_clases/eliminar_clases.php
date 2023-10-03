<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");

    $id_clase = $_POST["id_clase"];

    $query = "DELETE FROM `materias` WHERE id_materia = ?";
    
    $stmt = $mysqli->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("i", $id_clase);
        if ($stmt->execute()) {
            echo "Maestro eliminado exitosamente.";
            echo "Eliminado correctamete";
            $_SESSION["dato_borrado"] = true;
            header("Location: ./../../design/admin/materias.php");
        } else {
            echo "Error al eliminar el maestro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la sentencia: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    header("Location: ./../../design/admin/materias.php");
}
?>

