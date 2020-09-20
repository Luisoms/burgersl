<!DOCTYPE html>
<html lang="en">
<?php
	include("../conexion/conectar.php");
	error_reporting(0);
	session_start();
	
	if(empty($_SESSION["adm_id"]))
    {
        header('location:logout.php');
    }

	if(isset($_POST['submit']))
	{		

		/*$fname = $_FILES['file']['name'];
		$temp = $_FILES['file']['tmp_name'];
		$fsize = $_FILES['file']['size'];
						
		$extension = explode('.',$fname);
		$extension = strtolower(end($extension));  
		$fnew = uniqid().'.'.$extension;
					   
		$store = "Pro_img/productos/".basename($fnew);*/

		if(
			($_POST['p_nombre']) != ($roww['titulo']) ||
			($_POST['descripcion']) != ($roww['decripcion']) ||
			($_POST['precio']) != ($roww['precio'])
		)
		{
			mysqli_query($db, "update productos set titulo='$_POST[p_nombre]',descripcion='$_POST[descripcion]',precio='$_POST[precio]' where p_id='$_GET[pro_upd]'");
			
			$success = 	'<div class="alert alert-success alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Actualizado</strong>
						</div>';
		}
		
		/*if($_FILES['file'] = "1")
		{
			if($extension == 'jpg'||$extension == 'png'||$extension == 'gif' )
			{        
				if($fsize>=1000000)
				{
					$error = 	'<div class="alert alert-danger alert-dismissible fade show">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<strong>Tamaño maximo de la imagen 1024kb!</strong> Prueba una imagen diferente.
								</div>';
				}
			}
					
			mysqli_query($db, "update productos set img='$fnew' where p_id='$_GET[pro_upd]'");
			move_uploaded_file($temp, $store);
				
			$success = 	'<div class="alert alert-success alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Imagen actualizada</strong>
						</div>';
		}*/
	
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
                        <li> <a class="has-arrow  " href="#" aria-expanded="false">  <span><i class="fa fa-user-secret f-s-20 "></i></span><span class="hide-menu">Administradores</span></a>
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
				<?php  
					echo $error;
					echo $success; 
				?>
				
				<div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Editar Producto</h4>
                        </div>
						
                        <div class="card-body">
                            <form action='' method='post'  enctype="multipart/form-data">
                                <div class="form-body">
                                    <?php 
										$qml ="select * from productos where p_id='$_GET[pro_upd]'";
										$rest=mysqli_query($db, $qml); 
										$roww=mysqli_fetch_array($rest);
									?>
                                        <hr>
										
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nombre</label>
                                                    <input type="text" name="p_nombre" value="<?php echo $roww['titulo'];?>" class="form-control" placeholder="">
                                                </div>
                                            </div>
											
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Precio </label>
                                                    <input type="text" name="precio" value="<?php echo $roww['precio'];?>"  class="form-control" placeholder="$">
                                                </div>
                                            </div>
                                        </div>
										
                                        <div style="display:flex; justify-content:center; align-items:center;" class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Descripcion</label>
                                                    <input type="text" name="descripcion" value="<?php echo $roww['descripcion'];?>" class="form-control form-control-danger" placeholder="">
                                                </div>
                                            </div>
											<!--
												<div class="col-md-6">
													<div class="form-group has-danger">
														<label class="control-label">Imagen</label>
														<input type="file" name="file"  id="lastName" class="form-control form-control-danger" placeholder="12n">
													</div>
												</div>
											-->
                                        </div>
										<br>
									
										<div class="form-actions">
											<input type="submit" name="submit" class="btn btn-success" value="Guardar"> 
											<a href="dashboard.php" class="btn btn-inverse">Cancelar</a>
										</div>									
                                </form>
								
                            </div>
                        </div>
                    </div>	
                </div>
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