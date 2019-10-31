<?php
session_start();

require './db.php';
$db = new db();

if ( !isset( $_SESSION['username'] ) ) {
    // Redirect them to the login page
    header("Location: index.php"); 
}

/*
$query = "SELECT * FROM company_list";
$result = mysql_query($query);

$_COMPANY_LIST = array();

$num = mysql_num_rows($results);
if ($num > 0) {
    while ($row = mysql_fetch_assoc($result)) {
        array_push($_COMPANY_LIST, $row);
    }
}

echo($_COMPANY_LIST);
*/

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

</head>

<body>

<div class="header">
    <div class="jumbotron text-center" id="headish">
        <h1 id="header-font">Dashboard</h1>
        <div class="search-body">
        <input class="search-bar" type="text" id="search-input" placeholder ="eg: 'intel' " onkeyup="searchFunction()">
        </div>
    </div>
</div>

<div class="main-body">

<!-- The Modal -->
<div id="edit-modal" class="modal-custom">
  <!-- Modal content -->
    <div class="card" style="width: 75%; height: 75%; margin: 7% auto;">
        <div class="card-header">
            Company Information
            <span class="close">&times;</span>
        </div>
        <div class="card-body" style="margin: 50px auto">
            <h5 class="card-title">Intel</h5>
            <p class="card-text">Intel Corporation is an American multinational corporation and technology company headquartered in Santa Clara, California.</p>
            <a href="#" class="btn btn-primary">Visit Website</a>
        </div>
        <div class="card-footer bg-primary border-primary">
            <button type="button bg-primary" class="btn btn-primary" id="close">Close</button>
        </div>
    </div>
</div>

<div id="add-modal" class="modal-custom">
  <!-- Modal content -->
    <div class="card" style="width: 75%; height: 75%; margin: 7% auto;">
        <div class="card-header">
            Add new company
            <span class="close">&times;</span>
        </div>
        <div class="card-body" style="margin: 10px;">
            <form method="POST" action="php_events/event_insertCompany.php">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" placeholder="Company Name" name="name">
                </div>
                <label for="contact">Contact Details</label>
                <div id="contact" class="form-group">
                    <input id="inputAddress" class="form-control" type="text" placeholder="Company Address" name="address">
                </div>
                <div class="form-group">
                    <input id="inputTel" class="form-control" type="text" placeholder="Company Telephone" name="tel">
                </div>
                <div class="form-group">
                    <input id="inputEmail" class="form-control" type="email" placeholder="Company Email" name="email">
                </div>
                <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <textarea class="form-control" rows="5" id="comment" style="resize: none;" maxlength="200" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

    <div id="company-block-row" class="row">

        <div id="add-comp" class="card border-primary col-mb-3" style="width: 18rem; height: 15rem;">
            <div class="card-body text-primary" style="height: 100%;">
                <h5 class="card-title">Add new company</h5>
                <img style="margin: auto;" width="50px" src="assets/add_icon.png">
            </div>
        </div>
        <?php
        $company_list = $db->getCompanies();
        
        foreach ($company_list as $company){
            $element = sprintf("<div id='card-comp%s' class='card border-primary col-mb-3' style='max-width: 18rem;'>
            <div class='card-body text-primary'>
                <h5 class='card-title'>%s</h5>
                <p class='card-text'>%s</p>
            </div>
            <div class='card-footer bg-primary border-primary'>
                <button type='button bg-primary' class='btn btn-primary' id='more-info'>More Info</button>
                <div id='comp%s-btn' class='edit-button float-right mt-2' ><strong>Edit</strong> <img width='25px' src='assets/edit_logo.png'></div>
            </div>
            </div>",$company['id'], $company['name'], $company['description'], $company['id']);
            echo($element);
        }
        ?>
        
        
<!--
    <div id="comp01" class="col-lg-2">
      <h3>Company Name</h3>
      <p>This company has no information.</p>
      <div id="comp01-btn" class="edit-button" ><strong>Edit</strong> <img width="25px" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Black_pencil.svg"></div>
    </div>
    <div id="comp02" class="col-lg-2">
    <h3>Company Name</h3>
      <p>This company has no information.</p>
      <div id="comp02-btn" class="edit-button"><strong>Edit</strong> <img width="25px" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Black_pencil.svg"></div>
    </div>
    <div id="comp03" class="col-lg-2">
      <h3>Company Name</h3>
      <p>This company has no information.</p>
      <div id="comp03-btn" class="edit-button"><strong>Edit</strong> <img width="25px" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Black_pencil.svg"></div>
    </div>
    <div id="comp04" class="col-lg-2">
      <h3>Company Name</h3>
      <p>This company has no information.</p>
      <div id="comp04-btn" class="edit-button"><strong>Edit</strong> <img width="25px" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Black_pencil.svg"></div>
    </div>
    <div id="comp05" class="col-lg-2">
    <h3>Company Name</h3>
      <p>This company has no information.</p>
      <div id="comp05-btn" class="edit-button"><strong>Edit</strong> <img width="25px" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Black_pencil.svg"></div>
    </div>
-->
  </div>

</div>

<div class="footer">
</div>

</body>
</html>

<?php
    unset($_SESSION["error"]);
?>