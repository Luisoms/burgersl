<!DOCTYPE html>
<html lang="es">
<?php
include("conexion/conectar.php");
error_reporting(0);
session_start();

?>

<head>
    <!-- PRINCIPALES -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Burgers like</title>
    <link href="scss/principal.css" rel="stylesheet">
</head>

<body>

    <div class="dialibre">
        <div class="targeta">
            <span class="alerta" data-text="OPPS!">OPPS!</span>
            <span class="titulo">Lo sentimos es dia libre</span>
            <span class="parrafo">Horario de servicio:<br><strong>Jueves - Domingo 8am a 6pm</strong></span>
        </div>
    </div>

</body>

</html>