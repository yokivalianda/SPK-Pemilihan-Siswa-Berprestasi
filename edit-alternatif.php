<?php require_once('includes/init.php'); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

$id_siswa = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(isset($_POST['submit'])):	
	
	$nama_siswa = $_POST['nama_siswa'];
	$jurusan = $_POST['jurusan'];
	$kelas = $_POST['kelas'];
	$nomor_kelas = $_POST['nomor_kelas'];
	
	// Validasi
	if(!$nama_siswa) {
		$errors[] = 'nama_siswa tidak boleh kosong';
	}
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):

		$update = mysqli_query($koneksi,"UPDATE siswa SET nama_siswa= '$nama_siswa', jurusan= '$jurusan', kelas='$kelas', nomor_kelas='$nomor_kelas' WHERE id_siswa = '$id_siswa'");
		if($update) {
			redirect_to('list-alternatif.php?status=sukses-edit');
		}else{
			$errors[] = 'Data gagal diperbarui';
		}
	endif;

endif;
?>

<?php
$page = "Siswa";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Siswa</h1>

	<a href="list-alternatif.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>
			
<?php if(!empty($errors)): ?>
	<div class="alert alert-info">
		<?php foreach($errors as $error): ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php if($sukses): ?>
	<div class="alert alert-success">
		Data berhasil disimpan
	</div>	
<?php elseif($ada_error): ?>
	<div class="alert alert-info">
		<?php echo $ada_error; ?>
	</div>
<?php else: ?>		
			
<form action="edit-alternatif.php?id=<?php echo $id_siswa; ?>" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-edit"></i> Edit Data Siswa</h6>
		</div>
		<?php
		if(!$id_siswa) {
		?>
		<div class="card-body">
			<div class="alert alert-danger">Data tidak ada</div>
		</div>
		<?php
		}else{
		$data = mysqli_query($koneksi,"SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
		$cek = mysqli_num_rows($data);
		if($cek <= 0) {
		?>
		<div class="card-body">
			<div class="alert alert-danger">Data tidak ada</div>
		</div>
		<?php
		}else{
			while($d = mysqli_fetch_array($data)){
		?>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">nama_siswa</label>
					<input autocomplete="off" type="text" name="nama_siswa" required value="<?php echo $d['nama_siswa']; ?>" class="form-control" placeholder="Masukkan nama_siswa" />
					<br>
					<label class="font-weight-bold" for="jurusan">Jurusan</label>
					<select autocomplete="off" type="select" name="jurusan" required value="<?php echo $d['jurusan']; ?>" class="form-control">
						<option>Teknik Komputer Dan Jaringan</option>
						<option>Teknik Kendaraan Ringan</option>
						<option>Teknik Bisnis Sepeda Motor</option>
						<option>Teknik Instalasi Tenaga Listrik</option>
						<option>Teknik Pendingin Dan Tata Udara</option>
					</select>
					<br>
					<label for="kelas" class="font-weight-bold">Kelas</label>
					<select autocomplete="off" type="select" name="kelas" required value="<?php echo $d['kelas']; ?>" class="form-control">
						<option>X</option>
						<option>XI</option>
						<option>XII</option>
					</select>
					<br>
					<label for="nomor_kelas" class="font-weight-bold">Nomor Kelas</label>
					<input autocomplete="off" type="number" name="nomor_kelas" required value="<?php echo $d['nomor_kelas']; ?>" class="form-control"/>
					</select>
				</div>
			</div>
		</div>
	
		<div class="card-footer text-right">
		<button type="reset" class="btn btn-danger"><i class="fa fa-sync-alt"></i> Reset</button>
			<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
        </div>
		<?php
			}
		}
	}
		?>
	</div>
</form>

<?php
endif;
require_once('template/footer.php');
?>