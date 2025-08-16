<?php
session_start();
require_once "google-config.php";
require_once "include/connection.php";

// Handle Google login callback
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        
        // Get profile info
        $google_service = new Google_Service_Oauth2($client);
        $data = $google_service->userinfo->get();

        $google_id = $data['id'];
        $name = $data['givenName'] ?? $data['name']; // First name if available
        $email = $data['email'];

        // Check if user exists by google_id OR email (in case they signed up normally first)
        $stmt = $con->prepare("SELECT * FROM user WHERE google_id = ? OR email = ?");
        $stmt->bind_param("ss", $google_id, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Update google_id if user exists by email but not google_id
            if (empty($user['google_id'])) {
                $update_stmt = $con->prepare("UPDATE user SET google_id = ? WHERE id = ?");
                $update_stmt->bind_param("si", $google_id, $user['id']);
                $update_stmt->execute();
            }
        } else {
            // Create new user
            $stmt = $con->prepare("INSERT INTO user (name, email, google_id, status, created_at) 
                                   VALUES (?, ?, ?, 1, NOW())");
            $stmt->bind_param("sss", $name, $email, $google_id);
            $stmt->execute();
            
            $user_id = $stmt->insert_id;
            $stmt = $con->prepare("SELECT * FROM user WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
        }

        // Set ALL required session variables (EXACTLY matching your header.php checks)
        $_SESSION['u_id'] = $user['id']; // Critical - this is what header.php checks
        $_SESSION['u_email'] = $user['email'];
        $_SESSION['u_name'] = $user['name'];
        $_SESSION['loggedin'] = true; // Extra safeguard
        
        // Regenerate session ID for security
        session_regenerate_id(true);
        
        // Redirect to home page
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Google login failed. Please try again.";
        header("Location: login.php");
        exit();
    }
}

$google_login_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/head.php'); ?>
</head>

<body>
    <?php include('include/header.php'); ?>

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
                    <button type="submit" name="login" class="btn w-100 fw-semibold mb-3"
                        style="background-color: #CBB275; border: none; color: #0F0F0F; font-family: 'Inter', sans-serif;">
                        Log In
                    </button>
                    
                    <!-- Divider -->
                    <div class="d-flex align-items-center mb-3">
                        <div style="flex-grow: 1; height: 1px; background-color: #D5C7B2;"></div>
                        <span class="mx-2" style="color: #6E6259;">OR</span>
                        <div style="flex-grow: 1; height: 1px; background-color: #D5C7B2;"></div>
                    </div>
                    
                    <!-- Google Login Button -->
                    <a href="<?= htmlspecialchars($google_login_url) ?>" class="btn w-100 fw-semibold d-flex align-items-center justify-content-center"
                        style="background-color: #fff; border: 1px solid #D5C7B2; color: #0F0F0F; font-family: 'Inter', sans-serif; text-decoration: none;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" 
                             style="height: 18px; margin-right: 10px;" alt="Google logo">
                        Continue with Google
                    </a>
                </form>

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

    <?php include('include/footer.php'); ?>
</body>
</html>
