<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Grhatama Pustaka - Input Data</title>
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
                            <a class="nav-link" href="/statistik_perpustakaan/home.php">
                                <h4>Home</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/statistik_perpustakaan/input.php">
                                <h4>Input Data</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/statistik_perpustakaan/list-date.php">
                                <h4>List Data</h4>
                            </a>
                        </li>
                        <a class="nav-link" href="/statistik_perpustakaan/logout.php">
                            <h4>Logout</h4>
                        </a>
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

    <div class="mt-4 flex-container container-fluid bg-dark text-light">
        <div class="ruangan">
            <div>
                <h2>Grhatama Pustaka</h2>
            </div>
            <h4>Lantai Dasar</h4>
            <div class="mr-4">
                <a href="../statistik_perpustakaan/LD/formBukuAnak.php" class="btn btn-bukuanak">Buku Anak</a>
                <a href="../statistik_perpustakaan/LD/formBermain.php" class="btn btn-bermain">Bermain Anak</a>
                <a href="../statistik_perpustakaan/LD/formMusik.php" class="btn btn-musik">Musik Anak</a>
            </div>

            <div class="gab-btn">
                <a href="../statistik_perpustakaan/LD/formMendongeng.php" class="btn btn-mendongeng">Mendongeng</a>
                <a href="../statistik_perpustakaan/LD/formBioskop.php" class="btn btn-bioskop">Bioskop 6D</a>
                <a href="../statistik_perpustakaan/LD/formTandon.php" class="btn btn-tandon">Tandon</a>
            </div>

            <h4>Lantai 1</h4>
            <div class="gab-btn">
                <a href="../statistik_perpustakaan/L1/formKoleksiUmum.php" class="btn btn-umum">Koleksi Umum</a>
                <a href="../statistik_perpustakaan/L1/formBraile.php" class="btn btn-braile">Braille</a>
                <a href="../statistik_perpustakaan/L1/formMajalah.php" class="btn btn-Majalah">Majalah</a>
            </div>

            <h4>Lantai 2</h4>
            <div class="gab-btn">
                <a href="../statistik_perpustakaan/L2/formDigital.php" class="btn btn-digital">Digital</a>
                <a href="../statistik_perpustakaan/L2/formLangka.php" class="btn btn-langka">Langka</a>
                <a href="../statistik_perpustakaan/L2/formReferensi.php" class="btn btn-referensi">Referensi</a>
            </div>

            <div class="gab-btn">
                <a href="../statistik_perpustakaan/L2/formSkripsiBudaya.php" class="btn btn-skripsi">Skripsi &
                    Budaya</a>
                <a href="../statistik_perpustakaan/L2/formAudioVisual.php" class="btn btn-audiovisual">Audio Visual</a>
            </div>

        </div>

        <div class="btn-ruang">
            <div>
                <h2>Jogja Library Center</h2>
            </div>
            <div class="gab-btn">
                <a href="../statistik_perpustakaan/JLC/formJLC.php" class="btn btn-musik">JLC</a>
            </div>
        </div>

        <div class="btn-ruang">
            <div>
                <h2>Rumah Belajar Modern</h2>
            </div>
            <div class="gab-btn">
                <a href="../statistik_perpustakaan/RBM/formRBM.php" class="btn btn-musik">RBM</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>