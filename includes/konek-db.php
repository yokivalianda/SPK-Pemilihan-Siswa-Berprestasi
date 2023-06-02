<?php 
$koneksi = mysqli_connect("localhost","root","","spk_topsis_v2");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
 