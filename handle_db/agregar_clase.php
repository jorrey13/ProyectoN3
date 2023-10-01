<?php
echo "Estás aquí";
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los valores de POST
    $id_alumno = $_SESSION["user_data"]["id_user"];
    $id_materia = $_POST["id_materia"];

    // Validar y asegurarse de que los valores no estén vacíos o sean inválidos

    // Realizar la inserción en la tabla registroalumnos
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");

    // Verificar si ya existe una asociación similar en la tabla
    $consulta_existencia = "SELECT COUNT(*) as count FROM registroalumnos WHERE id_alumno = $id_alumno AND id_alumate = $id_materia";
    $resultado_existencia = $mysqli->query($consulta_existencia);
    $row_existencia = $resultado_existencia->fetch_assoc();

    if ($row_existencia["count"] == 0) {
        // Si no existe una asociación similar, insertar el nuevo registro
        $consulta_insertar = "INSERT INTO registroalumnos (id_alumno, id_alumate) VALUES ($id_alumno, $id_materia)";
        if ($mysqli->query($consulta_insertar)) {
            // La inserción fue exitosa
            header("Location: ./../design/alumno/dashboard_alumno_view.php");
            exit();
        } else {
            // La inserción falló, manejar el error apropiadamente
            echo "Error al insertar el registro: " . $mysqli->error;
        }
    } else {
        // Ya existe una asociación similar, manejar esto según tus necesidades
        echo "Ya existe una asociación entre este alumno y esta materia.";
    }
}
?>
