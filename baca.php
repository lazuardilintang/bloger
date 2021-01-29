<?php 
require 'fungsi/fungsi.php'; 
$id = $_GET['id'];
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Blog Template · Bootstrap</title>


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
<!--     <link rel="stylesheet" type="text/css" href="style.css">
 -->  </head>
  <body>
    <?php 
    $cek = lihat("SELECT *from artikel where id = $id ");
    foreach ($cek as $key ) :
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

<main role="main" class="container" style="margin-top: 50px;">
  <div class="row artikel">
    <div class="col-md-8 m-auto blog-main">
      <h1 class="blog-post-title">
        <?php echo $key['judul'] ?>
      </h1>
      <div class="authorName mb-2">
         <span>
          <!-- <img src="" width="30px" height="30px" class="rounded float-left mr-2" alt="..."> --></span>
         <p class="blog-post-meta"><?php echo $key['tanggal'] ?> by <a style="text-decoration: none;" class="text-primary" href="tentang.php?penulis=<?php echo $key['penulis'] ?>"><?php echo $key['penulis'] ?></a></p>
      </div>
     
      <img src="<?php echo URL ?>/gambar/<?php echo $key['gambar'] ?>" class="img-fluid" alt="Responsive image">

      <div class="blog-post mt-4">
        <!-- <h2 class="blog-post-title">Sample blog post</h2> -->
        <?php echo $key['isi']; ?>
      </div><!-- /.blog-post -->
    </div><!-- /.blog-main -->
  </div><!-- /.row -->
</main><!-- /.container -->
<?php endforeach ?>
<!-- pilihan -->
<div class="">
  <hr>
</div>



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

<!-- akhir pilihan -->
<footer class="blog-footer">
  <p>Copyright &copy; Bloger 2020</p>
  <p></p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
</body>
</html>
