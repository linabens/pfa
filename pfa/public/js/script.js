let loginBtn = document.getElementById("log-reg-show");
let regBtn = document.getElementById("log-login-show");
let whitePanel = document.getElementById("white-panel");
let loginCard = document.getElementById("login-show");
let regCard = document.getElementById("register-show");
let inputs = document.querySelectorAll(".floating input:not([type='button'])");

loginBtn.addEventListener("click", addRemoveActiveClass);
regBtn.addEventListener("click", addRemoveActiveClass);

inputs.forEach(element =>
  element.addEventListener("focus", addClassForFloating)
);

inputs.forEach(element =>
  element.addEventListener("blur", removeClassForFloationg)
);

function addClassForFloating() {
  let classes = this.parentElement;
  if (classes.className === "floating") {
    classes.classList.toggle("active", true);
  }
}

function removeClassForFloationg() {
  let classes = this.parentElement;
  console.log(classes);
  if (!this.value) {
    classes.classList.toggle("active", false);
  }
}

function addRemoveActiveClass() {
  whitePanel.classList.toggle("right");
  loginCard.classList.toggle("active");
  regCard.classList.toggle("active");
}

// --- Validation pour le formulaire d'inscription ---\n\nconst registerEmailInput = document.getElementById('register-email');\nconst registerPasswordInput = document.getElementById('register-password');\nconst confirmPasswordInput = document.getElementById('confirm-password');\n\nconst emailErrorSpan = document.getElementById('email-error');\nconst passwordErrorSpan = document.getElementById('password-error');\nconst confirmPasswordErrorSpan = document.getElementById('confirm-password-error');\n\nconst registerButton = document.getElementById('register-button');\n\nfunction validateEmail() {\n    const email = registerEmailInput.value.trim();\n    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;\n    if (email === '') {\n        emailErrorSpan.textContent = 'L\'email est requis.';\n        return false;\n    } else if (!emailRegex.test(email)) {\n        emailErrorSpan.textContent = 'Format d\'email invalide.';\n        return false;\n    } else {\n        emailErrorSpan.textContent = ''; // Efface l'erreur si valide\n        return true;\n    }\n}\n\nfunction validatePassword() {\n    const password = registerPasswordInput.value;\n    let errorMessage = '';\n    if (password.length < 8) {\n        errorMessage = 'Au moins 8 caractères.';\n    } else if (!/[A-Z]/.test(password)) {\n        errorMessage = 'Au moins une majuscule.';\n    } else if (!/[a-z]/.test(password)) {\n        errorMessage = 'Au moins une minuscule.';\n    } else if (!/[0-9]/.test(password)) {\n        errorMessage = 'Au moins un chiffre.';\n    } else if (!/[!@#$%^&*()\\-_=+{};:,<.>]/.test(password)) {\n        errorMessage = 'Au moins un caractère spécial.';\n    }\n    \n    passwordErrorSpan.textContent = errorMessage;\n    return errorMessage === '';\n}\n\nfunction validateConfirmPassword() {\n    const password = registerPasswordInput.value;\n    const confirmPassword = confirmPasswordInput.value;\n    if (confirmPassword === '') {\n        confirmPasswordErrorSpan.textContent = 'Veuillez confirmer le mot de passe.';\n        return false;\n    } else if (password !== confirmPassword) {\n        confirmPasswordErrorSpan.textContent = 'Les mots de passe ne correspondent pas.';\n        return false;\n    } else {\n        confirmPasswordErrorSpan.textContent = '';\n        return true;\n    }\n}\n\n// Ajout des écouteurs d'événements 'input' pour validation en temps réel\nif (registerEmailInput) {\n    registerEmailInput.addEventListener('input', validateEmail);\n}\nif (registerPasswordInput) {\n    registerPasswordInput.addEventListener('input', () => {\n        validatePassword();\n        validateConfirmPassword(); // Re-valider la confirmation si le mdp change\n    });\n}\nif (confirmPasswordInput) {\n    confirmPasswordInput.addEventListener('input', validateConfirmPassword);\n}\n\n// Optionnel : Validation lors du clic sur le bouton Register\n// (Note: Ce bouton est type='button', donc il ne soumet pas de formulaire par défaut)\nif (registerButton) {\n    registerButton.addEventListener('click', (event) => {\n        const isEmailValid = validateEmail();\n        const isPasswordValid = validatePassword();\n        const isConfirmPasswordValid = validateConfirmPassword();\n\n        if (!isEmailValid || !isPasswordValid || !isConfirmPasswordValid) {\n            console.log('Validation échouée côté client.');\n            // Vous pourriez empêcher une action ici si nécessaire,\n            // mais comme c'est un bouton simple, il n'y a pas d'action par défaut à prévenir.\n            // event.preventDefault(); // Seulement si c'était type='submit'\n        } else {\n            console.log('Validation réussie côté client.');\n            // Ici, vous pourriez déclencher une soumission AJAX ou une autre action\n        }\n    });\n}
