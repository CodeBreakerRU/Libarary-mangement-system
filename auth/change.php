<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "../connection.php";

$new_pass = $confirm_pword = $oldpword = "";
$new_pword_err = $confirm_pword_err = $old_pword_err ="";

$username = htmlspecialchars($_SESSION["username"]);

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    if (empty(trim($_POST["new_pass"])))
    {
        $new_pword_err = "Please enter the new password.";
    }
    elseif (strlen(trim($_POST["new_pass"])) < 6)
    {
        $new_pword_err = "Password must have at least 6 characters.";
    }
    else
    {
        $new_pass = trim($_POST["new_pass"]);
    }

    if (empty(trim($_POST["confirm_password"])))
    {
        $confirm_pword_err = "Please confirm the password.";
    }
    else
    {
        $confirm_pword = trim($_POST["confirm_password"]);

        if (empty($new_pword_err) && ($new_pass != $confirm_pword))
        {
            $confirm_pword_err = "Password did not match.";
        }
    }




    if(empty($new_pword_err) && empty($confirm_pword_err))
    {
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "si", $param_pword, $param_id);

            $param_pword = password_hash($new_pass, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt))
            {
                session_destroy();
                header("location: login.php");
                exit();
            }
            else
            {
                echo " Error :/";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);


}
?>

<!DOCTYPE html>
<?php include_once("main-menu.html"); ?>
<head>
    <title> Change Password </title>

    <link rel="stylesheet" type="text/css" href="../new/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../new/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../new/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../new/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../new/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="../new/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="../new/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../new/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="../new/css/util.css">
    <link rel="stylesheet" type="text/css" href="../new/css/main.css">


</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
            <form class="login100-form validate-form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<span class="login100-form-title p-b-33">
                        Change password
					</span>
                <div class="wrap-input100 rs1 ">
                    <input class="input100" type="text" name="uname" id="uname"  value="<?php echo htmlspecialchars($_SESSION["username"]); ?>" disabled>
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>
                <br />
<!--                <div class="wrap-input100 rs1 validate-input" data-validate="Old password">-->
<!--                    <input class="input100" type="password" name="oldpword" id="oldpword" placeholder="Old Password" value="--><?php //echo $oldpword; ?><!--">-->
<!--                    <span class="help-block">--><?php //echo $old_pword_err; ?><!--</span>-->
<!---->
<!--                    <span class="focus-input100-1"></span>-->
<!--                    <span class="focus-input100-2"></span>-->
<!--                </div>-->
<!--                <br/>-->
                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required" >
                    <input class="input100" type="password" name="new_pass" id="new_pass" placeholder="New Password" value="<?php echo $new_pass; ?>">
                    <span class="help-block"><?php echo $new_pword_err; ?></span>
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>
                <br/>
                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_pword; ?>">
                    <span class="help-block"><?php echo $confirm_pword_err; ?></span>
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>

                <div class="container-login100-form-btn m-t-20">
                    <button class="login100-form-btn" type="submit" value="Login">
                        Sign in
                    </button>
                </div>
                <br />
                <div class="text-center">
                    Don't have an account ?
                    <a href="register.php" class="txt2 hov1">
                        Sign up :)
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../new/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../new/vendor/animsition/js/animsition.min.js"></script>
<script src="../new/vendor/bootstrap/js/popper.js"></script>
<script src="../new/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../new/vendor/select2/select2.min.js"></script>
<script src="../new/vendor/daterangepicker/moment.min.js"></script>
<script src="../new/vendor/daterangepicker/daterangepicker.js"></script>
<script src="../new/vendor/countdowntime/countdowntime.js"></script>
<script src="../new/js/main.js"></script>

</body>
</html>
<br />
<?php include_once("../main-footer.html"); ?>

