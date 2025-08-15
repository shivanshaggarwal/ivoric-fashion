<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from themes.pixelstrap.com/fastkart/back-end/products.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Apr 2024 05:07:02 GMT -->

<head>
    <?php include('include/head_admin.php');
    if (isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($con, $_GET['type']);
        if ($type == 'status') {
            $operation = get_safe_value($con, $_GET['operation']);
            $id = get_safe_value($con, $_GET['id']);
            if ($operation == 'active') {
                $status = '1';
            } else {
                $status = '0';
            }
            $update_status_sql = "update product set status='$status' where id='$id'";
            mysqli_query($con, $update_status_sql);
        }

        if ($type == 'delete') {
            $id = get_safe_value($con, $_GET['id']);
            $select_sql = "SELECT image FROM product WHERE id='$id'";
            $result = mysqli_query($con, $select_sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $image_array = json_decode($row['image'], true); // Decode JSON array

                // Step 2: Delete record from the database
                $delete_sql = "DELETE FROM product WHERE id='$id'";
                mysqli_query($con, $delete_sql);

                // Step 3: Unlink the image files from the storage
                $uploadsDirectory = '../media/product/';

                foreach ($image_array as $filename) {
                    $filePath = $uploadsDirectory . $filename;

                    // Check if the file exists before attempting to delete it
                    if (file_exists($filePath)) {
                        unlink($filePath); // Delete the file
                        echo "Image file $filename deleted successfully<br>";
                    } else {
                        echo "Image file $filename not found in the storage<br>";
                    }
                }
                header('location:all-product.php');
            }
        }
    }

    $sql = "select * from product order by `id` desc";
    $res = mysqli_query($con, $sql);
    ?>
</head>

<body>
    <!-- tap on top start-->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end-->

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

            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="title-header option-title d-sm-flex d-block">
                                        <h5>Products List</h5>
                                        <div class="right-options">
                                            <ul>
                                                <!-- <li>
                                                    <a href="javascript:void(0)">import</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Export</a>
                                                </li> -->
                                                <li>
                                                    <a class="btn btn-solid" href="add-product.php">Add Product</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="table-responsive">
                                            <table class="table all-package theme-table table-product" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Image</th>
                                                        <th>Availability</th>
                                                        <th>Category</th>
                                                        <th>Name</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $image = json_decode($row['image']);
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i++ ?></td>
                                                            <td>
                                                                <div class="table-image">
                                                                    <img src="../media/product/<?= $image[0] ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </td>
                                                            <td><?php echo $row['availability'] ?></td>

                                                            <?php
                                                            $category = $row['category'];
                                                            $sql1 = "SELECT * FROM `category` WHERE `status` = '1' AND `id` = '$category'";
                                                            $res1 = mysqli_query($con, $sql1);
                                                            $row1 = mysqli_fetch_assoc($res1);
                                                            ?>
                                                            <td><?php echo $row1['name'] ?></td>
                                                            <td><?php echo $row['name'] ?></td>


                                                            <!-- <td class="status-close">
                                                                <span>Approved</span>
                                                            </td> -->
                                                            <!-- <td class="status-danger">
                                                                <span>Pending</span>
                                                            </td> -->

                                                            <td>
                                                                <ul>
                                                                    <!-- <li>
                                                                        <a href="order-detail.html">
                                                                            <i class="ri-eye-line"></i>
                                                                        </a>
                                                                    </li> -->

                                                                    <li>
                                                                        <a href="add-product.php?id=<?php echo $row['id']; ?>">
                                                                            <i class="ri-pencil-line"></i>
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <a href="?type=delete&id=<?php echo $row['id'] ?>">
                                                                            <i class="ri-delete-bin-line"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <?php include('include/footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <!-- page-wrapper End-->

    <?php include('include/foot_admin.php'); ?>
</body>


<!-- Mirrored from themes.pixelstrap.com/fastkart/back-end/products.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Apr 2024 05:07:02 GMT -->

</html>