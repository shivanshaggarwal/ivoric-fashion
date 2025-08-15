<!DOCTYPE html>
<html lang="en">


<head>
    <?php
    include('include/head.php');
    ?>
</head>

<body>

    <?php include('include/header.php');
    isLogin();
    if (isset($_POST['price']) && $_POST['price'] != '0' && $_POST['price'] != '') {
    ?>

        <!-- breadcrumb section strats here -->
        <div class="breadcrumb-section mb-100"
            style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(assets/image/inner-page/breadcrumbs-image5.jpg);">
     
        </div>
        <!-- breadcrumb section ends here -->
        <!-- checkout section strats here -->
        <div class="checkout-section mb-100">
            <div class="container">
                <div class="row g-lg-4 gy-5">
                    <form action="payment.php" method="post">
                        <div class="row g-lg-4 gy-5">

                            <!-- Billing Information -->
                            <div class="col-xl-7 col-lg-8">
                                <div class="enquery-section">
                                    <div class="checkout-form-title">
                                        <h4>Billing Information</h4>
                                    </div>
                                    <div class="enquery-form-wrapper style-3">
                                        <input type="hidden" name="u_id" value="<?php echo $user['id']; ?>">
                                        <div class="row">
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <label>Full Name</label>
                                                    <input type="text" name="name" placeholder="Mr. Daniel" value="<?php echo $user['name'] ?? ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <label>Phone Number</label>
                                                    <input type="text" name="phone" placeholder="(212)+ 455 645 678" value="<?php echo $user['phone'] ?? ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email" placeholder="info@example.com" value="<?php echo $user['email'] ?? ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <label>Street Address</label>
                                                    <input type="text" name="address" placeholder="Street Address" value="<?php echo $user['address'] ?? ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <label>City</label>
                                                    <input type="text" name="city" placeholder="Town/City" value="<?php echo $user['city'] ?? ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <label>State</label>
                                                    <input type="text" name="state" placeholder="State" value="<?php echo $user['state'] ?? ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <label>Postal Code</label>
                                                    <input type="text" name="pincode" placeholder="Postal Code" value="<?php echo $user['pincode'] ?? ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-15">
                                                <div class="form-inner">
                                                    <label>Short Notes</label>
                                                    <textarea name="note" placeholder="Your Text Here"><?php echo $_POST['note'] ?? ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="col-xl-5 col-lg-4">
                                <div class="checkout-form-wrapper">
                                    <div class="checkout-form-title">
                                        <h4>Order Summary</h4>
                                    </div>
                                    <div class="order-sum-area">
                                        <?php if (!empty($_SESSION['cart'])) { ?>
                                            <div class="cart-menu">
                                                <div class="cart-body">
                                                    <ul>
                                                        <?php
                                                        $total_price = 0;
                                                        foreach ($_SESSION['cart'] as $item) {
                                                            if (empty($item)) continue;
                                                            $name = $item['product_name'] ?? '';
                                                            $price = $item['product_price'] ?? 0;
                                                            $qty = $item['product_quantity'] ?? 0;
                                                            $image = $item['product_image'] ?? '';
                                                            $total_price += $price * $qty;
                                                        ?>
                                                            <li class="single-item">
                                                                <div class="item-area">
                                                                    <div class="main-item">
                                                                        <div class="item-img">
                                                                            <a href="#"><img src="media/product/<?php echo $image; ?>" alt=""></a>
                                                                        </div>
                                                                        <div class="content-and-quantity">
                                                                            <div class="content">
                                                                                <h6><a href="#"><?php echo $name; ?></a></h6>
                                                                                <span class="item-price"><?php echo $qty; ?> X ₹ <?php echo $price; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="quantity-area">
                                                                        <div class="quantity">
                                                                            <input type="hidden" name="product_name[]" value="<?php echo $name; ?>">
                                                                            <input type="hidden" name="product_quantity[]" value="<?php echo $qty; ?>">
                                                                            <input type="hidden" name="product_price[]" value="<?php echo $price; ?>">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <div class="cart-footer">
                                                    <div class="pricing-area mb-40">
                                                        <ul>
                                                            <li>
                                                                <strong>Sub Total</strong>
                                                                <strong class="price" id="subtotal-price">₹ <?php echo $total_price; ?></strong>
                                                                <input type="hidden" name="subtotal" value="<?php echo $total_price; ?>">
                                                            </li>
                                                            <li>
                                                                <strong>Shipping</strong>
                                                                <div class="order-info">
                                                                    <p>Shipping Fee</p>
                                                                    <span id="shipping-price">₹ 149</span>
                                                                    <input type="hidden" name="shipping" value="149">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <strong>Total</strong>
                                                                <strong class="price" id="total-price">₹ <?php echo $total_price + 149; ?></strong>
                                                                <input type="hidden" name="final_price" value="<?php echo $total_price + 149; ?>">
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="payment-method-area">
                                                        <h6>Select Payment Method</h6>
                                                        <ul class="list-unstyled">
                                                            <li class="mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="shipping_method" id="option_1" value="cod" checked>
                                                                    <label class="form-check-label" for="option_1">
                                                                        Cash On Delivery
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="shipping_method" id="option_2" value="online">
                                                                    <label class="form-check-label" for="option_2">
                                                                        Online
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button name="place_order" type="submit" class="primary-btn">
                                                        Place Your Order
                                                    </button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- checkout section ends here -->
    <?php
        include('include/footer.php');
    }
    ?>
    </script>
    <!-- Add this script before </body> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subtotalElem = document.getElementById('subtotal-price');
            const shippingElem = document.getElementById('shipping-price');
            const totalElem = document.getElementById('total-price');
            const subtotalInput = document.getElementById('subtotal-input');
            const shippingInput = document.getElementById('shipping-input');
            const finalPriceInput = document.getElementById('final-price-input');

            const shippingFee = 149; // Fixed shipping

            function updateTotals() {
                let subtotal = 0;
                document.querySelectorAll('.quantity__input').forEach(input => {
                    const qty = parseInt(input.value) || 1;
                    const price = parseFloat(input.getAttribute('data-price')) || 0;
                    subtotal += qty * price;

                    // Update individual item price
                    const priceSpan = input.closest('.item-area').querySelector('.item-price');
                    if (priceSpan) priceSpan.textContent = qty + ' X ₹ ' + price;
                });

                // Update subtotal
                subtotalElem.textContent = "₹ " + subtotal.toFixed(2);
                subtotalInput.value = subtotal.toFixed(2);

                // Update shipping
                shippingElem.textContent = "₹ " + shippingFee;
                shippingInput.value = shippingFee;

                // Update total
                const total = subtotal + shippingFee;
                totalElem.textContent = "₹ " + total.toFixed(2);
                finalPriceInput.value = total.toFixed(2);
            }

            document.querySelectorAll('.quantity').forEach(quantityDiv => {
                const minusBtn = quantityDiv.querySelector('.quantity__minus');
                const plusBtn = quantityDiv.querySelector('.quantity__plus');
                const input = quantityDiv.querySelector('.quantity__input');

                // Remove previously attached listeners to avoid double increment
                minusBtn.replaceWith(minusBtn.cloneNode(true));
                plusBtn.replaceWith(plusBtn.cloneNode(true));

                const newMinus = quantityDiv.querySelector('.quantity__minus');
                const newPlus = quantityDiv.querySelector('.quantity__plus');

                newMinus.addEventListener('click', function(e) {
                    e.preventDefault();
                    let qty = parseInt(input.value) || 1;
                    if (qty > 1) input.value = qty - 1;
                    updateTotals();
                });

                newPlus.addEventListener('click', function(e) {
                    e.preventDefault();
                    let qty = parseInt(input.value) || 1;
                    input.value = qty + 1;
                    updateTotals();
                });

                input.addEventListener('change', function() {
                    let qty = parseInt(input.value) || 1;
                    if (qty < 1) qty = 1;
                    input.value = qty;
                    updateTotals();
                });
            });

            // Initial calculation
            updateTotals();
        });
    </script>


</body>


</html>