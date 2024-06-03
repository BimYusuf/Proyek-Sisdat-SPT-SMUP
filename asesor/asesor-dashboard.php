<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPT SMUP - Asesor Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="shaded-background">
    <div class="singly-container grid-place">
        <div id="data-asesor-container" class="white-container">
            <h1>DATA ASESOR</h1>
            <hr>
            <table id="data-asesor" class="table-template">
                <tr>
                    <td>ID Asesor</td>
                    <td>: </td>
                </tr>
                <tr>
                    <td>Nama Aesor</td>
                    <td>: </td>
                </tr>
            </table>
        </div>
        <div id="asesor-tab">
            <button class="tab-active" onclick="showDataUniv()">Data Universitas</button>
            <button onclick="showDataPendaftar()">Data Pendaftar</button>
        </div>
        <?php include "data-univ.html" ?>
        <?php include "data-pendaftar.html" ?>
    </div>

    <?php include "../footer.html" ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>
</html>