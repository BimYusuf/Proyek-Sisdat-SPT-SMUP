<div id="data-fakultas-container" class="white-container">
    <h1>Fakultas</h1>
    <hr>
    <div class="tabel-fakultas">
        <?php 
            $index = 1;
            if($fakultas->num_rows > 0){
                for ($row_no = 0; $row_no < $fakultas->num_rows; $row_no++) {
                    $fakultas->data_seek($row_no);
                    $row = $fakultas->fetch_assoc();
                    echo '<div class="tabel-row">
                        <span>'.$index++.'</span>
                        <span>'.$row['nama_fak'].'</span>
                        <span>'.$row['singkatan'].'</span>
                        <span><a class="red-button" href="/asesor/delete.php?data=fakultas&id='.$row['id_fakultas'].'">Hapus</a></span>
                    </div>';
                }
            }else{
                echo "<h6>No Data (".$fakultas->num_rows.")</h6>";
            }
        ?>
    </div>
</div>
<div id="prodi-container" class="white-container">
    <h1>Program Studi</h1>
    <hr>
    <div class="tabel-prodi">
        <?php 
            $index = 1;
            if($prodi->num_rows > 0){
                for ($row_no = 0; $row_no < $prodi->num_rows; $row_no++) {
                    $prodi->data_seek($row_no);
                    $row = $prodi->fetch_assoc();
                    echo '<div class="tabel-row">
                        <span>'.$index++.'</span>
                        <span>'.$row['nama_prodi'].'</span>
                        <span>'.$row['jenjang'].'</span>
                        <span>Kursi:'.$row['kuota'].'</span>
                        <span>Sisa:'.$row['kuota_tersisa'].'</span>
                        <span><a class="red-button" href="/asesor/delete.php?data=prodi&id='.$row['id_prodi'].'">Hapus</a></span>
                    </div>';
                }
            }else{
                echo "<h6>No Data (".$prodi->num_rows.")</h6>";
            }

        ?>
    </div>
</div>
<div id="table-jalur-container" class="white-container">
    <h1>Jalur</h1>
    <hr>
    <div class="tabel-jalur">
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
                        <span><a class="red-button" href="/asesor/delete.php?data=jalur&id='.$row['id_jalur'].'">Hapus</a></span>
                    </div>';
                }
            }else{
                echo "<h6>No Data (".$jalur->num_rows.")</h6>";
            }

        ?>
    </div>
</div>
<div id="tambah-data-container" class="white-container">
    <div id="data-selector">
        <button class="select-active" onclick="showJalur()">Jalur</button>
        <button onclick="showFakultas()">Fakultas</button>
        <button onclick="showProdi()">Program Studi</button>
    </div>
    <h1>Tambah Jalur</h1>
    <hr>
    <form id="form-jalur" action="asesor-dashboard.php" method="POST">
        <br>
        <input type="hidden" name="data" value="jalur">
        <div class="input-row">        
            <div class="input-box">
                <label for="">ID Jalur</label>
                <input class="input-signin" type="text" name="id" >
            </div>
        </div>
        <div class="input-row">        
            <div class="input-box">
                <label for="">Nama Jalur</label>
                <input class="input-signin" type="text" name="nama" >
            </div>
        </div>
        <div class="input-row">
            <div class="input-box">
                <label for="">Skema</label>
                <input class="input-signin" type="text" name="skema" id="">
            </div>
        </div>
        <div class="input-row">
            <div class="input-box">
                <label for="">Jenjang</label>
                <input class="input-signin" type="text" name="jenjang" id="">
            </div>
        </div>
        <div class="input-row">
            <div class="input-box">
                <label for="">Tanggal Dibuka</label>
                <input class="input-signin" type="date" name="dibuka" id="">
            </div>
        </div>
        <div class="input-row">
            <div class="input-box">
                <label for="">Tanggal Ditutup</label>
                <input class="input-signin" type="date" name="ditutup" id="">
            </div>
        </div>
        <div class="input-row">
            <button class="blue-button" type="submit">Submit</button>
        </div>
    </form>

    <form id="form-fakultas" action="/asesor/asesor-dashboard.php" method="POST">
        <br>
        <input type="hidden" name="data" value="fakultas">
        <div class="input-row">        
            <div class="input-box">
                <label for="">ID Fakultas</label>
                <input class="input-signin" type="text" name="id" >
            </div>
        </div>
        <div class="input-row">
            <div class="input-box">
                <label for="">Nama Fakultas</label>
                <input class="input-signin" type="text" name="nama" id="">
            </div>
        </div>
        <div class="input-row">
            <div class="input-box">
                <label for="">Singkatan</label>
                <input class="input-signin" type="text" name="singkatan" id="">
            </div>
        </div>
        <div class="input-row">
            <button class="blue-button" type="submit">Submit</button>
        </div>
    </form>

    <form id="form-prodi" action="asesor-dashboard.php" method="POST">
        <br>
        <input type="hidden" name="data" value="prodi">
        <div class="input-row">        
            <div class="input-box">
                <label for="">ID Program Studi</label>
                <input class="input-signin" type="text" name="id" >
            </div>
            <div class="input-box">
                <label for="">Nama Program Studi (jangan disingkat)</label>
                <input class="input-signin" type="text" name="nama" >
            </div>
        </div>
        <div class="input-row">
            <div class="input-box">
                <label for="">Fakultas</label>
                <select class="input-signin" name="fakultas" id="">
                    <?php 
                        for ($row_no = 0; $row_no < $fakultas->num_rows; $row_no++) {
                            $fakultas->data_seek($row_no);
                            $row = $fakultas->fetch_assoc();
                            echo '<option value="'.$row["id_fakultas"].'">'.$row['nama_fak'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="input-box">
                <label for="">Nama Fakultas</label>
                <select class="input-signin" name="jenjang" id="">
                    <option value="Diploma 3">Diploma 3</option>
                    <option value="Diploma 4">Diploma 4</option>
                    <option value="arjana">Sarjana</option>
                    <option value="Vokasi">Vokasi</option>
                    <option value="Master">Master</option>
                    <option value="Doctor">Doctor</option>
                </select>
            </div>
        </div>
        <div class="input-row">
            <div class="input-box">
                <label for="">Biaya Pendidikan</label>
                <input class="input-signin" type="number" name="biaya_pendidikan" id="">
            </div>
            <div class="input-box">
                <label for="">Kuota</label>
                <input class="input-signin" type="number" name="kuota" id="">
            </div>
        </div>
        <div class="input-row">
            <button class="blue-button" type="submit">Submit</button>
        </div>
    </form>
</div>