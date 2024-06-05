<div id="filter-container" class="white-container">
    <h1>Cari Pendaftar / Filter</h1>
    <hr>
    <form action="/asesor/asesor-dashboard.php" method="GET">
        <input type="hidden" name="filter" value="true">
        <div class="input-row">
            <input class="input-signin" type="text" name="keyword">
            <button type="submit">Cari</button>
        </div>
        <div class="input-row">
            <label for="">Jalur</label>
            <select class="input-signin" name="jalur" id="">
                <?php 
                    for ($row_no = 0; $row_no < $jalur->num_rows; $row_no++) {
                        $jalur->data_seek($row_no);
                        $row = $jalur->fetch_assoc();
                        echo '<option value="'.$row["id_jalur"].'">'.$row["nama"].' - '.$row["jenis"].'</option>';
                    }
                ?>
            </select>
            <label for="">Urut Berdasarkan</label>
            <select class="input-signin" name="urut" id="">
                <option value="tanggal_daftar">Waktu Enroll</option>
                <option value="prodi.nama">Prodi</option>
                <option value="nama_fak">Fakultas</option>
            </select>
        </div>
        <div class="input-row">
            <label for="">Program Studi</label>
            <select class="input-signin" name="prodi" id="">
                <?php 
                    for ($row_no = 0; $row_no < $prodi->num_rows; $row_no++) {
                        $prodi->data_seek($row_no);
                        $row = $prodi->fetch_assoc();
                        echo '<option value="'.$row["id_prodi"].'">'.$row["nama_prodi"].'</option>';
                    }
                ?>
            </select>
            <label for="">Desc</label>
            <input type="radio" name="arah" value="DESC">
            <label for="">Asc</label>
            <input type="radio" name="arah" checked value="ASC">
        </div>
    </form>
</div>

<div id="pendaftar-container" class="white-container">
    <div class="tabel-pendaftar">
        <?php 
            $index = 1;
            if($pendaftar->num_rows > 0){
                for ($row_no = 0; $row_no < $pendaftar->num_rows; $row_no++) {
                    $pendaftar->data_seek($row_no);
                    $row = $pendaftar->fetch_assoc();
                    echo '<div class="tabel-row">
                        <span>'.$index++.'</span>
                        <span>'.$row['nama_pendaftar'].'</span>
                        <span>'.$row['nama'].'</span>
                        <span>'.$row['jenis'].'</span>
                        <span>'.$row['jenjang'].'</span>
                        <span><a class="blue-button" href="">Detail</a></span>
                    </div>';
                }
            }else{
                echo "<h6>No Data (".$pendaftar->num_rows.")</h6>";
            }
        ?>
    </div>
</div>
<div id="detail-container" class="white-container">
    <h1>Data Pendaftar</h1>
    <hr>
    <table class="table-template">
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
    <br>
    <table class="table-template">
        <tr>
            <td>Pilihan 1</td>
            <td>: </td>
        </tr>
        <tr>
            <td>Pilihan 2</td>
            <td>: </td>
        </tr>
    </table>
    <br>
    <table class="table-template">
        <tr>
            <td>Jalur</td>
            <td>: </td>
        </tr>
    </table>
    <br>
    <table class="table-template">
        <tr>
            <td>Tanggal Enroll</td>
            <td>: </td>
        </tr>
    </table>
    <br>
    <!-- Data enroll -->
    <p>Detail Enroll</p>
    <table class="table-template">
        <tr>
            <td>Peminatan</td>
            <td>: </td>
        </tr>
        <tr>
            <td>Matematika</td>
            <td>: </td>
        </tr>
        <tr>
            <td>IPA</td>
            <td>: </td>
        </tr>
        <tr>
            <td>IPS</td>
            <td>: </td>
        </tr>
        <tr>
            <td>Bahasa Indonesia</td>
            <td>: </td>
        </tr>
        <tr>
            <td>Bahasa Inggris</td>
            <td>: </td>
        </tr>
    </table>
    <table class="table-template">
        <tr>
            <td>Nomor UTBK</td>
            <td>: </td>
        </tr>
        <tr>
            <td>Skor UTBK</td>
            <td>: </td>
        </tr>
    </table>
    <br>
    <div class="input-row">
        <td><a class="red-button" href="">TDK LOLOS</a></td>
        <td><a class="blue-button" href="">LOLOS</a></td>
    </div>
</div>

