<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="indexStyle.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div class="the buttons" style= "height:100%;">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="margin:auto;">
            <div id="errorContainer" class="text-center">
                    <?php
                    //creates session error and echos it if occured
                        if(isset($_SESSION["error"])){
                            $error = $_SESSION["error"];
                            echo "<div class='alert alert-danger' role='alert'>$error</div>";
                            unset($_SESSION['error']);
                        }
                    ?>
            </div>
            <button class="btn bg-white btn-outline-primary text-uppercase font-weight-bold w-100 collapsible" type="button">LOG IN AS ADMIN</button>
            <div class="content rounded " style="width: 99.5%; margin: auto; background-color: white;">
                <form method="POST" class="loginform" action="./php_events/event_login.php">
                        <div class="form-group" style="padding-top: 20px;" >
                            <input type="text" name="username" class="form-control text-center" id="inputUsername" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control text-center" id="inputPassword" style="" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary mb-3 text-uppercase font-weight-bold text-center" style="width: 100%;" >Log In</button>
                </form>  
            </div>
            <form class="" action="board-guest.php" method="post">
                <button type="submit" class="btn bg-white btn-outline-primary text-uppercase font-weight-bold w-100" id="guestbtn" type="button">CONTINUE AS GUEST</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>
</div>
    <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;
    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function expandContainer() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
        content.style.maxHeight = null;
        } else {
        content.style.maxHeight = content.scrollHeight + "px";
        }
    });
    }
    </script>

</body>
</html>
