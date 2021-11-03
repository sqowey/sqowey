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

    // Close the Database connection
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
    <i onclick='location.href = "./app.php";' id="closebutton" class="fas fa-times"></i>
    <div class="container">
        <div class="settings">
            <div id="standart">
                <h1>Einstellungen</h1>
                <i class="fas fa-arrow-left"></i>
                <br>
                <span>W&auml;hle bitte eine Kategorie aus!</span>
            </div>
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
            <div id="privacy">
                <h1>Privatsph&auml;re</h1>
                <div class="privacy_container">
                    <div class="privacy_stats">
                        <span class="privacy_title">Anonyme Statistiken</span>
                        <p>Wir d&uuml;rfen anonym Nutzungsdaten sammeln<br>und diese in Statistiken zusammenfassen.</p>
                        <br>
                        <?=$_SESSION['privacy_statistics']?>
                    </div>
                    <div class="privacy_enhance">
                        <span class="privacy_title">Nutzbarkeit verbessern</span>
                        <p>Wir d&uuml;rfen Nutzungsdaten sammeln,<br>um die Nutzbarkeit zu verbessern.</p>
                        <br>
                        <?=$enhance_button?>
                    </div>
                    <div class="privacy_ads">
                        <span class="privacy_title">Werbung</span>
                        <p>Wir d&uuml;rfen deine Nachrichten, ohne deinen Namen,<br>zu Werbezwecken nutzen.</p>
                        <br>
                        <?=$ads_button?>
                    </div>
                    <div class="privacy_all">
                        <span class="privacy_title">Alle AN/AUS</span>
                        <p>Hier kannst du alle oben genannten Privatsph&auml;reeinstellungen<br>AN oder AUS schalten</p>
                        <br>
                        <?=$all_button?>
                    </div>
                </div>
            </div>
            <div id="security">
                <h1>Sicherheit</h1>

            </div>
            <div id="language">
                <h1>Sprache</h1>
                <div class="language_container">
                    <div onclick='setLanguage("de");' class="language_german">
                        <div class="language">
                            <div id="language_check_de" class="language_check">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="language_name">
                                Deutsch
                            </div>
                            <div class="language_flag">
                                <img src="images/flag_de.svg">
                            </div>
                        </div>
                    </div>
                    <div onclick='setLanguage("en");' class="language_english">
                        <div class="language">
                            <div id="language_check_en" class="language_check">
                                <i class="far fa-circle"></i>
                            </div>
                            <div class="language_name">
                                English
                            </div>
                            <div class="language_flag">
                                <img src="images/flag_gb.svg">
                            </div>
                        </div>
                    </div>
                    <div onclick='setLanguage("fr");' class="language_francais">
                        <div class="language">
                            <div id="language_check_fr" class="language_check">
                                <i class="far fa-circle"></i>
                            </div>
                            <div class="language_name">
                                Français
                            </div>
                            <div class="language_flag">
                                <img src="images/flag_fr.svg">
                            </div>
                        </div>
                    </div>
                    <div onclick='setLanguage("it");' class="language_italiano">
                        <div class="language">
                            <div id="language_check_it" class="language_check">
                                <i class="far fa-circle"></i>
                            </div>
                            <div class="language_name">
                                Italiano
                            </div>
                            <div class="language_flag">
                                <img src="images/flag_it.svg">
                            </div>
                        </div>
                    </div>
                    <div onclick='setLanguage("ch");' class="language_swissgerman">
                        <div class="language">
                            <div id="language_check_ch" class="language_check">
                                <i class="far fa-circle"></i>
                            </div>
                            <div class="language_name">
                                Schweiz
                            </div>
                            <div class="language_flag">
                                <img src="images/flag_ch.svg">
                            </div>
                        </div>
                    </div>
                    <div onclick='setLanguage("sw");' class="language_swabian">
                        <div class="language">
                            <div id="language_check_sw" class="language_check">
                                <i class="far fa-circle"></i>
                            </div>
                            <div class="language_name">
                                Schw&auml;bisch
                            </div>
                            <div class="language_flag">
                                <img src="images/flag_sw.svg">
                            </div>
                        </div>              
                    </div>
                </div>
            </div>
            <div id="look">
                <h1>Aussehen</h1>

            </div>
            <div id="access">
                <h1>Barrierefreiheit</h1>

            </div>
            <div id="help">
                <h1>Hilfe</h1>

            </div>
            <div id="credits">
                <h1>Danke an</h1>

            </div>
        </div>
        <div class="list">
            <div class="vertical-menu">
                <a onclick="changeToTab('account')" href="#">Account</a>
                <a onclick="changeToTab('privacy')" href="#">Privatsph&auml;re</a>
                <a onclick="changeToTab('security')" href="#">Sicherheit</a>
                <hr>
                <a onclick="changeToTab('language')" href="#">Sprache</a>
                <a onclick="changeToTab('look')" href="#">Aussehen</a>
                <a onclick="changeToTab('access')" href="#">Barrierefreiheit</a>
                <hr>
                <a onclick="changeToTab('help')" href="#">Hilfe</a>
                <a onclick="changeToTab('credits')" href="#">Credits</a>
                <a href="support.html" target="_blank">Support</a>
              </div> 
        </div>
    </div>
    <script src="settings_script.js"></script>
</body>

</html>