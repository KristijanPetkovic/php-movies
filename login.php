<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
$username = $password = "";
$username_err = $password_err = $login_err = "";
$link = mysqli_connect("localhost", "root", "") 
or die("Could not connect: " . mysqli_connect_error()); 
mysqli_select_db($link, 'apeiron-seminarski') 
or die(mysqli_connect_error()); 



$sqlDB = $link->query("CREATE TABLE user (
    `id` int(11) NOT NULL auto_increment,
    `username` varchar(20) NOT NULL default '',
    `pass` varchar(20) NOT NULL default '',
    `city` varchar(30) NOT NULL default '',
    PRIMARY KEY (`id`) )");
    
  if ($sqlDB === TRUE) {
    $sqlInsert = $link->query("INSERT INTO user VALUES 
    (1,'kris', '1234','Novi Sad'),
    (2,'pera', '5678','Beograd'),
    (3,'mika', '8527','Doboj')");
    
  } else {
    $sqlDrop = $link->query("DROP TABLE user");

    $sqlDB = $link->query("CREATE TABLE user (
        `id` int(11) NOT NULL auto_increment,
        `username` varchar(20) NOT NULL default '',
        `pass` varchar(20) NOT NULL default '',
        `city` varchar(30) NOT NULL default '',
        PRIMARY KEY (`id`) )");

    $sqlInsert = $link->query("INSERT INTO user VALUES 
    (1,'kris', '1234','Novi Sad'),
    (2,'pera', '5678','Beograd'),
    (3,'mika', '8527','Doboj')");
  }

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(empty(trim($_POST["username"]))){
        $username_err = "Unesite korisničko ime.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Unesite lozinku.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){
        $user = "SELECT * FROM user WHERE username = '$username' AND pass = '$password'";
        $result = mysqli_query($link, $user) or die("Greska prilikom dobijanja podataka o korisniku! " . mysqli_connect_error());
        if($result->num_rows != 0) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;                          
            header("location: index.php");
        }     
        $password_err = "Pogrešna lozinka!";                         
    }
    $link->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
    <style>
body { text-align: center;  margin-top: 15%;}
body > * { text-align: center; }
form { display: inline-block;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Prijava</h2>
        <p>Unesite kredenccijale za prijavu.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Korisnik</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                </br>
                <span style="color:red" class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
                 </br>
            <div class="form-group">
                <label>Lozinka</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                </br>
                <span style="color:red" class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
                </br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Prijava">
            </div>
        </form>
    </div>
</body>
</html>