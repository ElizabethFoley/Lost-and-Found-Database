<!--T
Insert item name into the Items table.
Date created: 4 November 2019
></!-->

<?php
// Start session - Not logged in
session_start();
 if (isset($_SESSION["loginstatus"]))
 { $loginstatus=$_SESSION["loginstatus"];
 }
 else
 { $loginstatus="";
 }
 ?>

<html>
<title>New Item</title>

 <!--CSS-->
<style>
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
<h1>Lost/Found Item Form</h1>

<?php

// Connect to site_db
include ("../../connect_db.php");

echo "<form action='" . $_SERVER['SCRIPT_NAME'] . "' method='POST'>";

// Autofocus array
$autofocus = array(1=>"",2=>"", 3=>"", 4=>"", 5=>"");
$checked = array(1=>"",2=>"");

// Declare variables
$itemName=$building=$description=$status=$fname=$lname=$cwid=$email="";

// Check if variables are set
if (isset($_POST['itemName']))
	{$itemName=strtolower($_POST['itemName']);}
if (isset($_POST['building']))
	{$building=$_POST['building'];}
if (isset($_POST['description']))
	{$description=$_POST['description'];}
if (isset($_POST['status']))
 {$status=$_POST['status'];}
if (isset($_POST['fname']))
 	{$fname=$_POST['fname'];}
if (isset($_POST['lname']))
 	{$lname=$_POST['lname'];}
if (isset($_POST['cwid']))
 	{$cwid=$_POST['cwid'];}
if (isset($_POST['email']))
 	{$email=$_POST['email'];}


$errormessage="";

// Validation
// Default error message
if ($itemName.$building.$description.$status.$fname.$lname.$cwid.$email == "")
  { $errormessage="Welcome to Find-a-Fox! Please enter all fields and hit submit"; $autofocus[1]="autofocus";}

// If first name is not entered
elseif (empty($_POST['fname']))
  { $errormessage="Enter the first name";
    $autofocus[2]="autofocus";}

// Special character check for first name
elseif (ctype_alpha($fname) == false)
  { $errormessage="First name can only contain letters";
    $autofocus[2]="autofocus";}

// If last name is not entered
elseif (empty($_POST['lname']))
  { $errormessage="Enter the last name";
    $autofocus[3]="autofocus";}

// Special character check for last name
elseif (ctype_alpha($lname) == false)
  { $errormessage="Last name can only contain letters";
    $autofocus[3]="autofocus";}

// If CWID is not entered
elseif (empty($_POST['cwid']))
  { $errormessage="Enter your CWID";
    $autofocus[4]="autofocus";}

// Special character check for CWID
elseif (ctype_digit($cwid) == false)
  { $errormessage="CWID can only contain numbers";
    $autofocus[4]="autofocus";}

// If email is not entered
elseif (empty($_POST['email']))
  { $errormessage="Enter the email address";
    $autofocus[5]="autofocus";}

// Special character check for email
elseif (preg_match('/[\'^£$%&*()}{#~?><>,;!|=_+¬-]/', $email))
  { $errormessage="Email can only contain letters"; $autofocus[5]="autofocus";}

//Validate email
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
  { $errormessage="Please enter a valid email address"; $autofocus[5]="autofocus";}

// Item name not entered
elseif ($itemName=="")
  { $errormessage="Enter the item name";
    $autofocus[1]="autofocus";}

// Item Name scpecial character check
elseif (ctype_alpha($itemName) == false)
  { $errormessage="Item Name can only contain letters (no whitespaces).";
    $autofocus[1]="autofocus";}

// Building not selected
else if (empty($_POST['building']) OR ($building=="--Select--") OR ($building=="Array"))
  { $errormessage = "<br>Please Select a Building</br>";}

// Description not entered
elseif ($description=="")
  { $errormessage="Enter a description of the item";}

// Description special character check
elseif (preg_match('/[\'^£$%&*()}{@#~?><>!|=_+¬-]/', $description))
  { $errormessage="Description can only contain letters, basic punctuation, and whitespace";}

// Status not selected
elseif (empty($_POST['status']))
  { $errormessage="Select the status (lost or found)";}

// Error message
if ($errormessage!="")
  {echo $errormessage;}

//Form
if (($_SERVER['REQUEST_METHOD'] != 'POST') OR ($errormessage<>""))
  {
    $q = "SELECT buildingName FROM 1BUILDINGS";
    $r = mysqli_query($dbc, $q);

    // element = 0, get building names from Buildings Table
    while($row = mysqli_fetch_array($r, MYSQLI_NUM))
     { $selectBuilding[]=$row[0];
     }

    echo "<form action ='1ItemsTableInsert.php' method='POST'>";
    echo "<fieldset style='width:500px'>";

    echo "<p> First Name <input type='text' name='fname' value='$fname' ".$autofocus[2]."></p>";
    echo "<p> Last Name <input type='text' name='lname' value='$lname' ".$autofocus[3]."></p>";
    echo "<p> CWID <input type='text' name='cwid' value='$cwid' ".$autofocus[4]."></p>";
    echo "<p> Email Address <input type='email' name='email' value='$email' ".$autofocus[5]."></p>";

    echo "<p> Item Name <input type ='text' name='itemName' value='$itemName'
              maxlength=20 size=20 " . $autofocus[1] . "></p>";


    echo "<p> Select Building <select name='building'></p>";
    echo "<option value = '$selectBuilding'>--Select--</option>";
    // Display passed buildings in select drop down
    for ($i=0;$i<count($selectBuilding);$i++)
    {	 echo "<option value='" . $selectBuilding[$i] . "'>"
           . $selectBuilding[$i] ."</option>";
    }

    echo "</select></p>";


    echo "<p> Item Description <br><textarea name='description' rows='2' cols='25' value='$description'
                maxlength=80 size=80></textarea></p>";

    echo "<p> Status of Item (lost/found) <br>
    	        <input type='radio' name='status' value='Item lost' $checked[1]>lost<br>
              <input type='radio' name='status' value='Item found' $checked[2] >found<br></p>";

    echo "<input type='submit'>";
    echo "</fieldset>";
    echo "</form>";
    }

// Process Form
else
  {
    $date = date("Y-m-d H:i:s");
    $building=trim($_POST['building']);

    // Insert query
    $q = "INSERT INTO 1ITEMS (email, fName, lName, CWID, itemName, building, description, date_regItem, status)
        VALUES ('$email', '$fname', '$lname', '$cwid', '$itemName','$building','$description', '$date','$status')";
    $r = mysqli_query($dbc, $q);

    //DBC error
    if ($r == false)
      { echo "DBC Error " . mysqli_error($dbc);
        echo "Unable to insert into the table. Contact support!"; die;
      }

    echo "<br>Thank you for your submission! $itemName has been added to the lost and found.<br>";
    echo '<br><button onclick="goBack()">Submit Another Item</button>&nbsp';
  }
echo '<a href= "Team1.php"><button>Home Page</button></a>&nbsp';

if($loginstatus=="LOGGED IN")
  {echo '<a href= "misc.php"><button>Administrator Functions</button></a>';}

echo "<br>";
echo "<br>";
include "versions.html";
?>
</div>
</html>
