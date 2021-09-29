<?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }

	// Database credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'wudsim';

	// Try to connect
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	// On error exit and say
    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    // Get Data from database, because it's not in the session
    $stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
    // Use the account ID to get the account info.
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($password, $email);
    $stmt->fetch();
    $stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="profile_style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="home.php"><i class="fas fa-user-circle"></i>Startseite</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Ausloggen</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>