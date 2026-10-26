<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit("Metode request tidak diizinkan.");
}

$nimInput = $_POST["nim"] ?? "";
$namaInput = $_POST["nm_lengkap"] ?? "";
$nilaiInput = $_POST["nilai_akhir"] ?? "";
$fotoIdInput = $_POST["foto_id"] ?? "";

if (!is_string($nimInput) || !is_string($namaInput) || !is_string($fotoIdInput)) {
  http_response_code(400);
  exit("NIM, nama, dan pilihan foto harus berupa teks.");
}

$nim = trim($nimInput);
$nama = trim($namaInput);
if ($nim === "" || strlen($nim) > 10 || $nama === "" || strlen($nama) > 100) {
  http_response_code(400);
  exit("NIM wajib diisi (maksimal 10 karakter) dan nama wajib diisi (maksimal 100 karakter).");
}

if (!is_string($nilaiInput) || !is_numeric($nilaiInput)) {
  http_response_code(400);
  exit("Nilai akhir harus berupa angka.");
}

$nilaiAkhir = (float) $nilaiInput;
if (!is_finite($nilaiAkhir) || $nilaiAkhir < 0 || $nilaiAkhir > 100) {
  http_response_code(400);
  exit("Nilai akhir harus berada di antara 0 dan 100.");
}

if ($nilaiAkhir >= 80) {
  $nilaiHuruf = "A";
  $predikat = "Sangat Memuaskan";
} elseif ($nilaiAkhir >= 70) {
  $nilaiHuruf = "B";
  $predikat = "Memuaskan";
} elseif ($nilaiAkhir >= 60) {
  $nilaiHuruf = "C";
  $predikat = "Cukup Memuaskan";
} elseif ($nilaiAkhir >= 50) {
  $nilaiHuruf = "D";
  $predikat = "Kurang Memuaskan";
} else {
  $nilaiHuruf = "E";
  $predikat = "Tidak Lulus";
}

require_once __DIR__ . "/connection.php";

if (!mysqli_select_db($conn, "dbNilai")) {
  http_response_code(500);
  exit("Gagal memilih database dbNilai: " . mysqli_error($conn));
}

require_once __DIR__ . "/photo_table.php";
try {
  ensurePhotoTable($conn);
  ensureStudentPhotoTable($conn);
} catch (Throwable $error) {
  http_response_code(500);
  exit("Gagal menyiapkan foto profil: " . htmlspecialchars($error->getMessage(), ENT_QUOTES, "UTF-8"));
}

$fotoId = null;
$fotoPath = null;
if (trim($fotoIdInput) !== "") {
  $fotoId = filter_var($fotoIdInput, FILTER_VALIDATE_INT);
  if ($fotoId === false || $fotoId < 1) {
    http_response_code(400);
    exit("Pilihan foto profil tidak valid.");
  }

  $photoCheck = mysqli_prepare($conn, "SELECT path_file FROM photo WHERE id = ?");
  if (!$photoCheck) {
    http_response_code(500);
    exit("Gagal memeriksa foto profil: " . mysqli_error($conn));
  }
  mysqli_stmt_bind_param($photoCheck, "i", $fotoId);
  mysqli_stmt_execute($photoCheck);
  $photoExists = mysqli_stmt_get_result($photoCheck);
  $photoRow = $photoExists ? mysqli_fetch_assoc($photoExists) : null;
  mysqli_stmt_close($photoCheck);
  if (!$photoRow) {
    http_response_code(400);
    exit("Foto profil yang dipilih tidak ditemukan.");
  }
  $fotoPath = $photoRow["path_file"];
}

mysqli_begin_transaction($conn);
$stmt = mysqli_prepare(
  $conn,
  "INSERT INTO nilai (nim, nm_lengkap, nilai_akhir, nilai_huruf, predikat, file_path)
   VALUES (?, ?, ?, ?, ?, ?)"
);

if (!$stmt) {
  mysqli_rollback($conn);
  http_response_code(500);
  exit("Gagal menyiapkan penyimpanan data: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssdsss", $nim, $nama, $nilaiAkhir, $nilaiHuruf, $predikat, $fotoPath);

if (!mysqli_stmt_execute($stmt)) {
  $error = mysqli_stmt_error($stmt);
  mysqli_stmt_close($stmt);
  mysqli_rollback($conn);
  http_response_code(500);
  exit("Gagal menyimpan data nilai: " . $error);
}

mysqli_stmt_close($stmt);

if ($fotoId !== null) {
  $photoLink = mysqli_prepare(
    $conn,
    "INSERT INTO nilai_photo (nim, photo_id) VALUES (?, ?)
     ON DUPLICATE KEY UPDATE photo_id = VALUES(photo_id)"
  );
  if (!$photoLink) {
    mysqli_rollback($conn);
    http_response_code(500);
    exit("Gagal menyiapkan relasi foto profil: " . mysqli_error($conn));
  }
  mysqli_stmt_bind_param($photoLink, "si", $nim, $fotoId);
  if (!mysqli_stmt_execute($photoLink)) {
    $error = mysqli_stmt_error($photoLink);
    mysqli_stmt_close($photoLink);
    mysqli_rollback($conn);
    http_response_code(500);
    exit("Gagal menyimpan foto profil: " . $error);
  }
  mysqli_stmt_close($photoLink);
}

if (!mysqli_commit($conn)) {
  mysqli_rollback($conn);
  http_response_code(500);
  exit("Gagal menyelesaikan penyimpanan data nilai.");
}

mysqli_close($conn);

header("Location: viewdata.php?status=success");
exit;
