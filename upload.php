<?php
function showUploadResult(string $message, bool $success = false, ?mysqli $conn = null): void
{
  if ($conn instanceof mysqli) {
    mysqli_close($conn);
  }

  $heading = $success ? "Upload berhasil" : "Upload gagal";
  $status = $success ? 200 : 400;
  http_response_code($status);

  echo '<!doctype html><html lang="id"><meta charset="utf-8"><title>'
    . htmlspecialchars($heading, ENT_QUOTES, "UTF-8")
    . '</title><body><p>'
    . htmlspecialchars($message, ENT_QUOTES, "UTF-8")
    . '</p><p><a href="form_upload.php">Kembali ke form upload</a></p></body></html>';
  exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit("Metode request tidak diizinkan.");
}

if (!isset($_FILES["photo"]) || !is_array($_FILES["photo"])) {
  showUploadResult("Pilih file gambar untuk diunggah.");
}

$photo = $_FILES["photo"];
if ($photo["error"] !== UPLOAD_ERR_OK || !is_uploaded_file($photo["tmp_name"])) {
  showUploadResult("File gagal diunggah. Silakan pilih file kembali.");
}

if ($photo["size"] > 1000000) {
  showUploadResult("Ukuran file maksimal 1 MB.");
}

$imageInfo = getimagesize($photo["tmp_name"]);
$extension = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));
$allowedTypes = [
  "jpg" => "image/jpeg",
  "jpeg" => "image/jpeg",
  "png" => "image/png",
  "gif" => "image/gif",
];

if (
  $imageInfo === false ||
  !isset($allowedTypes[$extension]) ||
  $imageInfo["mime"] !== $allowedTypes[$extension]
) {
  showUploadResult("File harus berupa gambar JPG, JPEG, PNG, atau GIF yang valid.");
}

$uploadDirectory = __DIR__ . DIRECTORY_SEPARATOR . "img";
if (!is_dir($uploadDirectory) || !is_writable($uploadDirectory)) {
  showUploadResult("Folder img tidak tersedia atau tidak dapat ditulisi.");
}

require_once __DIR__ . "/connection.php";
require_once __DIR__ . "/photo_table.php";

try {
  ensurePhotoTable($conn);
} catch (Throwable $error) {
  showUploadResult("Gagal menyiapkan tabel photo: " . $error->getMessage(), false, $conn);
}

$savedName = bin2hex(random_bytes(16)) . "." . $extension;
$relativePath = "img/" . $savedName;
$destination = $uploadDirectory . DIRECTORY_SEPARATOR . $savedName;

if (!move_uploaded_file($photo["tmp_name"], $destination)) {
  showUploadResult("File gambar tidak dapat disimpan ke folder img.");
}

$originalName = basename($photo["name"]);
$stmt = null;
try {
  $stmt = mysqli_prepare(
    $conn,
    "INSERT INTO photo (nama_file, path_file) VALUES (?, ?)"
  );

  if (!$stmt) {
    throw new RuntimeException("Gagal menyiapkan penyimpanan data foto: " . mysqli_error($conn));
  }

  mysqli_stmt_bind_param($stmt, "ss", $originalName, $relativePath);
  if (!mysqli_stmt_execute($stmt)) {
    throw new RuntimeException("Gagal menyimpan data foto ke database: " . mysqli_stmt_error($stmt));
  }
} catch (Throwable $error) {
  if ($stmt instanceof mysqli_stmt) {
    mysqli_stmt_close($stmt);
  }
  unlink($destination);
  showUploadResult($error->getMessage(), false, $conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

showUploadResult("File " . $originalName . " berhasil diunggah dan dicatat pada tabel photo.", true);
