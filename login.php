<?php
session_start();

if ( isset( $_SESSION['username'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Landing Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="boxwrapper">
        <div class="box-header"><h1>Admin Portal</h1></div>
        <div class="loginbox">
            <form method="POST" class="loginform" action="AuthUser.php">
                <h1>Username</h1>
                <input name="username" class="username-input" type="text"></br>
                <h1>Password</h1>
                <input name="password" class="password-input" type="password"></br>
                <a href="" target="_blank">Forgot your password?</a></br>
                    <?php
                        if(isset($_SESSION["error"])){
                            $error = $_SESSION["error"];
                            echo "</br><p class='error'>$error</p>";
                        }
                    ?>
                <button class="login-button" type="submit">Log In</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    unset($_SESSION["error"]);
?>
