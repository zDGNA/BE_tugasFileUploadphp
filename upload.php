<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = basename($_FILES["foto"]["name"]);
    $target_dir = "foto/";
    $target_file = $target_dir . $file_name;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOK = 1;

    if (file_exists($target_file)) {
        echo "<script>alert('Nama file sudah ada. Ganti nama file.'); window.location='index.php';</script>";
        $uploadOK = 0;
    }

    if (!in_array($fileType, ['jpg', 'jpeg', 'png'])) {
        echo "<script>alert('Jenis file tidak diizinkan. Hanya JPG, JPEG, PNG.'); window.location='index.php';</script>";
        $uploadOK = 0;
    }

    if ($uploadOK == 1) {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $stmt = mysqli_prepare($con, "INSERT INTO foto (nama_foto) VALUES (?)");
            mysqli_stmt_bind_param($stmt, "s", $file_name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "<script>alert('Foto berhasil di-upload'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Upload gagal'); window.location='index.php';</script>";
        }
    }
}
?>
