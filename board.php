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
            <h5 id="modal-company-name" class="card-title">Intel</h5>
            <p id="modal-company-desc" class="card-text">Intel Corporation is an American multinational corporation and technology company headquartered in Santa Clara, California.</p>
            <a id="modal-company-email" href="#" class="btn btn-primary">Email Link</a>
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
        <div class="card-footer bg-primary border-primary">
            <button type="button bg-primary" class="btn btn-primary" id="close">Close</button>
        </div>
    </div>
</div>

<div class= "container-fluid mt-4" >
    <div class= "row justify-content-center" id="company-block-row">
    <div class= 'col-auto mb-3'>
            <div class= 'card border-primary' style='width: 18rem; min-height:15rem;' id='add-comp'>
                <div class= 'card-body'>
                    <h5 class='card-title text-primary text-center'> Add New Company</h5>
                    <img style='margin: auto;'  width='75px' src='assets/add_icon.png'>
                </div>
            </div>
        </div>
        <?php
            $company_list = $db->getCompanies();

            foreach ($company_list as $company)
            {
                $element = sprintf("
                <div class='col-auto mb-3'>
                    <div class='card border-primary' style='width: 18rem; min-height:13rem;' id='card-comp%s'>
                        <div class='card-body'>
                            <h5 id= 'card-title' class='card-title text-primary text-center'>%s</h5>
                            <h6 class='card-subtitle mb-2 text-muted text-center'>Software Engineering</h6>
                            <p class='card-text text-center' style='height:4.5rem; overflow: hidden;' id='description'>%s</p>
                        </div>
                        <div class= 'card-bottom w-100 p-3 bg-primary' id='bottom'>
                                <button type='button bg-primary' class= 'btn btn-primary border-white' id='more-info'>More Info</button>
                        </div>
                    </div>
                    </div>"
            ,$company['id'], $company['name'], $company['description'], $company['id']);
                echo($element);
            }
        ?>
  </div>
  </div>

</div>

<div class="footer">
</div>

</body>
</html>

<?php
    unset($_SESSION["error"]);
?>