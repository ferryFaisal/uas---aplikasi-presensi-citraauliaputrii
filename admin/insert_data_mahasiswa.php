<?php
require "connect_db.php";

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

$sql = "INSERT INTO mahasiswa (nim, nama, kelas) VALUES ('$nim', '$nama', '$kelas')";

if ($conn->query($sql) === TRUE) {
  echo "data berhasil dimasukan!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: table_mahasiswa.php');
?>