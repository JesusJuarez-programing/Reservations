<?php
session_start();
$SILLAS= $_GET["sillas"];
$SEPARADAS = explode (',', $SILLAS);
foreach ($SEPARADAS as $imprimir){
   echo $imprimir ."<br>"; 
}


$servidor = "localhost";
$usuario = "root";
$contra = "";
$bd = "graduacion";
$conexion = new mysqli($servidor, $usuario, $contra, $bd);
$conexion->set_charset("utf8");
if ($conexion->connect_error) {
    die("Conexion Fallida: " . $conexion->connect_error);
} else {
    $idUsuario = $_SESSION["ID"];
    echo $idUsuario ."<br>";
    foreach ($SEPARADAS as $VALOR){
        $sql_insert = "UPDATE  sillas SET  alumno_id = \"".$idUsuario."\" WHERE id = \"".$VALOR."\"" ;
        try {
           $sillas_insert = $conexion->query($sql_insert);
           echo("Tú Reservación se ha hecho correctamente :)");  
           header('Location: obtener.php'); 
        } catch (Exception $e) {
           echo("Error al hacer la reservación: " . $e);
        header('Location: error2.php');
        }
    }
    $conexion->close();
}

   