<?php 
error_reporting(0);
// Cek jika parameter `login_success` ada di URL
if (isset($_GET['login_success']) && $_GET['login_success'] == 'true') {
    echo '<script language="javascript">';
    echo 'alert("Shalom ' . htmlspecialchars($_SESSION['usersi'], ENT_QUOTES, 'UTF-8') . 
         ', Selamat Melayani ya. Tuhan memberkati.\\nJangan lupa absen ya ^_^");';
    echo '</script>';
}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Imam Musik - GBI Cibubur Raya</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

    <script>
        function validateForm() {
            var lokasi = document.forms["absenForm"]["lokasi"].value;
            var time = new Date();
            var hours = time.getHours();
            var day = time.getDay();

            if (lokasi == "#") {
                alert("Anda belum memilih Gereja dengan benar");
                return false;
            }

            if (lokasi == "GNI 3" && day == 0 && (hours < 10 || hours >= 12)) {
                alert("Anda belum bisa absen Ibadah GNI 3");
                return false;
            }

            if (lokasi == "Madison 3" && day == 0 && (hours < 17 || hours >= 18)) {
                alert("Anda belum bisa absen Ibadah Madison 3");
                return false;
            }

            return true;
        }
    </script>
<style>
  .table {
            width: 100%;
            border-collapse: none;
        }
        .table th, .table td {
            border: 1px none #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: center; /* Header rata kiri */
        }
        .table td.cabang {
            text-align: left; /* Kolom cabang rata kiri */
            padding-left: 4px; /* Mengurangi padding kiri untuk kolom cabang */
        }
</style>
</head>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php
        $id = $_SESSION['idsi'];
        include 'koneksi.php';
        $sql = "SELECT * FROM tb_karyawan WHERE id_karyawan = '$id'";
        $query = mysqli_query($koneksi, $sql);
        $r = mysqli_fetch_array($query);
        $nama = $r['nama'];
?>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container px-5">
                <a class="navbar-brand" href="https://gbicibuburraya.com/siadem/imammusik/index.php?m=awal"><span class="fw-bolder text-primary">Imam Musik</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                        <li class="nav-item"><a class="nav-link" href="jadwal.php">Jadwal Pelayanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="pernyataan.php">Pernyataan</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="py-5">
            <div class="container px-5 pb-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-xxl-5">
                        <!-- Header text content-->
                        <div class="text-center text-xxl-start">
                            <div class="fs-3 fw-light text-muted">Shalom, </div>
                            <p class="display-3 fw-bolder mb-5" style="font-size: 2em;"><span class="text-gradient d-inline">
                                    <?php echo $r['nama']; ?></span></p>
                            <div id="MyClockDisplay" class="clock" onload="showTime()" style="font-size: 40px; font-weight: bold;"></div>
                            <p>
                                <?php echo date("l, j F Y")?>
                            </p>
                        </div>
                        <form id="contactForm" action="dt_absen_sv.php" method="post">
                            <!-- maps -->
                            <div class="form-floating mb-3">
                                <div id="map" style="width: 100%; height: 200px"></div>
                            </div>
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <select class="form-control" name="lokasi" id="gereja" onchange="checkGereja()">
                                    <option value="#">Pilih Gereja / Event</option>
                                    <option value="Raffles 1-3">Raffles 1-3</option>
                                    <option value="Legenda">Legenda</option>
                                    <option value="Harvest">Harvest</option>
                                    <option value="GNI 1-2">GNI 1 -2</option>
                                    <option value="GNI 3">GNI 3</option>
                                    <option value="Madison 1-2">Madison 1-2</option>
                                    <option value="Madison 3">Madison 3</option>
                                    <option value="Menara Doa">Menara Doa</option>
                                    <option value="MDPJ Sentul">MDPJ Sentul</option>
                                    <option value="MDPJ Ciburay">MDPJ Ciburay</option>
                                    <option value="COW">City of Worship</option>
                                    <option value="Fellowship">Fellowship Depmus</option>
                                    <option value="Cool">Cool Depmus</option>
                                </select>
                            </div>
                            <script>
                                function checkGereja() {
                                    var selectGereja = document.getElementById('gereja');
                                    var selectedValue = selectGereja.value;
                                                            
                                    if (selectedValue === '#') {
                                    alert('Anda belum memilih gereja atau kegiatan!');
                                    }
                                }
                            </script>
                             <input type="text" readonly="" class="form-control" name="id_karyawan" autocomplete="off" size="25px" maxlength="25px" value="<?php echo $_SESSION ['idsi'];?>" hidden>
                             <input type="text" class="form-control" name="nama" autocomplete="off" readonly="" value="<?php echo $_SESSION['namasi']; ?>" hidden>
                             <input type="text" class="form-control" value="<?php echo date('l, d-m-Y h:i:s a' ); ?>" name="waktu" readonly="" hidden>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-lg" type="submit" name="simpan">Absen</button></div>
                             
                        </form>
                        <div class="d-grid" style="margin-top: 30px;">
                                <a href="?m=karyawan&s=title">
                                   <button class="btn btn-outline-dark btn-outline-dark" type="submit" name="simpan">Izin Melayani / Menggantikan Pelayan</button> 
                                </a>
                                </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- About Section-->
        <section class="bg-light py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xxl-8">
                        <div class="text-center my-5">
                            <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Data Absensi</span></h2>
                            <p class="lead fw-light mb-4">Cek Data Absenmu disini.</p>
                           
                            <?php
                                $history = "SELECT * FROM `tb_absen` WHERE `nama`= '$nama';";
                                $result = mysqli_query($koneksi, $history);

                             ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Cabang</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Absen</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($row = mysqli_fetch_assoc($result)) { 
                $tanggal = date('d-m-Y', strtotime($row['waktu']));
                $absen = date('H:i:s', strtotime($row['waktu']));
                echo "<tr>"; 
                echo "<td class='cabang'>" . htmlspecialchars($row['lokasi']) . "</td>"; 
                echo "<td>" . htmlspecialchars($tanggal) . "</td>"; 
                echo "<td>" . htmlspecialchars($absen) . "</td>"; 
                echo "</tr>"; 
            } 
        ?>
    </tbody>
