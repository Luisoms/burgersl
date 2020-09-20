<!DOCTYPE html>
<html lang="en">

<?php

	session_start();
	error_reporting(0);
	include("../conexion/conectar.php");

	if(empty($_SESSION["adm_id"]))
    {
        header('location:logout.php');
    }

	if(isset($_POST['submit1'] ))
	{
		if(empty($_POST['cr_nombre']) ||
			empty($_POST['cr_correo'])|| 
			empty($_POST['cr_clave']))
			{
				$error = '<div class="alert alert-danger alert-dismissible fade show">
																	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																	<strong>Todos los campos son requeridos!</strong>
																</div>';
			}
		else
		{
			

		
		
		if(!filter_var($_POST['cr_correo'], FILTER_VALIDATE_EMAIL)) // Validate email address
		{
			$error = '<div class="alert alert-danger alert-dismissible fade show">
																	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																	<strong>correo invalido!</strong>
																</div>';
		}
		elseif(strlen($_POST['cr_clave']) < 6)
		{
			$error = '<div class="alert alert-danger alert-dismissible fade show">
																	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																	<strong>la clave debe ser >=6!</strong>
																</div>';
		}
		
		
		
		else{
		   
		
		$mql = "update admin set nombre='$_POST[cr_nombre]',correo='$_POST[cr_correo]',clave='".md5($_POST[cr_clave])."' where adm_id='$_GET[admin_upd]' ";
		mysqli_query($db, $mql);
				$success = 	'<div class="alert alert-success alert-dismissible fade show">
																	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																	<strong>Admin Actualizado!</strong></div>';
		
		}
		}

	}

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	
    <title>Buergerslike</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
	
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="scss/admin.css" rel="stylesheet">
</head>

<body class="fix-header">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader" style="background-color: #181818;">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
	
    <div id="main-wrapper">
        <!-- header header  -->
         <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <div alt="homepage" class="logo"></div>
                        <!--End Logo icon -->
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                     
                       
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                      
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/manager.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                   
                                    <li><a href="#"><i class="ti-settings"></i> Opciones</a></li>
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Salir</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
		
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Inicio</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Panel Principal</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="dashboard.php">Panel Principal</a></li>
                                
                            </ul>
                        </li>
                        <li class="nav-label">Administrar</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false">  <span><i class="fa fa-user-secret f-s-20 "></i></span><span class="hide-menu">Usuarios</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="t_admin.php">Administradores</a></li>
								<li><a href="agregar_admin.php">Agregar Administrador</a></li>
								
                               
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false">  <span><i class="fa fa-user f-s-20 "></i></span><span class="hide-menu">Usuarios</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="t_usuarios.php">Usuarios</a></li>
								<li><a href="agregar_usuario.php">Agregar Usuario</a></li>
								
                               
                            </ul>
                        </li>
                       
                      <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Productos</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="t_productos.php">Productos</a></li>
								<li><a href="agregar_producto.php">Agregar Productos</a></li>
                              
                                
                            </ul>
                        </li>
						 <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="hide-menu">Ordenes</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="t_ordenes.php">Ordenes</a></li>
								  
                            </ul>
                        </li>
						
                         
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
		
        <!-- Page wrapper  -->
        <div class="page-wrapper" style="height:100%;">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Panel Principal</h3>
				</div>               
            </div>
            <!-- End Bread crumb -->
			
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div style="justify-content:center;" class="row">
				
					<div class="container-fluid">
                <!-- Start Page Content -->
				
						<?php  
							echo $error;
							echo $success;										
						?>
					    <div class="col-lg-12">
						
							<div style="padding:20px 40px !important; width:100%;" class="card card-outline-primary">
								<div class="card-header">
									<h4 class="m-b-0 text-white">Editar Administrador</h4>
								</div>
								
								<div class="card-body">
									<?php 
										$ssql ="select * from admin where adm_id='$_GET[admin_upd]'";
										$res=mysqli_query($db, $ssql); 
										$newrow=mysqli_fetch_array($res);
									?>
									
									<form action='' method='post'  >
									
										<div class="form-body">
                                      
											<hr>
										
											<div class="row p-t-20">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Nombre de Usuario</label>
														<input type="text" name="cr_nombre" class="form-control" value="<?php  echo $newrow['nombre']; ?>" placeholder="nombre de usuario">
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="form-group has-danger">
														<label class="control-label">Correo</label>
														<input type="text" name="cr_correo" class="form-control form-control-danger"  value="<?php  echo $newrow['correo'];  ?>" placeholder="example@gmail.com">
													</div>
												</div>
											</div>
											
											<div style="display:flex; justify-content:center; align-items:center;" class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Contraseña</label>
														<input type="text" name="cr_clave" class="form-control form-control-danger"   value="<?php  echo $newrow['clave'];  ?>" placeholder="contraseña">
													</div>
												</div>
											</div>
											
										</div>
										
										<br>
										<div class="form-actions">
											<input type="submit" name="submit1" class="btn btn-success" value="Guardar"> 
											<a href="dashboard.php" class="btn btn-inverse">Cancelar</a>
										</div>
									</form>
								</div>
							</div>
						</div>					
					</div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
        </div>
        <!-- End Page wrapper  -->	
    </div>
    <!-- End Wrapper -->
	
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>

</body>

</html>