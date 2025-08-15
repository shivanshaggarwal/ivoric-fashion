<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>

    <?php include('include/head_admin.php');

    $url = '';
    $trending = '';
    $hot_deals = '';
    $availability = '';
    $stock_num = '';
    $name = '';
    $image = '';
    $image_alt_tag = '';
    $category = '';
    $subcategory = '';
    $base_price = '';
    $discounted_price = '';
    $short_description = '';
    $sku = '';
    $description = '';
    $meta_title = '';
    $meta_desc = '';
    $meta_url = '';

    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = get_safe_value($con, $_GET['id']);
        $image_required = '';
        $res = mysqli_query($con, "select * from product where id='$id'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $row = mysqli_fetch_assoc($res);
            $id = $_GET['id'];
            $trending = $row['trending'];
            $hot_deals = $row['hot_deals'];
            $availability = $row['availability'];
            $stock_num = $row['stock_num'];
            $url = $row['url'];
            $name = $row['name'];
            $image = $row['image'];
            $image_alt_tag = $row['image_alt_tag'];
            $category = $row['category'];
            $subcategory = $row['subcategory'];
            $base_price = $row['base_price'];
            $discounted_price = $row['discounted_price'];
            $short_description = $row['short_description'];
            $sku = $row['sku'];
            $description = $row['description'];
            $meta_title = $row['meta_title'];
            $meta_desc = $row['meta_desc'];
            $meta_url = $row['meta_url'];
        } else {
            header('location:all-product.php');
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
                            <form class="theme-form theme-form-2 mega-form" action="insert.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-8 m-auto">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-header-2">
                                                    <h5>Product Information</h5>
                                                </div>


                                                <div class="row align-items-center">
                                                    <label class="col-sm-3 col-form-label form-label-title">Trending</label>
                                                    <div class="col-sm-9">
                                                        <label class="switch">
                                                            <input type="checkbox" name="trending" value="<?php if ($trending == '1') {
                                                                                                                echo '1';
                                                                                                            } else {
                                                                                                                echo '0';
                                                                                                            } ?>" <?php if ($trending == '1') {
                                                                                                                        echo 'checked';
                                                                                                                    } else {
                                                                                                                        echo '';
                                                                                                                    } ?>><span class="switch-state"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
                                                    <label class="col-sm-3 col-form-label form-label-title">Hot Deals</label>
                                                    <div class="col-sm-9">
                                                        <label class="switch">
                                                            <input type="checkbox" name="hot_deals" value="<?php if ($hot_deals == '1') {
                                                                                                                echo '1';
                                                                                                            } else {
                                                                                                                echo '0';
                                                                                                            } ?>" <?php if ($hot_deals == '1') {
                                                                                                                        echo 'checked';
                                                                                                                    } else {
                                                                                                                        echo '';
                                                                                                                    } ?>><span class="switch-state"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Product
                                                        Name</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" name="name" value="<?php echo $name ?>" placeholder="Product Name" required>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label class="col-sm-3 col-form-label form-label-title">Select Category</label>
                                                    <div class="col-sm-9">
                                                        <select class="js-example-basic-single w-100" name="category" required>
                                                            <?php
                                                            if ($category) {
                                                                $sql1 = "SELECT * FROM `category` WHERE `status` = '1' AND `id` = '$category'";
                                                                $res1 = mysqli_query($con, $sql1);
                                                                $row1 = mysqli_fetch_assoc($res1);
                                                                echo '<option value="' . $category . '" selected>' . $row1['name'] . '</option>';
                                                            } else {
                                                                echo '<option value="" selected>Choose Category</option>';
                                                            }

                                                            $sql = "SELECT * FROM `category` WHERE `status` = '1'";
                                                            $res = mysqli_query($con, $sql);
                                                            while ($row = mysqli_fetch_assoc($res)) {
                                                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label class="col-sm-3 col-form-label form-label-title">Select Sub Category</label>
                                                    <div class="col-sm-9">
                                                        <select class="js-example-basic-single w-100" name="subcategory">
                                                            <?php
                                                            if ($subcategory) {
                                                                $sql1 = "SELECT * FROM `subcategory` WHERE `id` = '$category'";
                                                                $res1 = mysqli_query($con, $sql1);
                                                                $row1 = mysqli_fetch_assoc($res1);
                                                                echo '<option value="' . $subcategory . '" selected>' . $row1['name'] . '</option>';
                                                            } else {
                                                                echo '<option value="" selected>Choose Sub Category</option>';
                                                            }

                                                            $sql = "SELECT * FROM `subcategory`";
                                                            $res = mysqli_query($con, $sql);
                                                            while ($row = mysqli_fetch_assoc($res)) {
                                                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php if (isset($_GET['id'])) { ?>
                                                    <div class="mb-4 row align-items-center" id="image_box">
                                                        <label class="col-sm-3 col-form-label form-label-title">Images</label>
                                                        <?php
                                                        $all_image = json_decode($image);
                                                        for ($i = 0; $i < count($all_image); $i++) { ?>
                                                            <div class="col-sm-6">
                                                                <input class="form-control form-choose" name="image[]" type="file" value="<?php echo $all_image[$i] ?>" id="formFile">
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-lg-3">
                                                            <button id="" type="button" class="btn btn-sm btn-info mt-2" onclick="add_more_images()">
                                                                <span id="payment-button-amount">Add Image</span>
                                                            </button>
                                                        </div>

                                                    </div>
                                                <?php } else { ?>

                                                    <div class="mb-4 row align-items-center" id="image_box">
                                                        <label class="col-sm-3 col-form-label form-label-title">Images</label>

                                                        <div class="col-sm-6">
                                                            <input class="form-control form-choose" name="image[]" type="file" id="formFile" multiple>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <button id="" type="button" class="btn btn-sm btn-info mt-2" onclick="add_more_images()">
                                                                <span id="payment-button-amount">Add Image</span>
                                                            </button>
                                                        </div>

                                                    </div>
                                                <?php } ?>
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Image Alt Tag</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" name="image_alt_tag" value="<?php echo $image_alt_tag ?>" placeholder="Image Alt Tag" required>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" name="short_description" value="<?= $short_description ?>" placeholder="Short Description" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="form-label-title col-sm-12 mb-0">Product
                                                        Description</label>
                                                    <div class="col-sm-12">
                                                        <textarea id="editor" name="description"><?php echo $description ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="col-sm-3 col-form-label form-label-title">Stock
                                                        Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="js-example-basic-single w-100" name="availability" required>
                                                            <?php if ($availability) { ?>
                                                                <option value="<?php echo $availability; ?>" selected><?php echo $availability; ?></option>
                                                            <?php } else { ?>
                                                                <option value="" selected>Choose Availability</option>
                                                            <?php } ?>
                                                            <option value="In Stock">In Stock</option>
                                                            <option value="Out Of Stock">Out Of Stock</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Stock No.</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="stock_num" value="<?php echo $stock_num ?>" type="text" placeholder="Stock No." required>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">SKU</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="sku" value="<?php echo $sku ?>" type="text" placeholder="SKU" required>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Base Price</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="base_price" value="<?php echo $base_price ?>" placeholder="Base Price" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Discounted Price</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="discounted_price" value="<?php echo $discounted_price ?>" type="text" placeholder="Discounted Price" required>
                                                    </div>
                                                </div>
                                          
                                            </div>
                                        </div>

                        

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-header-2">
                                                    <h5>Search engine listing</h5>
                                                </div>

                                                <div class="seo-view">
                                                    <span class="link"><?= $meta_url ?></span>
                                                    <h5><?= $meta_title ?></h5>
                                                    <p><?= $meta_desc ?></p>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Meta title</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="meta_title" value="<?= $meta_title ?>" type="text" placeholder="Meta title">
                                                    </div>
                                                </div>

                                                <div class="mb-4 row">
                                                    <label class="form-label-title col-sm-3 mb-0">Meta
                                                        Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="meta_desc" rows="3"><?= $meta_desc ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label class="form-label-title col-sm-3 mb-0">URL handle</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" name="meta_url" value="<?= $meta_url ?>" placeholder="Url">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php if (isset($_GET['id'])) { ?>
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <button class="btn btn-solid" name="update_product_submit" type="submit">Update</button>
                                    <?php } else { ?>
                                        <button class="btn btn-solid" name="submit" type="submit">Submit</button>
                                    <?php } ?>
                                </div>

                            </form>
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
        var total_image = 1;

        function add_more_images() {
            total_image++;
            var html = '<div class="row" id="add_image_box_' + total_image + '" ><div class="col-lg-3"></div><div class="col-lg-6">' +
                '<input class="form-control form-choose" type="file" name="image[]" id="formFile" multiple></div>' +
                '<div class="col-lg-3"><button type="button" ' +
                'class="btn btn-sm btn-danger btn-info mt-2" onclick="remove_image(' + total_image + ')">' +
                '<span id="payment-button-amount">Remove</span></button>' +
                '</div></div>';
            jQuery('#image_box').append(html);
        }

        function remove_image(id) {
            jQuery('#add_image_box_' + id).remove();
        }
    </script>
    <?php include('include/foot_admin.php'); ?>

</body>



</html>