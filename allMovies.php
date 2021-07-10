<?php
session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
  header("location: index.php");
  exit;
}
  $link = mysqli_connect("localhost", "root", "") 
    or die("Could not connect: " . mysqli_connect_error()); 
  mysqli_select_db($link, 'apeiron-seminarski') 
    or die(mysqli_connect_error());
?>

<html>
<head>
<title>Pregled svih filmova</title>
<style type="text/css">
TD{color:#353535;font-family:verdana}
TH{color:#FFFFFF;font-family:verdana;background-color:#336699}
h1{color:#FFFFFF;font-family:verdana;background-color:#336699;text-align:center;}
a{color:#FFFFFF;font-family:verdana;text-align:center;}
</style>
</head>
<body>
<h1>Zdravo <?php echo($_SESSION["username"])?> <a href="logout.php" class="btn btn-danger ml-3" style="float: right">Odjavi se</a>
</h2>
<div style="text-align: center">
<a href="index.php" class="btn btn-danger ml-3" style="color:black">Nazad</a>
  </div>

  <br>
  
<table border="0" width="600" cellspacing="1" cellpadding="3" 
       bgcolor="#353535" align="center">
       <tr>
    <th width="30%">Naziv</th>
    <th width="30%">Godina</th>
    <th width="30%">Grad</th>
    <th width="30%">Kino</th>
  </tr>
<?php
  $movies = "SELECT * FROM movies";
  $result = mysqli_query($link, $movies) 
    or die("Greška prilikom dobijanja podataka o filmovima! " . mysqli_connect_error()); 
  while ($row = mysqli_fetch_array($result)) {
?>
  <tr>
    <td bgcolor="#FFFFFF" width="25%">
      <?php echo $row['name']; ?>
    </td>

    <td bgcolor="#FFFFFF" width="25%">
      <?php echo $row['relaseYear']; ?>
    </td>

    <td bgcolor="#FFFFFF" width="25%">
      <?php echo $row['movieCity']; ?>
    </td>

    <td bgcolor="#FFFFFF" width="25%">
      <?php echo $row['cinema']; ?>
    </td>
  </tr>
<?php
  }
?>
</table>
</body>
</html>