<?php 
require_once("koneksi.php");
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
} else {
    $username = $_SESSION['username'];  
}

$filter_condition = "";
if (isset($_POST['tanggal_filter']) && !empty($_POST['tanggal_filter'])) {
    $tanggal_filter = $_POST['tanggal_filter'];
    $filter_condition = " WHERE DATE(STR_TO_DATE(waktu, '%W, %d-%m-%Y %h:%i:%s %p')) = '$tanggal_filter'";
} elseif (isset($_POST['show_all'])) {
    $filter_condition = "";
}

$sql = "SELECT * FROM tb_absen" . $filter_condition . " ORDER BY lokasi ASC";
$query = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Data Absen</title>

    <!-- Fontfaces CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all">
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- Jquery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html"></a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li><a class="js-arrow" href="admin2.php"><i class="fas fa-tachometer-alt"></i>Beranda</a></li>
                        <li><a href="datakaryawan.php"><i class="fas fa-chart-bar"></i>Data Imam Musik</a></li>
                        <li><a href="datauser.php"><i class="fas fa-table"></i>Data user</a></li>
                        <li><a href="datajabatan.php"><i class="far fa-check-square"></i>Data Bidang Pelayanan Musik</a></li>
                        <li class="active"><a href="data_absen.php"><i class="fas fa-list"></i>Data Absen</a></li>
                        <li><a href="data_keterangan.php"><i class="fas fa-envelope"></i>Data Keterangan</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#"><h1>admin</h1></a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li><a class="js-arrow" href="admin2.php"><i class="fas fa-tachometer-alt"></i>Beranda</a></li>
                        <li><a href="datakaryawan.php"><i class="fas fa-chart-bar"></i>Data Imam Musik</a></li>
                        <li><a href="datauser.php"><i class="fas fa-table"></i>Data User</a></li>
                        <li><a href="datajabatan.php"><i class="far fa-check-square"></i>Data Bidang Pelayanan Depmus</a></li>
                        <li class="active"><a href="data_absen.php"><i class="fas fa-list"></i>Data Absen</a></li>
                        <li><a href="data_keterangan.php"><i class="fas fa-envelope"></i>Data Keterangan</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="prospenab.php" method="POST">
                                <input autocomplete="off" class="au-input au-input--xl" type="text" name="cari" placeholder="Cari ID atau Nama Karyawan" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
<a href="absen/generate_laporan.php?tanggal_filter=<?php echo isset($_POST['tanggal_filter']) ? $_POST['tanggal_filter'] : ''; ?>" target="_blank">
    <i class="fas fa-download"></i>Export Absen
</a>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="table-responsive table--no-card m-b-30">
                                <form method="post">
                                    <div class="form-group">
                                        <label for="tanggal_filter">Filter Tanggal :</label>
                                        <input type="date" id="tanggal_filter" name="tanggal_filter" class="form-control" onchange="this.form.submit()">
                                        <button class="btn btn-primary" type="submit" name="show_all">Tampilkan | Urutkan Data</button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive table--no-card m-b-30">
                                <table id="absenTable" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Pelayan</th>
                                            <th>Nama</th>
                                            <th>Waktu</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr id="row-<?php echo $row['id']; ?>">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row['id_karyawan']; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['waktu']; ?></td>
                                            <td><?php echo $row['lokasi']; ?></td>
                                            <td>
                                                <button class="btn btn-danger" onclick="hapusData(<?php echo $row['id']; ?>)">Hapus</button>
                                            </td>
                                        </tr>
                                        <?php 
                                            $no++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->

        <!-- Jquery JS-->
        <script src="vendor/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="vendor/bootstrap-4.1/popper.min.js"></script>
        <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
        <!-- Vendor JS-->
        <script src="vendor/slick/slick.min.js"></script>
        <script src="vendor/wow/wow.min.js"></script>
        <script src="vendor/animsition/animsition.min.js"></script>
        <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendor/counter-up/jquery.counterup.min.js"></script>
        <script src="vendor/circle-progress/circle-progress.min.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <!-- Main JS-->
        <script src="js/main.js"></script>

        <script>
            $(document).ready(function() {
                $('#absenTable').DataTable();
            });

            function hapusData(id) {
                if (confirm('Yakin ingin dihapus?')) {
                    $.ajax({
                        url: 'absen/hapus_absen.php',
                        type: 'GET',
                        data: { id: id },
                        success: function(response) {
                            alert('Data berhasil dihapus');
                            // Menghapus baris dari DOM
                            $('#row-' + id).remove();
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan: ' + error);
                        }
                    });
                }
            }
        </script>
    </div>
</body>

</html>
