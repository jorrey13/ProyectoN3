<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");

    // Obtener los datos del formulario
    $clase = $_POST["clase"];
    $maestroId = $_POST["maestro"];

    try {
        // Insertar la nueva clase en la tabla de materias
        $queryInsertClase = "INSERT INTO materias (materia) VALUES (?)";
        $stmtInsertClase = $mysqli->prepare($queryInsertClase);
        $stmtInsertClase->bind_param("s", $clase);
        $stmtInsertClase->execute();

        // Obtener el ID de la clase recién insertada
        $claseId = $mysqli->insert_id;

        // Asignar el maestro a la clase en la tabla de asignacionmaestros
        $queryAsignarMaestro = "INSERT INTO asignacionmaestros (id_profemate, id_profesor) VALUES (?, ?)";
        $stmtAsignarMaestro = $mysqli->prepare($queryAsignarMaestro);
        $stmtAsignarMaestro->bind_param("ii", $claseId, $maestroId);
        $stmtAsignarMaestro->execute();

        echo "Clase creada y maestro asignado exitosamente.";
        $_SESSION["nueva_clase"] = true;
        header("Location: ./../../design/admin/materias.php");
    } catch (mysqli_sql_exception $e) {
        echo "Error al crear la clase: " . $e->getMessage();
    }
} else {
    header("Location: ./../../design/admin/materias.php");
}
?>
