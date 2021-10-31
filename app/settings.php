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
    if ($stmt = $con->prepare('SELECT email, password, phone, avatar, id FROM accounts WHERE username = ?')) {

        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('s', $_SESSION['name']);
        $stmt->execute();

        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        $stmt->bind_result($mail, $password, $phone, $avatar, $id);
        $stmt->fetch();
        $_SESSION['mail'] = $mail;
        $_SESSION['password'] = $password;
        $_SESSION['phone'] = $phone;
        $_SESSION['avatar'] = $avatar;
        $_SESSION['id'] = $id;
    }

    // close the database-connection
    mysqli_close($con);
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
                            <i onclick="document.getElementById('uploadform').style.display = 'block';" class="fas fa-pen"></i>
                        </div>
                        <form id="uploadform" method="post" enctype="multipart/form-data">	
                            <input id="files" type="file" name="files[]" multiple>
                            <input type="submit" value="Hochladen" name="submit">
                        </form>
                    </div>
                    <form action="setaccountinfo.php" method="post" id="accountdata-inner">
                        <span>E-Mail</span>
                        <br>
                        <input id="account_mail" name="email" value="<?=$_SESSION['mail']?>">
                        <br><br>
                        <span>Nutzername</span>
                        <br>
                        <input id="account_username" name="username" value="<?=$_SESSION['name']?>">
                        <br><br>
                        <span>Telefonnumer</span>
                        <br>
                        <input id="account_phone" name="phone" value="<?=$_SESSION['phone']?>">
                        <br><br>
                        <input type="submit" class="submit" value="Absenden" onclick=''></input>
                    </form>
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
      <script src="settings_script.js"></script>
</body>

</html>