<?php
session_start(); // Start session


require_once '../koneksi.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../index.php"); // Redirect to the login page if not logged in
    exit();
}
// Get data from form
$tanggal = $_POST["tanggal"];
$pelajarL = $_POST["pelajarL"];
$pelajarP = $_POST["pelajarP"];
$mhsL = $_POST["mhsL"];
$mhsP = $_POST["mhsP"];
$umumL = $_POST["umumL"];
$umumP = $_POST["umumP"];

// Check if the data for this date already exists
$checkQuery = "SELECT COUNT(*) as count FROM ruang_referensi WHERE tanggal = '$tanggal'";
$result = $conn->query($checkQuery);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count > 0) {
    // If data already exists, perform an UPDATE query
    $updateQuery = "UPDATE ruang_referensi SET pelajarL='$pelajarL', pelajarP='$pelajarP', mhsL='$mhsL', mhsP='$mhsP', umumL='$umumL', umumP='$umumP' WHERE tanggal='$tanggal'";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Data berhasil diperbarui di database.";
    } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
} else {
    // If data does not exist, display an error message
    echo "Data untuk tanggal tersebut tidak ditemukan.";
}

$conn->close();

header("Location: ../list.php");
exit();