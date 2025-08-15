<?php
include('include/head_admin.php');

if (isset($_POST['submit'])) {
    $trending = isset($_POST['trending']) ? 1 : 0;
    $hot_deals = isset($_POST['hot_deals']) ? 1 : 0;
    $availability = get_safe_value($con, $_POST['availability']);
    $stock_num = get_safe_value($con, $_POST['stock_num']);
    $name = get_safe_value($con, $_POST['name']);
    $url = generate_seo_friendly_title($name);
    $image_alt_tag = get_safe_value($con, $_POST['image_alt_tag']);
    $category = get_safe_value($con, $_POST['category']);
    $subcategory = get_safe_value($con, $_POST['subcategory']);
    $base_price = get_safe_value($con, $_POST['base_price']);
    $discounted_price = get_safe_value($con, $_POST['discounted_price']);
    $short_description = get_safe_value($con, $_POST['short_description']);
    $sku = get_safe_value($con, $_POST['sku']);
    $description = get_safe_value($con, $_POST['description']);
    $meta_title = get_safe_value($con, $_POST['meta_title']);
    $meta_desc = get_safe_value($con, $_POST['meta_desc']);
    $meta_url = get_safe_value($con, $_POST['meta_url']);


    $image_array = $_FILES['image'];
    $image_count = count($image_array['name']);
    $array = array();

    for ($i = 0; $i < $image_count; $i++) {
        $image_name = rand(111111111, 999999999) . '_' . $image_array['name'][$i];
        $image_tmp_name = $image_array['tmp_name'][$i];
        $image_size = $image_array['size'][$i];
        $image_error = $image_array['error'][$i];
        $image_type = $image_array['type'][$i];
        array_push($array, $image_name);

        // Upload the image to your desired location
        move_uploaded_file($image_tmp_name, '../media/product/' . $image_name);
    }

    echo $product_images = json_encode($array);

    $insert_query = "INSERT INTO `product`(`trending`,`hot_deals`,`availability`, `stock_num`, `url`, `name`, `image`,`image_alt_tag`,`category`,`subcategory`,`base_price`,`discounted_price`,`short_description`,`sku`,`description`,  `meta_title`,`meta_desc`,`meta_url`) 
    VALUES ('$trending','$hot_deals','$availability', '$stock_num', '$url','$name','$product_images','$image_alt_tag','$category','$subcategory','$base_price','$discounted_price','$short_description','$sku','$description', '$meta_title','$meta_desc','$meta_url')";
    mysqli_query($con, $insert_query);
    // print_r($insert_query);
    header('location: all-product.php');
    die();
}

$trending = '';
$hot_deals = '';
if (isset($_POST['update_product_submit'])) {
    echo $id = $_POST['id'];
    $trending = isset($_POST['trending']) ? 1 : 0;
    $hot_deals = isset($_POST['hot_deals']) ? 1 : 0;
    $availability = get_safe_value($con, $_POST['availability']);
    $stock_num = get_safe_value($con, $_POST['stock_num']);
    $name = get_safe_value($con, $_POST['name']);
    $url = generate_seo_friendly_title($name);
    $image_alt_tag = get_safe_value($con, $_POST['image_alt_tag']);
    $category = get_safe_value($con, $_POST['category']);
    $subcategory = get_safe_value($con, $_POST['subcategory']);
    $base_price = get_safe_value($con, $_POST['base_price']);
    $discounted_price = get_safe_value($con, $_POST['discounted_price']);
    $short_description = get_safe_value($con, $_POST['short_description']);
    $sku = get_safe_value($con, $_POST['sku']);
    $description = get_safe_value($con, $_POST['description']);
    $meta_title = get_safe_value($con, $_POST['meta_title']);
    $meta_desc = get_safe_value($con, $_POST['meta_desc']);
    $meta_url = get_safe_value($con, $_POST['meta_url']);

    // Check if new images are provided
    if (isset($_FILES['image'])) {
        // Fetch existing images from the database
        $row = mysqli_query($con, "SELECT * FROM `product` WHERE id='$id'");
        $result = mysqli_fetch_assoc($row);
        $old_images = json_decode($result['image'], true); // Decode JSON array

        $new_images = [];

        // Loop through the new images
        foreach ($_FILES['image']['name'] as $key => $value) {
            // Check if the file field is not empty
            if (!empty($_FILES['image']['name'][$key])) {
                $new_image_name = rand(111111111, 999999999) . '_' . $_FILES['image']['name'][$key];
                $new_image_tmp_name = $_FILES['image']['tmp_name'][$key];
                move_uploaded_file($new_image_tmp_name, '../media/product/' . $new_image_name);
                $new_images[] = $new_image_name;
            } else {
                // If no new image was uploaded for this index, add the corresponding old image
                $new_images[] = $old_images[$key] ?? '';
            }
        }

        // Encode the modified array of image names as JSON
       echo $product_image = json_encode($new_images);
    } else {
        // If no new images were provided, keep the existing images
      echo  $product_image = $result['image'];
    }

    // Update the product information in the database
    $update_sql = "UPDATE `product` SET `trending`='$trending',`hot_deals`='$hot_deals',`availability`='$availability', `stock_num`='$stock_num', `name`='$name', `image`='$product_image', `image_alt_tag`='$image_alt_tag', `category`='$category', `subcategory`='$subcategory', `base_price`='$base_price', `discounted_price`='$discounted_price', `short_description`='$short_description', `sku`='$sku', `description`='$description', `meta_title`='$meta_title', `meta_desc`='$meta_desc',`meta_url`='$meta_url' WHERE `id`='$id'";
    mysqli_query($con, $update_sql);
    header('location: all-product.php');
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
