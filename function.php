<?php


function DBConnection(){
  return mysqli_connect('localhost','root','','db_pengaduan_masyarakat');
}

function registrasi($data){
  $conn = DBConnection();

  $namapetugas = htmlspecialchars($data['namapetugas']);
  $username =htmlspecialchars($data['username']);
  $level = htmlspecialchars($data['level']);
  $telp = htmlspecialchars($data['telephone']);
  $password =htmlspecialchars($data['password']);
  $passwords = htmlspecialchars($data['passwords']);
  
  // cek akun
  $ceking = mysqli_query($conn,"SELECT * FROM petugas WHERE username='$username'");
  if(mysqli_fetch_All($ceking)){
    echo "<script>alert('akun sudah terdaftar')</script>";
    return false;
  }


  // cek password 
  if($password != $passwords){
    echo
    "
    <script>
    alert('cek for password');
    </script>
    ";
    return false;
  }

  // enkripsi password
  $sql = "INSERT INTO petugas VALUES('','$namapetugas','$username','$password','$telp','$level')";
  $execute = mysqli_query($conn,$sql);
  header('location:index.php');

}

function daftar($data){
  $conn = DBConnection();
  $nik = $data['nik'];
  $nama = $data['nama'];
  $username = $data['username'];
  $telephone = $data['telephone'];
  $password = $data['password'];
  $password2 = $data['password2'];

  $check = mysqli_query($conn,"SELECT * FROM masyarakat WHERE username ='$username' ");
  if(mysqli_fetch_All($check)){
    echo "<script> alert('akun telah terdaftar');</script>";
    return false;
  }

  if($password != $password2){
    echo "<script> alert('password tidak sama')</script>";
  }
  $sql ="INSERT INTO masyarakat(nik,nama,username,password,telp) VALUES('$nik','$nama','$username','$password','$telephone')";
  $execute = mysqli_query($conn,$sql);
  
  header('location:index.php  ');

}



function tanggapan($nik,$data){
  $conn = DBConnection();
  $nik = $nik;
  $tanggal = date('Y-m-d');
  $isi = $data['isi'];
  $status = '0';
  $gambar = upload();

  //sql insert
  $query = "INSERT INTO pengaduan(tgl_pengaduan,nik,isi_laporan,foto,status) VALUES('$tanggal','$nik','$isi','$gambar','$status')";
  // execute 
  
mysqli_query($conn,$query);

}
function upload(){
  // inisialisasi nilai
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];
 
  
  // cek extensi file
  $exstensiGambarValid =['jpg','jpeg','png','JPG','JPEG','PNG'];
  $exstensiGambar =pathinfo($namaFile,PATHINFO_EXTENSION);
  
  //cek gambar atau bukan
  if(!in_array($exstensiGambar, $exstensiGambarValid)){
    echo "<script>
      alert('upload not gambar');
    </script>";
    // hentikan program
    return false;
  }

  //cek ukuran file
  if($ukuranFile > 1000000){
    echo "
    <script>
      alert('ukuran gambar terlalu besar');
    </script>
    ";
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $exstensiGambar;

  //upload gambar
 move_uploaded_file($tmpName,'../../img/' . $namaFileBaru);
  return $namaFileBaru;
}