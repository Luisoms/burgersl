<?php
include("../conexion/conectar.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM ordenes WHERE o_id = '".$_GET['orden_del']."'");
header("location:t_ordenes.php");  

?>
