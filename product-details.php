<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('include/head.php');
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .product-gallery {
            text-align: center;
        }

        .product-main-img {
            width: 100%;
            height: 500px;
            /* Fixed height for uniform look */
            background: #fff;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            /* center horizontally */
            position: relative;
        }

        .product-main-img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.2s ease-in-out;
            cursor: zoom-in;
        }

        .product-thumbnails img {
            width: 80px;
            height: 80px;
            border: 2px solid transparent;
            cursor: pointer;
            object-fit: cover;
        }

        .product-thumbnails img.active,
        .product-thumbnails img:hover {
            border-color: #000;
        }
    </style>

</head>

<body>

    <?php
    include('include/header.php');
    ?>
    <!-- breadcrumb section strats here -->
    <div class="breadcrumb-section mb-100"
        style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(assets/image/inner-page/breadcrumbs-image2.jpg);">

    </div>
    <!-- breadcrumb section ends here -->
    <!-- Start Shop Details top section -->
    <div class="shop-details-top-section mb-70">
        <div class="container-xl container-fluid-lg container">

            <?php
            // Get product from URL
            $url = $_GET['url'];
            $sql = "SELECT * FROM `product` WHERE `status` = '1' AND `url` = '$url'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($res);

            // Decode images JSON (stored in DB)
            $images = json_decode($row['image'], true);
            if (!$images) {
                $images = ["default.jpg"]; // fallback
            }
            ?>
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="product-gallery">
                        <!-- Main Image -->
                        <div class="product-main-img">
                            <img id="mainProductImg"
                                src="media/Product/<?php echo $images[0]; ?>"
                                alt="<?php echo htmlspecialchars($row['name']); ?>"
                                class="zoomable">
                        </div>

                        <!-- Thumbnails -->
                        <div class="product-thumbnails mt-3 d-flex gap-2 justify-content-center">
                            <?php foreach ($images as $key => $img) { ?>
                                <img src="media/Product/<?php echo $img; ?>"
                                    class="thumb-img <?php echo $key === 0 ? 'active' : ''; ?>"
                                    onclick="changeImage(this)"
                                    alt="<?php echo htmlspecialchars($row['name']); ?>">
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="shop-details-content">
                        <h3><?php echo $row['name']; ?></h3>

                        <!-- Rating (static demo) -->
                        <div class="rating-review">
                            <div class="rating">
                                <div class="star">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="price-area">
                            <p class="price">
                                <?php if (!empty($row['discounted_price'])) { ?>
                                    <del>₹ <?php echo number_format($row['base_price']); ?></del>
                                    ₹ <?php echo number_format($row['discounted_price']); ?>
                                <?php } else { ?>
                                    ₹ <?php echo number_format($row['base_price']); ?>
                                <?php } ?>
                            </p>
                        </div>

                        <!-- Size (example static list) -->
                        <div class="quantity-color-area">
                            <?php
                            $sizes = !empty($row['sizes']) ? json_decode($row['sizes']) : [];
                            ?>
                            <div class="quantity-color">
                                <h6 class="widget-title">Size</h6>
                                <div class="size-list">
                                    <ul>
                                        <?php foreach ($sizes as $size): ?>
                                            <li class="select-wrap"><?= $size ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>


                            <!-- Quantity -->
                            <div class="quantity-color">
                                <div class="quantity-area">
                                    <div class="quantity">
                                        <a class="quantity__minus"><span><i class="bi bi-dash"></i></span></a>
                                        <input name="quantity" type="text" class="quantity__input" value="1">
                                        <a class="quantity__plus"><span><i class="bi bi-plus"></i></span></a>
                                    </div>
                                </div>
                                <h6 class="widget-title">
                                    Availability:
                                    <?php if ($row['availability'] === "In Stock" || $row['stock_num'] > 0) { ?>
                                        <span style="color: #28a745; font-weight: bold;">In Stock</span>
                                    <?php } else { ?>
                                        <span style="color: #dc3545; font-weight: bold;">Out of Stock</span>
                                    <?php } ?>
                                </h6>

                            </div>
                        </div>

                        <!-- Buttons -->
                        <!-- Add to Cart -->
                        <div class="shop-details-btn">
                            <?php if (isset($_SESSION['u_email'])): ?>
                                <a class="primary-btn" href="javascript:void(0);"
                                    onclick="addtocart(
                            '<?= $row['id'] ?>',
                            '<?= addslashes($row['name']) ?>',
                            '<?= $images[0] ?>',
                            '<?= $row['discounted_price'] ?>',
                            '<?= $row['url'] ?>',
                            '<?= $row['base_price'] ?>',
                            selectedSize
                        )">
                                    ADD TO CART
                                </a>
                            <?php else: ?>
                                <a class="primary-btn" href="login.php">ADD TO CART</a>
                            <?php endif; ?>

                            <!-- Buy Now -->
                            <?php if (isset($_SESSION['u_email'])): ?>
                                <a class="primary-btn2" href="javascript:void(0);"
                                    onclick="buyNow(
                                    '<?= $row['id'] ?>',
                                    '<?= addslashes($row['name']) ?>',
                                    selectedSize,
                                    '<?= $images[0] ?>',
                                    '<?= $row['discounted_price'] ?>',
                                    '<?= $row['url'] ?>',
                                    '<?= $row['base_price'] ?>'
                                )">
                                    BUY NOW
                                </a>
                            <?php else: ?>
                                <a class="primary-btn2" href="login.php">BUY NOW</a>
                            <?php endif; ?>

                        </div>


                        <!-- Extra Info -->
                        <ul class="product-shipping-delivers">
                            <li class="product-shipping">
                                <i class="fa-solid fa-truck-fast"></i> Fast Delivery In 24 hours max
                            </li>
                            <li class="product-delivers">
                                <i class="fas fa-money-check"></i> Safe Payment
                            </li>
                        </ul>

                        <!-- Wishlist -->
                        <div class="compare-wishlist-area">
                            <ul>
                                <li>
                                    <?php if (isset($_SESSION['u_email']) && isset($_SESSION['u_id'])): ?>
                                        <a href="javascript:void(0);"
                                            onclick="add_to_wishlist('<?= $row['id'] ?>','<?= $_SESSION['u_id'] ?>')"
                                            class="buttonLInk radious50">
                                            <i class="fa-solid fa-heart"></i> Add to wishlist
                                        </a>
                                    <?php else: ?>
                                        <a href="login.php" class="buttonLInk radious50">
                                            <i class="fa-solid fa-heart"></i> Add to wishlist
                                        </a>
                                    <?php endif; ?>
                                </li>

                            </ul>
                        </div>
                        <!-- Product Info -->
                        <div class="product-info">
                            <ul class="product-info-list">
                                <li><span>Sku:</span> <?php echo $row['sku']; ?></li>
                                <li><span>Brand:</span> <a href="#">IVORIC</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function changeImage(el) {
                    document.getElementById("mainProductImg").src = el.src;
                    document.querySelectorAll(".thumb-img").forEach(img => img.classList.remove("active"));
                    el.classList.add("active");
                }
            </script>


        </div>
    </div>
    <!-- End Shop Details top section -->
    <!-- Product details page strats -->
    <div class="product-details-page mb-100">
        <div class="container">
            <div class="row">
                <div class="product-description-and-review-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="nav nav2 nav-pills" id="v-pills-tab2" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="pill"
                                    data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                    aria-selected="false">Description</button>
                                <!-- <button class="nav-link" id="size-shap-tab" data-bs-toggle="pill"
                                    data-bs-target="#size-shap" type="button" role="tab" aria-controls="size-shap"
                                    aria-selected="true">
                                    Size & Shape</button> -->
                            </div>
                            <div class="tab-content tab-content2" id="v-pills-tabContent3">
                                <div class="tab-pane fade active show" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <div class="description">
                                        <?php if (!empty($row['description'])): ?>
                                            <?= $row['description'] ?>
                                        <?php else: ?>
                                            <p>No description available for this product.</p>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <!-- <div class="tab-pane fade" id="size-shap" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <div class="addithonal-information">
                                        <table class="cart-table">
                                            <thead>
                                                <tr>
                                                    <th>Size</th>
                                                    <th>XS</th>
                                                    <th>S</th>
                                                    <th>M</th>
                                                    <th>L</th>
                                                    <th>XL</th>
                                                    <th>XXL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td data-label="Size Info">
                                                        <span>Chest</span>
                                                    </td>
                                                    <td data-label="size"><span>82</span></td>
                                                    <td data-label="size"><span>88</span></td>
                                                    <td data-label="size"><span>90</span></td>
                                                    <td data-label="size"><span>100</span></td>
                                                    <td data-label="size"><span>106</span></td>
                                                    <td data-label="size"><span>114</span></td>
                                                </tr>
                                                <tr>
                                                    <td data-label="Size Info">
                                                        <span> Waist</span>
                                                    </td>
                                                    <td data-label="size"><span>64</span></td>
                                                    <td data-label="size"><span>70</span></td>
                                                    <td data-label="size"><span>76</span></td>
                                                    <td data-label="size"><span>82</span></td>
                                                    <td data-label="size"><span>88</span></td>
                                                    <td data-label="size"><span>94</span></td>
                                                </tr>
                                                <tr>
                                                    <td data-label="Size Info">
                                                        <span> Seat</span>
                                                    </td>
                                                    <td data-label="size"><span>82</span></td>
                                                    <td data-label="size"><span>88</span></td>
                                                    <td data-label="size"><span>94</span></td>
                                                    <td data-label="size"><span>100</span></td>
                                                    <td data-label="size"><span>106</span></td>
                                                    <td data-label="size"><span>114</span></td>
                                                </tr>
                                                <tr>
                                                    <td data-label="Size Info">
                                                        <span> Shoulders</span>
                                                    </td>
                                                    <td data-label="size"><span>71</span></td>
                                                    <td data-label="size"><span>72</span></td>
                                                    <td data-label="size"><span>73</span></td>
                                                    <td data-label="size"><span>74</span></td>
                                                    <td data-label="size"><span>75</span></td>
                                                    <td data-label="size"><span>78</span></td>
                                                </tr>
                                                <tr>
                                                    <td data-label="Size Info"><span>Length</span></td>
                                                    <td data-label="size"><span>164</span></td>
                                                    <td data-label="size"><span>168</span></td>
                                                    <td data-label="size"><span>170</span></td>
                                                    <td data-label="size"><span>172</span></td>
                                                    <td data-label="size"><span>174</span></td>
                                                    <td data-label="size"><span>180</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product details page strats -->
    <!-- Best selling product section strats here -->
    <div class="home1-product-section mb-100 ">
        <div class="container">
            <div class="row wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="col-lg-12 mb-50">
                    <div class="section-title text-center">
                        <h3>Related Products</h3>
                        <p>A curated selection of timeless pieces, thoughtfully designed to elevate your everyday wardrobe.</p>
                    </div>

                </div>
            </div>
            <div class="row wow animate fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="col-lg-12 position-relative">
                    <div class="swiper home1-product-swiper">
                        <div class="swiper-wrapper">
                            <?php

                            $sql = mysqli_query($con, "SELECT * FROM `product`");
                            while ($product = mysqli_fetch_assoc($sql)) {
                                $images = json_decode($product['image']);
                                $firstImage = isset($images[0]) ? $images[0] : 'assets/image/home1/product-image.jpg';
                                $discount = (!empty($product['discounted_price']) && $product['base_price'] > 0)
                                    ? round((($product['base_price'] - $product['discounted_price']) / $product['base_price']) * 100)
                                    : 0;
                            ?>
                                <!-- Start Product Card -->
                                <div class="swiper-slide">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            <a href="product-details.php?url=<?= $product['url'] ?>">
                                                <img src="media/product/<?= $firstImage ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                            </a>
                                            <div class="batch">
                                                <?php if ($discount > 0) { ?>
                                                    <span class="new"><?= $discount ?>% off</span>
                                                <?php } ?>
                                                <span>Hot deal</span>
                                            </div>
                                            <div class="overlay">
                                                <div class="cart-area"> <a class="add-cart-btn" href="#" onclick="addtocart('<?php echo $product['id'] ?>','<?php echo $product['name'] ?>','<?php echo $images[0] ?>','<?php echo $product['discounted_price'] ?>','<?php echo $product['url'] ?>','<?php echo $product['base_price'] ?>')"> <i class="bi bi-bag-check"></i> Add To Cart </a> </div>
                                            </div>
                                            <div class="view-and-favorite-area">
                                                <ul>
                                                    <li> <?php if (isset($_SESSION['u_email'])) { ?> <a href="javascript:void(0);" onclick="add_to_wishlist('<?php echo $product['id']; ?>','<?php echo $user['id']; ?>')" class="buttonLInk radious50"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                                    <path d="M16.528 2.20919C16.0674 1.71411 15.5099 1.31906 14.8902 1.04859C14.2704 0.778112 13.6017 0.637996 12.9255 0.636946C12.2487 0.637725 11.5794 0.777639 10.959 1.048C10.3386 1.31835 9.78042 1.71338 9.31911 2.20854L9.00132 2.54436L8.68352 2.20854C6.83326 0.217151 3.71893 0.102789 1.72758 1.95306C1.63932 2.03507 1.5541 2.12029 1.47209 2.20854C-0.490696 4.32565 -0.490696 7.59753 1.47209 9.71463L8.5343 17.1622C8.77862 17.4201 9.18579 17.4312 9.44373 17.1868C9.45217 17.1788 9.46039 17.1706 9.46838 17.1622L16.528 9.71463C18.4907 7.59776 18.4907 4.32606 16.528 2.20919ZM15.5971 8.82879H15.5965L9.00132 15.7849L2.40553 8.82879C0.90608 7.21113 0.90608 4.7114 2.40553 3.09374C3.76722 1.61789 6.06755 1.52535 7.5434 2.88703C7.61505 2.95314 7.68401 3.0221 7.75012 3.09374L8.5343 3.92104C8.79272 4.17781 9.20995 4.17781 9.46838 3.92104L10.2526 3.09438C11.6142 1.61853 13.9146 1.52599 15.3904 2.88767C15.4621 2.95378 15.531 3.02274 15.5971 3.09438C17.1096 4.71461 17.1207 7.2189 15.5971 8.82879Z"> </path>
                                                                </svg> </a> <?php } else { ?> <a href="login.php" class="buttonLInk radious50"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                                    <path d="M16.528 2.20919C16.0674 1.71411 15.5099 1.31906 14.8902 1.04859C14.2704 0.778112 13.6017 0.637996 12.9255 0.636946C12.2487 0.637725 11.5794 0.777639 10.959 1.048C10.3386 1.31835 9.78042 1.71338 9.31911 2.20854L9.00132 2.54436L8.68352 2.20854C6.83326 0.217151 3.71893 0.102789 1.72758 1.95306C1.63932 2.03507 1.5541 2.12029 1.47209 2.20854C-0.490696 4.32565 -0.490696 7.59753 1.47209 9.71463L8.5343 17.1622C8.77862 17.4201 9.18579 17.4312 9.44373 17.1868C9.45217 17.1788 9.46039 17.1706 9.46838 17.1622L16.528 9.71463C18.4907 7.59776 18.4907 4.32606 16.528 2.20919ZM15.5971 8.82879H15.5965L9.00132 15.7849L2.40553 8.82879C0.90608 7.21113 0.90608 4.7114 2.40553 3.09374C3.76722 1.61789 6.06755 1.52535 7.5434 2.88703C7.61505 2.95314 7.68401 3.0221 7.75012 3.09374L8.5343 3.92104C8.79272 4.17781 9.20995 4.17781 9.46838 3.92104L10.2526 3.09438C11.6142 1.61853 13.9146 1.52599 15.3904 2.88767C15.4621 2.95378 15.531 3.02274 15.5971 3.09438C17.1096 4.71461 17.1207 7.2189 15.5971 8.82879Z"> </path>
                                                                </svg> </a> <?php } ?> </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-card-content">
                                            <div class="rating">
                                                <ul>
                                                    <?php for ($i = 0; $i < 5; $i++) { ?>
                                                        <li><i class="bi bi-star-fill"></i></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <h6>
                                                <a class="hover-underline" href="product-details.php?url=<?= $product['url'] ?>">
                                                    <?= $product['name'] ?>
                                                </a>
                                            </h6>
                                            <p class="price">
                                                <?php if ($product['discounted_price'] > 0) { ?>
                                                    <del>₹<?= $product['base_price'] ?></del> ₹<?= $product['discounted_price'] ?>
                                                <?php } else { ?>
                                                    ₹<?= $product['base_price'] ?>
                                                <?php } ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Card -->
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center pt-40">
                    <div class="slider-btn-wrap">
                        <div class="slider-btn product-slider-prev">
                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 13C11 10.5 6 8 3 7C6 6 10.5 4.5 12 1" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="fractional-pagination"></div>
                        <div class="slider-btn product-slider-next">
                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1C2 3.5 7 6 10 7C7 8 2.5 9.5 1 13" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Best selling product section ends here -->

    <script>
        function changeImage(el) {
            let mainImg = document.getElementById("mainProductImg");
            mainImg.src = el.src;

            document.querySelectorAll(".thumb-img").forEach(img => img.classList.remove("active"));
            el.classList.add("active");
        }

        // ✅ Zoom effect with centered image
        document.addEventListener("DOMContentLoaded", function() {
            const img = document.getElementById("mainProductImg");

            img.addEventListener("mousemove", function(e) {
                const {
                    left,
                    top,
                    width,
                    height
                } = this.getBoundingClientRect();
                const x = ((e.pageX - left - window.scrollX) / width) * 100;
                const y = ((e.pageY - top - window.scrollY) / height) * 100;
                this.style.transformOrigin = `${x}% ${y}%`;
                this.style.transform = "scale(2)";
            });

            img.addEventListener("mouseleave", function() {
                this.style.transform = "scale(1)";
            });
        });
    </script>

    <script>
        // This will hold the selected size globally
        let selectedSize = null;

        // Handle clicking a size
        document.querySelectorAll(".size-list .select-wrap").forEach(el => {
            el.addEventListener("click", function() {
                // Remove 'active' from all
                document.querySelectorAll(".size-list .select-wrap").forEach(li => li.classList.remove("active"));

                // Add 'active' to the clicked size
                this.classList.add("active");

                // Set the selected size
                selectedSize = this.innerText.trim();
                console.log("Selected Size:", selectedSize);
            });
        });
    </script>



    <?php
    include('include/footer.php');
    ?>
</body>

</html>