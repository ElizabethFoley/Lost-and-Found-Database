<!-->
Administator log-out
Date Created: 18 November 2019
-->

<title>Log Out</title>

<?php

// Start Session
session_start();
$_SESSION["loginstatus"]="NOT LOGGED IN";

// Check if session is set
if (isset($_SESSION["loginstatus"]))
	{ $loginstatus=$_SESSION["loginstatus"];}
else
{ $loginstatus="";}

echo "Login Status: $loginstatus <br>";

//Redirect back to "team1.php" after logging out
header("location:/Team1/Team1.php");
?>
