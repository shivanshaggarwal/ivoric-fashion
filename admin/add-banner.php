<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
    <?php include('include/head_admin.php');

   
    $image = '';
    $image_alt_tag = '';

    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = get_safe_value($con, $_GET['id']);
        $image_required = '';
        $res = mysqli_query($con, "select * from banner where id='$id'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $row = mysqli_fetch_assoc($res);
            $image = $row['image'];
            $image_alt_tag = $row['image_alt_tag'];
        } else {
            header('location:all-banner.php');
            die();
        }
    }

    if (isset($_POST['submit_banner'])) {
        // prx($_POST);
        $image_alt_tag = get_safe_value($con, $_POST['image_alt_tag']);
        $description = get_safe_value($con, $_POST['description']);

        if (isset($_GET['id']) && $_GET['id'] == 0) {
            if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg' && $_FILES['image']['type'] != 'image/webp') {
                $msg = "Please select only png, jpg, webp and jpeg image format";
            }
        } else {
            if ($_FILES['image']['type'] != '') {
                if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg' && $_FILES['image']['type'] != 'image/jpeg') {
                    $msg = "Please select only png, jpg, webp and jpeg image format";
                }
            }
        }


        $msg = "";

        if ($msg == '') {
            if (isset($_GET['id']) && $_GET['id'] != '') {
                if ($_FILES['image']['name'] != '') {
                    $image =  $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], "../media/banner/" . $image);
                    mysqli_query($con, "UPDATE `banner` SET `image`='$image',`image_alt_tag`='$image_alt_tag' WHERE `id`='$id'");
                } else {
                    $update_query = "UPDATE `banner` SET `image`='$image',`image_alt_tag`='$image_alt_tag' WHERE `id`='$id'";

                    mysqli_query($con, $update_query);
                }
            } else {
                $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "../media/banner/" . $image);
                $insert_query = "INSERT INTO `banner`(`image`,`image_alt_tag`) 
        VALUES ('$image','$image_alt_tag')";
                mysqli_query($con, $insert_query);
                print_r($insert_query);
            }
            header('location:all-banner.php');
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
                                                <h5>Banner</h5>
                                            </div>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="theme-form theme-form-2 mega-form">
                                                    

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-3 col-form-label form-label-title"> Image</label>
                                                        <div class="form-group col-sm-9">
                                                            <input class="form-control" type="file" name="image" placeholder=" Image" value="<?php echo $image ?>" <?php echo $image ?>>

                                                            <?php
                                                            if ($image != '') {
                                                                echo "<a target='_blank' href='" . "../media/banner/" . $image . "'><img width='150px' src='" . "../media/banner/" . $image . "'/></a>";
                                                            }
                                                            ?>
                                                        </div>

                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-3 col-form-label form-label-title">Image Alt Text</label>
                                                        <div class="form-group col-sm-9">
                                                            <input class="form-control" type="text" name="image_alt_tag" <?php echo $image_alt_tag ?> placeholder="Image Alt Text" value="<?php echo $image_alt_tag ?>">

                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <button class="btn btn-solid" name="submit_banner" type="submit">Submit</button>
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