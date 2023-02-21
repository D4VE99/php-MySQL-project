<?php
include 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
<title>commenti</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
    <html>
  <body>  <div class="menu">
    <ul>
    <li><i class="fas fa-bookmark"></i> <a style="color:#004369;"href="index.php">Subscription</a></li>
  <li><i class="fas fa-home"></i> <a style="color:#004369;"href="scegliblog.php">Home</a></li>
  <li><i class="fas fa-blog"></i> <a style="color:#004369;"href="creablog.php">New Blog</a></li>
  <li href="home.php"><i class="fas fa-user-alt"></i> <a style="color:#004369;"href="profile.php">Profile</a></li>
  <li href="home.php"><i class="fas fa-dollar-sign"></i> <a style="color:#004369;" href="pro.php">Pro</a></li>
  <li href="login.php"><i class="fas fa-check-circle"></i> <a style="color:#004369;"href="login.php">login</a></li>
</ul><!-- qui prendo il cookie salvato dalla pagina home che mi dice quale post caricare per i commenti  -->
</div><br><?php 
$j= $_COOKIE["ww"];

?><a style="display:none;"><?php $nome=$_SESSION["nomeut"]; ?></a>

<h1>post selezionato</h1>
  <?php 
 if(!(isset($variable))){$nome="guest";}

$rows=mysqli_query($conn, "SELECT * FROM post where idpost='$j'");
foreach($rows as $row):
  echo "<div style='background:#01949A; padding:10px 20px; border-radius:10px; width:60%;  margin-left:20%;margin-top:10px;'>";
  
echo "<p><b>categoria: </b>". $row['categoria']."</p>";
echo "<p> <b>". $row['titolo']."</b></p>";
echo "<p style='max-height:auto; text-align:center;width:auto;'>". $row['testo']."</p>";
echo "<p><b>autore: </b> ". $row['autore']."</p>";
echo "<p><b>coautore: </b>". $row['coautore']."</p>";
echo "<p>". $row['dora']."</p>";
$idcercato=$row['idpost'];

$rows1=mysqli_query($conn, "SELECT * FROM grafica where nome='$idcercato' ");?>


<?php
foreach($rows1 as $row1):
?>
 

<img style="max-height:200px; max-width:500px; border-radius:5%;border:1px solid black;" src="img/<?php echo $row1['immagine']; ?>" alt=""><br>


<?php
endforeach;
  echo "</div>";
endforeach;

?>
</div><!-- seleziono i commenti del post e li mostro sotto il post -->
 <div style='background:#E5DDC8; padding:10px 20px; border-radius:10px; width:60%; margin-left:20%;margin-top:10px;border:1px solid black;text-align:center;overflow-y: scroll;max-height:200px;'>
<?php $rows=mysqli_query($conn, "SELECT * FROM commento where idpost='$j'");
foreach($rows as $row):
  $p=$row['utente'];
  $sql=mysqli_query($conn, "SELECT immagine FROM utente where nomeutente='$p'");
  foreach($sql as $ssql):
  echo "<div style='background:#ffffff; padding:10px 20px; border-radius:10px; width:40%;margin-left:29%; margin-top:10px;border:1px solid black;'>";
 ?> <img style="vertical-align:middle;height:30px; width:30px; border-radius:50%;border:1px solid black;margin-right:5px;" src="img/<?php echo $ssql['immagine']; ?>" alt=""><?php
echo "<p style='display:inline-block;'><b>". $row['utente']."</b></p>";
echo "<p> ". $row['testo']."</p>";
echo"</div>";
endforeach;
endforeach;

?>

 </div><!-- creo il form per creare commenti e linko la pagina home dopo aver postato il commento  -->
 <form  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"class="creacomm" id="creacomm" style=" margin-top:1%;background:#E5DDC8;max-width:60%; margin-left:21%;border-radius:10px; height:150px; overflow-y:no;">
<textarea style=" max-height:100px;"type="text" id="testocomm" name="testocomm" value="" placeholder="scrivi un commento.."></textarea><br>
<div id="comm" style="display:auto;"><button style="display:auto;" type="submit" value="submit" >posta</button></div>
</form>
<?php  $k=0;
$nome=$_SESSION["nomeut"];
$sql = mysqli_query($conn,"SELECT * FROM pro where nomeutente='$nome'");
foreach($sql as $rows):$k=$k+1;endforeach;

if ($k === 0){echo"<script>$('#comm').css('display', 'none');</script>";$k=0;}else{echo"<script>$('#comm').css('display', 'auto');</script>";$k=0;};

$testo ="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $testo = $_POST['testocomm'];
  $testo= filter_var($testo, FILTER_SANITIZE_STRING);
}
if( $testo=="" )
     {echo"<br>";die('iscriviti alla pro e scrivi il commento per postare');}
  else{
    $sql = "INSERT INTO commento (`utente`, `testo`, `idpost`) VALUES ('$nome', '$testo', '$j');";
    if ($conn->query($sql) == TRUE) {
      $testo ="";
    echo "<script>alert('commento postato')</script>";
  
   
  } }echo"<script>window.location.href = 'home.php?commentii=' +'#'+ $j;</script>"
  ?>
</body>
</html>
