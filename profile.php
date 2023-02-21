<?php
include 'connection.php';
session_start();

?>
<!DOCTYPE html>
<html lang="it">
    <head>
<title>profile</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
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
</div><br><!-- attraverso il nome utente del profilo loggato carico alcune informazioni da mostrare come la mail e se è abbonato alla pro  -->
<h1>Profile</h1>
<?php
$nome=$_SESSION["nomeut"];
if(isset($_POST["submit"])){
  if($_FILES["image"]["error"] === 4){
    echo "<script> alert('non esiste immagine');</script>";
  }else{
    $fileName=$_FILES["image"]["name"];
    $fileSize=$_FILES["image"]["size"];
    $tmpName=$_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension=strtolower(end($imageExtension));
    if(!in_array($imageExtension, $validImageExtension)){
      echo "<script> alert('estensione immagine non valida');</script>";
    }elseif ($fileSize > 10000000) {
      {
        echo "<script> alert('immagine troppo grande');</script>";
      }
    }else{
      $newImageName= uniqid();
      $newImageName .= '.' . $imageExtension;
      move_uploaded_file($tmpName, 'img/'. $newImageName);
      $query = "UPDATE utente set immagine='$newImageName' where nomeutente='$nome'";
      mysqli_query($conn, $query);
      echo
      "<script>alert('caricamento eseguito');</script>";
    }

  }
}?>
<div style="margin-left:20%;max-height:120px; max-width:120px; border-radius:50%;">
<?php

$rows=mysqli_query($conn, "SELECT * FROM utente where nomeutente='$nome' ORDER BY nomeutente DESC");
foreach($rows as $row):
?>
 

<img style="max-height:200px; max-width:200px; border-radius:50%;border:1px solid black;" src="img/<?php echo $row['immagine']; ?>" alt="">


<?php
endforeach;
?>
<form  method="POST" action="" autocomplete="off" enctype="multipart/form-data">
  
  <input style="border-style:none;max-width:66px;margin-left:40px;"type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="" /><br>
  
  <input type="submit" value="upload" name="submit"><br>
  
  </form>
  
 </div>
  <h2 style="margin-top:-70px;">Nome utente:</h2>
<h2><?php
echo $nome;?><h2>
<h2>abbonamento pro:</h2>
<h2><?php 
$b=0;
$rows=mysqli_query($conn, "SELECT * FROM pro where nomeutente='$nome'");?>
<?php
foreach($rows as $row):
  $b++;
endforeach;
if($b==0){echo "non abbonato "."<a href='pro.php'> rimedia subito!</a>"; }else{echo "Abbonato";}
?><h2>
  <h2>Email utente:</h2>
<h2><?php 
$b=0;
$rows=mysqli_query($conn, "SELECT * FROM utente where nomeutente='$nome'");
foreach($rows as $row):
  $new= $row['email'];
  echo $new;
endforeach;
?></h2>
<h1>i tuoi post</h1><!-- mostro i post scritti dal profilo o di cui ricopre il ruolo di coautore e grazie al valore del pulsante eulimina creo una funzione ajax che salva un cookie che verrà utilizzato per eliminare il post  -->
  <?php 
if($nome!=""){
$rows=mysqli_query($conn, "SELECT * FROM post where autore='$nome'or coautore='$nome' order by idpost desc");
foreach($rows as $row):
  echo "<div style='background:#01949A; padding:10px 20px; border-radius:10px; width:60%; margin-bottom:20px; margin-left:20%;margin-top:10px;'>";
  $hh=$row['idblog'];
  $rows2=mysqli_query($conn, "SELECT * FROM blog where idblog='$hh'");
foreach($rows2 as $row2):
  echo "<p><b>Blog: </b>". $row2['nomeb']."</p>";
endforeach;
echo "<p><b>categoria: </b>". $row['categoria']."</p>";
echo "<p> <b>". $row['titolo']."</b></p>";
echo "<p style='max-height:auto; text-align:center;'>". $row['testo']."</p>";
echo "<p><b>autore: </b> ". $row['autore']."</p>";
echo "<p><b>coautore: </b>". $row['coautore']."</p>";
echo "<p>". $row['dora']."</p>";
$idcercato=$row['idpost'];


$rows1=mysqli_query($conn, "SELECT * FROM grafica where nome='$idcercato' ");?>


<?php
foreach($rows1 as $row1):
?>
 

<img style="max-height:300px; max-width:500px; border-radius:5%;border:1px solid black;" src="img/<?php echo $row1['immagine']; ?>" alt=""><br>


<?php
endforeach;?>

<button onclick="sendAJAX(this.value)" value="<?php
 echo $row['idpost']; ?>">elimina</button>

  <?php
  echo "</div>";
endforeach;
}
?>
</div>
 
<a style="width:100%;padding-top:30px; font-size:18px;font-weight=700; color:#DB1F48;margin-left:0px;"href="eliminautente.php">Elimina profilo</a>

</body>
</html>


<script>
function sendAJAX(q1)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var temp = xmlhttp.responseText;
document.cookie = "temp="+temp;
         
         location.reload();
    }window.location.href = "elim.php";

  }
xmlhttp.open("GET","prova.php?q=" + q1 ,true);
xmlhttp.send();
}

</script>