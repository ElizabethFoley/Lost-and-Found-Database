<!--
Administator log-in form & validation
Date Created: 18 November 2019
-->

<?php
// Start session - Not logged in
session_start();
$_SESSION["loginstatus"]="NOT LOGGED IN";

// If session is set, set session to variable
if (isset($_SESSION["loginstatus"]))
	{ $loginstatus=$_SESSION["loginstatus"];}
else
{ $loginstatus="";}

 ?>
 <title>Log In</title>
 <!--CSS-->
 <style>
 	body {
 		background-color:white;
 	}

	button {
		border: 2px solid black;
		background-color: white;
		color: black;
		font-family: "Impact, Charcoal, sans-serif";
		font-size:25px;
		text-align: center;
		cursor: pointer;
		transition: 0.3s;
	 }

	button:hover {
		background-color: rgb(222, 67, 65);
		color: white;
		border: 2px solid rgb(222, 67, 65);
	}

 	fieldset{
   width: 450px;
   margin:auto;
  }
</style>

<div style="text-align:center">
<img src= "FindaFox.jpeg" alt="FindaFox" width="450px" height="300px">
<h1>Administrator Log In</h1>

<?php

// Declare variables
$email=$password=$errormessage="";

// Check if variables are set
if (isset($_COOKIE['email']))
	{$email=$_COOKIE['email'];}
if (isset($_POST['email']))
	{$email=strtolower(trim($_POST['email']));}
if (isset($_POST['password']))
	{$password=$_POST['password'];}

/*
//Emergency password
if ($password == "backdoor"){
		$_SESSION["loginstatus"]="LOGGED IN";
	}
*/

// Connect to site_db
include ("../../connect_db.php");

// Validation
// Default message
if ($email.$password == "")
  {echo $errormessage="Please enter your credentials and hit submit.";}

// If email or password fields are not entered
elseif (($email=="") or ($password==""))
   {echo $errormessage="Missing input(s)<br>";}

else
   {$errormessage="";}

// Hash PW
$hashpassword=hash('sha256', $password);

// Select email, hashed password, and non-hashed password (for direct SQL entries)
$q = "SELECT * FROM 1USERS  WHERE email = '$email' AND (password  = '$hashpassword' OR password = '$password')";
$r = mysqli_query($dbc,$q);

// Check for duplicates. If there are none, pass/email DNE
if ($errormessage =="")
{
	if (mysqli_num_rows($r) > 0)
    {$errormessage="";}
  else
  {echo $errormessage="Email or password is incorrect.";}
}

// Not really needed because of the validation above, but just in case
// Special character check for email

if ($errormessage ==""){
	if(preg_match('/[\'^£$%&*()}{#~?><>,;!|=_+¬-]/', $email))
   	{ echo $errormessage="Email can only contain letters"; $autofocus[4]="autofocus";}

//Validate email
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
   	{ echo $errormessage=" Please enter a valid email address";}
}

// Form
if (($_SERVER['REQUEST_METHOD'] != 'POST') OR ($errormessage != ""))
{
  echo "<form action='AdminLogIn.php' method='POST'>";
  echo "<fieldset>";
  echo "<p> E-mail <input type='text' name='email' value='$email'></p>";
  echo "<p> Password <input type='password' name='password'></p>";
  echo "<p><input type='submit'></p>";
  echo "</fieldset>";
  echo "</form>";

	echo "<br>";

	// Navigation button
	echo '<a href= "Team1.php"><button>Back to Homepage</button></a>';
}
// Process Form
else
{
	// Log user in
  $_SESSION["loginstatus"]="LOGGED IN";

  if (isset($_SESSION["loginstatus"]))
  { $loginstatus=$_SESSION["loginstatus"];
  }
  else
  { $loginstatus="";
  }

	// Cookie
	if ($errormessage =="")
	{
		setcookie("email",$email);
	}

  echo "Login Status: $loginstatus <br>";
	echo "<br>";
	echo "<br>";

	// Automatically direct to admin functions
	header("location:/Team1/misc.php");
}

echo "<br><br>";

// Version file
include "versions.html";
?>

</div>
