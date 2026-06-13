<?php
include 'config/koneksi.php'; 
$database = new Koneksi();
$conn = $database->getConnection();

date_default_timezone_set('Asia/Jakarta');

$status_simpan = '';

if (isset($_POST['submit'])) {
    $nama     = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $tujuan   = $_POST['tujuan'];
    $tanggal  = date('Y-m-d');
    $waktu    = date('H:i:s');

    $stmt = $conn->prepare("INSERT INTO buku_tamu (nama, instansi, tujuan, tanggal, waktu) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $instansi, $tujuan, $tanggal, $waktu);

    if ($stmt->execute()) {
        $status_simpan = 'sukses';
    } else {
        $status_simpan = 'gagal';
    }
}

require 'views/index_view.php';
?>