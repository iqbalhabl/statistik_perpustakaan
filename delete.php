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
    $successMessage = "Data telah berhasil terhapus dari tabel : $tabel";
    echo "<div class='new-container'>";
        echo $successMessage;
        echo "<form method='post' action='list-date.php'>";
        echo "<button type='submit' class='blue-button' data-toggle='modal'>Ok</button>";
        echo "</form>";
    echo "</div>";
    $conn->close();
    exit();
} else {
    echo "Error deleting record(s) from table: $tabel - " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style4.css">
    <title>Delete</title>
</head>

<body>
    <div class="new-container">
        <p>
            Hello World!
        </p>
    </div>
</body>

</html>