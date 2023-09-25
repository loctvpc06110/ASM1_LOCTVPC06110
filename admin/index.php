<?php 
    session_start();
    if(isset($_GET['login'])){
        $logout_admin = $_GET['login'];
    }
    else {
        $logout_admin= '';
    }
    if($logout_admin == 'logout_admin'){
        unset($_SESSION['login_admin']);
        echo "<script>document.location='index.php?page=login';</script>";
    }
?>

<?php include("../admincpn/connect.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LocTV PC06110</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php 
        if (isset($_GET["page"])) {
            $url = $_GET["page"];
        }else{
            $url = "product";
        }
        
        if ($url == "product") {
            include("product.php");
        }
        else if ($url == "productCate") {
            include("productCate.php");
        }
        else if ($url == "user") {
            include("user.php");
        }
        else if ($url == "login") {
            include("login.php");
        }
        else if ($url == "signup") {
            include("signup.php");
        }
        else if ($url == "forgot-password") {
            include("forgot-password.php");
        }
        else if ($url == "comment") {
            include("comment.php");
        }
    ?>
        
</body>

</html>