<?php
session_start();

require('../../function.php');
$conn = DBConnection();
  //simpan,tangkap session username
 $name = $_SESSION['username'];

  //cek sudahkan login
if(!isset($_SESSION['login'])){

  header('location:../../index.php');
  exit;
}
if($_SESSION['level'] != 'petugas'){
  header('location:login.php');
  exit;
}

if(isset($_POST['verify'])){
  $idpengaduan = $_POST['verify'];
  $_SESSION['idpengaduan'] = $idpengaduan;
  $cek = mysqli_query($conn, "UPDATE pengaduan SET status ='proses' WHERE id_pengaduan='$idpengaduan'");
  header('location:tanggapan.php');
}
  $sql = "SELECT * FROM pengaduan";
  $execute = mysqli_query($conn,$sql);
  $getdata = mysqli_fetch_All($execute,MYSQLI_ASSOC);
  require('../layouts/header.php');
?>
<div class="container-fluid ">
  <div class="row justify-content-center">
    <main role="main" class="col-md-6">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Pengaduan :</h1>
        
      </div>
      <p>Welcome <b><?php echo $name ;?></b></p>
      <div class="container col-md-12">
      <table class="table table-hover">
        <thead class="bg-dark text-white ">
            <tr>
              <th>tanggal</th>
              <th>isi laporan</th>
              <th>bukti</th>
              <th>status</th>
              <th>Aksi</th>
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
            <td>
              <form action="" method="post">
                <button value="<?php echo $data['id_pengaduan'] ;?>"type="submit" class="btn btn-link text-primary" name="verify">verify</button>
              </form>
            </td>
          </tr>
        <?php endforeach ;?>
        </tbody>
      </table>
    </div>
    </main>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>