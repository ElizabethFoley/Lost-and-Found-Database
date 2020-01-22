<!--
Inserts new user into Users table.
Date Created: 4 November 2019
-->

<html>
<title>New User</title>
 <!--CSS-->
<style>
  body {
          background-color: white;
    }

  p {
    font-family: "Impact, Charcoal, sans-serif";
    color: black;
    font-size: 17px;
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
</style>

<script>
  // Back button in JS
	function goBack() {
  window.history.back();
	}
</script>

<div align="center">
<img src= "FindaFox.jpeg" alt="FindaFox" width="450px" height="300px"><br>
<h1>New User Form</h1>

<?php

// Connect to database
include ("../../connect_db.php");

// Setting variables = "", autofocus variable, error message variable
$fname=$lname=$cwid=$email=$password="";
$autofocus= array(1=>"",2=>"", 3=>"", 4=>"", 5=>"");
$errormessage="";

// Making sure variables are set
if (isset($_POST['fname']))
	{$fname=$_POST['fname'];}
if (isset($_POST['lname']))
	{$lname=$_POST['lname'];}
if (isset($_POST['cwid']))
	{$cwid=$_POST['cwid'];}
if (isset($_POST['email']))
	{$email=$_POST['email'];}
if (isset($_POST['password']))
	{$password=$_POST['password'];}

// Validation
// Default message
if ($fname.$lname.$cwid.$email.$password == "")
  {echo $errormessage="Please enter all fields and hit submit.";
	 $autofocus[1]="autofocus";}

// If first name is not entered
elseif (empty($_POST['fname']))
   { echo $errormessage="Enter the first name";
     $autofocus[1]="autofocus";}

// Special character check for first name
elseif (ctype_alpha($fname) == false)
   { echo $errormessage="First name can only contain letters";
     $autofocus[1]="autofocus";}

// If last name is not entered
elseif (empty($_POST['lname']))
   { echo $errormessage="Enter the last name";
     $autofocus[2]="autofocus";}

// Special character check for last name
elseif (ctype_alpha($lname) == false)
  { echo $errormessage="Last name can only contain letters";
    $autofocus[2]="autofocus";}

// If CWID is not entered
elseif (empty($_POST['cwid']))
   { echo $errormessage="Enter the cwid";
     $autofocus[3]="autofocus";}

// Special character check for CWID
elseif (ctype_digit($cwid) == false)
   { echo $errormessage="CWID can only contain numbers";
     $autofocus[3]="autofocus";}

// If email is not entered
elseif (empty($_POST['email']))
   { echo $errormessage="Enter the email address";
     $autofocus[4]="autofocus";}

// Special character check for email
elseif (preg_match('/[\'^£$%&*()}{#~?><>,;!|=_+¬-]/', $email))
   { echo $errormessage="Email can only contain letters"; $autofocus[4]="autofocus";}

//Validate email
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
   { echo $errormessage="Please enter a valid email address";}


// If password is not entered
elseif (empty($_POST['password']))
   { echo $errormessage="Enter the password";
     $autofocus[5]="autofocus";}

else{
     $errormessage =="";
   }

// Check for duplicate emails
$q = "SELECT * FROM 1USERS WHERE email = '$email'";
$r = mysqli_query($dbc,$q);

if ($errormessage =="")
  { if (mysqli_num_rows($r) <= 0)
      {$errormessage="";}
else
  {echo $errormessage="That email already exists.";}
  }

// Check for duplicate CWIDs
$q = "SELECT * FROM 1USERS WHERE cwid = '$cwid'";
$r = mysqli_query($dbc,$q);

if ($errormessage =="")
  { if (mysqli_num_rows($r) <= 0)
      {$errormessage="";}
else
  {echo $errormessage="CWID already exists.";}
  }

// Display form
if (($_SERVER['REQUEST_METHOD'] != 'POST') OR ($errormessage<>""))
 {
	echo "<form action='1UsersTableInsert.php' method='POST'>";
 	echo "<fieldset style='width:500px'>";

 	echo "<p> First Name <input type='text' name='fname' value='$fname' ".$autofocus[1]."></p>";
 	echo "<p> Last Name <input type='text' name='lname' value='$lname' ".$autofocus[2]."></p>";
 	echo "<p> CWID <input type='text' name='cwid' value='$cwid' ".$autofocus[3]."></p>";
	echo "<p> Email Address <input type='email' name='email' value='$email' ".$autofocus[4]."></p>";
  echo "<p> Password <input type='password' name='password' value='$password' ".$autofocus[5]."></p>";
 	echo "<p><input type='submit'></p>";

 	echo "</fieldset>";
 	echo "</form>";
 }

// Process Form
else
 {
   // Protect Password
   $password=hash('sha256', $password);
   $email = strtolower($_POST['email']);

  // Insert query
  $q = "INSERT INTO 1USERS (fname, lname, cwid, email, password)
        VALUES ('$fname','$lname',$cwid, '$email', '$password')";
  $r = mysqli_query($dbc, $q );

  // Error check
  if ($r == false)
    { echo "DBC Error " . mysqli_error($dbc);
      echo "Unable to insert into the table. Contact support!"; die;
    }

  echo "<br> New user added: $fname $lname!<br>";
  echo '<br><button onclick="goBack()">Create Another User</button>&nbsp';

}

?>

<!-- Navigation buttons -->
<a href= "Team1.php"><button>Home Page</button></a>
<a href= "misc.php"><button>Administrator Functions</button></a>

<?php
  echo "<br><br>";
  include "versions.html";
?>
</html>
