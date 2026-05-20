<?php
session_start();
include 'koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>inventory - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"><img src="kdg.jpg" width="400" height="385" ></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php
                                    if (isset($_POST['login'])) { //jika tombol login di tEKAN
                                        $username = $_POST['username']; //maka username = isi dari inputan username
                                        $password = ($_POST['password']); //maka password = isi dari inputan password
                                        
                                        $data = mysqli_query($koneksi, "SELECT * FROM user 
                                        WHERE username='$username' AND password='$password'"); //query untuk memilih data dari tabel user dimana username dan password sesuai dengan inputan
                                        $cek = mysqli_num_rows($data); //menghitung jumlah data yang ditemukan dari query diatas
                                        if ($cek > 0) { //jika ada datanya
                                            $_SESSION['username'] = mysqli_fetch_array($data);
                                            echo '<script>alert("Login Berhasil");
                                            location.href="index.php";</script>'; //maka diarahkan ke halaman index.php
                                        } else {
                                            echo "<script>alert('Login Gagal: Cek username dan password')</script>"; //pesan error
                                        }
                                    }
                                    ?>
                                    <form  method ="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>

                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Tampikan Password</label>
                                            </div>
                                        </div>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        const checkbox = document.getElementById("customCheck");
        const password = document.getElementById("exampleInputPassword");

            checkbox.addEventListener("click", function () {

                if (checkbox.checked) {
                    password.type = "text";
                } else {
                    password.type = "password";
                }

         });
    </script>

</body>

</html>