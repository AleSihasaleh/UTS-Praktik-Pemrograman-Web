<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Upload Foto</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="photo">Pilih foto (JPG, JPEG, PNG, atau GIF; maksimal 1 MB):</label><br><br>
        <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/gif" required>
        <br><br>
        <button type="submit" name="submit">Unggah</button>
    </form>
</body>