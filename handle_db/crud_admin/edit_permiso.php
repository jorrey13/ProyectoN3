<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");
    $user_id = $_POST["usuario_id"];
    $email = $_POST["email"];
    $rol = $_POST["rol"];
    $estado = $_POST["estado"];

    try {
        $mysqli->query("UPDATE usuarios SET email = '$email', rol_id = '$rol', estado = '$estado' WHERE id_user = '$user_id'");
        
        echo "Actualización exitosa";
        $_SESSION["dato_actualizado"] = true;
        header("Location: ./../../design/admin/permisos.php");
    } catch (mysqli_sql_exception $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }
} else {
    header("Location: ./../../design/admin/alumnos.php");
}
?>
