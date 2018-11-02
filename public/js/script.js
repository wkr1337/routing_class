// // scroll navigation 
function scrollToDiv (divId){
    document.querySelector(divId).scrollIntoView();
}

// login
// Get the modal
var modal = document.getElementById('modal-login-div');
var modalRegister = document.getElementById('modal-register-div');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == modalRegister) {
        modalRegister.style.display = "none";
    }
}

document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) {
        modalRegister.style.display = "none";
        modal.style.display = "none";
    }
};


// fade out the alert messages after login, logout or register.
$( "div.alert-box-failure" ).delay( 5000 ).fadeOut( 1000 );
$( "div.alert-box-success" ).delay( 1000 ).fadeOut( 1000 );


// Check if the two passwords are the same
function checkPassword() {
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('password_1');
    var pass2 = document.getElementById('password_2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value.length != 0 && pass2.value.length != 0) {
        if(pass1.value == pass2.value){
            //The passwords match. 
            //Set the color to the good color and inform
            //the user that they have entered the correct password 
            pass2.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "Passwords Match!";
        }else{
            //The passwords do not match.
            //Set the color to the bad color and
            //notify the user.
            pass2.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "Passwords Do Not Match!";
        }
    }
    if(pass1.value.length == 0 || pass2.value.length == 0) {
        pass2.style.backgroundColor = "#ffffff";
        message.innerHTML = "";
    }
}
