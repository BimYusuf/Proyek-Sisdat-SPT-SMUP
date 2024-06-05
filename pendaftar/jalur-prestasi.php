<?php
session_start();
require_once '../db_connect.php';
$id_jalur = "333333";
$id_pendaftar = $_SESSION['email'];

// check login session 
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

// ambil data prodi
$prodi = conn()->query("SELECT prodi.*, fakultas.singkatan FROM prodi JOIN fakultas ON prodi.fk_fakultas = fakultas.id_fakultas");

// ambil data pendaftaran prestasi
if(isset($_GET['table'])){
    $id_rapor = $_GET['table'];
    $data = conn()->query("SELECT prestasi.*, enroll.*, jalur.* FROM prestasi JOIN enroll ON prestasi.id_prestasi = enroll.fk_prestasi JOIN jalur ON enroll.fk_jalur = jalur.id_jalur");
    $data = $data->fetch_assoc();
}else{
    $data = conn()->query("SELECT  enroll.*, jalur.* FROM  enroll JOIN jalur ON enroll.fk_jalur = jalur.id_jalur");
    $data = $data->fetch_assoc();
}

//input data
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $prodi_1 = mysqli_real_escape_string(conn(), $_POST['prodi_1']);
    $prodi_2 = mysqli_real_escape_string(conn(), $_POST['prodi_2']);
    $judul = mysqli_real_escape_string(conn(), $_POST['judul']);
    $bidang = mysqli_real_escape_string(conn(), $_POST['bidang']);
    $tingkat = mysqli_real_escape_string(conn(), $_POST['tingkat']);
    $peringkat = mysqli_real_escape_string(conn(), $_POST['peringkat']);
    $link = mysqli_real_escape_string(conn(), $_POST['link']);

    // tetapkan prestasi id
    do{
        $id_prestasi = mt_rand(10000000, 99999999);
        //cek apakah id sudah ada
        $sql = "SELECT COUNT(*) FROM prestasi WHERE id_prestasi = '$id_prestasi'";
        $result = conn()->query($sql);
    }while(!$result);
    
    if(isset($_GET['table'])){
        $id_prestasi = $_GET['table'];
    }

    // update or insert rapor&utbk
    conn()->query("INSERT INTO prestasi 
    VALUES ('$id_prestasi', '$judul', '$bidang', '$tingkat', '$peringkat', '$link')
    ON DUPLICATE KEY UPDATE
    nama_prestasi = '$judul', bidang = '$bidang', tingkat = '$tingkat', peringkat = '$peringkat', link = '$link'");

    // update enroll
    conn()->query("
    UPDATE enroll
    SET 
        fk_prodi_1 = '$prodi_1',
        fk_prodi_2 = '$prodi_2',
        fk_prestasi = '$id_prestasi'
    WHERE 
        fk_pendaftar = '$id_pendaftar' AND
        fk_jalur = '$id_jalur'
    ");

    header("Location: ../pendaftar");
    
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPT SMUP - Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="shaded-background">
    <form class="singly-container" action="/pendaftar/jalur-prestasi.php" method="POST">
        
        <?php include "data-diri-pendaftar-box.php" ?>
        
        <div id="" class="white-container">
            <h1>Daftar Jalur Prestasi</h1>
            <hr>
            <table class="table-template">
                    <tr>
                        <td>Skema</td>
                        <td>: <?php echo $data['jenis'] ?></td>
                    </tr>
                    <tr>
                        <td>Pendaftaran Dibuka</td>
                        <td>: <?php echo $data['tanggal_dibuka'] ?></td>
                    </tr>
                    <tr>
                        <td>Pendaftaran Ditutup</td>
                        <td>: <?php echo $data['tanggal_ditutup'] ?></td>
                    </tr>
            </table>
            <br>
            <table class="table-template">
                <tr>
                    <td>Program Studi Pilihan 1</td>
                    <td>
                        <select class="input-signin" name="prodi_1" id="">
                            <option>pilih</option>
                            <?php 
                                for ($row_no = 0; $row_no < $prodi->num_rows; $row_no++) {
                                    $prodi->data_seek($row_no);
                                    $row = $prodi->fetch_assoc();
                                    echo '<option value="'.$row["id_prodi"].'"'.(($row["id_prodi"] == $data["fk_prodi_1"])? "selected" : "").'>'.$row["nama_prodi"].' - '.$row["singkatan"].'</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Program Studi Pilihan 2</td>
                    <td>
                        <select class="input-signin" name="prodi_2" id="">
                            <option>pilih</option>
                            <?php 
                                for ($row_no = 0; $row_no < $prodi->num_rows; $row_no++) {
                                    $prodi->data_seek($row_no);
                                    $row = $prodi->fetch_assoc();
                                    echo '<option value="'.$row["id_prodi"].'"'.(($row["id_prodi"] == $data["fk_prodi_2"])? "selected" : "").'>'.$row["nama_prodi"].' - '.$row["singkatan"].'</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div id="nilai-rapor-container" class="white-container">
            <h1>Data Prestasi</h1>
            <hr>
            <table class="table-template">
                <tr>
                    <td>Judul Prestasi</td>
                    <td>
                        <input class="input-signin" type="text" name="judul" id="" value="<?php echo (isset($data['nama_prestasi']))? $data['nama_prestasi'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>Bidang</td>
                    <td>
                        <input class="input-signin" type="text" name="bidang" id="" value="<?php echo (isset($data['bidang']))? $data['bidang'] : ''?>">
                    </td>
                </tr>
                <tr>
                    <td>Tingkat</td>
                    <td>
                        <input class="input-signin" type="text" name="tingkat" id="" value="<?php echo (isset($data['tingkat']))? $data['tingkat'] : ''?>">
                    </td>
                </tr>
                <tr>
                    <td>Peringkat</td>
                    <td>
                        <input class="input-signin" type="text" name="peringkat" id="" value="<?php echo (isset($data['peringkat']))? $data['peringkat'] : ''?>">
                    </td>
                </tr>
                <tr>
                    <td>Link Bukti Prestasi</td>
                    <td>
                        <input class="input-signin" type="text" name="link" id="" value="<?php echo (isset($data['link']))? $data['link'] : ''?>">
                    </td>
                </tr>
            </table>
        </div>
        <div id="submit-jalur" class="white-container">
            <button type="submit">SUBMIT PENDAFTARAN</button>
        </div>
    </form>

    <?php include "../footer.html" ?>

</body>
</html>