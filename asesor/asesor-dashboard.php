<?php 
session_start();
require_once '../db_connect.php';

// check login session 
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin-login.php");
    exit();
}


//query jalur
$jalur = conn()->query("SELECT * FROM jalur");

//query fakultas
$fakultas = conn()->query("SELECT * FROM fakultas");

//query prodi
$prodi = conn()->query("SELECT * FROM prodi");



// query enroll pendaftar
if(!isset($_GET['filter'])){
    $pendaftar = conn()->query("SELECT enroll.*, jalur.*, pendaftar.* FROM enroll 
    JOIN jalur ON enroll.fk_jalur = jalur.id_jalur
    JOIN pendaftar ON enroll.fk_pendaftar = pendaftar.id_pendaftar");
}else{
    $keyword = $_GET['keyword'];
    $arah = $_GET['arah'];

    $sql = "SELECT enroll.*, jalur.*, pendaftar.*, prodi.* FROM enroll 
    JOIN jalur ON enroll.fk_jalur = jalur.id_jalur
    JOIN pendaftar ON enroll.fk_pendaftar = pendaftar.id_pendaftar
    JOIN prodi ON enroll.fk_prodi_1 = prodi.id_prodi
    WHERE nama_pendaftar LIKE '%$keyword%' ";

    if(isset($_GET['jalur'])){
        $id_jalur = $_GET['jalur'];
        $sql = $sql."AND id_jalur = '$id_jalur' ";
    }
    if(isset($_GET['prodi'])){
        $id_prodi = $_GET['prodi'];
        $sql = $sql."AND id_prodi = '$id_prodi' ";
    }
    if(isset($_GET['urut'])){
        $urut = $_GET['urut'];
        $sql = $sql."ORDER BY $urut $arah";
    }
    

    $pendaftar = conn()->query($sql);

    
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // upload fakultas
    if($_POST['data'] == 'fakultas'){

        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $singkatan = $_POST['singkatan'];

        conn()->query("INSERT INTO fakultas VALUES('$id', '$nama', '$singkatan')");
    }
    //upload data jalur
    else if($_POST['data'] == 'jalur'){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $skema = $_POST['skema'];
        $jenjang = $_POST['jenjang'];
        $dibuka = $_POST['dibuka'];
        $ditutup = $_POST['ditutup'];

        conn()->query("INSERT INTO jalur VALUES('$id', '$skema', '$nama', '$jenjang', '$dibuka', '$ditutup')");
    }
    //upload data prodi 
    else if($_POST['data'] == 'prodi'){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $fakultas = $_POST['fakultas'];
        $jenjang = $_POST['jenjang'];
        $biaya = $_POST['biaya_pendidikan'];
        $kuota = $_POST['kuota'];

        conn()->query("INSERT INTO prodi VALUES('$id', '$nama', '$fakultas', '$jenjang', '$biaya', '$kuota', '$kuota')");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPT SMUP - Asesor Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="shaded-background">
    <div class="singly-container grid-place">
        <div id="data-asesor-container" class="white-container">
            <h1>DATA ASESOR</h1>
            <hr>
            <table id="data-asesor" class="table-template">
                <tr>
                    <td>ID Asesor</td>
                    <td>: </td>
                </tr>
                <tr>
                    <td>Nama Aesor</td>
                    <td>: </td>
                </tr>
            </table>
        </div>
        <div id="asesor-tab">
            <button class="tab-active" onclick="showDataUniv()">Data Universitas</button>
            <button onclick="showDataPendaftar()">Data Pendaftar</button>
        </div>
        <?php include "data-univ.php" ?>
        <?php include "data-pendaftar.php" ?>
    </div>

    <?php include "../footer.html" ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>
</html>