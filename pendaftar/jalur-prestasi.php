<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
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
    <div class="singly-container">
        <div id="data-diri-pendaftar-container" class="white-container">
            <h1>DATA CALON MAHASISWA</h1>
            <hr>
            <div class="row-container">
                <table id="data-pendaftar" class="table-template">
                    <tr>
                        <td>ID Pendaftar</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Pendidikan Terakhir</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Status Perkawinan</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td>: </td>
                    </tr>
                </table>
                <div class="foto-profil">
                    <!-- foto img -->
                </div>
            </div>
        </div>
        <div id="" class="white-container">
            <h1>Daftar Jalur Prestasi</h1>
            <hr>
            <table class="table-template">
                    <tr>
                        <td>Skema</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>Pendaftaran Dibuka</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>Pendaftaran Ditutup</td>
                        <td>:</td>
                    </tr>
            </table>
            <br>
            <table class="table-template">
                <tr>
                    <td>Program Studi Pilihan 1</td>
                    <td>
                        <select class="input-signin" name="" id="">
                            <option>pilih</option>
                            <option value="">Teknik Informatika</option>
                            <option value="">Teknik Biomedis</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Program Studi Pilihan 2</td>
                    <td>
                        <select class="input-signin" name="" id="">
                            <option>pilih</option>
                            <option value="">Teknik Informatika</option>
                            <option value="">Teknik Biomedis</option>
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
                        <input class="input-signin" type="text" name="judul" id="">
                    </td>
                </tr>
                <tr>
                    <td>Bidang</td>
                    <td>
                        <input class="input-signin" type="text" name="bidang" id="">
                    </td>
                </tr>
                <tr>
                    <td>Tingkat</td>
                    <td>
                        <input class="input-signin" type="text" name="tingkat" id="">
                    </td>
                </tr>
                <tr>
                    <td>Peringkat</td>
                    <td>
                        <input class="input-signin" type="text" name="peringkat" id="">
                    </td>
                </tr>
                <tr>
                    <td>Link Bukti Prestasi</td>
                    <td>
                        <input class="input-signin" type="text" name="link" id="">
                    </td>
                </tr>
            </table>
        </div>
        <div id="submit-jalur" class="white-container">
            <button type="submit">SUBMIT PENDAFTARAN</button>
        </div>
    </div>

    <?php include "../footer.html" ?>

</body>
</html>