mail = document.getElementById("account_mail");
username = document.getElementById("account_username");
phone = document.getElementById("account_phone");
old_mail = mail.value;
old_username = username.value;
old_phone = phone.value;
function accountDetailsColor(){
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
setInterval(accountDetailsColor, 10);