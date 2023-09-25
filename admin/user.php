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
                    $result = $connect->query("SELECT * FROM tb_user ORDER BY user_id ASC LIMIT $start, $limit");
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User Manager</h1>
    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="#"><button class="btn btn-primary">Update</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <td>Name</td>                                       
                                            <td>Address</td>
                                            <td>Phone</td>
                                            <td>Email</td>
                                            <td>Privilege <br>0 = admin | 1 = user</td>
                                        </tr>
                                    </thead>

                                    <?php 
                                        while ($row = $result->fetch_assoc()){
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $row['user_id'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['username'] ?>
                                            </td>                                       
                                            <td>
                                                <?php echo $row['address'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['phone'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['email'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['id_group'] ?>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                    <?php
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
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
