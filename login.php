<?php 
session_start();
require_once 'db_connect.php';

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = conn()->query("SELECT id_pendaftar, password FROM pendaftar WHERE email = '".$email."'");
    $result = $stmt->fetch_assoc();
    
    $hashed_password = $result["password"];

    if ($stmt->num_rows > 0) {

        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $result["id_pendaftar"];
            header("Location: pendaftar/");
            exit();
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPT SMUP</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="shaded-background">
    <div class="split-container">
        <div class="banner_left">
            <object data="assets/banner_1.png" type=""></object>
        </div>
        <form action="login.php" method="POST" class="login-box">
            <h3>LOGIN</h3>
            <p>Login dengan akun pendaftar</p>
            <input type="email" name="email" id="email_input" placeholder="Email"> 
            <input type="password" name="password" id="password_input" placeholder="Password">
            <div id="capthca">
                <!-- capthca -->
            </div>
            <input type="text" name="capthca" id="capthca_input" placeholder="Enter Capthca Above">
            <button type="submit">LOGIN</button>
            <p>Belum punya akun? <a href="signin.php">Daftar Disini</a></p>
            <br>
            <p><a href="">Privacy Policy</a> | <a href="">Aggrement</a></p>
       </form>
    </div>
</body>
</html>