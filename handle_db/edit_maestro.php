<?php
echo "Estás aquí";
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");
    $email = $_POST["email"];
    $password = $_POST["password"];
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $direccion = $_POST["direccion"];
    $id = $_SESSION["user_data"]["id_user"];

    try {
        $email !== "" && $mysqli->query("UPDATE usuarios SET email = '$email' where id_user = '$id'");
        if ($password !== "") {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $mysqli->query("UPDATE usuarios SET contrasena = '$hash' where id_user = '$id'");
        }
        $dni !== "" && $mysqli->query("UPDATE usuarios SET dni = '$dni' where id_user = '$id'");
        $nombre !== "" && $mysqli->query("UPDATE usuarios SET nombre = '$nombre' where id_user = '$id'");
        $apellido !== "" && $mysqli->query("UPDATE usuarios SET apellido = '$apellido' where id_user = '$id'"); 
        $fecha_nacimiento !== "" && $mysqli->query("UPDATE usuarios SET fecha_nacimiento = '$fecha_nacimiento' where id_user = '$id'");
        $direccion !== "" && $mysqli->query("UPDATE usuarios SET direccion = '$direccion' where id_user = '$id'");

        $query = $mysqli->query("SELECT * FROM usuarios WHERE id_user = '$id'");
        $_SESSION["user_data"] = $query->fetch_assoc();
        echo "Actualización exitosa";
        $_SESSION["dato_actualizado"] = true;
        header("Location: ./../design/maestro/dashboard_maestro.php");
    } catch (mysqli_sql_exception $e) {
        echo "Error al actualizar" . $e->getMessage();
    }
}else {
    header("Location: ./../design/maestro/dashboard_maestro.php");
}
?>
