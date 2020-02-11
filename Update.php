<!--
  Update status and matchedID fields in Item Table
  Date created: 27 November 2019
></!-->

<html lang="en">
<head><meta charset="UTF-8">

<title>Team 1 Update</title>

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
</style>

<div align = "center">
<img src= "FindaFox.jpeg" alt="FindaFox" width="450px" height="300px"><br>

<?php

// Declare variables
$id1=$id2=$matchedID=$errormessage="";

// Check if variables are set
if (isset($_POST['id1']))
{
  $id1=$_POST['id1'];
  echo $id1;
}
if (isset($_POST['id2']))
{
  $id2=$_POST['id2'];
}
if (isset($_POST['$matchedID']))
{
  $matchedID=$_POST['$matchedID'];
}

include ("../../connect_db.php");

echo "<h1>Update Item Form</h1>";

if (($_SERVER['REQUEST_METHOD'] != 'POST') OR ($errormessage != ""))
{
  echo "<form action='Update.php' method='POST'>";
  echo "<fieldset style='width:500px'>";
  echo "<p> ID 1: <input type='text' name='id1' value='$id1'></p>";
  echo "<p> ID 2: <input type='text' name='id2' value='$id2'></p>";
  echo "<p><input type='submit'></p>";
  echo "</fieldset>";
  echo "</form>";

}
else{
  $date = date("Y-m-d H:i:s");


  $q = "UPDATE 1ITEMS SET matchedID = '$date', status = 'Item matched' WHERE id = '$id1' OR id = '$id2'";
  $r = mysqli_query($dbc, $q );

echo $q;

  if ($r == false)
    { echo "DBC Error " . mysqli_error($dbc);
      echo "Unable to insert into the table."; die;
    }


}
?>

<br>
<a href="team1.php"><button>Home Page</button></a>
<a href="misc.php"><button>Administrator Functions</button></a>
<br>
<br>
<?php include "versions.html"; ?>
</div>
</html>