</table>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
         <!-- Grafik data absen by Budiman -->       
<section class="py-5">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-xxl-8">
                <div class="text-center my-5">
                    <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Summary Data Absen</span></h2>
                    <p class="lead fw-light mb-4">Data Absen by Cabang.</p>
                   
                    <?php
                        $history = "SELECT lokasi, COUNT(*) as jumlah_absen FROM `tb_absen` WHERE `nama`= '$nama' GROUP BY lokasi;";
                        $result = mysqli_query($koneksi, $history);

                     ?>
                     <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Cabang</th>
                                <th scope="col">Jumlah Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($result)) { 
                                echo "<tr>"; 
                                echo "<td>" . $row['lokasi'] . "</td>"; 
                                echo "<td>" . $row['jumlah_absen'] . "</td>"; 
                                echo "</tr>"; 
                            } 
                            ?>
                        </tbody>
                    </table>
                    
                    <div class="chart-container" style="position: relative; width:100%;">
                        <canvas id="absensiChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('absensiChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                <?php
                    mysqli_data_seek($result, 0);
                    while($row = mysqli_fetch_assoc($result)) { 
                        echo "'" . $row['lokasi'] . "',"; 
                    } 
                ?>
            ],
            datasets: [{
                label: 'Data Absensi',
                data: [
                    <?php
                        mysqli_data_seek($result, 0);
                        while($row = mysqli_fetch_assoc($result)) { 
                            echo $row['jumlah_absen'] . ","; 
                        } 
                    ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Data Absensi per Cabang'
                }
            }
        }
    });
</script>

<style>
    @media (max-width: 576px) {
        .chart-container {
            width: 100%;
        }
    }
</style>

<!-- Tambahkan CSS -->
<style>
    /* Sesuaikan lebar iframe sesuai dengan lebar layar perangkat mobile */
    @media (max-width: 767px) {
        .pdf-wrapper {
            width: 100%;
            overflow-x: auto; /* Tambahkan overflow-x untuk pengguliran horizontal jika diperlukan */
        }
        #pdfIframe {
            width: 100%;
        }
    }
</style>

    </main>
    <!-- Footer-->
    <footer class="bg-white py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0">Copyright © GBI Cibubur Raya 2024.</div>
                </div>

            </div>
        </div>
           <!-- Modal HTML -->
<div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalLabel">Reminder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Shalom rekan2....</p>
                <p>Mengundang rekan2 WL, Singer, Musik, dan Penari untuk hadir bersama-sama dalam Menara Doa Depmus pada setiap hari Minggu jam 12.30 WIB bertempat di ruang menara doa Madison Square lantai 4.</p>
                <p>Terimakasih atas perhatiannya. Gbu</p>
                <p>Joseph Sharon<br>Ka. Dept</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script type="text/javascript">
    window.onload = getLocation;
    var lat;
    var long;
    var myModal = new bootstrap.Modal(document.getElementById('announcementModal'), {
            keyboard: false
        });
        myModal.show();
    // Get LongLat
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
    }

    function showPosition(position) {
        var long = position.coords.longitude;
        var lat = position.coords.latitude;
        console.log(long);
        console.log(lat);
        // Creating map options
        // Initialize and display the map
        var map = L.map('map').setView([lat, long], 16); // Example: New York City

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a marker to the map
        var marker = L.marker([lat, long]).addTo(map); // Example: New York City
        //marker.bindPopup("<b>Hello world!</b><br>I am a marker.").openPopup();

    }




    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";

        if (h == 0) {
            h = 12;
        }

        if (h > 12) {
            h = h - 12;
            session = "PM";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();
    </script>
</body>

</html>
<!-- end document-->
