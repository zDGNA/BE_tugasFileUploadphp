<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama_foto = $_POST["nama_foto"];
    $file_path = "foto/" . $nama_foto;

    if (file_exists($file_path)) {
        unlink($file_path); 
    }

    $stmt = mysqli_prepare($con, "DELETE FROM foto WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "<script>alert('Foto berhasil dihapus'); window.location='index.php';</script>";
}
?>
