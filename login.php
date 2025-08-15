<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('include/head.php');
    ?>
</head>

<body>
    <?php
    include('include/header.php');
    ?>


    <div>

        <div class="d-flex justify-content-center align-items-center min-vh-100" style="background-color: #F6F4F2;">
            <div class="card shadow p-4" style="max-width: 400px; width: 100%; background-color: #FFFFFF; border: 1px solid #D5C7B2;">

                <!-- Form Title -->
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-uppercase" style="font-family: 'Playfair Display', serif; color: #0F0F0F;">
                        Log In
                    </h3>
                </div>
                <?php if (!empty($_SESSION['error'])) : ?>
                    <div style="color: red; font-size: 14px; margin-top: 5px;">
                        <?= $_SESSION['error']; ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- Form -->
                <form method="post" action="form.php">
                    <!-- Contact Info -->
                    <div class="mb-3">
                        <input type="text" name="contact_info" class="form-control" placeholder="Phone Number or Email *" required
                            style="font-family: 'Inter', sans-serif; border-color: #D5C7B2;">
                    </div>

                    <!-- Password -->
                    <div class="mb-3 position-relative">
                        <input id="password" name="password" type="password" class="form-control" placeholder="Password *"
                            style="font-family: 'Inter', sans-serif; border-color: #D5C7B2;">
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword"
                            style="cursor: pointer; color: #6E6259;"></i>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" name="login" class="btn w-100 fw-semibold"
                        style="background-color: #CBB275; border: none; color: #0F0F0F; font-family: 'Inter', sans-serif;">
                        Log In
                    </button>
                </form>

                <?php if (!empty($error)) : ?>
                    <div style="color: red; font-size: 14px; margin-top: 5px;">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <!-- Sign Up Link -->
                <div class="text-center mt-3">
                    <small style="font-family: 'Inter', sans-serif; color: #6E6259;">
                        Not a member yet?
                        <a href="signup.php" style="color: #CBB275; text-decoration: none;">Sign Up</a>
                    </small>
                </div>
            </div>
        </div>

    </div>



    <?php
    include('include/footer.php');
    ?>
</body>

</html>