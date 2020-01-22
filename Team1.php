<!--
  Home page:
  links to user report lost/found form, admin log in/admin functions
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

<title>Team 1 Home Page</title>

<!--CSS-->
<style>
  body {
    background-color: white;
  }

  p {
    font-family: "Impact, Charcoal, sans-serif";
    color: white;
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

   table {
     font-size:18px;
     font-family: "Impact, Charcoal, sans-serif";
     color:black;
     border-style: ridge;
  }
</style>
<!--
// Icons!
<script src='https://kit.fontawesome.com/a076d05399.js'></script>-->
</head>

<body>

<div style="text-align:center">
  <img src= "FindaFox.jpeg" alt="FindaFox" width="450px" height="300px">
  <h1>Marist College Lost & Found Database</h1>
</div>

<br>

<table border=solid; align="center";>
  <tr>
    <!-- Welcomeing message/instructions, contact info -->
    <td align= "center" width="500px" height="200px">
      Welcome to Find-a-Fox: An online lost and
      found website for Marist students! Report a lost or found item
      by clicking on the "Report a Lost/Found Item" button. Administrators,
      log in via the "Administrator Log In" button.
      <br>
      <br>
      For any questions or concerns, please contact:
      <br>
      Anton Sachs, Anton.Sachs1@marist.edu
      <br>
      Calista Phippen, Calista.Phippen1@marist.edu
      <br>
      Elizabeth Foley, Elizabeth.Foley1@marist.edu
    </td>
  </tr>
</table>
<br>
<br>

<div style="text-align:center">

<?php
  // Navigation buttons
  echo '<div style="text-align:center">';
  echo '<a href="1ItemsTableInsert.php"><button>Report a Lost or Found Item</button></a>&nbsp';

  // Button change from log in to admin functions if admin is logged in
  if($loginstatus=="LOGGED IN"){
    echo '<a href= "misc.php"><button>Administrator Functions</button></a>';
  }
  else{
  echo '<a href= "AdminLogIn.php"><button>Administrator Log In</button></a>';
  }
  echo '</div>';
?>

</div>
<br>
<br>
</body>

<?php
// Version file
include "versions.html";
?>
