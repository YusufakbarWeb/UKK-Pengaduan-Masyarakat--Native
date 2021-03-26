<?php
session_start();
require '../../function.php';
$conn = DBConnection();
  //simpan session username
 $name = $_SESSION['username'];

  //cek sesi
if(!isset($_SESSION['login'])){


  header('location:../../index.php');
  exit;
}
if($_SESSION['level'] != ''){
  header('location:login.php');
  exit;
}

$sql = "SELECT * FROM pengaduan";
$execute = mysqli_query($conn,$sql);
$getdata = mysqli_fetch_All($execute,MYSQLI_ASSOC);

require('../layouts/header.php');
?>
<div class="container-fluid ">
  <div class="row justify-content-center">
    <main class="col-md-6">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Pengaduan :</h1>
        
      </div>
      <p>Welcome <b><?php echo $name ;?></b></p>
      <div class="container col-md-12">
      <table class="table table-bordered">
        <thead class="bg-dark text-white ">
            <tr>
              <th>tanggal</th>
              <th>isi laporan</th>
              <th>bukti</th>
              <th>status</th>
            </tr>
        </thead>
        <tbody >
          <?php foreach($getdata as $data) : 

            $status = $data['status'];
            if($status == '0'){
              $status = 'terkirim';
            }else if($status == 'proses'){
              $status = 'terbaca';
            }else{
              $status = 'diterima';
            }
            ?>
          <tr>

            <td><?php echo $data['tgl_pengaduan'];?></td>
            <td><?php echo $data['isi_laporan'];?></td>
            <td><img src="../../img/<?php echo $data['foto'];?>"  width ="50px"alt=""></td>
            <td class="text-success "><b><?php echo $status ;?></b></td>
          </tr>
        <?php endforeach ;?>
        </tbody>
      </table>
      <a href="index.php" class="btn btn-primary">kembali</a>
    </div>
    </main>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>
