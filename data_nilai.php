<?php
require_once __DIR__ . '/connection.php';
mysqli_select_db($conn, "dbnilai");

$nim = "$_POST[nim]";
$nm_lengkap = "$_POST[nm_lengkap]";
$nilai_akhir = "$_POST[nilai_akhir]";
$nilai_huruf = "$_POST[nilai_huruf]";
$predikat = "$_POST[predikat]";

$sql = "INSERT INTO nilai (nim, nm_lengkap, nilai_akhir, nilai_huruf, predikat, created_date, modified_date)
VALUES ('$nim', '$nm_lengkap', '$nilai_akhir', '$nilai_huruf', '$predikat', NOW(), NOW())";
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('New record created successfully');
            window.location.href = 'nilaiui.php';
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


header('Location: viewdata.php');
?>