<?php
include "koneksi.php";
$data = mysqli_query($conn, "SELECT * FROM sertifikat ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Sertifikat</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Data Sertifikat</span>
		<span class="navbar-brand">
        <a href="tambah_data.php" class="btn btn-success">Tambah Data</a>
		 <a href="index.html" class="btn btn-success">Home</a> </span>
    </div>
</nav>

<div class="container py-5">
    <div class="bg-white p-4 rounded-4 shadow">
        <h3 class="mb-4 text-center">Daftar Sertifikat</h3>

        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Items</th>
                    <th>Tanggal</th>
                    <th>Masa Berlaku</th>
                    <th>Link Dokumen</th>
                </tr>
            </thead>

            <tbody>
                <?php $no=1; while($row = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['items']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['masa_berlaku']; ?></td>
                    <td><a href="<?= $row['link_dokumen']; ?>" target="_blank" class="btn btn-info btn-sm">Buka</a></td>
					<td><a href="koreksi.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Koreksi</a> <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">Delete
                    </a> </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
