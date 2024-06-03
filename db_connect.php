<?php
function conn() {
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "smup";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    return $conn;
}
?>
