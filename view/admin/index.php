<?php
session_start();
require('../../function.php');
$conn = DBConnection();
  //simpan session username
  $name = $_SESSION['username'];

  //cek sesi
  if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
  }
  //cek level 
  if($_SESSION['level'] != 'admin'){
    header('location:login.php');
  }

$sql = "SELECT * FROM tanggapan";
$execute = mysqli_query($conn,$sql);
$getdata = mysqli_fetch_All($execute,MYSQLI_ASSOC);
require('../layouts/header.php')
?>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-6 mt-5">
      <div class="card">
        <div class="card-header">
          Dashboard
        </div>
        <div class="card-body">
          <a href="../logout.php" class="btn btn-danger float-right mx-2">Logout</a>
          <a href="registrasi.php" class="btn btn-primary float-right mx-2">registrasi</a>
          <p>Welcome <b><?php echo $name ;?></b></p>
          <table class="table table-bordered">
            <thead class="bg-dark text-white ">
              <tr>
                <th>isi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($getdata as $data) : ?>
              <tr>
                <td><?php echo $data['tanggapan'];?></td>
                <td>
                  <form action="generate.php" method="post">
                    <button value="<?php echo $data['id_tanggapan'] ;?>" type="submit" class="btn btn-link text-success"
                      name="verify">generet report</button>
                  </form>
                </td>
              </tr>
              <?php endforeach ;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php require('../layouts/footer.php') ?>