<?php 
    // thêm sản phẩm vào giỏ hàng
    if (isset($_POST['add_cart'])){
        $prod_name_cart = $_POST['prod_name_cart'];
        $price_cart = $_POST['price_cart'];
        $image_cart = $_POST['image_cart'];
        $size_cart = $_POST['size_cart'];
        $quantity_cart = $_POST['quantity_cart'];
        $prod_id = $_POST['prod_id'];

        $sql_select_cart = mysqli_query($connect, "SELECT * FROM tb_cart WHERE product_id ='$prod_id'");
        $count = mysqli_num_rows($sql_select_cart);
        if($count > 0){
            $row_prd = mysqli_fetch_array($sql_select_cart);
            $quantity_cart = $row_prd['quantity'] + 1;
            $sql_cart = "UPDATE tb_cart SET quantity = '$quantity_cart' WHERE product_id ='$prod_id'";
        }
        else {
            $quantity = $quantity_cart;
            $sql_cart = "INSERT INTO tb_cart(prod_name, price, image, quantity, size, product_id) values ('$prod_name_cart', $price_cart, '$image_cart', $quantity_cart, '$size_cart', '$prod_id')";
        }
        $insert_row = mysqli_query($connect, $sql_cart);
        if ($insert_row == 0) {
            echo "<script>document.location='?page=detail&id=$prod_id';</script>";
        }
    }
    // cập nhập số lượng và xóa sản phẩm trong giỏ hàng
    else if (isset($_POST['upd_cart'])){

        for($i = 0; $i<count($_POST['product_id']); $i++){
            $product_id = $_POST['product_id'][$i];
            $quantity = $_POST['quantity'][$i];
            $sql_upd = mysqli_query($connect, "UPDATE tb_cart SET quantity = '$quantity' WHERE product_id = '$product_id'");
        }

        $product_id = $_POST['product_id'];

    }
    else if (isset($_GET['delete'])){
        $id = $_GET['delete'];
        $sql_delete = mysqli_query($connect, "DELETE FROM tb_cart WHERE cart_id = '$id'");
    }
?>

    <?php 
    // lưu thông tin khách hàng khi thang toán
    if(!isset($_SESSION['login_email_user'])){
        echo "<script>document.location='index.php?page=login';</script>";
    }
    else {
        $email = $_SESSION['login_email_user'];
        $sql_select = mysqli_query($connect, "SELECT * FROM tb_user WHERE email like '%$email%'");
        $row_up = mysqli_fetch_assoc($sql_select);

        if (isset($_POST['checkout'])){
            $name = $_POST['_name'];
            $delivery_address = $_POST['_address'];
            $email = $_POST['_email'];
            $phone = $_POST['_phone'];
            $payment = $_POST['payment'];
            $sql_user = mysqli_query($connect, "UPDATE tb_user SET username = '$name', address = '$delivery_address', phone = '$phone', email = '$email', payment = '$payment'");
        
        // tạo đơn hàng từ giỏ hàng
        if ($sql_user){
            $sql_select_customer = mysqli_query($connect, "SELECT * FROM tb_user ORDER BY user_id DESC LIMIT 1");
            $commodityCodes = rand(0,9999);
            $row_user = mysqli_fetch_array($sql_select_customer);
            $user_id = $row_user['user_id'];
            for($i = 0; $i<count($_POST['pay_product_id']); $i++){
                $product_id = $_POST['pay_product_id'][$i];
                $quantity = $_POST['pay_quantity'][$i];
    
                $sql_order = mysqli_query($connect, "INSERT INTO tb_order (product_id, quantity, commodityCodes, user_id) VALUES         ('$product_id','$quantity','$commodityCodes','$user_id')");
                $sql_delete_pay = mysqli_query($connect, "DELETE FROM tb_cart WHERE product_id = $product_id");
                echo "<script>alert('Successful order');</script>";
            }
        }
    }
}

?>

<?php
    // Limit là số dòng dữ liệu hiển thị mỗi trang
        $limit = 6;
    
    // Tìm CURRENT_PAGE
        if (isset($_GET["pagination"])){
            $current_page = $_GET["pagination"];
        } else {
            $current_page = 1;
        };

    // Start là đòng dữ liệu bất đầu
        $start = (intval($current_page - 1 )) * $limit;
        
    // Truy vấn danh sách typeProduct
        $result = $connect->query("SELECT * FROM tb_cart ORDER BY cart_id ASC LIMIT $start, $limit");
