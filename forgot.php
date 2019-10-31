<?php
session_start();

echo($_SESSION['error']);

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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="boxwrapper">
        <div class="card" style="width: auto;">
            <div class="card-header"><a href="index.php" class="card-link">< Back</a></div>
            <div class="card-body">
                <h5 class="card-title">Login as Admin</h5>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input name="user_email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">This is the email you originally registered with.</small>
                    </div>
                    <?php
                        if(isset($_SESSION["error"])){
                            $error = $_SESSION["error"];
                            echo "<div class='alert alert-danger' role='alert'>$error</div>";
                        }elseif (isset($_POST['submit'])){
                            echo "<div class='alert alert-success' role='alert'>Reset email sent. Log in to your email to confirm password reset.</div>";
                        }
                    ?>
                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                </form>
            </div>
        </div>
    </div>


</body>
</html>

<?php

unset($_SESSION["error"]);
include('ConnectDataBase.php');

$user_email = $_POST["user_email"];

function generateEmailToken($email){
    $expFormat = mktime(
        date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
        );
    $expDate = date("Y-m-d H:i:s",$expFormat);
    $key = md5(2418*2+$email);
    $addKey = substr(md5(uniqid(rand(),1)),3,10);
    $key = $key . $addKey;
    $tokenDetails = array($email, $key, $expDate);

    return $tokenDetails;
}

function sendPasswordReminder($user_email, $conn){
    echo $user_email;
    $sql = "SELECT user_pass, user_email FROM user_accounts WHERE user_email='$user_email'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result); // Row array with fetched details
    echo $row['user_email'];
    var_dump(is_null($row['user_email']));
    if (is_null($row['user_email'])){

        $errorMessage = "Email not found.";
    }else{
        if ($row['user_email'] === $user_email) {
            $errorMessage = "Reset email sent. Check your inbox.";
            
            echo "Sent.";

            $tokenDetails = generateEmailToken($user_email);

            $sql = "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('".$tokenDetails[0]."', '".$tokenDetails[1]."', '".$tokenDetails[2]."');";
            mysqli_query($conn, $sql);

            $to = $row['user_email'];

            $subject = 'CompanyBase | Password Reset Link';

            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $url = "https://s5107296.bucomputing.uk/reset.php?key=";

            $message = '<html><body>';
            $message .= "<p>Hi User,</p>";
            $message .= "<p>This email was sent to you in response to your password reset request.</p>";
            $message .= "<p>Click this link to generate new password.</p>";
            $message .= "<p>" . $url . $tokenDetails[1] . "</p>";
            $message .= "<p>You can also visit this <a href='" . $url . "'>page</a> and enter this code " . $tokenDetails[1] . ".</p>";
            $message .= "<p>Thank you,</p>";
            $message .= "<p>CompanyBase Team</p>";
            $message .= "</body></html>";

            mail($to, $subject, $message, $headers);
        }
    }
    
    $_SESSION["error"] = $errorMessage;

    

}

sendPasswordReminder($user_email, $conn);

?>