<?php
require('../../function.php');
$conn = DBConnection();
// tangkap id_Tanggapan
$id_tanggapan = $_POST['verify'];
//ambil tgl tangapan,tanggapan
	$tanggapan = "SELECT * FROM tanggapan WHERE id_tanggapan='$id_tanggapan'";
		$getDataTanggapan = mysqli_fetch_All( mysqli_query($conn,$tanggapan),MYSQLI_ASSOC);
		//tgl tanggapan
		$tanggalTanggapan = $getDataTanggapan[0]['tgl_tanggapan'];
		//isi tanggapan
		$tanggapan = $getDataTanggapan[0]['tanggapan'];
		//id petugas
		$idPetugas = $getDataTanggapan[0]['id_petugas'];
		//id pengaduan
		$idPengaduan = $getDataTanggapan[0]['id_pengaduan'];
// ambil tgl pengaduan,isi pengaduan
	$pengaduan = "SELECT * FROM pengaduan WHERE id_pengaduan='$idPengaduan'";
		$getDataPengaduan = mysqli_fetch_All( mysqli_query($conn,$pengaduan),MYSQLI_ASSOC);
		//tgl pengaduan
		$tanggalPengaduan = $getDataPengaduan[0]['tgl_pengaduan'];
		//isi pengaduan
		$pengaduan = $getDataPengaduan[0]['isi_laporan'];
		// foto
		$foto= $getDataPengaduan[0]['foto'];
		//nik 
		$nik = $getDataPengaduan[0]['nik'];
		
//ambil nama petugas

	$petugas = "SELECT * FROM petugas WHERE id_petugas = '$idPetugas'";
		$getDataPetugas = mysqli_fetch_All( mysqli_query($conn,$petugas),MYSQLI_ASSOC);
		// nama petugas
		$namaPetugas = $getDataPetugas[0]['nama_petugas'];
		
//ambil nama pengadu,
	$masyarakat = "SELECT * FROM masyarakat WHERE nik = '$nik'";
		$getDataMasyarakat = mysqli_fetch_All( mysqli_query($conn,$masyarakat),MYSQLI_ASSOC);
		//nama masyarakat
		$namaMasyarakat = $getDataMasyarakat[0]['nama'];

		
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Report</title>
	<link href="../../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
	@media print{
		.btn-primary {
			display:none;
		}
	}
</style>

<body>
	<div class="container mt-5">
		<div class="row mt-5">
			<div class="col-12 text-center">
				<h3>
					Laporan Pengaduan Masyarakat
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Nama Masyarakat</th>
							<th>Nama Petugas</th>
							<th>Tanggal Pengaduan</th>
							<th>Tanggal Tanggapan</th>
							<th>Isi Pengaduan</th>
							<th>Foto</th>
							<th>Tanggapan</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= $namaMasyarakat ;?></td>
							<td><?= $namaPetugas ;?></td>
							<td><?= $tanggalPengaduan ; ?></td>
							<td><?= $tanggalTanggapan ; ?></td>
							<td><?= $pengaduan ;?></td>
							<td><img src="../../img/<?php echo $foto ;?>" width="100px" alt=""></td>
							<td><?= $tanggapan ;?></td>
						</tr>
					</tbody>
				</table>
					<a href="index.php" class="btn btn-primary">kembali</a>
			</div>
		</div>
	</div>
	<script>
		window.print();
	</script>
</body>

</html>