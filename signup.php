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

    $error = $_SESSION['error'] ?? '';
    $success = $_SESSION['success'] ?? '';

    // clear them so they don't keep showing on refresh
    unset($_SESSION['error'], $_SESSION['success']);
    ?>

    <div>

        <div class="d-flex justify-content-center align-items-center min-vh-100" style="background-color:#F6F4F2;">
            <div class="card shadow-lg border-0 my-4" style="max-width: 550px; width:100%; background-color:#FFFFFF;">
                <div class="card-body p-4">
                    <!-- Form Title -->
                    <h3 class="text-center mb-4 fw-bold" style="color:#0F0F0F; font-family:'Playfair Display', serif; text-transform:uppercase;">
                        Sign Up
                    </h3>

                    <?php if (!empty($error)) : ?>
                        <div style="color: red; font-size: 14px; margin-top: 5px;">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($success)) : ?>
                        <div style="color: green; font-size: 14px; margin-top: 5px;">
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="form.php">
                        <!-- Username -->
                        <div class="mb-3">
                            <input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none"
                                name="name" placeholder="User Name *" style="background-color:transparent; font-family:'Inter', sans-serif;">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <input type="email" class="form-control border-0 border-bottom rounded-0 shadow-none"
                                name="email" placeholder="Email Here *" style="background-color:transparent;">
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <input type="tel" class="form-control border-0 border-bottom rounded-0 shadow-none"
                                name="phone" placeholder="Phone Number *" style="background-color:transparent;">
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none"
                                name="address" placeholder="Enter Address" required style="background-color:transparent;">
                        </div>

                        <!-- City -->
                        <div class="mb-3">
                            <input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none"
                                name="city" placeholder="Enter City" required style="background-color:transparent;">
                        </div>

                        <!-- State -->
                        <div class="mb-3">
                            <input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none"
                                name="state" placeholder="Enter State" required style="background-color:transparent;">
                        </div>

                        <!-- Pincode -->
                        <div class="mb-3">
                            <input type="text" class="form-control border-0 border-bottom rounded-0 shadow-none"
                                name="pincode" placeholder="Enter Pincode" required style="background-color:transparent;">
                        </div>

                        <!-- Password -->
                        <div class="mb-3 position-relative">
                            <input id="password2" name="password1" type="password" class="form-control border-0 border-bottom rounded-0 shadow-none"
                                placeholder="Password *" style="background-color:transparent;">
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword2" style="cursor:pointer;"></i>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3 position-relative">
                            <input id="password3" name="password2" type="password" class="form-control border-0 border-bottom rounded-0 shadow-none"
                                placeholder="Confirm Password *" style="background-color:transparent;">
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword3" style="cursor:pointer;"></i>
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="remember" name="tnc" value="accept">
                            <label class="form-check-label" for="remember" style="font-family:'Inter', sans-serif;">
                                Accept the Terms and Privacy Policy
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button class="btn w-100 py-2 fw-semibold" type="submit" name="register"
                            style="background-color:#CBB275; color:#0F0F0F; font-family:'Inter', sans-serif;">
                            Sign Up
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>


    <?php
    include('include/footer.php');
    ?>
</body>

</html>