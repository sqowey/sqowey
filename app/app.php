<?php
	// Start the session, to get the data
	session_start();
	// If the user is not logged in redirect to the index-page
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
		header('Location: ./account/index.php');
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
    <!-- Set tab icon -->
    <link rel="icon" href="../contents/icon.svg">
</head>

<body>
    <!-- The container in which the full page is -->
    <div class="container">

        <!-- main area -->
        <div class="main">
            <div id="main">
                <h2>NOCH IM AUFBAU!</h2>
                <p>Welcome back,
                    <?=$_SESSION['displayname']?>!
                </p>
            </div>
        </div>

        <!-- The area where people are listed -->
        <div class="people">
            <i class="plusicon far fa-plus-square"></i>
        </div>

        <!-- The area where servers are listed -->
        <div class="servers">
            <i class="plusicon far fa-plus-square"></i>
        </div>

        <!-- The chat input box -->
        <div class="chat">
            <form action="sendmessage.php" method="post" id="input-box">
                <input name="message" autocomplete="off" placeholder="Nachricht" id="input_field"></input>
            </form>
        </div>

        <!-- The Name thats on the top of the page -->
        <div class="name">
            <div id="actions">
                <i class="fas fa-cog" onclick='location.href = "./settings/settings.php";'></i>
            </div>
            <span>Test</span>
            <div id="personal_actions">
                <i class="fas fa-phone"></i>
                <i class="fas fa-video"></i>
                <i class="fas fa-user-cog"></i>
            </div>
        </div>

        <!-- The channel switcher -->
        <div class="channels">

        </div>

        <!-- The status -->
        <div class="status">
            <span id="online"><i onclick="changeStatus('online');" class="far fa-circle"></i></span>
            <span id="away"><i onclick="changeStatus('away');" class="far fa-circle"></i></span>
            <span id="disturb"><i onclick="changeStatus('disturb');" class="far fa-circle"></i></span>
        </div>
    </div>

    <!-- Get the ajax library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Load all needed scripts -->
    <script src="./app_script.js"></script>
</body>

</html>