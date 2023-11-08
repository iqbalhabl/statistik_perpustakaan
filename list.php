<?php
session_start(); // Start session

require 'koneksi.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['tgl_mulai']) || !isset($_GET['tgl_akhir'])) {
    // Variabel tgl_mulai atau tgl_akhir belum ada, arahkan ke list-date.php
    header("Location: list-date.php");
    exit();
}
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
                            <a class="nav-link active" href="/statistik_perpustakaan/list-date.php">
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

    <div class="list">
        <div class="data-pengunjung">
            <div>
                <h1>Data Pengunjung
                    <?php if (isset($_POST['show']) || isset($_POST["rooms"])) {
                        $rooms = $_POST["rooms"];
                        $lastRoom = end($rooms);

                        $newTables = [
                            'ruang_digital' => 'Ruang Digital',
                            'ruang_langka' => 'Ruang Langka',
                            'ruang_audiovisual' => 'Ruang Audio Visual',
                            'ruang_referensi' => 'Ruang Referensi',
                            'ruang_skripsibudaya' => 'Ruang Skripsi Budaya',
                            'ruang_umum' => 'Ruang Umum',
                            'ruang_braile' => 'Ruang Braile',
                            'ruang_majalah' => 'Ruang Majalah',
                            'ruang_bukuanak' => 'Ruang Bukuanak',
                            'ruang_bermain' => 'Ruang Bermain',
                            'ruang_musik' => 'Ruang Musik',
                            'ruang_mendongeng' => 'Ruang Mendongeng',
                            'ruang_bioskop' => 'Ruang Bioskop',
                            'ruang_tandon' => 'Ruang Tandon',
                            'jlc' => 'JLC',
                            'rbm' => 'RBM',
                            'layanan_bprsr' => 'BPRSR',
                            'layanan_bprsw' => 'BPRSW',
                            'layanan_sambantul' => 'Samsat Bantul',
                            'layanan_samkp' => 'Samsat KP',
                            'layanan_kppsleman' => 'KPP Sleman',
                            'layanan_pnyogya' => 'PN Yogya',
                            'layanan_dp3ap2' => 'DP3AP2',
                            'layanan_dpmptsp' => 'DPMPTSP',
                            'layanan_polairud' => 'POLAIRUD',
                            'layanan_tkpkkwido' => 'TK PKK Widodomartani',
                            'layanan_sdjali' => 'SD Jali Prambanan',
                            'layanan_sdsinarmelati' => 'SD Sinar Melati',
                            'layanan_sdpendowoharjo' => 'SD Pendowoharjo',
                            'layanan_sdrejodani' => 'SD Rejodani',
                            'layanan_sdtamanan3' => 'SD Tamanan',
                            'layanan_sdberbah2' => 'SD Berbah',
                            'layanan_sdmurten' => 'SD Murten',
                            'layanan_sdmuhconcat' => 'SD Muhammadiyah Condong',
                            'layanan_tkkalibulus' => 'TK Kalibulus',
                            'layanan_tkpkkpajimatan' => 'TK PKK Pajimatan',
                            'layanan_sdmuhbabakan' => 'SD Muhammadiyah Babakan',
                            'layanan_tkabasutopadan' => 'TK ABA Sutopadan',
                            'layanan_slb1bantul' => 'SLB Bantul',
                            'layanan_mamafasa' => 'MA Mafasa',
                            'layanan_sdngentak' => 'SD Ngentak',
                            'layanan_sdjurugentong' => 'SD Jurugentong',
                            'layanan_sdbunder2' => 'SD Bunder',
                            'layanan_tkabaplembutan' => 'TK ABA Plembutan',
                            'layanan_tkabakarangmojo' => 'TK ABA Karangmojo',
                            'layanan_sdgedangklutuk' => 'SD Gedang Klutuk',
                            'layanan_sdplembutan' => 'SD Plembutan Asri',
                            'layanan_slb1yogya' => 'SLB Yogyakarta',
                            'layanan_smkkoperasi' => 'SMK Koperasi',
                            'layanan_sdnsidakan' => 'SD Sidakan',
                            'layanan_sdsorogenen2' => 'SD Sorogenen',
                            'layanan_kbkasihibu' => 'KB Kasih Ibu',
                            'layanan_mabinbaz' => 'MA Bin Baz',
                            'layanan_brsbkl' => 'BRSBKL',
                            'layanan_rutanwates' => 'Rutan Wates',
                            'layanan_rutanbantul' => 'Rutan Bantul',
                            'layanan_rutankota' => 'Rutan kota',
                            'layanan_lapaswiro' => 'Lapas Wirogunan',
                            'layanan_lapascebong' => 'Lapas Cebongan',
                            'layanan_lapaswono' => 'Lapas Wonosari',
                            'layanan_lapasnarko' => 'Lapas Narkotika',
                            'layanan_ponpespes' => 'PONPES Pesawat',
                            'layanan_panurul' => 'PA Nurul Haq',
                            'layanan_spsmanggis' => 'SPS Manggis',
                            'layanan_bprswgodean' => 'BPRSW Godean',
                            'layanan_huntapkarang' => 'Huntap Karang Kendal',
                            'layanan_brspabimo' => 'BRSPA Bimomartani',
                            'layanan_brspabudhi' => 'BRSPA Budhi Bakti',
                            'layanan_ponpesibnul' => 'PONPES Ibnul Qoyyim',
                            'layanan_brtpdpundong' => 'BRTPD Pundong Bantul',
                            'layanan_do' => 'Delivery Order',
                            'layanan_smpn1paliyan' => 'SMPN Paliyan',
                            'layanan_smpn3sentolo' => 'SMPN Sentolo',
                            'layanan_sdmsleman' => 'SD Model Sleman',
                            'layanan_smkpariwisata' => 'SMK Pariwisata',
                            'layanan_smpn3gamping' => 'SMPN Gamping',
                            'layanan_smpn2pundong' => 'SMPN Pundong',
                            'layanan_sdtimuran' => 'SD Timuran',
                            'layanan_sman1lendah' => 'SMAN Lendah',
                            'layanan_sdmujahidin' => 'SD Mujahidin',
                            'layanan_smpn6yogyakarta' => 'SMPN Yogyakarta',
                            'layanan_ig' => 'Instagram',
                            'layanan_twitter' => 'Twitter',
                            'layanan_fb' => 'Facebook',
                            'layanan_tiktok' => 'Tiktok',
                            'layanan_youtube' => 'Youtube',
                            'layanan_webinar' => 'Webinar',
                            'layanan_webbalai' => 'Website Balai Yanpus',
                            'layanan_webcoe' => 'Website COE',
                            'layanan_ijogja' => 'IJogja'
                        ];


                        foreach ($rooms as $room) {
                            if ($room === $lastRoom) {
                                $selectedNewTables = $newTables[$room];
                                echo $selectedNewTables;
                            } else {
                                $selectedNewTables = $newTables[$room];
                                echo "$selectedNewTables, ";
                            }
                        }
                    } ?>
                </h1>
            </div>

            <?php
            // Inisialisasi variabel rooms yang akan digunakan untuk menyimpan status checkbox yang dipilih
            $selectedRooms = [];

            // Cek apakah formulir telah dikirim (tombol "Tampilkan tabel" diklik)
            if (isset($_POST['show'])) {
                // Periksa apakah checkbox tertentu dipilih dan simpan dalam variabel $selectedRooms
                if (isset($_POST['rooms'])) {
                    $selectedRooms = $_POST['rooms'];
                }
            }

            // Fungsi untuk memeriksa apakah checkbox tertentu harus ditandai
            function isRoomSelected($roomValue, $selectedRooms)
            {
                return in_array($roomValue, $selectedRooms) ? 'checked' : '';
            }
            ?>

            <!-- checkbox start -->
            <div class="filter_data">
                <form action="" method="post">
                    <!-- checklist start -->

                    <div class="container-fluid custom-width float-start">
                        <div class="row">
                            <div class="col">
                                <label for="pilihRuang">Pilih ruang :</label>
                            </div>
                            <div class="w-100 d-none d-md-block"></div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_digital"
                                        id="flexCheckDefault" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ruang_digital', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ruang Digital
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_langka"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ruang_langka', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Langka
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="ruang_audiovisual" id="flexCheckChecked"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('ruang_audiovisual', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Audio Visual
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="ruang_referensi" id="flexCheckChecked"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('ruang_referensi', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Referensi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="ruang_skripsibudaya" id="flexCheckChecked"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('ruang_skripsibudaya', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Skripsi Budaya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_umum"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ruang_umum', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Umum
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_braile"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ruang_braile', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Braille
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_majalah"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ruang_majalah', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Majalah
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="ruang_bukuanak" id="flexCheckChecked"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('ruang_bukuanak', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Buku Anak
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_bermain"
                                        id="flexCheckChecked" <?= isRoomSelected('ruang_bermain', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Bermain
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_musik"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ruang_musik', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Musik
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_mendongeng" 
                                    id="flexCheckChecked" onclick="limitCheckboxSelections(2)" 
                                        <?= isRoomSelected('ruang_mendongeng', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Mendongeng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_bioskop"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ruang_bioskop', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Bioskop
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_tandon"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ruang_tandon', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Tandon
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="jlc"
                                        id="flexCheckDefault" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('jlc', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        JLC
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="rbm"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('rbm', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        RBM
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_bprsr"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_bprsr', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BPRSR
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_bprsw"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_bprsw', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BPRSW
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sambantul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sambantul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Samsat Bantul
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_samkp"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_samkp', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Samsat KP
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_kppsleman"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_kppsleman', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        KPP Sleman
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_pnyogya"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_pnyogya', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        PN Yogya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_dp3ap2"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_dp3ap2', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        DP3AP2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_dpmptsp"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_dpmptsp', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        DPMPTSP
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_polairud"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_polairud', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        POLAIRUD
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_tkpkkwido"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_tkpkkwido', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK PKK Widodomartani
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdjali"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdjali', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Jali Prambanan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdsinarmelati"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdsinarmelati', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Sinar Melati
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdpendowoharjo"
                                        id="flexCheckDefault" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdpendowoharjo', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        SD Pendowoharjo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdrejodani"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdrejodani', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Rejodani
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdtamanan3"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdtamanan3', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Tamanan 3 Kalasan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdberbah2"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdberbah2', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Berbah 2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdmurten"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdmurten', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Murten
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdmuhconcat"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdmuhconcat', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Muhammadiyah Condong catur
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_tkkalibulus"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_tkkalibulus', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK Kalibulus
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_tkpkkpajimatan" 
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)" 
                                        <?= isRoomSelected('layanan_tkpkkpajimatan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK PKK Pajimatan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdmuhbabakan"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdmuhbabakan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Muhammadiyah Babakan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_tkabasutopadan" 
                                    id="flexCheckChecked" onclick="limitCheckboxSelections(2)" 
                                        <?= isRoomSelected('layanan_tkabasutopadan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK ABA Sutopadan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_slb1bantul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_slb1bantul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SLB 1 Bantul
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_mamafasa"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_mamafasa', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        MA Mafasa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdngentak"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdngentak', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Ngentak Banguntapan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdjurugentong" 
                                    id="flexCheckChecked" onclick="limitCheckboxSelections(2)" 
                                        <?= isRoomSelected('layanan_sdjurugentong', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Jurugentong
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdbunder2"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdbunder2', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Bunder 2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_tkabaplembutan" 
                                        id="flexCheckDefault" onclick="limitCheckboxSelections(2)" 
                                        <?= isRoomSelected('layanan_tkabaplembutan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        TK ABA Plembutan Asri
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_tkabakarangmojo"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_tkabakarangmojo', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK ABA Karangmojo 1
                                    </label>
                                </div>


                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdgedangklutuk"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdgedangklutuk', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Gedang Klutuk
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdplembutan"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdplembutan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Plembutan Asri
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_slb1yogya"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_slb1yogya', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SLB 1 Yogyakarta
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_smkkoperasi"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_smkkoperasi', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMK Koperasi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdnsidakan"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdnsidakan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Negeri Sidakan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdsorogenen2"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdsorogenen2', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Sorogenen 2 Kalasan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_kbkasihibu"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_kbkasihibu', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        KB Kasih Ibu
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_mabinbaz"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_mabinbaz', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        MA Bin Baz
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_brsbkl"
                                        id="flexCheckDefault" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_brsbkl', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        BRSBKL
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_rutanwates"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_rutanwates', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Rutan Wates
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_rutanbantul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_rutanbantul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Rutan Bantul
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_rutankota"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_rutankota', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Rutan kota
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_lapaswiro"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_lapaswiro', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Lapas Wirogunan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_lapascebong"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_lapascebong', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Lapas Cebongan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_lapaswono"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_lapaswono', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Lapas Wonosari
                                    </label>
                                </div>


                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_lapasnarko"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_lapasnarko', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Lapas Narkotika
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_ponpespes"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_ponpespes', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        PONPES Pesawat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_panurul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_panurul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        PA Nurul Haq
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_spsmanggis"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_spsmanggis', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SPS Manggis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_bprswgodean"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_bprswgodean', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BPRSW Godean
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_huntapkarang"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_huntapkarang', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Huntap Karang Kendal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_brspabimo"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_brspabimo', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BRSPA Bimomartani
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_brspabudhi"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_brspabudhi', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BRSPA Budhi Bakti
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_ponpesibnul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_ponpesibnul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        PONPES Ibnul Qoyyim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_brtpdpundong"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_brtpdpundong', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BRTPD Pundong Bantul
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_do"
                                        id="flexCheckDefault" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_do', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Delivery Order
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_smpn1paliyan"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_smpn1paliyan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 1 Paliyan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_smpn3sentolo"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_smpn3sentolo', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 3 Sentolo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdmsleman"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdmsleman', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Model Sleman
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_smkpariwisata" 
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)" 
                                        <?= isRoomSelected('layanan_smkpariwisata', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMK Pariwisata
                                    </label>
                                </div>



                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_smpn3gamping"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_smpn3gamping', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 3 Gamping
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_smpn2pundong"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_smpn2pundong', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 2 Pundong
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdtimuran"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdtimuran', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Timuran
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sman1lendah"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sman1lendah', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMAN 1 Lendah
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_sdmujahidin"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_sdmujahidin', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Mujahidin
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_smpn6yogyakarta"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_smpn6yogyakarta', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 6 Yogyakarta
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_ig"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_ig', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Instagram
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_twitter"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_twitter', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Twitter
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_fb"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_fb', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Facebook
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_tiktok"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_tiktok', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Tiktok
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_youtube"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_youtube', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Youtube
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_webinar"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_webinar', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Webinar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_webbalai"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_webbalai', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Website Balai Yanpus
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="layanan_webcoe"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('layanan_webcoe', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Web COE
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ijogja"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ijogja', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        I Jogja
                                    </label>
                                </div>
                            </div>
                            <div class="w-100 d-none d-md-block"></div>
                            <div class="col">
                                <button class='btn btn-show' type="submit" name="show"
                                    >Tampilkan tabel</button>
                                <p class="warning-text" id="checkboxWarning" style="color: red;"></p>
                            </div>
                        </div>    
                    </div>
                </form>
            </div>

            <!-- checklist ended -->
            <!-- checkbox end -->
            <script>
                // Fungsi untuk membatasi jumlah checkbox yang dapat dicentang
                function limitCheckboxSelections(maxLimit) {
                    var checkboxes = document.querySelectorAll('input[name="rooms[]"]:checked');
                    var warningMessage = document.getElementById('checkboxWarning');

                    if (checkboxes.length > maxLimit) {
                        // Nonaktifkan checkbox yang tidak dapat dicentang
                        document.querySelectorAll('input[name="rooms[]"]:not(:checked)').forEach(function (checkbox) {
                            checkbox.disabled = true;
                        });

                        // Tampilkan pesan peringatan
                        warningMessage.innerText = "Anda hanya dapat memilih maksimal 3 ruang!";
                    } else {
                        // Aktifkan kembali checkbox yang sebelumnya nonaktif
                        document.querySelectorAll('input[name="rooms[]"]:not(:checked)').forEach(function (checkbox) {
                            checkbox.disabled = false;
                        });

                        // Hapus pesan peringatan
                        warningMessage.innerText = "";
                    }
                }
            </script>

            <?php
            $tgl_mulai_awal = $_GET['tgl_mulai'];
            $tgl_akhir_awal = $_GET['tgl_akhir'];

            $tgl_mulai = date('d-m-Y', strtotime($tgl_mulai_awal));
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir_awal));

            if (isset($_POST['show'])) {
                if (sizeof($rooms) == 3) {
                    $query1 = "SELECT * FROM $rooms[0] WHERE tanggal BETWEEN '$tgl_mulai_awal' AND '$tgl_akhir_awal'";
                    $query2 = "SELECT * FROM $rooms[1] WHERE tanggal BETWEEN '$tgl_mulai_awal' AND '$tgl_akhir_awal'";
                    $query3 = "SELECT * FROM $rooms[2] WHERE tanggal BETWEEN '$tgl_mulai_awal' AND '$tgl_akhir_awal'";

                    $result1 = mysqli_query($conn, $query1);
                    $result2 = mysqli_query($conn, $query2);
                    $result3 = mysqli_query($conn, $query3);
                } else if (sizeof($rooms) == 2) {
                    $query1 = "SELECT * FROM $rooms[0] WHERE tanggal BETWEEN '$tgl_mulai_awal' AND '$tgl_akhir_awal'";
                    $query2 = "SELECT * FROM $rooms[1] WHERE tanggal BETWEEN '$tgl_mulai_awal' AND '$tgl_akhir_awal'";

                    $result1 = mysqli_query($conn, $query1);
                    $result2 = mysqli_query($conn, $query2);
                } else if (sizeof($rooms) == 1) {
                    $query1 = "SELECT * FROM $rooms[0] WHERE tanggal BETWEEN '$tgl_mulai_awal' AND '$tgl_akhir_awal'";

                    $result1 = mysqli_query($conn, $query1);
                } else {
                    $query1 = "SELECT * FROM ruang_digital WHERE tanggal BETWEEN '$tgl_mulai_awal' AND '$tgl_akhir_awal'";

                    $result1 = mysqli_query($conn, $query1);
                }
            }
            ?>

            <div class="tgl">
                <b>
                    <?= "Data dari tanggal $tgl_mulai - $tgl_akhir"; ?>
                </b>
            </div>

            <div class="list-table">
                <table id="tblToExcl">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" rowspan="2">No.</th>
                            <th scope="col" rowspan="2">Tanggal</th>
                            <th scope="col" colspan="2">Pelajar</th>
                            <th scope="col" colspan="2">Mahasiswa</th>
                            <th scope="col" colspan="2">Umum</th>
                            <th scope="col" rowspan="2">Jumlah</th>
                            <th scope="col" rowspan="2">Keterangan</th>
                            <th scope="col" rowspan="2">Edit</th>
                            <th scope="col" rowspan="2">Delete</th>
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

                        if (isset($result1)) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                echo "<tr>";
                                echo "<td>" . $count . "</td>"; // Menampilkan angka urutan
                                echo "<td>" . $row['tanggal'] . "</td>";
                                echo "<td>" . $row['pelajarL'] . "</td>";
                                echo "<td>" . $row['pelajarP'] . "</td>";
                                echo "<td>" . $row['mhsL'] . "</td>";
                                echo "<td>" . $row['mhsP'] . "</td>";
                                echo "<td>" . $row['umumL'] . "</td>";
                                echo "<td>" . $row['umumP'] . "</td>";

                                $throw = date('d-m-Y', strtotime($row['tanggal']));
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

                                switch ($rooms[0]) {
                                    case "ruang_digital":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpDigital.php'>";
                                        break;
                                    case "ruang_langka":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpLangka.php'>";
                                        break;
                                    case "ruang_audiovisual":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpAV.php'>";
                                        break;
                                    case "ruang_referensi":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpReferensi.php'>";
                                        break;
                                    case "ruang5":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpSkripsiBudaya.php'>";
                                        break;
                                    case "ruang6":
                                        echo "<form method='post' action='/statistik_perpustakaan/L1/formUpUmum.php'>";
                                        break;
                                    case "ruang7":
                                        echo "<form method='post' action='/statistik_perpustakaan/L1/formUpBraile.php'>";
                                        break;
                                    case "ruang8":
                                        echo "<form method='post' action='/statistik_perpustakaan/L1/formUpMajalah.php'>";
                                        break;
                                    case "ruang9":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpBukuAnak.php'>";
                                        break;
                                    case "ruang_bermain":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpBermain.php'>";
                                        break;
                                    case "ruang_musik":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpMusik.php'>";
                                        break;
                                    case "ruang_mendongeng":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpMendongeng.php'>";
                                        break;
                                    case "ruang_bioskop":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpBioskop.php'>";
                                        break;
                                    case "ruang_tandon":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpTandon.php'>";
                                        break;
                                    case "jlc":
                                        echo "<form method='post' action='/statistik_perpustakaan/JLC/formUpMJLC.php'>";
                                        break;
                                    case "rbm":
                                        echo "<form method='post' action='/statistik_perpustakaan/RBM/formUpRBM.php'>";
                                        break;
                                    default:
                                        echo "<form method='post' action='dashboard.php'>";
                                }

                                // Edit Button
                                if (isset($rooms[0])) {
                                    $selectedNewTables = $newTables[$rooms[0]];
                                    echo "<td>" . $selectedNewTables . "</td>";
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

                                // Delete Button
                                echo "<td>";
                                echo "<form method='post' action='delete.php'>";
                                echo "<input type='hidden' name='tanggal' value='" . $throw . "'>";
                                echo "<input type='hidden' name='ruang' value='" . $rooms[0] . "'>";
                                echo "<button type='submit' class='btn btn-delete' data-toggle='modal'>Delete</button>";
                                echo "</form>";
                                echo "</td>";

                                echo "</tr>";

                                $count++;
                            }
                        }

                        if (isset($result2)) {
                            while ($row = mysqli_fetch_assoc($result2)) {
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

                                switch ($rooms[1]) {
                                    case "ruang_digital":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpDigital.php'>";
                                        break;
                                    case "ruang_langka":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpLangka.php'>";
                                        break;
                                    case "ruang_audiovisual":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpAV.php'>";
                                        break;
                                    case "ruang_referensi":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpReferensi.php'>";
                                        break;
                                    case "ruang5":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpSkripsiBudaya.php'>";
                                        break;
                                    case "ruang6":
                                        echo "<form method='post' action='/statistik_perpustakaan/L1/formUpUmum.php'>";
                                        break;
                                    case "ruang7":
                                        echo "<form method='post' action='/statistik_perpustakaan/L1/formUpBraile.php'>";
                                        break;
                                    case "ruang8":
                                        echo "<form method='post' action='/statistik_perpustakaan/L1/formUpMajalah.php'>";
                                        break;
                                    case "ruang9":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpBukuAnak.php'>";
                                        break;
                                    case "ruang_bermain":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpBermain.php'>";
                                        break;
                                    case "ruang_musik":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpMusik.php'>";
                                        break;
                                    case "ruang_mendongeng":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpMendongeng.php'>";
                                        break;
                                    case "ruang_bioskop":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpBioskop.php'>";
                                        break;
                                    case "ruang_tandon":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpTandon.php'>";
                                        break;
                                    case "jlc":
                                        echo "<form method='post' action='/statistik_perpustakaan/JLC/formUpMJLC.php'>";
                                        break;
                                    case "rbm":
                                        echo "<form method='post' action='/statistik_perpustakaan/RBM/formUpRBM.php'>";
                                        break;
                                    default:
                                        echo "<form method='post' action='dashboard.php'>";
                                }

                                if (isset($rooms[1])) {
                                    echo "<td>";
                                    $selectedNewTables = $newTables[$rooms[1]];
                                    echo $selectedNewTables;
                                    echo "</td>";
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
                                echo "<form method='post' action='delete.php'>";
                                echo "<input type='hidden' name='tanggal' value='" . $throw . "'>";
                                echo "<input type='hidden' name='ruang' value='" . $rooms[1] . "'>";
                                echo "<button type='submit' class='btn btn-delete' data-toggle='modal'>Delete</button>";
                                echo "</form>";
                                echo "</td>";

                                echo "</tr>";

                                $count++;
                            }
                        }

                        if (isset($result3)) {
                            while ($row = mysqli_fetch_assoc($result3)) {
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

                                switch ($rooms[2]) {
                                    case "ruang_digital":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpDigital.php'>";
                                        break;
                                    case "ruang_langka":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpLangka.php'>";
                                        break;
                                    case "ruang_audiovisual":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpAV.php'>";
                                        break;
                                    case "ruang_referensi":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpReferensi.php'>";
                                        break;
                                    case "ruang5":
                                        echo "<form method='post' action='/statistik_perpustakaan/L2/formUpSkripsiBudaya.php'>";
                                        break;
                                    case "ruang6":
                                        echo "<form method='post' action='/statistik_perpustakaan/L1/formUpUmum.php'>";
                                        break;
                                    case "ruang7":
                                        echo "<form method='post' action='/statistik_perpustakaan/L1/formUpBraile.php'>";
                                        break;
                                    case "ruang8":
                                        echo "<form method='post' action='/statistik_perpustakaan/L1/formUpMajalah.php'>";
                                        break;
                                    case "ruang9":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpBukuAnak.php'>";
                                        break;
                                    case "ruang_bermain":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpBermain.php'>";
                                        break;
                                    case "ruang_musik":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpMusik.php'>";
                                        break;
                                    case "ruang_mendongeng":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpMendongeng.php'>";
                                        break;
                                    case "ruang_bioskop":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpBioskop.php'>";
                                        break;
                                    case "ruang_tandon":
                                        echo "<form method='post' action='/statistik_perpustakaan/LD/formUpTandon.php'>";
                                        break;
                                    case "jlc":
                                        echo "<form method='post' action='/statistik_perpustakaan/JLC/formUpMJLC.php'>";
                                        break;
                                    case "rbm":
                                        echo "<form method='post' action='/statistik_perpustakaan/RBM/formUpRBM.php'>";
                                        break;
                                    default:
                                        echo "<form method='post' action='dashboard.php'>";
                                }

                                if (isset($rooms[2])) {
                                    echo "<td>";
                                    $selectedNewTables = $newTables[$rooms[2]];
                                    echo $selectedNewTables;
                                    echo "</td>";
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
                                echo "<form method='post' action='delete.php'>";
                                echo "<input type='hidden' name='tanggal' value='" . $throw . "'>";
                                echo "<input type='hidden' name='ruang' value='" . $rooms[2] . "'>";
                                echo "<button type='submit' class='btn btn-delete' data-toggle='modal'>Delete</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";

                                $count++;
                            }
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
                <button class="btn btn-download" onclick="htmlTableToExcel('xlsx', null, false);
">Download XLS</button>
            </div>

        </div>
    </div>

    <!-- xlsx download script -->

    <script>
        function htmlTableToExcel(type, fn, dl) {
            var elt = document.getElementById('tblToExcl');
            var sheetName = `data_pengunjung`;
            var wb = XLSX.utils.table_to_book(elt, { sheet: sheetName });
            var fileName = `data_pengunjung.${type || 'xlsx'}`;
            return dl ? XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) : XLSX.writeFile(wb, fn || fileName);
        }
    </script>


    <!-- xlsx download script -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>