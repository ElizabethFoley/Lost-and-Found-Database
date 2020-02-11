<!--
  Administrator functions:
  links to check connection page, table page, functional diagram,
  display tables, users table & form, buildings table & form, items table
  & form, versions table & form, lost items, found items, matched items,
  log out button
  Date created: 30 September 2019
></!-->

<?php

// Start session
session_start();
 if (isset($_SESSION["loginstatus"]))
 { $loginstatus=$_SESSION["loginstatus"];
 }
 else
 { $loginstatus="";
 }
 ?>

<html lang="en">
<head><meta charset="UTF-8">

 <title>Team 1 Admin Functions</title>

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

 .button2{
   border: 2px solid black;
   background-color: white;
   color: black;
   font-family: "Impact, Charcoal, sans-serif";
   font-size:20px;
   text-align: center;
   cursor: pointer;
   transition: 0.3s;
   width: 300px;
 }

 .button2:hover{
   background-color: white;
   color: rgb(222, 67, 65);
   border: 2px solid rgb(222, 67, 65);
 }

 .logout{
   border: 3px solid black;
   background-color: white;
   color: black;
   font-family: "Impact, Charcoal, sans-serif";
   font-size:25px;
   text-align: center;
   cursor: pointer;
   transition: 0.3s;
   font-weight: bold;
 }

 .logout:hover{
   background-color: rgb(222, 67, 65);
   color: white;
   border: 3px solid rgb(222, 67, 65);
 }
</style>

<body>

<div style="text-align:center">
<img src="FindaFox.jpeg" alt="FindaFox" width= "450px" height= "300px">
<h1> Administrator Functions </h1>

<!-- Links/buttons to individual tables -->

<!-- Home Page -->
<a href="team1.php"><button>Home Page</button></a>
<!-- Check Connection -->
<a href="checkConnection.php"><button>Check Connection</button></a>
<!-- Table Structures -->
<a href="Team1Tables.php"><button>Table Structures</button></a>
<!-- Functional Diagram -->
<a href="FunctionalDiagram.php"><button>Functional Diagram</button></a>

<br>
<br>
<br>

<!-- User Table -->
<a href="DisplayOptions.php?Table=1USERS"><button class="button2">User Table</button></a>
<!-- User Table Form -->
<a href="1UsersTableInsert.php"><button class="button2">New User</button></a><br><br>
<!-- Buildings Table -->
<a href="DisplayOptions.php?Table=1BUILDINGS"><button class="button2">Building Table</button></a>
<!-- Buildings Table Form-->
<a href="1BuildingsTableInsert.php"><button class="button2">New Building</button></a><br><br>
<!-- Items Table -->
<a href="DisplayOptions.php?Table=1ITEMS"><button class="button2">Item Table</button></a>
<!-- Items Table Form -->
<a href="1ItemsTableInsert.php"><button class="button2">New Item</button></a><br><br>
<!-- Versions Table -->
<a href="DisplayOptions.php?Table=1VERSIONS"><button class="button2">Version Table</button></a>
<!-- Versions Table Form -->
<a href="1VersionsTableInsert.php"><button class="button2">New Version</button></a><br><br><br><br>
<!-- Status: Lost Items Table -->
<a href="ItemStatus.php?status=Item lost"><button class="button2">Lost Items</button></a>
<!-- Status: Found Items Table -->
<a href="ItemStatus.php?status=Item Found"><button class="button2">Found Items</button></a><br><br>
<!-- Status: Matched Items Table -->
<a href="ItemStatus.php?status=Item Matched"><button class="button2">Matched Items</button></a><br><br>

<br>
<!-- Log Out -->
<a href= "AdminLogOut.php"><button class="logout">Log Out</button></a>
</div>

<br>

</body>

<?php
// Versions file
include "versions.html";
?>
