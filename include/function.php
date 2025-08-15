<?php
function isLogin()
{
    if (!isset($_SESSION['u_email'])) {
?>
        <script>
            window.location.href = 'index.php';
        </script>
<?php
    }
}
function isNotLogin()
{
    if (isset($_SESSION['u_email'])) {
?>
        <script>
            window.location.href = 'index.php';
        </script>
<?php
    }
}
?>
<?php 
if (isset($_SESSION['u_email']) && $_SESSION['u_email'] != '') {
    $u_email = $_SESSION['u_email'];
$user = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `user` WHERE `email` = '$u_email'"));
}

$about = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `about`"));
$contact = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `info_co`"));
?>