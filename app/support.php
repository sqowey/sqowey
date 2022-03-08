<?php
// The login credentials of the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sqowey";

// Get the form values
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

// prepare the sql statement
$sql = "INSERT INTO support (fehlercode, titel, email, problem, sonstiges)
VALUES ('".$errorcode."', '".$title."', '".$mail."', '".$problem."', '".$sonstige."')";

// run the mysql query
if (mysqli_query($conn, $sql)) {
    header('Location: support.php?message=Dein Supportticket<br>wurde erfolgreich erstellt.');
} else {
    header('Location: support.php?message=Fehler mit<br>der Datenbank!');
}

// close the database-connection
mysqli_close($conn);
?> 