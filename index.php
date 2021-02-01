<?php 
require 'fungsi/fungsi.php';
session_start();
 ?>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="blog MAXIMUM">
    <meta name="author" content="lintang">
    <meta name="MAXIMUM" content="MAXIMUM">
    <title>MAXIMUM</title>
    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?php echo URL ?>boot/css/bootstrap.min.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo URL ?>boot/blog.css" rel="stylesheet">
  </head>
  <body>
    
      <div class="container">
        <header class="blog-header py-3">
          <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
              <?php
              //ubah timezone menjadi jakarta
                date_default_timezone_set("Asia/Jakarta");

              //ambil jam dan menit
                $jam = date('H:i');

              //atur salam menggunakan IF
                if ($jam > '05:30' && $jam < '10:00') {
                    $salam = 'Pagi';
                } elseif ($jam >= '10:00' && $jam < '15:00') {
                    $salam = 'Siang';
                } elseif ($jam < '18:00') {
                    $salam = 'Sore';
                } else {
                    $salam = 'Malam';
                }

                ?>
              <a class="text-muted" href=""> Selamat <?php echo $salam ?></a>
            </div>
            <div class="col-4 text-center">
              <a class="blog-header-logo text-dark" href="<?php echo URL ?>">MAX</a>
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
        </header>


    <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <?php 
       $cek =  lihat("SELECT *from kategori where status = 'on'");
       foreach ($cek as $kategori):
        $nama = $kategori['nama']
       ?>
      <a class="p-2 text-muted" 
      href="<?php echo "kategori.php?kategori=$nama"?>"><?php echo $kategori['nama'] ?></a>
      <?php endforeach ?>
    </nav>
  </div>
<?php 
  $ambil = mysqli_query($kon,"SELECT * FROM tampilkan join artikel on tampilkan.id_artikel = artikel.id where status = 'on' order by RAND() limit 1");
  foreach ($ambil as $key) :
  ?>
  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">    
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic"><?php echo $key['judul'] ?></h1>
      <p class="lead my-3"><?php echo substr($key['isi'], 0,200) ?></p>
      <p class="lead mb-0"><a href="baca.php?id=<?php echo $key['id'] ?>" class="text-white font-weight-bold">Continue reading...</a></p>
    </div>
  </div>

<?php endforeach ?>

  <div class="row mb-2 mt-4">
  <?php 
  $asik = lihat("SELECT *from artikel order by rand() limit 2");
  foreach ($asik as $ambil) :
  $thumbnail = $ambil['gambar'];
  ?>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">
            <a href="kategori.php?kategori=<?php echo $ambil['kategori'] ?>"><?php echo $ambil['kategori']; ?></a>
            </strong>
          <h3 class="mb-0"><?php echo $ambil['judul'] ?></h3>
          <div class="mb-1 text-muted"><?php echo $ambil['tanggal'] ?></div>
          <p class="card-text mb-auto"><?php echo substr($ambil['isi'], 0,100); ?></p>
          <a href="baca.php?id=<?php echo $ambil['id'] ?>" class="link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="<?php echo GAMBAR.$thumbnail ?>" class="bd-placeholder-img" alt="<?php echo $ambil['judul']; ?>" width="200" height="250" >
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>

<main role="main" class="container">
  <div class="row artikel">
    <?php 
    $cek = lihat("SELECT *from artikel order by rand() limit 5 ");
    foreach ($cek as $dapat) :
     ?>
    <div class="col-md-8 m-auto blog-main">
      <div class="blog-post">
        <h2 class="blog-post-title"><?php echo $dapat['judul'] ?></h2>
        <p class="blog-post-meta"><?php echo $dapat['tanggal'] ?> by <a href="tentang.php?penulis=<?php echo $dapat['penulis'] ?>"><?php echo $dapat['penulis'] ?></a></p>

        <?php echo substr($dapat['isi'], 0,100);  ?>
        
        <div class="link">
          <a href="baca.php?id=<?php echo $dapat['id']; ?>" class="link">Continue reading</a>
        </div>
      </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->
    <?php endforeach ?>
  </div><!-- /.row -->

</main><!-- /.container -->


<footer class="blog-footer">
  <p>Copyright &copy; MAXIMUM 2020</p>
  <p>v.20210102</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>

</div>

</body>
</html>
