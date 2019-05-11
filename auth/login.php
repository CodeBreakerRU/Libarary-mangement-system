<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: profile.php");
    exit;
}

require_once "../connection.php";

$username = $pword = "";
$username_error = $pword_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $username = trim($_POST["username"]);
    $pword = trim($_POST["password"]);


    if(empty($username_error) && empty($pword_error))
    {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if(mysqli_stmt_fetch($stmt))
                    {

                        if(password_verify($pword, $hashed_password))
                        {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            if ($username == admin)
                            {
                                header("location: ../admin");
                            }
                            else{

                                header("location: profile.php");

                            }
                        }
                        else
                        {
                            $pword_error = "Wrong password";
                        }
                    }
                }
                else
                {
                    $username_error = "No user account found";
                }
            }

            else

            {
                echo " error :/";
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
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                        Login
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Enter your ID number">
                    <input class="input100" type="text" name="username" placeholder="ID number" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_error; ?></span>
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>
                <br/>

                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required" >
                    <input class="input100" type="password" name="password" placeholder="Password" value="<?php echo $pword; ?>">
                    <span class="help-block"><?php echo $pword_error; ?></span>
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>
                <br/>

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
