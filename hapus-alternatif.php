<?php require_once('includes/init.php'); ?>


<?php
$ada_error = false;
$result = '';

$id_siswa = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(!$id_siswa) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE id_siswa = '$id_siswa'");
	$cek = mysqli_num_rows($query);
	
	if($cek <= 0) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	} else {
		mysqli_query($koneksi,"DELETE FROM siswa WHERE id_siswa = '$id_siswa';");
		mysqli_query($koneksi,"DELETE FROM penilaian WHERE id_siswa = '$id_siswa';");
		mysqli_query($koneksi,"DELETE FROM hasil WHERE id_siswa = '$id_siswa';");
		redirect_to('list-alternatif.php?status=sukses-hapus');
	}
}
?>

<?php
$page = "Siswa";
require_once('template/header.php');
?>
	<?php if($ada_error): ?>
		<?php echo '<div class="alert alert-danger">'.$ada_error.'</div>'; ?>	
	<?php endif; ?>
<?php
require_once('template/footer.php');
?>