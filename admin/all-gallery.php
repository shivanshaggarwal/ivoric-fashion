<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from themes.pixelstrap.com/fastkart/back-end/category.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Apr 2024 05:07:03 GMT -->

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
            $update_status_sql = "update gallery set status='$status' where id='$id'";
            mysqli_query($con, $update_status_sql);
        }

        if ($type == 'delete') {
            $id = get_safe_value($con, $_GET['id']);
            $select_sql = "SELECT image FROM gallery WHERE id='$id'";
            $result = mysqli_query($con, $select_sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $filename = $row['image'];

                // Step 2: Delete record from the database
                $delete_sql = "DELETE FROM gallery WHERE id='$id'";
                mysqli_query($con, $delete_sql);

                // Step 3: Unlink the image file from the storage
                $uploadsDirectory = '../media/gallery/';
                $filePath = $uploadsDirectory . $filename;

                // Check if the file exists before attempting to delete it
                if (file_exists($filePath)) {
                    unlink($filePath); // Delete the file
                    echo "gallery and image file deleted successfully";
                } else {
                    echo "Image file not found in the storage";
                }
                header('location:all-gallery.php');
            }
        }
    }

    $sql = "select * from gallery ";
    $res = mysqli_query($con, $sql);
    ?>
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

        <!-- Page Body Start -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php include('include/sidebar_admin.php'); ?>
            <!-- Page Sidebar Ends-->

            <!-- Container-fluid starts-->
            <div class="page-body">
                <!-- All User Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>All Gallery</h5>
                                        <form class="d-inline-flex">
                                            <a href="add-gallery.php" class="align-items-center btn btn-theme d-flex">
                                                <i data-feather="plus-square"></i>Add Gallery
                                            </a>
                                        </form>
                                    </div>

                                    <div class="table-responsive category-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>S. No.</th>
                                                        <th>Image</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                                        <tr>
                                                            <td><?php echo $i++ ?></td>
                                                            <td>
                                                                <div class="table-image">
                                                                    <?php
                                                                    echo "<a target='_blank' href='" . "../media/gallery/" . $row['image'] . "'><img width='50px' src='" . "../media/gallery/" . $row['image'] . "'/></a>";
                                                                    ?>
                                                                </div>
                                                            </td>

                                                           

                                                           

                                                            <td>
                                                                <ul>
                                                                    <!-- <li>
                                                                        <a href="order-detail.html">
                                                                            <i class="ri-eye-line"></i>
                                                                        </a>
                                                                    </li> -->

                                                                    <li>
                                                                        <a href="add-gallery.php?id=<?php echo $row['id']; ?>">
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
                <!-- All User Table Ends-->

                <?php include('include/footer_admin.php'); ?>
            </div>
            <!-- Container-fluid end -->
        </div>
        <!-- Page Body End -->

    </div>

    <?php include('include/foot_admin.php'); ?>
</body>


<!-- Mirrored from themes.pixelstrap.com/fastkart/back-end/category.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Apr 2024 05:07:03 GMT -->

</html>