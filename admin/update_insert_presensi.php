<?php
require "connect_db.php";

$makul = $_POST['makul'];
$presensi = $_POST['presensi'];

$id = $_GET['id'];
$sql1 = "UPDATE presensi SET makul='$makul', status_presensi='$presensi' WHERE id='$id'";

if ($conn->query($sql1) == TRUE) {
  // echo "New record created successfully";
  header('Location: table_presensi.php');
  ob_end_flush();
} else {
  echo "Error: " . $sql1 . "<br>" . $conn->error;
}

$conn->close();
