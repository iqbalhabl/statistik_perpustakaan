<?php
    session_start();
    require_once 'koneksi.php';

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: index.php");
        exit();
    }

    // $tanggal = $_POST['tanggal'];
    $tabel = $_POST['ruang'];

    $sql = "DELETE FROM $tabel";

    if ($conn->query($sql) === TRUE) {
        echo "Record(s) deleted successfully from table: $tabel";
    } else {
        echo "Error deleting record(s) from table: $tabel - " . $conn->error;
    }

    $conn->close();
    header("Location: /statistik_perpustakaan/list-date.php");
    exit();
?>