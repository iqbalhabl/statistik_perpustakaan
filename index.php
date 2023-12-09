<?php
session_start(); // Mulai sesi

require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: home.php");
    } else {
        $error = "Username atau password salah";
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Login</title>
</head>

<body>
    <div class="body-login">
        <div class="global-container">
            <div class="card login-form">
                <div class="card-body">
                    <h1 class="card-title">LOGIN</h1>
                </div>
                <div class="card-text">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="usernameInput" class="userpass">Username</label>
                            <input type="text" name="username" class="form-control" id="usernameInput">
                        </div>
                        <div class="mb-3">
                            <label for="passwordInput" class="userpass">Password</label>
                            <input type="password" name="password" class="form-control" id="passwordInput">
                        </div>
                        <button type="submit" value="Login" class="btn btn-primary">Masuk</button>
                    </form>
                    <?php if (isset($error)) {
                        echo $error;
                    } ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>