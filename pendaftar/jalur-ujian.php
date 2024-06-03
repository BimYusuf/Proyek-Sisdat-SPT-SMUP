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
            <h1>Daftar Jalur Ujian SMUP</h1>
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
        <div id="data-ujian-container" class="white-container">
            <h1>Data Ujian</h1>
            <hr>
            <br>
            <br>
            <p>Ujian dilaksanakan pada laman <a href="https://www.jian.unpad.id">ujian.smup.unpad.id</a></p>
            <table class="table-template">
                <tr>
                    <td>Username</td>
                    <td> : <b>user1234</b></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td> : <b>#2897f8rg</b></td>
                </tr>
            </table>
            <br>
            <table class="table-template">
                <tr>
                    <td>Waktu Mulai Ujian</td>
                    <td> : 08:00 WIB 05-05-2024</td>
                </tr>
                <tr>
                    <td>Waktu Berakhir</td>
                    <td> : 11:00 WIB 05-05-2024</td>
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
                    <td>: -</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>: -</td>
                </tr>
            </table>
            <br>
        </div>
    </div>

    <?php include "../footer.html" ?>

</body>
</html>