<?php
session_start();

if ( isset( $_SESSION['username'] )) {
    // Redirect them to the login page
    header("Location: ./board.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Landing Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <script src="script.js"></script>
    
    <div class="boxwrapper">

    <div class="card" style="width: auto;">
    <div class="card-header"><a href="" class="card-link">< Back</a></div>
  <div class="card-body">
    <h5 class="card-title">Login as Admin</h5>
    <form method="POST" class="loginform" action="./php_events/event_login.php">
            <div class="form-group">
                <label for="inputUsername">Username</label>
                <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
            <a href="forgot.php" class="card-link">Forgot your password?</a></br>
            <button type="submit" class="btn btn-primary mt-2">Log In</button>
            <?php
                        if(isset($_SESSION["error"])){
                            $error = $_SESSION["error"];
                            echo "<div class='alert alert-danger' role='alert'>$error</div>";
                        }
            ?>
        </form>
  </div>
</div>
        
            <!--
            <form method="POST" class="loginform" action="AuthUser.php">
                <h1>Username</h1>
                <input name="username" class="username-input" type="text"></br>
                <h1>Password</h1>
                <input name="password" class="password-input" type="password"></br>
                <a href="forgot.php" target="">Forgot your password?</a></br>
                    
                <button class="login-button" type="submit">Log In</button>
            </form>
            -->
    </div>


</body>
</html>

<?php
    unset($_SESSION["error"]);
?>