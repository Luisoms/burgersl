<?php 
    include("conexion/conectar.php");
    require_once 'codificador.php';
    
    foreach($_SESSION["cart_item"] as $item)
    {
        $precio_total += ($item["precio"] * $item["cantidad"]);
        $cantidad_total += $item["cantidad"];
        $id_total = $item["p_id"];

        $p_array[] = array('titulo'=>$item["titulo"], 'p_id'=>$item["p_id"], 'cantidad'=>$item["cantidad"]);
    }

    $array_codificado = UtilHelper::arrayEncode($p_array);
    
    if (isset($_POST['comprar'])) {
        $modalidad = $_POST['modalidad'];
        $nreferencia = $_POST['numreferencia'];

        $sql = "INSERT INTO ordenes(u_id,modalidad,numreferencia,p_id,carrito,precio) VALUE('" . $_SESSION["user_id"] . "','" . $modalidad . "','" . $nreferencia. "','" .$id_total ."','". $array_codificado . "','" . $precio_total . "')";
        mysqli_query($db, $sql);
    }
?>