<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

    <div class="mt-4 flex-container container-fluid bg-dark text-light" class="dropdownAllruangan">
        <div class="ruangan">
            <div>
                <h2>Grhatama Pustaka</h2>
            </div>
            <h4>Lantai Dasar</h4>
            <div class="mr-4">
                <form name="webpage">
                    <select name="statistikLD" id="statistikLD">
                        <option value="#" disabled selected>Pilihan Lantai Dasar</option>
                        <option value="../statistik_perpustakaan/LD/formBukuAnak.php">Buku Anak</option>
                        <option value="../statistik_perpustakaan/LD/formBermain.php">Bermain Anak</option>
                        <option value="../statistik_perpustakaan/LD/formMusik.php">Musik Anak</option>
                        <option value="../statistik_perpustakaan/LD/formMendongeng.php">Mendongeng</option>
                        <option value="../statistik_perpustakaan/LD/formBioskop.php">Bioskop 6D</option>
                        <option value="../statistik_perpustakaan/LD/formTandon.php">Tandon</option>
                    </select>
                </form>
            </div>

            <h4>Lantai 1</h4>
            <div class="gab-btn">
                <form name="webpage">
                    <select name="statistikL1" id="statistikL1">
                        <option value="#" disabled selected>Pilihan Lantai 1</option>
                        <option value="../statistik_perpustakaan/L1/formKoleksiUmum.php">Koleksi Umum</option>
                        <option value="../statistik_perpustakaan/L1/formBraile.php">Braille</option>
                        <option value="../statistik_perpustakaan/L1/formMajalah.php">Majalah</option>
                    </select>
                </form>
            </div>

            <h4>Lantai 2</h4>
            <div class="gab-btn">
                <form name="webpage">
                    <select name="statistikL2" id="statistikL2">
                        <option value="#" disabled selected>Pilihan Lantai 2</option>
                        <option value="../statistik_perpustakaan/L2/formDigital.php">Digital</option>
                        <option value="../statistik_perpustakaan/L2/formLangka.php">Langka</option>
                        <option value="../statistik_perpustakaan/L2/formReferensi.php">Referensi</option>
                        <option value="../statistik_perpustakaan/L2/formSkripsiBudaya.php">Skripsi & Budaya</option>
                        <option value="../statistik_perpustakaan/L2/formAudioVisual.php">Audio Visual</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="btn-ruang">
            <div>
                <h2>Jogja Library Center</h2>
            </div>
            <div class="gab-btn">
                <form name="webpage">
                    <select name="statistikJLC" id="statistikJLC">
                        <option value="#" disabled selected>Pilihan JLC</option>
                        <option value="../statistik_perpustakaan/JLC/formJLC.php">JLC</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="btn-ruang">
            <div>
                <h2>Rumah Belajar Modern</h2>
            </div>
            <div class="gab-btn">
                <form name="webpage">
                    <select name="statistikRBM" id="statistikRBM">
                        <option value="#" disabled selected>Pilihan Rumah Belajar Modern</option>
                        <option value="../statistik_perpustakaan/RBM/formRBM.php">RBM</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="btn-ruang">
            <div>
                <h2>Pojok Baca</h2>
            </div>
            <div class="gab-btn">
                <form name="webpage">
                    <select name="statistikPojokBaca" id="statistikPojokBaca">
                        <option value="#" disabled selected>Pilihan Lokasi Pojok Baca</option>
                        <option value="#">BPRSR</option>
                        <option value="#">BPRSW</option>
                        <option value="#">Samsat Bantul</option>
                        <option value="#">Samsat KP</option>
                        <option value="#">KPP sleman</option>
                        <option value="#">PN Yogya</option>
                        <option value="#">DP3AP2</option>
                        <option value="#">DPMPTSP</option>
                        <option value="#">POLAIRUD</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="btn-ruang">
            <div>
                <h2>Layanan Keliling</h2>
            </div>
            <div class="gab-btn">
                <form name="webpage">
                    <select name="statistikLayananKel" id="statistikLayananKel">
                        <option value="#" disabled selected>Pilihan Lokasi Layanan Keliling</option>
                        <option value="#">TK PKK Widodomartani</option>
                        <option value="#">SD Jali Prambanan</option>
                        <option value="#">SD Sinar Melati</option>
                        <option value="#">SD Pendowoharjo</option>
                        <option value="#">SD Rejodani</option>
                        <option value="#">SD Tamanan 3 Kalasan</option>
                        <option value="#">SD Berbah</option>
                        <option value="#">SD Murten</option>
                        <option value="#">SD Muh.Condong catur</option>
                        <option value="#">TK Kalibulus</option>
                        <option value="#">TK PKK Pajimatan</option>
                        <option value="#">SD Muhammadiyah Babakan</option>
                        <option value="#">TK ABA Sutopadan</option>
                        <option value="#">SLB 1 Bantul</option>
                        <option value="#">MA Mafasa</option>
                        <option value="#">SD Ngentak Banguntapan</option>
                        <option value="#">SD Jurugentong</option>
                        <option value="#">SD Bunder</option>
                        <option value="#">TK ABA Plembutan Asri</option>
                        <option value="#">TK ABA Karangmojo I</option>
                        <option value="#">SD Gedang Klutuk</option>
                        <option value="#">SD Plembutan Asri</option>
                        <option value="#">SLB I Yogyakarta</option>
                        <option value="#">SMK Koperasi</option>
                        <option value="#">SD Negeri Sidakan</option>
                        <option value="#">SD Sorogenen 2 Kalasan</option>
                        <option value="#">KB Kasih Ibu</option>
                        <option value="#">MA Bin Baz</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="btn-ruang">
            <div>
                <h2>Layanan Paket Buku</h2>
            </div>
            <div class="gab-btn">
                <form name="webpage">
                    <select name="statistikLayananPaket" id="statistikLayananPaket">
                        <option value="#" disabled selected>Pilihan Lokasi Layanan Paket Buku</option>
                        <option value="#">BRSBKL</option>
                        <option value="#">Rutan Wates</option>
                        <option value="#">Rutan Bantul</option>
                        <option value="#">Rutan kota</option>
                        <option value="#">Lapas Wirogunan</option>
                        <option value="#">Lapas Cebongan</option>
                        <option value="#">Lapas Wonosari</option>
                        <option value="#">Lapas Narkotika</option>
                        <option value="#">PONPES Pesawat</option>
                        <option value="#">PA Nurul Haq</option>
                        <option value="#">SPS Manggis</option>
                        <option value="#">BPRSW Godean</option>
                        <option value="#">Huntap Karang Kendal</option>
                        <option value="#">BRSPA Bimomartani</option>
                        <option value="#">BRSPA Budhi Bakti</option>
                        <option value="#">PONPES Ibnul Qoyyim</option>
                        <option value="#">BRTPD Pundong Bantul</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="btn-ruang">
            <div>
                <h2>Delivery Order</h2>
            </div>
            <div class="gab-btn">
                <form name="webpage">
                    <select name="statistikDO" id="statistikDO">
                        <option value="#" disabled selected>Pilihan Delivery Order</option>
                        <option value=#">DO</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script type ="text/javascript">
        var urlMenu = document.getElementById('statistikLD');
        urlMenu.onchange = function()
        {
            var userOption = this.options[this.selectedIndex];
            if (userOption.value != "nothing")
                {
                window.open(userOption.value, "HTML CSS javascript PHP", "");
                }
        }
    </script>
    <script type ="text/javascript">
        var urlMenu = document.getElementById('statistikL1');
        urlMenu.onchange = function()
        {
            var userOption = this.options[this.selectedIndex];
            if (userOption.value != "nothing")
                {
                window.open(userOption.value, "HTML CSS javascript PHP", "");
                }
        }
    </script>
    <script type ="text/javascript">
        var urlMenu = document.getElementById('statistikL2');
        urlMenu.onchange = function()
        {
            var userOption = this.options[this.selectedIndex];
            if (userOption.value != "nothing")
                {
                window.open(userOption.value, "HTML CSS javascript PHP", "");
                }
        }
    </script>
    <script type ="text/javascript">
        var urlMenu = document.getElementById('statistikJLC');
        urlMenu.onchange = function()
        {
            var userOption = this.options[this.selectedIndex];
            if (userOption.value != "nothing")
                {
                window.open(userOption.value, "HTML CSS javascript PHP", "");
                }
        }
    </script>
    <script type ="text/javascript">
        var urlMenu = document.getElementById('statistikRBM');
        urlMenu.onchange = function()
        {
            var userOption = this.options[this.selectedIndex];
            if (userOption.value != "nothing")
                {
                window.open(userOption.value, "HTML CSS javascript PHP", "");
                }
        }
    </script>
    <script type ="text/javascript">
        var urlMenu = document.getElementById('statistikPojokBaca');
        urlMenu.onchange = function()
        {
            var userOption = this.options[this.selectedIndex];
            if (userOption.value != "nothing")
                {
                window.open(userOption.value, "HTML CSS javascript PHP", "");
                }
        }
    </script>
    <script type ="text/javascript">
        var urlMenu = document.getElementById('statistikLayananKel');
        urlMenu.onchange = function()
        {
            var userOption = this.options[this.selectedIndex];
            if (userOption.value != "nothing")
                {
                window.open(userOption.value, "HTML CSS javascript PHP", "");
                }
        }
    </script>
    <script type ="text/javascript">
        var urlMenu = document.getElementById('statistikLayananPaket');
        urlMenu.onchange = function()
        {
            var userOption = this.options[this.selectedIndex];
            if (userOption.value != "nothing")
                {
                window.open(userOption.value, "HTML CSS javascript PHP", "");
                }
        }
    </script>
    <script type ="text/javascript">
        var urlMenu = document.getElementById('statistikDO');
        urlMenu.onchange = function()
        {
            var userOption = this.options[this.selectedIndex];
            if (userOption.value != "nothing")
                {
                window.open(userOption.value, "HTML CSS javascript PHP", "");
                }
        }
    </script>
    
</body>

</html>