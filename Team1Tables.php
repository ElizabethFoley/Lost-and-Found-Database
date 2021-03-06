                      <!--
 Connects to site_db where our tables are stored. In this file,
 we use PHP & SQL commands to display the tables in our database. T
 Date Created: 7 October 2019
></!-->

<html lang="en">
<head><meta charset="UTF-8">

<title> Team 1 Tables </title>

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

</head>

<div style="text-align:center">
  <img src="FindaFox.jpeg" alt="FindaFox" width= "450px" height= "300px">
</div>

<div style="text-align:center">
  <!-- Navigation Buttons -->
  <a href="team1.php"><button>Home Page</button></a>
  <a href= "misc.php"><button>Administrator Functions</button></a>
</div>

<body>

<?php

echo "<h1 align='center'> Team 1 Tables </h1>";

// Versions file
include "versions.html";

// Connect to site_db
require("../../connect_db.php");

// Declare array
$tables=array('1USERS','1BUILDINGS', '1ITEMS', '1VERSIONS');
$count=count($tables);
{
  for($i=0; $i<$count; $i++)
  {
    // Call Function
    display_table($tables[$i], $count, $dbc);
  }
}

// Function
function display_table($table, $count, $dbc)
{
  echo "<table align='center'>";
  echo "<tr>";
  echo "<th> $table </th>";
  echo "</t>";

  // Explain query
  $q = 'EXPLAIN '.$table.";";
  $r2 = mysqli_query($dbc, $q);

  if($r2)
  {
    echo "<ul>";

    // Header
    echo "<table border=1 align='center' layout='fixed'>";
    echo "<tr>";
    echo "<th>Field</th>";
    echo "<th>Type</th>";
    echo "<th>Null</th>";
    echo "<th>Key</th>";
    echo "</tr>";


    // Display table
    while($row2 = mysqli_fetch_array($r2, MYSQLI_BOTH ))
    {
      echo '<tr>';
      for($i=0; $i<$count; $i++)
      {
        echo '<td>'.$row2[$i].'</td>';
      }
      echo '</t>';
      echo "</ul>";
    }
  }
else
  {
      // Error message
      echo '<li>'.mysqli_error($dbc).'</li>';
  }
}

?>
</body>
</html>
