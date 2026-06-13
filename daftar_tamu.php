<?php
include 'koneksi.php';
$database = new Koneksi();
$conn = $database->getConnection();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-knicks-blue py-3 align-items-center justify-content-between d-flex">
            <h5 class=" mb-0 fw-bold card-title">Absensi Daftar Tamu</h5>
            <div class="d-flex align-items-center">
                <form action="daftar_tamu.php" method="GET" class="d-flex me-3">
                    <input type="text" autocomplete="off" name="search" class="form-control form-control-sm me-2" placeholder="Cari nama/instansi..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    <button type="submit" class="btn btn-sm btn-light text-primary fw-bold">Cari</button>
                </form>
                <a href="index.php" class="btn btn-sm btn-knicks-orange fw-bold">Kembali ke Form</a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 table-hover ">
                    <thead>
                        <tr>
                            <th class="table-knicks-header ps-4">No</th>
                            <th class="table-knicks-header">Nama Lengkap</th>
                            <th class="table-knicks-header">Instansi</th>
                            <th class="table-knicks-header">Tujuan</th>
                            <th class="table-knicks-header">Tanggal</th>
                            <th class="table-knicks-header">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

                        if ($search != "") {
                            $query_tampil = "SELECT * FROM buku_tamu WHERE nama LIKE :search OR instansi LIKE :search ORDER BY id DESC";
                            $stmt = $conn->prepare($query_tampil);
                            $stmt->bindValue(':search', "%$search%");
                            $stmt->execute();
                        } else {
                            $query_tampil = "SELECT * FROM buku_tamu ORDER BY id DESC";
                            $stmt = $conn->query($query_tampil);
                        }

                        $bulan_indo = [
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                            '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                        ];

                        $no = 1;
                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                
                                $timestamp = explode('-', $row['tanggal']);
                                $tgl = $timestamp[2];
                                $bln = $bulan_indo[$timestamp[1]];
                                $thn = $timestamp[0];
                                $tanggal_format = $tgl . ' ' . $bln . ' ' . $thn;
                                $waktu_format = date('H:i', strtotime($row['waktu']));
                        ?>
                            <tr>
                                <td class="ps-4"><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nama']); ?></td>
                                <td><?= htmlspecialchars($row['instansi']); ?></td>
                                <td><?= htmlspecialchars($row['tujuan']); ?></td>
                                <td><?= $tanggal_format; ?></td>
                                <td><?= $waktu_format; ?></td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6' class=' py-4 text-center'>Belum ada data tamu atau data tidak ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>