<?php
    // Start the PHP_session
    session_start();

	// If the user is not logged in redirect to the index-page
    // Also if the session variable id is unset
	if (!isset($_SESSION['name']) || !isset($_SESSION['loggedin'])) {
		header('Location: app.html');
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
    if ($stmt = $con->prepare('SELECT id, email, password, phone, avatar FROM accounts WHERE username = ?')) {

        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('s', $_SESSION['name']);
        $stmt->execute();

        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        $stmt->bind_result($id, $mail, $password, $phone, $avatar);
        $stmt->fetch();
        $_SESSION['id'] = $id;
        $_SESSION['mail'] = $mail;
        $_SESSION['password'] = $password;
        $_SESSION['phone'] = $phone;
        $_SESSION['avatar'] = $avatar;

        // close the statement
        $stmt->close();
        
            // Prepare the SQL
            if ($stmt = $con->prepare('SELECT privacy_statistics, privacy_enhance, privacy_ads, language FROM settings WHERE user_id = ?')) {

                // Bind parameters (s = string, i = int, b = blob, etc)
                $stmt->bind_param('s', $id);
                $stmt->execute();

                // Store the result to check if the account exists in the database.
                $stmt->store_result();
                $stmt->bind_result($w1, $w2, $w3, $w4);
                $stmt->fetch();

                // Check if any of the variables is unset
                if (!isset($w1) || !isset($w2) || !isset($w3) || !isset($w4)) {

                    // Prepare the SQL
                    if ($stmt = $con->prepare('INSERT INTO accounts (user_id, privacy_statistics, privacy_enhance, privacy_ads, language) VALUES (?, ?, ?, ?, ?)')) {

                        // Bind parameters (s = string, i = int, b = blob, etc)
                        $stmt->bind_param('sssss', $_SESSION['name'], '1', '1', '1', 'en');
                        $stmt->execute();

                        // close the statement
                        $stmt->close();

                        // Reload the page
                        header('Location: settings.php');
                        exit;

                    } else {

                        // Log the error
                        exit("Error-aaaa".mysqli_error($con));
                    }

                } else {

                    // close the statement
                    $stmt->close();
                }

                
                // Check all variables
                // Session var used here: privacy_all
                // If they are true then set the session variable to 1
                // If they are false then set the session variable to 0
                // If they are mixed then set the session variable to 2
                if ($w1 == '1' && $w2 == '1' && $w3 == '1') {
                    $_SESSION['privacy_all'] = '1';
                } elseif ($w1 == '0' && $w2 == '0' && $w3 == '0') {
                    $_SESSION['privacy_all'] = '0';
                } else {
                    $_SESSION['privacy_all'] = '2';
                }

                // Give the local variable privacy all the associated values
                // If Session: 1 then local: <i class="fas fa-check-circle"></i>
                // If Session: 2 then local: <i class="fas far-circle"></i>
                // If Session: 0 then local: <i class="fas fa-times-circle"></i>
                if ($_SESSION['privacy_all'] == '1') {
                    $privacy_all = '<i onclick=\'privacy("all_switch");\' class="fas fa-check-circle"></i>';
                } elseif ($_SESSION['privacy_all'] == '2') {
                    $privacy_all = '<i onclick=\'privacy("all_switch");\' class="far fa-circle"></i>';
                } else {
                    $privacy_all = '<i onclick=\'privacy("all_switch");\' class="fas fa-times-circle"></i>';
                }



                // Check every variable if it is true or false
                // If it is true, set the associated session-variable to '<i class="fas fa-check-circle"></i>'
                // If it is false, set the associated session-variable to '<i class="fas fa-times-circle"></i>'
                if ($w1 == 1) {
                    $_SESSION['privacy_statistics'] = '<i onclick=\'privacy("stats_switch");\' class="fas fa-check-circle"></i>';
                } else {
                    $_SESSION['privacy_statistics'] = '<i onclick=\'privacy("stats_switch");\' class="fas fa-times-circle"></i>';
                }
                if($w2 == 1) {
                    $_SESSION['privacy_enhance'] = '<i onclick=\'privacy("enhance_switch");\' class="fas fa-check-circle"></i>';
                } else {
                    $_SESSION['privacy_enhance'] = '<i onclick=\'privacy("enhance_switch");\' class="fas fa-times-circle"></i>';
                }
                if($w3 == 1) {
                    $_SESSION['privacy_ads'] = '<i onclick=\'privacy("ads_switch");\' class="fas fa-check-circle"></i>';
                } else {
                    $_SESSION['privacy_ads'] = '<i onclick=\'privacy("ads_switch");\' class="fas fa-times-circle"></i>';
                }
                 
                // Copy all session variables to the local variables
                $privacy_statistics = $_SESSION['privacy_statistics'];
                $privacy_enhance = $_SESSION['privacy_enhance'];
                $privacy_ads = $_SESSION['privacy_ads'];
                $language = $_SESSION['language'];



                // Set the language to the session-variable
                $_SESSION['language'] = $w4;
                
            }
            else{
                // Log the error
                exit("Error-".mysqli_error($con));

                // Display an error.
                header('Location: message.html?error=%22Fehler%20mit%20der%20Datenbank%22');
                exit();
            }
    }

    // Close the Database connection
    mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>

    <!-- Set Charset for compatibility -->
    <meta charset="utf-8">

    <!-- Set the title -->
    <title>Wudsim</title>

    <!-- Get connextion to fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <!-- Get the stylesheet -->
    <link href="settings_style.css" rel="stylesheet" type="text/css">

    <!-- Get the ajax library -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>

<body>

    <!-- The button to close the settings -->
    <i onclick='location.href = "./app.php";' id="closebutton" class="fas fa-times"></i>

    <!-- The main container, in which the grid is positioned -->
    <div class="container">

        <!-- The container in which all the settings are -->
        <div class="settings">

            <!-- The standart page, which is seen, when the settings are opened -->
            <div id="standart">

                <!-- Title for the standart page -->
                <h1>Einstellungen</h1>
                <i class="fas fa-arrow-left"></i>
                <br>
                <span>W&auml;hle bitte eine Kategorie aus!</span>
            </div>

            <!-- The container in which all the account settings are -->
            <div id="account">

                <!-- The title of the account settings container -->
                <h1>Account</h1>
                <div id="accountdata">

                    <!-- The area to change the avatar -->
                    <div id="avatarchanger">

                        <!-- The current avatar -->
                        <img src="<?=$_SESSION['avatar']?>"></img>

                        <!-- The edit icon -->
                        <div>
                            <i onclick="document.getElementById('uploadform').style.display = 'block';" class="fas fa-pen"></i>
                        </div>

                        <!-- The formular to upload a new avatar -->
                        <form id="uploadform" method="post" enctype="multipart/form-data">	
                            <input id="files" type="file" name="files[]" multiple>
                            <input type="submit" value="Hochladen" name="submit">
                        </form>
                    </div>

                    <!-- The formular to change account information -->
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

            <!-- The area in which privacy settings are -->
            <div id="privacy">

                <!-- The title for the privacy settings -->
                <h1>Privatsph&auml;re</h1>

                <!-- The container to place the grid -->
                <div class="privacy_container">

                    <!-- The container with everything that has to do with taking statistics -->
                    <div class="privacy_stats">
                        <span class="privacy_title">Anonyme Statistiken</span>
                        <p>Wir d&uuml;rfen anonym Nutzungsdaten sammeln<br>und diese in Statistiken zusammenfassen.</p>
                        <br>
                        <?=$privacy_statistics?>
                    </div>

                    <!-- The container with everything that has to do with taking data to enhance experience -->
                    <div class="privacy_enhance">
                        <span class="privacy_title">Nutzbarkeit verbessern</span>
                        <p>Wir d&uuml;rfen Nutzungsdaten sammeln,<br>um die Nutzbarkeit zu verbessern.</p>
                        <br>
                        <?=$privacy_enhance?>
                    </div>
                    
                    <!-- The container with everything that has to do with taking messages for ads -->
                    <div class="privacy_ads">
                        <span class="privacy_title">Werbung</span>
                        <p>Wir d&uuml;rfen deine Nachrichten, ohne deinen Namen,<br>zu Werbezwecken nutzen.</p>
                        <br>
                        <?=$privacy_ads?>
                    </div>
                    
                    <!-- The container with the button to toggle all settings -->
                    <div class="privacy_all">
                        <span class="privacy_title">Alle AN/AUS</span>
                        <p>Hier kannst du alle oben genannten Privatsph&auml;reeinstellungen<br>AN oder AUS schalten</p>
                        <br>
                        <?=$privacy_all?>
                    </div>
                </div>
            </div>
                    
            <!-- The container with everything that has to do with security settings -->
            <div id="security">

                <!-- The title of the security settings area -->
                <h1>Sicherheit</h1>
                <div class="security_friends_title">
                    Wer kann dich als Freund hinzuf&uuml;gen?
                </div>
                <div class="security_container">
                    <div class="toggle_element security_friends_everyone">
                        <p>Jeder</p>
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <div class="toggle_element security_friends_server">
                        <p>von gleichen Servern</p>
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <div class="toggle_element security_friends_noone">
                        <p>Niemand</p>
                        <i class="fas fa-toggle-off"></i>
                    </div>
                    <div class="security_messages_title">
                        Wer kann dich anschreiben?
                    </div>
                    <div class="toggle_element security_messages_everyone">
                        <p>Jeder</p>
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <div class="toggle_element security_messages_server">
                        <p>von gleichen Servern</p>
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <div class="toggle_element security_messages_friends">
                        <p>Freunde</p>
                        <i class="fas fa-toggle-on"></i>
                    </div>
                </div>
            </div>

            <!-- The container in which the language settings are -->
            <div id="language">

                <!-- The title of the language settings -->
                <h1>Sprache</h1>

                <!-- The container in which the grid is positioned -->
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

            <!-- The settings on how the app looks -->
            <div id="look">

                <!-- Title of the look-settings -->
                <h1>Aussehen</h1>

                <!-- The container in which the grid is placed -->
                <div class="theme_container">
                    <div class="theme_title">
                        Welches Aussehen willst du?
                    </div>
                    <div onclick='toggleTheme("hell")' class="theme_dark themes">
                        <div class="center">Dunkel</div>
                        Wenn es abend ist,<br>oder du deine Augen schonen willst.
                    </div>
                    <div onclick='toggleTheme("dark")' class="theme_light themes">
                        <div class="center">Hell</div>
                        Entweder du bist verrückt<br>oder hast deine Augen schon verloren.
                    </div>
                    <div class="theme_example">

                    </div>
                </div>
            </div>

            <!-- The settings on accessibility -->
            <div id="access">
                <h1>Barrierefreiheit</h1>

            </div>

            <!-- The area where help can be found -->
            <div id="help">
                <h1>Hilfe</h1>

            </div>

            <!-- The area in which credits of the app are placed -->
            <div id="credits">
                <h1>Danke an</h1>

            </div>
        </div>

        <!-- The list on the left with that is navigated -->
        <div class="list">
            <div class="vertical-menu">
                <a onclick="changeToTab('account')">Account</a>
                <a onclick="changeToTab('privacy')">Privatsph&auml;re</a>
                <a onclick="changeToTab('security')">Sicherheit</a>
                <br>
                <a onclick="changeToTab('language')">Sprache</a>
                <a onclick="changeToTab('look')">Aussehen</a>
                <a onclick="changeToTab('access')">Barrierefreiheit</a>
                <br>
                <a onclick="changeToTab('help')">Hilfe</a>
                <a onclick="changeToTab('credits')">Credits</a>
                <a href="support.html" target="_blank">Support</a>
                <a href="logout.php">Ausloggen</a>
              </div> 
        </div>
    </div>

    <!-- Import all needed scripts -->
    <script src="settings_script.js"></script>
</body>

</html>