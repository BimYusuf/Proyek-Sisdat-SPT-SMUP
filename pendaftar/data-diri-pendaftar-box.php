<?php 
    // query data pendaftar
    $result = conn()->query("SELECT * FROM pendaftar WHERE id_pendaftar = '".$_SESSION['email']."'"); 
    $data_pendaftar = $result->fetch_assoc();

?>

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