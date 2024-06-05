<?php
session_start();
require_once '../db_connect.php';

// conn()->query("DROP TABLE enroll");

// cek login session
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

//query jalur
$jalur = conn()->query("SELECT * FROM jalur");

// enroll aktif
$enroll = conn()->query("SELECT jalur.nama, jalur.jenis, enroll.* FROM enroll
JOIN pendaftar ON enroll.fk_pendaftar = pendaftar.id_pendaftar
JOIN jalur ON enroll.fk_jalur = jalur.id_jalur
WHERE enroll.fk_pendaftar = '".$_SESSION['email']."'");

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

        <?php include "data-diri-pendaftar-box.php" ?>

        <div id="enroll-aktif-container" class="white-container">
            <h1>ENROLL AKTIF</h1>
            <hr>
            <div class="tabel-enroll-aktif">
                <div class="tabel-row head">
                    <span>NO.</span>
                    <span>NAMA JALUR</span>
                    <span>SKEMA</span>
                    <span>STATUS</span>
                    <span>EDIT</span>
                    <span>BATALKAN</span>
                </div>
                <?php 
                    
                    $index = 1;
                    if($enroll->num_rows > 0){
                        for ($row_no = 0; $row_no < $enroll->num_rows; $row_no++) {
                            $enroll->data_seek($row_no);
                            $row = $enroll->fetch_assoc();

                            if($row['lulus'] == null){
                                $lulus = "belum diumumkan";
                            }else{
                                $lulus = ($row['lulus'])? "Lulus" : "Tidak Lulus";
                            }

                            $view_jalur = [
                                "111111" => "jalur-rapor.php",
                                "222222" => "jalur-ujian.php",
                                "333333" => "jalur-prestasi.php"
                            ];

                            $link = $view_jalur[$row["fk_jalur"]].'?table='.$row['fk_rapor'].$row['fk_ujian'].$row['fk_prestasi'];
                            echo '<div class="tabel-row">
                                <span>'.$index++.'</span>
                                <span>'.$row['nama'].'</span>
                                <span>'.$row['jenis'].'</span>
                                <span>'.$lulus.'</span>
                                <span><a class="blue-button" href="pendaftar/'.$link.'">Edit</a></span>
                                <span><a class="red-button" href="delete.php?enroll-id='.$row['fk_jalur'].'">Batalkan</a></span>
                            </div>';
                        }
                    }else{
                        echo "<h6>No Data (".$enroll->num_rows.")</h6>";
                    }

                ?>
            </div>
        </div>
        <div id="jalur-tersedia-container" class="white-container">
            <h1>JALUR SELEKSI TERSEDIA</h1>
            <hr>
            <div class="tabel-jalur-tersedia">
                <?php 
                    $index = 1;
                    if($jalur->num_rows > 0){
                        for ($row_no = 0; $row_no < $jalur->num_rows; $row_no++) {
                            $jalur->data_seek($row_no);
                            $row = $jalur->fetch_assoc();
                            echo '<div class="tabel-row">
                                <span>'.$index++.'</span>
                                <span>'.$row['nama'].'</span>
                                <span>'.$row['jenis'].'</span>
                                <span>Dibuka:'.(new DateTime($row['tanggal_dibuka']))->format('Y-m-d').'</span>
                                <span>Ditutup:'.(new DateTime($row['tanggal_ditutup']))->format('Y-m-d').'</span>
                                <span><a class="red-button" href="../add_enroll.php?jalur='.$row["id_jalur"].'">Daftar</a></span>
                            </div>';
                        }
                    }else{
                        echo "<h6>No Data (".$jalur->num_rows.")</h6>";
                    }

                ?>
            </div>
        </div>
    </div>


    <?php include "../footer.html" ?>

</body>
</html>