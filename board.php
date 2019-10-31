<?php
session_start();

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

    <div id="company-block-row" class="row">
        <div id="comp01" class="card border-primary col-mb-3" style="max-width: 18rem;">
            <div class="card-body text-primary">
                <h5 class="card-title">Intel</h5>
                <p class="card-text">Intel Corporation is an American multinational corporation and technology company based in Silicon Valley. </p>
            </div>
                <div class="card-footer bg-primary border-primary">
                    <button type="button bg-primary" class="btn btn-primary" id="more-info">More Info</button>
                    <div id="comp01-btn" class="edit-button float-right mt-2" ><strong>Edit</strong> <img width="25px" src="assets/edit_logo.png"></div>
                </div>
        </div>

        <div id="comp02" class="card border-primary col-mb-3" style="max-width: 18rem;">
            <div class="card-body text-primary">
                <h5 class="card-title">IBM</h5>
                <p class="card-text">The International Business Machines Corporation is an American multinational information technology company.</p>
            </div>
                <div class="card-footer bg-primary border-primary">
                    <button type="button bg-primary" class="btn btn-primary" id="more-info">More Info</button>
                    <div id="comp02-btn" class="edit-button float-right mt-2" ><strong>Edit</strong> <img width="25px" src="assets/edit_logo.png"></div>
                </div>
        </div>
        <div id="comp03" class="card border-primary col-mb-3" style="max-width: 18rem;">
            <div class="card-body text-primary">
                <h5 class="card-title">Apple</h5>
                <p class="card-text">Apple Inc. is an American multinational technology company headquartered in Cupertino that sells consumer electronics</p>
            </div>
                <div class="card-footer bg-primary border-primary">
                    <button type="button bg-primary" class="btn btn-primary" id="more-info">More Info</button>
                    <div id="comp03-btn" class="edit-button float-right mt-2" ><strong>Edit</strong> <img width="25px" src="assets/edit_logo.png"></div>
                </div>
        </div>
        <div id="comp04" class="card border-primary col-mb-3" style="max-width: 18rem;">
            <div class="card-body text-primary">
                <h5 class="card-title">Microsoft</h5>
                <p class="card-text">Microsoft Corporation is an American multinational technology company with headquarters in Redmond, Washington.</p>
            </div>
                <div class="card-footer bg-primary border-primary">
                    <button type="button bg-primary" class="btn btn-primary" id="more-info">More Info</button>
                    <div id="comp04-btn" class="edit-button float-right mt-2" ><strong>Edit</strong> <img width="25px" src="assets/edit_logo.png"></div>
                </div>
        </div>



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