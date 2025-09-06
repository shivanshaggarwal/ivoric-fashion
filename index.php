<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('include/head.php');
    ?>
    <style>
        .swiper,
        .responsivebanner,
        .responsiveban {
            width: 100%;
            height: auto;
        }

        .responsiveban img {
            width: 100%;
            height: auto;
            object-fit: cover;
            display: block;
        }


        /* ...existing code... */
        @media (max-width: 768px) {

            .banner-swiper,
            .banner-swiper .swiper-wrapper,
            .banner-swiper .swiper-slide {
                height: 100vw !important;
                min-height: 450px;
                max-height: 150vw;
            }

            .banner-swiper .swiper-slide img {
                width: 200vw;
                height: 100%;
                object-fit: cover !important;
                display: block;
            }
        }@media (max-width: 576px) {
            .categori-section .categori-content a img {
                width: 120px;
                height: 120px;
            }
        }
        /* ...existing code... */

        /* ...existing code... */
    </style>
</head>

<body>

    <?php
    include('include/header.php');
    ?>

    <!-- Banner section strats here -->
    <!-- Banner Slider -->
    <div class="px-0 mb-100">
        <div class="swiper banner-swiper">

            <div class="swiper-wrapper responsivebanner">
                <?php
                $sql = mysqli_query($con, "SELECT * FROM banner");
                while ($banner = mysqli_fetch_assoc($sql)) {
                ?>
                    <div class="swiper-slide responsiveban text-center">
                        <a href="<?= !empty($banner['link']) ? $banner['link'] : '#' ?>"
                            title="<?= $banner['image_alt_tag'] ?>">
                            <img src="media/banner/<?= $banner['image'] ?>"
                                alt="<?= $banner['image_alt_tag'] ?>"
                                class="img-fluid w-100">

                        </a>
                    </div>
                <?php } ?>
            </div>

            <!-- Navigation Buttons -->
            <!-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> -->

            <!-- Pagination Dots -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Banner section ends here -->

    <!-- Best selling product section strats here -->
    <div style="margin-bottom: 150px !important;" class="home1-product-section mb-100">
        <div class="container">
            <div class="row wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="col-lg-12 mb-50">
                    <div class="section-title text-center">
                        <h3>Featured Products</h3>
                        <p>A curated selection of timeless pieces, thoughtfully designed to elevate your everyday wardrobe.</p>
                    </div>

                </div>
            </div>
            <div class="row wow animate fadeInUp" data-wow-delay="250ms" data-wow-duration="1500ms">
                <div class="col-lg-12 position-relative ">
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
                                            <div class="batch w-25 w-md-35">
                                                <?php if ($discount > 0) { ?>
                                                    <span class="new"><?= $discount ?>% off</span>
                                                <?php } ?>
                                                <span class="px-0">Hot deal</span>
                                            </div>
                                            <div class="overlay">
                                                <div class="cart-area">
                                                    <?php if (!isset($_SESSION['u_id'])): ?>
                                                        <a class="add-cart-btn" href="login.php">
                                                            <i class="bi bi-bag-check"></i> Add To Cart
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="add-cart-btn" href="#" onclick="addtocart(
                                                        '<?php echo $product['id'] ?>',
                                                        '<?php echo addslashes($product['name']) ?>',
                                                        '<?php echo $images[0] ?>',
                                                        '<?php echo $product['discounted_price'] ?>',
                                                        '<?php echo $product['url'] ?>',
                                                        '<?php echo $product['base_price'] ?>'
                                         )">
                                                            <i class="bi bi-bag-check"></i> Add To Cart
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="view-and-favorite-area">
                                                <ul>
                                                    <li>
                                                        <?php if (!empty($_SESSION['u_email']) && !empty($_SESSION['u_id'])): ?>
                                                            <a href="javascript:void(0);"
                                                                onclick="add_to_wishlist('<?= $product['id'] ?>','<?= $_SESSION['u_id'] ?>')"
                                                                class="buttonLInk radious50">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                                    <path d="M16.528 2.20919C16.0674 1.71411 15.5099 1.31906 14.8902 1.04859C14.2704 0.778112 13.6017 0.637996 12.9255 0.636946C12.2487 0.637725 11.5794 0.777639 10.959 1.048C10.3386 1.31835 9.78042 1.71338 9.31911 2.20854L9.00132 2.54436L8.68352 2.20854C6.83326 0.217151 3.71893 0.102789 1.72758 1.95306C1.63932 2.03507 1.5541 2.12029 1.47209 2.20854C-0.490696 4.32565 -0.490696 7.59753 1.47209 9.71463L8.5343 17.1622C8.77862 17.4201 9.18579 17.4312 9.44373 17.1868C9.45217 17.1788 9.46039 17.1706 9.46838 17.1622L16.528 9.71463C18.4907 7.59776 18.4907 4.32606 16.528 2.20919ZM15.5971 8.82879H15.5965L9.00132 15.7849L2.40553 8.82879C0.90608 7.21113 0.90608 4.7114 2.40553 3.09374C3.76722 1.61789 6.06755 1.52535 7.5434 2.88703C7.61505 2.95314 7.68401 3.0221 7.75012 3.09374L8.5343 3.92104C8.79272 4.17781 9.20995 4.17781 9.46838 3.92104L10.2526 3.09438C11.6142 1.61853 13.9146 1.52599 15.3904 2.88767C15.4621 2.95378 15.531 3.02274 15.5971 3.09438C17.1096 4.71461 17.1207 7.2189 15.5971 8.82879Z"></path>
                                                                </svg>
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="login.php" class="buttonLInk radious50">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                                    <path d="M16.528 2.20919C16.0674 1.71411 15.5099 1.31906 14.8902 1.04859C14.2704 0.778112 13.6017 0.637996 12.9255 0.636946C12.2487 0.637725 11.5794 0.777639 10.959 1.048C10.3386 1.31835 9.78042 1.71338 9.31911 2.20854L9.00132 2.54436L8.68352 2.20854C6.83326 0.217151 3.71893 0.102789 1.72758 1.95306C1.63932 2.03507 1.5541 2.12029 1.47209 2.20854C-0.490696 4.32565 -0.490696 7.59753 1.47209 9.71463L8.5343 17.1622C8.77862 17.4201 9.18579 17.4312 9.44373 17.1868C9.45217 17.1788 9.46039 17.1706 9.46838 17.1622L16.528 9.71463C18.4907 7.59776 18.4907 4.32606 16.528 2.20919ZM15.5971 8.82879H15.5965L9.00132 15.7849L2.40553 8.82879C0.90608 7.21113 0.90608 4.7114 2.40553 3.09374C3.76722 1.61789 6.06755 1.52535 7.5434 2.88703C7.61505 2.95314 7.68401 3.0221 7.75012 3.09374L8.5343 3.92104C8.79272 4.17781 9.20995 4.17781 9.46838 3.92104L10.2526 3.09438C11.6142 1.61853 13.9146 1.52599 15.3904 2.88767C15.4621 2.95378 15.531 3.02274 15.5971 3.09438C17.1096 4.71461 17.1207 7.2189 15.5971 8.82879Z"></path>
                                                                </svg>
                                                            </a>
                                                        <?php endif; ?>
                                                    </li>
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

    <!-- Categori section strats here -->
    <div style="margin-bottom: 150px !important;" class="categori-section mb-100">
        <div class="container">
            <div class="row wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="col-lg-12 d-flex align-items-center mb-60">
                    <div class="section-title text-center">
                        <h3> Shop by categories</h3>
                    </div>
                    <!-- <div class="view-all-button">
                        <a href="#">View All</a>
                    </div> -->
                </div>
            </div>
            <div class="row g-4 row-cols-xxl-6 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-3 justify-content-start justify-content-md-center">
                <?php
                $catRes = mysqli_query($con, "SELECT * FROM category WHERE status = 1 ORDER BY name ASC");
                $delay = 200; // initial animation delay
                while ($catRow = mysqli_fetch_assoc($catRes)) {
                    // Check if the image exists, otherwise use a default image
                    $img = !empty($catRow['image']) ? 'media/category/' . $catRow['image'] : 'media/category/default.png';
                    echo '<div class="col wow animate fadeInDown" data-wow-delay="' . $delay . 'ms" data-wow-duration="1500ms">
                <div class="categori-content text-center">
                    <a href="category.php?category=' . urlencode($catRow['id']) . '">
                        <img src="' . $img . '" alt="' . htmlspecialchars($catRow['name']) . '" class="img-fluid">
                    </a>
                    <h6>
                        <a href="category.php?category=' . urlencode($catRow['id']) . '">' . htmlspecialchars($catRow['name']) . '</a>
                    </h6>
                </div>
            </div>';
                    $delay += 200; // increment delay for staggered animation
                }
                ?>
            </div>


        </div>
    </div>
    <!-- Categori section ends here -->


    <section style="margin-bottom: 200px !important;" id="our-story" class="m-5">
        <div class="container">
            <div class="row gap-2">
                <div class="col-md-6" data-aos="fade-up">
                    <h2 class="mb-3 text-center text-md-start">Our Story</h2>
                    <p class="text-justify text-md-start">

                        Ivoric was born in India - shaped by heritage, driven by craftsmanship, and elevated
                        for the world.

                        In a world saturated with fleeting trends and fast fashion, we envisioned something
                        different - a brand that would stand proudly from India, delivering clothing that
                        rivals the world’s finest. We wanted to redefine affordable luxury from an Indian
                        perspective - crafted in India, made for the global stage.
                        <br>

                        The name “Ivoric” draws from ivory - timeless, rare, and refined - much like
                        the garments we create. Our designs reflect minimalism, utility, and quiet
                        confidence, blending Indian craftsmanship with global luxury standards.

                    </p>
                </div>
                <div class="col-md-5" data-aos="fade-up">
                    <img src="assets/image/istockphoto-1443245439-612x612.jpg" class="custom-img" alt="Story">
                </div>
            </div>
        </div>
    </section>
 

    <!-- tesimonial section strats here -->
    <div class="testimonial-section2 mb-100">
        <div class="container">
            <div class="row wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="col-lg-12 mb-50">
                    <div class="section-title text-center">
                        <h3>What customers say about us</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper testimonial-swiper-slide2">
                        <div class="swiper-wrapper">
                            <?php
                            // Fetch testimonials from DB
                            $result = mysqli_query($con, "SELECT name, designation, message FROM testimonial ORDER BY id DESC LIMIT 10");
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <div class="swiper-slide d-flex justify-content-center">
                                    <div class="testimonial-content d-flex flex-column text-center p-4 shadow rounded" style="background:#fff; border:1px solid #eee; border-radius:15px; width:100%; max-width:350px; min-height:300px;">

                                        <!-- Static 5 Stars -->
                                        <div class="rating mb-3">
                                            <ul class="list-inline m-0">
                                                <li class="list-inline-item text-warning"><i class="bi bi-star-fill"></i></li>
                                                <li class="list-inline-item text-warning"><i class="bi bi-star-fill"></i></li>
                                                <li class="list-inline-item text-warning"><i class="bi bi-star-fill"></i></li>
                                                <li class="list-inline-item text-warning"><i class="bi bi-star-fill"></i></li>
                                                <li class="list-inline-item text-warning"><i class="bi bi-star-fill"></i></li>
                                            </ul>
                                        </div>

                                        <!-- Message -->
                                        <p class="fst-italic text-secondary flex-grow-1">
                                            “<?php echo htmlspecialchars($row['message']); ?>”
                                        </p>

                                        <!-- Author -->
                                        <div class="author-area mt-3">
                                            <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($row['name']); ?></h5>
                                            <span class="text-muted"><?php echo htmlspecialchars($row['designation']); ?></span>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Slider buttons -->
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center pt-50">
                    <div class="slider-btn-wrap3 d-flex gap-3">
                        <div class="slider-btn testimonial-slider-prev btn btn-outline-dark rounded-circle p-2 shadow">
                            <i class="bi bi-chevron-left"></i>
                        </div>
                        <div class="fractional-pagination3"></div>
                        <div class="slider-btn testimonial-slider-next btn btn-outline-dark rounded-circle p-2 shadow">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- tesimonial section ends here -->



    <?php
    include('include/footer.php');
    ?>


</body>



</html>