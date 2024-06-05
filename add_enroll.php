<?php 
session_start();
require_once 'db_connect.php';

$id_jalur = $_GET['jalur'];
$id_pendaftar = $_SESSION['email'];

$view_jalur = [
    "111111" => "jalur-rapor.php",
    "222222" => "jalur-ujian.php",
    "333333" => "jalur-prestasi.php"
];

// cek apakah sudah mendafatr di jalur ini
$session_id = $_SESSION['email'];
$sql = "SELECT 1 FROM enroll WHERE fk_pendaftar = $session_id AND fk_jalur = $id_jalur LIMIT 1";
$result = conn()->query($sql);
if($result && $result->num_rows > 0){
    header("Location: pendaftar/");
    exit();
}else{
    
    // buat enroll baru
    if(isset($_GET['jalur'])){
    
        // khusus jalur ujian, insert databasenya disini
        if($id_jalur == "222222"){
            $id_ujian = createUjian();
            $sql = "INSERT INTO enroll(tanggal_daftar, fk_jalur, fk_pendaftar, fk_ujian) VALUES ('$now', '$id_jalur', '$id_pendaftar', $id_ujian)";
        }else{
            $sql = "INSERT INTO enroll(tanggal_daftar, fk_jalur, fk_pendaftar) VALUES ('$now', '$id_jalur', '$id_pendaftar')";
        }

        conn()->query($sql);


        header("Location: pendaftar/".$view_jalur[$id_jalur]);
    }else{
        header("Location: login.php");
    }
}

function createUjian(){
    // buat ID Ujian 
    do{
        $id_ujian = mt_rand(10000000, 99999999);
        //cek apakah id sudah ada
        $sql = "SELECT COUNT(*) FROM ujian WHERE id_ujian = $id_ujian";
        $result = conn()->query($sql);
    }while(!$result);

    // buat username Ujian 
    do{
        $username = "user".mt_rand(100000, 999999);
        //cek apakah id sudah ada
        $sql = "SELECT COUNT(*) FROM ujian WHERE id_ujian = '$username'";
        $result = conn()->query($sql);
    }while(!$result);

    // buat password
    $password = mt_rand(11111111, 99999999);

    // insert
    $sql = "INSERT INTO ujian VALUES('$id_ujian', '$username', '$password', '2024-07-21 09:00:00', '2024-07-21 12:00:00', null)";
    conn()->query($sql);

    return $id_ujian;
}

?>