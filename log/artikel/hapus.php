<?php 
$id = $_GET['id'];

require '../../fungsi/fungsi.php';
$halaman = $_GET['halaman'];
if ($halaman == 'artikel') {
	if (hapus($id) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'index.php?halaman=artikel';
		</script>
	";
	}else{
	echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = 'index.php?halaman=artikel';
		</script>
	";
	}
}elseif ($halaman == 'draft') {
	if (hapusd($id) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'index.php?halaman=draft';
		</script>
	";	
	}else{
	echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = 'index.php?halaman=draft';
		</script>
	";
	}
}elseif ($halaman == 'kategori') {
	if (hapuskat($id) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'index.php?halaman=kategori';
		</script>
	";	
	}else{
	echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = 'index.php?halaman=kategori';
		</script>
	";
	}
}

else{
echo "
		<script>
			document.location.href = 'index.php?halaman=artikel';
		</script>
	";
 }?>
