<!DOCTYPE html>
<html lang="en" >
<?php
include("../conexion/conectar.php");
error_reporting(0);
session_start();
if(isset($_POST['submit']))
{
	$nombre = $_POST['nombre'];
	$clave = $_POST['clave'];
	
	if(!empty($_POST["submit"])) 
     {
	$loginquery ="SELECT * FROM admin WHERE nombre='$nombre' && clave='".md5($clave)."'";
	$result=mysqli_query($db, $loginquery);
	$row=mysqli_fetch_array($result);
	
	                        if(is_array($row))
								{
                                    	$_SESSION["adm_id"] = $row['adm_id'];
										 header("refresh:1;url=dashboard.php");
	                            } 
							else
							    {
                                      	$message = "Nombre o Contraseña invalidos!";
                                }
	 }
	
	
}

if(isset($_POST['submit1'] ))
{
     if(empty($_POST['cr_nombre']) ||
   	    empty($_POST['cr_correo'])|| 
		empty($_POST['cr_clave']) ||  
		empty($_POST['cr_cclave']) ||
		empty($_POST['codigo']))
		{
			$message = "Todos los campos deben ser llenados";
		}
	else
	{
		
	
	$check_nombre= mysqli_query($db, "SELECT nombre FROM admin where nombre = '".$_POST['cr_nombre']."' ");
	
	$check_correo = mysqli_query($db, "SELECT correo FROM admin where correo = '".$_POST['cr_correo']."' ");
	
	  $check_codigo = mysqli_query($db, "SELECT adm_id FROM admin where codigo = '".$_POST['codigo']."' ");

	
	if($_POST['cr_clave'] != $_POST['cr_cclave']){
       	$message = "La contraseña no coincide";
    }
	
    elseif (!filter_var($_POST['cr_correo'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
       	$message = "Dirección de correo no válida, escriba un correo válido!";
    }
	elseif(mysqli_num_rows($check_nombre) > 0)
     {
    	$message = 'El nombre de usuario ya existe!';
     }
	elseif(mysqli_num_rows($check_correo) > 0)
     {
    	$message = 'El correo ya existe!';
     }
	 elseif(mysqli_num_rows($check_codigo) > 0)           // if code already exist 
             {
                   $message = "Codigo unico ya utilizado!";
             }
	else{
       $result = mysqli_query($db,"SELECT id FROM admin_codigos WHERE codigo =  '".$_POST['codigo']."'");  //query to select the id of the valid code enter by user! 
					  
                     if(mysqli_num_rows($result) == 0)     //if code is not valid
						 {
                            // row not found, do stuff...
			                 $message = "Codigo invalido!";
                         } 
                      
                      else                                 //if code is valid 
					     {
	
								$mql = "INSERT INTO admin (nombre,clave,correo,codigo) VALUES ('".$_POST['cr_nombre']."','".md5($_POST['cr_clave'])."','".$_POST['cr_correo']."','".$_POST['codigo']."')";
								mysqli_query($db, $mql);
									$success = "Administrador Agregado Exitosamente!";
						 }
        }
	}

}
?>

<head>
  <meta charset="UTF-8">
  <title>Login Administrador</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">

  
</head>

<body>

  
<div class="container">
  <div class="info">
    <h1>Administrador </h1><span> Cuenta</span>
  </div>
</div>
<div class="form">
  <div class="thumbnail"><img src="images/manager.png"/></div>
  
  <form class="register-form" action="index.php" method="post">
    <input type="text" placeholder="nombre" name="cr_nombre"/>
    <input type="text" placeholder="correo"  name="cr_correo"/>
	 <input type="password" placeholder="contraseña"  name="cr_clave"/>
	  <input type="password" placeholder="Confirmar contraseña"  name="cr_cclave"/>
	  <input type="password" placeholder="Codigo"  name="codigo"/>
   <input type="submit"  name="submit1" value="Crear" />
    <p class="message">Listo para registrarte? <a href="#">Sign In</a></p>
  </form>
  
  <span style="color:red;"><?php echo $message; ?></span>
   <span style="color:green;"><?php echo $success; ?></span>
  <form class="login-form" action="index.php" method="post">
    <input type="text" placeholder="nombre" name="nombre"/>
    <input type="password" placeholder="contraseña" name="clave"/>
    <input type="submit"  name="submit" value="Entrar" />
    <p class="message">No estas registrado? <a href="#">Crea una cuenta</a></p>
  </form>
  
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='js/index.js'></script>
  

    



</body>

</html>
