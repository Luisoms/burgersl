<!DOCTYPE html>
<html lang="es">

<?php
    include("conexion/conectar.php");
    error_reporting(0);
    session_start();

    include_once 'producto-accion.php';

    function mostrarMensaje($mensaje)
    {
        echo '<script language="javascript">alert("'.$mensaje.'"); window.location.href="index.php";</script>';
    }
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="scss/principal.css" rel="stylesheet">
    <script src="./js/tools/dialibre.js"></script>

</head>

<body class="home">

    <!-- INGRESAR PHP -->

        <?php

            if(!empty($_POST['entrar']))
            {
                $nombre = $_POST['nombre'];
                $clave  = $_POST['clave'];

                $loginqueryUser  = mysqli_query($db, "SELECT * FROM usuarios WHERE u_nombre='$nombre' && clave='".md5($clave)."'"); 
                $loginqueryAdmin = mysqli_query($db, "SELECT * FROM admin WHERE nombre='$nombre' && clave='".md5($clave)."'");

                if($loginqueryAdmin)
                {
	                $row=mysqli_fetch_array($loginqueryAdmin);
	
	                if(is_array($row))
					{
                        $_SESSION["adm_id"] = $row['adm_id'];
						header("location:admin/dashboard.php");
                    }
                }

                if($loginqueryUser)
                {
	                $row=mysqli_fetch_array($loginqueryUser);
	
	                if(is_array($row))
					{
                        $_SESSION["user_id"] = $row['u_id'];
                    }
                }

                if(!$row)
                {
                    $ingresoInvalido  = "Nombre o Contraseña invalidos";
                    mostrarMensaje($ingresoInvalido);
                }
            }
            
        ?>

    <!-- INGRESAR PHP-->

    <!-- REGISTRAR PHP -->

        <?php
            if (!empty($_POST['submit']))
            {
                if (
                    empty($_POST['nombre']) ||
                    empty($_POST['apellido']) ||
                    empty($_POST['correo']) ||
                    empty($_POST['telefono']) ||
                    empty($_POST['clave']) ||
                    empty($_POST['cclave']) ||
                    empty($_POST['direccion'])
                ){
                    $registroInvalido = "Rellene los campos correctamente";
                    mostrarMensaje($registroInvalido);
                } 
                else 
                {
                    $check_u_nombre = mysqli_query($db, "SELECT u_nombre FROM usuarios where u_nombre = '" . $_POST['u_nombre'] . "' ");
                    $check_correo = mysqli_query($db, "SELECT correo FROM usuarios where correo = '" . $_POST['correo'] . "' ");

                    if ($_POST['clave'] != $_POST['cclave']) {
                        $mensaje = "La contraseña no coincide";
                        mostrarMensaje($mensaje);
                    } elseif (strlen($_POST['clave']) < 6)
                    {
                        $mensaje = "Contraseña mínima es de 6 caracteres";
                        mostrarMensaje($mensaje);
                    } elseif (strlen($_POST['telefono']) < 10)
                    {
                        $mensaje = "Telefono invalido";
                        mostrarMensaje($mensaje);
                    } elseif (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL))
                    {
                        $mensaje = "Dirección de correo no válida";
                        mostrarMensaje($mensaje);
                    } elseif (mysqli_num_rows($check_u_nombre) > 0)
                    {
                        $mensaje = 'El nombre de usuario ya existe!';
                        mostrarMensaje($mensaje);
                    } elseif (mysqli_num_rows($check_correo) > 0)
                    {
                        $mensaje = 'El correo ya existe!';
                        mostrarMensaje($mensaje);
                    } else {
                        $mql = "INSERT INTO usuarios(u_nombre,nombre,apellido,correo,telefono,clave,direccion) VALUES('" . $_POST['u_nombre'] . "','" . $_POST['nombre'] . "','" . $_POST['apellido'] . "','" . $_POST['correo'] . "','" . $_POST['telefono'] . "','" . md5($_POST['clave']) . "','" . $_POST['direccion'] . "')";
                        mysqli_query($db, $mql);

                        $_SESSION["user_id"] = $_GET['u_id'];
                    }
                }
            }
        ?>

    <!-- REGISTRAR PHP -->


    <div id="navbar" class="navbar">
    
        <a onclick="scrollTox(0);"><div class="logo" alt="Logo BurgersLike"></div></a>
        
        <div class="menu">
            <a class="link" onclick="scrollTox(0);">Inicio</a>
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
    
    <div class="contenedor">
        
        <div id="ingresar" class="ingresar">
        
            <div class="cabeza">
                <span class="titulo">Iniciar Sesión</span>
                <span class="cerrarI">&#215;</span>
            </div>
            
            <form class="formulario" action="" method="post">
        
                <div class="input">
                    <input class="usuario" type="text" autocomplete="off" name="nombre" required>
                    <label class="label" for="nombre">
                        <span class="texto">Usuario</span>
                    </label>
                </div>
        
                <div class="input">
                    <input class="clave" type="password" autocomplete="off" name="clave" required>
                    <label class="label" for="clave">
                        <span class="texto">Contraseña</span>
                    </label>
                </div>
        
                <input class="btnentrar" type="submit" name="entrar" value="entrar">
            </form>
        
            <div class="crear-cuenta">
                <span class="pregunta">¿No estás Registrado?</span>
                <a class="crear">Crear cuenta</a>
            </div>
        
        </div>

        <div id="registrar" class="registrar">


            <div class="cabezaR">
                <span class="titulo">Crear Cuenta</span>
                <span class="cerrarR">&#215;</span>
            </div>

            <form class="formularioR" action="" method="post">
                <!-- NOMBRE -->
                <div class="input">
                    <input class="nombre" id="nombre" type="text" autocomplete="null" name="nombre" required>
                    <label class="label" for="nombre">
                        <span class="texto">Nombre</span>
                    </label>
                </div>
                <!-- APELLIDO -->
                <div class="input">
                    <input class="apellido" id="apellido" type="text" autocomplete="null" name="apellido" required>
                    <label class="label" for="apellido">
                        <span class="texto">Apellido</span>
                    </label>
                </div>
                <!-- USUARIO -->
                <div class="input">
                    <input class="usuario" id="usuario" type="text" autocomplete="off" name="u_nombre" required>
                    <label class="label" for="usuario">
                        <span class="texto">Usuario</span>
                    </label>
                </div>
                <!-- CONTRASEÑA -->
                <div class="input">
                    <input class="clave" id="clave" type="password" autocomplete="off" name="clave" aria-describedby="emailHelp" required>
                    <label class="label" for="clave">
                        <span class="texto">Contraseña</span>
                    </label>
                </div>
                <!-- REPETIR CONTRASEÑA -->
                <div class="input">
                    <input class="rclave" id="cclave" type="password" autocomplete="off" name="cclave" aria-describedby="emailHelp" required>
                    <label class="label" for="cclave">
                        <span class="texto">Repetir contraseña</span>
                    </label>
                </div>
                <!-- CORREO -->
                <div class="input">
                    <input class="correo" id="Correo" type="text" autocomplete="off" name="correo" aria-describedby="emailHelp" required>
                    <label class="label" for="Correo">
                        <span class="texto">Correo</span>
                    </label>
                </div>
                <!-- TELEFONO -->
                <div class="input">
                    <input class="telefono" id="Teléfono" type="text" autocomplete="off" name="telefono" aria-describedby="emailHelp" required>
                    <label class="label" for="Correo">
                        <span class="texto">Teléfono</span>
                    </label>
                </div>
                <!-- DIRECCION -->
                <div class="input-direccion">
                    <label class="labelD" for="direccion">Dirección de Entrega</label>
                    <textarea class="direccion" id="direccion" placeholder=". . ." name="direccion" rows="3" required></textarea>
                </div>
                
                <input class="btnregistro" type="submit" value="Registrarse" name="submit">

            </form>

        </div>
        
        <section class="inicio">
            <div class="inicio-contenedor">
                <span class="titulo">Burgers Like</span>
                <span class="parrafo">
                    Disfruta de la mejor comida rapida de Ciudad Guayana, 
                    contamos con servicio de delivery para que puedas degustar  
                    de la comida en la comodidad de tu hogar
                </span>
                <a class="btnin" href="productos.php">Ordena ahora</a>

                <div class="calendario">
                    <span class="infoDias">
                        Trabajamos de jueves a domingo de <strong>5:00pm - 10:00pm</strong>
                    </span>
                </div>
            </div>
        </section>

        <section class="acerca">
            <span class="titulo">Acerca de Burgers Like</span>
            <span class="parrafo">
                Burgers Like, es una empresa ubicada en Guaiparo San félix .Edo Bolívar.
                Se dedica a la venta de comida rapida como hamburguesas sencillas, 
                dobles de pollo y carne, pizzas con distintos contornos. Sus clientes 
                van desde los mas pequeños hasta los mas adultos.
            </span>
            <span class="firma">Burgers Like</span>
        </section>

        <section class="comprar">
            <span class="titulo">Menú para ordenar</span>
            
            <div id="comprar-menu" class="comprar-grid">

                <?php
                    $query_res = mysqli_query($db, "select * from productos LIMIT 24");
                    while ($r = mysqli_fetch_array($query_res)) {

                        $inicioprecio  = $r['precio'];
                        $rprecioi = number_format($inicioprecio,2,",",".");

                        if (empty($_SESSION["user_id"]))
                        {   

                            echo '
                                <a id="carta" class="carta" onclick="checkIngreso()">
                                    <div class="carta-imagen" style="background-image: url(admin/Pro_img/productos/'. $r['img'].');">
                                        <span class="precio">Bs ' . $rprecioi . '</span>
                                    </div>
                                                            
                                    <div class="carta-contenido">
                                        <span id="nombreCarrito" class="nombre">'. $r['titulo'].'</span>
                                        <span class="descripcion">'. $r['descripcion'].'</span>
                                    </div>
                                </a>
                            ';
                        } else
                        {
                            echo '
                                <a id="carta" class="carta" href="productos.php?p_id='.$r['p_id'].'">
                                    <div class="carta-imagen" style="background-image: url(admin/Pro_img/productos/'. $r['img'].');">
                                        <span class="precio">Bs ' . $rprecioi. '</span>
                                    </div>
                                                            
                                    <div class="carta-contenido">
                                        <span id="nombreCarrito" class="nombre">'. $r['titulo'].'</span>
                                        <span class="descripcion">'. $r['descripcion'].'</span>
                                    </div>
                                </a>
                            ';
                        }
                    }
                ?>

            </div>

        </section>

        <section class="piedep">
            <div class="direccion">
                <span class="titulo"><strong>Dirección:</strong> Urb. Guaiparo, Av. Centurion</span>
                <span class="titulo"><strong>Correo:</strong> burgerslikeca@gmail.com</span>
                <span class="titulo"><strong>Telefono:</strong><a class="link">0286-9315048</a></span>
                
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

    <script src="js/tools/principal.js"></script>
    <script src="js/tools/scrollto.js"></script>
    <script src="js/tools/ingreso-registro.js"></script>
    <script src="js/tools/sumaresta.js"></script>
</body>

</html>
