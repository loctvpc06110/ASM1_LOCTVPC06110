<?php
    $email = $_SESSION['login_email_user'];
    
    $sql_select = mysqli_query($connect, "SELECT * FROM tb_user WHERE email like '%$email%'");
    $row_up = mysqli_fetch_assoc($sql_select);
    $email_old = $row_up['email'];

    if(isset($_POST['saveIn4'])) {
        $_name = $_POST['user_name'];
        $_email = $_POST['user_email'];
        $_password = $_POST['user_password'];
        $_phone = $_POST['user_phone'];
        $_address = $_POST['user_address'];

        $sql = mysqli_query($connect, "UPDATE tb_user SET username = '$_name', address = '$_address', phone = '$_phone', email = '$_email', password = '$_password'");

        echo "<script>document.location='?page=infouser';</script>";
    }
?>
<?php include("header.php"); ?>  

    <section id="container-in4" class="section-p1">
            <h2>Your Information</h2>
            
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name: </label><br>
                    <input type="text" name="user_name" class="form-control" value="<?php if (isset($row_up['username'])) echo $row_up['username'];?>">
                </div>
                <div class="form-group">
                    <label for="">Email: </label><br>
                    <input type="email" name="user_email" class="form-control" value="<?php if (isset($row_up['email'])) echo $row_up['email'];?>">
                </div>
                <div class="form-group">
                    <label for="">Password: </label><br>
                    <input type="text" name="user_password" class="form-control" value="<?php if (isset($row_up['password'])) echo $row_up['password'];?>">
                </div>
                <div class="form-group">
                    <label for="">Phone: </label><br>
                    <input type="text" name="user_phone" class="form-control" value="<?php if (isset($row_up['phone'])) echo $row_up['phone'];?>">
                </div>
                <div class="form-group">
                    <label for="">Address: </label><br>
                    <input type="text" name="user_address" class="form-control" value="<?php if (isset($row_up['address'])) echo $row_up['address'];?>">
                </div>
              <button class="normal btn-checkout" name="saveIn4">Save</button>
              <a href="?login=logout_user" class="w3-bar-item w3-button">Log out</a>
            </form>
           
    </section>

   

<?php include("footer.php"); ?>
