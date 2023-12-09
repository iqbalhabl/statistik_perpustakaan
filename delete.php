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