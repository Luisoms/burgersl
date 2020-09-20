<?php
include("../conexion/conectar.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM productos WHERE p_id = '".$_GET['pro_del']."'");
header("location:t_productos.php");  

?>
