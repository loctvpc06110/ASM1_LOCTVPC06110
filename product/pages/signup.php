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

            $sql_user = "INSERT INTO tb_user SET email = ?, password = ?";
            $stmt_user = $conn->prepare($sql_user);
            $stmt_user->execute( [$email, $password] );

            $sql_customer ="INSERT INTO tb_user SET email = ?";
            $stmt_customer = $conn->prepare($sql_customer);
            $stmt_customer->execute( [$email] );


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
            <?php GLOBAL $err; if ($err != "") { ?>
                <div class="alert alert-danger"><?= $err?></div>
            <?php } ?>
        </div>
        <form method="post">
            <div class="form-group">
                <input value="<?php if (isset($email)) echo $email;?>" type="text" required name="email">
                <span>Email</span>
                <i></i>
            </div>
            <div class="form-group">
                <input value="<?php if (isset($password)) echo $password;?>" type="password" required name="password">
                <span>Password</span>
                <i></i>
            </div>
            <div class="form-group">
                <input value="<?php if (isset($rePassword)) echo $rePassword;?>" type="password" required name="rePassword">
                <span>Re-Password</span>
                <i></i>
            </div>
            <div class="form-group btn">
                <a href="?page=login" class="login">Login</a>
                <button class="normal" name="signup">Next</button>
            </div>
        </form>
        </div>
    </section>

    <?php include("footer.php"); ?>
    <!--End Footer --> 