const student_login_btn = document.querySelector("#student-btn");
const admin_login_btn = document.querySelector("#admin-btn");
const container = document.querySelector(".container");
const log = document.querySelector(".btn-solid")

// Function to clear input fields
function clearInputFields() {
    const inputs = document.querySelectorAll('.input-field input');
    inputs.forEach(input => input.value = '');
}

admin_login_btn.addEventListener('click', () => {
    container.classList.add("admin-mode");
    clearInputFields();
});

student_login_btn.addEventListener('click', () => {
    container.classList.remove("admin-mode");
    clearInputFields();
});

// document.querySelectorAll('.toggle-text').forEach(function (icon) {
//     icon.addEventListener('click', function () {
//         const textField = this.previousElementSibling;
//         textField.classList.toggle('hidden-text');
//         this.classList.toggle('fa-eye-slash');
//         this.classList.toggle('fa-eye');
//     });
// });


