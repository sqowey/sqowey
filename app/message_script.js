// Get the error message and show it
function setErrorMessage() {
    errorMessageSub = location.search.substring(1);
    errorMessage = errorMessageSub.split("&")[0];
    errorMessage = errorMessage.split("=")[1];
    while (errorMessage.includes("%22")) {
        errorMessage = errorMessage.replace("%22", "");
    }
    while (errorMessage.includes("%20")) {
        errorMessage = errorMessage.replace("%20", " ");
    }

    document.getElementById("errorBox").innerHTML = errorMessage;
}
setErrorMessage();

// Check if the report button should be shown
function showReportButton() {
    if (location.search.substring().includes("showReportButton=false")) {
        document.getElementById("reportButton").style.display = "none";
    }
}
showReportButton();