<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // $document = $_SERVER["DOCUMENT_ROOT"];
    // echo "$document";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");
    // Obtener el hash de la contraseña desde la base de datos
    
    $stmnt = $mysqli->query("SELECT * FROM usuarios WHERE email = '$correo'");
    // while($row = $stmnt->fetch_assoc()){

    // };

    if ($stmnt->num_rows === 1) {
        $result = $stmnt->fetch_assoc();
        $contrasena_hash = $result["contrasena"];

        // Verificar la contraseña utilizando password_verify
        if (password_verify($contrasena, $contrasena_hash)) {
            if ($result["rol_id"]==="1") {
                session_start();
                $_SESSION["user_data"] = $result;
                // var_dump($_SESSION["user_data"]);
                if ($_SESSION["user_data"]["estado"] === '1') {
                    header("Location: ./../design/admin/dashboard_admin.php");
                }else {
                    $_SESSION["usuario_bloqueado"] = TRUE;
                    header("Location: /index.php?usuario_inactivo");
                }
            }elseif ($result["rol_id"]==="2") {
                session_start();
                $_SESSION["user_data"] = $result;
                // var_dump($_SESSION["user_data"]);
                if ($_SESSION["user_data"]["estado"] === '1') {
                    header("Location: ./../design/maestro/dashboard_maestro.php");
                }else {
                    $_SESSION["usuario_bloqueado"] = TRUE;
                    header("Location: /index.php?usuario_inactivo");
                }
            }elseif ($result["rol_id"]==="3") {
                session_start();
                $_SESSION["user_data"] = $result;
                // var_dump($_SESSION["user_data"]);
                if ($_SESSION["user_data"]["estado"] === '1') {
                    header("Location: ./../design/alumno/dashboard_alumno.php");
                }else {
                    $_SESSION["usuario_bloqueado"] = TRUE;
                    header("Location: /index.php?usuario_inactivo");
                }
            }
        } else {
            session_start();
            $_SESSION["usuario_mal"] = TRUE;
            header("Location: /index.php?error=incorrect_password");
        }
    } else {
        session_start();
        $_SESSION["usuario_mal"] = TRUE;
        header("Location: /index.php?error=incorrect_password");
    }
}
?>
