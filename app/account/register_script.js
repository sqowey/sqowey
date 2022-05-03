// Create the Variables
var specialChars;
var upperChars;
var lowerChars;
var passwordLength;



// Get all needet Form-elements
submitButton = document.getElementById("submitButton");
passwordField = document.getElementById("password");
passwordRequirement1 = document.getElementById("passwordRequirement1");
passwordRequirement2 = document.getElementById("passwordRequirement2");
passwordRequirement3 = document.getElementById("passwordRequirement3");
passwordRequirement4 = document.getElementById("passwordRequirement4");
passwordRequirement1icon = document.getElementById("passwordRequirement1icon");
passwordRequirement2icon = document.getElementById("passwordRequirement2icon");
passwordRequirement3icon = document.getElementById("passwordRequirement3icon");
passwordRequirement4icon = document.getElementById("passwordRequirement4icon");

// Disable the submit button, so that the requirements can be checked
submitButton.disabled = "true";

// Function, that is being called on an change in the Password field
function passwordChanged() {

    // Get the kength of the password
    passwordLength = passwordField.value.length;

    // Get the number of special Characters
    specialChars = passwordLength - passwordField.value.replace(/[@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '').length;

    // Get the number of uppercase Characters
    upperChars = passwordLength - passwordField.value.replace(/[A-Z]/g, '').length;

    // Get the number of lowercase Characters
    lowerChars = passwordLength - specialChars - upperChars;


    // 
    // Special character check
    // 
    // Check if there is at least one special Character
    if (specialChars > 0) {
        // Set the checkmark
        passwordRequirement1.innerHTML = '<i class="fas fa-check"></i> Sonderzeichen';
    }
    // If there is not at least one Special Character
    else {
        // Remove Checkmark
        passwordRequirement1.innerHTML = '<i class="far fa-times-circle"></i> Sonderzeichen';
    }

    // 
    // Uppercase character check
    // 
    // Check if there is at least one uppercase Character
    if (upperChars > 0) {
        // Set the checkmark
        passwordRequirement2.innerHTML = '<i class="fas fa-check"></i> Gro&szlig;buchstaben';
    }
    // If there is not at least one uppercase Character
    else {
        // Remove checkmark
        passwordRequirement2.innerHTML = '<i class="far fa-times-circle"></i> Gro&szlig;buchstaben';
    }

    // 
    // Lowercase character check
    // 
    // Check if there is at least one lowercase Character
    if (lowerChars > 0) {
        // Set the chckmark
        passwordRequirement3.innerHTML = '<i class="fas fa-check"></i> Kleinbuchstaben';
    }
    // If there is not at least one lowercase Character
    else {
        // Remove checkmark
        passwordRequirement3.innerHTML = '<i class="far fa-times-circle"></i> Kleinbuchstaben';

    }

    // 
    // Password length check
    // 
    // Check if the password is long enough
    if (passwordLength >= 8 && passwordLength <= 100) {

        // Set the ckeckmark
        passwordRequirement4.innerHTML = '<i class="fas fa-check"></i> L&auml;nge 8-100';
    }
    // If the password is not long enough
    else {

        // Remove checkmark
        passwordRequirement4.innerHTML = '<i class="far fa-times-circle"></i> L&auml;nge 8-100 Buchstaben';

    }

    // check if password passes all tests
    if (specialChars > 0 && upperChars > 0 && lowerChars > 0 && passwordLength >= 8 && passwordLength <= 100) {
        submitButton.disabled = false;
        submitButton.style.backgroundColor = "#3274d6";
    } else {
        submitButton.disabled = true;
        submitButton.style.backgroundColor = "#254674";
    }
}
setInterval(passwordChanged, 100);