?>

<?php include("header.php"); ?>  
    <!--End Header -->  

    <section id="page-header" class="about-header">
      
      <h2>#let's_talk</h2>
      <p>LEAVE A MESSAGE, We love to hear from you!</p>

    </section>

    <section id="cart" class="section-p1">
    
    <form action="" method="post">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Size</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>

            <?php 
                $total = 0;
                while ($row = $result->fetch_assoc()){
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
            ?>    

            <tbody>
                <tr>
                    <td><a href="?page=cart&delete=<?php echo $row['cart_id']?>"><i class="fa-regular fa-circle-xmark"></i></a></td>
                    <td><img src="../images/products/<?php echo $row['image'];?>" alt=""></td>
                    <td><?php echo $row['prod_name'];?></td>
                    <td><?php echo $row['size'];?></td>
                    <td>$ <?php echo $row['price'];?></td>
                    <td>
                        <input type="number" min="1" name="quantity[]" value="<?php echo $row['quantity'];?>">
                        <input type="hidden" name="product_id[]" value="<?php echo $row['product_id'];?>">
                    </td>
                    <td>$ <?php echo $subtotal;?></td>
                </tr>
            </tbody>

            <?php } ?>
                
        </table>
        
    <?php
        $limit = 6;

        // tính tổng số dòng dữ liệu
        $result_db = mysqli_query($connect, "SELECT COUNT(cart_id) From tb_cart");
        $row_db = mysqli_fetch_row($result_db);
        $total_records = $row_db[0];

        // Tính tổng số trang
        $total_page = ceil($total_records / $limit);

        $pageLink = "<section id='pagination' class='section-p1'>";
        for($i = 1; $i <= $total_page; $i++) {
            $pageLink .= "<a href='?page=addcart&pagination=".$i."'>$i</a>";
        }
        echo $pageLink."</section>";
    ?>

    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div>

        <div id="subtotal">
             <h3>Cart Totals</h3>

            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>$ <?php GLOBAL $total; echo $total;?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$ <?php GLOBAL $total; echo $total;?></strong></td>
                </tr>
                <tr>
                    <form method="post" action="">
                    <td colspan="2" align="center"><button type="submit" name="upd_cart" class="normal">update</button></td>
                    </form>
                </tr>   
            </table>
            <h3>Checkout</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name: </label>
                    <input type="text" name="_name" class="form-control" required value="<?php if (isset($row_up['username'])) echo $row_up['username'];?>">
                </div>
                <div class="form-group">
                    <label for="">Email: </label>
                    <input type="email" name="_email" class="form-control" required value="<?php if (isset($row_up['email'])) echo $row_up['email'];?>">
                </div>
                <div class="form-group">
                    <label for="">Phone: </label>
                    <input type="text" name="_phone" class="form-control" required value="<?php if (isset($row_up['phone'])) echo $row_up['phone'];?>">
                </div>
                <div class="form-group">
                    <label for="">Address: </label>
                    <input type="text" name="_address" class="form-control" required value="<?php if (isset($row_up['address'])) echo $row_up['address'];?>">
                </div>
                <div class="form-group">
                    <label for="">Payment: </label>
                    <select name="payment" class="form-control">
                        <option>Select Payment</option>
                        <option value="COD">COD</option>
                        <option value="CreditCard">Credit Card</option>
                    </select>
                </div>

                <?php
                    $sql_select_cart = mysqli_query($connect, "SELECT * FROM tb_cart ORDER BY cart_id DESC");
                    while($row_pay = mysqli_fetch_array($sql_select_cart)) { ?>

                        <input type="hidden" name="pay_quantity[]" value="<?php echo $row_pay['quantity'];?>">
                        <input type="hidden" name="pay_product_id[]" value="<?php echo $row_pay['product_id'];?>">

                    <?php } ?>
                

                <button class="normal btn-checkout" name="checkout">Pay Now</button>
            </form>
        </div>
    
    </section>

    <?php include("footer.php"); ?>
    <!--End Footer --> 

