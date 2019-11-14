<?php
session_start();

require './db.php';
$db = new db();
$company_list = $db->getCompanies();

if ( !isset( $_SESSION['username'] ) ) {
    // Redirect them to the login page
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>

    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type="text/javascript" src="script.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    var company_list = <?php echo json_encode($company_list); ?>;
    console.log(company_list);
    </script>

</head>

<body>

<div class="header">
    <div class="jumbotron text-center" id="headish">
        <h1 id="header-font">Company Details</h1>
          <?php print $_SESSION['recordAdded']?>
       </div>
        </div>
    </div>
</div>

<div class="main-body">

  <!-- Modal content -->
    <div class="card" style="width: 75%; height: 75%; margin: 7% auto;">
        <div class="card-header">
            Add new company
            <span class="close">&times;</span>
        </div>
        <div class="card-body" style="margin: 10px;">
            <form method="POST" action="php_events/event_insertCompany.php">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" placeholder="Company Name" name="name" required>
                </div>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelectType">Type</label>
                </div>
                <select class="custom-select" id="inputGroupSelectType">
                    <option selected>Choose...</option>
                    <option value="software engineering">Software Engineering</option>
                    <option value="computing">Computing</option>
                    <option value="data">Data</option>
                </select>
                </div>
                <label for="contact">Contact Details</label>
                <div id="contact" class="form-group">
                    <input id="inputAddress" class="form-control" type="text" placeholder="Company Address" name="address">
                </div>
                <div class="form-group">
                    <input id="inputTel" class="form-control" type="tex" placeholder="Company Telephone - 11 digits long" name="tel"
                    pattern="[0-9]{3}[0-9]{4}[0-9]{4}" required>
                </div>
                <div class="form-group">
                    <input id="inputEmail" class="form-control" type="email" placeholder="Company Email" name="email">
                </div>
                <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <textarea class="form-control" rows="5" id="comment" style="resize: none;" maxlength="200" name="description"></textarea>
                </div>
                <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="card-footer bg-primary border-primary">
            <button type="button bg-primary" class="btn btn-primary" id="close">Close</button>
        </div>
    </div>

</div>

<div class="footer">
    <div class="card-footer bg-primary border-primary fixed-bottom">
        <form method="post" action="logout.php">
          <button type="submit" class="btn btn-primary">Log out</button>
        </form>
    </div>
    
</div>

</body>
</html>

<?php
    unset($_SESSION["error"]);
?>
