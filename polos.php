<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            color: white;
        }
    </style>
</head>

<body>
<div class="container mt-4 mb-5 px-5">

<?php
// Variabel default warna
$cardColor = "primary";
$buttonColor = "primary";

if (isset($_POST['proses'])) {

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $kehadiran = $_POST['kehadiran'];
    $tugas = $_POST['tugas'];
    $uts = $_POST['uts'];
    $uas = $_POST['uas'];

    // Validasi kosong
    if ($nama == "" || $nim == "" || $kehadiran == "" || $tugas == "" || $uts == "" || $uas == "") {
        echo "<div class='alert alert-danger'>Semua kolom harus diisi!</div>";
    } else {

        // Hitung nilai akhir
        $nilaiAkhir =
            ($kehadiran * 0.10) +
            ($tugas * 0.20) +
            ($uts * 0.30) +
            ($uas * 0.40);

        // Tentukan grade
        if ($nilaiAkhir >= 85) {
            $grade = "A";
        } elseif ($nilaiAkhir >= 70) {
            $grade = "B";
        } elseif ($nilaiAkhir >= 55) {
            $grade = "C";
        } elseif ($nilaiAkhir >= 40) {
            $grade = "D";
        } else {
            $grade = "E";
        }

        // Tentukan kelulusan
        if (
            $kehadiran > 70 &&
            $nilaiAkhir >= 60 &&
            $tugas >= 40 &&
            $uts >= 40 &&
            $uas >= 40
        ) {
            $status = "LULUS";
            $cardColor = "success";
            $buttonColor = "success";
        } else {
            $status = "TIDAK LULUS";
            $cardColor = "danger";
            $buttonColor = "danger";
        }
    }
}
?>

<div class="card shadow-sm border-<?= $cardColor ?>">
    <div class="card-header bg-<?= $cardColor ?> text-center">
        <h1 class="h4 mb-0">Form Penilaian Mahasiswa</h1>
    </div>

    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Masukkan Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Agus">
            </div>

            <div class="mb-3">
                <label class="form-label">Masukkan NIM</label>
                <input type="text" class="form-control" name="nim" placeholder="202332xxx">
            </div>

            <div class="mb-3">
                <label class="form-label">Nilai Kehadiran (10%)</label>
                <input type="number" class="form-control" name="kehadiran" min="0" max="100">
            </div>

            <div class="mb-3">
                <label class="form-label">Nilai Tugas (20%)</label>
                <input type="number" class="form-control" name="tugas" min="0" max="100">
            </div>

            <div class="mb-3">
                <label class="form-label">Nilai UTS (30%)</label>
                <input type="number" class="form-control" name="uts" min="0" max="100">
            </div>

            <div class="mb-3">
                <label class="form-label">Nilai UAS (40%)</label>
                <input type="number" class="form-control" name="uas" min="0" max="100">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" name="proses" class="btn btn-<?= $buttonColor ?>">
                    Proses
                </button>
            </div>
        </form>

        <?php if (isset($status)) { ?>
            <hr>
            <h5>Hasil Penilaian</h5>
            <ul class="list-group">
                <li class="list-group-item">Nama: <b><?= $nama ?></b></li>
                <li class="list-group-item">NIM: <b><?= $nim ?></b></li>
                <li class="list-group-item">Nilai Akhir: <b><?= number_format($nilaiAkhir, 2) ?></b></li>
                <li class="list-group-item">Grade: <b><?= $grade ?></b></li>
                <li class="list-group-item">
                    Status: 
                    <span class="badge bg-<?= $cardColor ?>">
                        <?= $status ?>
                    </span>
                </li>
            </ul>
        <?php } ?>
    </div>
</div>

</div>
</body>
</html>