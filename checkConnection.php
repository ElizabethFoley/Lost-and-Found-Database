<!--
  Checks/verifies database connection
  Date created: 30 September 2019
></!-->

<html lang="en">

<head><meta charset="UTF-8">

<title>Team 1 Check Connection</title>

<!--CSS-->
<style>
  p {
    font-size: 70px;
    color: red;
    font-family: "Impact, Chracoal, sans-serif";
  }

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
</head>

<body>

<div style="text-align:center">
  <img src="FindaFox.jpeg" alt="FindaFox" width= "450px" height= "300px">

  <?php
    // Check connection here
    echo "<h1>Find-a-Fox Checking Connection...</h1>";
    // Connect to site_db
    require ("../../connect_db.php");
    // Good connection
    if (mysqli_ping($dbc))
        {echo "You are connected!";}
  ?>

<br>
<br>

<!-- Navigation Buttons -->
<a href="misc.php"><button>Administrator Functions</button></a>
<a href="Team1.php"><button>Home Page</button></a>

<br>
<br>

</div>

</body>
</html>

<?php
// Versions file
include "versions.html";
?>
