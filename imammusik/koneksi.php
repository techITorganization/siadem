<?php 
$koneksi = mysqli_connect("localhost", "root", "", "jevknxmx_siadem");

if (mysqli_connect_errno()) {
	echo "koneksi gagal " . mysqli_connect_error();
}
 ?>