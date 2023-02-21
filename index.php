<?php
include 'database.php';
include 'connection.php';
session_start();
$_SESSION["nomeut"]="";

?>
<!DOCTYPE html>
<html lang="it">
    <head>
<title>subscription</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
<html>
  <body><!-- form di registrazione utente che dopo aver controllato che i campi siano tutti completi e che non ci siano caratteri non alfanumerici nel nome, inserisce tutto nel database -->
  <script 
src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jq
uery.min.js"></script>
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
  <h1 >SIGN IN</h1>
  <div class="form">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
  <label for="fname">nome:</label><br>
  <input type="text" id="fname" name="fname" value="" onkeyup="showHint(this.value)"><br>
  <p>nomi gia esistenti: <span id="txtHint"></span></p><br>
  <label for="lname">email:</label><br>
  <input type="text" id="email" name="email" value=""><br><br>
  <label for="lname">phone:</label><br>
  <input type="text" id="phone" name="phone" value=""><br><br>
  <label for="lname">password:</label><br>
  <input type="password" id="password" name="password" value=""><br><br>
  <label for="lname">conferma password:</label><br>
  <input type="password" id="conf" name="conf" value=""><br><br>
  <input type="submit" value="Sign in" id="submit">
</form>
</div>
<?php

$nome = "";
  $email = "";
  $phone = "";
  $passw = "";
  $conf = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['fname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $passw = $_POST['password'];
  $conf = $_POST['conf'];
  
}
?><!-- inserisco i vari controlli per verificare indirizzo email, password corretta, caratteri giusti nella password e caratteri corretti nel resto --><?php
$phone= filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
$uppercase = preg_match('@[A-Z]@', $passw);
$lowercase = preg_match('@[a-z]@', $passw);
$number    = preg_match('@[0-9]@', $passw);
$specialChars = preg_match('@[^\w]@', $passw);
if($uppercase && $lowercase && $number && $specialChars && strlen($passw) >= 8) {
    echo 'password valida';
  
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo $email ."is not a valid email address";
} else{
if(($nome!="")&&($passw!="")&&($conf==$passw)&&(ctype_alnum($nome))){
  $i=0;
  $rows=mysqli_query($conn, "SELECT * FROM utente where nomeutente='$nome' ORDER BY nomeutente DESC");?>
  <?php
  foreach($rows as $row):
$i++;
  endforeach;
  
  
  if( $i > 0 )
     {die('Your nomeutente already exists');}
  else{$sql = "INSERT INTO utente (`nomeutente`, `email`, `telefono`, `password`) VALUES ('$nome', '$email', '$phone', '$passw');";
    
    if ($conn->query($sql) == TRUE) {
    echo "<script>alert('Nuovo utente creato con successo');</script>";
   header('location:scegliblog.php');
    $_SESSION["nomeut"] = $nome;
   
  } }
  

  
  }else{echo "<script>alert('compila tutti i campi con caratteri validi');</script>";}
}
} else {echo "La password deve essere lunga almeno 8 caratteri e contenere almeno una maiuscola, una minuscola, un numero e un carattere speciale";}

$conn->close();
?>
</body><!-- la funzione ajax mostra ogni carattere cliccato quale nome gli si avvicina se è occupato in modo tale che si possa evitare -->
</html>
<script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}

  </script>
