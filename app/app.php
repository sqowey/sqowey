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
        <div id="topbar">
            <div>
                <h1>Wudsim</h1>
                <a href="profile.php"><i class="fas fa-user-circle"></i>Profil</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Ausloggen</a>
            </div>
        </div>
        <div id="main">
            <h2>NOCH IM AUFBAU!</h2>
            <p>Welcome back,
                <?=$_SESSION['name']?>!</p>
        </div>
        <div id="navigation">

        </div>
        <div id="statussetter">
            <span id="online">&SmallCircle;</span>
            <span id="away">&SmallCircle;</span>
            <span id="notDisturb">&SmallCircle;</span>
        </div>
    </body>

    </html>