<?php 

include 'koneksi.php';
if (isset($_POST['simpan'])) {
	
	$id = $_POST['id'];
	$id_karyawan = $_POST['id_karyawan'];
	$nama = $_POST['nama'];
	$keterangan = $_POST['keterangan'];
	$alasan = $_POST['alasan'];
	$waktu = $_POST['waktu'];
	$tanggal = $_POST['tanggal'];
	$jam = $_POST['jam'];


}



$query = "INSERT INTO tb_keterangan SET id_karyawan = '$id_karyawan', nama='$nama', keterangan='$keterangan', alasan='$alasan', waktu='$waktu', tanggal='$tanggal', jam='$jam'";
mysqli_query($koneksi, $query);

if ($query) {
	echo "<script>alert('Anda sudah memberi keterangan') </script>";
	echo '<script>window.history.back()</script>';
}else{
	echo "gagal";
}

 ?>