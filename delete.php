<?php
session_start(); // Mulai sesi

require_once 'koneksi.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

$tanggal = $_POST['tanggal'];
$ruang = $_POST['ruang'];
$tabel = "";

switch ($ruang) {
    case "ruang1":
        $tabel = "ruang_digital";
        break; // Add break statement to exit the switch after setting the table name
    case "ruang2":
        $tabel = "ruang_langka";
        break;
    case "ruang3":
        $tabel = "ruang_audiovisual";
        break;
    case "ruang4":
        $tabel = "ruang_referensi";
        break;
    case "ruang5":
        $tabel = "ruang_skripsibudaya";
        break;
    case "ruang6":
        $tabel = "ruang_umum";
        break;
    case "ruang7":
        $tabel = "ruang_braile";
        break;
    case "ruang8":
        $tabel = "ruang_majalah";
        break;
    case "ruang9":
        $tabel = "ruang_bukuanak";
        break;
    case "ruang10":
        $tabel = "ruang_bermain";
        break;
    case "ruang11":
        $tabel = "ruang_musik";
        break;
    case "ruang12":
        $tabel = "ruang_mendongeng";
        break;
    case "ruang13":
        $tabel = "ruang_bioskop";
        break;
    case "ruang14":
        $tabel = "ruang_tandon";
        break;
    case "ruang15":
        $tabel = "jlc";
        break;
    case "ruang16":
        $tabel = "rbm";
        break;
    default:
        header("Location: /statistik_perpustakaan/list.php");
        exit();
}

$sql = "DELETE FROM $tabel WHERE tanggal = '$tanggal'";

if ($conn->query($sql) === TRUE) {
    echo "Record(s) deleted successfully from table: $tabel";
} else {
    echo "Error deleting record(s) from table: $tabel - " . $conn->error;
}

// Close the database connection
$conn->close();
header("Location: /statistik_perpustakaan/list.php");
exit();
?>