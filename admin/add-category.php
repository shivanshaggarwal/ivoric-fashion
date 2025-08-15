<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
    <?php include('include/head_admin.php');


    $name = '';
    $image = '';
    $image_alt_tag = '';
    $url = '';

    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = get_safe_value($con, $_GET['id']);
        $image_required = '';
        $res = mysqli_query($con, "select * from category where id='$id'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $row = mysqli_fetch_assoc($res);
            $name = $row['name'];
            $image = $row['image'];
            $image_alt_tag = $row['image_alt_tag'];
            $url = $row['url'];
        } else {
            header('location:all-category.php');
            die();
        }
    }

    if (isset($_POST['submit_category'])) {
        // prx($_POST);
        echo  $name = get_safe_value($con, $_POST['name']);
        echo $image_alt_tag = get_safe_value($con, $_POST['image_alt_tag']);
        echo $url = generate_seo_friendly_title($name);

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
                    move_uploaded_file($_FILES['image']['tmp_name'], "../media/category/" . $image);
                    mysqli_query($con, "UPDATE `category` SET `name`='$name', `image`='$image',`image_alt_tag`='$image_alt_tag', `url`='$url' WHERE `id`='$id'");
                } else {
                    $update_query = "UPDATE `category` SET `name`='$name',`image`='$image',`image_alt_tag`='$image_alt_tag',`url`='$url' WHERE `id`='$id'";

                    mysqli_query($con, $update_query);
                }
            } else {
                $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "../media/category/" . $image);
                $insert_query = "INSERT INTO `category` (`name`, `image`, `image_alt_tag`, `url`) VALUES ('$name', '$image','$image_alt_tag','$url')";
                mysqli_query($con, $insert_query);
                print_r($insert_query);
            }
            header('location:all-category.php');
            die();
        }
    }
    function generate_seo_friendly_title($title)
    {
        // Convert the title to lowercase
        $title = strtolower($title);

        // Replace spaces with dashes
        $title = str_replace(' ', '-', $title);

        // Remove special characters
        $title = preg_replace('/[^A-Za-z0-9\-]/', '', $title);

        return $title;
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
                                                <h5>Category Information</h5>
                                            </div>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="theme-form theme-form-2 mega-form">
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Category Name</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="name" type="text" placeholder="Category Name" value="<?php echo $name ?>">
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-3 col-form-label form-label-title">Category
                                                            Image</label>
                                                        <div class="form-group col-sm-9">
                                                            <input class="form-control" type="file" name="image" placeholder="Category Image" value="<?php echo $image ?>" <?php echo $image ?>>
                                                          
                                                            <?php
                                                            if ($image != '') {
                                                                echo "<a target='_blank' href='" . "../media/category/" . $image . "'><img width='150px' src='" . "../media/category/" . $image . "'/></a>";
                                                            }
                                                            ?>
                                                        </div>

                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-3 col-form-label form-label-title">Category
                                                            Image Alt Tag</label>
                                                        <div class="form-group col-sm-9">
                                                            <input class="form-control" type="text" name="image_alt_tag" <?php echo $image_alt_tag ?> placeholder="Category Image" value="<?php echo $image_alt_tag ?>">

                                                        </div>
                                                    </div>

                                                    <!-- <div class="mb-4 row align-items-center">
                                                    <div class="col-sm-3 form-label-title">Select Category Icon</div>
                                                    <div class="col-sm-9">
                                                        <div class="dropdown icon-dropdown">
                                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                                                Select Icon
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/vegetable.svg" class="img-fluid" alt="">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/cup.svg" class="blur-up lazyload" alt="">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/meats.svg" class="img-fluid" alt="">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/breakfast.svg" class="img-fluid" alt="">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/frozen.svg" class="img-fluid" alt="">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/biscuit.svg" class="img-fluid" alt="">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/grocery.svg" class="img-fluid" alt="">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/drink.svg" class="img-fluid" alt="">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/milk.svg" class="img-fluid" alt="">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/pet.svg" class="img-fluid" alt="">
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> -->
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