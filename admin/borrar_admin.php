<?php
include("../conexion/conectar.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM admin WHERE adm_id = '".$_GET['admin_del']."'");
header("location:t_admin.php");  

?>
