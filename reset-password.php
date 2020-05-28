<?php
    include('includes/header.php');
?>

<?php
    //Initialize the session
    session_start();

    //Check if the user is logged in, if not then redirect to login page
    if( !isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true ) {
        header('location: login.php');
        exit;
    }

    //Include config file
    require_once('config.php');

    //Define variables and initialize with empty values
    $new_password     = $confirm_password = '';
    $new_password_err = $confirm_password_err = '';

    //Process form data when form is submitted
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        //Validate password
        if( empty(trim($_POST["new_password"])) ){
            $new_password_err = "Please enter the new password.";     
        } elseif( strlen(trim($_POST["new_password"])) < 6 ){
            $new_password_err = "Password must have atleast 6 characters.";
        } else{
            $new_password = trim($_POST["new_password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm the password.";
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($new_password_err) && ($new_password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }

        //Check input errors before updating the database
        if( empty($new_password_err) && empty($confirm_password_err) ) {
            //Prepare an update statement
            $sql = 'UPDATE users SET password = ? WHERE id = ?';

            if( $stmt = mysqli_prepare($link, $sql) ) {
                //Bind variables to the prepend statement as parameters
                mysqli_stmt_bind_param($stmt, 'si', $param_password, $param_id);
                //Set parameters
                $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                $param_id       = $_SESSION['id'];
                //Attemtp to execute the prepared statement
                if( mysqli_stmt_execute($stmt) ) {
                    //Password updates successfully. Destroy session and redirect to login page
                    session_destroy();
                    header('location: login.php');
                    exit();
                } else {
                    echo 'Something went wrong. Please try again later.';
                }
                //Close statement
                mysqli_stmt_close($stmt);
            }
        }
        //Close connection
        mysqli_close($link);
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
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row center-col">
                <div class="col-sm-6">
                    <h2><em>Reset Password</em></h2>
                    <p class="fill">Please fill out this form to reset your password.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                        <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                            <span class="help-block"><?php echo $new_password_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a class="btn btn-link" href="welcome.php">Cancel</a>
                        </div>
                    </form>
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