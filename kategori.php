<?php 
require 'fungsi/fungsi.php';
session_start();

$kategori = $_GET['kategori'];

if (!$kategori) {
	echo "
	<script>
        document.location.href = '". URL ."';
    </script>
	";
}

 ?>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="blog MAXIMUM">
    <meta name="author" content="lintang">
    <meta name="MAXIMUM" content="MAXIMUM">
    <title><?php echo $kategori ?></title>

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
              <a class="text-muted" href="kategori.php?kategori=<?php echo $kategori ?>"><?php echo $kategori ?></a>
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
         </div>


<main role="main" class="container mt-3">
  <div class="row artikel">
    <?php 
    $cek = lihat("SELECT *from artikel where kategori = '$kategori' order by rand() limit 9 ");
    foreach ($cek as $dapat) :
     ?>
    <div class="col-md-8 m-auto blog-main">
      <div class="blog-post">
        <h2 class="blog-post-title"><?php echo $dapat['judul'] ?></h2>
        <p class="blog-post-meta"><?php echo $dapat['tanggal'] ?> by <a href="tentang.php?penulis=<?php echo $dapat['penulis'] ?>"><?php echo $dapat['penulis'] ?></a></p>

        <?php echo substr($dapat['isi'], 0,100);  ?>
        
        <div class="link">
          <a href="baca.php?id=<?php echo $dapat['id'] ?>" class="link">Continue reading</a>
        </div>
      </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->
    <?php endforeach ?>
  </div><!-- /.row -->

</main><!-- /.container -->


<footer class="blog-footer container">
  <p>Copyright &copy; MAXIMUM 2020</p>
  <p>v.20210102</p>
  <p>
    <a href="kategori.php?kategori=<?php echo $kategori ?>">Back to top</a>
  </p>
</footer>
</body>
</html>
