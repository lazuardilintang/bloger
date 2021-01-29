<?php 
require '../../fungsi/fungsi.php';
$id = $_GET['id'];
$cek = mysqli_query($kon , "DELETE FROM tampilkan where id_artikel = $id");

if ($cek) {
	echo "
	<script>
			alert('data berhasil dihapus!');
			document.location.href = 'index.php';
	</script>
		";
}else{
	echo "
	<script>
			alert('data tidak berhasil dihapus!');
			document.location.href = 'index.php';
	</script>
	";
}
 ?>