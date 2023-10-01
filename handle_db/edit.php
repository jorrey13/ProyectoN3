<?php
echo "Estás aquí";
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/conexion.php");
    $email = $_POST["email"];
    $nombre = $_POST["name"];
    $bio = $_POST["bio"];
    $phone = $_POST["phone"];
    $password = $_POST["contrasena"];
    $id = $_SESSION["user_data"]["id"];

    // Verificar si se subió una nueva imagen
    if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
        $type = $_FILES["image"]["type"];
        $tmp_location = $_FILES["image"]["tmp_name"];
        $fn_location_db = "/public/img/" . $_FILES["image"]["name"];
        $fn_location = $_SERVER["DOCUMENT_ROOT"] . $fn_location_db;
        move_uploaded_file($tmp_location, $fn_location);
    } else {
        // No se subió una nueva imagen, mantener la imagen actual en la base de datos
        $email = $_SESSION["user_data"]["email"];
        $stmnt = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'");
        while ($row = $stmnt->fetch_assoc()) {
            if (isset($row["url_imagen"])) {
                $fn_location_db = $row["url_imagen"];
            }
        }
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Actualizar todos los campos en la base de datos
    // $sql = "UPDATE usuarios SET nombre = '$nombre', bio = '$bio', phone = '$phone', email = '$email', contrasena = '$hash', url_imagen = '$fn_location_db' WHERE email = '$email'";

    $nombre !== "" && $mysqli->query("UPDATE usuarios SET nombre = '$nombre' where email = '$email'");
    $email !== "" && $mysqli->query("UPDATE usuarios SET email = '$email' where id = '$id'");
    $bio !== "" && $mysqli->query("UPDATE usuarios SET bio = '$bio' where email = '$email'");
    $phone !== "" && $mysqli->query("UPDATE usuarios SET phone = '$phone' where email = '$email'");
    if ($password !== "") {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $mysqli->query("UPDATE usuarios SET contrasena = '$hash' where email = '$email'");
    }

    $query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'");
    $_SESSION["user_data"] = $query->fetch_assoc();
    echo "Actualización exitosa";
    $_SESSION["dato_actualizado"] = true;
    header("Location: /views/dashboard.php");

}
?>
