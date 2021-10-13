<?php
	// Start the session, to get the data
	session_start();
	// If the user is not logged in redirect to the index-page
	if (!isset($_SESSION['loggedin'])) {
		header('Location: index.html');
		exit;
	}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link href="app_style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body>
    <div class="container">
        <div class="main">
            <div id="main">
                <h2>NOCH IM AUFBAU!</h2>
                <p>Welcome back,
                    <?=$_SESSION['name']?>!
                </p>
            </div>
        </div>
        <div class="people"></div>
        <div class="servers"></div>
        <div class="chat">
            <div id="input-box">
                <input placeholder="Nachricht" id="input_field"></input>
            </div>
        </div>
        <div class="name"></div>
        <div class="channels"></div>
        <div class="status">
            <span id="online"><i class="fas fa-bullseye"></i></span>
            <span id="away"><i class="fas fa-bullseye"></i></span>
            <span id="notDisturb"><i class="fas fa-bullseye"></i></span>
        </div>
    </div>
    <!-- <div id="topbar">
        <div>
            <h1>Wudsim</h1>
            <a href="profile.php"><i class="fas fa-user-circle"></i>Profil</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Ausloggen</a>
        </div>
    </div>
    -->
</body>

</html>