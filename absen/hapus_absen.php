<?php 

include '../koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM tb_absen WHERE id = '$id'";
$hapus = mysqli_query($koneksi, $sql);

if ($hapus) {
	//header("location: ../data_absen.php");
	echo "<alert>data berhasil di hapus<alert>";
} 
else
{
echo "bakekok bunda";
} 
 ?>
