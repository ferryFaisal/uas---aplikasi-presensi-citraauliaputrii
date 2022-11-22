<?php
$nim = $nama = $kelas  = "";
$cls5A = $cls5B = "";

require "connect_db.php";
$sql1 = " SELECT * FROM mahasiswa WHERE nim = '$_GET[nim]'";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $nim = $row['nim'];
    $nama= $row['nama'];

    //view value which is selected
    switch ($row['kelas']) {
      case "5A":
        $cls5A = "selected";
        break;
      case "5B":
        $cls5B = "selected";
        break;
      default:
      $cls5A = $cls5B = "";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Mahasiswa</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <h3 class="card-header ">Update Data Mahasiswa</h3>
        <div class="card-body">
          <form action="update_insert_mahasiswa.php" method="POST">
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" name="nim" readonly class="form-control"  autofocus="autofocus" value="<?= $row['nim']; ?>">
                <label for="inputnim">NIM</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="nama" class="form-control" autofocus="autofocus" value="<?= $row['nama']; ?>">
                <label for="inputnama">Nama</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <select name='kelas' class="form-control" autofocus="autofocus" >
                  <option value=""> ---Pilih Kelas--- </option><br>
                  <option value="5A" <?php echo $cls5A; ?>>5A</option>
                  <option value="5B" <?php echo $cls5B; ?>>5B</option>
                </select><br>
              </div>
            </div>
            
            <input type="submit" name="submit" value="Selesai" class="btn btn-primary btn-block">
          </form>
        </div>
      </div>
    </div>
    <?php
  } //end of while
} else {
  echo "0 results";
} ?>
  </body>

</html>