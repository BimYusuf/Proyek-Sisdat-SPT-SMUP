<?php
session_start();
require_once '../db_connect.php';
$id_jalur = "111111";
$id_pendaftar = $_SESSION['email'];

// check login session 
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

// ambil data prodi
$prodi = conn()->query("SELECT prodi.*, fakultas.singkatan FROM prodi JOIN fakultas ON prodi.fk_fakultas = fakultas.id_fakultas");

// ambil data pendaftaran rapor dan utbk

if(isset($_GET['table'])){
    $id_rapor = $_GET['table'];
    $data = conn()->query("SELECT rapor_utbk.*, enroll.*, jalur.* FROM rapor_utbk JOIN enroll ON rapor_utbk.id_rapor = enroll.fk_rapor JOIN jalur ON enroll.fk_jalur = jalur.id_jalur");
    $data = $data->fetch_assoc();
}else{
    $data = conn()->query("SELECT enroll.*, jalur.* FROM enroll JOIN jalur ON enroll.fk_jalur = jalur.id_jalur");
    $data = $data->fetch_assoc();
}

//input data
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $prodi_1 = mysqli_real_escape_string(conn(), $_POST['prodi_1']);
    $prodi_2 = mysqli_real_escape_string(conn(), $_POST['prodi_2']);
    $nomor_utbk = mysqli_real_escape_string(conn(), $_POST['nomor_utbk']);
    $nilai_utbk = mysqli_real_escape_string(conn(), $_POST['nilai_utbk']);
    $minat = mysqli_real_escape_string(conn(), $_POST['minat']);
    $mtk = mysqli_real_escape_string(conn(), $_POST['MTK']);
    $ipa = mysqli_real_escape_string(conn(), $_POST['IPA']);
    $ips = mysqli_real_escape_string(conn(), $_POST['IPS']);
    $bindo = mysqli_real_escape_string(conn(), $_POST['bindo']);
    $bing = mysqli_real_escape_string(conn(), $_POST['bing']);
    // tetapkan rapor id
    do{
        $id_rapor = mt_rand(10000000, 99999999);
        //cek apakah id sudah ada
        $sql = "SELECT COUNT(*) FROM rapor_utbk WHERE id_rapor = '$id_rapor'";
        $result = conn()->query($sql);
    }while(!$result);
    
    if(isset($_GET['table'])){
        $id_rapor = $_GET['table'];
    }

    // update or insert rapor&utbk
    conn()->query("INSERT INTO rapor_utbk 
    VALUES ('$id_rapor', '$minat','$mtk', '$ipa', '$ips', '$bindo', '$bing', '$nilai_utbk', '$nomor_utbk')
    ON DUPLICATE KEY UPDATE
    minat = '$minat',mtk = '$mtk', ipa = '$ipa', ips = '$ips', bindo = '$bindo', bing = '$bing', nilai_utbk = '$nilai_utbk', nomor_utbk = '$nomor_utbk'");

    // update enroll
    conn()->query("
    UPDATE enroll
    SET 
        fk_prodi_1 = '$prodi_1',
        fk_prodi_2 = '$prodi_2',
        fk_rapor = '$id_rapor'
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
    <form class="singly-container" action="/pendaftar/jalur-rapor.php" method="POST">

        <?php include "data-diri-pendaftar-box.php" ?>

        <div id="daftar-jalur-utbk-rapor" class="white-container">
            <h1>Daftar Jalur UTBK dan Rapor</h1>
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
            <h1>Nilai Rapor</h1>
            <hr>
            <table class="table-template">
                <tr>
                    <td>Peminatan</td>
                    <td>
                        <input class="input-signin" type="text" name="minat" id="" value="<?php echo (isset($data['minat']))? $data['minat'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>Matematika</td>
                    <td>
                        <input class="input-signin" type="number" name="MTK" id="" value="<?php echo (isset($data['mtk']))? $data['mtk'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>IPA</td>
                    <td>
                        <input class="input-signin" type="number" name="IPA" id="" value="<?php echo (isset($data['ipa']))? $data['ipa'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>IPS</td>
                    <td>
                        <input class="input-signin" type="number" name="IPS" id="" value="<?php echo (isset($data['ips']))? $data['ips'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>Bahasa Indonesia</td>
                    <td>
                        <input class="input-signin" type="number" name="bindo" id="" value="<?php echo (isset($data['bindo']))? $data['bindo'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>Bahasa Inggris</td>
                    <td>
                        <input class="input-signin" type="number" name="bing" id="" value="<?php echo (isset($data['bing']))? $data['bing'] : '' ?>">
                    </td>
                </tr>
            </table>
        </div>
        <div id="skor-utbk-container" class="white-container">
            <h1>Skor UTBK</h1>
            <hr>
            <table class="table-template">
                <tr>
                    <td>Nomor UTBK</td>
                    <td>
                        <input class="input-signin" type="text" name="nomor_utbk" id="" value="<?php echo (isset($data['nomor_utbk']))? $data['nomor_utbk'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>Skor UTBK</td>
                    <td>
                        <input class="input-signin" type="number" name="nilai_utbk" id=" " value="<?php echo (isset($data['nilai_utbk']))? $data['nilai_utbk'] : '' ?>"> 
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