<?php
echo "Estas aqui";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/conexion.php");
    $email = $_POST["email"];
    // echo "$email";
    // var_dump($_FILES);
    $type = $_FILES["image"]["type"];
    $tmp_location = $_FILES["image"]["tmp_name"];
    $fn_location_db = "/public/img/" . $_FILES["image"]["name"];
    $fn_location = $_SERVER["DOCUMENT_ROOT"] . $fn_location_db;
    echo "<br>" . "$type";
    echo "<br>" . "$tmp_location";
    echo "<br>" . "$fn_location_db";
    echo "<br>" . "$fn_location";
  

    if (move_uploaded_file($tmp_location, $fn_location)) {
        echo "Aqui estoy entrando a update";
        $mysqli->query("UPDATE usuarios SET url_imagen ='$fn_location_db' WHERE email = '$email'");
       
        if ($mysqli) {
            
            echo "Guardado con exito";
            header("Location: /views/dashboard.php");
        } else {
            header("Location: /views/login.php");
        }
    }
}

