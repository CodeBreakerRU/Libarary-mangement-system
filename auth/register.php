<?php
require_once "../connection.php";
$username = $pword = $confirm_pword = "";
$name = $address = $phone ="";

$username_error = $pword_error = $confirm_pword_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    if(empty(trim($_POST["username"])))
    {
        $username_error = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_error = "Username is already taken";
                } else

                {
                    $username = trim($_POST["username"]);
                }

            } else

            {
                echo "error :/";
            }
        }

        mysqli_stmt_close($stmt);
    }

    if(empty(trim($_POST["password"])))

    {
        $pword_error = "Please enter a password.";
    }

    elseif(strlen(trim($_POST["password"])) < 6)

    {
        $pword_error = "Password should be greater than 6 characters !!";
    }
    else
    {
        $pword = trim($_POST["password"]);

    }

    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_pword_error = "Please confirm password.";
    }
    else

   {
        $confirm_pword = trim($_POST["confirm_password"]);
        if(empty($pword_error) && ($pword != $confirm_pword))
        {
            $confirm_pword_error = "Password did not match.";
        }
    }

    if(empty($username_err) && empty($pword_err) && empty($confirm_pword_error))
    {
        // prepared statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($conn, $sql))
        {
            $name = trim($_POST["name"]);
            $address = trim($_POST["address"]);
            $phone = trim($_POST["phone"]);

            // assign variables as parameters

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_pword);


            $param_username = $username;
            $param_pword = password_hash($pword, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt))
            {
                mysqli_query ($conn, "INSERT INTO members (username,name,address,phone) VALUES ('$username','$name','$address','$phone')");

               header("location: login.php");
            }
            else

            {
                echo "error :/";
            }
        }
        mysqli_stmt_close($stmt);
    }
    // close connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<?php include_once("main-menu.html"); ?>
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../new/images/icons/favicon.ico"/>
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
						Create an account
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter your ID number">
						<input class="input100" type="text" name="username" placeholder="ID Number" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_error; ?></span>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<br/>
					<div class="wrap-input100 rs1 validate-input" data-validate="Enter your name">
						<input class="input100" type="text" name="name" id="name" placeholder="Full name" value="<?php echo $name; ?>">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					<br/>

                    <div class="wrap-input100 rs1 validate-input" data-validate="Enter your address">
                        <input class="input100" type="text" name="address" id="address" placeholder="Address" value="<?php echo $address; ?>">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>
                    <br/>
                    <div class="wrap-input100 rs1 validate-input" data-validate="Enter your Phone">
                        <input class="input100" type="text" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>">
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
					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_pword; ?>">
                        <span class="help-block"><?php echo $confirm_pword_error; ?></span>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn" type="submit" value="Register">
							Sign up
						</button>
					</div>
                <br />
					<div class="text-center">
                        Already have an account ?
						<a href="login.php" class="txt2 hov1">
							Sign in :)
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
 <br />  <br />
<?php include_once("../main-footer.html"); ?>
</html>
