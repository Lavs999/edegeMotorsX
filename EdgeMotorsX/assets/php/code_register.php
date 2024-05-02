<?php
//INCLUIR ARCHIVO DE CONEXION A LA BASE DE DATOS 
require_once "conexion.php";

//DEFINIR VARIABLE E INICIALIZAR CON VALORES VACIOS 

$username = $email = $password = "";
$username_err = $email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(empty (trim($_POST["username"]))) {
$username_err = "Por favor, ingrese un nombre de usuario";

    }else{

        //PREPARA UNA DECLARACION DE LA SELECCION
        $sql = "SELECT id FROM usuarios WHERE nombre =  ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1 ){
                    $username_err = "Este nombre de usuario ya esta en uso";
                }else{
                    $username = trim($_POST ["username"]);
                } 
            }else{
                echo "Ups! Algo salio maal, intentalo mas atrde";
            }

        }

    }
}

?>