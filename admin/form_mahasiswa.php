<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Mahasiswa</title>
  <!-- Custom fonts for this template-->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin.css" rel="stylesheet">
</head>

<body>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <h3 class="card-header ">Mahasiswa Baru</h3>
        <div class="card-body">
          <form action="insert_data_mahasiswa.php" method="POST">
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" name="nim" class="form-control"  autofocus="autofocus" >
                <label for="inputnim">NIM</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="nama" class="form-control" autofocus="autofocus">
                <label for="inputnama">Nama</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <select name='kelas' class="form-control" autofocus="autofocus">
                  <option value=""> ---Pilih Kelas--- </option><br>
                  <option value="5A">5A</option>
                  <option value="5B">5B</option>
                </select><br>
              </div>
            </div>

            <input type="submit" name="submit" value="Selesai" class="btn btn-primary btn-block">
          </form>
        </div>
      </div>
    </div>

  </body>

</html>