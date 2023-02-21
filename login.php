<?php
include 'connection.php';
session_start();
$_SESSION["nomeut"]="guest";
?>
<!DOCTYPE html>
<html lang="it">
    <head>
<title>login</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
<html>
  <body>
  <div class="menu">
  <ul>
  <li><i class="fas fa-bookmark"></i> <a style="color:#004369;"href="index.php">Subscription</a></li>
  <li><i class="fas fa-home"></i> <a style="color:#004369;"href="scegliblog.php">Home</a></li>
  <li><i class="fas fa-blog"></i> <a style="color:#004369;"href="creablog.php">New Blog</a></li>
  <li href="home.php"><i class="fas fa-user-alt"></i> <a style="color:#004369;"href="profile.php">Profile</a></li>
  <li href="home.php"><i class="fas fa-dollar-sign"></i> <a style="color:#004369;"href="pro.php">Pro</a></li>
  <li href="login.php"><i class="fas fa-check-circle"></i> <a style="color:#004369;"href="login.php">login</a></li>
</ul>
</div><br>
  <h1 >Sign up</h1>
  <div class="form">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
  <label for="fname">nome utente:</label><br>
  <input type="text" id="fname" name="fname" value=""><br><br>
  <label for="lname">email:</label><br>
  <input type="text" id="email" name="email" value=""><br><br>
  <label for="lname">password:</label><br>
  <input type="password" id="password" name="password" value=""><br><br>
  <input type="submit" value="Sign Up" id="submit">
</form>
</div><!-- creo un form per inserire i dati e dopo controllo se il nomeutente e inserito ha quella password e quella mail e se vedo tutto corretto mando alla pagina home  -->
<?php
$nome = "";
  $cognome = "";
  $email = "";
  $passw = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['fname'];
  $email = $_POST['email'];
  $passw = $_POST['password'];
  $nome= filter_var($nome, FILTER_SANITIZE_STRING);
  $passw= filter_var($passw, FILTER_SANITIZE_STRING);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
}
if(($nome!="")&&($email!=="")&&($passw!="")&&(ctype_alnum($nome))){
  $rows=mysqli_query($conn, "SELECT * FROM utente where nomeutente='$nome'");
foreach($rows as $row):
 if(($row['email']==$email)&&($row['password']==$passw)){
  echo "<script>alert('login effettuato')</script>";
  
  $_SESSION["nomeut"]=$nome;
  header('Location: scegliblog.php');
 }

endforeach;
  
  }else{echo "compila tutti i campi con caratteri validi";}



?>
</body>
</html>