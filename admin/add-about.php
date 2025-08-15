<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
    <?php include('include/head_admin.php');

    $title = '';
    $description = '';

    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = get_safe_value($con, $_GET['id']);
        $image_required = '';
        $res = mysqli_query($con, "select * from about where id='$id'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $description = $row['description'];
        } else {
            header('location:about.php');
            die();
        }
    }

    if (isset($_POST['submit_about'])) {
        // prx($_POST);
        $title = get_safe_value($con, $_POST['title']);
        $description = get_safe_value($con, $_POST['description']);

        $msg = "";

        if ($msg == '') {
            if (isset($_GET['id']) && $_GET['id'] != '') {
                mysqli_query($con, "UPDATE `about` SET `title`='$title',`description`='$description' WHERE `id`='$id'");
            } else {
                $insert_query = "INSERT INTO `about`(`title`,`description`) 
        VALUES ('$title','$description')";
                mysqli_query($con, $insert_query);
            }
            header('location:about.php');
            die();
        }
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
                                                <h5>About Details</h5>
                                            </div>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="theme-form theme-form-2 mega-form">
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Title</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="title" type="text" placeholder="Title" value="<?php echo $title ?>">
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <label class="form-label-title col-sm-12 mb-0">
                                                            Description</label>
                                                        <div class="col-sm-12">
                                                            <textarea id="editor" name="description"><?php echo $description ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-solid" name="submit_about" type="submit">Submit</button>
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