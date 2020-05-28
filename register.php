<?php
    include('includes/header.php');
?>

<?php
    //Include config file
    require_once('config.php');

    //Define variables and initialize with empty values
    $username     = $password     = $confirm_password = '';
    $username_err = $password_err = $confirm_password_err = '';

    //Process form data when form is submitted
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        // Validate username
        if( empty(trim($_POST['username'])) ) {
            $username_err = 'Please enter a username';
        } else {
            //Prepare select statement
            $sql = 'SELECT id FROM users WHERE username = ?';

            if( $stmt = mysqli_prepare($link, $sql) ) {
                //Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, 's', $param_username);

                //Set parameters
                $param_username = trim($_POST['username']);

                //Attempt to exe the prepared statement
                if ( mysqli_stmt_execute($stmt) ) {
                    //store result
                    mysqli_stmt_store_result($stmt);

                    if ( mysqli_stmt_num_rows($stmt) == 1 ) {
                        $username_err = 'This user is already in use.';
                    } else {
                        $username = trim($_POST['username']);
                    }
                } else {
                    echo 'Something went wrong. Please try again later.';
                }
            }

            //Close statement
            mysqli_stmt_close($stmt);
        }
        //End validate username

        //Validate password
        if( empty(trim($_POST['password'])) ) {
            $password_err = 'Please enter a password.';
        } elseif ( strlen(trim($_POST['password'])) < 6 ) {
            $password_err = 'Password must have at least 6 characters.';
        } else {
            $password = trim($_POST['password']);
        }

        //Validate confirm password
        if( empty(trim($_POST['password'])) ) {
            $confirm_password_err = 'Please confirm password.';
        } else {
            $confirm_password = trim($_POST['confirm_password']);

            if ( empty($password_err) && ($password != $confirm_password) ) {
                $confirm_password_err = 'Password did not match.';
            }
        }

        //Check input errors before inserting in DB
        if( empty($username_err) && empty($password_err) && empty($confirm_password_err) ) {
            //Prepare insert statement
            $sql = 'INSERT INTO users (username, password) VALUES(?, ?)';

            if( $stmt = mysqli_prepare($link, $sql) ) {
                //Bind variables to prepared statement as parameters
                mysqli_stmt_bind_param($stmt, 'ss', $param_username, $param_password);
                //Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT);//Hashing the password
                //Attempt to exe the prepared statement
                if( mysqli_stmt_execute($stmt) ) {
                    //Redirect lo login page
                    header('location: login.php');
                } else {
                    echo 'Something went wrong. Please try again.';
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
                    <h2><em>Sign Up</em></h2>
                    <p class="fill">Please fill this form to create an account.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn" value="Submit">
                            <input type="reset" class="btn" value="Reset">
                        </div>
                        <p>Already have an account? <a href="login.php">Login here</a>.</p>
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