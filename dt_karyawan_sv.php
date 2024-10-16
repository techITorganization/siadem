<?php
session_start(); 
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];

    // Pastikan ID, nama, username, dan jabatan diisi
    if (empty($id_karyawan) || empty($username) || empty($nama) || empty($jabatan)) {
        echo "<script>alert('ID, nama, username, dan jabatan wajib diisi!')</script>";
        echo "<script>window.location.href = 'form_input.php'</script>";
        exit; // Stop the script execution
    }

    //untuk gambar
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $fotobaru = date('dmYHis').$foto;
    $path = "images/".$fotobaru;

    if (move_uploaded_file($tmp, $path)) {
        $sql = "SELECT * FROM tb_karyawan WHERE id_karyawan = '".$id_karyawan."'";
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Data Dengan ID = ".$id_karyawan." sudah ada')</script>";
            echo "<script>window.location.href = 'datakaryawan.php'</script>";
            exit; // Stop the script execution
        }

        $query = "INSERT INTO tb_karyawan (id_karyawan, username, password, nama, jabatan, foto) VALUES ('$id_karyawan', '$username', '$password', '$nama', '$jabatan', '$fotobaru')";
        if (mysqli_query($koneksi, $query)) {
            header("location: datakaryawan.php");
        } else {
            echo "gagal";
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>
