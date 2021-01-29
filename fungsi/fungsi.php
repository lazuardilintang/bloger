<?php 
define('BASE_URL', 'http://localhost/blog/log/');
define('URL', 'http://localhost/blog/');


$kon = mysqli_connect("localhost","root","","bloger");

//artikel
function lihat($see){
	global $kon;
	$ambil = mysqli_query($kon,$see);
	while ($taruh = mysqli_fetch_assoc($ambil)) {
		$data[] = $taruh;
	}
	return $data;
}

function hapus($del)
{
	global $kon;
	mysqli_query($kon,"DELETE from artikel where id = $del ");
	return mysqli_affected_rows($kon);
}

function tambahkan($masukan)
{
	global $kon;

	$judul = $masukan['judul'];
	$isi = $masukan['isi'];
	$penulis = $masukan['penulis'];
	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date("Y-m-d");
	$jam = date("h:i");
	$status = 'on';
	$kategori = $masukan['kategori'];
	$gambar = upload();
	if( !$gambar ) {
		echo "<script>
				alert('masukan thumbnail!');
		      </script>";
		return false;
	}
	$query = "INSERT INTO artikel values ('','$judul','$isi','$penulis','$tanggal','$jam','$kategori','$status','$gambar')";
	$aksi = mysqli_query($kon,$query);

	return mysqli_affected_rows($kon);
}

function upload() {

	$nama = $_FILES['gambar']['name'];
	$error = $_FILES['gambar']['size'];
	$tmp = $_FILES['gambar']['tmp_name'];
	$boleh = array('png','jpg','jpeg','gif');
	$eks = pathinfo($nama,PATHINFO_EXTENSION);

	if (!in_array($eks, $boleh)) {
		return false;
	}

	$rand = rand(1,999);
	$newname = $rand.'_'.$nama;

	move_uploaded_file($tmp, 'gambar/' . $newname);

	return $newname;

}

function edit_artikel($masukan)
{
	global $kon;

	$id = $masukan ['id'];
	$judul = $masukan['judul'];
	$isi = $masukan['isi'];
	$penulis = $masukan['penulis'];
	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date("Y-m-d");
	$jam = date("h:i");
	$kategori = $masukan['kategori'];
	$status = $masukan['status'];
	
	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $masukan['gambarlama'];
	}else{
		$gambar = upload();
	}

	$query = "UPDATE artikel SET judul =  '$judul', isi = '$isi', penulis = '$penulis',tanggal = '$tanggal',jam = '$jam',kategori = '$kategori',status = '$status', gambar = '$gambar' WHERE id = $id ";
	$aksi = mysqli_query($kon,$query);

	return mysqli_affected_rows($kon);
}

//draft

function hapusd($del)
{
	global $kon;
	mysqli_query($kon,"DELETE from draft where id = $del ");
	return mysqli_affected_rows($kon);
}

function draft($masukan)
{
	global $kon;

	$judul = $masukan['judul'];
	$isi = $masukan['isi'];
	$penulis = $masukan['penulis'];
	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date("Y-m-d");
	$jam = date("h:i");
	$query = "INSERT INTO draft values ('','$judul','$isi','$penulis','$tanggal','$jam','$gambar')";
	$aksi = mysqli_query($kon,$query);

	return mysqli_affected_rows($kon);
}

function baca($read)
{
	global $kon;
	$cek = mysqli_query($kon,"SELECT judul from artikel where id = $read");
	while ($data = mysqli_fetch_assoc($cek)) {
		$ambil[]=$data;
	}
	return $ambil;
}

function editd($edit)
{
	global $kon;
	
	$nomer = $edit['id'];
	$penulis = $edit['penulis'];
	$judul = htmlspecialchars($edit['judul']);
	$isi = $edit['isi'];
	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date("Y-m-d");
	$jam = date("h:i");

	mysqli_query($kon,"UPDATE draft SET judul = '$judul', isi = '$isi', penulis = '$penulis', tanggal = '$tanggal', jam = '$jam' where id = '$nomer' ");

	mysqli_affected_rows($kon);
}


//user

