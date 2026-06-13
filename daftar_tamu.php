<?php
include 'config/koneksi.php';
$database = new Koneksi();
$conn = $database->getConnection();

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$data_tamu = [];

$bulan_indo = [
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
    '04' => 'April', '05' => 'Mei', '06' => 'Juni',
    '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
    '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
];

if ($search != "") {
    $stmt = $conn->prepare("SELECT * FROM buku_tamu WHERE nama LIKE ? OR instansi LIKE ? ORDER BY id DESC");
    $searchTerm = "%$search%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
    } else {
        die("Query error: " . $stmt->error);
    }
} else {
    $result = $conn->query("SELECT * FROM buku_tamu ORDER BY id DESC");
}

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tgl_pecah = explode('-', $row['tanggal']);
        $row['tanggal_format'] = $tgl_pecah[2] . ' ' . ($bulan_indo[$tgl_pecah[1]] ?? 'N/A') . ' ' . $tgl_pecah[0];
        $row['waktu_format'] = substr($row['waktu'], 0, 5);
        $data_tamu[] = $row;
    }
}

require 'views/daftar_tamu_view.php';
?>