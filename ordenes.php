<!DOCTYPE html>
<html lang="en">
<?php
include("conexion/conectar.php");
error_reporting(0);
session_start();

include_once 'ordenes-accion.php';
require_once 'codificador.php';

if (empty($_SESSION['user_id']))
{
    header('location:login.php');
} 
else 
{
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />

        <link href="scss/principal.css" rel="stylesheet">
        <script src="./js/tools/dialibre.js"></script>
    </head>


    <body>

        <div id="navbar" class="navbar">
        
            <a onclick="scrollTox(0);"><div class="logo" alt="Logo BurgersLike"></div></a>
            
            <div class="menu">
                <a class="link" href="index.php">Inicio</a>
                <a class="link" href="productos.php">Menú</a>
                <?php
                    if (empty($_SESSION["user_id"])) // Sí no ingreso el usuario
                    {
                    ?>
                        <a class="link stuno ingresarbtn" onclick="ingresarBtn();">Ingresar</a>
                        <a class="link stdos registrarbtn" onclick="registrarBtn()">Registrar</a>
                    <?php
                    } else //Sí ingreso el usuario
                    {
                        $usuario_id = $_SESSION['user_id'];
                        $resultado = mysqli_query($db, "select nombre from usuarios WHERE u_id='$usuario_id'");
                        $username = mysqli_fetch_array($resultado);
                    ?>
                        <a class="link" onclick="scrollTox(0);">Ordenes</a>
                        <a class="link sttres" href="logout.php">Salir</a>
                        <a class="link usuarioN"> <?php echo  $username['nombre']?> </a>
                    <?php
                    }
                ?>
            </div>
                
            <button class="btnhb" type="button">
                <span class="hamburguesa"></span>
                <span class="hamburguesa"></span>
                <span class="hamburguesa"></span>
            </button>
                
        </div>

        <div class="contenedor-ordenes">

            <section class="ordenes">

                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Estatus</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>

                    <tbody>
    
                        <?php
                            $query_res = mysqli_query($db, "SELECT * FROM ordenes WHERE ordenes.u_id=".$_SESSION['user_id']);
                            if (!mysqli_num_rows($query_res) > 0)
                            {
                                echo '<td colspan="6"><center>No hay ordenes.</center></td>';
                            } else {

                                while ($row = mysqli_fetch_array($query_res))
                                {
                                    $array_deco = UtilHelper::arrayDecode($row['carrito']);
                        ?>
                                    <tr>
                                        <td data-column="Producto">
                                            <?php
                                                foreach($array_deco as $producto){
                                                    echo '<p class="pnombre">', $producto['titulo'] ,'</p>';
                                                }
                                            ?>
                                        </td>

                                        <td data-column="Cantidad">
                                            <?php 
                                                foreach($array_deco as $producto){
                                                    echo '<p class="pcantidad">x ', $producto['cantidad'] ,'</p>';
                                                } 
                                            ?>
                                        </td>

                                        <td data-column="Precio">Bs <?php echo $row['precio']; ?></td>

                                        <td data-column="Estatus">
                                            <span class="estatus <?php echo $row['estatus']; ?>"><?php echo $row['estatus']; ?></span>
                                        </td>

                                        <td data-column="Fecha"> <?php echo $row['fecha']; ?></td>
                                    </tr>
                        <?php 
                                }
                            } 
                        ?>
                    </tbody>
                    
                </table>

            </section>

            <section class="piedep">
                <div class="direccion">
                    <!-- AGREGAR INFORMACION --><span class="titulo">Dirección: UD4 Calle Principal</span>
                    <!-- AGREGAR INFORMACION --><span class="titulo">Correo: burgerslike@correo.com</span>
                    <span class="titulo">Telefono: <a class="link" href="tel:02869315048">02869315048</a></span>
                </div>

                <div class="informacion">
                    <span class="titulo">Informacion Adicional</span>
                    <!-- AGREGAR INFORMACION -->
                    <p class="parrafo">Join the thousands of other restaurants who benefit from having their menus on TakeOff</p>
                </div>
            </section>

        </div>


    </body>

</html>
<?php
}
?>