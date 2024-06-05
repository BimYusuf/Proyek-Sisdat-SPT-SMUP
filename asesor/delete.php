<?php
session_start();
require_once '../db_connect.php';
$data = $_GET['data'];
$id= $_GET['id'];

$id_name = 'id_'.$data;
echo "DELETE FROM $data WHERE $id_name = $id";
conn()->query("DELETE FROM $data WHERE $id_name = $id");

header("Location: /asesor/asesor-dashboard.php");


?>