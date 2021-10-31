// 
// Get all needed elements
// 

// Get the file upload script
const php_script = "upload_file.php";

// Get the upload formular
const uploadform = document.getElementById("uploadform");

// Get all account formular items
mail = document.getElementById("account_mail");
username = document.getElementById("account_username");
phone = document.getElementById("account_phone");


// 
// Background color changer on value change
// 

// Get initial values
old_mail = mail.value;
old_username = username.value;
old_phone = phone.value;

// The function that get's called repeatedly
function accountDetailsColor(){

    // Check if value has changed and if so set new background color
    if(mail.value!=old_mail){
        mail.style.background = "#4e8fc2"
    }else{
        mail.style.background = "#dee0e4"
    }
    if(username.value!=old_username){
        username.style.background = "#4e8fc2"
    }else{
        username.style.background = "#dee0e4"
    }
    if(phone.value!=old_phone){
        phone.style.background = "#4e8fc2"
    }else{
        phone.style.background = "#dee0e4"
    }
}

// Add an interval-caller for the account function
setInterval(accountDetailsColor, 10);



// 
// 
// 


// eventlistener is waiting for submits
uploadform.addEventListener ("submit", function (evt) {
	evt.preventDefault();
	const files = document.querySelector('[type=file]').files;
    const formData = new FormData();
    
	for (let i = 0; i < files.length; i++) {
		let file = files[i];
		formData.append('files[]', file)
	}
	
	fetch (php_script, {
		method: "POST",
		body: formData,
	}).then ((response) => {
		console.log (response);
	});
});