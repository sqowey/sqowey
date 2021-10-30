<?php
    // Start the PHP_session
    session_start();
	// If the user is not logged in redirect to the index-page
	if (!isset($_SESSION['loggedin'])) {
		header('Location: index.html');
		exit;
	}

    
    // Variables with the login-credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'accounts';
    // Try to Connect with credentials
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    
    // Get the mail
    // Prepare the SQL
        if ($stmt = $con->prepare('SELECT email, password, phone, avatar FROM accounts WHERE username = ?')) {

            // Bind parameters (s = string, i = int, b = blob, etc)
            $stmt->bind_param('s', $_SESSION['name']);
            $stmt->execute();
    
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
            $stmt->bind_result($mail, $password, $phone, $avatar);
            $stmt->fetch();
            $_SESSION['mail'] = $mail;
            $_SESSION['password'] = $password;
            $_SESSION['phone'] = $phone;
            $_SESSION['avatar'] = $avatar;
        }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Wudsim</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="settings_style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="settings">
            <div id="account">
                <h1>Account</h1>
                <div id="accountdata">
                    <div id="avatarchanger">
                        <img src="<?=$_SESSION['avatar']?>"></img>
                        <div>
                            <i class="fas fa-pen"></i>
                        </div>
                    </div>
                    <div id="accountdata-inner">
                        <span>E-Mail</span>
                        <br>
                        <input placeholder="<?=$_SESSION['mail']?>">
                        <div>
                            <i class="fas fa-pen"></i>
                        </div>
                        <br><br>
                        <span>Nutzername</span>
                        <br>
                        <input placeholder="<?=$_SESSION['name']?>">
                        <div>
                            <i class="fas fa-pen"></i>
                        </div>
                        <br><br>
                        <span>Telefonnumer</span>
                        <br>
                        <input placeholder="<?=$_SESSION['phone']?>">
                        <div>
                            <i class="fas fa-pen"></i>
                        </div>
                        <br><br>
                        <span class="submit" onclick=''>Verändern</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="list">
            <div class="vertical-menu">
                <a href="#" class="active">Account</a>
                <a href="#">Profil</a>
                <a href="#">Sicherheit</a>
                <hr>
                <a href="#">Sprache</a>
                <a href="#">Aussehen</a>
                <a href="#">Barrierefreiheit</a>
                <hr>
                <a href="#">Hilfe</a>
                <a href="#">Credits</a>
                <a href="#">Support</a>
              </div> 
        </div>
      </div>
</body>

</html>