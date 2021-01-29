<?php 
require 'fungsi/fungsi.php';
$penulis = $_GET['penulis'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title><?php echo $penulis ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo URL ?>boot/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>boot/tentang.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>boot/blog.css">
</head>
<body>
  <?php 
  $cek = lihat("SELECT *from user where penulis = '$penulis' ");
  foreach ($cek as $key) :
   ?>
<div class="container">
  <header class="blog-header py-3">
          <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
              <a class="text-muted" href="tentang.php?penulis=<?php echo $key['penulis'] ?>"><?php echo $key['penulis'] ?></a>
            </div>
            <div class="col-4 text-center">
              <a class="blog-header-logo text-dark" href="<?php echo URL ?>">Large</a>
            </div>
              <?php 

              if (isset($_SESSION['status'])) {
                  echo "
                   <div class='col-4 d-flex justify-content-end align-items-center'>
                   <a class='btn btn-sm btn-outline-secondary' href='".BASE_URL."'>dashboard</a>
                  ";
                }else{
                  echo "
                  <div class='col-4 d-flex justify-content-end align-items-center'>
                   <a class='btn btn-sm btn-outline-secondary' href='".BASE_URL."'>login</a>
                   ";
                }

               ?>
            </div> 
          </div>
        </header>
      <?php endforeach ?>
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?php echo URL ?>/gambar/<?php echo $key['foto'] ?>" alt="Admin" class="profilfoto" width="100%">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?php echo $key['nama'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Author Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?php echo $key['penulis'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $key['email'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Tentang</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo nl2br($key['tentang']) ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>





<div class="row mb-2 mt-4">
  <?php 
  $asik = lihat("SELECT *from artikel where penulis = '$penulis' order by rand() limit 4");
  foreach ($asik as $ambil) :
  ?>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">
            <?php echo $ambil['kategori']; ?>
            </strong>
          <h3 class="mb-0"><?php echo $ambil['judul'] ?></h3>
          <div class="mb-1 text-muted"><?php echo $ambil['tanggal'] ?></div>
          <p class="card-text mb-auto"><?php echo substr($ambil['isi'], 0,100); ?></p>
          <a href="baca.php?id=<?php echo $ambil['id'] ?>" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img class="bd-placeholder-img" alt="" src="<?php echo URL ?>/gambar/<?php echo $ambil['gambar'] ?>" width="200" height="250" >
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>


   </div>


<footer class="blog-footer">
  <p>Copyright &copy; Bloger 2020</p>
  <p></p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>

<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
  
</script>
</body>
</html>