document.addEventListener('DOMContentLoaded', function() {
    var inputIds = ['lname', 'fname', 'address', 'placebirth', 'birthdate','civilstatus', 'email', 'strand',
                    'p_file', 'reference_no', 'semester', 'purpose', 'amount', 'fullname', 'id_payver']; // List all input IDs here
    inputIds.forEach(function(id) {
        var input = document.getElementById(id);
        if (input) {
            input.addEventListener('input', function() {
                if (input.value.trim() !== '') {
                    input.classList.remove('error');
                } else {
                    input.classList.add('error');
                }
            });
        }
    });
});
