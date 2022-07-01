<?php 
    // Start the PHP_session
    session_start();

	// If the user is not logged in redirect to the index-page
    // Also if the session variable id is unset
	if (!isset($_SESSION['name']) || !isset($_SESSION['loggedin']) || !isset($_SESSION['id'])){
		header('Location: ../../index.html');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sqowey - Account löschen</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/b5c383da68.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- The Container in which the Error output is pasted -->
    <div id="errorOutputContainer">
    </div>

    <form action="deleteaccount.php" method="post">
        <h1>Account löschen</h1>
        <div class="container">
            <div id="account_info">
                Du bist dabei eine Löschungsanfrage für das Konto
                <span id="account_name"><?=$_SESSION['displayname']; ?></span>
                zu stellen.
            </div>
        </div>
        <div class="container">
            Bis wann soll der account gelöscht werden?
            <br><br>
            <select name="time_until_deletion" id="time_until_deletion">
                <option value="0">Jetzt</option>
                <option value="30">1 Monat</option>
                <option value="60" selected>2 Monate</option>
                <option value="365">1 Jahr</option>
            </select>
        </div>
        <div class="container">
            Sicherheitsabfrage:
            <br> Wie lautet das Accountpasswort?
            <br><br>
            <input type="password" name="password" id="password">
        </div>
        <div class="container">
            Löschen
            <br><br>
            <div id="deletion_text"></div>
            <input type="submit" name="delete" id="submit_button" value="Account löschen">
        </div>
    </form>
    <script src="./script.js"></script>

</body>

</html>