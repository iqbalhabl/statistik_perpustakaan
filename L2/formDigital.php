<?php
session_start(); 

require_once '../koneksi.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../index.php"); 
    exit();
}

$successMessage = "";
$tanggal = $pelajarL = $pelajarP = $mhsL = $mhsP = $umumL = $umumP = ""; 
$showWarning = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $tanggal = $_POST["tanggal"];

    $checkSql = "SELECT COUNT(*) as count FROM ruang_digital WHERE tanggal = '$tanggal'";
    $result = $conn->query($checkSql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        $showWarning = true;
    } else {
        $pelajarL = $_POST["pelajarL"];
        $pelajarP = $_POST["pelajarP"];
        $mhsL = $_POST["mhsL"];
        $mhsP = $_POST["mhsP"];
        $umumL = $_POST["umumL"];
        $umumP = $_POST["umumP"];

        $sql = "INSERT INTO ruang_digital (tanggal, pelajarL, pelajarP, mhsL, mhsP, umumL, umumP) VALUES ('$tanggal', '$pelajarL', '$pelajarP', '$mhsL', '$mhsP', '$umumL', '$umumP' )";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Data berhasil dimasukkan ke database.";
            $tanggal = $pelajarL = $pelajarP = $mhsL = $mhsP = $umumL = $umumP = "";
        } else {
            $successMessage = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        header("Location: ../L2/formDigital.php"); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Digital</title>
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
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
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
                                <h4>Masukkan Data</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/statistik_perpustakaan/list-date.php">
                                <h4>Laporan Pengunjung</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/statistik_perpustakaan/logout.php">
                                <h4>Kelluar</h4>
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- nav section end -->

    <div class="form">
        <h1>Masukkan Data Ruang Digital</h1>
        <?php if ($successMessage !== ""): ?>
            <p>
                <?php echo $successMessage; ?>
            </p>
        <?php else: ?>
            <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div>
                    <label for="tanggal">Pilih tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>
                </div>

                <h3>Pelajar</h3>
                <div class="form-group">
                    <label for="pelajarL">Laki - Laki</label>
                    <input type="number" class="form-control" name="pelajarL" required>
                </div>
                <div class="form-group">
                    <label for="pelajarP">Perempuan</label>
                    <input type="number" class="form-control" name="pelajarP" required>
                </div>

                <h3>Mahasiswa</h3>
                <div class="form-group">
                    <label for="mhsL">Laki - Laki</label>
                    <input type="number" class="form-control" name="mhsL" required>
                </div>
                <div class="form-group">
                    <label for="mhsP">Perempuan</label>
                    <input type="number" class="form-control" name="mhsP" required>
                </div>

                <h3>Umum</h3>
                <div class="form-group">
                    <label for="umumL">Laki - Laki</label>
                    <input type="number" class="form-control" name="umumL" required>
                </div>
                <div class="form-group">
                    <label for="umumP">Perempuan</label>
                    <input type="number" class="form-control" name="umumP" required>
                </div>

                <div class="form-group">
                    <button class="btn btn-form" type="submit" value="Submit">Simpan Data</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
    <?php if ($showWarning): ?>
        <script>
            alert('Data untuk hari yang anda pilih sudah ada. Pilih hari lain!');
        </script>
    <?php endif; ?>
</body>

</html>