<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

$id = $_POST['id'];
$tabel = $_POST['ruang'];

$sql = "DELETE FROM $tabel WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Record(s) deleted successfully from table: $tabel";
    $conn->close();
    header("Location: /statistik_perpustakaan/list-date.php");
    exit();
} else {
    echo $sql;
    // echo "Error deleting record(s) from table: $tabel - " . $conn->error;
}


?>