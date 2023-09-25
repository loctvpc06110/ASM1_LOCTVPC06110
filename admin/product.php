    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <?php include('sidebar.php'); ?>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <?php include('navnar.php'); ?>

                <!-- Chia dữ liệu cho bảng  -->

                    <?php
                    // Limit là số dòng dữ liệu hiển thị mỗi trang
                        $limit = 5;
                    
                    // Tìm CURRENT_PAGE
                        if (isset($_GET["pagination"])){
                            $current_page = $_GET["pagination"];
                        } else {
                            $current_page = 1;
                        };

                    // Start là đòng dữ liệu bất đầu
                        $start = (intval($current_page - 1 )) * $limit;
                        
                    // Truy vấn danh sách typeProduct
                        $result = $connect->query("SELECT * FROM tb_product INNER JOIN tb_prod_cate ON tb_prod_cate.cate_id = tb_product.cate_id ORDER BY product_id ASC LIMIT $start, $limit");
                    ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Product Manager</h1>
    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="#"><button class="btn btn-primary">Add</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Inventory</th>
                                            <th>Desripction</th>
                                            <th>Categogy</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php 
                                        while ($row = $result->fetch_assoc()){
                                    ?> 
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $row['product_id'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['prod_name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['status'] ?>
                                            </td>
                                            <td>
                                                <img src="./img/products/<?php echo $row['image'] ?>" width="70px">
                                            </td>
                                            <td>
                                                $ <?php echo $row['price'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['inventory'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['description'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['cate_name'] ?>
                                            </td>
                                            <td>
                                                <a href="#"><button class="btn btn-success">Edit</button></a>
                                                <a href="#"><button style="margin-top: 8px;" class="btn btn-danger">Remove</button></a>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                    <?php
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>
                            <?php
                                $limit = 5;

                                // tính tổng số dòng dữ liệu
                                $result_db = mysqli_query($connect, "SELECT COUNT(product_id) From tb_product");
                                $row_db = mysqli_fetch_row($result_db);
                                $total_records = $row_db[0];

                                // Tính tổng số trang
                                $total_page = ceil($total_records / $limit);

                                $pageLink = "<div class='w3-center'>
                                                <div class='w3-bar w3-border'>";
                                for($i = 1; $i <= $total_page; $i++) {
                                    $pageLink .= "<a href='?page=product&pagination=".$i."' class='w3-bar-item w3-button'>$i</a>";
                                }
                                echo $pageLink."</div>
                                            </div>";
                            ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            <?php 
            include('footer.php');
            ?>
            
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

