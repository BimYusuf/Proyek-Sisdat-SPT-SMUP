<?php
session_start();
require_once '../db_connect.php';

// cek login session
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

// query data pendaftar
$result = conn()->query("SELECT * FROM pendaftar WHERE id_pendaftar = '".$_SESSION['email']."'"); 
$data_pendaftar = $result->fetch_assoc();
//query 
$jalur = conn()->query("SELECT * FROM jalur");

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
    <div class="singly-container">
        <div id="data-diri-pendaftar-container" class="white-container">
            <h1>DATA CALON MAHASISWA</h1>
            <hr>
            <div class="row-container">
                <table id="data-pendaftar" class="table-template">
                    <tr>
                        <td>ID Pendaftar</td>
                        <td>: <?php echo$data_pendaftar['id_pendaftar']?> </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: <?php echo$data_pendaftar['nama_pendaftar']?> </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: <?php echo$data_pendaftar['email']?> </td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: <?php echo$data_pendaftar['tanggal_lahir']?> </td>
                    </tr>
                    <tr>
                        <td>Pendidikan Terakhir</td>
                        <td>: <?php echo$data_pendaftar['pendidikan_terakhir']?> </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?php echo$data_pendaftar['alamat']?> </td>
                    </tr>
                    <tr>
                        <td>Status Perkawinan</td>
                        <td>: <?php echo$data_pendaftar['status_perkawinan']?> </td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td>: <?php echo$data_pendaftar['no_telepon']?> </td>
                    </tr>
                </table>
                <div class="foto-profil">
                    <!-- foto img -->
                </div>
            </div>
        </div>
        <div id="enroll-aktif-container" class="white-container">
            <h1>ENROLL AKTIF</h1>
            <hr>
            <div class="tabel-enroll-aktif">
                <div class="tabel-row head">
                    <span>NO.</span>
                    <span>NAMA JALUR</span>
                    <span>SKEMA</span>
                    <span>STATUS</span>
                    <span>BERKAS</span>
                    <span>EDIT</span>
                    <span>BATALKAN</span>
                </div>
                <div class="tabel-row">
                    <span>1</span>
                    <span>UTBK dan Rapor</span>
                    <span>Seleksi Mandiri</span>
                    <span>Sedang diperiksa</span>
                    <span>Lengkap</span>
                    <span><a class="blue-button" href="">Edit</a></span>
                    <span><a class="red-button" href="">Batalkan</a></span>
                </div>
            </div>
        </div>
        <div id="jalur-tersedia-container" class="white-container">
            <h1>JALUR SELEKSI TERSEDIA</h1>
            <hr>
            <div class="tabel-jalur-tersedia">
                <div class="tabel-row">
                    <span>1</span>
                    <span>UTBK dan Rapor</span>
                    <span>Seleksi Mandiri</span>
                    <span>Dibuka:04-04-2024</span>
                    <span>Ditutup:04-06-2024</span>
                    <span><a class="red-button" href="">Daftar</a></span>
                </div>
                <div class="tabel-row">
                    <span>2</span>
                    <span>Ujian SMUP</span>
                    <span>Seleksi Mandiri</span>
                    <span>Dibuka:04-04-2024</span>
                    <span>Ditutup:04-06-2024</span>
                    <span><a class="red-button" href="">Daftar</a></span>
                </div>
                <div class="tabel-row">
                    <span>3</span>
                    <span>Prestasi</span>
                    <span>Seleksi Mandiri</span>
                    <span>Dibuka:04-04-2024</span>
                    <span>Ditutup:04-06-2024</span>
                    <span><a class="red-button" href="">Daftar</a></span>
                </div>
                <?php 
                    for ($row_no = 0; $row_no >= $result->num_rows; $row_no++) {
                        $result->data_seek($row_no);
                        $row = $result->fetch_assoc();
                        $index++;
                        echo '<div class="tabel-row">
                            <span>'.$index++.'</span>
                            <span>'.$row['nama'].'</span>
                            <span>'.$row['jenis'].'</span>
                            <span>Dibuka:'.$row['tanggal_dibuka'].'</span>
                            <span>Ditutup:'.$row['tanggal_dututup'].'</span>
                            <span><a class="red-button" href="">Daftar</a></span>
                        </div>';
                    }

                ?>
            </div>
        </div>
    </div>


    <?php include "../footer.html" ?>

</body>
</html>