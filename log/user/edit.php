<?php 
include '../../fungsi/fungsi.php';
session_start();
if ($_SESSION['status'] != 'login' ) {
    header("location:". BASE_URL ."../login.php");
} 

   $id = $_SESSION['id'];
    $cek = mysqli_query($kon,"SELECT *FROM user where id = '$id' ");
    $ambil = mysqli_fetch_assoc($cek);
    $pangkat = $ambil['pangkat'];
    $nama = $ambil['nama'];
    $email = $ambil['email'];
    $foto = $ambil['foto'];
    $status = $ambil['status'];
    $penulis = $ambil['penulis'];
    $tentang = $ambil['tentang'];

    if ($status != "on") {
        echo "
            <script>
                alert('Akun anda terblokir, Segera Hubungi Admin');
                document.location.href = '". BASE_URL ."halaman/login.php';
            </script>
            ";
    }
    
    if ($tentang == '') {
        echo "
         <script>
                alert('isi tentang dahulu!');
                document.location.href = '". BASE_URL ."profil/edit.php?id=$id';
        </script>
            ";
    }elseif ($foto == '') {
        echo " <script>
                alert('isi foto dahulu!');
                document.location.href = '". BASE_URL ."profil/edit.php?id=$id';
        </script>
        ";
    }

    if ($pangkat != "admin") {
    header("location:". BASE_URL);
    }

if (isset($_POST['edit'])) {
	if (editusad($_POST)>0) {
		echo "
			<script>
				alert('data berhasil di ubah!');
				document.location.href = 'index.php';
			</script>
			";
	}else{
		echo "
		<script>
			alert('data gagal di ubah!');
			document.location.href = 'index.php';
		</script>
	";
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Website bloger" content="">
    <meta name="lintang" content="">

    <title>bloger</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo BASE_URL."alat/vendor/fontawesome-free/css/all.min.css" ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo BASE_URL."alat/css/sb-admin-2.min.css"?> " rel="stylesheet">

</head>

<body id="page-top" >
<!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo BASE_URL ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $pangkat ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo BASE_URL ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>profil</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">setting :</h6>
                       <a class="collapse-item" href="<?php echo BASE_URL."profil/" ?>/">profil</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>keperluan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">keperluan:</h6>
                        <a class="collapse-item" href="<?php echo BASE_URL."artikel/index.php?halaman=artikel" ?>">artikel</a>
                        <a class="collapse-item" href="<?php echo BASE_URL."artikel/index.php?halaman=draft" ?>">draft</a>
                       <?php if ($ambil['pangkat'] == "admin"): ?>
                            <a class="collapse-item" href="<?php echo BASE_URL."user/" ?>">user</a>
                            <a class="collapse-item" href="<?php echo BASE_URL."banner/" ?>">banner</a>
                        <?php endif ?>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <?php if ($pangkat == "admin"): ?>

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>halaman</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login :</h6>
                        <a class="collapse-item" href="<?php echo BASE_URL."halaman/login.php" ?>">Login</a>
                        <a class="collapse-item" href="<?php echo BASE_URL."halaman/register.php" ?>">Register</a>
                        <a class="collapse-item" href="<?php echo BASE_URL."halaman/forgot-password.php" ?>">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="<?php echo BASE_URL."halaman/404.php" ?>">404 Page</a>
                        <a class="collapse-item" href="<?php echo BASE_URL."halaman/blank.php" ?>">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL."halaman/charts.php" ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>statistik</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL."halaman/tables.php" ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>daftar isi</span></a>
            </li>
            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <?php endif ?>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
 -->
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- Counter - Alerts -->
                                <span style="color: black;" class="jam">
                                    <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    echo date("Y-m-d");
                                    ?>
                                </span>
                            </a>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nama ?></span>
                                <img class="img-profile rounded-circle" alt="<?= $nama ?>"
                                src="<?php echo URL."gambar/$foto" ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


<!-- container artikel  -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
    </div>
    <?php 
    $id = $_GET['id'];
    $cek = lihat("SELECT *FROM user where id = $id ");
    foreach ($cek as $aksi) :
     ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
		<div class="row mb-3">
        <div class="col-sm-12">
                <div class="form-group">
                <label for="penulis">Nama</label>
                <input type="text" name="nama" value="<?php echo $aksi['nama'] ?>" class="form-control" id="penulis" aria-describedby="penulis" readonly >
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            </div>
			<div class="col-sm-12">
                <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php echo $aksi['email'] ?>" class="form-control" id="email" aria-describedby="email" readonly>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" value="<?php echo $aksi['penulis'] ?>" class="form-control" id="penulis" aria-describedby="penulis" readonly>
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                <label for="tetang">Tentang</label>
                <input type="text" name="tentang" value="<?php echo $aksi['tentang'] ?>" class="form-control" id="tetang" aria-describedby="tetang" readonly >
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                <label for="pangkat">pangkat</label>
                <?php 
                $pangkat = $aksi['pangkat']  ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" <?php if($pangkat=="admin") echo "checked"; ?> value="admin" name="pangkat">
                        </div>
                    </div>
                    <input type="text" class="form-control" value="admin" readonly="readonly">
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" <?php if($pangkat=="penulis") echo "checked"; ?> value="penulis" name="pangkat" aria-label="Radio button for following text input">
                        </div>
                    </div>
                    <input type="text" value="penulis" readonly="readonly" class="form-control" aria-label="Text input with radio button">
                </div>    
            </div>
        </div>

            <div class="col-sm-12">
                <div class="form-group">
                <label for="status">Status</label>
                <?php 
                $status = $aksi['status'] ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" <?php if($status=="on")echo "checked"; ?> value="on" name="status">
                        </div>
                    </div>
                    <input type="text" class="form-control" value="on" readonly="readonly">
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" <?php if($status=="off")echo "checked"; ?> value="off" name="status" aria-label="Radio button for following text input">
                        </div>
                    </div>
                    <input type="text" value="off" readonly="readonly" class="form-control" aria-label="Text input with radio button">
                </div>    
            </div>
        </div>

        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <img width="100%" src="<?php echo URL ?>gambar/<?php echo $aksi['foto'] ?>" >
                                    </div>
                                </div>
                            </div>           
                        </div>
            
            </div>
        </div>
		</div>	
		<button name="edit" class="tambah">edit</button>
	</form>
<?php endforeach ?>
</div>



<footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>

<!-- logout modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href=<?php echo BASE_URL."halaman/logout.php" ?>>Logout</a>
                </div>
            </div>
        </div>
    </div>
<!-- akhir container artikel -->

<script src="<?php echo BASE_URL."alat/vendor/jquery/jquery.min.js" ?>"></script>
    <script src="<?php echo BASE_URL."alat/vendor/bootstrap/js/bootstrap.bundle.min.js" ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo BASE_URL."alat/vendor/jquery-easing/jquery.easing.min.js"?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo BASE_URL."alat/js/sb-admin-2.min.js" ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo BASE_URL."alat/vendor/chart.js/Chart.min.js" ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo BASE_URL."alat/js/demo/chart-area-demo.js" ?>"></script>
    <script src="<?php echo BASE_URL."alat/js/demo/chart-pie-demo.js" ?>"></script>
</body>
</html>