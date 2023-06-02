<?php
require_once('includes/init.php');

$page = "Perhitungan";
require_once('template/header.php');

mysqli_query($koneksi,"TRUNCATE TABLE hasil;");

$kriterias = array();
$q1 = mysqli_query($koneksi,"SELECT * FROM kriteria ORDER BY kode_kriteria ASC");			
while($krit = mysqli_fetch_array($q1)){
	$kriterias[$krit['id_kriteria']]['id_kriteria'] = $krit['id_kriteria'];
	$kriterias[$krit['id_kriteria']]['kode_kriteria'] = $krit['kode_kriteria'];
	$kriterias[$krit['id_kriteria']]['nama_kriteria'] = $krit['nama_kriteria'];
	$kriterias[$krit['id_kriteria']]['type'] = $krit['type'];
	$kriterias[$krit['id_kriteria']]['bobot'] = $krit['bobot'];
	$kriterias[$krit['id_kriteria']]['ada_pilihan'] = $krit['ada_pilihan'];
}

$alternatifs = array();
$q2 = mysqli_query($koneksi,"SELECT * FROM siswa");			
while($alt = mysqli_fetch_array($q2)){
	$alternatifs[$alt['id_siswa']]['id_siswa'] = $alt['id_siswa'];
	$alternatifs[$alt['id_siswa']]['nama_siswa'] = $alt['nama_siswa'];
} 

//Matrix Keputusan (X)
$matriks_x = array();
foreach($kriterias as $kriteria):
	foreach($alternatifs as $alternatif):
		
		$id_siswa = $alternatif['id_siswa'];
		$id_kriteria = $kriteria['id_kriteria'];
		
		if($kriteria['ada_pilihan']==1){
			$q4 = mysqli_query($koneksi,"SELECT sub_kriteria.nilai_sub_kriteria FROM penilaian JOIN sub_kriteria WHERE penilaian.nilai_penilaian=sub_kriteria.id_sub_kriteria AND penilaian.id_siswa='$alternatif[id_siswa]' AND penilaian.id_kriteria='$kriteria[id_kriteria]'");
			$data = mysqli_fetch_array($q4);
			$nilai = $data['nilai_sub_kriteria'];
		}else{
			$q4 = mysqli_query($koneksi,"SELECT nilai_penilaian FROM penilaian WHERE id_siswa='$alternatif[id_siswa]' AND id_kriteria='$kriteria[id_kriteria]'");
			$data = mysqli_fetch_array($q4);
			$nilai = $data['nilai_penilaian'];
		}
		
		$matriks_x[$id_kriteria][$id_siswa] = $nilai;
	endforeach;
endforeach;

//Matriks Ternormalisasi (R)
$matriks_r = array();
foreach($matriks_x as $id_kriteria => $penilaians):
	
	$jumlah_kuadrat = 0;
	foreach($penilaians as $penilaian):
		$jumlah_kuadrat += pow($penilaian, 2);
	endforeach;
	$akar_kuadrat = sqrt($jumlah_kuadrat);
	
	foreach($penilaians as $id_siswa => $penilaian):
		$matriks_r[$id_kriteria][$id_siswa] = $penilaian / $akar_kuadrat;
	endforeach;
	
endforeach;

 //Matriks Y
$matriks_y = array();
foreach($kriterias as $kriteria):
	foreach($alternatifs as $alternatif):
		
		$bobot = $kriteria['bobot'];
		$id_siswa = $alternatif['id_siswa'];
		$id_kriteria = $kriteria['id_kriteria'];
		
		$nilai_r = $matriks_r[$id_kriteria][$id_siswa];
		$matriks_y[$id_kriteria][$id_siswa] = $bobot * $nilai_r;

	endforeach;
endforeach;

