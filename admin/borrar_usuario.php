<?php
include("../conexion/conectar.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM usuarios WHERE u_id = '".$_GET['usuario_del']."'");
header("location:t_usuarios.php");  

?>
