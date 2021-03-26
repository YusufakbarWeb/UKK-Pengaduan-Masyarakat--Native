<?php
session_start();
$username = $_SESSION['username'];
//cek sudahkan login
if(!isset($_SESSION['login'])){
  header('location:../administrator/index.php');
  exit;
}
// cek apakah  bukan petugas
if($_SESSION['level'] != 'petugas'){
    header('location:../adminstrator/index.php');
  }

  require('../layouts/header.php');
?>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-6 mt-5">
      <div class="card">
          <div class="card-header">
            Dashboard Home
          </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col">
              <p>selamat kembali beraktivitas <b><?php echo $username;?></b></p>
                <a href="petugas.php" class="btn btn-primary">Data Pengguna</a>
                <a href="pengaduan.php" class="btn btn-primary">Data Pengaduan</a>
                <a href="../logout.php" class="btn btn-primary">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>