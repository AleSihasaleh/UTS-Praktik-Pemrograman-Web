<?php
require_once __DIR__ . "/connection.php";
require_once __DIR__ . "/photo_table.php";

try {
  ensurePhotoTable($conn);
} catch (Throwable $error) {
  http_response_code(500);
  exit("Gagal menyiapkan daftar foto: " . htmlspecialchars($error->getMessage(), ENT_QUOTES, "UTF-8"));
}

$result = mysqli_query($conn, "SELECT id, nama_file, path_file, uploaded_at FROM photo ORDER BY id DESC");
if (!$result) {
  http_response_code(500);
  exit("Gagal membaca tabel photo: " . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, "UTF-8"));
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Foto</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 2rem; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 0.75rem; text-align: left; }
    th { background: #f4f4f4; }
    .preview img { width: 100px; height: auto; }
  </style>
</head>
<body>
  <h1>Daftar Foto</h1>
  <p><a href="form_upload.php">Unggah foto baru</a></p>

  <?php if (mysqli_num_rows($result) === 0): ?>
    <p>Belum ada foto yang diunggah.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama File</th>
          <th>Tanggal Diunggah</th>
          <th>Pratinjau</th>
        </tr>
      </thead>
      <tbody>
        <?php $number = 1; ?>
        <?php while ($photo = mysqli_fetch_assoc($result)):
          $fileName = basename($photo["path_file"]);
          $imagePath = "img/" . rawurlencode($fileName);
          $imageExists = $fileName !== "" && is_file(__DIR__ . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . $fileName);
        ?>
          <tr>
            <td><?php echo $number++; ?></td>
            <td><?php echo htmlspecialchars($photo["nama_file"], ENT_QUOTES, "UTF-8"); ?></td>
            <td><?php echo htmlspecialchars($photo["uploaded_at"], ENT_QUOTES, "UTF-8"); ?></td>
            <td class="preview">
              <?php if ($imageExists): ?>
                <img
                  src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, "UTF-8"); ?>"
                  alt="<?php echo htmlspecialchars($photo["nama_file"], ENT_QUOTES, "UTF-8"); ?>"
                >
              <?php else: ?>
                File gambar tidak ditemukan.
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
