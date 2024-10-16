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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .pdf-controls {
            text-align: center;
            margin-bottom: 10px;
        }
        .pdf-controls button,
        .pdf-controls input {
            margin: 0 5px;
        }
        #zoomSlider {
            width: 200px;
        }
        .pdf-wrapper {
            overflow: auto; /* Enable scrolling */
            position: relative;
            width: 100%;
            height: 500px; /* Adjust as needed */
        }
        #pdfIframe {
            transition: transform 0.2s; /* Smooth zoom effect */
            border: none; /* Remove border */
            width: 100%;
            height: 100%;
        }
    </style>
</head>

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
        <!-- About Section-->
        <section class="py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xxl-8">
                        <div class="text-center my-5">
                            <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Jadwal Imam Musik</span></h2>
                            <button id="viewPdfButton" class="btn btn-primary">Cek Jadwal Imam Musik</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Popup Pengunjung PDF Tersembunyi -->
        <div id="pdfPopup" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Jadwal Imam Musik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="pdf-controls">
                            <button id="zoomOutButton" class="btn btn-secondary">-</button>
                            <button id="zoomInButton" class="btn btn-secondary">+</button>
                            <input id="zoomSlider" type="range" min="50" max="200" value="100" />
                            <a href="https://drive.google.com/uc?export=download&id=1RJkxLFE2qLh3iSMwQlJSZRlB3f4vMDB0" class="btn btn-success" download>Download PDF</a>
                        </div>
                        <div class="pdf-wrapper">
                            <iframe id="pdfIframe" src="https://drive.google.com/file/d/1RJkxLFE2qLh3iSMwQlJSZRlB3f4vMDB0/preview" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            document.getElementById('viewPdfButton').addEventListener('click', function() {
                $('#pdfPopup').modal('show'); // Tampilkan modal popup
            });

            function setZoom(zoomLevel) {
                var iframe = document.getElementById('pdfIframe');
                iframe.style.transform = `scale(${zoomLevel / 100})`; // Mengatur zoom dengan scale transform
                iframe.style.transformOrigin = '0 0'; // Menetapkan titik asal transformasi di sudut kiri atas
            }

            document.getElementById('zoomInButton').addEventListener('click', function() {
                var slider = document.getElementById('zoomSlider');
                slider.value = Math.min(200, parseInt(slider.value) + 10); // Increment zoom
                setZoom(slider.value); // Terapkan zoom
            });

            document.getElementById('zoomOutButton').addEventListener('click', function() {
                var slider = document.getElementById('zoomSlider');
                slider.value = Math.max(50, parseInt(slider.value) - 10); // Decrement zoom
                setZoom(slider.value); // Terapkan zoom
            });

            document.getElementById('zoomSlider').addEventListener('input', function() {
                setZoom(this.value); // Terapkan zoom saat slider diubah
            });

            // Set initial zoom
            setZoom(document.getElementById('zoomSlider').value);
        </script>
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
</body>

</html>
