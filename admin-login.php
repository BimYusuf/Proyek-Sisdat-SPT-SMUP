<?php 
session_start();
require_once 'db_connect.php';

// if (isset($_SESSION['admin'])) {
//     header("Location: asesor/asesor-dashboard.php");
//     exit();
// }

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = conn()->query("SELECT id_asesor, password FROM asesor WHERE username = '".$username."'");
    $result = $stmt->fetch_assoc();
    
    $hashed_password = $result["password"];

    if ($stmt->num_rows > 0) {

        if (password_verify($password, $hashed_password)) {
            $_SESSION['admin'] = $result["id_asesor"];
            header("Location: asesor/asesor-dashboard.php");
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
    <title>SPT SMUP - Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="shaded-background">
    <div class="login-container">
        <form class="login-box admin" action="admin-login.php" method="POST">
            <h3>LOGIN ADMINISTRATOR</h3>
            <input type="text" name="username" id="username_input" placeholder="Username"> 
            <input type="password" name="password" id="password_input" placeholder="Password">
            <div id="capthca">
                <!-- capthca -->
            </div>
            <input type="text" name="capthca" id="capthca_input" placeholder="Enter Capthca Above">
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>