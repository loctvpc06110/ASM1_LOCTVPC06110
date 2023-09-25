<?php
    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conn = new PDO('mysql:host=localhost;dbname=store_loctv', 'root', 'mysql');    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_user WHERE email = ? AND password = ? AND (id_group = 0 OR id_group = 1)";
        $stmt = $conn->prepare($sql); //tạo prepare stement
        $stmt->execute( [$email, $password] );
        if ($stmt->rowCount() == 1){
            $user = $stmt->fetch();
            $_SESSION['login_email_user'] = $user['email'];
            if ($user['id_group'] == 1){
                echo "<script>document.location='index.php?page=home';</script>";
                exit();
            }
        }
        else {
            echo "<script>document.location='index.php?page=login';</script>";
        }
    }
?>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="../frontend/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <?php include("header.php"); ?>  
    <!--End Header -->

    <section id="login">
        <div class="wrap">
        <div class="heading">
            <img src="../images/logo.png" width="200px">
        </div>
        <form method="post">
            <div class="form-group">
                <input value="<?php if (isset($email)) echo $email;?>" type="text" required id="_email" name="email">
                <span>Email</span>
                <i></i>
            </div>

            <div class="form-group">
                <input value="<?php if (isset($password)) echo $password;?>" type="password" required id="_password" name="password">
                <span>Password</span>
                <i></i>
            </div>

            <div class="mb3 form-check">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember account</label>
            </div>

            <div class="form-group">
                <a href="?page=forgot" class="forgot_pw">Forget password ?</a=>
            </div>
            
            <div class="form-group btn">
                <a href="?page=signup">Need an account ?</a>
                <button class="normal" name="login">Login</button>
            </div>
        </form>
        </div>
    </section>

    <?php include("footer.php"); ?>
    <!--End Footer --> 
