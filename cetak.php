<?php
require_once('includes/init.php');

$user_role = get_role();
if ($user_role == 'admin' || $user_role == 'user') {
?>

	<html>

	<head>
		<title>Sistem Pendukung Keputusan Metode TOPSIS</title>
	</head>

	<body onload="window.print();"> 

		<div style="width:100%;margin:0 auto;text-align:center;"> <br>
					<table>
				<tr>
					<td width="10%">
					<img style="border-radius:50%; margin-top: 10px; width: 140px; height: 140px" src="images/logo.jpg" alt="logo">
					</td>
					<td style="text-align: center; font-size:12pt"><b>YAYASAN PENDIDIKAN UTAMA BAKTI<br>
							<span style="font-size:16pt"> SMK UTAMA BAKTI PALEMBANG </span> <br>
							<span style="font-size: 11pt"> TEKNOLOGI DAN REKAYASA - TEKNOLOGI INFORMASI DAN KOMUNIKASI </span><br> 
							<span  style="font-size: 12pt">Terakreditasi "A"</span> </b> <br>
						<span style="font-size: 11pt"><b>Jalan STM UB Lebong Siareng Telp. 0711-414548 Palembang <br>
							Email : smkub_plb@yahoo.com</span><b></b>
					</td>
				</tr>
				<tr><td colspan="2"><hr style="border: solid 2px #000"></td></tr>
				<tr><td colspan="2" style="text-align: center; font-weight: bold; font-size: 14pt">LAPORAN HASIL PERHITUNGAN PEMILIHAN SISWA BERPRESTASI</td></tr>
				<tr><td colspan="2">
			</table>
			<h3> </h3>
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead>
					<tr align="center">
						<th>Nama Siswa</th>
						<th>Jurusan</th>
						<th>Kelas</th>
						<th>Nomor Kelas</th>
						<th>Nilai</th>
						<th width="15%">Rank</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$query = mysqli_query($koneksi, "SELECT * FROM hasil JOIN siswa ON hasil.id_siswa=siswa.id_siswa ORDER BY hasil.nilai_hasil DESC");
					while ($data = mysqli_fetch_array($query)) {
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
			<tr>
				<td colspan="6">
					<br><br>
					<table width="100%">
						<tr>
							<td width="8%"></td>
							<td width="29%">
								<br>
								Mengetahui,
								<p> Wali Kelas.................</p>
								<br>
								<br><br><br>
								<u>..........................</u>
							</td>
							<td width="8%"></td>
							<td width="29%">
								<br>
								Palembang,..................
								<p> Kepala SMK Utama Bakti Palembang</p>
								<br>
								<br><br><br>
								<u>Antoni Fahmi, S.E., M.M.</u>
							</td>
						</tr>
					</table>

				</td>
			</tr>
		</div>

	</body>

	</html>

<?php
} else {
	header('Location: login.php');
}
?>