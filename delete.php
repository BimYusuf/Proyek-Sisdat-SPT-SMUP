<?php
session_start();
require_once 'db_connect.php';
$id_jalur = $_GET['enroll-id'];
$id_pendaftar = $_SESSION['email'];

$table_jalur = [
    '111111' => ["rapor_utbk", "id_rapor"],
    '222222' => ["ujian", "id_ujian"],
    '333333' => ["prestasi", "id_prestasi"]
];

conn()->query("DELETE FROM enroll WHERE fk_pendaftar = $id_pendaftar AND fk_jalur = $id_jalur");

header("Location: pendaftar/");


?>