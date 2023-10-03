    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $correo = $_POST["email"];
        $password = $_POST["password"];
        $nombre = $_POST["nombre"];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        require_once($_SERVER["DOCUMENT_ROOT"] . "/Proyecto_Final/config/database.php");

        try {
            $result = $mysqli->query("INSERT INTO usuarios (nombre, email, contrasena, rol_id, estado) VALUES ('$nombre', '$correo', '$hash', '1', '1')");
            if ($result) {
                $data = $mysqli->query("SELECT * FROM usuarios WHERE email = '$correo'");
                $data = $data->fetch_assoc();
                session_start();
                $_SESSION["user_data"] = $data;

                header("Location: /index.php");
            }else {
                echo "Error al registrar un usuario";
            }
        } catch (mysqli_sql_exception $e) {
            if ($mysqli->errno === 1062) {
                session_start();
                $_SESSION["duplicado"] = TRUE;
                header("Location: ./../public/pages/create-account.php");
            }else{
                echo "Error" . $e->getMessage();
            };
        }
    }

    ?>