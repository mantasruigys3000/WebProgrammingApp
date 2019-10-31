function initialiseCode(){

    
    // Get the modal
    var modal = document.getElementById("edit-modal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var spanAlt = document.querySelectorAll('#edit-modal .card-footer #close')[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    spanAlt.onclick = function() {
        modal.style.display = "none";
    }


    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
    
    document.querySelectorAll('#company-block-row .col-mb-3').forEach(item => {
        item.addEventListener('mouseover', function(event){
            var editButton = document.getElementById((this.id).concat("-btn"));
            editButton.style.display = "inline-block";
        })
        item.addEventListener('click', function(event){
            // get the modal by ID
            console.log("Edit Company");
            console.log(this.id)
            var btn = document.getElementById((this.id));
            btn.onclick = function() {
                modal.style.display = "block";

            }
        })
        item.addEventListener('mouseout', function(event){
            var editButton = document.getElementById((this.id).concat("-btn"));
            editButton.style.display = "none";
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
    document.querySelectorAll('#company-block-row .col-mb-3').forEach(item =>{
        a = (item.getElementsByClassName("card-body text-primary").item(0));
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





