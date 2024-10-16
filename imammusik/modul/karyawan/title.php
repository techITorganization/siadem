<?php 
error_reporting(0);

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
    <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }
    .h-custom {
      height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
    
    </style>
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container px-5">
                <a class="navbar-brand" href="index.html"><span class="fw-bolder text-primary">Imam Musik</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
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
                            <p class="display-3 fw-bolder" style="font-size: 2em;"><span class="text-gradient d-inline">
                                    <?php echo $r['nama']; ?></span></p>
                            <div id="MyClockDisplay" class="clock" onload="showTime()" style="font-size: 40px; font-weight: bold;"></div>
                            <div class="fs-5 fw-light text-muted mb-5">Berikan keteranganmu dibawah ini</div>
                        </div>
                        <div class="table-responsive table--no-card m-b-30">
                            <div class="form-group" style="margin-bottom:10px">

                            </div>
                        <form action="modul/karyawan/keterangan_sv.php" method="post" enctype="multipart/form-data">
                            <div class="form-group" style="margin-bottom:10px">
                                <input type="hidden" readonly="" class="form-control" name="id_karyawan" autocomplete="off" size="25px" maxlength="25px" value="<?php echo $_SESSION
                                                ['idsi'];?>">
                            </div>
                            <div class="form-group" style="margin-bottom:10px">
                                <input type="hidden" class="form-control" name="nama" autocomplete="off" readonly="" value="<?php echo $_SESSION['namasi']; ?>">
                            </div>
                            <div class="form-group mb-3" style="margin-bottom:10px;">
                                <select name="keterangan" required="">
                                    <option>Pilih Keteranganmu Disini</option>
                                    <option>Sakit</option>
                                    <option>Izin</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom:10px">
                                <label for="alasan">Masukkan Detail : </label>
                                <textarea name="alasan" class="form-control" required=""></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom:10px">
                                <input readonly="" type="hidden" class="form-control" value="<?php echo date('l, d-m-Y h:i:s a' ); ?>" name="waktu">
                            </div>
                            <div class="form-group" style="margin-bottom:10px">
                                <label for="tanggal">Tanggal Izin : </label>
                                <input type="date" class="form-control" name="tanggal">
                            </div>
                            <div class="form-group mb-3" style="margin-bottom:10px;">
                                <select name="jam" required="">
                                    <option>Pilih Jam Ibadah</option>
                                    <option>Pagi</option>
                                    <option>Sore</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom:10px; align-items:center;">
                                <button type="submit" name="simpan" class="btn btn-primary">Kirim</button>
                                <a href="javascript:history.go(-1)" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
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
                                        echo "<tr>"; 
                                        echo "<td>" . $row['lokasi'] . "</td>"; 
                                        echo "<td>" . substr($row['waktu'],8,10) . "</td>"; 
                                        echo "<td>" . substr($row['waktu'],19,8) . "</td>"; 
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
        var day = date.getDay();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";
        
        var daysOfWeek = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        var dayName = daysOfWeek[day];
    
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
    
        var time = dayName + " " + h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;
    
        setTimeout(showTime, 1000);
    }

    showTime();

    </script>
</body>

</html>
<!-- end document-->
