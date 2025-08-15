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
    ?>
    <section class="thank-you-section py-5" style="background-color:#f6f4f2;">
        <div class="container text-center">
            <div class="thank-you-content">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Thank You" style="width:100px;margin-bottom:20px;">
                <h1 class="mb-3" style="color:#0F0F0F;">Thank You!</h1>
                <p class="mb-4" style="color:#6E6259; font-size:1.1rem;">
                    Your order has been successfully placed. We appreciate your business and will process your order soon.
                </p>
                <a href="index.php" class="btn btn-primary px-4 py-2" style="background-color:#CBB275; border:none; color:#fff; border-radius:5px;">
                    Continue Shopping
                </a>
            </div>
        </div>
    </section>

</body>


</html>