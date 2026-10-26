<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit("Metode request tidak diizinkan.");
}

$nimInput = $_POST["nim"] ?? null;
if (!array_key_exists("nim", $_POST) || !is_string($nimInput)) {
  http_response_code(400);
  exit("NIM tidak valid.");
}

$nim = trim($nimInput);
if (strlen($nim) > 10) {
  http_response_code(400);
  exit("NIM tidak valid.");
}

require_once __DIR__ . "/connection.php";
require_once __DIR__ . "/photo_table.php";

if (!mysqli_select_db($conn, "dbNilai")) {
  http_response_code(500);
  exit("Gagal memilih database dbNilai: " . mysqli_error($conn));
}

try {
  ensureStudentPhotoTable($conn);
} catch (Throwable $error) {
  http_response_code(500);
  exit("Gagal menyiapkan relasi foto: " . htmlspecialchars($error->getMessage(), ENT_QUOTES, "UTF-8"));
}

mysqli_begin_transaction($conn);
$stmt = mysqli_prepare($conn, "DELETE FROM nilai WHERE nim = ?");
if (!$stmt) {
  mysqli_rollback($conn);
  http_response_code(500);
  exit("Gagal menyiapkan penghapusan data: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $nim);
if (!mysqli_stmt_execute($stmt)) {
  $error = mysqli_stmt_error($stmt);
  mysqli_stmt_close($stmt);
  mysqli_rollback($conn);
  http_response_code(500);
  exit("Gagal menghapus data nilai: " . $error);
}

if (mysqli_stmt_affected_rows($stmt) === 0) {
  mysqli_stmt_close($stmt);
  mysqli_rollback($conn);
  mysqli_close($conn);
  header("Location: viewdata.php?status=not_found");
  exit;
}

mysqli_stmt_close($stmt);

$photoLink = mysqli_prepare($conn, "DELETE FROM nilai_photo WHERE nim = ?");
if (!$photoLink) {
  mysqli_rollback($conn);
  http_response_code(500);
  exit("Gagal menyiapkan penghapusan relasi foto: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($photoLink, "s", $nim);
if (!mysqli_stmt_execute($photoLink)) {
  $error = mysqli_stmt_error($photoLink);
  mysqli_stmt_close($photoLink);
  mysqli_rollback($conn);
  http_response_code(500);
  exit("Gagal menghapus relasi foto: " . $error);
}
mysqli_stmt_close($photoLink);

if (!mysqli_commit($conn)) {
  mysqli_rollback($conn);
  http_response_code(500);
  exit("Gagal menyelesaikan penghapusan data.");
}

mysqli_close($conn);

header("Location: viewdata.php?status=deleted");
exit;
