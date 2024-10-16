<?php
include '../koneksi.php';

// Set zona waktu sesuai dengan kebutuhan
date_default_timezone_set('Asia/Jakarta');

// Menyiapkan variabel untuk JavaScript
$show_popup = false;
$popup_message = '';
$popup_url = '';

// Kriteria waktu untuk pop-up
$criteria = [
    '07:00' => ['Raffles 1-3'],
    '08:00' => ['Legenda'],
    '07:30' => ['Harvest', 'Madison 1-2'],
    '06:30' => ['GNI 1-2'],
    '17:00' => ['Madison 3'],
];

if (isset($_POST['simpan'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $nama = $_POST['nama'];
    $waktu = $_POST['waktu'];
    $lokasi = $_POST['lokasi'];

    // Ambil jam saat ini
    $jam_saat_ini = date('H:i');

    // Cek waktu dan tampilkan pop-up jika diperlukan
    foreach ($criteria as $time => $locations) {
        if ($jam_saat_ini == $time && in_array($lokasi, $locations)) {
            $show_popup = true;
            $popup_message = 'Ibadah sedang berlangsung anda tidak bisa absen';
            $popup_url = 'https://wa.me/6282229777152?text=Maaf%2C%20saya%20telat%20absen%20kak%20regen';
            break;
        }
    }

    if ($show_popup) {
        echo "<script>
            window.onload = function() {
                document.getElementById('popup').style.display = 'flex';
            }
        </script>";
    } else {
        // Cek hari dan waktu sesuai kriteria
        $hari_saat_ini = date('w'); // 0 (Minggu) sampai 6 (Sabtu)
        
        if ($hari_saat_ini == 0) { // Minggu=0
            if (($lokasi == '#' && $waktu != 'GNI 3' && $waktu != 'Madison 3') || ($lokasi == 'GNI 3' && ($jam_saat_ini < '09:30' || $jam_saat_ini > '12:00')) || ($lokasi == 'Madison 3' && ($jam_saat_ini < '15:30' || $jam_saat_ini > '18:30'))) {
                if ($lokasi == '#') {
                    echo "<script>alert('Anda belum memilih Gereja dengan benar')</script>";
                } elseif ($lokasi == 'GNI 3') {
                    echo "<script>alert('Anda belum bisa absen Ibadah GNI 3')</script>";
                } elseif ($lokasi == 'Madison 3') {
                    echo "<script>alert('Anda belum bisa absen Ibadah Madison 3')</script>";
                }
            } else {
                // Jika kriteria terpenuhi, simpan data absen
                $save = "INSERT INTO tb_absen (id_karyawan, nama, waktu, lokasi) VALUES ('$id_karyawan', '$nama', '$waktu', '$lokasi')";
                $result = mysqli_query($koneksi, $save);

                if ($result) {
                    echo "<script>alert('Anda sudah absen untuk hari ini')</script>";
                    echo "<script>window.location.href = 'index.php?m=awal'</script>";
                    exit;
                } else {
                    echo "<script>alert('Terjadi kesalahan saat menyimpan absen.')</script>";
                }
            }
        } elseif ($hari_saat_ini == 6) { // Sabtu=6
            if ($lokasi != 'MDPJ Ciburay') {
                echo "<script>alert('Hari ini bukan hari Minggu. Anda tidak dapat absen hari ini kecuali di MDPJ Ciburay.')</script>";
            } else {
                // Jika kriteria terpenuhi, simpan data absen
                $save = "INSERT INTO tb_absen (id_karyawan, nama, waktu, lokasi) VALUES ('$id_karyawan', '$nama', '$waktu', '$lokasi')";
                $result = mysqli_query($koneksi, $save);

                if ($result) {
                    echo "<script>alert('Anda sudah absen untuk hari ini')</script>";
                    echo "<script>window.location.href = 'index.php?m=awal'</script>";
                    exit;
                } else {
                    echo "<script>alert('Terjadi kesalahan saat menyimpan absen.')</script>";
                }
            }
        } else {
            echo "<script>alert('Hari ini bukan hari Minggu atau Sabtu. Anda tidak dapat absen hari ini.')</script>";
        }
    }
} else {
    echo "Tidak ada data yang dikirimkan melalui form.";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop-up Absen</title>
    <style>
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            width: 300px;
        }
        .popup-content p {
            margin: 0 0 15px;
        }
        .popup-content a {
            display: inline-block;
            background-color: #25D366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .popup-content a:hover {
            background-color: #128C7E;
        }
    </style>
</head>
<body>

<div id="popup" class="popup">
    <div class="popup-content">
        <p><?php echo $popup_message; ?></p>
        <a href="<?php echo $popup_url; ?>" target="_blank">LAPOR</a>
    </div>
</div>

</body>
</html>
