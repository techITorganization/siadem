<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $cabang = $_POST['cabang'];
    $bidang = $_POST['bidang'];
    $alamat = $_POST['alamat'];
    $alasana1 = $_POST['alasana1'];
    $alasana2 = $_POST['alasana2'];
    $alasana3 = $_POST['alasana3'];
    $alasana4 = $_POST['alasana4'];
    $alasana5 = $_POST['alasana5'];
    $alasanb1 = $_POST['alasanb1'];
    $alasanb2 = $_POST['alasanb2'];
    $alasanb3 = $_POST['alasanb3'];
    $alasanb4 = $_POST['alasanb4'];
    $setuju_1 = $_POST['setuju_1'];
    $setuju_2 = $_POST['setuju_2'];
    $setuju_3 = $_POST['setuju_3'];
    $setuju_4 = $_POST['setuju_4'];
    $setuju_5 = $_POST['setuju_5'];
    $setuju_6 = $_POST['setuju_6'];
    $setuju_7 = $_POST['setuju_7'];
    $setuju_8 = $_POST['setuju_8'];
    $tanggal = date('d F Y');

    $alasana1 = $setuju_1 == "YA" ? "Saya bersedia komitmen dan mengikuti Menara Doa Pelayan Jemaat di SICC (Sabtu, Minggu ke 1)" : "Saya tidak bersedia mengikuti kegiatan karena $alasana1";
    $alasana2 = $setuju_2 == "YA" ? "Saya bersedia komitmen dan mengikuti Menara Doa Pelayan Jemaat GBI Cibubur Raya (Sabtu, Minggu ke 3)" : "Saya tidak bersedia mengikuti kegiatan karena $alasana2";
    $alasana3 = $setuju_3 == "YA" ? "Saya bersedia komitmen dan mengikuti Menara Doa Cibubur Raya (masuk 1 x dalam 1 bulan)" : "Saya tidak bersedia mengikuti kegiatan karena $alasana3";
    $alasana4 = $setuju_4 == "YA" ? "Saya bersedia komitmen dan mengikuti Mercy seat (Setiap Minggu sebelum Ibadah Raya)" : "Saya tidak bersedia mengikuti kegiatan karena $alasana4";
    $alasana5 = $setuju_5 == "YA" ? "Saya bersedia komitmen dan mengikuti COOL" : "Saya tidak bersedia mengikuti kegiatan karena $alasana5";
    $alasanb1 = $setuju_6 == "YA" ? "Saya bersedia komitmen dan mengikuti kegiatan Pelatihan yang diselenggarakan baik Vocal ataupun Instrumen" : "Saya tidak bersedia mengikuti kegiatan karena $alasanb1";
    $alasanb2 = $setuju_7 == "YA" ? "Saya bersedia komitmen dan mengikuti kegiatan Menara doa wajib setiap 1 bulan sekali di Minggu ke 4" : "Saya tidak bersedia mengikuti kegiatan karena $alasanb2";
    $alasanb3 = $setuju_8 == "YA" ? "Departemen Musik" : "$alasanb3";
    $alasanb4 = $setuju_8 == "YA" ? "COOL Departemen Musik" : "$alasanb4";
    
    $templateProcessor = new TemplateProcessor('template_surat.docx');
    $templateProcessor->setValue('Nama Lengkap', $nama);
    $templateProcessor->setValue('Cabang', $cabang);
    $templateProcessor->setValue('Bidang', $bidang);
    $templateProcessor->setValue('Alamat', $alamat);
    $templateProcessor->setValue('Alasan a1', $alasana1);
    $templateProcessor->setValue('Alasan a2', $alasana2);
    $templateProcessor->setValue('Alasan a3', $alasana3);
    $templateProcessor->setValue('Alasan a4', $alasana4);
    $templateProcessor->setValue('Alasan a5', $alasana5);
    $templateProcessor->setValue('Alasan b1', $alasanb1);
    $templateProcessor->setValue('Alasan b2', $alasanb2);
    $templateProcessor->setValue('Alasan b3', $alasanb3);
    $templateProcessor->setValue('Alasan b4', $alasanb4);
    $templateProcessor->setValue('Setuju 1', $setuju_1);
    $templateProcessor->setValue('Setuju 2', $setuju_2);
    $templateProcessor->setValue('Setuju 3', $setuju_3);
    $templateProcessor->setValue('Setuju 4', $setuju_4);
    $templateProcessor->setValue('Setuju 5', $setuju_5);
    $templateProcessor->setValue('Setuju 6', $setuju_6);
    $templateProcessor->setValue('Setuju 7', $setuju_7);
    $templateProcessor->setValue('Setuju 8', $setuju_8);
    $templateProcessor->setValue('Tanggal', $tanggal);

    // Simpan file Word
    $filename = 'Surat_Pernyataan_' . $nama . '.docx';
    $templateProcessor->saveAs($filename);

    // Koneksi ke database
    $dsn = 'mysql:host=localhost;dbname=jevknxmx_siadem';
    $db_username = 'root';
    $db_password = '';

    try {
        $pdo = new PDO($dsn, $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Simpan path file ke database
        $query = "INSERT INTO file_rek (nama_file, tanggal_upload) VALUES (:nama_file, NOW())";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nama_file', $filename);

        $stmt->execute();
        echo "File berhasil disimpan ke database.";

    } catch (PDOException $e) {
        echo "Gagal menyimpan file: " . $e->getMessage();
    }

    // Kirim file ke user untuk di-download
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename=' . basename($filename));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    flush();
    readfile($filename);

    // Hapus file sementara dari server
    unlink($filename);

    exit;
}
?>
