<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Login Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Login Customer</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <body class="hold-transition login-page">
        <div class="card-body d-flex justify-content-center">
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <a href="../../index2.html" class="h1"><b>Sufee</b>Shop</a>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Login Customer !!!</p>

                        <form action="#m" method="POST">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Username" name="username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button type="submit" name="login" class="btn btn-primary btn-block">Log In</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>


                        <!-- /.social-auth-links -->
                        <p class="mb-0">
                            <a href="?page=registrasi" class="text-center">Belum Punya Akun !</a>
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.login-box -->
        </div>
        <!-- /.login-box -->

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>



        <?php

        if (isset($_POST["login"])) {

            $username = $_POST["username"];
            $password = $_POST["password"];

            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE username='$username' AND password='$password'");

            $akunyangcocok = $ambil->num_rows;

            if ($akunyangcocok == 1) {
                $akun = $ambil->fetch_assoc();
                $_SESSION["pelanggan"] = $akun;
                echo "<script>alert('Anda sukses login');</script>";
                echo "<script>location = 'index.php';</script>";
            } else {
                echo "<script>alert('Anda gagal login, Periksa akun Anda');</script>";
                echo "<script>location = '?page=login';</script>";
            }
        }

        ?>
    </body>

    </html>