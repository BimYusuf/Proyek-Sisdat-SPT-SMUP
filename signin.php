<?php
// // signup.php
// session_start();
// require 'db_connect.php'; // Include the database connection file

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = trim($_POST['username']);
//     $password = trim($_POST['password']);
//     $confirm_password = trim($_POST['confirm_password']);

//     // Check if the fields are not empty
//     if (!empty($username) && !empty($password) && !empty($confirm_password)) {
//         // Check if passwords match
//         if ($password === $confirm_password) {
//             // Check if the username already exists
//             $stmt = conn()->prepare("SELECT COUNT(*) FROM pendaftar WHERE username = :username");
//             $stmt->bindParam(':username', $username);
//             $stmt->execute();
//             $count = $stmt->fetchColumn();

//             if ($count == 0) {
//                 // Hash the password
//                 $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//                 // Insert the new user into the database
//                 $stmt = $conn->prepare("INSERT INTO pendaftar (username, password) VALUES (:username, :password)");
//                 $stmt->bindParam(':username', $username);
//                 $stmt->bindParam(':password', $hashed_password);

//                 if ($stmt->execute()) {
//                     // Redirect to login page or dashboard after successful registration
//                     header("Location: signin.php");
//                     exit;
//                 } else {
//                     // Error inserting user
//                     $error = "Error creating account. Please try again.";
//                 }
//             } else {
//                 // Username already exists
//                 $error = "Username already taken. Please choose another.";
//             }
//         } else {
//             // Passwords do not match
//             $error = "Passwords do not match. Please try again.";
//         }
//     } else {
//         // Fields are empty
//         $error = "Please fill in all fields.";
//     }
// }


session_start();
require 'db_connect.php';

if (isset($_POST['submit_daftar'])) {
    $nama = mysqli_real_escape_string(conn(), $_POST['nama']);
    $email = mysqli_real_escape_string(conn(), $_POST['email']);
    $password = mysqli_real_escape_string(conn(), $_POST['password']);
    $konfirmasi_password = mysqli_real_escape_string(conn(), $_POST['konfirmasi_password']);
    $pendidikan_terakhir = mysqli_real_escape_string(conn(), $_POST['pendidikan_terakhir']);
    $tanggal_lahir = mysqli_real_escape_string(conn(), $_POST['tanggal_lahir']);
    $alamat = mysqli_real_escape_string(conn(), $_POST['alamat']);
    $status_perkawinan = mysqli_real_escape_string(conn(), $_POST['status_perkawinan']);
    $telepon = mysqli_real_escape_string(conn(), $_POST['telepon']);

    
    if($password == $konfirmasi_password){
        $password = password_hash($password, PASSWORD_DEFAULT);
        do{
            $id = mt_rand(10000000, 99999999);
            //cek apakah id sudah ada
            $sql = "SELECT COUNT(*) FROM pendaftar WHERE id_pendaftar = $id";
            $result = conn()->query($sql);
        }while(!$result);

        $query = "INSERT INTO pendaftar (
            id_pendaftar, nama_pendaftar, email, password, pendidikan_terakhir, tanggal_lahir, alamat, status_perkawinan, no_telepon) 
            VALUES ('$id','$nama', '$email', '$password', '$pendidikan_terakhir', '$tanggal_lahir', '$alamat', '$status_perkawinan', '$telepon')";
        
        $query_run = mysqli_query(conn(), $query);
    
        if($query_run)
        {
            $_SESSION['message'] = "Student Created Successfully";
            header("Location: login.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Student Not Created";
            header("Location: signin.php");
            exit(0);
        }
    }else{
        echo "Konfirmasi Password tidak cocok";
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
        <form class="signin-box" action="signin.php" method="POST">
            <div class="input-row">
                <h2>Sign-In Pendaftar Baru</h2>
            </div>
            <div class="input-row">        
                    <div class="input-box">
                        <label for="">Nama Lengkap</label>
                        <input class="input-signin" type="text" name="nama" placeholder="Nama Lengkap">
                    </div>
                    <div class="input-box">
                        <label for="">Tanggal Lahir</label>
                        <input class="input-signin" type="date" name="tanggal_lahir" id="" placeholder="Tanggal Lahir">
                    </div>
            </div>
            <div class="input-row">
                    <div class="input-box">
                        <label for="">Email</label>
                        <input class="input-signin" name="email" type="email" placeholder="Email">
                    </div>
            </div>
            <div class="input-row">
                    <div class="input-box">
                        <label for="">Password</label>
                        <input class="input-signin" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="input-box">
                        <label for="">Konfirmasi Password</label>
                        <input class="input-signin" name="konfirmasi_password" type="passowrd" placeholder="Konfirmasi Password">
                    </div>
            </div>
            <div class="input-row">
                <div class="input-box">
                    <label for="">Pendidikan Terakhir</label>
                    <select class="input-signin" name="pendidikan_terakhir">
                        <option >pilih</option>
                        <option value="SMA">SLTA/sederajat atau Paket C</option>
                        <option value="S1">Strata 1</option>
                        <option value="S2">Strata 2</option>
                    </select>
                </div>
            </div>
            <div class="input-row">
                    <div class="input-box">
                        <label for="">Alamat</label>
                        <input class="input-signin long" name="alamat" type="text" placeholder="Alamat">
                    </div>
            </div>
            <div class="input-row">
                    <div class="input-box">
                        <label for="">Status Perkawinan</label>
                        <select class="input-signin" name="status_perkawinan" id="">
                            <option>pilih</option>
                            <option value="Belum Kawin">Belum Kawin</option>
                            <option value="Kawin">Kawin</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="">Telepon</label>
                        <input class="input-signin" name="telepon" type="text" placeholder="telepon">
                    </div>
            </div>
            <div class="input-row jus-right">
                <button class="daftar-submit" type="submit" name="submit_daftar">Daftar</button>
            </div>
        </form>
        <div class="banner_right">
            <object data="assets/banner_2.png" type=""></object>
        </div>
    </div>
</body>
</html>