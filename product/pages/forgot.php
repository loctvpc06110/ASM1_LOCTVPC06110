<?php
    if ( isset($_POST['sendEmail'])){
    $email = $_POST['email'];
    $conn = new PDO('mysql:host=localhost;dbname=store_loctv', 'root', 'mysql');    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM tb_user WHERE email =?";
    $stmt = $conn->prepare($sql);
    $stmt->execute( [$email] );
    $check = $stmt->rowCount();
    if ($check==0){
        $err ="The email you entered is not registered with us!";
    }
    else {
        $newPassword = substr( md5( rand(0,999999)), 0, 8);
        $sql = "UPDATE tb_user SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute( [$newPassword, $email] );
        // đã cập nhập mk
        $result = SendPassword($email, $newPassword);
        if ($result == true){
            echo "<script>alert('Password has been sent to your email');</script>";
            echo "<script>document.location='index.php?page=login';</script>";
        }
    }//else
}
?>
 
<?php function SendPassword($email, $newPassword){
    require "../PHPMailer-master/src/PHPMailer.php"; 
    require "../PHPMailer-master/src/SMTP.php"; 
    require '../PHPMailer-master/src/Exception.php'; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
try {
    $mail->SMTPDebug = 0; //0,1,2: chế độ debug
    $mail->isSMTP();  
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com';  //SMTP servers
    $mail->SMTPAuth = true; // Enable authentication
    $mail->Username = 'loctvpc06110@gmail.com'; // SMTP username
    $mail->Password = 'cdaswpjuzqvzprgs';   // SMTP password
    $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
    $mail->Port = 465;  // port to connect to                
    $mail->setFrom('loctvpc06110@gmail.com', 'ThaiLoc' ); 
    $mail->addAddress($email); 
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Resend the password you requested';
    $noidungthu = "You received this letter because you requested a reissue of your password
        your password is: {$newPassword}
    "; 
    $mail->Body = $noidungthu;
    $mail->smtpConnect( array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));
    $mail->send();
    return true;
}catch (Exception $e) {
    echo 'Error: ', $mail->ErrorInfo;
    return false;
}
} ?>

    <?php include("header.php"); ?>  

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="../frontend/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <section id="login">
        <div class="wrap">
        <div class="heading">
            <img src="../images/logo.png" width="200px">
            <h4>Forgot Password</h4>  
            <?php GLOBAL $err; if ($err != "") { ?>
                <div class="alert alert-danger"><?= $err?></div>
            <?php } ?>
        </div>

        <form method="post">

            <div class="form-group">
                <input type="text" required name="email" value="<?php if (isset($email)) echo $email?>">
                <span>Email</span>
                <i></i>
            </div>
            
            <div class="form-group btn">
                <a href="?page=signup">Create an account ?</a>
                <button class="normal" name="sendEmail">Send Email</button>
            </div>

        </form>

        </div>
    </section>


    <?php include("footer.php"); ?>
    <!--End Footer --> 
