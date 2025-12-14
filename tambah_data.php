<?php
session_start();
include "koneksi.php"; // koneksi database

// Cek login admin
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

$error = "";

// Proses form submit
if(isset($_POST['submit'])){
    // Ambil input dari form
    $items = mysqli_real_escape_string($conn, $_POST['Item'] ?? '');
    $tanggal = $_POST['Tanggal'] ?? '';
    $masa_berlaku = $_POST['MasaBerlaku'] ?? '';
    $link_dokumen = mysqli_real_escape_string($conn, $_POST['LinkDokumen'] ?? '');
    
    // Upload file (opsional)
    $file = "";
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
        $uploadDir = "uploads/";
        // pastikan folder uploads ada
        if(!is_dir($uploadDir)){
            mkdir($uploadDir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES['file']['name']);
        $target = $uploadDir . $file_name;

        if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){
            $file = $file_name;
        } else {
            $error = "Gagal upload file!";
        }
    }

    if($error == ""){
        $query = mysqli_query($conn, "INSERT INTO sertifikat (items, tanggal, masa_berlaku, link_dokumen) VALUES ('$items', '$tanggal', '$masa_berlaku', '$link_dokumen')");
        if($query){
            // Redirect ke view_data.php setelah berhasil
            header("Location: view_data.php");
            exit;
        } else {
            $error = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Sertifikat</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
body { font-family: 'Nunito', sans-serif; background: #fdf5f7; padding-top: 50px; }
.card { border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
</style>
</head>
<body>
<div class="container">
    <div class="card p-4 mx-auto" style="max-width: 600px;">
        <h3 class="text-center mb-4">Tambah Data Sertifikat</h3>

        <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Item</label>
                <input type="text" name="Item" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="Tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Masa Berlaku</label>
                <input type="date" name="MasaBerlaku" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Link Dokumen</label>
                <textarea name="LinkDokumen" rows="2" class="form-control"></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="submit" class="btn btn-success">Tambah Sertifikat</button>
                <a href="view_data.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
