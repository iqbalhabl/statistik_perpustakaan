<?php
session_start(); // Mulai sesi

require_once '../koneksi.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../index.php"); // Redirect to the login page if not logged in
    exit();
}

$tanggal = $_POST['tanggal'];
$pl = $_POST['pl'];
$pp = $_POST['pp'];
$ml = $_POST['ml'];
$mp = $_POST['mp'];
$ul = $_POST['ul'];
$up = $_POST['up'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>MA Mafasa</title>
</head>

<body>

    <!-- nav section start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <div class="col">
                    <img src="https://balaiyanpus.jogjaprov.go.id/images/logo.png" alt="" height="75">
                </div>
                <div class="col">
                    <div class="row">
                        <a class="navbar-brand" href="/">
                            <h2>Statistik Pengunjung</h2>
                        </a>
                    </div>
                    <div class="row">
                        <a class="navbar-brand" href="/">
                        <h5>Balai Layanan Perpustakaan DPAD DIY</h5>
                        </a>
                    </div>
                    </div>
                    <div class="col">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    </div>
                </div>
                <div class="col-7">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/statistik_perpustakaan/home.php">
                            <h4>Home</h4>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="/statistik_perpustakaan/input.php">
                            <h4>Input Data</h4>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/statistik_perpustakaan/list-date.php">
                            <h4>Laporan Pengunjung</h4>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/statistik_perpustakaan/logout.php">
                            <h4>Logout</h4>
                        </a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- nav section end -->

    <div class="form">
        <h1>Edit Data Layanan Keliling MA Mafasa</h1>
        <form class="row g-3" action="u_MAMafasa.php" method="POST">
            <div><label for="tanggal">Pilih tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" value="<?= $tanggal ?>" required>
                <br>
            </div>

            <h3>Pelajar</h3>
            <div class="form-group">
                <label for="pelajarL">Laki - Laki</label>
                <input type="number" class="form-control" name="pelajarL" value="<?= $pl ?>" required>
            </div>
            <div class="form-group">
                <label for="pelajarP">Perempuan</label>
                <input type="number" class="form-control" name="pelajarP" value="<?= $pp ?>" required>
            </div>

            <h3>Mahasiswa</h3>
            <div class="form-group">
                <label for="mhsL">Laki - Laki</label>
                <input type="number" class="form-control" name="mhsL" value="<?= $ml ?>" required>
            </div>
            <div class="form-group">
                <label for="mhsP">Perempuan</label>
                <input type="number" class="form-control" name="mhsP" value="<?= $mp ?>" required>
            </div>

            <h3>Umum</h3>
            <div class="form-group">
                <label for="umumL">Laki - Laki</label>
                <input type="number" class="form-control" name="umumL" value="<?= $ul ?>" required>
            </div>
            <div class="form-group">
                <label for="umumP">Perempuan</label>
                <input type="number" class="form-control" name="umumP" value="<?= $up ?>" required>
            </div>

            <div class="form-group">
                <button class="btn btn-form" type="submit" value="Submit">Submit form</button>
            </div>

        </form>
    </div>
</body>

</html>