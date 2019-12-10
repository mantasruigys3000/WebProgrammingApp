function initialiseCode(){
    
    // Store modals in a variable
    var modal = document.getElementsByClassName("modal-custom");

    // Get the <span> elements that closes the modal
    // spanAlt is used as an alternative button to close the modal
    var span = document.getElementsByClassName("close");
    var spanAlt = document.querySelectorAll('.modal-custom .card-footer #close');

    // Get company information from global array and display it in the more info modal.
    // Arguments:
    // current_id: the id of the element clicked

    function getCompanyInfo(current_id){

        // Declaring variables that hold the elements
        
        modal_company_name_element = document.getElementById("modal-company-name");
        modal_company_desc_element = document.getElementById("modal-company-desc");
        modal_company_address_element = document.getElementById("modal-company-address");
        modal_company_tel_element = document.getElementById("modal-company-tel");
        modal_company_email_element = document.getElementById("modal-company-email");

        // Convert string id to number for iterative purposes
        current_id = current_id.replace("card-comp", '');

        for (company in company_list){
            if (current_id === company_list[company]['id']){
                
                // Declaring variables that hold company information
                modal_company_name = company_list[company]['name'];
                modal_company_desc = company_list[company]['description'];
                modal_company_address = company_list[company]['address'];
                modal_company_tel = company_list[company]['tel'];
                modal_company_email = company_list[company]['email'];
                
                
            }
        } 

        // Changing the contents of the element within the modal
        modal_company_name_element.innerHTML = modal_company_name;
        modal_company_desc_element.innerHTML = modal_company_desc;
        modal_company_address_element.innerHTML = modal_company_address;
        modal_company_tel_element.innerHTML = modal_company_tel;
        modal_company_email_element.innerHTML = modal_company_email;
    }

    // When the user clicks on <span> (x), close the modal
    // Index in square brackets determines the type of modal being closed.
    // 0: Company Information Modal
    // 1: Add New Company Modal

    span[0].onclick = function() {
        modal[0].style.display = "none";
    }

    span[1].onclick = function() {
        modal[1].style.display = "none";
    }

    spanAlt[0].onclick = function() {
        modal[0].style.display = "none";
    }

    spanAlt[1].onclick = function() {
        modal[1].style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal[0]) {
        modal[0].style.display = "none";
    }else if (event.target == modal[1]){
        modal[1].style.display = "none";
    }
    }
    
    // Query that selects all grid blocks within the company list and for each item adds three event listeners
    document.querySelectorAll('#company-block-row .card').forEach(item => {

        // 1. Event listener for when mouse enters the card
        item.addEventListener('mouseover', function(event){
            // Specific edit button selected and displayed
            var editButton = document.getElementById((this.id).concat("-btn"));
            if (editButton){
                editButton.style.display = "inline-block";
            }
        })

        // 2. Event listener for when mouse clicks the card
        item.addEventListener('click', function(event){
            // get the modal by ID
            current_id = this.id;
            console.log(current_id);

            // depending on the type of the card, corresponding modal is opened when clicked
            // ID types:
            // card-comp{0} - a card containing company information, {0} represents its unique id
            // card-add-comp - a predefined card for adding new companies

            console.log(current_id.includes("card-comp"));

            if (current_id.includes("card-comp")){
                var btn = document.getElementById((current_id));
                var edit_button =  document.getElementById('edit-button-form');
                edit_button.action = 'edit.php?id='+current_id;
                console.log(edit_button.action);
                modal[0].style.display = "block";
                getCompanyInfo(current_id);
            }else{
                modal[1].style.display = "block";
                console.log(modal[1]);
            }
        })

        // 3. Event listener for when mouse leaves the card
        item.addEventListener('mouseout', function(event){
            var editButton = document.getElementById((this.id).concat("-btn"));
            if (editButton){
                editButton.style.display = "none";
            }
        })
      })
    };

  function searchFunction() {
    // Declare variables
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById('search-input');
    filter = input.value.toUpperCase();

    // Loop through all list items, and hide those who don't match the search query
    document.querySelectorAll('#company-block-row .col-mb-3').forEach(item =>{
        a = (item.getElementsByClassName("card-body text-primary").item(0));
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            item.style.display = "";
          } else {
            item.style.display = "none";
          }
    })
}

// This selection is used to ensure that JS can only modify the DOM tree after it has finished loading

if( document.readyState !== 'loading' ) {
    console.log( 'document is already ready, just execute code here' );
    initialiseCode();
    
} else {
    document.addEventListener('DOMContentLoaded', function () {
        console.log( 'document was not ready, place code here' );
        initialiseCode();
    });
};

