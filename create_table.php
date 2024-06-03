<?php 
require 'db_connect.php';

$sqls = [
    "CREATE TABLE pendaftar(
        id_pendaftar varchar(8) PRIMARY KEY, 
        nama_pendaftar varchar(60), 
        email varchar(20),password varchar(255), 
        pendidikan_terakhir varchar(30), 
        tanggal_lahir date, alamat varchar(255), 
        status_perkawinan varchar(11), 
        no_telepon varchar(15)
    )",
    "CREATE TABLE asesor(
        id_asesor varchar(8) PRIMARY KEY, 
        nama_asesor varchar(8), username varchar(8), 
        password varchar(8)
    )",
    "CREATE TABLE jalur(
        id_jalur varchar(6) PRIMARY KEY, 
        jenis varchar(30), 
        nama varchar(50), 
        jenjang varchar(30), 
        tanggal_dibuka datetime, 
        tanggal_ditutup datetime
    )",
    "CREATE TABLE fakultas(
        id_fakultas varchar(2) PRIMARY KEY, 
        nama_fak varchar(30), 
        singkatan varchar(8)
    )",
    "CREATE TABLE prodi(id_prodi varchar(6) PRIMARY KEY, 
        nama_prodi varchar(30), 
        fk_fakultas varchar(2), 
        jenjang varchar(10), 
        biaya_pendidikan bigint, 
        kuota smallint, 
        kuota_tersisa smallint,
        FOREIGN KEY(fk_fakultas) REFERENCES fakultas(id_fakultas)
    )",
    "CREATE TABLE ujian(
        id_ujian varchar(8) PRIMARY KEY, 
        username varchar(30), 
        password varchar(255), 
        mulai_ujian datetime, 
        selesai_ujian datetime, 
        nilai smallint
    )",
    "CREATE TABLE prestasi(
        id_prestasi varchar(8) PRIMARY KEY, 
        nama_prestasi varchar(8), 
        bidang varchar(8), 
        tingkat varchar(13), 
        peringkat varchar(8), 
        link text
    )",
    "CREATE TABLE rapor_utbk(
        id_rapor varchar(8) PRIMARY KEY, 
        mtk tinyint, 
        ipa tinyint, 
        ips tinyint, 
        bindo tinyint, 
        bing tinyint, 
        nilai_utbk smallint, 
        nomor_utbk varchar(12)
    )",
    "CREATE TABLE enroll(
        tanggal_daftar datetime, 
        fk_jalur varchar(6), 
        fk_pendaftar varchar(8), 
        fk_prodi_1 varchar(6), 
        fk_prodi_2 varchar(6), 
        fk_ujian varchar(8), 
        fk_rapor varchar(8), 
        fk_prestasi varchar(8), 
        lulus boolean, 
        fk_asesor varchar(8), 
        FOREIGN KEY(fk_pendaftar) REFERENCES pendaftar(id_pendaftar),
        FOREIGN KEY(fk_jalur) REFERENCES jalur(id_jalur),
        FOREIGN KEY(fk_prodi_1) REFERENCES prodi(id_prodi),
        FOREIGN KEY(fk_prodi_2) REFERENCES prodi(id_prodi),
        FOREIGN KEY(fk_ujian) REFERENCES ujian(id_ujian),
        FOREIGN KEY(fk_rapor) REFERENCES rapor_utbk(id_rapor),
        FOREIGN KEY(fk_prestasi) REFERENCES prestasi(id_prestasi),
        FOREIGN KEY(fk_asesor) REFERENCES asesor(id_asesor)
    )",
    // "drop table jalur"
];

// SQL to create table
$index = 1;
foreach($sqls as $sql){

    try{
        conn()->query($sql);
        echo "Table created successfully \n";
        $index++;

    }catch (PDOException $e) { 
        echo "\nError creating table (".$index."): " . $e->getMessage();
        
    }
}



?>