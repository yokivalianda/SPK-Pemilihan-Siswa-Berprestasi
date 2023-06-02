<?php
require_once('includes/init.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {

$page = "Hasil";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Perhitungan</h1>
	
	<a href="cetak.php" target="_blank" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th>Nama Siswa</th>
						<th>Jurusan</th>
						<th>Kelas</th>
						<th>Nomor Kelas</th>
						<th>Nilai</th>
						<th width="15%">Rank</th>
				</thead>
				<tbody>
					<?php 
						$no=0;
						$query = mysqli_query($koneksi,"SELECT * FROM hasil JOIN siswa ON hasil.id_siswa=siswa.id_siswa ORDER BY hasil.nilai_hasil DESC");
						while($data = mysqli_fetch_array($query)){
						$no++;
					?>
					<tr align="center">
						<td align="left"><?= $data['nama_siswa'] ?></td>
						<td align="left"><?= $data['jurusan'] ?></td>
						<td align="left"><?= $data['kelas'] ?></td>
						<td align="left"><?= $data['nomor_kelas'] ?></td>
						<td><?= $data['nilai_hasil'] ?></td>
						<td><?= $no; ?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<footer class="footer">©Copyright 2022 SMK UTAMA BAKTI PALEMBANG</footer>
<?php
require_once('template/footer.php');
}
else {
	header('Location: login.php');
}
?>