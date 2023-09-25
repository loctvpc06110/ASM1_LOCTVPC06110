<?php
$err="";
    if ( isset($_POST['signup'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rePassword = $_POST['rePassword'];
        
        if (strlen($email)<5) { $err.="Invalid email ! <br/>";}
        if (strlen($password)<8) { $err.="Password needs to be at least 8 characters long ! <br/>";}
        if ($password != $rePassword) { $err.="Password & Retype Password must be the same ! <br/>";}

        if ($err==""){
            $conn = new PDO('mysql:host=localhost;dbname=store_loctv', 'root', 'mysql');    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql_user = "INSERT INTO tb_user SET email = ?, password = ?, id_group = 0";
            $stmt_user = $conn->prepare($sql_user);
            $stmt_user->execute( [$email, $password] );

            $sql_customer ="INSERT INTO tb_user SET email = ?";
            $stmt_customer = $conn->prepare($sql_customer);
            $stmt_customer->execute( [$email] );

            echo "<script>document.location='index.php?page=login';</script>";
        }
    }
?>
<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        placeholder="Email Address"
                                        value="<?php if (isset($email)) echo $email;?>">

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                             placeholder="Password"
                                            value="<?php if (isset($password)) echo $password;?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                             placeholder="Repeat Password"
                                            value="<?php if (isset($rePassword)) echo $rePassword;?>">
                                    </div>
                                </div>
                                <?php GLOBAL $err; if ($err != "") { ?>
                                    <div class="alert alert-danger"><?= $err?></div>
                                <?php } ?>
                                <button name="signup" class="btn btn-primary btn-user btn-block">
                                    Register Account
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
                                <a class="small" href="?page=login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
