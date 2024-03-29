<?php 

    // 
    // Check if there is no db entry
    // 

    // Start the session, to get the data
    session_start();

    // Get the database login-credentials
    require("../config.php");
    
    // Try to Connect with credentials
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'sqowey');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the data from the database
    if ($stmt = $con->prepare('INSERT IGNORE INTO `settings` SET user_id = ?')) {

        // Bind the variables to the parameter
        $stmt->bind_param('s', $_SESSION['id']);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sqowey - Settings</title>
    <link rel="stylesheet" href="settings_style.css">
    <script src="https://kit.fontawesome.com/b5c383da68.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Close icon -->
    <div class="close-icon" onclick="closeSettings();">
        <i class="fa-solid fa-square-xmark"></i>
    </div>


    <!-- Container for outputting messages -->
    <div id="output_message">
    </div>

    <div class="container">
        <div id="name" class="user">
            <div class="icon" id="avatar_left_top">
                <img src="">
            </div>
            <div id="name_field" class="name">

            </div>
            <div id="email_field" class="email">

            </div>
        </div>
        <div class="tabs">
            <ul>
                <a href="#account">
                    <li>
                        <i class="fa-solid fa-user-gear"></i> Account
                    </li>
                </a>
                <a href="#security">
                    <li>
                        <i class="fa-solid fa-shield-halved"></i> Sicherheit
                    </li>
                </a>
                <a href="#privacy">
                    <li>
                        <i class="fa-solid fa-user-secret"></i> Privatsphäre
                    </li>
                </a>
                <a href="#language">
                    <li>
                        <i class="fa-solid fa-language"></i> Sprache
                    </li>
                </a>
                <a href="#appearance">
                    <li>
                        <i class="fa-solid fa-circle-half-stroke"></i> Aussehen
                    </li>
                </a>
                <a href="#help">
                    <li>
                        <i class="fa-solid fa-question-circle"></i> Hilfe
                    </li>
                </a>
                <a href="#infos">
                    <li>
                        <i class="fa-solid fa-info-circle"></i> Weitere Infos
                    </li>
                </a>
            </ul>

        </div>
        <div class="settings">
            <div id="account">
                <h1>Account</h1>
                <div class="settings_details">
                    <form action="./scripts/setaccount.php" method="post">
                        <h3>Email</h3>
                        <input class="account_form_inputs" id="account_settings_mail" type="text" name="email" value="" disabled>
                        <h3>Benutzername</h3>
                        <input class="account_form_inputs" id="account_settings_username" type="text" name="username" value="" disabled>
                        <h3>Telefonnummer</h3>
                        <input class="account_form_inputs" id="account_settings_phone" type="text" name="phone" value="" disabled>
                        <br><br>
                        <input class="form_submit" type="submit" value="Speichern" id="account_settings_submit">
                    </form>
                    <button class="form_submit" id="account_settings_change" onclick="editFormAccounts();">Ändern</button>
                    <h3>Avatar</h3>
                    <div class="avatar_container">
                        <div class="avatar_image">
                            <img id="account_settings_avatar" src="">
                        </div>
                        <form action="./scripts/setavatar.php" method="post" id="avatar_upload_form" enctype="multipart/form-data">
                            <div class="avatar_upload">
                                <div>
                                    <input type="file" name="avatar_upload" id="account_settings_avatar_file" accept="image/*">
                                    <input class="form_submit" type="submit" value="Speichern" id="account_settings_avatar_submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="security">
                <h1>Sicherheit</h1>
                <div class="settings_details">
                    <h3>Passwort</h3>
                    <button onclick="open_pw_change();" class="warning_button">Passwort ändern</button>
                    <div id="pw_change">
                        <form action="./scripts/setpassword.php" method="post">
                            <input type="password" name="old_pw" placeholder="Altes Passwort"><br>
                            <input type="password" name="new_pw" placeholder="Neues Passwort"><br>
                            <input type="password" name="new_pw_repeat" placeholder="Neues Passwort wiederholen"><br>
                            <input type="submit" value="Passwort ändern">
                        </form>
                    </div>
                    <h3>Account löschen</h3>
                    <button onclick="window.open('./deleteaccount/','_blank')" class="warning_button">Account löschen</button>
                </div>
            </div>
            <div id="privacy">
                <h1>Privatsphäre</h1>
                <div class="settings_details">
                    <h3>Direktnachrichten</h3>
                    <button class="settings_button" onclick="switch_button(this);push_privacy();" id="privacy_server_dms">Direktnachrichten von Freunden erlauben</button>
                    <br>
                    <br>
                    <button class="settings_button" onclick="switch_button(this);push_privacy();" id="privacy_all_dms">Direktnachrichten von allen erlauben</button>
                    <br>
                    <h3>Freundschaftsanfragen</h3>
                    <button class="settings_button" onclick="switch_button(this);push_privacy();" id="privacy_server_friends">Freundschaftsanfragen von servermitgliedern erlauben</button>
                    <br>
                    <br>
                    <button class="settings_button" onclick="switch_button(this);push_privacy();" id="privacy_all_friends">Freundschaftsanfragen von allen erlauben</button>
                    <br>
                </div>
            </div>
            <div id="language">
                <h1>Sprache</h1>
                <div class="settings_details">
                    <h3>Sprache wählen</h3>
                    <button class="language_button" id="lang_button_de" onclick="set_lang('de');">
                        Deutsch
                    </button>
                    <button class="language_button" id="lang_button_en" onclick="set_lang('en');">
                        English
                    </button>
                    <button class="language_button" id="lang_button_fr" onclick="set_lang('fr');">
                        French
                    </button>
                    <button class="language_button" id="lang_button_it" onclick="set_lang('it');">
                        Italiano
                    </button>
                </div>
            </div>
            <div id="appearance">
                <h1>Aussehen</h1>
                <div class="settings_details">
                    <h3>Theme</h3>
                    <button class="appearance_theme_button theme_button_light" id="theme_button_light" onclick="change_theme(1)">
                        Hell
                    </button>
                    <button class="appearance_theme_button theme_button_dark" id="theme_button_dark" onclick="change_theme(0)">
                        Dunkel
                    </button>
                </div>
            </div>
            <div id="help">
                <h1>Hilfe</h1>
                <div class="settings_details">
                    <h3>Hilfe</h3>
                    <p>
                        <a href="../../misc/support/support.html">Hier</a> kannst du Hilfe bekommen, wenn du Hilfe brauchst.
                    </p>
                    <h3>Feedback</h3>
                    <p>
                        Feedback kannst du <a href="../../misc/support/support.html">hier unter "Sonstige"</a> abschicken!
                    </p>
                    <h3>Dokumentation</h3>
                    <p>
                        <a onclick="alert('Kommt bald!')">Hier</a> findest du die Dokumentation für Entwickler
                    </p>
                </div>
            </div>
            <div id="infos">
                <h1>Weitere Informationen</h1>
                <div class="settings_details">
                    <h3>Version</h3>
                    <p>
                        Beta 0.0.4
                    </p>
                    <h3>Changelogs</h3>
                    <button onclick="open_changelogs();" id="open_changelog_button">
                        Open changelogs
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Get the ajax library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Get all other scripts -->
    <script src="./message_script.js"></script>
    <script src="./scripts/getaccount.js"></script>
    <script src="./scripts/getprivacy.js"></script>
    <script src="./scripts/getlanguage.js"></script>
    <!-- <script src="./scripts/setaccount.js"></script> -->
    <script src="./scripts/setprivacy.js"></script>
    <script src="./scripts/setlanguage.js"></script>
    <script src="./scripts/setappearance.js"></script>
    <script src="./scripts/setavatar.js"></script>
    <script src="./settings_script.js"></script>
</body>

</html>