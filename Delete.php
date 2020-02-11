<!--
  Delete row from table
  Date created: 26 November 2019
></!-->

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

<div align = "center">

<?php

// Declare variables
$primaryID=$TableName=$errormessage="";

// Check if variables are set
if(isset($_GET['primaryID']))
{
	$primaryID=$_GET['primaryID'];
}
else {
	echo $errormessage .= " No primary ID passed.";
}

// Connect to site_db
include ("../../connect_db.php");

// Check if variables are set
if(isset($_GET['TableName']))
{
	$TableName=$_GET['TableName'];
}
else {
	echo $errormessage .= " No passed table.";
}

// Setting $col to each tables' primary key
$col = "";
if($TableName == "1USERS")
{$col = "cwid";}
elseif($TableName == "1ITEMS")
{$col = "id";}
elseif($TableName == "1BUILDINGS")
{$col = "buildingID";}
elseif($TableName == "1VERSIONS")
{$col = "version";}

// Delete query
 $q = "DELETE FROM $TableName WHERE $col = '$primaryID'";
 $r = mysqli_query($dbc, $q);

// Confirmation message, Nav buttons, Error check
if($r != false)
{
	echo '<img src= "FindaFox.jpeg" alt="FindaFox" width="450px" height="300px"><br>';
	echo "Deleted $primaryID from $col in table $TableName.";
	echo "<br><br><br>";
	echo '<a href="team1.php"><button>Home Page</button></a>&nbsp';
	echo '<a href="misc.php"><button>Administrator Functions</button></a>&nbsp';
	echo '<button onclick="goBack()">Go Back</button>';
}
else{
	echo "DBC Error ".mysqli_error($dbc);
}
?>
</div>
