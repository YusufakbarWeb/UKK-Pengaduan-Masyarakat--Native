<?php
session_start();
require '../../db.php';
$conn = DBConnection();
  //simpan session username
  $name = $_SESSION['username'];

  //cek sudahkah login
  if(!isset($_SESSION['login'])){
    header('location:../../index.php');
    exit;
  }
  //cek apakah anda petugas
  if($_SESSION['level'] != 'petugas'){
    header('location:../../index.php');
  }

$sql = "SELECT * FROM masyarakat";
$query = mysqli_query($conn,$sql);
$getdata =mysqli_fetch_All($query,MYSQLI_ASSOC);

require('../layouts/header.php');
?>
<div class="container-fluid ">
  <div class="row justify-content-center">
    <main role="main" class="col-md-6">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar pengguna</h1>
      </div>
      <p>Welcome <b><?php echo $name ;?></b></p>
      <div class="container col-md-12">
      <table class="table table-hover">
        <thead class="bg-dark text-white ">
            <tr>
              <th>Nik</th>
              <th>Nama</th>
              <th>Username</th>
              <th>telp</th>
            </tr>
        </thead>
        <tbody >
          <?php foreach($getdata as $data) : ;?>
          <tr>
            <td><?php echo $data['nik'];?></td>
            <td><?php echo $data['nama'];?></td>
            <td><?php echo $data['username'];?></td>
            <td><?php echo $data['telp'];?></td>
          </tr>
        <?php endforeach ;?>
        </tbody>
      </table>
    </div>
    </main>

  
  </div>
</div>
<?php require('../layouts/footer.php'); ?>
