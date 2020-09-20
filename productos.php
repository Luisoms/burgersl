<!DOCTYPE html>
<html lang="es">

<?php
    include("conexion/conectar.php");
    error_reporting(0);
    session_start();

    include_once 'producto-accion.php';

    function mostrarMensaje($mensaje)
    {
        echo '<span class="mensaje activado">'.$mensaje.'</span>';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>

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
            <a class="link" href="index.php">Inicio</a>
            <a class="link" onclick="scrollTox(700);">Menú</a>
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
    
    <div class="contenedor-menu">

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

        <section id="carrito" class="carrito">

            <div class="productos">
                <?php
                    $stmt = $db->prepare("select * from productos where p_id='$_GET[p_id]'");
                    $stmt->execute();
                    $products = $stmt->get_result();
                    if (!empty($products)) 
                    {
                        foreach($products as $product)
                        {
                ?>
                            <form id="producto-item" class="producto-item" method="post" action='productos.php?p_id=<?php echo $_GET['p_id'];?>&action=add&id=<?php echo $product['p_id']; ?>'>
                                                                
                                <div class="producto-img" style="background-image: url(admin/Pro_img/productos/<?php echo $product['img']; ?>);"></div>
                                        
                                <div class="producto-info">
                                    <span class="producto-name"><?php echo $product['titulo']; ?></span>
                                    <span class="producto-dec"> <?php echo $product['descripcion']; ?></span>
                                </div>
                                        
                                <div class="producto-compra"> 
                                    <span class="producto-precio">Bs <?php echo $product['precio']; ?></span>
                                    <div class="producto-cantidad">
                                        <a id="mas" onclick="añadirP();"></a>
                                        <input id="cantidadC" class="cantidad" type="text" autocomplete="null" name="cantidad" value="1" size="2" au/>
                                        <a id="menos" onclick="quitarP();"></a>
                                    </div>
                                    <input class="producto-añadir" type="submit" value="+" />
                                </div>
                                
                            </form>
                <?php
                        }
                                                        
                    }
                ?>
            </div>

            <div class="chequeo">
                    
                <span class="titulo">
                    Carrito
                </span>

                <div id="cesta" class="cesta">
                    <?php
                        $precio_total = 0.00;
						
						foreach ($_SESSION["cart_item"] as $item)
						{ 
                            $precio_total += $item["precio"] * $item["cantidad"];
                            $item_total = $item["precio"] * $item["cantidad"];
                            $cantidad_total += $item["cantidad"];
							?>
								<div id="producto" class="producto">
									<span class="p-nombre"><?php echo $item["titulo"]; ?></span>
									<div class="p-info">
										<input class="p-cantidad" type="text" value='<?php echo "x".$item["cantidad"]; ?>' >
										<input class="p-precio" type="text" value='<?php echo "Bs ".$item_total; ?>' >
										<a class="p-borrar" href="productos.php?p_id=<?php echo $_GET['p_id']; ?>&action=remove&id=<?php echo $item["p_id"]; ?>">🗑</a>
									</div>
								</div>	
                            <?php
                        }
                    ?>
                </div>				  
                                                                                    
                <div class="infototal">
                    <span class="total">total</span>
                    <span class="precio"><span>Bs</span><?php echo $precio_total; ?></span>
                    <span class="texto">Envio Gratis</span>
                    <a class="btncheck" href="productos.php?p_id=<?php echo $_GET['p_id'];?>&action=check">Comprar</a>
                </div>
    
            </div>

        </section>

        <section class="comprar">
            <span class="titulo">Menú para ordenar</span>
            
            <div id="comprar-menu" class="comprar-grid">

                <?php
                    $query_res = mysqli_query($db, "select * from productos LIMIT 9");
                    while ($r = mysqli_fetch_array($query_res)) {

                        if (empty($_SESSION["user_id"]))
                        {                        
                            echo '
                                <a id="carta" class="carta" onclick="checkIngreso()">
                                    <div class="carta-imagen" style="background-image: url(admin/Pro_img/productos/'. $r['img'].');">
                                        <span class="precio">Bs ' . $r['precio']. '</span>
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
                                        <span class="precio">Bs ' . $r['precio']. '</span>
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

    <script src="js/tools/principal.js"></script>
    <script src="js/tools/scrollto.js"></script>
    <script src="js/tools/ingreso-registro.js"></script>
    <script src="js/tools/sumaresta.js"></script>

</body>

</html>