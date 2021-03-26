<?php 
// mulai sesi
session_start();
// hubungkan kehalam db koneksi;
require('function.php');

$conn = DBConnection();
// tombol submit ditekan 
  if(isset($_POST['submit'])){
    //dapatkan data dari inputan form 
    $username = $_POST['username'];
    $password = $_POST['password'];

    //get data 
    $acount = mysqli_query($conn,"SELECT * FROM masyarakat WHERE username = '$username'");

    //cek username
    if(mysqli_num_rows($acount) === 1){
      $data = mysqli_fetch_assoc($acount);
        if($password == $data['password']){

          // create session
          $_SESSION['login'] = true;
          $_SESSION['nik'] = $data['nik'];
          $_SESSION['level'] ='';
          $_SESSION['username'] = $data['username'];  
          //pindah halaman
          header('location:view/masyarakat/index.php');
          // stop code
          exit;
        }
    }
    // error
    $error = true;

  }else if(isset($_POST['regist'])){
    // kembali halaman registrasi
     header('location:view/masyarakat/registrasi.php');
  }
require('view/layouts/header.php')
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
    <div class="card-header">Login Masyarakat</div>
      <div class="card">
        <div class="card-body">
          <form class="form-group" method="post" action="">
            <div class="form-group">
              <label for="inputEmail" class="sr-only">username</label>
              <input type="text" id="inputEmail" class="form-control" placeholder="username" name="username" autofocus>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="sr-only">Password</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="form-group">
              <button class="btn  btn-primary" type="submit" name="submit">Login</button>
              <a class="btn  btn-danger" href="view/admin/login.php">Login Sebagai Petugas</a>
            </div>
            <?php if(isset($error)):?>
            <p class="text-danger ">username/password salah</p>
            <?php endif ;?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('view/layouts/footer.php') ?>