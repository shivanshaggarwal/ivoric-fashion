<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
    <?php include('include/head_admin.php');
    // Handle delete functionality
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $delete_query = "DELETE FROM testimonial WHERE id='$delete_id'";
        mysqli_query($conn, $delete_query);
        header('Location: all-testimonials.php');  // Redirect after delete
        die();
    }
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
                                        <h5>All Testimonials</h5>
                                        <form class="d-inline-flex">
                                            <a href="add-testimonial.php" class="align-items-center btn btn-theme d-flex">
                                                <i data-feather="plus-square"></i>Add New
                                            </a>
                                        </form>
                                    </div>

                                    <div class="table-responsive category-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>S. No.</th>
                                                        <th>Name</th>
                                                        <th>Comment</th>
                                                        <th>Designation</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    // Fetch testimonials from the database
                                                    $testimonial_query = "SELECT * FROM testimonial ORDER BY id DESC";
                                                    $result = mysqli_query($con, $testimonial_query);

                                                    // Initialize counter
                                                    $i = 1;

                                                    // Check if testimonials exist
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $id = $row['id'];
                                                            $name = $row['name'];
                                                            $comment = $row['comment'];
                                                            $designation = $row['designation'];
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                                <td><?php echo htmlspecialchars($row['designation']); ?></td>
                                                                <td><?php echo htmlspecialchars($row['comment']); ?></td>

                                                                <td>
                                                                    <ul>

                                                                        <li>
                                                                            <a href="add-category.php?id=<?php echo $row['id']; ?>">
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
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='4'>No testimonials found</td></tr>";
                                                    }
                                                    ?>

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



</html>