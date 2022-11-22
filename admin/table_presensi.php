<?php
ob_start();
include 'connect_db.php';
session_start();
if (isset($_SESSION['login'])) { //jika sudah login
} else {
  die("Anda belum login! Silahkan login <a href='login.php'>di sini</a>");
}

$sql = "SELECT * FROM user where email = '$_SESSION[login]'";
$result = $conn->query($sql);

?>

<?php
require "connect_db.php";
$sql = "SELECT * FROM presensi";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Table Presensi</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Presensi Mahasiswa</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="login.php">Login</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <?php if ($_SESSION['role'] == 'Admin') { ?>
          <li class="nav-item active">
            <a class="nav-link" href="table_presensi.php">
              <i class="fas fa-fw fa-book"></i>
              <span>Presensi</span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="table_mahasiswa.php">
              <i class="fas fa-fw fa-users"></i>
              <span>Mahasiswa</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form_mahasiswa.php">
              <i class="fas fa-fw fa-plus"></i>
              <span>Add Mahasiwa</span></a>
          </li>

        <?php } ?>
        <?php if ($_SESSION['role'] == 'Dosen') { ?>

          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="fas fa-fw fa-table"></i>
              <span>Presensi</span></a>
          </li>
        <?php } ?>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-book"></i>
              Presensi Mahasiswa
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal Presensi</th>
                      <th>Mata Kuliah</th>
                      <th>Kelas</th>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Status Presensi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      // output data of each row
                      while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?= $row["tgl_presensi"]; ?></td>
                          <td><?= $row["makul"]; ?></td>
                          <td><?= $row["kelas"]; ?></td>
                          <td><?= $row["nim"]; ?></td>
                          <td><?= $row["nama"]; ?></td>
                          <td><?= $row["status_presensi"]; ?></td>
                          <td>
                            <a href='update_data_presensi.php?id=<?= $row['id'] ?>'><i class="bi bi-pencil-square"></i></a>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
          </div>


          <!-- <p class="small text-center text-muted my-5">
        <em>More table examples coming soon...</em>
      </p> -->

        </div>

        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer ">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kamu ingin keluar dari laman ini?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

  </body>

  </html>

<?php
                    }else{
                      echo "0 results";
                    }
      
                  $conn->close();
?>