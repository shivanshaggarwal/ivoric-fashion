<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
    <?php include('include/head_admin.php');

    $address = '';
    $phone = '';
    $phone2 = '';
    $email = '';
    $map = '';
    $location = '';
    $facebook = '';
    $insta = '';
    $twitter = '';

    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = get_safe_value($con, $_GET['id']);
        $image_required = '';
        $res = mysqli_query($con, "select * from info_co where id='$id'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $row = mysqli_fetch_assoc($res);
            $address = $row['address'];
            $phone = $row['phone'];
            $phone2 = $row['phone2'];
            $email = $row['email'];
            $map = $row['map'];
            $location = $row['location'];
            $facebook = $row['facebook'];
            $insta = $row['insta'];
            $twitter = $row['twitter'];
        } else {
            header('location:contact.php');
            die();
        }
    }

    if (isset($_POST['submit_info_co'])) {
        // prx($_POST);
        $address = get_safe_value($con, $_POST['address']);
        $phone = get_safe_value($con, $_POST['phone']);
        $phone2 = get_safe_value($con, $_POST['phone2']);
        $email = get_safe_value($con, $_POST['email']);
        $map = get_safe_value($con, $_POST['map']);
        $location = get_safe_value($con, $_POST['location']);
        $facebook = get_safe_value($con, $_POST['facebook']);
        $insta = get_safe_value($con, $_POST['insta']);
        $twitter = get_safe_value($con, $_POST['twitter']);
        $msg = "";

        if ($msg == '') {
            if (isset($_GET['id']) && $_GET['id'] != '') {

                $update_query = "UPDATE `info_co` SET `address`='$address', `phone`='$phone',`phone2`='$phone2', `email`='$email' , `map`='$map' ,`location`='$location' ,`facebook`='$facebook', `insta`='$insta', `twitter`='$twitter' WHERE `id`='$id'";

                mysqli_query($con, $update_query);
            } else {
                $insert_query = "INSERT INTO `info_co` ( `address`, `phone`,`phone2`, `email`, `map`, `location`, `facebook`, `insta`, `twitter`)
            VALUES ('$address', '$phone', '$phone2', '$email','$map', '$location', '$facebook', '$insta','$twitter')";
                mysqli_query($con, $insert_query);
            }

            header('location:contact.php');
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
                                                <h5>Contact Details</h5>
                                            </div>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="theme-form theme-form-2 mega-form">
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Address</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="address" type="text" placeholder="Address" value="<?php echo $address ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Phone</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="phone" type="tel" placeholder="Phone" value="<?php echo $phone ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Phone 2</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="phone2" type="tel" placeholder="Phone 2" value="<?php echo $phone2 ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Email</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="email" type="email" placeholder="Email" value="<?php echo $email ?>">
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Map</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="map" type="text" placeholder="Map" value="<?php echo $map ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Location</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="location" type="text" placeholder="Location" value="<?php echo $location ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Facebook</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="facebook" type="url" placeholder="Facebook" value="<?php echo $facebook ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Instagram</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="insta" type="url" placeholder="Instagram" value="<?php echo $insta ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Twitter</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="twitter" type="url" placeholder="Twitter" value="<?php echo $twitter ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-solid" name="submit_info_co" type="submit">Submit</button>
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


<!-- Mirrored from themes.pixelstrap.com/fastkart/back-end/add-new-category.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Apr 2024 05:07:04 GMT -->

</html>