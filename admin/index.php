<?php
ob_start();
include 'connect_db.php';
session_start();


if (isset($_SESSION['login'])) {
  //jika sudah login

} else {
  die("Anda belum login! Silahkan login <a href='login.php'>di sini</a>");
}

$sql = "SELECT * FROM user where email = '$_SESSION[login]'";
$result = $conn->query($sql);

$tglErr = $makulErr = "";
$valid_tgl = $valid_makul = false;
$message = "";


if (isset($_POST['submit'])) {
  if (empty($_POST['tgl'])) {
    $valid_tgl = false;
    $tglErr = "*required field";
  } else {
    $valid_tgl = true;
  }

  if (empty($_POST['makul'])) {
    $valid_makul = false;
    $makulErr = "*required field";
  } else {
    $valid_makul = true;
  }
}

if (isset($_GET["success"])) {
  $message = '
  <div class="alert alert-success alert-dismissible">
    data berhasil disimpan! 
    <a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  </div>
  ';
}
if ($result->num_rows > 0) {
?>

  <?php
  include 'connect_db.php';

  $sql = "SELECT * FROM mahasiswa where kelas = '5A'";
  $result = $conn->query($sql);
  ?>

  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input | Presensi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
      .error {
        color: #FF0000;
      }
    </style>
  </head>

  <body class="bg-dark">
    <h1></h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <div>

      <?php
      if ($result->num_rows > 0) {
      ?>

        <div class="container">
          <div class="card card-register mx-auto mt-5">
            <div class="card-header text-center">
              <span><?= $message ?></span>
              <h4>Pengisian Kehadiran Mahasiswa</h4>
            </div>

            <div class="card-body">
              <form method="POST" action="">
                <!-- <div class="form-group"> -->
                <div class="row form-row mb-1">
                  <div class="col-md-4">
                    <div class="form-label-group">
                      <input type="date" id="tgl" name="tgl" class="form-control" placeholder="Tgl" autofocus="autofocus" value="">
                      <span class="error"><?= $tglErr ?></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-label-group">
                      <select name="makul" id="makul" class="form-control" autofocus="autofocus">
                        <option value=""> -- Pilih Mata Kuliah -- </option>
                        <option value="WebProg"> Pemrograman Web </option>
                        <option value="WebProgLab"> Praktik Pemrograman Web </option>
                        <option value="SoftDev"> Rekayasa Perangkat Lunak </option>
                      </select>
                      <span class="error"><?= $makulErr ?></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-label-group">
                      <span>Pilih kelas: &nbsp; </span>
                      <a href="index.php" class="btn btn-dark">5A</a>
                      <a href="indexB.php" class="btn btn-dark">5B</a>
                      <input type="hidden" name="kelas" value="5A">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="col12 fs-5" style="font-weight:35px;">
                  KELAS 5A</div>
                <hr>
                <hr>
                <div class="row text-center">
                  <div class="col-md-4"><strong>Nomor Induk Mahasiswa</strong></div>
                  <div class="col-md-4"><strong>Nama Lengkap</strong></div>
                  <div class="col-md-4"><strong>Status Presensi</strong></div>
                </div>
                <hr>

                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                  <div class="row form-row mb-1">
                    <div class="col-md-4">
                      <div class="form-label-group">
                        <input type="text" readonly id="nim" name="nim[]" class="form-control" placeholder="NIM" autofocus="autofocus" value="<?= $row['nim'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-label-group">
                        <input type="text" readonly id="nama" name="nama[]" class="form-control" placeholder="Nama" autofocus="autofocus" value="<?= $row['nama'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-label-group">
                        <select name="presensi[]" id="presensi" class="form-control" autofocus="autofocus">
                          <option value="Hadir"> Hadir </option>
                          <option value="Sakit"> Sakit </option>
                          <option value="Izin"> Izin </option>
                          <option value="Alpa"> Alpa </option>
                        </select>
                      </div>
                    </div>
                  </div>

                <?php
                }
                ?>
              <?php
            } else {
              echo "o result";
            }
            mysqli_close($conn);
              ?>
              <!-- </div> -->
              <br>
              <p class="text-center">
                <input type="submit" name="submit" value="Simpan Presensi" class="btn btn-primary btn-block">
              </p>
              <!-- <a class="btn btn-secondary btn-block" href="users.php">Cancel</a> -->
              </form>
              <div class="text-center">
                <br>Copyright © Program Studi Teknik Informatika - <?= date('Y'); ?><br>
              </div>
            </div>
          </div>
          <?php
          if ($valid_makul && $valid_tgl == true) {
            include 'insert_presensi.php';
          }
          ?>

  </body>

  </html>
<?php
} else {
  echo "echo 0 results";
}
$conn->close();
?>