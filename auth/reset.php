<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "../connection.php";

$new_pass = $confirm_pass = "";
$new_pword_err = $confirm_pword_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["new_pass"]))){

        $new_pword_err = "Please enter the new password.";

    }
    elseif
    (strlen(trim($_POST["new_pass"])) < 6)
    {
        $new_pword_err = "Password must have atleast 6 characters.";
    } else{
        $new_pass= trim($_POST["new_pass"]);
    }

    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_pword_err = "Please confirm the password.";
    }
    else

     {
        $confirm_pword = trim($_POST["confirm_password"]);
        if(empty($new_pword_err) && ($new_pass != $confirm_pword))
        {
            $confirm_pword_err = "Password did not match.";
        }
    }

    if(empty($new_pword_err) && empty($confirm_pword_err)){

        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_pword, $param_id);

            $param_pword = password_hash($new_pass, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo " Error :/";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<head>
    <title> Change Password </title>
    <?php include_once("../main-menu.html"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-85 p-b-20">
            <form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<span class="login100-form-title p-b-70">
Change Password
                    </span>
                <span class="login100-form-avatar">
						<img src="images/reset.png" alt="AVATAR">
					</span>

                <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "New Password">
                    <input class="input100" type="password" name="new_pass" id="new_pass" value="<?php echo $new_pass; ?>">
                    <span class="focus-input100" data-placeholder="New Password"></span>
                    <span class="help-block"><?php echo $new_pword_err; ?></span>
                </div>

                <div class="wrap-input100 validate-input m-b-50" data-validate="Re type Password">
                    <input class="input100" type="password" name="confirm_password" id="confirm_password">
                    <span class="focus-input100" data-placeholder="Retype your new Password"></span>
                    <span class="help-block"><?php echo $confirm_pword_err; ?></span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit" value="Login">
                        Reset
                    </button>
                </div>

                <ul class="login-more p-t-190">
                    <li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

                        <a href="#" class="txt2">
                            Username / Password?
                        </a>
                    </li>

                    <li>
							<span class="txt1">
								Already have an account?
							</span>

                        <a href="login.php" class="txt2">
                            Sign In
                        </a>
                    </li>
                </ul>

            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/animsition/js/animsition.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<script src="vendor/countdowntime/countdowntime.js"></script>
<script src="js/main.js"></script>


<br/>   <br/>  <br/>
</body>
<?php include_once("../main-footer.html"); ?>


</html>
