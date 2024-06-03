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

    $conn = conn();

    $stmt = $conn->prepare("SELECT password FROM pendaftar WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['asesor'] = $email;
            header("Location: asesor-dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "Invalid email or password";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPT SMUP - Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="shaded-background">
    <div class="login-container">
        <div class="login-box admin">
            <h3>LOGIN ADMINISTRATOR</h3>
            <input type="email" name="email" id="email_input" placeholder="Email"> 
            <input type="password" name="password" id="password_input" placeholder="Password">
            <div id="capthca">
                <!-- capthca -->
            </div>
            <input type="text" name="capthca" id="capthca_input" placeholder="Enter Capthca Above">
            <button type="submit">LOGIN</button>
        </div>
    </div>
</body>
</html>