// 
// Get all needed elements
// 

// Get the file upload script
const php_script = "upload_avatar.php";

// Get the upload formular
const uploadform = document.getElementById("uploadform");

// Get all account formular items
mail = document.getElementById("account_mail");
username = document.getElementById("account_username");
phone = document.getElementById("account_phone");

// Get all tabs
standart = document.getElementById("standart");
account = document.getElementById("account");
profile = document.getElementById("profile");
security = document.getElementById("security");
language = document.getElementById("language");
look = document.getElementById("look");
access = document.getElementById("access");
help = document.getElementById("help");
credits = document.getElementById("credits");
support = document.getElementById("support");

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
// Avatar upload
// 


// eventlistener is waiting for submits
uploadform.addEventListener ("submit", function (evt) {

    // prevent default
	evt.preventDefault();

    // get the files
	const files = document.querySelector('[type=file]').files;

    // create a form
    const formData = new FormData();
    
    // repeat it for every file
	for (let i = 0; i < files.length; i++) {

        // pick the right file
		let file = files[i];

        // append the file to the form
		formData.append('files[]', file)
	}
	
    // send everything to the php script
	fetch (php_script, {
		method: "POST",
		body: formData,
	});
});




// 
// Change settings tab
// 
function changeToTab(tab){

    // close all tabs
    standart.style.display = "none";
    account.style.display = "none";
    profile.style.display = "none";
    security.style.display = "none";
    language.style.display = "none";
    look.style.display = "none";
    access.style.display = "none";
    help.style.display = "none";
    credits.style.display = "none";
    support.style.display = "none";

    // open the needed tab
    switch(tab){
        case('account'):
            account.style.display = "block";
            break;
        case('profile'):
            profile.style.display = "block";
            break;
        case('security'):
            security.style.display = "block";
            break;
        case('language'):
            language.style.display = "block";
            break;
        case('look'):
            look.style.display = "block";
            break;
        case('access'):
            access.style.display = "block";
            break;
        case('help'):
            help.style.display = "block";
            break;
        case('credits'):
            credits.style.display = "block";
            break;
        case('support'):
            support.style.display = "block";
            break;
    }
}