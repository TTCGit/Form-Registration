<?php
    include('includes/header.php');
?>

<?php
    //Initialize session
    session_start();

    //Check if the user is login
    if( !isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true ) {
        header('location: login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="HandheldFriendly" content="true" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>SignUp</title>
	<!-- ========== CSS INCLUDES ========== -->
	<link rel="stylesheet" href="assets/css/master.css">
</head>
<body class="welcome">
    <div class="wrapper">
        <div class="container">
            <div class="row center-col">
                <div class="col-sm-6">
                    <div class="page-header">
                        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
                    </div>
                    <p>
                        <a href="reset-password.php" class="btn">Reset Your Password</a>
                        <a href="logout.php" class="btn">Sign Out of Your Account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.js"></script>
	<script src="assets/bootstrap-master/assets/javascripts/bootstrap.min.js"></script>
	<script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>

<?php
    include('includes/footer.php');
?>