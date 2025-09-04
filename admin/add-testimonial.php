<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
    <?php
    include('include/head_admin.php');

    // Initialize variables
    $name = '';
    $comment = '';
    $designation = '';
    $id = ''; // Initialize ID to avoid errors

    // Check if an ID is passed (i.e., for updating an existing testimonial)
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = $_GET['id']; // Get the testimonial ID from the query string

        // Retrieve testimonial details from the database
        $get_testimonial_query = "SELECT * FROM testimonial WHERE id = '$id'";
        $result = mysqli_query($conn, $get_testimonial_query);

        // If testimonial exists, fetch the details
        if (mysqli_num_rows($result) > 0) {
            $testimonial = mysqli_fetch_assoc($result);
            $name = $testimonial['name'];
            $comment = $testimonial['comment'];
            $designation = $testimonial['designation'];
        }
    }

    // Check if form is submitted
    if (isset($_POST['submit_testimonial'])) {
        // Sanitize the input values using mysqli_real_escape_string to prevent SQL injection
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $designation = mysqli_real_escape_string($conn, $_POST['designation']);

        // Check if an ID is passed (i.e., for updating an existing testimonial)
        if ($id != '') {
            // Update the existing testimonial
            $update_query = "UPDATE testimonial SET name = '$name', comment = '$comment', designation = '$designation' WHERE id = '$id'";
            mysqli_query($conn, $update_query); // Execute the query

            if (mysqli_affected_rows($conn) > 0) {
                echo "Testimonial updated successfully";
            } else {
                echo "Failed to update testimonial";
            }
        } else {
            // Insert a new testimonial if no ID is provided
            $insert_query = "INSERT INTO testimonial (name, comment, designation) VALUES ('$name', '$comment', '$designation')";
            mysqli_query($conn, $insert_query); // Execute the query

            if (mysqli_affected_rows($conn) > 0) {
                echo "New testimonial added successfully";
            } else {
                echo "Failed to add new testimonial";
            }
        }

        // Redirect to the testimonials page after the operation
        header('Location: admin-testimonial.php');
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

    <!-- page-wrapper start -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <?php include('include/header_admin.php'); ?>
        <!-- Page Header Ends-->

        <!-- Page Body start -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php include('include/sidebar_admin.php'); ?>
            <!-- Page Sidebar Ends-->

            <div class="page-body">

                <!-- New Product Add Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-8 m-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-header-2">
                                                <h5>Testimonial</h5>
                                            </div>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="theme-form theme-form-2 mega-form">
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Name</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="name" type="text" placeholder="Name" value="<?php echo $name ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Comment</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="comment" type="text" placeholder="comment" value="<?php echo $comment ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Designation</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="designation" type="text" placeholder="designation" value="<?php echo $designation ?>">
                                                        </div>
                                                    </div>



                                                </div>
                                                <button class="btn btn-solid" name="submit_category" type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Product Add End -->

                <!-- footer Start -->
                <?php include('include/footer_admin.php'); ?>
                <!-- footer En -->
            </div>
            <!-- Container-fluid End -->
        </div>
        <!-- Page Body End -->
    </div>
    <!-- page-wrapper End -->

    <?php include('include/foot_admin.php'); ?>
</body>



</html>