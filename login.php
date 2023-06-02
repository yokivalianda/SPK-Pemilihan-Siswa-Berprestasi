<?php require_once('includes/init.php'); ?>

<?php
$errors = array();
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['username']) ? trim($_POST['password']) : '';

if (isset($_POST['submit'])) :

    // Validasi Login
    if (!$username) {
        $errors[] = 'Username tidak boleh kosong';
    }
    if (!$password) {
        $errors[] = 'Password tidak boleh kosong';
    }

    if (empty($errors)) :
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
        $cek = mysqli_num_rows($query);
        $data = mysqli_fetch_array($query);

        if ($cek > 0) {
            $hashed_password = sha1($password);
            if ($data['password'] === $hashed_password) {
                $_SESSION["user_id"] = $data["id_user"];
                $_SESSION["username"] = $data["username"];
                $_SESSION["role"] = $data["role"];
                redirect_to("dashboard.php");
            } else {
                $errors[] = 'Username atau password salah!';
            }
        } else {
            $errors[] = 'Username atau password salah!';
        }

    endif;

endif;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Sistem Pendukung Keputusan Metode TOPSIS</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
</head>

<body class="bg-gradient-success">
    <div class="container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="text-center card-body p-0">
                                    <p style="font-size: 25px; color:black">SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN SISWA BERPRESTASI DI SMK UTAMA BAKTI PALEMBANG</p>
                                    <p class="text-center card-body p-0 text-center"><img style="border-radius:50%;" src="images/logo.jpg" width="190" height="190"></p>
                                </div>
                            </div>
                            <?php if (!empty($errors)) : ?>
                                <?php foreach ($errors as $error) : ?>
                                    <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <form class="user" action="login.php" method="post">
                                <div class="form-group">
                                    <input required autocomplete="off" type="text" value="<?php echo htmlentities($username); ?>" class="form-control form-control-user" id="exampleInputUser" placeholder="Username" name="username" />
                                </div>
                                <div class="form-group">
                                    <input required autocomplete="off" type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" />
                                </div>
                                <button name="submit" type="submit" class="btn btn-success btn-user btn-block"><i class="fas fa-fw fa-sign-in-alt mr-1"></i> Masuk</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>