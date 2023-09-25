<?php 
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql = mysqli_query($connect, "SELECT * FROM tb_product INNER JOIN tb_prod_cate ON tb_product.cate_id = tb_prod_cate.cate_id WHERE product_id='$id'");
?>
<?php include("header.php"); ?>  

    <section id="prodetails" class="section-p1">
        
        <?php 
            while($row = mysqli_fetch_array($sql)){ ?>

        <div class="single-pro-image">
            <div class="main-img" id="MainImg">
                <img src="../images/products/<?php echo $row['image'];?>" width="500px" height="auto">
            </div>

            <?php
                $cateID = $row['cate_id'];
                $sql_small_img = mysqli_query($connect, "SELECT *FROM tb_product WHERE cate_id = $cateID limit 4");
            ?>

            <div class="small-img-group">

            <?php 
            while($row_small_img = mysqli_fetch_array($sql_small_img)){ ?>

                <div class="small-img-col">
                    <a href="?page=detail&id=<?php echo $row_small_img['product_id'];?>">
                        <img src="../images/products/<?php echo $row_small_img['image'];?>" width="100%" height="120px" class="small-img">
                    </a>    
                </div>
            <?php } ?>

            </div>
        </div>
    <form method="post" action="?page=cart">
        <div class="single-pro-details">
        <input type="hidden" name="prod_id" value="<?php echo $row['product_id'];?>">
        <input type="hidden" name="prod_name_cart" value="<?php echo $row['prod_name'];?>">
        <input type="hidden" name="price_cart" value="<?php echo $row['price'];?>">
        <input type="hidden" name="image_cart" value="<?php echo $row['image'];?>">
        
            <h6 id="categoryPro"><?php echo $row['cate_name'];?></h6>
            <h4 id="namePro"><?php echo $row['prod_name'];?></h4>
            <h2 id="pricePro">$ <?php echo $row['price'];?></h2>
            <select name="size_cart">
                <option>Select Size</option>
                <option>S</option>
                <option>M</option>
                <option>L</option>
                <option>XL</option>
            </select>
            <input name="quantity_cart" type="number" value="1">
            <button type="submit" name="add_cart" class="normal">Add To Cart</button>
            <h4>Product Details</h4>
            <span id="describePro">
                <?php echo $row['description'];?>
            </span>
        </div>
    </form>
    <?php } ?>

    </section>

    <section id="comment" class="section-p1">
        <div class="comments">
        <h3>Bình luận</h3>
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Tên của bạn"><br>
            <textarea name="comment" placeholder="Nhận xét của bạn"></textarea><br>
            <input type="submit" name="submit" value="Gửi bình luận">
        </form>
        </div>

        <div class="comment-list">
    <?php
        // Kết nối đến cơ sở dữ liệu và truy vấn các bình luận đã được lưu trữ
        $result = mysqli_query($connect, "SELECT * FROM tb_comment INNER JOIN tb_detail_cmt ON tb_comment.cmt_id = tb_detail_cmt.cmt_id ORDER BY tb_comment.prod_id");

        // Hiển thị tất cả các bình luận
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="comment">';
            echo '<h4>'.$row['username'].'</h4>';
            echo '<p>'.$row['content'].'</p>';
            echo '</div>';
        }
        // Xử lý việc gửi bình luận mới
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $comment = $_POST['comment'];

            // Kiểm tra và chèn bình luận mới vào cơ sở dữ liệu
            // if (!empty($name) && !empty($comment)) {
            //     $insert_query = "INSERT INTO (name, comment) VALUES ('$name', '$comment')";
            //     mysqli_query($connect, $insert_query);
            // }
        }

    ?>

    </section>


    <section id="product1" class="section-p1">

        <h2>Similar Product</h2>
        <p>Summer Collection New Morden Design</p>

        <?php include("productDtl.php");?>

    </section>

<?php include("newsletter.php"); ?>
     <!--End news --> 

<?php include("footer.php"); ?>
    <!--End Footer --> 