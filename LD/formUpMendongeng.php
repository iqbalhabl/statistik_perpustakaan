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
    <title>Mendongeng</title>
</head>

<body>
    <?php include '../header.php'; ?>
    <div class="sidebar-container">
        <?php include '../sidebar.php'; ?>
    </div>

    <div class="form">
        <h1>Input Data Ruang Mendongeng</h1>
        <form class="row g-3" action="u_Mendongeng.php" method="POST">
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