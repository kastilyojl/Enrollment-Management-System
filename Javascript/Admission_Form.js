function hideShowInputBox(val) {

    if(val=='hide') {
        document.getElementById('inputBox').style.display='none';
    } else if(val=='show') {
        document.getElementById('inputBox').style.display = 'block';
    } 

    if(val=='showESC') {
        document.getElementById('inputBoxESC').style.display = 'block';
    } 

    if(val=='showScholar') {
        document.getElementById('inputBoxScholar').style.display = 'block';
    }

}

function goBack1(formName) {
    window.location.href = formName + ".php";
}

function submitted(formFolder, formName) {
    window.location.href = filename + ".php";
}
//////////////////////////////////////////////////////////////////////////

// Set rules to telephone

// Start with number 9
var telephoneInput = document.getElementById('telephone');

    telephoneInput.addEventListener('input', function() {
        
        var value = this.value;
       
        if (value.charAt(0) !== '9') {
            
            this.value = '';
        }
    });

// Set to numbers only
    telephoneInput.addEventListener('keydown', function(event) {

        var key = event.keyCode || event.charCode;

        if (!(key >= 48 && key <= 57) &&
            !(key >= 96 && key <= 105) &&
            key != 8 && key != 9 && key != 13 && key != 46 &&
            !(key >= 37 && key <= 40)) { 
            event.preventDefault(); 
        }
    });

    //////////////////////////////////////////////////////////////////////////