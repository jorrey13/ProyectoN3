<?php
include('./../config/conexion.php');

$mensajeOK='Bienvenido a la base de datos';
$mensajeERROR='El sistema no se encuentra disponible';

    if(isset($_POST['correo'], $_POST['contrasena'])):
        echo "Entro";
        if($_POST['correo']!=""):
            echo "Usuario Valido";
            if($_POST['contrasena']!=""):
                echo "Clave Valida";
                $usua=$_POST['correo'];
                $pass=$_POST['contrasena'];

                $consulta=mysqli_query($mysqli,"SELECT * FROM `usuarios` WHERE `email` = '$usua' AND `contrasena` = SHA1('$pass');");

                if(mysqli_num_rows($consulta)>0):
                    session_start();
                    $mensajeOK=true;
                    $datos=mysqli_fetch_array($consulta);
                    $_SESSION['id']=$datos[0];
                    $_SESSION['email']=$datos[1];
                    $_SESSION['contrasena']=$datos[2];
                    $_SESSION['photo']=$datos[3];
                    $_SESSION['name']=$datos[4];
                    $_SESSION['bio']=$datos[5];
                    $_SESSION['phone']=$datos[6];
                    $mensajeERROR='Logueado Correctamente';

                    print "<script>alert(\"Logueado correctamente.\");window.location='./views/dashboard.php';</script>";
                    include "cerrar_con.php";
                else:
                    $mensajeERROR='Usuario o Contraseña incorrecta o usuario no existe.';
                    print "<script>alert(\"Usuario o Contraseña incorrecta.\");window.location='./../views/login.php';</script>";
                endif;
            else:
                echo'esta aqui';
                $mensajeERROR='Contraseña incorrecta';
                print "<script>alert(\"Usuario o Contraseña incorrecta.\");window.location='./../views/login.php';</script>";
            endif;
        else:
            $mensajeERROR='Nombre de Usuario no existe';
            print "<script>alert(\"Usuario o Contraseña incorrecta.\");window.location='./../views/login.php';</script>";
        endif;
    else:
        $mensajeERROR='Todos los campos son requeridos';
        print "<script>alert(\"Todos los campos son requeridos.\");window.location='./../views/login.php;</script>";
    endif;
    $salidaJason=array('respuesta'=> $mensajeOK, 'mensaje'=>$mensajeERROR);
?>