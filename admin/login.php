<?php
    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conn = new PDO('mysql:host=localhost;dbname=store_loctv', 'root', 'mysql');    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_user WHERE email = ? AND password = ? AND id_group = 0";
        $stmt = $conn->prepare($sql); //tạo prepare stement
        $stmt->execute( [$email, $password] );
        if ($stmt->rowCount() == 1){
            $user = $stmt->fetch();
            $_SESSION['login_admin'] = $user['email'];
            
                echo "<script>document.location='index.php?page=product';</script>";
               
        }
        else {
            echo "<script>document.location='index.php?page=login';</script>";
        }
    }
?>
 <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..."
                                                required name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                placeholder="Password"
                                                required name="password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" >
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" name="login">
                                            Login
                                        </button>
                                        <hr>
                                        <a href="#" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Register with Google
                                        </a>
                                        <a href="#" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="?page=forgot-password">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="?page=signup">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
