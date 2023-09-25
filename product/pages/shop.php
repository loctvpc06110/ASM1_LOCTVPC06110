<?php include("header.php"); ?>  
    <!--End Header -->

<section id="page-header">      
    <h2>#Stayhome</h2>
     
    <p>Save more with coupons & up to 70% off</p>
</section>

<section id="product1" class="section-p1">
    <h2>All Products</h2>
    
    <?php
    // Limit là số dòng dữ liệu hiển thị mỗi trang
        $limit = 12;
    
    // Tìm CURRENT_PAGE
        if (isset($_GET["pagination"])){
            $current_page = $_GET["pagination"];
        } else {
            $current_page = 1;
        };

    // Start là đòng dữ liệu bất đầu
        $start = (intval($current_page - 1 )) * $limit;
        
    // Truy vấn danh sách typeProduct
        $result = $connect->query("SELECT * FROM tb_product INNER JOIN tb_prod_cate ON tb_product.cate_id = tb_prod_cate.cate_id  ORDER BY product_id ASC LIMIT $start, $limit");
    ?>
    <div class="pro-container">
            <?php 
                while ($row = $result->fetch_assoc()){
            ?>              
        
            <div class="pro">
            <form method="post" action="?page=addcart">
                <a href="?page=detail&id=<?php echo $row['product_id'];?>">
                    <img src="../images/products/<?php echo $row['image'];?>" alt="Image Shirt">
                    <div class="des">
                    <span><?php echo $row['cate_name'];?></span>
                    <h5><?php echo $row['prod_name'];?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$ <?php echo $row['price'];?></h4>
                    </div>
                </a>    
                <i class="fa-solid fa-cart-shopping cart"></i>
            </form>    
                </div>
            <?php
                }
            ?>
        </div>

</section>

        <?php
        $limit = 12;

        // tính tổng số dòng dữ liệu
        $result_db = mysqli_query($connect, "SELECT COUNT(product_id) From tb_product");
        $row_db = mysqli_fetch_row($result_db);
        $total_records = $row_db[0];

        // Tính tổng số trang
        $total_page = ceil($total_records / $limit);

        $pageLink = "<section id='pagination' class='section-p1'>";
        for($i = 1; $i <= $total_page; $i++) {
            $pageLink .= "<a href='?page=shop&pagination=".$i."'>$i</a>";
        }
        echo $pageLink."</section>";
    ?>

<?php include("newsletter.php"); ?>
     <!--End news -->

<?php include("footer.php"); ?>
    <!--End Footer --> 
