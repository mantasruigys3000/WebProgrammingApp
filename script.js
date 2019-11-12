function initialiseCode(){

    
    // Get the modal
    var modal = document.getElementsByClassName("modal-custom");
    console.log(modal[0])

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var spanAlt = document.querySelectorAll('.modal-custom .card-footer #close')[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        console.log("Span clicked");
        modal[0].style.display = "none";
        modal[1].style.display = "none";
    }

    spanAlt.onclick = function() {
        console.log("Alt Span clicked");
        modal[0].style.display = "none";
        modal[1].style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
        console.log("Outside Span clicked");
        modal[0].style.display = "none";
        modal[1].style.display = "none";
    }
    }
    
    // Query selects all grid blocks within the company row list and for each item adds an event listener
    document.querySelectorAll('#company-block-row .col-mb-3').forEach(item => {

        // Event listener when mouse enters the card
        item.addEventListener('mouseover', function(event){
            // Specific edit button selected and displayed
            var editButton = document.getElementById((this.id).concat("-btn"));
            if (editButton){
                editButton.style.display = "inline-block";
            }
        })

        // Event listener when mouse clicks the card
        item.addEventListener('click', function(event){
            // get the modal by ID
            current_id = this.id;
            console.log(current_id);

            // depending on the type of the card, corresponding modal is opened when clicked
            // ID types:
            // card-comp{0} - a card containing company information, {0} represents its unique id
            // card-add-comp - a predefined card for adding new companies

            console.log(current_id.includes("comp"));

            if (current_id.includes("card-comp")){
                var btn = document.getElementById((current_id));
                btn.onclick = function() {
                    modal[0].style.display = "block";
                }
            }else{
                modal[1].style.display = "block";
            }
        })

        // Event listener when mouse leaves the card
        item.addEventListener('mouseout', function(event){
            var editButton = document.getElementById((this.id).concat("-btn"));
            if (editButton){
                editButton.style.display = "none";
            }
        })
      })
    };

function expandLoginBox() {
    var coll = document.getElementsByClassName("loginroll");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
            content.style.maxHeight = null;
            } else {
            content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
  };

  function searchFunction() {
    // Declare variables
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById('search-input');
    filter = input.value.toUpperCase();

    // Loop through all list items, and hide those who don't match the search query
    document.querySelectorAll('#company-block-row').forEach(item =>{
        a = (item.getElementsByClassName("card-body").item(0));
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            item.style.display = "";
          } else {
            item.style.display = "none";
          }
        /*
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        }else {
            li[i].style.display = "none";
        }
        */
    })
}

if( document.readyState !== 'loading' ) {
    console.log( 'document is already ready, just execute code here' );
    initialiseCode();
    
} else {
    document.addEventListener('DOMContentLoaded', function () {
        console.log( 'document was not ready, place code here' );
        initialiseCode();
    });
};

/* function initialise(){
    document.querySelectorAll('#company-block-row .col-lg-2').forEach(item => {
        item.addEventListener('mouseover', event => {
            console.log(this);
            var currentElementId = document.getElementById(this.id);
            var editButton = currentElementId.getElementByClassName("edit-button");
            editButton.style.display = "block";
        })
        item.addEventListener('click', event => {
            console.log("Edit Menu");
        })
        item.addEventListener('mouseout', event => {
            var currentElementId = document.getElementById(this.id);
            var editButton = currentElementId.getElementByClassName("edit-button");
            editButton.style.display = "none";
        })
      })
};
*/





