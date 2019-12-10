<?php
session_start();

require './db.php';
$db = new db();
$company_list = $db->getCompanies(
  count($_GET),
  $_GET['search'],
  $_GET['order'],
  $_GET['type'],
  $_GET['startrange'],
  $_GET['endrange']
);

$company_id = str_replace("card-comp","",$_GET['id']);

if ( !isset( $_SESSION['username'] ) ) {
    // Redirect them to the login page
    header("Location: index.php");
}elseif ( !isset( $_GET['id'])){
    header("Location: board.php");
}

$found = True;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>

    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- <script type="text/javascript" src="script.js"></script> -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>

<div class="header">
<div class="jumbotron text-center p-3" id="headish">
        <form method="POST" class="loginform" action="board.php">
            <button class="btn text-uppercase font-weight-bold" id="header-font">Company details</button>
        </form>
       </div>
        </div>
    </div>
</div>

<div class="main-body">

    <div class="card" style="width: 75%; height: 75%; margin: 2% auto;">
        <div class="card-body" style="margin: 10px;">
                <?php 
                    foreach ($company_list as $company){
                        if ($company['id'] == $company_id){
                            $found = True;
                            break;
                        }else{
                            $found = False;
                        }
                }

                if ($found){
                    $element = sprintf("
                        <form method='POST' action='php_events/event_editCompany.php?id=%s'>
                            <div class='form-group'>
                            <input value='%s' class='form-control form-control-lg' type='text' placeholder='Company Name' name='name' required>
                            </div>
                            <div class='input-group mb-3'>
                            <div class='input-group-prepend'>
                                <label class='input-group-text' for='inputGroupSelectType'>Type</label>
                            </div>
                            <select selected='%s' name='type' class='custom-select' id='inputGroupSelectType'>
                                <option value='Software Engineering'>Software Engineering</option>
                                <option value='Computing'>Computing</option>
                                <option value='Data'>Data</option>
                            </select>
                            </div>
                            <label for='contact'>Contact Details</label>
                            <div id='contact' class='form-group'>
                                <input value='%s' id='inputAddress' class='form-control' type='text' placeholder='Company Address' name='address'>
                            </div>
                            <div class='form-group'>
                                <input value='%s' id='inputTel' class='form-control' type='text' placeholder='Company Telephone - 11 digits long' name='tel'
                                pattern='[0-9]{3}[0-9]{4}[0-9]{4}' required>
                            </div>
                            <div class='form-group'>
                                <input value='%s' id='inputEmail' class='form-control' type='email' placeholder='Company Email' name='email'>
                            </div>
                            <div class='form-group'>
                                <label for='inputDescription'>Description</label>
                                <textarea class='form-control' rows='5' id='comment' style='resize: none;' maxlength='200' name='description'>%s</textarea>
                            </div>
                            <div class='row' style='text-decoration: none important!;'>
                                <div class='col'>
                                    <button type='submit' name = 'submit' class='btn btn-danger'><a style='text-decoration: none !important; color: white !important;' href='php_events/event_deleteCompany.php?id=%s''>Delete Company</a></button>
                                </div>
                                <div class='col ml-auto'>
                                    <div class='float-right'>
                                        <button type='submit' name = 'submit' class='btn btn-outline-primary'><a href='board.php'>Cancel</a></button>
                                        <button type='submit' name = 'submit' class='btn btn-primary'>Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        ", $_GET['id'], $company['name'], $company['type'], $company['address'], $company['tel'], $company['email'], $company['description'], $_GET['id']);
                        echo($element);
                }else{
                    header("Location: board.php");
                }

                ?>
        </div>
    </div>

</div>

<div class="footer" style="margin-top:80px" >
        <!-- Footer -->
            <div class="card-footer bg-primary border-primary fixed-bottom" style="margin-top:10px;">
                <form method="post" action="logout.php">
                <button type="submit" class="btn btn-primary text-uppercase font-weight-bold">Log out</button>
                </form>
            </div>
        </div>

</body>
</html>

<?php
    unset($_SESSION["error"]);
?>
