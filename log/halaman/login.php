<?php 
//error_reporting(0);
session_start();
require '../../fungsi/fungsi.php';

//cek cookie
if (isset($_COOKIE['id'])&& isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $cek = mysqli_query($Kon,"SELECT email from user where id = $id");
    $pecah = mysqli_fetch_assoc($cek);

    //cek cookie dan email
    if ($key === hash('sha256', $pecah['email'])) {
        $_SESSION['login'] = true;
    }
}


if (isset($_SESSION['login'])) {
    header("location:".BASE_URL."index.php");
    exit;
}

    if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $cek = mysqli_query($kon,"SELECT *from user where email = '$email' ");
    $pecah = mysqli_fetch_array($cek);
    $cekpas = password_verify($pass, $pecah['password']);
    $hitung = mysqli_num_rows($cek);
    $status = $pecah['status'];

    

    //cek email 
    if ($hitung > 0 ) {
        
        //cek password
        
            if ($cekpas) {
            
                //set sesseion 
                $_SESSION['status'] = 'login';
                $_SESSION['id'] = $pecah['id'];
                $_SESSION['nama'] = $pecah['nama'];
                $_SESSION['penulis'] = $pecah['penulis'];

            if (isset($_POST['ingat'])) {
                
                //set cookie

                setcookie('id',$pecah['id'],time()+60);
                setcookie('key',hash('256',$pecah['email']),time()+60);
            }

            header("location:".BASE_URL."index.php");
            exit;

            }

            $pass = true;

        }

    $error = true;


}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="website blog" content="">
    <meta name="lintang" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo BASE_URL."alat/vendor/fontawesome-free/css/all.min.css" ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo BASE_URL."alat/css/sb-admin-2.min.css"?> " rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php if( isset($error) ) : ?>
                                    <p style="color: red; font-style: italic;">email salah</p>
                                    <?php endif; ?>
                                    <?php if (isset($pass)): ?>
                                        <p style="color: red; font-style: italic;">password salah</p>     
                                    <?php endif ?>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="ingat" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                       <!--  <hr> -->
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo BASE_URL."alat/vendor/jquery/jquery.min.js"?>"></script>
    <script src="<?php echo BASE_URL."alat/vendor/bootstrap/js/bootstrap.bundle.min.js"?>"></script>

    <!-- Core plugin JavaScript-->
    <script src=" <?php echo BASE_URL."alat/vendor/jquery-easing/jquery.easing.min.js"?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo BASE_URL."alat/js/sb-admin-2.min.js" ?>"></script>

</body>

</html>