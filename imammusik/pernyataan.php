<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
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
<style>
    .d-flex{
        display: flex;
    }
    .flex-fill{
        flex: 1;
        min-width: 500px;
        margin: 10px;
    }

    .border{
        border: 3px solid black;
    }
</style>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container px-5">
                <a class="navbar-brand" href="https://gbicibuburraya.com/siadem/imammusik/index.php?m=awal"><span class="fw-bolder text-primary">Imam Musik</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                        <li class="nav-item"><a class="nav-link" href="javascript:history.go(-1)">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Form untuk mengisi data surat -->
        <section class="py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xxl-8">
                        <div class="text-center my-5">
                            <h2 class="fs-8 fw-bolder"><span class="text-gradient d-inline">Isi biodata mu disini!</span></h2>
                            <p>Fungsi dari bio dibawah ini yang nantinya akan di generate menjadi surat.</p>
                            <form action="generate_surat.php" method="post" class="text-start">
                                <div class="mb-3">
                                    <label for="nama">Nama Lengkap :</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($_SESSION['namasi'] ?? ''); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="cabang">Cabang :</label>
                                    <div class="form-floating">
                                        <select class="form-control" id="cabang" name="cabang" onchange="checkGereja()" required>
                                            <option value="#">Pilih Gereja</option>
                                            <option value="CRH">CRH</option>
                                            <option value="Legenda">Legenda</option>
                                            <option value="Harvest">Harvest</option>
                                            <option value="GNI">GNI</option>
                                            <option value="Madison">Madison</option>
                                        </select>
                                    </div>
                                    <script>
                                        function checkGereja() {
                                            var selectCabang = document.getElementById('cabang');
                                            var selectedValue = selectCabang.value;

                                            if (selectedValue === '#') {
                                            alert('Anda belum memilih cabang pada bio');
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="mb-3">
                                    <label for="bidang">Bidang / Instrumen :</label>
                                    <input type="text" class="form-control" id="bidang" name="bidang" value="<?php echo htmlspecialchars($_SESSION['jabatansi'] ?? ''); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat">Alamat :</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
                                <h2 class="fs-8 fw-bolder text-center mt-4"><span class="text-gradient d-inline">Isi form re komitmen disini!</span></h2>
                                <div class="d-flex border p-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2 class="flex-fill fs-5 fw-bolder mt-4">Bersedia mengikuti kegiatan Cibubur Raya, seperti :</h2>
                                            <div class="flex-fill mb-3">
                                                <label>Menara Doa Pelayan Jemaat di SICC (Sabtu, Minggu ke 1)</label>
                                                <br>
                                                <input type="radio" id="setuju_yes_1" name="setuju_1" value="YA" onclick="toggleAlasanField('1')">
                                                <label for="setuju_yes_1">YA</label><br>
                                                <input type="radio" id="setuju_no_1" name="setuju_1" value="TIDAK" onclick="toggleAlasanField('1')">
                                                <label for="setuju_no_1">TIDAK</label>
                                            </div>
                                            <div class="flex-fill mb-3" id="alasanField_1" class="alasanField" style="display: none;">
                                                <label for="alasana1">Alasan:</label>
                                                <textarea class="form-control" id="alasana1" name="alasana1" rows="3"></textarea>
                                            </div>
                                            <div class="flex-fill mb-3">
                                                <label>Menara Doa Pelayan Jemaat GBI Cibubur Raya (Sabtu, Minggu ke 3)</label>
                                                <br>
                                                <input type="radio" id="setuju_yes_2" name="setuju_2" value="YA" onclick="toggleAlasanField('2')">
                                                <label for="setuju_yes_2">YA</label><br>
                                                <input type="radio" id="setuju_no_2" name="setuju_2" value="TIDAK" onclick="toggleAlasanField('2')">
                                                <label for="setuju_no_2">TIDAK</label>
                                            </div>
                                            <div class="flex-fill mb-3" id="alasanField_2" class="alasanField" style="display: none;">
                                                <label for="alasana2">Alasan:</label>
                                                <textarea class="form-control" id="alasana2" name="alasana2" rows="3"></textarea>
                                            </div>
                                            <div class="flex-fill mb-3">
                                                <label>Menara Doa Cibubur Raya (masuk 1 x dalam 1 bulan)</label>
                                                <br>
                                                <input type="radio" id="setuju_yes_3" name="setuju_3" value="YA" onclick="toggleAlasanField('3')">
                                                <label for="setuju_yes_3">YA</label><br>
                                                <input type="radio" id="setuju_no_3" name="setuju_3" value="TIDAK" onclick="toggleAlasanField('3')">
                                                <label for="setuju_no_3">TIDAK</label>
                                            </div>
                                            <div class="flex-fill mb-3" id="alasanField_3" class="alasanField" style="display: none;">
                                                <label for="alasana3">Alasan:</label>
                                                <textarea class="form-control" id="alasana3" name="alasana3" rows="3"></textarea>
                                            </div>
                                            <div class="flex-fill mb-3">
                                                <label>Mercy Seat (Setiap Minggu sebelum Ibadah Raya)</label>
                                                <br>
                                                <input type="radio" id="setuju_yes_4" name="setuju_4" value="YA" onclick="toggleAlasanField('4')" checked>
                                                <label for="setuju_yes_4">YA</label><br>
                                                <input type="radio" id="setuju_no_4" name="setuju_4" value="TIDAK" onclick="toggleAlasanField('4')" disabled>
                                                <label for="setuju_no_4">TIDAK</label>
                                            </div>
                                            <div class="flex-fill mb-3" id="alasanField_4" class="alasanField" style="display: none;">
                                                <label for="alasana4">Alasan:</label>
                                                <textarea class="form-control" id="alasana4" name="alasana4" rows="3"></textarea>
                                            </div>
                                            <div class="flex-fill mb-3">
                                                <label>COOL</label>
                                                <br>
                                                <input type="radio" id="setuju_yes_5" name="setuju_5" value="YA" onclick="toggleAlasanField('5')">
                                                <label for="setuju_yes_5">YA</label><br>
                                                <input type="radio" id="setuju_no_5" name="setuju_5" value="TIDAK" onclick="toggleAlasanField('5')">
                                                <label for="setuju_no_5">TIDAK</label>
                                            </div>
                                            <div class="flex-fill mb-3" id="alasanField_5" class="alasanField" style="display: none;">
                                                <label for="alasana5">Alasan:</label>
                                                <textarea class="form-control" id="alasana5" name="alasana5" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h2 class="flex-fill fs-5 fw-bolder mt-4">Bersedia mengikuti kegiatan Departemen Musik, seperti :</h2>
                                            <div class="flex-fill mb-3">
                                                <label>Pelatihan yang diselenggarakan baik Vocal ataupun Instrumen</label>
                                                <br>
                                                <input type="radio" id="setuju_yes_6" name="setuju_6" value="YA" onclick="toggleAlasanField('6')">
                                                <label for="setuju_yes_6">YA</label><br>
                                                <input type="radio" id="setuju_no_6" name="setuju_6" value="TIDAK" onclick="toggleAlasanField('6')">
                                                <label for="setuju_no_6">TIDAK</label>
                                            </div>
                                            <div class="flex-fill mb-3" id="alasanField_6" class="alasanField" style="display: none;">
                                                <label for="alasanb1">Alasan:</label>
                                                <textarea class="form-control" id="alasanb1" name="alasanb1" rows="3"></textarea>
                                            </div>
                                            <div class="flex-fill mb-3">
                                                <label>Menara doa wajib setiap 1 bulan sekali di Minggu ke 4</label>
                                                <br>
                                                <input type="radio" id="setuju_yes_7" name="setuju_7" value="YA" onclick="toggleAlasanField('7')">
                                                <label for="setuju_yes_7">YA</label><br>
                                                <input type="radio" id="setuju_no_7" name="setuju_7" value="TIDAK" onclick="toggleAlasanField('7')">
                                                <label for="setuju_no_7">TIDAK</label>
                                            </div>
                                            <div class="flex-fill mb-3" id="alasanField_7" class="alasanField" style="display: none;">
                                                <label for="alasanb2">Alasan:</label>
                                                <textarea class="form-control" id="alasanb2" name="alasanb2" rows="3"></textarea>
                                            </div>
                                            <div class="flex-fill mb-3">
                                                <label>COOL (Jika belum tergabung dalam COOL manapun)</label>
                                                <br>
                                                <input type="radio" id="setuju_yes_" name="setuju_8" value="YA" onclick="toggleAlasanField('8')">
                                                <label for="setuju_yes_8">YA</label><br>
                                                <input type="radio" id="setuju_no_8" name="setuju_8" value="TIDAK" onclick="toggleAlasanField('8')">
                                                <label for="setuju_no_8">TIDAK</label>
                                            </div>
                                            <div class="flex-fill mb-3" id="alasanField_8" class="alasanField" style="display: none;">
                                                <label for="alasanb3">Nama Cabang :</label>
                                                <div class="form-floating">
                                                    <select class="form-control" id="alasanb3" name="alasanb3" onchange="checkCabang()" required>
                                                        <option value="#">Pilih Gereja</option>
                                                        <option value="CRH">CRH</option>
                                                        <option value="Legenda">Legenda</option>
                                                        <option value="Harvest">Harvest</option>
                                                        <option value="GNI">GNI</option>
                                                        <option value="Madison">Madison</option>
                                                    </select>
                                                </div>
                                                <script>
                                                    function checkCabang() {
                                                        var selectCabang = document.getElementById('alasanb3');
                                                        var selectedValue = selectCabang.value;
                                                    
                                                        if (selectedValue === '#') {
                                                        alert('Anda belum memilih cabang pada bio');
                                                        }
                                                    }
                                                </script>
                                                <label for="alasanb4">Nama COOL :</label>
                                                <input type="text" class="form-control" id="alasanb4" name="alasanb4">
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Generate Surat</button>
                            </form>
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

    <script>
        function toggleAlasanField(number) {
            var setujuNo = document.getElementById('setuju_no_' + number);
            var alasanField = document.getElementById('alasanField_' + number);

            if (setujuNo.checked) {
                alasanField.style.display = 'block';
            } else {
                alasanField.style.display = 'none';
            }
        }
    </script>
</body>

<style>
    /* Default styles (for large screens) */
    .container {
        padding: 0 15px;
    }
    .text-center h2 {
        font-size: 2.5rem;
    }
    .d-flex {
        flex-direction: row;
    }
    .form-control {
        font-size: 1rem;
    }
    .form-floating {
        margin-bottom: 1rem;
    }

    /* Styles for medium screens */
    @media (max-width: 992px) {
        .container {
            padding: 0 10px;
        }
        .text-center h2 {
            font-size: 2rem;
        }
        .d-flex {
            flex-direction: column;
        }
        .col-md-6 {
            width: 100%;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
        .btn {
            width: 100%;
            padding: 0.75rem;
        }
        .flex-fill{
            min-width: 400px;
        }
    }

    /* Styles for small screens */
    @media (max-width: 576px) {
        .text-center h2 {
            font-size: 1.5rem;
        }
        .form-control {
            font-size: 0.875rem;
        }
        .form-floating {
            margin-bottom: 0.5rem;
        }
        .d-flex {
            flex-direction: column;
        }
        .btn {
            font-size: 0.875rem;
            padding: 0.5rem;
        }
        .flex-fill{
            min-width: 250px;
        }
    }
</style>

</html>
