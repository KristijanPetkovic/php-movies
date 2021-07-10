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

    $sqlDB = $link->query("CREATE TABLE `movies` (
      `id` int(15) NOT NULL auto_increment,
      `name` varchar(20) NOT NULL default '',
      `cinema` varchar(20) NOT NULL default '',
      `movieCity` varchar(20) NOT NULL default '',
      `relaseYear` int(4) NOT NULL default '0',
      PRIMARY KEY (`id`))");
      
    if ($sqlDB === TRUE) {
      $sqlInsert = $link->query("INSERT INTO movies VALUES 
      (1,'Ko to tamo peva', 'Narodno kino', 'Doboj','1980'),
      (2,'Mi nismo andjeli', 'Kinoteka','Doboj','1992'),
      (3,'Pad u raj','KinoFino', 'Doboj','2004'),
      (4,'Terminator 1','Arena', 'Novi Sad','1984'),
      (5,'Iron man 1','Cineplex', 'Novi Sad','2008'),
      (6,'Mehanic','Filmici', 'Novi Sad','2011'),
      (7,'Black Widow','KokiceKino', 'Beograd','2021'),
      (8,'Wreck it Ralph','CineplexArena', 'Beograd','2012'),
      (9,'Who am I','Kinče', 'Beograd','2011')");
      
    } else {
      $sqlDrop = $link->query("DROP TABLE movies");

      $sqlDB = $link->query("CREATE TABLE `movies` (
        `id` int(15) NOT NULL auto_increment,
        `name` varchar(20) NOT NULL default '',
        `cinema` varchar(20) NOT NULL default '',
        `movieCity` varchar(20) NOT NULL default '',
        `relaseYear` int(4) NOT NULL default '0',
        PRIMARY KEY (`id`))");

      $sqlInsert = $link->query("INSERT INTO movies VALUES 
      (1,'Ko to tamo peva', 'Narodno kino', 'Doboj','1980'),
      (2,'Mi nismo andjeli', 'Kinoteka','Doboj','1992'),
      (3,'Pad u raj','KinoFino', 'Doboj','2004'),
      (4,'Terminator 1','Arena', 'Novi Sad','1984'),
      (5,'Iron man 1','Cineplex', 'Novi Sad','2008'),
      (6,'Mehanic','Filmici', 'Novi Sad','2011'),
      (7,'Black Widow','KokiceKino', 'Beograd','2021'),
      (8,'Wreck it Ralph','CineplexArena', 'Beograd','2012'),
      (9,'Who am I','Kinče', 'Beograd','2011')");
    }
?>

<html>
<head>
<title>Pregled filmova</title>
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
<a href="allMovies.php" class="btn btn-danger ml-3" style="color:black">Prikaz svih filmova</a>
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
  $movies = "SELECT * FROM movies INNER JOIN user ON movies.movieCity=user.city WHERE username ='" .$_SESSION["username"]."'";
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