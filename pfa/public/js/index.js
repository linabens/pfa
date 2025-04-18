let loginBtn = document.getElementById("log-reg-show");
let regBtn = document.getElementById("log-login-show");
let whitePanel = document.getElementById("white-panel");
let loginCard = document.getElementById("login-show");
let regCard = document.getElementById("register-show");
let inputs = document.querySelectorAll(".floating input:not([type='button'])");

// --- Select Registration Form Elements ---
const registerButton = document.getElementById('register-button');
const registerEmailInput = document.getElementById('register-email');
const registerPasswordInput = document.getElementById('register-password');
const confirmPasswordInput = document.getElementById('confirm-password');
// --- Select Error Message Elements ---
const emailErrorSpan = document.getElementById('email-error');
const passwordErrorSpan = document.getElementById('password-error');
const confirmPasswordErrorSpan = document.getElementById('confirm-password-error');

loginBtn.addEventListener("click", addRemoveActiveClass);
regBtn.addEventListener("click", addRemoveActiveClass);

inputs.forEach(element =>
  element.addEventListener("focus", addClassForFloating)
);

inputs.forEach(element =>
  element.addEventListener("blur", removeClassForFloationg)
);

// --- Add Event Listener for Registration Validation ---
if (registerButton) {
    registerButton.addEventListener('click', validateRegistration);
}

function addClassForFloating() {
  let classes = this.parentElement;
  if (classes.className === "floating") {
    classes.classList.toggle("active", true);
  }
  // --- Clear error when user starts typing in a field ---
  const errorSpanId = this.id.replace('register-', '') + '-error'; // e.g., 'email-error'
  const errorSpan = document.getElementById(errorSpanId);
  if(errorSpan) {
    errorSpan.textContent = ''; // Clear specific error on focus
  }
}

function removeClassForFloationg() {
  let classes = this.parentElement;
  // console.log(classes); // Keep console logs minimal or remove for production
  if (!this.value) {
    classes.classList.toggle("active", false);
  }
}

function addRemoveActiveClass() {
  whitePanel.classList.toggle("right");
  loginCard.classList.toggle("active");
  regCard.classList.toggle("active");
}

// --- Registration Validation Function ---
function validateRegistration() {
    // --- Clear all previous errors ---
    emailErrorSpan.textContent = '';
    passwordErrorSpan.textContent = '';
    confirmPasswordErrorSpan.textContent = '';

    let isValid = true; // Assume valid initially
    const email = registerEmailInput.value.trim();
    const password = registerPasswordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    // --- Email Validation ---
    let emailLocalPart = '';
    if (!email) {
        emailErrorSpan.textContent = "L'email est requis.";
        isValid = false;
    } else {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            emailErrorSpan.textContent = "Le format de l'email est invalide.";
            isValid = false;
        } else {
            emailLocalPart = email.split('@')[0].toLowerCase();
            if (emailLocalPart.length < 3) {
                emailLocalPart = '';
            }
        }
    }

    // --- Password Validation ---
    let isPasswordValid = true; // Flag specific to password rules
    if (!password) {
        // If password is empty, show the specific message for empty field
        passwordErrorSpan.textContent = "Le mot de passe est requis.";
        isPasswordValid = false; // Mark password as invalid
        isValid = false; // Mark overall form as invalid
    } else {
        // Check all rules. If any fail, set isPasswordValid to false.
        if (password.length < 8) isPasswordValid = false;
        if (!/[A-Z]/.test(password)) isPasswordValid = false;
        if (!/[a-z]/.test(password)) isPasswordValid = false;
        if (!/\d/.test(password)) isPasswordValid = false;
        if (!/[\^£$%&*()}{@#~?><>,|=_+¬\-\]\[]/.test(password)) isPasswordValid = false;
        if (emailLocalPart && password.toLowerCase().includes(emailLocalPart)) isPasswordValid = false;

        // If any rule failed (and password wasn't empty)
        if (!isPasswordValid) {
            // Display the single, generic error message for password criteria
            passwordErrorSpan.textContent = "Le mot de passe doit contenir min 8 caractères, majuscule, minuscule, chiffre et symbole.";
            isValid = false; // Mark overall form as invalid
        }

        // --- Confirm Password Validation ---
        // Check confirmation regardless of other password errors
        if (!confirmPassword) {
            confirmPasswordErrorSpan.textContent = "La confirmation est requise.";
            isValid = false;
        } else if (password !== confirmPassword) {
            confirmPasswordErrorSpan.textContent = "Les mots de passe ne correspondent pas.";
            isValid = false;
        }
    } // End of password check block

    // --- Final Action ---
    if (isValid) {
        alert('Inscription valide !');
        console.log('Registration data is valid:', { email });
        // Optionally clear form or redirect
    } else {
        console.log('Registration validation failed.');
    }
}
