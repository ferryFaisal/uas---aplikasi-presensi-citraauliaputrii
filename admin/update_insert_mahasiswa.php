<?php
require "connect_db.php";

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$sql1 = "UPDATE mahasiswa SET nama='$nama', kelas='$kelas' WHERE nim='$nim'";

if ($conn->query($sql1) == TRUE) {
  // echo "New record created successfully";
  header('Location: table_mahasiswa.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
