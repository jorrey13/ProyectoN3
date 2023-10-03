<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");

    $id_maestro = $_POST["id_alumno"];

    $query = "DELETE FROM usuarios WHERE id_user = ?";
    
    $stmt = $mysqli->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("i", $id_maestro);
        if ($stmt->execute()) {
            echo "Maestro eliminado exitosamente.";
            echo "Eliminado correctamete";
            $_SESSION["dato_borrado"] = true;
            header("Location: ./../../design/admin/alumnos.php");
        } else {
            echo "Error al eliminar el maestro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la sentencia: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    header("Location: ./../../design/admin/alumnos.php");
}
?>

