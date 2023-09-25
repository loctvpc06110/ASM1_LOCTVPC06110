<?php
     $result = $connect->query("SELECT * FROM tb_product INNER JOIN tb_prod_cate ON tb_product.cate_id = tb_prod_cate.cate_id  ORDER BY product_id ASC LIMIT 1, 4");
?>

<div class="pro-container">

        <?php 
                while ($row = $result->fetch_assoc()) { ?>  
            <a href="?page=detail&id=<?php echo $row['product_id'];?>">
                <div class="pro">
                    <img src="../images/products/<?php echo $row['image'] ?>" alt="Image Shirt">
                    <div class="des">
                    <span><?php echo $row['cate_name'] ?></span>
                    <h5><?php echo $row['prod_name'] ?></h5>
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