function regis($regis)
{
	global $kon;

	$nama = htmlspecialchars($regis['nama']);
	$penulis = htmlspecialchars($regis['penulis']);
	$email = htmlspecialchars($regis['email']);
	$pass = mysqli_real_escape_string($kon,$regis['pass']);
	$pass1 = mysqli_real_escape_string($kon,$regis['pass1']);
	$tentang = '';
	$pangkat = 'penulis';
	$foto = '';
	$status = 'on';

	//cek nama
	// $cek = mysqli_query($kon,"SELECT nama FROM user WHERE nama = $nama");
	// $hitung = mysqli_num_rows($cek);
	// if ($hitung > 0) {
	// 	echo "<script>
	// 			alert('username sudah terdaftar!')
	// 	      </script>";
	// 	return false;
	// }

	$cekpen = mysqli_query($kon,"SELECT *from user where penulis = '$penulis' ");
	$hitungpen = mysqli_num_rows($cekpen);
	if ($hitungpen > 0) {
		echo "
		<script>
				alert('nama author anda sudah dipakai, silakan ganti!')
		</script>
		";
		return false;
	}

	// cek author
	$cek1 = mysqli_query($kon,"SELECT *FROM user WHERE email = '$email' ");
	$hitung1 = mysqli_num_rows($cek1);
	if ( $hitung1 > 0) {
		echo "<script>
				alert('email anda sudah dipakai, silakan ganti!')
		      </script>";
		return false;
	}

	// cek email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  		echo "<script>
				alert('yang anda masukan bukan email !')
		      </script>";
		return false;
	}

	// cek password
	if ($pass !== $pass1){
		echo "<script>
				alert('password tidak sama!')
		      </script>";
		return false;
	}

	$pass2 = password_hash($pass, PASSWORD_DEFAULT);

	$masuk = mysqli_query($kon,"INSERT INTO user VALUES ('','$nama','$email','$penulis','$tentang','$pass2','$foto','$pangkat','$status')");

	return mysqli_affected_rows($kon);
}

function uploadlog() {

	$nama = $_FILES['foto']['name'];
	$tmp = $_FILES['foto']['tmp_name'];
	$boleh = array('png','jpg','jpeg','gif');
	$eks = pathinfo($nama,PATHINFO_EXTENSION);

	if (!in_array($eks, $boleh)) {
		return false;
	}

	$rand = rand(1,999);
	$newname = $rand.'_'.$nama;

	move_uploaded_file($tmp, '../../gambar/' . $newname);

	return $newname;

}

function editusad($user)
{
	global $kon;
	$id = $user['id'];
	$nama = htmlspecialchars($user['nama']);
	$email = htmlspecialchars($user['email']);
	$penulis = htmlspecialchars($user['penulis']);
	$tentang = htmlspecialchars($user['tentang']);
	$pangkat = htmlspecialchars($user['pangkat']);
	$status = htmlspecialchars($user['status']);
	$query = "UPDATE user SET nama = '$nama', email = '$email', penulis = '$penulis', tentang = '$tentang', pangkat = '$pangkat', status = '$status' where id = '$id' ";
	 mysqli_query($kon,$query);
	 
	 return mysqli_affected_rows($kon);
}

function useredit($edit)
{
	global $kon;
	$id = $edit['id'];
	$nama = htmlspecialchars($edit['nama']);
	$email = htmlspecialchars($edit['email']);
	$penulis = htmlspecialchars($edit['penulis']);
	$tentang = htmlspecialchars($edit['tentang']);
	$foto = uploadlog();
	$query = "UPDATE user SET nama = '$nama', email = '$email', penulis = '$penulis', tentang = '$tentang', foto = '$foto' where id = '$id' ";
	 mysqli_query($kon,$query);
	 
	 return mysqli_affected_rows($kon);
}


//banner

function inputban($tambah)
{
	global $kon;

	$id = $tambah['id'];

	$cek = mysqli_query($kon,"SELECT *FROM tampilkan where id_artikel = '$id' ");
	$hitung = mysqli_num_rows($cek);

	if ($hitung > 0) {
		echo "
		<script>
        alert('data sudah ditambahkan sebelumnya!');
       	</script>
                ";
		return false;
	}else{
	mysqli_query($kon,"INSERT INTO tampilkan values ('','$id') ");
	}
	return mysqli_affected_rows($kon);
}


//kategori

function masukkat($kategori)
{
	global $kon;

	$nama = $_POST['kategori'];
	$status = "on";

	mysqli_query($kon,"INSERT INTO kategori values ('','$nama','$status') ");

	return mysqli_affected_rows($kon);
}

function hapuskat($kategori)
{
	global $kon;

	mysqli_query($kon,"DELETE from kategori where id = $kategori ");

	return mysqli_affected_rows($kon);
}

?>