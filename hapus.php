<?php
include "koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM sertifikat WHERE id='$id'");

header("Location: view_data.php");
exit;
?>
