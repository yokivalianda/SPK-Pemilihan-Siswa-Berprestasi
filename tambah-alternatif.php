<?php require_once('includes/init.php'); ?>


<?php
$errors = array();
$sukses = false;

$nama_siswa = (isset($_POST['nama_siswa'])) ? trim($_POST['nama_siswa']) : '';
$jurusan = (isset($_POST['jurusan'])) ? trim($_POST['jurusan']) : '';
$kelas = (isset($_POST['kelas'])) ? trim($_POST['kelas']) : '';
$nomor_kelas = (isset($_POST['nomor_kelas'])) ? trim($_POST['nomor_kelas']) : '';

if (isset($_POST['submit'])) :

	// Validasi
	if (!$nama_siswa) {
		$errors[] = 'Nama siswa tidak boleh kosong';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if (empty($errors)) :
		$simpan = mysqli_query($koneksi, "INSERT INTO siswa (id_siswa, nama_siswa, jurusan, kelas, nomor_kelas) VALUES ('', '$nama_siswa', '$jurusan', '$kelas', '$nomor_kelas')");
		if ($simpan) {
			redirect_to('list-alternatif.php?status=sukses-baru');
		} else {
			$errors[] = 'Data gagal disimpan';
		}
	endif;

endif;

$page = "Siswa";
require_once('template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Siswa</h1>

	<a href="list-alternatif.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<?php if (!empty($errors)) : ?>
	<div class="alert alert-info">
		<?php foreach ($errors as $error) : ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<form action="tambah-alternatif.php" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-plus"></i> Tambah Data Siswa</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama Siswa</label>
					<input autocomplete="off" type="text" name="nama_siswa" required value="<?php echo $nama_siswa; ?>" class="form-control" placeholder="Masukkan nama siswa" />
					<br>
					<label class="font-weight-bold" for="jurusan">Jurusan</label>
					<select autocomplete="off" type="select" name="jurusan" required value="<?php echo $jurusan; ?>" class="form-control">
						<option>Teknik Komputer Dan Jaringan</option>
						<option>Teknik Kendaraan Ringan</option>
						<option>Teknik Bisnis Sepeda Motor</option>
						<option>Teknik Instalasi Tenaga Listrik</option>
						<option>Teknik Pendingin Dan Tata Udara</option>
					</select>
					<br>
					<label for="kelas" class="font-weight-bold">Kelas</label>
					<select autocomplete="off" type="select" name="kelas" required value="<?php echo $kelas; ?>" class="form-control">
						<option>X</option>
						<option>XI</option>
						<option>XII</option>
					</select>
					<br>
					<label for="nomor_kelas" class="font-weight-bold">Nomor Kelas</label>
					<input autocomplete="off" type="number" name="nomor_kelas" required value="<?php echo $nomor_kelas; ?>" class="form-control"/>
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
		<button type="reset" class="btn btn-danger"><i class="fa fa-sync-alt"></i> Reset</button>
			<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
</form>

<?php
require_once('template/footer.php');
?>