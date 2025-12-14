<?php
include "koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM sertifikat WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $items = $_POST['items'];
    $tanggal = $_POST['tanggal'];
    $masa = $_POST['masa_berlaku'];
    $link = $_POST['link'];

    mysqli_query($conn, 
        "UPDATE sertifikat SET 
            items='$items',
            tanggal='$tanggal',
            masa_berlaku='$masa',
            link_dokumen='$link'
         WHERE id='$id'"
    );

    header("Location: view_data.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Koreksi Data Sertifikat</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="col-lg-6 mx-auto bg-white p-5 rounded-4 shadow">

        <h3 class="text-center mb-4">Koreksi Data Sertifikat</h3>

        <form method="POST">

            <label>Items</label>
            <input type="text" name="items" value="<?= $row['items']; ?>" class="form-control mb-3" required>

            <label>Tanggal</label>
            <input type="date" name="tanggal" value="<?= $row['tanggal']; ?>" class="form-control mb-3" required>

            <label>Masa Berlaku</label>
            <input type="date" name="masa_berlaku" value="<?= $row['masa_berlaku']; ?>" class="form-control mb-3" required>

            <label>Link Dokumen</label>
            <input type="text" name="link" value="<?= $row['link_dokumen']; ?>" class="form-control mb-4">

            <button class="btn btn-success w-100 rounded-pill" name="update">Update Data</button>
        </form>

        <a href="view_data.php" class="btn btn-secondary w-100 mt-3 rounded-pill">Kembali</a>

    </div>
</div>

</body>
</html>
