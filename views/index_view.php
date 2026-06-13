<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Buku Tamu Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <h2 class="text-knicks-blue fw-bold mb-2">Buku Tamu Sekolah Digital</h2>
                <p class="text-muted">Isi formulir di bawah ini saat berkunjung.</p>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header pt-3 justify-content-between bg-knicks-blue d-flex align-items-center py-3">
                    <h5 class="card-title mb-0 fw-bold">Formulir Tamu</h5>
                    <a href="daftar_tamu.php" class="btn btn-sm btn-knicks-orange fw-bold">Lihat Daftar Tamu</a>
                </div>
                <div class="p-4">
                    <form action="index.php" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="instansi" class="form-label fw-semibold">Instansi / Asal</label>
                            <input type="text" class="form-control" id="instansi" name="instansi" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="tujuan" class="form-label fw-semibold">Tujuan Kedatangan</label>
                            <textarea class="form-control" id="tujuan" name="tujuan" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-knicks-orange w-100 fw-bold py-2 mt-2">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php if ($status_simpan == 'sukses'): ?>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data tamu berhasil disimpan!',
            icon: 'success',
            confirmButtonColor: '#F58426', 
            confirmButtonText: 'Tutup'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php';
            }
        });
    </script>
<?php elseif ($status_simpan == 'gagal'): ?>
    <script>
        Swal.fire({
            title: 'Oops...',
            text: 'Data gagal disimpan, silakan coba lagi.',
            icon: 'error',
            confirmButtonColor: '#006BB6',
            confirmButtonText: 'Tutup'
        });
    </script>
<?php endif; ?>

</body>
</html>