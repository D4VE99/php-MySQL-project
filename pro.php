<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="it">
    <head>
<title>pro</title>
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
  <h1 >Iscrizione Pro</h1><!-- uso il form con metoo post per inserire i dati della carta e carico con ajax un testo per i termini di pagamento se clicco sul bottone  -->
  <div class="form">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
  <label for="fname">nome utente:</label><br>
  <input type="text" id="fname" name="fname" value=""><br><br>
  <label for="lname">numero carta:</label><br>
  <input type="text" id="carta" name="carta" value=""><br><br>
  <label for="lname">cvv:</label><br>
  <input type="password" id="cvv" name="cvv" value=""><br><br>
  <input type="submit" value="Paga ora" id="submit">
</form>
</div>
<?php

$nome = "";
$carta = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['fname'];
  $carta = $_POST['carta'];
$cvv=$_POST['cvv'];
$nome= filter_var($nome, FILTER_SANITIZE_STRING);
$carta= filter_var($carta, FILTER_SANITIZE_STRING);
$cvv= filter_var($cvv, FILTER_SANITIZE_NUMBER_INT);
}
$s=0;
$c=0;
$rows=mysqli_query($conn, "SELECT * FROM pro where nomeutente='$nome';");
foreach($rows as $row):
    $c++;
endforeach;

$rows=mysqli_query($conn, "SELECT nomeutente FROM utente where nomeutente='$nome';");
foreach($rows as $row):
    $s++;
endforeach;

if($c==0){if(($nome!="")&&($carta!="")&&($cvv!="")&&($s==1)&&(ctype_alnum($nome))){
    $sql=mysqli_query($conn, "INSERT INTO pro values('$nome','$carta','$cvv', 1)");
    echo "<script> alert('iscrizione effettuato con successo');window.location.href='scegliblog.php';</script>";
    }else{
      if(($nome=="")||(!ctype_alnum($nome))){echo "nome non valido";}elseif($s==0){echo "nome utente non registrato nel database";}elseif($cvv==""){echo "errore nel cvv";}elseif($carta==""){echo "errore carta";}
      else{echo "errore";}
      }
  }else{echo "registrazione gia effettuata da questo utente";}




$conn->close();
?>
<br><br><p style="max-width:50%;margin-left:25%;" id="term"></p>

<button type="button" onclick="loadterm()">termini e condizioni</button>

<script>
function loadterm() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("term").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "term.txt", true);
  xhttp.send();
}
</script>
</body>
</html>