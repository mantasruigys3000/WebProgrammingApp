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
    <title>Reset Password</title>
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
                <h5 class="card-title">Reset Password</h5>
                
                    <?php
                        if(!isset($_GET["key"])){
                            $error = $_SESSION["error"];
                            echo "<form method='POST' action=''>
                                    <div class='form-group'>
                                        <label for='keyInput'>Key</label>
                                        <input name='reset_key' type='text' class='form-control' id='keyInput' aria-describedby='keyHelp' placeholder='Enter key token'>
                                        <small id='keyHelp' class='form-text text-muted'>This is the key sent to your email.</small>
                                    </div>
                                    <button type='submit' class='btn btn-primary'>Send Reset Link</button>
                                </form>";
                        }else{
                            generateNewPassword();
                            echo "<div class='alert alert-success' role='alert'>Reset confirmed. The new password was sent to your email.</div>";
                        }
                    ?>
                    
            </div>
        </div>
    </div>


</body>
</html>

<?php
    unset($_SESSION["error"]);
?>

<?php

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

    if (is_null($row['user_email'])){
        $errorMessage = "Email not found.";
    }else{
        if ($row['user_email'] === $user_email) {
            $errorMessage = "Reset email sent. Check your inbox.";
            
            echo "Sent.";

            $tokenDetails = generateEmailToken($user_email);

            $sql = "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('".$tokenDetails[0]."', '".$tokenDetails[1]."', '".$tokenDetails[2]."');";
            mysqli_query($conn, $sql);
    
            $msg = "Your password is " . $row['user_pass'];
            $msg = wordwrap($msg,70);
            mail($row['user_email'],"Your Password Reminder",$msg);
        }
    }
    
    $_SESSION["error"] = $errorMessage;

    

}

sendPasswordReminder($user_email, $conn);

?>