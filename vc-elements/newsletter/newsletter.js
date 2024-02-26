$( document ).ready( function() {

    $('#mce_EMAIL').bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-Z0-9.-_@]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    /**
     * Disable copy-paste
     */
    window.onload = function() {
        var myInput = document.getElementById('mce_EMAIL');
        myInput.onpaste = function(e) {
            e.preventDefault();
            alert("this action is prohibited");
        }
        
        myInput.oncopy = function(e) {
            e.preventDefault();
            alert("this action is prohibited");
        }
    }
})

function ValidateEmail(inputText) {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.value.match(mailformat)) {
        $('#mce_EMAIL').focus();
        return true;
    } else {
        alert("You have entered an invalid email address!");
        $('#mce_EMAIL').focus();
        $('#mce_EMAIL').val('');
        event.preventDefault();
        return false;
    }
}