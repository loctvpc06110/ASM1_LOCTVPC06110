<?php 
    session_start();
    if(isset($_GET['login'])){
        $logout_user = $_GET['login'];
    }
    else {
        $logout_user = '';
    }
    if($logout_user == 'logout_user'){
        unset($_SESSION['login_email_user']);
        echo "<script>document.location='index.php?page=login';</script>";
    }
?>
<?php include('../admincpn/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocTVPC06110</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>    
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php 
        if (isset($_GET["page"])) {
            $url = $_GET["page"];
        }else{
            $url = "home";
        }
        
        if ($url == "home") {
            include("./pages/home.php");
        }
        else if ($url == "shop") {
            include("./pages/shop.php");
        }
        else if ($url == "blog"){
            include("./pages/blog.php");
        }
        else if ($url == "about"){
            include("./pages/about.php");
        }
        else if ($url == "contact"){
            include("./pages/contact.php");
        }
        else if ($url == "login"){
            include("./pages/login.php");
        }
        else if ($url == "signup"){
            include("./pages/signup.php");
        }
        else if ($url == "cart"){
            include("./pages/cart.php");
        }
        else if ($url == "forgot"){
            include("./pages/forgot.php");
        }
        else if ($url == "search"){
            include("./pages/search.php");
        }
        else if ($url == "detail"){
            include("./pages/dtlproduct.php");
        }
        else if ($url == "infouser"){
            include("./pages/infouser.php");
        }
    ?>
<script src="./js/menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>