<?php
session_start(); // Start session

require 'koneksi.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
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
                            'bprsr' => 'BPRSR',
                            'bprsw' => 'BPRSW',
                            'samsat_bantul' => 'Samsat Bantul',
                            'samsat_kp' => 'Samsat KP',
                            'kpp_sleman' => 'KPP Sleman',
                            'pn_yogya' => 'PN Yogya',
                            'dp3ap2' => 'DP3AP2',
                            'dpmptsp' => 'DPMPTSP',
                            'polairud' => 'POLAIRUD',
                            'tk_pkkwido' => 'TK PKK Widodomartani',
                            'sd_jali' => 'SD Jali Prambanan',
                            'sd_sinar' => 'SD Sinar Melati',
                            'sd_pendowo' => 'SD Pendowoharjo',
                            'sd_rejodani' => 'SD Rejodani',
                            'sd_tamanan' => 'SD Tamanan',
                            'sd_berbah' => 'SD Berbah',
                            'sd_murten' => 'SD Murten',
                            'sd_muhconcat' => 'SD Muhammadiyah Condong',
                            'tk_kalibulus' => 'TK Kalibulus',
                            'tk_pkkpajimatan' => 'TK PKK Pajimatan',
                            'sd_muhbabakan' => 'SD Muhammadiyah Babakan',
                            'tk_abasutopadan' => 'TK ABA Sutopadan',
                            'slb_bantul' => 'SLB Bantul',
                            'ma_mafasa' => 'MA Mafasa',
                            'sd_ngentak' => 'SD Ngentak',
                            'sd_jurugentong' => 'SD Jurugentong',
                            'sd_bunder' => 'SD Bunder',
                            'tk_abaplembutan' => 'TK ABA Plembutan',
                            'tk_abakarang' => 'TK ABA Karangmojo',
                            'sd_gedang' => 'SD Gedang Klutuk',
                            'sd_plembutan' => 'SD Plembutan Asri',
                            'slb_yogya' => 'SLB Yogyakarta',
                            'smk_koperasi' => 'SMK Koperasi',
                            'sd_sidakan' => 'SD Sidakan',
                            'sd_sorogenen' => 'SD Sorogenen',
                            'kb_kasihibu' => 'KB Kasih Ibu',
                            'ma_binbaz' => 'MA Bin Baz',
                            'brsbkl' => 'BRSBKL',
                            'rutan_wates' => 'Rutan Wates',
                            'rutan_bantul' => 'Rutan Bantul',
                            'rutan_kota' => 'Rutan kota',
                            'lapas_wiro' => 'Lapas Wirogunan',
                            'lapas_cebong' => 'Lapas Cebongan',
                            'lapas_wono' => 'Lapas Wonosari',
                            'lapas_narko' => 'Lapas Narkotika',
                            'ponpes_pes' => 'PONPES Pesawat',
                            'pa_nurul' => 'PA Nurul Haq',
                            'sps_manggis' => 'SPS Manggis',
                            'bprsw_godean' => 'BPRSW Godean',
                            'huntap_karang' => 'Huntap Karang Kendal',
                            'brspa_bimo' => 'BRSPA Bimomartani',
                            'brspa_budhi' => 'BRSPA Budhi Bakti',
                            'ponpes_ibnul' => 'PONPES Ibnul Qoyyim',
                            'brtpd_pundong' => 'BRTPD Pundong Bantul',
                            'do' => 'Delivery Order',
                            'smpn_paliyan' => 'SMPN Paliyan',
                            'smpn_sentolo' => 'SMPN Sentolo',
                            'sdm_sleman' => 'SD Model Sleman',
                            'smk_pariwisata' => 'SMK Pariwisata',
                            'smpn_gamping' => 'SMPN Gamping',
                            'smpn_pundong' => 'SMPN Pundong',
                            'sd_timuran' => 'SD Timuran',
                            'sman_lendah' => 'SMAN Lendah',
                            'sd_mujahidin' => 'SD Mujahidin',
                            'smpn_yogya' => 'SMPN Yogyakarta',
                            'ig' => 'Instagram',
                            'twitter' => 'Twitter',
                            'fb' => 'Facebook',
                            'tt' => 'Tiktok',
                            'yt' => 'Youtube',
                            'webinar' => 'Webinar',
                            'web_balai' => 'Website Balai Yanpus',
                            'web_coe' => 'Website COE',
                            'ijogja' => 'IJogja'
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
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="ruang_mendongeng" id="flexCheckChecked"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('ruang_mendongeng', $selectedRooms) ?>>
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
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ruang_digital"
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
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="bprsr"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('bprsr', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BPRSR
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="bprsw"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('bprsw', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BPRSW
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="samsat_bantul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('samsat_bantul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Samsat Bantul
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="samsat_kp"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('samsat_kp', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Samsat KP
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="kpp_sleman"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('kpp_sleman', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        KPP Sleman
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="pn_yogya"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('pn_yogya', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        PN Yogya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="dp3ap2"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('dp3ap2', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        DP3AP2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="dpmptsp"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('dpmptsp', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        DPMPTSP
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="polairud"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('polairud', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        POLAIRUD
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="tk_pkkwido"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('tk_pkkwido', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK PKK Widodomartani
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_jali"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_jali', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Jali Prambanan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_sinar"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_sinar', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Sinar Melati
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_pendowo"
                                        id="flexCheckDefault" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_pendowo', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        SD Pendowoharjo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_rejodani"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_rejodani', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Rejodani
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_tamanan"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_tamanan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Tamanan 3 Kalasan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_berbah"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_berbah', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Berbah 2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_murten"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_murten', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Murten
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_muhconcat"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_muhconcat', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Muhammadiyah Condong catur
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="tk_kalibulus"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('tk_kalibulus', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK Kalibulus
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="tk_pkkpajimatan" id="flexCheckChecked"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('tk_pkkpajimatan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK PKK Pajimatan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_muhbabakan"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_muhbabakan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Muhammadiyah Babakan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="tk_abasutopadan" id="flexCheckChecked"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('tk_abasutopadan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK ABA Sutopadan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="slb_bantul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('slb_bantul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SLB 1 Bantul
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ma_mafasa"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ma_mafasa', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        MA Mafasa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_ngentak"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_ngentak', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Ngentak Banguntapan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="sd_jurugentong" id="flexCheckChecked"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('sd_jurugentong', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Jurugentong
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_bunder"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_bunder', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Bunder 2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="tk_abaplembutan" id="flexCheckDefault"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('tk_abaplembutan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        TK ABA Plembutan Asri
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="tk_abakarang"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('tk_abakarang', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        TK ABA Karangmojo 1
                                    </label>
                                </div>


                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_gedang"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_gedang', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Gedang Klutuk
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_plembutan"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_plembutan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Plembutan Asri
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="slb_yogya"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('slb_yogya', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SLB 1 Yogyakarta
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="smk_koperasi"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('smk_koperasi', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMK Koperasi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_sidakan"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_sidakan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Negeri Sidakan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_sorogenen"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_sorogenen', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Sorogenen 2 Kalasan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="kb_kasihibu"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('kb_kasihibu', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        KB Kasih Ibu
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ma_binbaz"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ma_binbaz', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        MA Bin Baz
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="brsbkl"
                                        id="flexCheckDefault" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('brsbkl', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        BRSBKL
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="rutan_wates"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('rutan_wates', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Rutan Wates
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="rutan_bantul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('rutan_bantul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Rutan Bantul
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="rutan_kota"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('rutan_kota', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Rutan kota
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="lapas_wiro"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('lapas_wiro', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Lapas Wirogunan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="lapas_cebong"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('lapas_cebong', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Lapas Cebongan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="lapas_wono"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('lapas_wono', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Lapas Wonosari
                                    </label>
                                </div>


                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="lapas_narko"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('lapas_narko', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Lapas Narkotika
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ponpes_pes"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ponpes_pes', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        PONPES Pesawat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="pa_nurul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('pa_nurul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        PA Nurul Haq
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sps_manggis"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sps_manggis', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SPS Manggis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="bprsw_godean"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('bprsw_godean', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BPRSW Godean
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="huntap_karang"
                                        id="flexCheckChecked" <?= isRoomSelected('huntap_karang', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Huntap Karang Kendal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="brspa_bimo"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('brspa_bimo', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BRSPA Bimomartani
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="brspa_budhi"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('brspa_budhi', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BRSPA Budhi Bakti
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ponpes_ibnul"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ponpes_ibnul', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        PONPES Ibnul Qoyyim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="brtpd_pundong"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('brtpd_pundong', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        BRTPD Pundong Bantul
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="do"
                                        id="flexCheckDefault" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('do', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Delivery Order
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="smpn_paliyan"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('smpn_paliyan', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 1 Paliyan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="smpn_sentolo"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('smpn_sentolo', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 3 Sentolo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sdm_sleman"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sdm_sleman', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Model Sleman
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox"
                                        value="smk_pariwisata" id="flexCheckChecked"
                                        onclick="limitCheckboxSelections(2)" <?= isRoomSelected('smk_pariwisata', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMK Pariwisata
                                    </label>
                                </div>



                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="smpn_gamping"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('smpn_gamping', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 3 Gamping
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="smpn_pundong"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('smpn_pundong', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 2 Pundong
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_timuran"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_timuran', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Timuran
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sman_lendah"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sman_lendah', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMAN 1 Lendah
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="sd_mujahidin"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('sd_mujahidin', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SD Mujahidin
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="smpn_yogya"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('smpn_yogya', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        SMPN 6 Yogyakarta
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="ig"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('ig', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Instagram
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="twitter"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('twitter', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Twitter
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="fb"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('fb', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Facebook
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="tt"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('tt', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Tiktok
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="yt"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('yt', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Youtube
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="webinar"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('webinar', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Webinar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="web_balai"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('web_balai', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Website Balai Yanpus
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="rooms[]" type="checkbox" value="web_coe"
                                        id="flexCheckChecked" onclick="limitCheckboxSelections(2)"
                                        <?= isRoomSelected('web_coe', $selectedRooms) ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Ruang Tandon
                                    </label>
                                </div>
                            </div>
                            <div class="w-100 d-none d-md-block"></div>
                            <div class="col">
                                <button class='btn btn-show' type="submit" name="show"
                                    onclick='limitCheckboxSelections(2)'>Tampilkan tabel</button>
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
            $tgl_mulai = $_GET['tgl_mulai'];
            $tgl_akhir = $_GET['tgl_akhir'];

            $tgl_mulai = date('d-m-Y', strtotime($tgl_mulai));
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));

            if (isset($_POST['show'])) {
                if (sizeof($rooms) == 3) {
                    $query1 = "SELECT * FROM $rooms[0]";
                    $query2 = "SELECT * FROM $rooms[1]";
                    $query3 = "SELECT * FROM $rooms[2]";

                    // echo "query1 : $query1";
                    // echo "query2 : $query2";
                    // echo "query3 : $query3";
            
                    $result1 = mysqli_query($conn, $query1);
                    $result2 = mysqli_query($conn, $query2);
                    $result3 = mysqli_query($conn, $query3);
                } else if (sizeof($rooms) == 2) {
                    $query1 = "SELECT * FROM $rooms[0]";
                    $query2 = "SELECT * FROM $rooms[1]";

                    // echo "query1 : $query1";
                    // echo "query2 : $query2";
            
                    $result1 = mysqli_query($conn, $query1);
                    $result2 = mysqli_query($conn, $query2);
                } else if (sizeof($rooms) == 1) {
                    $query1 = "SELECT * FROM $rooms[0]";

                    // echo "query1 : $query1";
            
                    $result1 = mysqli_query($conn, $query1);
                } else {
                    $query1 = "SELECT * FROM ruang_digital";

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
                            <th scope="col" rowspan="2">#</th>
                            <th scope="col" rowspan="2">Tanggal</th>
                            <th scope="col" colspan="2">Pelajar</th>
                            <th scope="col" colspan="2">Mahasiswa</th>
                            <th scope="col" colspan="2">Umum</th>
                            <th scope="col" rowspan="2">Jumlah</th>
                            <th scope="col" rowspan="2">Keterangan</th>
                            <th scope="col" rowspan="2">Actions</th>
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