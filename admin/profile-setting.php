<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
    <?php include('include/head_admin.php');

    if (isset($_POST['change_details'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = mysqli_query($con, "UPDATE `admin` SET `username`='$username',`password`='$password' WHERE `id` = '1'");
        if ($sql) {
            echo "<script>alert('Details Updated Successfully.')</script>";
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Details Start -->
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="title-header option-title">
                                                <h5>Profile Setting</h5>
                                            </div>
                                            <?php
                                            $data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `admin`"));
                                            ?>
                                            <form class="theme-form theme-form-2 mega-form" method="post">
                                                <div class="row">
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Username</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" name="username" value="<?php echo $data['username'] ?>" placeholder="Username">
                                                        </div>
                                                    </div>


                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Password</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" name="password" value="<?php echo $data['password'] ?>" placeholder="Enter Password">
                                                        </div>
                                                    </div>


                                                </div>
                                                <button class="btn btn-solid" name="change_details" type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Details End -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid End -->
        </div>
        <!-- Page Body End -->
    </div>
    <!-- page-wrapper End -->

    <?php include('include/foot_admin.php'); ?>
</body>



</html>