//Solusi Ideal Positif & Negarif
$solusi_ideal_positif = array();
$solusi_ideal_negatif = array();
foreach($kriterias as $kriteria):

	$id_kriteria = $kriteria['id_kriteria'];
	$type_kriteria = $kriteria['type'];
	
	$nilai_max = @(max($matriks_y[$id_kriteria]));
	$nilai_min = @(min($matriks_y[$id_kriteria]));
	
	if($type_kriteria == 'Benefit'):
		$s_i_p = $nilai_max;
		$s_i_n = $nilai_min;
	elseif($type_kriteria == 'Cost'):
		$s_i_p = $nilai_min;
		$s_i_n = $nilai_max;
	endif;
	
	$solusi_ideal_positif[$id_kriteria] = $s_i_p;
	$solusi_ideal_negatif[$id_kriteria] = $s_i_n;

endforeach;

//Jarak Ideal Positif & Negatif
$jarak_ideal_positif = array();
$jarak_ideal_negatif = array();
foreach($alternatifs as $alternatif):

	$id_siswa = $alternatif['id_siswa'];		
	$jumlah_kuadrat_jip = 0;
	$jumlah_kuadrat_jin = 0;
	
	// Mencari penjumlahan kuadrat
	foreach($matriks_y as $id_kriteria => $penilaians):
		
		$hsl_pengurangan_jip = $penilaians[$id_siswa] - $solusi_ideal_positif[$id_kriteria];
		$hsl_pengurangan_jin = $penilaians[$id_siswa] - $solusi_ideal_negatif[$id_kriteria];
		
		$jumlah_kuadrat_jip += pow($hsl_pengurangan_jip, 2);
		$jumlah_kuadrat_jin += pow($hsl_pengurangan_jin, 2);
	
	endforeach;
	
	// Mengakarkan hasil penjumlahan kuadrat
	$akar_kuadrat_jip = sqrt($jumlah_kuadrat_jip);
	$akar_kuadrat_jin = sqrt($jumlah_kuadrat_jin);
	
	// Memasukkan ke array matriks jip & jin
	$jarak_ideal_positif[$id_siswa] = $akar_kuadrat_jip;
	$jarak_ideal_negatif[$id_siswa] = $akar_kuadrat_jin;
	
endforeach;

//Kedekatan Relatif Terhadap Solusi Ideal (V)
$kedekatan_relatif = array();
foreach($alternatifs as $alternatif):

	$s_negatif = $jarak_ideal_negatif[$alternatif['id_siswa']];
	$s_positif = $jarak_ideal_positif[$alternatif['id_siswa']];	
	
	$nilai_v = @($s_negatif / ($s_positif + $s_negatif));
	
	$kedekatan_relatif[$alternatif['id_siswa']]['id_siswa'] = $alternatif['id_siswa'];
	$kedekatan_relatif[$alternatif['id_siswa']]['nama_siswa'] = $alternatif['nama_siswa'];
	$kedekatan_relatif[$alternatif['id_siswa']]['nilai_penilaian'] = $nilai_v;
	
