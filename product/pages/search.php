<?php include("../frontend/pages/component/header.php"); ?>  

<section id="product1" class="section-p1">
         

<?php 
    if (isset($_POST['search'])){
        $keyS = $_POST['txt_search'];
        
        if ($keyS == ""){
            echo "<h3>Please enter your search</h3>";
            // 
        }
        else {
            $sql = "SELECT * FROM tb_product INNER JOIN tb_productcate ON tb_product.cateID = tb_productcate.cateID WHERE prd_name LIKE '%$keyS%' OR cate_name LIKE '%$keyS%'";
            $query = mysqli_query($connect, $sql);
            $count = mysqli_num_rows($query);

            if ($count <= 0){
                echo "<h3>Can't find the keyword <b style='color: red;'>$keyS</b> you entered</h3>";
                //
            }
            else {
                echo "<h3>Here's the keyword matching information: <b style='color: red;'>$keyS</b></h3>";
                //  
                ?>

                <div class="pro-container">

                <?php
                    while ($row = mysqli_fetch_array($query)){ ?>
            <a href="?page=detail&id=<?php echo $row['productID'];?>">
                <div class="pro">
                    <img src="../images/products/<?php echo $row['image'];?>" alt="Image Shirt">
                    <div class="des">
                    <span><?php echo $row['cate_name'] ?></span>
                    <h5><?php echo $row['prd_name'] ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$ <?php echo $row['price'] ?></h4>
                    </div>
                    <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
                </div>
            </a>            
                <?php } ?>
                
            </div>

                <?php
            }
        }
    }
?>

<?php require("../backend/admincpn/connect.php"); ?>

    </section>

<?php include("../frontend/pages/component/footer.php"); ?>
