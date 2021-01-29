<?php 
require 'fungsi/fungsi.php';
session_start();

$halaman = isset($_GET['kategori']) ? $_GET['kategori'] : false ;

 ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Blog Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/blog/">

    <!-- Bootstrap core CSS -->
  <link href="boot/css/bootstrap.min.css" rel="stylesheet">

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
    <link href="boot/blog.css" rel="stylesheet">
  </head>
  <body>
    
      <div class="container">
        <header class="blog-header py-3">
          <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
              <a class="text-muted" href="#">Subscribe</a>
            </div>
            <div class="col-4 text-center">
              <a class="blog-header-logo text-dark" href="#">Large</a>
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

    <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <?php 
       $cek =  lihat("SELECT *from kategori where status = 'on'");
       foreach ($cek as $kategori):
        $nama = $kategori['nama']
       ?>
      <a class="p-2 text-muted" 
      href="<?php echo "index.php?kategori=$nama" ?>"><?php echo $kategori['nama'] ?></a>
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

<main role="main" class="container">
  <div class="row artikel">
    <?php 
    $cek = lihat("SELECT *from artikel order by rand() limit 5 ");
    foreach ($cek as $dapat) :
     ?>
    <div class="col-md-8 m-auto blog-main">
      <div class="blog-post">
        <h2 class="blog-post-title"><?php echo $ambil['judul'] ?></h2>
        <p class="blog-post-meta"><?php echo $ambil['tanggal'] ?> by <a href="tentang.php?penulis=<?php echo $ambil['penulis'] ?>"><?php echo $ambil['penulis'] ?></a></p>

        <?php echo substr($ambil['isi'], 0,100);  ?>
        
        <div class="link">
          <a href="baca.php?id=<?php echo $dapat['id'] ?>" class="link">Continue reading</a>
        </div>
      </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->
    <?php endforeach ?>
  </div><!-- /.row -->

</main><!-- /.container -->


<footer class="blog-footer">
  <p>Copyright &copy; Bloger 2020</p>
  <p></p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
</body>
</html>
