<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
    <?php include('include/head_admin.php'); ?>
</head>

<body>
    <!-- tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <?php include('include/header_admin.php'); ?>
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php include('include/sidebar_admin.php'); ?>
            <!-- Page Sidebar Ends-->

            <!-- index body start -->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- chart caard section start -->
                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                                <div class="custome-1-bg b-r-4 card-body">
                                    <div class="media align-items-center static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Total Revenue</span>
                                            <?php
                                            // Initialize the total revenue variable
                                            $total_revenue = 0;

                                            // Query to select all orders with order_status = '1'
                                            $sqll = mysqli_query($con, "SELECT * FROM `orders` WHERE `order_status` = '1'");

                                            // Loop through each row of the result set
                                            while ($ss = mysqli_fetch_assoc($sqll)) {
                                                // Add the final price to the total revenue
                                                $total_revenue += $ss['final_price'];
                                            }
                                            ?>
                                            <!-- Display the total revenue -->
                                            <h4 class="mb-0 counter">₹<?php echo $total_revenue; ?>
                                                <span class="badge badge-light-primary grow">
                                                    <i data-feather="trending-up"></i>8.5%</span>
                                            </h4>
                                        </div>

                                        <div class="align-self-center text-center">
                                            <i class="ri-database-2-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                                <div class="custome-2-bg b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Total Orders</span>
                                            <h4 class="mb-0 counter">
                                                <?php
                                                $sqll = mysqli_query($con, "SELECT * FROM `orders`");
                                                $count = mysqli_num_rows($sqll);

                                                echo $count;
                                                ?>
                                                <span class="badge badge-light-danger grow">
                                                    <i data-feather="trending-down"></i>8.5%</span>
                                            </h4>
                                        </div>
                                        <div class="align-self-center text-center">
                                            <i class="ri-shopping-bag-3-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                                <div class="custome-3-bg b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Total Products</span>
                                            <h4 class="mb-0 counter">
                                                <?php
                                                $sqll = mysqli_query($con, "SELECT * FROM `product`");
                                                $count = mysqli_num_rows($sqll);

                                                echo $count;
                                                ?>
                                                <a href="add-new-product.html" class="badge badge-light-secondary grow">
                                                    ADD NEW</a>
                                            </h4>
                                        </div>

                                        <div class="align-self-center text-center">
                                            <i class="ri-chat-3-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                                <div class="custome-4-bg b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Total Customers</span>
                                            <h4 class="mb-0 counter">
                                            <?php
                                                $sqll = mysqli_query($con, "SELECT * FROM `user`");
                                                $count = mysqli_num_rows($sqll);

                                                echo $count;
                                                ?>
                                                <span class="badge badge-light-success grow">
                                                    <i data-feather="trending-down"></i>8.5%</span>
                                            </h4>
                                        </div>

                                        <div class="align-self-center text-center">
                                            <i class="ri-user-add-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card o-hidden card-hover">
                                <div class="card-header border-0 pb-1">
                                    <div class="card-header-title p-0">
                                        <h4>Category</h4>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="category-slider no-arrow">
                                        <?php
                                        $sql = "select * from `category` ";
                                        $res = mysqli_query($con, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <div>
                                                <div class="dashboard-category">
                                                    <a href="add-category.php?id=<?php echo $row['id']; ?>" class="category-image">
                                                        <img src="../media/category/<?= $row['image'] ?>" class="img-fluid" alt="">
                                                    </a>
                                                    <a href="add-category.php?id=<?php echo $row['id']; ?>" class="category-name">
                                                        <h6><?= $row['name'] ?></h6>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- chart card section End -->


                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- footer start-->

                <?php include('include/footer_admin.php'); ?>
                <!-- footer End-->
            </div>
            <!-- index body end -->

        </div>
        <!-- Page Body End -->
    </div>
    <!-- page-wrapper End-->



    <?php include('include/foot_admin.php'); ?>
</body>



</html>