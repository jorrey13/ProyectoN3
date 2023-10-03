<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $dni = $_POST["dni"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $direccion = $_POST["direccion"]; 
        $hash = password_hash($password, PASSWORD_DEFAULT);

        require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");

        try {
            $result = $mysqli->query("INSERT INTO usuarios ( dni, email, contrasena, nombre, apellido, fecha_nacimiento, direccion, rol_id, estado) VALUES ('$dni', '$email', '$hash', '$nombre', '$apellido', '$fecha_nacimiento', '$direccion','2', '1')");
            if ($result) {
                $data = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'");
                $data = $data->fetch_assoc();
                session_start();
                $_SESSION["U_CREADO"] = TRUE;
                header("Location: ./../../design/admin/alumnos.php");
            }else {
                echo "Error al registrar un usuario";
            }
        } catch (mysqli_sql_exception $e) {
            if ($mysqli->errno === 1062) {
                session_start();
                $_SESSION["duplicado"] = TRUE;
                header("Location: ./../../design/admin/alumnos.php");
            }else{
                echo "Error" . $e->getMessage();
            };
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <a href=""></a>
    </body>
    </html>