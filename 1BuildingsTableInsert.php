<!--
Inserts the name of the building selected from the lost/found form, into the buildings table.
Date Created: 7 November 2019
!-->

<html>
<title>New Building</title>

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
<h1>New Building Form</h1>

<?php

// Setting variables to ""
$buildingName=$floorNumber="";
$autofocus= array(1=>"",2=>"");
include ("../../connect_db.php");

// Checks if variable is set
if (isset($_POST['buildingName']))
	{$buildingName=$_POST['buildingName'];}
else
  {$floorNumber=NULL;}

if (isset($_POST['floorNumber']))
	{$floorNumber=$_POST['floorNumber'];}
else
	{$floorNumber=NULL;}

// Setting error message to nothing
$errormessage="";

// Validation
// Default message if entries are blank
if($buildingName.$floorNumber == "")
  {echo $errormessage="Welcome to Find-a-Fox! Please enter all fields and hit submit.";
    $autofocus[1]="autofocus";}

// If no building is entered
elseif (empty($_POST['buildingName']))
	{echo $errormessage="Please enter the building name";
	 $autofocus[1]="autofocus";}

// If no floor is entered
elseif($floorNumber==NULL)
  {echo $errormessage="Please enter the floor number";
    $autofocus[2]="autofocus";}

// Special characters
elseif(ctype_alpha($buildingName) == FALSE)
{
  echo $errormessage = "Only alphabetical characters permitted. Please enter a
  valid building name.";
  $autofocus[1]="autofocus";}

else{
  $errormessage =="";
}

$q = "SELECT * FROM 1BUILDINGS WHERE buildingName = '$buildingName'";
$r = mysqli_query($dbc,$q);

if ($errormessage =="")
  { if (mysqli_num_rows($r) <= 0)
        {$errormessage="";}
    else
      {echo $errormessage="That building already exists.";}
  }

// Form
if (($_SERVER['REQUEST_METHOD'] != 'POST') OR ($errormessage != ""))
 {
    echo "<form action='1BuildingsTableInsert.php' method='POST'>";
    echo "<fieldset style='width:500px'>";
    echo "<p> Building Name: <input type='text' name='buildingName' value='$buildingName' ".$autofocus[1]."></p>";
		echo "<p> Floor Number: <input type='number' step='1' name='floorNumber' value='$floorNumber' ".$autofocus[2]."></p>";
    echo "<p><input type='submit'></p>";
    echo "</fieldset>";
    echo "</form>";
 }
// Process form
else
 {
	  echo "Thank you for your submission. ";
    echo "There are ".count($_POST)." elements  in the \$_POST array";


		// Insert query
    $q = "INSERT INTO 1BUILDINGS (buildingName, floorNum)
          VALUES ('$buildingName','$floorNumber')";
    $r = mysqli_query($dbc, $q);

    if ($r == false)
    { echo "DBC Error " . mysqli_error($dbc);
      echo " Unable to insert into the table. Contact support!"; die;
    }

		// Shows what was entered into the table
    echo "<br> Building Table updated; added building: $buildingName,
    floor number: $floorNumber <br><br>";
    echo '<br><button onclick="goBack()">Submit Another Building</button>&nbsp';
 }

?>

<!-- Navigation buttons -->
<a href= "Team1.php"><button>Home Page</button></a>
<a href= "misc.php"><button>Administrator Functions</button></a>

<?php
  echo "<br><br>";
  include "versions.html";
?>
</div>
</html>
