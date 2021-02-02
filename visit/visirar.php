<?php	
$kon = mysqli_connect("localhost","root","","bloger");

	$query = mysqli_query($kon, "SELECT * FROM visit_artikel where id_artikel = '$id' ") or die(mysqli_error());
	$fetch = mysqli_fetch_array($query);
	$rows = mysqli_num_rows($query);
 
	if($rows == 0){
		mysqli_query($kon, "INSERT INTO visit_artikel VALUES('', '$id','')") or die(mysqli_error());
	}
 
	$count = $fetch['visit'] + 1;
	mysqli_query($kon, "UPDATE `visit_artikel` SET visit = '$count' where id_artikel = '$id' ") or die(mysqli_error());
 
?>