<?php 

require 'db_connect.php';

// status connection
if (conn()->connect_error) {
    $conn_status = "Connection failed: " . $conn->connect_error;
}else{
    $conn_status = "Everything seems fine :) ";
}

// jumlah tabel
$result = conn()->query("SHOW TABLES");
$tables = [];
while ($row = $result->fetch_array(MYSQLI_NUM)) {
    $tables[] = $row[0];
}
$tableCount = count($tables);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Debug</title>
    <style>
        body {
            background-color: black;
        }
        table{
            border-collapse: collapse;
        }
        td{
            border: 1px solid white;
            color: white;
            padding: 2px 12px;
        }
    </style>
</head>
<body>
        <table>
            <tr>
                <td>Database Connection</td>
                <td><?php echo $conn_status?></td>
            </tr>
            <tr>
                <td>Number of Tables</td>
                <td><?php echo $tableCount?></td>
            </tr>
        </table>
</body>
</html>