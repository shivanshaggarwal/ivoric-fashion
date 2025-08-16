<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/head.php'); ?>
</head>

<body>
<?php include('include/header.php'); ?>

<!-- breadcrumb section -->
<div class="breadcrumb-section mb-100"
    style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(assets/image/inner-page/breadcrumbs-image5.jpg);">
</div>

<!-- Wishlist Section -->
<div class="wishlist-section mb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <?php if (!isset($_SESSION['u_id'])): ?>
                    <!-- Not logged in -->
                    <div class="empty-cart text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png"
                            alt="Empty Wishlist" style="max-width:150px; margin-bottom:20px;">
                        <h4>Your wishlist is empty.</h4>
                        <p>Please log in to view your wishlist.</p>
                        <div class="mt-4 d-flex justify-content-center gap-3">
                            <a href="index.php" class="btn btn-outline-dark px-4 py-2 fw-semibold"
                               style="border-width:2px; border-radius:8px;">
                                <i class="bi bi-arrow-left me-2"></i> Continue Shopping
                            </a>
                            <a href="login.php" class="btn btn-dark px-4 py-2 fw-semibold"
                               style="border-radius:8px;">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php
                    $user_id = $_SESSION['u_id'];
                    $sql = "SELECT * FROM `wishlists` WHERE `user_id` = '$user_id'";
                    $res = mysqli_query($con, $sql);

                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $product_id = $row['product_id'];
                            $sqll = "SELECT * FROM `product` WHERE `id` = '$product_id'";
                            $ress = mysqli_query($con, $sqll);
                            $roww = mysqli_fetch_assoc($ress);
                            $image = json_decode($roww['image']);
                            ?>
                            <div class="wishlist-wrapper mb-30">
                                <div class="row">
                                    <!-- Product Image & Details -->
                                    <div class="col-lg-4">
                                        <div class="product-content-details style-2">
                                            <div class="procut-image">
                                                <img src="media/product/<?php echo $image[0]; ?>" alt="<?php echo $roww['image_alt_tag']; ?>">
                                            </div>
                                            <div class="product-details">
                                                <h6><a href="product.php?url=<?php echo $roww['url']; ?>"><?php echo $roww['name']; ?></a></h6>
                                                <span><strong>Sku:</strong> <?php echo $roww['sku'] ?? $roww['id']; ?></span>
                                                <p>₹<?php echo $roww['discounted_price']; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Stock Status -->
                                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                                        <div class="product-content-details">
                                            <div class="stock">
                                                <h6 class="<?php echo strtolower($roww['availability']) == 'sold out' ? 'style-2' : ''; ?>">
                                                    <?php echo $roww['availability']; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add to Cart & Delete -->
                                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                                        <div class="product-content-details close-btn">
                                            <a onclick="addtocart('<?php echo $roww['id']; ?>','<?php echo $roww['name']; ?>','<?php echo $image[0]; ?>','<?php echo $roww['discounted_price']; ?>','<?php echo $roww['url']; ?>','<?php echo $roww['base_price']; ?>')" class="primary-btn2">
                                                ADD TO CART
                                            </a>
                                            <div class="close-icon" onclick="delete_wishlist_item('<?php echo $roww['id']; ?>','<?php echo $user_id; ?>')">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 1L1 9" stroke="#222222" stroke-width="1.2" stroke-linecap="round" />
                                                    <path d="M1 1L9 9" stroke="#222222" stroke-width="1.2" stroke-linecap="round" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p class="text-center">Your wishlist is empty</p>';
                    }
                    ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>
</body>
</html>