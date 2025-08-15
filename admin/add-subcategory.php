<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
    <?php include('include/head_admin.php');


    $name = '';
    $category = '';
    $url = '';

    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = get_safe_value($con, $_GET['id']);
        $image_required = '';
        $res = mysqli_query($con, "select * from subcategory where id='$id'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $row = mysqli_fetch_assoc($res);
            $name = $row['name'];
            $category = $row['category'];
            $url = $row['url'];
        } else {
            header('location:all-subcategory.php');
            die();
        }
    }

    if (isset($_POST['submit_subcategory'])) {
        // prx($_POST);
        echo  $name = get_safe_value($con, $_POST['name']);
        echo $category = get_safe_value($con, $_POST['category']);
        echo $url = generate_seo_friendly_title($name);


        $msg = "";

        if ($msg == '') {
            if (isset($_GET['id']) && $_GET['id'] != '') {

                $update_query = "UPDATE `subcategory` SET `name`='$name',`category`='$category',`url`='$url' WHERE `id`='$id'";
                mysqli_query($con, $update_query);
            } else {
                $insert_query = "INSERT INTO `subcategory` (`name`, `category`, `url`) VALUES ('$name','$category','$url')";
                mysqli_query($con, $insert_query);
            }
            header('location:all-subcategory.php');
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
                                                <h5>Sub Category Information</h5>
                                            </div>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="theme-form theme-form-2 mega-form">


                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-3 col-form-label form-label-title">Select Category</label>
                                                        <div class="col-sm-9">
                                                            <label for="category" class="form-label" style="font-weight:600;">Select Category</label>
                                                            <select id="category" name="category" class="form-control" style="border-radius:8px; padding:10px;" required>
                                                                <option value="" disabled <?= empty($category) ? 'selected' : '' ?>>— Choose Category —</option>
                                                                <?php
                                                                $sql = "SELECT * FROM `category` WHERE `status` = '1' ORDER BY name ASC";
                                                                $res = mysqli_query($con, $sql);
                                                                while ($row = mysqli_fetch_assoc($res)) {
                                                                    $selected = ($category == $row['id']) ? 'selected' : '';
                                                                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . htmlspecialchars($row['name']) . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Sub Category Name</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="name" type="text" placeholder="Category Name" value="<?php echo $name ?>">
                                                        </div>
                                                    </div>


                                                </div>
                                                <button class="btn btn-solid" name="submit_subcategory" type="submit">Submit</button>
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
    <script>
        $('.js-example-basic-single').select2({
            placeholder: "Choose Category",
            allowClear: true
        });
    </script>

    <?php include('include/foot_admin.php'); ?>
</body>



</html>