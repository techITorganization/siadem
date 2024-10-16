<?php
include '../koneksi.php';
session_start();

$filter_condition = "";
if (isset($_GET['tanggal_filter']) && !empty($_GET['tanggal_filter'])) {
    $tanggal_filter = $_GET['tanggal_filter'];
    $filter_condition = " WHERE DATE(STR_TO_DATE(waktu, '%W, %d-%m-%Y %h:%i:%s %p')) = '$tanggal_filter'";
} elseif (isset($_GET['show_all'])) {
    $filter_condition = "";
}

// Fetch data from the database
$query = "SELECT * FROM tb_absen" . $filter_condition . " ORDER BY lokasi ASC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($koneksi));
}

// Create a simple HTML table
echo "<html>
        <head>
            <title>Laporan Absen</title>
        </head>
        <body>
            <h2>Laporan Absen Imam Musik</h2>
            <table border='1'>
                <tr>
                    <th>ID Pelayan</th>
                    <th>Nama</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id_karyawan']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['waktu']}</td>
            <td>{$row['lokasi']}</td>
          </tr>";
}

echo "</table></body></html>";

mysqli_close($koneksi);
?>

<script type="text/javascript">
    window.print();
</script>

