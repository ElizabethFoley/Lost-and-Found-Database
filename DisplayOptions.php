<!--
  Displays the contents of user, buildings, items, and version tables in site_db
  Date created: 30 October 2019
></!-->

<html lang="en">
<head><meta charset="UTF-8">

<title>Team 1 Display Individual Tables</title>

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

  .button{
    border: 1px solid black;
    background-color: white;
    color: black;
    font-family: "Impact, Charcoal, sans-serif";
    font-size:16px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
}

.button:hover{
  background-color: white;
  color: rgb(222, 67, 65);
  border: 1px solid rgb(222, 67, 65);
}
</style>

<div align = "center">
<img src= "FindaFox.jpeg" alt="FindaFox" width="450px" height="300px"><br>

<?php
// Declare variable
$TableName=$_GET["Table"];

echo "<h1 align='center'> $TableName Table </h1>";

// Connect to site_db
require("../../connect_db.php");

echo "<table align='center'>";
echo "<th> $TableName </th>";

if(mysqli_ping($dbc))
{
    $TableName=$_GET["Table"];
    echo "<table border=1 align='center' layout='fixed'>";
    $q = 'EXPLAIN '.$TableName.";";
    $r = mysqli_query($dbc, $q);

    // Header
    while ($row2 = mysqli_fetch_array($r, MYSQLI_NUM))
    {
      echo '<th>'.$row2[0].'</th>';
    }
    echo '<tr>';

    // Select query
    $q2 = 'SELECT * FROM '.$TableName.";";
    $r2 = mysqli_query($dbc, $q2);

    // Display contents of tables
    while($row = mysqli_fetch_array($r2, MYSQLI_NUM))
    {
      $columns=array_keys($row);
      $column_qty=count($columns);

    for($x = 0; $x<$column_qty; $x++)
    {
      echo'<td>'.$row[$x].'</td>';

    }

  // Delete button, passed through Delete.php
  echo "<td> <a href='Delete.php?primaryID=".$row[0]."&TableName=".$TableName."'class='button'> DELETE </a>" . "</td>";
  // Update button, passed through Update.php
  if ($TableName == '1ITEMS'){
    echo "<td> <a href='Update.php?primaryID=".$row[0]."&TableName=".$TableName."'class='button'> UPDATE </a>" . "</td>";
  }

  echo "</tr>";
  }
  echo"</table>";
  }
  else
    {
      // Error check
      echo '<li>'.mysqli_error($dbc).'</li>';
    }
?>
<br>

<!-- Navigation Buttons -->
<a href="team1.php"><button>Home Page</button></a>
<a href="misc.php"><button>Administrator Functions</button></a>

<br>
<br>
</div>

<?php
// Version file
include "versions.html";
?>
