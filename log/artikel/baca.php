<?php 
require '../../fungsi/fungsi.php';
session_start();
if ($_SESSION['status'] != 'login' ) {
    header("location:../login.php");
} 

    $id = $_SESSION['id'];
    $cek = mysqli_query($kon,"SELECT *FROM user where id = '$id' ");
    $ambil = mysqli_fetch_assoc($cek);
    $pangkat = $ambil['pangkat'];
    $nama = $ambil['nama'];
    $penulis = $ambil['penulis'];
    $tentang = $ambil['tentang'];

    if ($tentang == '') {
        echo "
         <script>
                alert('data berhasil diubah!');
                document.location.href = 'draft.php';
        </script>
            ";
    }

?>
<!DOCTYPE html>
<html>
<head>
  <title>baca</title>
<link rel="stylesheet" type="text/css" href="<?php echo URL ?>boot/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL ?>boot/css/bootstrap.min.css">
<!-- <script async="async" defer="defer" src="https://buttons.github.io/buttons.js"></script> -->
<script async="async" defer="defer" src="https://buttons.github.io/buttons.js"></script>
</head>
<body>
  <?php 
  $nomer = $_GET['id'];
  $halaman = $_GET['halaman']; 

  if ($halaman == 'draft') {
    $cek = lihat("SELECT *from draft where id = '$nomer' ");
  }
  elseif ($halaman == 'artikel') {
      $cek = lihat("SELECT *from artikel where id = '$nomer' ");
  } 
  foreach ($cek as $ambil):
  ?>
<script async="async" defer="defer" src="https://buttons.github.io/buttons.js"></script>
<div class="container">
  <div class="meta"> 
    <div class="image"></div>
    <div class="info"> 
      <h1>On Web Typography</h1>
      <p class="subtitle">`Tale of a dev obsessed with readability on the web`</p>
      <div class="author">
        <div class="authorImage"></div>
        <div class="authorInfo">
          <div class="authorName"><a href="https://codepen.io/lucagez">Luca Gesmundo</a></div>
          <div class="authorSub">Nov 7 <span class="median-divider">·</span> 5 min read</div>
        </div>
      </div><a class="github-button git" href="https://github.com/lucagez/medium.css" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star lucagez/medium.css on GitHub">Star</a>
    </div>
  </div>
  <div class="article" style="border: solid 1px black;">
  <?php echo $ambil['isi']; ?>    
  </div>
</div>
<?php endforeach ?>
</body>
</html>


