<!DOCTYPE html>
<html lang="en">

<?php
include("conexion/conectar.php");

error_reporting(0);
session_start();

include_once 'producto-accion.php';
include_once 'ordenes-accion.php';

if (empty($_SESSION["user_id"])) {
    header('location:index.php');
} else {

?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="index.php">
        <title>Buergeslike</title>

        <link href="scss/principal.css" rel="stylesheet">
        <script src="./js/tools/dialibre.js"></script>
    </head>

    <body class="home">

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
                        <a class="link" href="ordenes.php">Ordenes</a>
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

        <div class="contenedor-c">

            <form class="formulario-chequear" method="post" action="">

                <?php
                    $rpreciot = number_format($precio_total,2,",",".");
                ?>
 
                <span class="tituloResumen">Resumen de Compra</span>
 
                <div class="resumen-grid">
                    <span class="tituloCS">Compra Subtotal</span>
                    <span class="itemTotal">Bs <?php echo $rpreciot; ?></span>
                        
                    <span class="envioMani">Envio y Manipulación</span>
                    <span class="envioGratis">Envio Gratis</span>
 
                    <span class="tituloTotal">Total</span>
                    <span class="precioTotal">Bs <?php echo $rpreciot; ?></span>
                    <div class="hr"></div>
                    <div class="modalidades-compra">
                        <span class="tituloM">Modalidades</span>

                        <div class="delivery">
                            <input class="radioD" name="modalidad" type="radio" value="delivery" required>
                            <span class="tituloD">Delivery</span>
                        </div>

                        <div class="pickup">
                            <input class="radioP" name="modalidad" type="radio" value="pickup" required>
                            <span class="tituloP">Pickup</span>
                        </div>
                        
                    </div>

                    <div class="infoBanco">
                        <div class="transferencia">
                            <span class="tituloBanco">Transferencia</span>
                            <span class="banco"><strong>Banco: </strong>Mercantil, cuenta Corriente</span>
                            <span class="numeroCuenta"><strong>Nº Cuenta: </strong>0105-0047-8810-4756-4254</span>
                            <span class="nombre"><strong>Nombre: </strong>Carlos Mendez</span>
                            <span class="cedula"><strong>Cédula: </strong>28.272.644</span>
                        </div>

                        <div class="pagoMobil">
                            <span class="tituloBanco">Pago Movil</span>
                            <span class="banco"><strong>Banco: </strong>Mercantil - 0105</span>
                            <span class="cedula"><strong>Cédula: </strong>28.272.644</span>
                            <span class="telefono"><strong>Número: </strong>0414-1985035</span>
                        </div>
                    </div>
 
                    <div class="input">
                        <input class="numreferencia" type="number" autocomplete="off" name="numreferencia" required>
                        <label class="label" for="numreferencia">
                            <span class="texto">Nº de Referencia Bancaria</span>
                        </label>
                    </div>
                    <i class="verificacionR">Verifique el Nº de referencia antes de finalizar la compra</i>
                </div>
                
                <button class="comprarBtn" type="submit" onclick="return confirm('¿Estás Seguro?');" name="comprar">Finalizar Compra</button>
 
            </form>

            <section class="piedep">
                <div class="direccion">
                    <span class="titulo"><strong>Dirección:</strong> Urb. Guaiparo, Av. Centurion</span>
                    <span class="titulo"><strong>Correo:</strong> burgerslikeca@gmail.com</span>
                    <span class="titulo"><strong>Telefono:</strong> <a class="link" href="tel:02869315048">02869315048</a></span>
                    
                    <div class="redesSociales">
                        <div class="btnredes">

                            <div class="fac">
                                <a href="https://www.facebook.com/burgerslike/">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span class="fa fa-facebook" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="ins">
                                <a href="https://www.instagram.com/burgerslike/">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span class="fa fa-instagram" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="wha">
                                <a href="tel:04141985035">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span class="fa l fa-whatsapp" aria-hidden="true"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="informacion">
                    <span class="titulo">Informacion Adicional</span>
                    <p class="parrafo">
                        En burgers Like, nuestra prioridad es atender a nuestros clientes con 
                        el mejor servicio por eso nuestro Slogan es "Servicio de reino".<br><br>
                        No te quedes sin ordenar tu comida. Mantente informado visitando nuestras redes sociales
                    </p>
                </div>

            </section>
        </div>

    </body>

</html>

<?php
}
?>