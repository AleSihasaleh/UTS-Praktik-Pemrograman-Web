<?php
function ensurePhotoTable(mysqli $conn): void
{
  if (!mysqli_select_db($conn, "dbNilai")) {
    throw new RuntimeException("Gagal memilih database dbNilai: " . mysqli_error($conn));
  }

  $tableCheck = mysqli_prepare(
    $conn,
    "SELECT table_name
     FROM information_schema.tables
     WHERE table_schema = DATABASE() AND table_name IN ('photo', 'tabel_foto')"
  );
  if (!$tableCheck || !mysqli_stmt_execute($tableCheck)) {
    throw new RuntimeException("Gagal memeriksa tabel foto: " . mysqli_error($conn));
  }

  $result = mysqli_stmt_get_result($tableCheck);
  if (!$result) {
    mysqli_stmt_close($tableCheck);
    throw new RuntimeException("Gagal membaca daftar tabel foto: " . mysqli_error($conn));
  }

  $tables = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $tables[$row["table_name"]] = true;
  }
  mysqli_stmt_close($tableCheck);

  if (!isset($tables["photo"]) && isset($tables["tabel_foto"])) {
    if (!mysqli_query($conn, "RENAME TABLE tabel_foto TO photo")) {
      throw new RuntimeException("Gagal mengganti nama tabel tabel_foto: " . mysqli_error($conn));
    }
    return;
  }

  if (!isset($tables["photo"])) {
    $createTableSql = "CREATE TABLE photo (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nama_file VARCHAR(255) NOT NULL,
      path_file VARCHAR(255) NOT NULL,
      uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if (!mysqli_query($conn, $createTableSql)) {
      throw new RuntimeException("Gagal membuat tabel photo: " . mysqli_error($conn));
    }
    return;
  }

  if (isset($tables["tabel_foto"])) {
    $migrateSql = "INSERT INTO photo (nama_file, path_file, uploaded_at)
      SELECT old_photo.nama_file, old_photo.path_file, old_photo.uploaded_at
      FROM tabel_foto AS old_photo
      WHERE NOT EXISTS (
        SELECT 1 FROM photo WHERE photo.path_file = old_photo.path_file
      )";
    if (!mysqli_query($conn, $migrateSql)) {
      throw new RuntimeException("Gagal memindahkan data dari tabel_foto: " . mysqli_error($conn));
    }
  }
}

function ensureStudentPhotoTable(mysqli $conn): void
{
  $createTableSql = "CREATE TABLE IF NOT EXISTS nilai_photo (
    nim CHAR(10) NOT NULL PRIMARY KEY,
    photo_id INT NULL
  )";

  if (!mysqli_query($conn, $createTableSql)) {
    throw new RuntimeException("Gagal menyiapkan relasi foto mahasiswa: " . mysqli_error($conn));
  }

  $columnCheck = mysqli_query(
    $conn,
    "SELECT column_name
     FROM information_schema.columns
     WHERE table_schema = DATABASE()
       AND table_name = 'nilai'
       AND column_name = 'file_path'"
  );
  if (!$columnCheck) {
    throw new RuntimeException("Gagal memeriksa kolom file_path: " . mysqli_error($conn));
  }

  $hasFilePath = mysqli_num_rows($columnCheck) > 0;
  mysqli_free_result($columnCheck);
  if (!$hasFilePath && !mysqli_query($conn, "ALTER TABLE nilai ADD COLUMN file_path VARCHAR(255) NULL")) {
    throw new RuntimeException("Gagal menambahkan kolom file_path: " . mysqli_error($conn));
  }

  if (!$hasFilePath && !mysqli_query(
    $conn,
    "UPDATE nilai AS n
     INNER JOIN nilai_photo AS np ON np.nim = n.nim
     INNER JOIN photo AS p ON p.id = np.photo_id
     SET n.file_path = p.path_file
     WHERE n.file_path IS NULL OR n.file_path = ''"
  )) {
    throw new RuntimeException("Gagal memindahkan path foto mahasiswa: " . mysqli_error($conn));
  }
}
