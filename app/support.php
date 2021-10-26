<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wudsim";

$errorcode = $_POST["errorcode"];
$title = $_POST["title"];
$mail = $_POST["mail"];
$problem = $_POST["problem"];
$sonstige = $_POST["sonstige"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO support (fehlercode, titel, email, problem, sonstiges)
VALUES ('".$errorcode."', '".$title."', '".$mail."', '".$problem."', '".$sonstige."')";

if (mysqli_query($conn, $sql)) {
    header('Location: message.html?error=%22Dein%20Supportticket%20wurde%20erfolgreich%20erstellt!%22&showReportButton=false');
} else {
    header('Location: message.html?error=%22Fehler%20mit%20der%20Datenbank%22');
}

mysqli_close($conn);
?> 