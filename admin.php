<?php 
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}
	session_destroy();

include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $items = $_POST['items'];
    $tanggal = $_POST['tanggal'];
    $masa = $_POST['masa_berlaku'];
    $link = $_POST['link_dokumen'];

    $sql = "INSERT INTO sertifikat (items, tanggal, masa_berlaku, link_dokumen)
            VALUES ('$items', '$tanggal', '$masa', '$link')";
    mysqli_query($conn, $sql);

    $msg = "Data sertifikat berhasil disimpan!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Entri Sertifikat</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Halaman Admin</span>
		<span class="navbar-brand">
        <a href="view_data.php" class="btn btn-success">Lihat Data</a>
		<a href="index.html" class="btn btn-success">Home</a> </span>
    </div>
</nav>

<div class="container py-5">
    <div class="col-lg-6 mx-auto bg-white p-5 rounded-4 shadow">

        <h3 class="text-center mb-4">Entri Data Sertifikat</h3>

        <?php if (!empty($msg)) : ?>
            <div class="alert alert-success text-center"><?= $msg ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Items</label>
            <input type="text" name="items" class="form-control mb-3" required>

            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control mb-3" required>

            <label>Masa Berlaku</label>
            <input type="date" name="masa_berlaku" class="form-control mb-3" required>

            <label>Link Dokumen</label>
            <input type="text" name="link_dokumen" class="form-control mb-4" placeholder="URL sertifikat">

            <button class="btn btn-success w-100 rounded-pill">Simpan Data</button>
        </form>
    </div>
</div>

</body>
</html>
