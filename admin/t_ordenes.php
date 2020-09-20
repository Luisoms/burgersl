<!DOCTYPE html>
<html lang="en">
<?php
	include("../conexion/conectar.php");
	error_reporting(0);
	session_start();

	include_once '../ordenes-accion.php';
	require_once '../codificador.php';

	if(empty($_SESSION["adm_id"]))
    {
        header('location:logout.php');
    }

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Burgerslike</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="scss/admin.css" rel="stylesheet">

</head>

<body class="fix-header fix-sidebar">
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
                        <div alt="homepage" class="dark-logo"></div>
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
                        <!-- Comment -->
                        <li class="nav-item dropdown">

                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>

                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Comment -->

                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/manager.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">

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
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"> <span><i class="fa fa-user-secret f-s-20 "></i></span><span class="hide-menu">Administradores</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="t_admin.php">Administradores</a></li>
                                <li><a href="agregar_admin.php">Agregar Administrador</a></li>


                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"> <span><i class="fa fa-user f-s-20 "></i></span><span class="hide-menu">Usuarios</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="t_usuarios.php">Usuarios</a></li>
                                <li><a href="agregar_usuario.php">Agregar Usuario</a></li>


                            </ul>
                        </li>

                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Productos</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="t_productos.php">Productos</a></li>
                                <li><a href="agregar_producto.php">Agregar Producto</a></li>


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
        <div class="page-wrapper">
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Todas las Ordenes</h4>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="table table-bordered table-striped ">
                                        
                                        <thead>
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Pedido</th>
                                                <th>Precio</th>
                                                <th>Direccion / Modalidad</th>
                                                <th>Referencia</th>
                                                <th>Estatus</th>
                                                <th>Fecha</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $sql = "SELECT usuarios.*, ordenes.* FROM ordenes,usuarios where usuarios.u_id=ordenes.u_id";
                                            $query = mysqli_query($db, $sql);

                                            if (!mysqli_num_rows($query) > 0) {
                                                echo '<td colspan="10"><center>No hay Ordenes</center></td>';
                                            } else {
                                                while ($rows = mysqli_fetch_array($query))
                                                {
                                                    $array_deco = UtilHelper::arrayDecode($rows['carrito']);
                                            ?>
                                                    <tr class="tr">
                                                        <td><?php echo $rows['u_nombre']; ?></td>

                                                        <td>
                                                            <?php
                                                            foreach ($array_deco as $producto) {
                                                                echo '<p class="pnombre">', $producto['titulo'] ,' x', $producto['cantidad'] , '</p>';
                                                            }
                                                            ?>
                                                        </td>

                                                        <td width="130">Bs <?php echo $rows['precio']; ?></td>
                                                        <td><?php echo $rows['direccion']; ?> / <?php echo $rows['modalidad']; ?></td>
                                                        <td><?php echo $rows['numreferencia']; ?></td>

                                                        <td width="100" class="td">
                                                            <span class="estatus <?php echo $rows['estatus']; ?>"><?php echo $rows['estatus']; ?></span>
                                                        </td>

                                                        <td><?php echo $rows['fecha']; ?></td>

                                                        <td>
                                                            <a style="padding:5px 10px !important; width:100%; height:100%;" href="borrar_ordenes.php?orden_del=<?php echo $rows['o_id']; ?>" onclick="return confirm('¿Estás Seguro?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                                                <i class="fa fa-trash-o" style="font-size:16px"></i>
                                                            </a>

                                                            <a style="border-radius:2px !important; padding:7px 10px !important; width:100%; height:100%;" href="ver_ordenes.php?usuario_upd=<?php echo $rows['o_id']; ?>" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5">
                                                                <i class="ti-settings"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

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


    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>

</html>