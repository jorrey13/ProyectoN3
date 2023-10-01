<?php
echo "Estás aquí";
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el ID de la clase a eliminar y el ID del alumno
    $id_materia = $_POST["id_materia"];
    $id_alumno = $_SESSION["user_data"]["id_user"];

    // Realizar la consulta SQL para eliminar la clase del alumno
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");
    $deleteQuery = "DELETE FROM registroalumnos WHERE id_alumno = $id_alumno AND id_am = $id_materia";
    $deleteResult = $mysqli->query($deleteQuery);

    if ($deleteResult) {
        // Redireccionar a una vista actualizada
        header("Location: ./../design/alumno/dashboard_alumno_view.php");
        exit();
    } else {
        // Manejar un error si la eliminación falla
        echo "Error al eliminar la clase.";
    }
}
?>
