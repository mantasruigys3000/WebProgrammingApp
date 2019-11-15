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
    <!-- <script type="text/javascript" src="script.js"></script> -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    var company_list = <?php echo json_encode($company_list); ?>;
    var company_id = <?php echo json_encode($_GET['id']); ?>;

    function stickyFormEditCompany(company_id){

        // Declaring variables that hold the elements
        input_company_name_element = document.getElementsByName("name");
        input_company_type_element = document.getElementsByName("type");
        input_company_address_element = document.getElementsByName("address");
        input_company_tel_element = document.getElementsByName("tel");
        input_company_email_element = document.getElementsByName("email");
        input_company_desc_element = document.getElementsByName("description");

        // Convert string id to number for iterative purposes
        company_id = company_id.replace("card-comp", '');
        console.log(company_id);
        for (company in company_list){
            if (company_id === company_list[company]['id']){
                // Declaring variables that hold company information
                input_company_name = company_list[company]['name'];
                input_company_type = company_list[company]['type'];
                input_company_address = company_list[company]['address'];
                input_company_tel = company_list[company]['tel'];
                input_company_email = company_list[company]['email'];
                input_company_desc = company_list[company]['description'];
            }
        }

        console.log(input_company_type);

        // Changing the contents of the element within the modal
        input_company_name_element[0].value = input_company_name;
        input_company_type_element[0].value = input_company_type;
        input_company_address_element[0].value = input_company_address;
        input_company_tel_element[0].value = input_company_tel;
        input_company_email_element[0].value = input_company_email;
        input_company_desc_element[0].value = input_company_desc;
    }

    if( document.readyState !== 'loading' ) {
        stickyFormEditCompany(company_id);

    } else {
        document.addEventListener('DOMContentLoaded', function () {
            stickyFormEditCompany(company_id);
        });
    };

    console.log(company_id);
    </script>

</head>

<body>

<div class="header">
    <div class="jumbotron text-center p-3" style="height: 100px;" id="headish">
        <h1 class="display-4" id="header-font">Company Details</h1>

       </div>
        </div>
    </div>
</div>

<div class="main-body">

  <!-- Modal content -->
    <div class="card" style="width: 75%; height: 75%; margin: 2% auto;">
        <div class="card-body" style="margin: 10px;">
            <form method="POST" action="php_events/event_insertCompany.php">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" placeholder="Company Name" name="name" required>
                </div>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelectType">Type</label>
                </div>
                <select name="type" class="custom-select" id="inputGroupSelectType">
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
                <div class="row" style="text-decoration: none important!;">
                    <div class="col">
                        <button type="submit" name = "submit" class="btn btn-danger"><a href="php_events/event_deleteCompany.php">Delete Company</a></button>
                    </div>
                    <div class="col ml-auto">
                        <div class="float-right">
                            <button type="submit" name = "submit" class="btn btn-outline-primary"><a href="board.php">Cancel</a></button>
                            <button type="submit" name = "submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<div class="footer">
    <div class="card-footer bg-primary border-primary">
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
