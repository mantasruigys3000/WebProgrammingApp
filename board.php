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


    var_dump($_GET["type"]);

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
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    var company_list = <?php echo json_encode($company_list); ?>;
    console.log(company_list);
    </script>
</head>

<body>
    <div class="header">
        <div class="jumbotron text-center p-3" id="headish">
        <form method="POST" class="loginform" action="board.php">
            <button class="btn text-uppercase font-weight-bold" id="header-font">Dashboard</button>
        </form>
            <form style="margin: auto; width: 80%;" action="board.php" method="GET">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="button input-group-text outline-primary " type="button" id="basic-addon3" onclick="toggleAdvSearch()" > Adv. Search </button>
                    </div>
                    <input type="text" class="form-control text-center" placeholder="Try searching for a company!" name="search">
                    <div class="input-group-append">
                        <button class="input-group-text outline-primary" type="text" >Search</button>
                    </div>
                </div>
                
                <div class="card mt-3 collapse" id="collapse1" style="display: none">
                    <div class="card-header">
                        Advanced Search Settings
                    </div>
                    <div class="card-body p-3">
                        <div>SORT BY</div>
                        <div class="input-group" style="width: 100%;" >
                            <select class="custom-select" id="inputSelectSearchSort" name="order">
                                <option selected>A-Z</option>
                                <option value="Z-A">Z-A</option>
                                <option value="Newest">Newest</option>
                                <option value="Oldest">Oldest</option>
                            </select>
                        </div>
                        <div style="padding-top: 1.1%;">CATEGORY</div>
                        <div class="input-group" style="width: 100%;" >
                            <select class="custom-select" id="inputSelectSearchFilter" name="type">
                                <option id="se" selected>Software Engineering</option>
                                <option value="Computing">Computing</option>
                                <option value="Data">Data</option>
                                <option value="All">All</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
    </div>

    <script>
        function toggleAdvSearch(){
            var x = document.getElementById("collapse1");
            if (x.style.display === "none") {
                x.style.display = "block";
            } 
            else {
                x.style.display = "none";
            }
            return false();
        }
    </script>

    <div class="main-body">
        <div id="edit-modal" class="modal-custom">
        <!-- Modal content -->
            <div class="card" style="width: 75%; height: 75%; margin: 7% auto;">
                <div class="card-header ">
                    Company Information
                    <span class="close">&times;</span>
                </div>
                <div class="card-body " style="margin: auto">
                    <div class="row">
                        <div class="col-md-4" style="margin-left: 2.5%;">
                            <h5 class="text-uppercase font-weight-bold text-center border-bottom" style="width: 100%; margin:auto; font-size: 25px; margin-top:35%;">CONTACT INFORMATION</h5>
                            <h5 class="text-uppercase font-weight-bold text-center" style="width: 90%; margin:auto; margin-top: 8%;">company address</h5>
                            <p id="modal-company-address" class="text-center border-bottom" style="width: 90%; margin:auto;">yeah</p>
                            <h5 class="text-uppercase font-weight-bold text-center" style="width: 90%; margin:auto; margin-top: 10%;">company telephone</h5>
                            <p id="modal-company-tel" class="text-center border-bottom" style="width: 90%; margin:auto;">yeah</p>
                            <h5 class="text-uppercase font-weight-bold text-center" style="width: 90%; margin:auto; margin-top: 10%;">company email</h5>
                            <p id="modal-company-email" class="text-center border-bottom" style="width: 90%; margin:auto;">yeah</p>
                        </div>
                        <div id="black-bar" style=" width: 1px; background-color:#e6e6e6; margin-top: 3%; margin-left: 5%;"></div>
                        <div class="col-md-7">
                    <h5 id="modal-company-name" class="card-title text-uppercase font-weight-bold text-center border-bottom" style="width: 80%; margin:auto;">Intel</h5>
                    <p id="modal-company-desc" class="card-text border-bottom p-4">Intel Corporation is an American multinational corporation and technology company headquartered in Santa Clara, California.</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary border-primary">
                    <div class="row">
                        <div class="col">
                            <button type="button bg-primary" class="btn btn-primary text-uppercase font-weight-bold" id="close">Close</button>
                        </div>
                        <div class="col ml-auto">
                            <div class="float-right">
                            <form action="" method="POST" id="edit-button-form">
                                <button type="button bg-primary" class="btn btn-primary text-uppercase font-weight-bold float-right"id="edit-button">Edit Infomation</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="add-modal" class="modal-custom">
        <!-- Modal content -->
            <div class="card" style="width: 75%; height: auto; margin: 7% auto;">
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
                            <label class="input-group-text" for="inputSelectType">Type</label>
                        </div>
                        <select class="custom-select" name="type" id="inputSelectType" require>
                            <option selected>Choose...</option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Computing">Computing</option>
                            <option value="Data">Data</option>
                        </select>
                        </div>
                        <label for="contact">Contact Details</label>
                        <div id="contact" class="form-group">
                            <input id="inputAddress" class="form-control" type="text" placeholder="Company Address" name="address">
                        </div>
                        <div class="form-group">
                            <input id="inputTel" class="form-control" type="text" placeholder="Company Telephone - 11 digits long" name="tel"
                            pattern="[0-9]{3}[0-9]{4}[0-9]{4}" required>
                        </div>
                        <div class="form-group">
                            <input id="inputEmail" class="form-control" type="email" placeholder="Company Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Description</label>
                            <textarea class="form-control" rows="5" id="comment" style="resize: none;" maxlength="1000" name="description"></textarea>
                        </div>
                        <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="card-footer bg-primary border-primary">
                    <button type="button bg-primary" class="btn btn-primary" id="close">Close</button>
                </div>
            </div>
        </div>

        <div class= "container-fluid mt-4" >
        <!-- Card Generator + Add Card -->
            <div class= "row justify-content-center" id="company-block-row">
            <div class= 'col-auto mb-3'>
                    <div class= 'card border-primary' style='width: 18rem; min-height:14.5rem;' id='add-comp'>
                        <div class= 'card-body'>
                            <h5 class='card-title text-primary text-center '> Add New Company</h5>
                            <img style='  display: block; margin-left: auto; margin-right: auto; width: 40%; margin-top: 32.5px;'  width='75px' src='assets/add_icon.png'>
                        </div>
                    </div>
                </div>
                <?php

                    foreach ($company_list as $company)
                    {
                        $element = sprintf("
                        <div class='col-auto mb-3'>
                            <div class='card border-primary' style='width: 18rem; min-height:13rem;' id='card-comp%s'>
                                <div class='card-body'>
                                    <h5 id= 'card-title' class='card-title text-primary text-center'>%s</h5>
                                    <h6 class='card-subtitle mb-2 text-muted text-center'>%s</h6>
                                    <p class='card-text text-center' style='height:4.5rem; overflow: hidden;' id='description'>%s</p>
                                </div>
                                <div class= 'card-bottom w-100 p-3 bg-primary' id='bottom'>
                                        <button type='button' class= 'btn btn-primary text-white text-uppercase font-weight-bold' style='width: 16rem;' id='more-info'>View & Edit</button>
                                </div>
                            </div>
                            </div>"
                    ,$company['id'], $company['name'], $company['type'], $company['description'], $company['id']);
                        echo($element);
                    }
                ?>
        </div>

        <div class="footer" style="margin-top:80px" >
        <!-- Footer -->
            <div class="card-footer bg-primary border-primary fixed-bottom" style="margin-top:10px;">
                <form method="post" action="logout.php">
                <button type="submit" class="btn btn-primary text-uppercase font-weight-bold">Log out</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
    unset($_SESSION["error"]);
?>
