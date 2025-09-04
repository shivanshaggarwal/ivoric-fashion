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

<!-- Cart Content -->
<div class="cart-page mb-100">
    <div class="container-lg container-fluid">

        <?php if (!isset($_SESSION['u_id'])): ?>
            <!-- Not logged in -->
            <div class="empty-cart text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png"
                    alt="Empty Cart" style="max-width:150px; margin-bottom:20px;">
                <h4>Your shopping cart is empty.</h4>
                <p>Please log in to view your cart.</p>
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
            <!-- Logged in user cart details -->
            <?php
            // Your original cart HTML starts here
            // Shopping Cart Table
            ?>
            <div class="row g-lg-4 gy-5">
                <div class="col-xl-8 col-lg-7">
                    <div class="cart-shopping-wrapper">
                        <div class="cart-widget-title">
                            <h4>My Shopping</h4>
                        </div>
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product Info</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                    $total_price = 0;
                                    foreach ($_SESSION['cart'] as $key => $item) {
                                        // Remove the inner foreach loop - it's causing the duplication
                                        $final_price = $item['product_actual_price'] * $item['product_quantity'];
                                        $total_price += $final_price;
                                        ?>
                                        <tr>
                                            <td data-label="Product Info">
                                                <div class="product-info-wrapper">
                                                    <div class="product-info-img">
                                                        <img src="media/product/<?php echo $item['product_image']; ?>" alt="">
                                                    </div>
                                                    <div class="product-info-content">
                                                        <h6><?php echo $item['product_name']; ?></h6>
                                                        <p><span>Sku: </span><?php echo $item['product_id']; ?></p>
                                                        <div class="quantity-area">
                                                            <div class="quantity">
                                                                <a class="quantity__minus" onclick="update_quantity('<?php echo $item['product_id']; ?>','minus')"><span><i class="bi bi-dash"></i></span></a>
                                                                <input name="quantity" type="text" class="quantity__input" data-product="<?php echo $item['product_id']; ?>" value="<?php echo $item['product_quantity']; ?>">
                                                                <a class="quantity__plus" onclick="update_quantity('<?php echo $item['product_id']; ?>','plus')"><span><i class="bi bi-plus"></i></span></a>
                                                            </div>
                                                        </div>
                                                        <ul>
                                                            <li onclick="remove_item_from_cart('<?php echo $item['product_id']; ?>')">remove</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Price">
                                                <span data-product-price="<?php echo $item['product_id']; ?>" data-price="<?php echo $item['product_actual_price']; ?>">
                                                    ₹<?php echo $item['product_actual_price']; ?>
                                                </span>
                                            </td>
                                            <td data-label="Total" data-product-total="<?php echo $item['product_id']; ?>">
                                                ₹<?php echo $final_price; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="3" class="text-center">Your cart is empty</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <a href="index.php" class="details-button">
                            Continue Shopping
                            <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.33624 2.84003L1.17627 10L0 8.82373L7.15914 1.66376H0.849347V0H10V9.15065H8.33624V2.84003Z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="cart-order-sum-area">
                        <div class="cart-widget-title">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="order-summary-wrap">
                            <ul class="order-summary-list">
                                <li>
                                    <strong>Sub Total</strong>
                                    <span data-subtotal>₹<?php echo isset($total_price) ? number_format($total_price, 2) : '0.00'; ?></span>
                                </li>
                                <li>
                                    <strong>Shipping</strong>
                                    <div class="order-info">
                                        <p>Shipping Free*</p>
                                        <span>Pickup fee ₹10.00</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="coupon-area">
                                        <strong>Coupon Code</strong>
                                        <form>
                                            <div class="form-inner">
                                                <input type="text" placeholder="Your code">
                                                <button type="submit" class="apply-btn">Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <strong>Total</strong>
                                    <span data-grand-total>₹<?php echo isset($total_price) ? number_format($total_price + 10, 2) : '10.00'; ?></span>
                                </li>
                            </ul>
                            <form action="checkout-page.php" method="post">
                                <input type="hidden" name="price" value="<?php echo isset($total_price) ? $total_price + 10 : 10; ?>">
                                <button type="submit" class="primary-btn mt-40" name="checkout">
                                    Proceed to CHECKOUT
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include('include/footer.php'); ?>

<script>
    function update_quantity(product_id, action) {
        // Find the input for this product
        const selector = `.quantity__input[data-product="${product_id}"]`;
        const quantityInput = document.querySelector(selector);
        if (!quantityInput) return;

        // Let any other UI handlers (main.js) run first, then read the final value.
        setTimeout(() => {
            // Read final quantity from input (ensures single increment)
            let currentQty = parseInt(quantityInput.value) || 1;

            // Defensive: enforce minimum 1
            if (currentQty < 1) currentQty = 1;
            quantityInput.value = currentQty;

            // Send AJAX request to update cart on server
            $.post("ajax.php", {
                product_id: product_id,
                quantity: currentQty,
                update_cart_quantity: "1"
            }, function(resp) {
                try {
                    var data = (typeof resp === 'string') ? JSON.parse(resp) : resp;
                    if (data.status === "success") {
                        // Update per-item total from server-calculated value if provided
                        const totalElement = document.querySelector(`[data-product-total="${product_id}"]`);
                        if (totalElement && typeof data.item_total !== 'undefined') {
                            totalElement.textContent = '₹' + Number(data.item_total).toFixed(2).replace(/\.00$/, '');
                        } else {
                            // fallback: calculate from per-item price
                            const priceEl = document.querySelector(`[data-product-price="${product_id}"]`);
                            if (priceEl) {
                                const price = parseFloat(priceEl.dataset.price) || 0;
                                if (totalElement) totalElement.textContent = '₹' + (price * currentQty).toFixed(2).replace(/\.00$/, '');
                            }
                        }

                        // Update subtotal / grand total
                        if (typeof data.cart_total !== 'undefined') {
                            document.querySelector('[data-subtotal]').textContent = '₹' + Number(data.cart_total).toFixed(2).replace(/\.00$/, '');
                            document.querySelector('[data-grand-total]').textContent = '₹' + Number(data.cart_total + 10).toFixed(2).replace(/\.00$/, '');
                            // update hidden checkout price
                            const hidden = document.querySelector('input[name="price"]');
                            if (hidden) hidden.value = (Number(data.cart_total) + 10);
                        } else {
                            // fallback: recalc client-side totals
                            updateCartTotals();
                        }

                        // Update header cart badge if server returned cart_count
                        if (typeof window.updateCartBadge === 'function' && typeof data.cart_count !== 'undefined') {
                            window.updateCartBadge(data.cart_count);
                        }
                    }
                    showToast(data.msg, data.status);
                } catch (e) {
                    console.error('Invalid JSON from ajax.php (update quantity):', resp, e);
                    showToast('Server error. Try again.', 'error');
                }
            }, 'json').fail(function(xhr, status, err) {
                console.error('AJAX error (update quantity):', status, err, xhr.responseText);
                showToast('Server error. Try again.', 'error');
            });
        }, 60); // small delay so other handlers run first
    }

    function updateCartTotals() {
        let subtotal = 0;
        
        // Calculate new subtotal from all items
        document.querySelectorAll('[data-product-total]').forEach(element => {
            const totalText = element.textContent.replace('₹', '');
            subtotal += parseFloat(totalText) || 0;
        });
        
        // Update subtotal display
        document.querySelector('[data-subtotal]').textContent = '₹' + subtotal.toFixed(2);
        
        // Update grand total (subtotal + shipping)
        const shipping = 10; // Fixed shipping cost
        const grandTotal = subtotal + shipping;
        document.querySelector('[data-grand-total]').textContent = '₹' + grandTotal.toFixed(2);
        
        // Update hidden input for checkout
        document.querySelector('input[name="price"]').value = grandTotal;
    }
</script>
</body>
</html>