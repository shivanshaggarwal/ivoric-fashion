<?php
function get_safe_value($con, $str)
{
	if ($str != '') {
		$str = trim($str);
		return mysqli_real_escape_string($con, $str);
	}
}

function isAdmin()
{
    if (!isset($_SESSION['ADMIN_LOGIN'])) {
?>
        <script>
            window.location.href = 'login.php';
        </script>
<?php
    }
}

function isNotAdmin()
{
    if (isset($_SESSION['ADMIN_LOGIN'])) {
?>
        <script>
            window.location.href = 'index.php';
        </script>
<?php
    }
}
?>