endforeach;
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan</h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matrix Keputusan (X)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Siswa</th>
						<?php foreach ($kriterias as $kriteria): ?>
							<th><?= $kriteria['kode_kriteria'] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif['nama_siswa'] ?></td>
						<?php
						foreach ($kriterias as $kriteria):
							$id_siswa = $alternatif['id_siswa'];
							$id_kriteria = $kriteria['id_kriteria'];
							echo '<td>';
							echo $matriks_x[$id_kriteria][$id_siswa];
							echo '</td>';
						endforeach
						?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Bobot Preferensi (W)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<?php foreach ($kriterias as $kriteria): ?>
						<th><?= $kriteria['kode_kriteria'] ?> (<?= $kriteria['type'] ?>)</th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<?php foreach ($kriterias as $kriteria): ?>
						<td>
						<?php 
						echo $kriteria['bobot'];
						?>
						</td>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matriks Ternormalisasi (R)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Siswa</th>
						<?php foreach ($kriterias as $kriteria): ?>
							<th><?= $kriteria['kode_kriteria'] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif['nama_siswa'] ?></td>
						<?php						
						foreach($kriterias as $kriteria):
							$id_siswa = $alternatif['id_siswa'];
							$id_kriteria = $kriteria['id_kriteria'];
							echo '<td>';
							echo $matriks_r[$id_kriteria][$id_siswa];
							echo '</td>';
						endforeach;
						?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matriks Y</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Siswa</th>
						<?php foreach ($kriterias as $kriteria): ?>
							<th><?= $kriteria['kode_kriteria'] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif['nama_siswa'] ?></td>
						<?php						
						foreach($kriterias as $kriteria):
							$id_siswa = $alternatif['id_siswa'];
							$id_kriteria = $kriteria['id_kriteria'];
							echo '<td>';
							echo $matriks_y[$id_kriteria][$id_siswa];
							echo '</td>';
						endforeach;
						?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Solusi Ideal Positif (A+)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<?php foreach($kriterias as $kriteria ): ?>
							<th><?php echo $kriteria['nama_kriteria']; ?> (<?php echo $kriteria['kode_kriteria']; ?>)</th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
					<?php foreach($kriterias as $kriteria ): ?>
						<td>
							<?php
							$id_kriteria = $kriteria['id_kriteria'];							
							echo $solusi_ideal_positif[$id_kriteria];
							?>
						</td>
					<?php endforeach; ?>
					</tr>					
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Solusi Ideal Negatif (A-)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<?php foreach($kriterias as $kriteria ): ?>
							<th><?php echo $kriteria['nama_kriteria']; ?> (<?php echo $kriteria['kode_kriteria']; ?>)</th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
					<?php foreach($kriterias as $kriteria ): ?>
						<td>
							<?php
							$id_kriteria = $kriteria['id_kriteria'];							
							echo $solusi_ideal_negatif[$id_kriteria];
							?>
						</td>
					<?php endforeach; ?>
					</tr>					
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Jarak Ideal Positif (S<sub>i</sub>+)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Siswa</th>
						<th width="30%">Jarak Ideal Positif</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$no=1;
				foreach($alternatifs as $alternatif ): ?>
					<tr align="center">
						<td><?php echo $no; ?></td>
						<td align="left"><?php echo $alternatif['nama_siswa']; ?></td>
						<td>
							<?php								
							$id_siswa = $alternatif['id_siswa'];
							echo $jarak_ideal_positif[$id_siswa];
							?>
						</td>						
					</tr>
				<?php 
				$no++;
				endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Jarak Ideal Negatif (S<sub>i</sub>-)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Siswa</th>
						<th width="30%">Jarak Ideal Negatif</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$no=1;
				foreach($alternatifs as $alternatif ): ?>
					<tr align="center">
						<td><?php echo $no; ?></td>
						<td align="left"><?php echo $alternatif['nama_siswa']; ?></td>
						<td>
							<?php								
							$id_siswa = $alternatif['id_siswa'];
							echo $jarak_ideal_negatif[$id_siswa];
							?>
						</td>						
					</tr>
				<?php 
				$no++;
				endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Kedekatan Relatif Terhadap Solusi Ideal (V)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Siswa</th>
						<th width="30%">Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no=1;
					foreach($kedekatan_relatif as $alternatif ): ?>
						<tr align="center">
							<td><?php echo $no; ?></td>
							<td align="left"><?php echo $alternatif['nama_siswa']; ?></td>
							<td><?php echo $alternatif['nilai_penilaian']; ?></td>											
						</tr>
					<?php 
					$no++;
					mysqli_query($koneksi,"INSERT INTO hasil (id_hasil, id_siswa, nilai_hasil) VALUES ('', '$alternatif[id_siswa]', '$alternatif[nilai_penilaian]')");
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
require_once('template/footer.php');

?>