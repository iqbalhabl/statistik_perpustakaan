<?php
session_start(); // Start session

require 'koneksi.php';

// Handle the case where the form is submitted
if (isset($_POST['filter_tgl'])) {
    $_SESSION['selectedRuang'] = $_POST['ruang'];
}

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Get the selected ruang from the session variable
$selectedRuang = isset($_SESSION['selectedRuang']) ? $_SESSION['selectedRuang'] : 'ruang1';

// Map the selected ruang to the corresponding table name
$tableNames = [
    'ruang1' => 'ruang_digital',
    'ruang2' => 'ruang_langka',
    'ruang3' => 'ruang_audiovisual',
    'ruang4' => 'ruang_referensi',
    'ruang5' => 'ruang_skripsibudaya',
    'ruang6' => 'ruang_umum',
    'ruang7' => 'ruang_braile',
    'ruang8' => 'ruang_majalah',
    'ruang9' => 'ruang_bukuanak',
    'ruang10' => 'ruang_bermain',
    'ruang11' => 'ruang_musik',
    'ruang12' => 'ruang_mendongeng',
    'ruang13' => 'ruang_bioskop',
    'ruang14' => 'ruang_tandon',
    'ruang15' => 'jlc',
    'ruang16' => 'rbm'
];
$selectedTableName = $tableNames[$selectedRuang];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style3.css">
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <title>List Data Pengunjung</title>
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
                            <h5>Grhatama Pustaka Yogyakarta</h5>
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
                            <a class="nav-link" href="/statistik_perpustakaan/input.php">
                                <h4>Input Data</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/statistik_perpustakaan/list.php">
                                <h4>List Data</h4>
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

    <?php
        $rooms = $_POST["rooms"];
        foreach ($rooms as $room) {
            echo $room;
        }
    ?>

    <div class="list">
        <div class="data-pengunjung">
            <div>
                <h1>Data Pengunjung</h1>
            </div>

            <!-- checkbox start -->
            <div class="filter_data">
                <form action="" method="post">
                    <label for="pilihRuang">Pilih ruang :</label>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Ruang Digital
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Langka
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Audio Visual
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Referensi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Skripsi Budaya
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Umum
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Braille
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Majalah
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Buku Anak
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Bermain
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Musik
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Mendongeng
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Bioskop
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="rooms[]" type="checkbox" value="a" id="flexCheckChecked"
                            checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ruang Tandon
                        </label>
                    </div>
                    <button class='btn btn-primary' type="submit" name="show" onclick=''>Tampilkan tabel</button>
            </div>
            <!-- checkbox end -->

            <?php
            if (isset($_POST['filter_tgl'])) {
                $ruang = $_POST['ruang'];
                $tgl_mulai = $_POST['tgl_mulai'];
                $tgl_akhir = $_POST['tgl_akhir'];

                if ($ruang === 'ruang1') {
                    $query = "SELECT * FROM ruang_digital WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang2') {
                    $query = "SELECT * FROM ruang_langka WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang3') {
                    $query = "SELECT * FROM ruang_audiovisual WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang4') {
                    $query = "SELECT * FROM ruang_referensi WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang5') {
                    $query = "SELECT * FROM ruang_skripsibudaya WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang6') {
                    $query = "SELECT * FROM ruang_umum WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang7') {
                    $query = "SELECT * FROM ruang_braile WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang8') {
                    $query = "SELECT * FROM ruang_majalah WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang9') {
                    $query = "SELECT * FROM ruang_bukuanak WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang10') {
                    $query = "SELECT * FROM ruang_bermain WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang11') {
                    $query = "SELECT * FROM ruang_musik WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang12') {
                    $query = "SELECT * FROM ruang_mendongeng WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang13') {
                    $query = "SELECT * FROM ruang_bioskop WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang14') {
                    $query = "SELECT * FROM ruang_tandon WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang15') {
                    $query = "SELECT * FROM jlc WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                } elseif ($ruang === 'ruang16') {
                    $query = "SELECT * FROM rbm WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
                }

            } else {
                $query = "SELECT * FROM $selectedTableName";
            }

            $result = mysqli_query($conn, $query);
            ?>

            <div class="list-table">

                <table id="tblToExcl">

                    <thead class="table-dark">
                        <tr>
                            <th scope="col" rowspan="2">#</th>
                            <th scope="col" rowspan="2">Tanggal</th>
                            <th scope="col" colspan="2">Pelajar</th>
                            <th scope="col" colspan="2">Mahasiswa</th>
                            <th scope="col" colspan="2">Umum</th>
                            <th scope="col" rowspan="2">Jumlah</th>
                            <th scope="col" rowspan="2">Keterangan</th>
                            <th scope="col" rowspan="2">Actions</th> <!-- Add a new column for actions -->
                        </tr>
                        <tr>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $totalPelajarL = 0;
                        $totalPelajarP = 0;
                        $totalMhsL = 0;
                        $totalMhsP = 0;
                        $totalUmumL = 0;
                        $totalUmumP = 0;

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $count . "</td>"; // Menampilkan angka urutan
                            echo "<td>" . $row['tanggal'] . "</td>";
                            echo "<td>" . $row['pelajarL'] . "</td>";
                            echo "<td>" . $row['pelajarP'] . "</td>";
                            echo "<td>" . $row['mhsL'] . "</td>";
                            echo "<td>" . $row['mhsP'] . "</td>";
                            echo "<td>" . $row['umumL'] . "</td>";
                            echo "<td>" . $row['umumP'] . "</td>";

                            $throw = $row['tanggal'];
                            $throwPP = $row['pelajarP'];
                            $throwPL = $row['pelajarL'];
                            $throwML = $row['mhsL'];
                            $throwMP = $row['mhsP'];
                            $throwUP = $row['umumP'];
                            $throwUL = $row['umumL'];

                            $totalPelajarL += $row['pelajarL'];
                            $totalPelajarP += $row['pelajarP'];
                            $totalMhsL += $row['mhsL'];
                            $totalMhsP += $row['mhsP'];
                            $totalUmumL += $row['umumL'];
                            $totalUmumP += $row['umumP'];

                            $total = $row['umumP'] + $row['umumL'] + $row['mhsP'] + $row['mhsL'] + $row['pelajarP'] + $row['pelajarL'];
                            echo "<td>" . $total . "</td>";
                            echo "<td>";
                            switch ($selectedRuang) {
                                case "ruang1":
                                    echo "<form method='post' action='../statistikbalai/L2/formUpDigital.php'>";
                                case "ruang2":
                                    echo "<form method='post' action='../statistikbalai/L2/formUpLangka.php'>";
                                case "ruang3":
                                    echo "<form method='post' action='../statistikbalai/L2/formUpAV.php'>";
                                case "ruang4":
                                    echo "<form method='post' action='../statistikbalai/L2/formUpReferensi.php'>";
                                case "ruang5":
                                    echo "<form method='post' action='../statistikbalai/L2/formUpSkripsiBudaya.php'>";
                                case "ruang6":
                                    echo "<form method='post' action='../statistikbalai/L1/formUpUmum.php'>";
                                case "ruang7":
                                    echo "<form method='post' action='../statistikbalai/L1/formUpBraile.php'>";
                                case "ruang8":
                                    echo "<form method='post' action='../statistikbalai/L1/formUpMajalah.php'>";
                                case "ruang9":
                                    echo "<form method='post' action='../statistikbalai/LD/formUpBukuAnak.php'>";
                                case "ruang10":
                                    echo "<form method='post' action='../statistikbalai/LD/formUpBermain.php'>";
                                case "ruang11":
                                    echo "<form method='post' action='../statistikbalai/LD/formUpMusik.php'>";
                                case "ruang12":
                                    echo "<form method='post' action='../statistikbalai/LD/formUpMendongeng.php'>";
                                case "ruang13":
                                    echo "<form method='post' action='../statistikbalai/LD/formUpBioskop.php'>";
                                case "ruang14":
                                    echo "<form method='post' action='../statistikbalai/LD/formUpTandon.php'>";
                                case "ruang15":
                                    echo "<form method='post' action='../statistikbalai/JLC/formUpMJLC.php'>";
                                case "ruang16":
                                    echo "<form method='post' action='../statistikbalai/RBM/formUpRBM.php'>";

                                    break;
                                default:
                                    echo "<form method='post' action='dashboard.php'>";
                            }
                            echo "
                            <input type='hidden' name='tanggal' value='" . $throw . "'>
                            <input type='hidden' name='pl' value='" . $throwPL . "'>
                            <input type='hidden' name='pp' value='" . $throwPP . "'>
                            <input type='hidden' name='ml' value='" . $throwML . "'>
                            <input type='hidden' name='mp' value='" . $throwMP . "'>
                            <input type='hidden' name='ul' value='" . $throwUL . "'>
                            <input type='hidden' name='up' value='" . $throwUP . "'>
                          <button type='submit' class='btn btn-edit' data-toggle='modal'>Edit</button>
                          </form>
                        </td>";

                            // Delete button
                            echo "<td>";
                            echo "<form method='post' action='delete.php'>"; // Replace 'delete.php' with your actual delete script
                            echo "<input type='hidden' name='tanggal' value='" . $throw . "'>";
                            echo "<input type='hidden' name='ruang' value='" . $selectedRuang . "'>";
                            echo "<button type='submit' class='btn btn-delete' data-toggle='modal'>Delete</button>";
                            echo "</form>";
                            echo "</td>";

                            echo "</tr>";

                            $count++;
                        }
                        ?>

                        <tr>
                            <th scope="row">JUMLAH</th>
                            <td></td>
                            <td>
                                <?php echo $totalPelajarL; ?>
                            </td>
                            <td>
                                <?php echo $totalPelajarP; ?>
                            </td>
                            <td>
                                <?php echo $totalMhsL; ?>
                            </td>
                            <td>
                                <?php echo $totalMhsP; ?>
                            </td>
                            <td>
                                <?php echo $totalUmumL; ?>
                            </td>
                            <td>
                                <?php echo $totalUmumP; ?>
                            </td>
                            <td>
                                <?php echo $totalPelajarL + $totalPelajarP + $totalMhsL + $totalMhsP + $totalUmumL + $totalUmumP; ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <button class="btn btn-download" onclick=" htmlTableToExcel('xlsx')">Download XLS</button>
            </div>

        </div>
    </div>

    <script>
        function htmlTableToExcel(type, fn, dl) {
            var elt = document.getElementById('tblToExcl');
            var wb = XLSX.utils.table_to_book(elt, { sheet: `data_pegunjung_${tglmulai}-${tglakhir}` });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('data-pengunjung.' + (type || 'xlsx')));
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>