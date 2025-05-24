<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
    
    <div class="card w-100 shadow-sm mb-4" style="max-width: 500px;">
        <div class="card-header text-white text-center" style="background-color:rgb(49, 141, 246)">
            <h4>Upload Foto</h4>
        </div>
        <div class="card-body">
            <form action="upload.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmUpload()">
                <div class="mb-3">
                    <label for="foto" class="form-label">Pilih File:</label>
                    <input type="file" class="form-control" name="foto" id="foto" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Upload</button>
            </form>
        </div>
    </div>

    <div class="card w-100 shadow-sm" style="max-width: 500px;">
        <div class="card-header text-white text-center" style="background-color:rgb(49, 141, 246)">
            <h4>Daftar Foto</h4>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <?php
                require "koneksi.php";
                $qry = mysqli_query($con, "SELECT * FROM foto ORDER BY uploaded_at DESC");
                while ($data = mysqli_fetch_assoc($qry)) {
                ?>
                <div class="d-flex flex-column align-items-center" style="width: 120px; height: 160px; border: 1px solid #ddd; padding: 8px; border-radius: 6px;">
                    <img src="foto/<?= htmlspecialchars($data['nama_foto']) ?>" class="img-thumbnail mb-2" style="max-width: 100px; max-height: 100px; object-fit: contain;">
                    <form action="delete.php" method="POST" class="mt-auto w-100" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <input type="hidden" name="nama_foto" value="<?= htmlspecialchars($data['nama_foto']) ?>">
                        <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
function confirmUpload() {
    return confirm('Apakah Anda yakin ingin meng-upload file ini?');
}
</script>
</body>
</html>
