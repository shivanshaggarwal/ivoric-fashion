<?php
session_start();
require_once "google-config.php";
require_once "include/connection.php";

// Handle Google login callback for signup
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        
        // Get profile info
        $google_service = new Google_Service_Oauth2($client);
        $data = $google_service->userinfo->get();

        $google_id = $data['id'];
        $name = $data['givenName'] ?? $data['name'];
        $email = $data['email'];

        // Check if user already exists
        $stmt = $con->prepare("SELECT * FROM user WHERE google_id = ? OR email = ?");
        $stmt->bind_param("ss", $google_id, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, redirect to login
            $_SESSION['error'] = "An account with this email already exists. Please login instead.";
            header("Location: login.php");
            exit();
        } else {
            // Create new user via Google signup
            $stmt = $con->prepare("INSERT INTO user (name, email, google_id, status, created_at) 
                                 VALUES (?, ?, ?, 1, NOW())");
            $stmt->bind_param("sss", $name, $email, $google_id);
            $stmt->execute();
            
            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Google signup failed. Please try again.";
        header("Location: signup.php");
        exit();
    }
}

$google_signup_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/head.php'); ?>
</head>

<body>
    <?php include('include/header.php'); ?>

    <div>
        <div class="d-flex justify-content-center align-items-center min-vh-100" style="background-color:#F6F4F2;">
            <div class="card shadow-lg border-0 my-4" style="max-width: 550px; width:100%; background-color:#FFFFFF;">
                <div class="card-body p-4">
                    <!-- Form Title -->
                    <h3 class="text-center mb-4 fw-bold" style="color:#0F0F0F; font-family:'Playfair Display', serif; text-transform:uppercase;">
                        Sign Up
                    </h3>

                    <?php if (!empty($_SESSION['error'])) : ?>
                        <div style="color: red; font-size: 14px; margin-top: 5px;">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['success'])) : ?>
                        <div style="color: green; font-size: 14px; margin-top: 5px;">
                            <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
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
                        
                        <!-- Divider -->
                        <div class="d-flex align-items-center mb-3">
                            <div style="flex-grow: 1; height: 1px; background-color: #D5C7B2;"></div>
                            <span class="mx-2" style="color: #6E6259;">OR</span>
                            <div style="flex-grow: 1; height: 1px; background-color: #D5C7B2;"></div>
                        </div>
                        
                        <!-- Google Signup Button -->
                        <a href="<?= htmlspecialchars($google_signup_url) ?>" class="btn w-100 fw-semibold d-flex align-items-center justify-content-center"
                            style="background-color: #fff; border: 1px solid #D5C7B2; color: #0F0F0F; font-family: 'Inter', sans-serif; text-decoration: none;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" 
                                 style="height: 18px; margin-right: 10px;" alt="Google logo">
                            Continue with Google
                        </a>
                    </form>

                    <!-- Login Link -->
                    <div class="text-center mt-3">
                        <small style="font-family: 'Inter', sans-serif; color: #6E6259;">
                            Already have an account?
                            <a href="login.php" style="color: #CBB275; text-decoration: none;">Log In</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('include/footer.php'); ?>
</body>
</html>