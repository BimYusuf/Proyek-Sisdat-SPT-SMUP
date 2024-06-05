<?php
session_start();
require_once '../db_connect.php';
$id_jalur = "222222";
$id_pendaftar = $_SESSION['email'];

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}


// ambil data prodi
$prodi = conn()->query("SELECT prodi.*, fakultas.singkatan FROM prodi JOIN fakultas ON prodi.fk_fakultas = fakultas.id_fakultas");

// ambil data pendaftaran rapor dan utbk
$data = conn()->query("SELECT ujian.*, enroll.*, jalur.* FROM ujian JOIN enroll ON ujian.id_ujian = enroll.fk_ujian JOIN jalur ON enroll.fk_jalur = jalur.id_jalur");
$data = $data->fetch_assoc();
if(isset($_GET['table'])){
    $id_rapor = $_GET['table'];
    $data = conn()->query("SELECT ujian.*, enroll.*, jalur.* FROM ujian JOIN enroll ON ujian.id_ujian = enroll.fk_ujian JOIN jalur ON enroll.fk_jalur = jalur.id_jalur");
    $data = $data->fetch_assoc();
}

// text lulus
if($data['lulus'] == null){
    $lulus = "-";
}else{
    $lulus = ($data['lulus'])? "Lulus": "Tidak Lulus";
}

// input data prodi pilihan
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $prodi_1 = mysqli_real_escape_string(conn(), $_POST['prodi_1']);
    $prodi_2 = mysqli_real_escape_string(conn(), $_POST['prodi_2']);

    // update enroll
    conn()->query("
    UPDATE enroll
    SET 
        fk_prodi_1 = '$prodi_1',
        fk_prodi_2 = '$prodi_2'
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
    <form class="singly-container" action="/pendaftar/jalur-ujian.php" method="POST">
        
        <?php include "data-diri-pendaftar-box.php" ?>
        
        <div id="daftar-jalur-ujian" class="white-container">
            <h1>Daftar Jalur Ujian SMUP</h1>
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
        <div id="data-ujian-container" class="white-container">
            <h1>Data Ujian</h1>
            <hr>
            <br>
            <br>
            <p>Ujian dilaksanakan pada laman <a href="https://www.jian.unpad.id">ujian.smup.unpad.id</a></p>
            <table class="table-template">
                <tr>
                    <td>Username</td>
                    <td> : <b><?php echo $data['username']?></b></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td> : <b><?php echo $data['password']?></b></td>
                </tr>
            </table>
            <br>
            <table class="table-template">
                <tr>
                    <td>Waktu Mulai Ujian</td>
                    <td> : <?php echo $data['mulai_ujian']?> WIB</td>
                </tr>
                <tr>
                    <td>Waktu Berakhir</td>
                    <td> : <?php echo $data['selesai_ujian']?> WIB</td>
                </tr>
            </table>
            <br>
        </div>
        <div id="hasil-ujian-container" class="white-container">
            <h1>Hasil Ujian</h1>
            <hr>
            <br>
            <table class="table-template">
                <tr>
                    <td>Nilai</td>
                    <td>: <?php echo $data['nilai']?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>: <?php echo $lulus?></td>
                </tr>
            </table>
            <br>
        </div>
        <div id="submit-jalur" class="white-container">
            <button type="submit">SUBMIT PENDAFTARAN</button>
        </div>
    </form>

    
    <?php include "../footer.html" ?>

</body>
</html>