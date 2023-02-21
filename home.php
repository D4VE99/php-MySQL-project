<?php
include 'connection.php';
 session_start();
 $b=1;
 $idblog=$_COOKIE["idblog"];
 $rows=mysqli_query($conn, "SELECT * FROM blog where idblog='$idblog'");
 foreach($rows as $row):
$colore=$row['colore'];
$stile=$row['stile'];
$nomeblog=$row['nomeb'];
$descblog=$row['descrizione'];
$revisore1=$row['coautore1'];
$revisore2=$row['coautore2'];
 endforeach;

 $rows1=mysqli_query($conn, "SELECT * FROM scrive where idblog='$idblog'");
 foreach($rows1 as $row1):
$creatore=$row1['nomeutente'];
 endforeach;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
<title>home</title>
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
  <li href="home.php"><i class="fas fa-dollar-sign"></i> <a style="color:#004369;" href="pro.php">Pro</a></li>
  <li href="login.php"><i class="fas fa-check-circle"></i> <a style="color:#004369;"href="login.php">login</a></li>
</ul>
</div><br>
<p style="display:none;"><?php 
$nome=$_SESSION["nomeut"]; if(($nome=="")||($nome==null)){$nome="guest";$_SESSION["nomeut"]=$nome;}?></p>
<h1 style="font-family:<?php echo $stile;?>;"><?php echo $nomeblog;?></h1>
<h2 style="font-family:<?php echo $stile;?>;"><?php echo $descblog;?></h2>
<h3 style="font-family:<?php echo $stile;?>;"><?php echo "creatore e admin del blog: ". $creatore . "";?></h3>
<h3 style="font-family:<?php echo $stile;?>;"><?php echo "aiutante dell'admin del blog: ". $revisore1 . "";?></h3>
<h3 style="font-family:<?php echo $stile;?>;"><?php echo "aiutante dell'admin del blog: ". $revisore2 . "";?></h3>
<?php
if($creatore==$nome){echo "<button id='moderatori'>modifica moderatori</button>";
}
if(($creatore==$nome)||($revisore1==$nome)||($revisore2==$nome)){echo "<br><br><button value='$idblog' id='elblog'>elimina blog</button>";
}
?>
<h2 style="font-family:<?php echo $stile;?>;"> <?php echo "ciao"." ". $nome;?></h2>



<div class="creapost" id="creapost" style="display:none;max-width:70%;margin:0 15% 0 15%;">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"autocomplete="off" enctype="multipart/form-data" >
<label for="coaut">coautore:</label><br>
  <input type="text" id="coaut" name="coaut" value=""><br><br>
  <label for="cath">categoria:</label><br>
  <input type="text" id="cath" name="cath" value=""><br><br>
  <label for="tit">titolo:</label><br>
  <input type="text" id="title" name="title" value=""><br><br>
  <label for="text">testo:</label><br>
  <textarea id="testo" name="testo" value=""></textarea><br><br>
  <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="" ><br><br>
  <input onclick="posta1()" type="submit" value="posta" id="submit1">
  
</form>
</div><!-- menu e due form uno di creazione post e uno di ricerca che, a seconda del tasto cliccato, saranno visibili grazie alle funzioni posta e posta1 che con jquery ne modificano il css -->
<div class="vedi" id="vedi" style="background-color:<?php echo $colore;?>; margin: 20px 15% 10px 15%;border-radius:10px; height:700px; overflow-y:auto;border:1px solid black;">
<form  method="get" action="<?php echo $_SERVER['PHP_SELF'];?>"autocomplete="off" enctype="multipart/form-data">
  <input type="text" id="testocer" name="testocer" value="" onkeyup="showHint(this.value)" placeholder="digita la parola da cercare">
  <input style=" background:#000000;max-width:120px;color:#ffffff;border:2px solid white;" type="submit" value="cerca" id="cerca"><br><p>categorie: <span id="txtHint"></span></p><br>
</form>




<button onclick="posta()" type="" value="" id="crea">+ nuovo post</button>




<?php

$categoria = "";
  $titolo = "";
  $testo = "";
  $immagine = "";
  $coautore="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $categoria = $_POST['cath'];
  $testo = $_POST['testo'];
  $titolo = $_POST['title'];
  $coautore = $_POST['coaut'];

}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
 ?><a style="display:none"><?php $ric=$_GET['testocer'];?></a><?php

}

  
  ?>
  
<?php
  if(($categoria=="")||($testo=="")||($titolo=="")||($nome=="")||($nome=="guest")){echo "crea un nuovo post cliccando sul bottone e compilando tutti i campi!"; $a=1;}
  else{$categoria= filter_var($categoria, FILTER_SANITIZE_STRING);
    $testo= filter_var($testo, FILTER_SANITIZE_STRING);
    $titolo= filter_var($titolo, FILTER_SANITIZE_STRING);
    $coautore= filter_var($coautore, FILTER_SANITIZE_STRING);
    $sql = "INSERT INTO post (`categoria`, `testo`, `titolo`, `autore`, `coautore`,`idblog`,`dora`) VALUES ('$categoria', '$testo', '$titolo', '$nome', '$coautore','$idblog', now());"; 
    
    if ($conn->query($sql) == TRUE) {
    echo "New post created successfully"; 
    ?><script>$("#cerca").click();</script><?php
    $a=0;
  }else{echo "error";}}

 
  $rows=mysqli_query($conn, "SELECT * FROM post order by idpost desc limit 1");
  foreach($rows as $row):{$newid= ($row['idpost']);}endforeach;

  
 
?>

<!-- inserimento immagine prendendo come valore di riferimento id del post appena inserito in modo tale da porre una immagine corretta-->
<p style="display:none;">
  <?php
  
  if(($_FILES["image"]["error"] === 4)||($a==1)){
  echo "immagine non caricata";
}else{
  $fileName=$_FILES["image"]["name"];
  $fileSize=$_FILES["image"]["size"];
  $tmpName=$_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension=strtolower(end($imageExtension));
  if(!in_array($imageExtension, $validImageExtension)){
    echo "estensione immagine non valida";
  }elseif ($fileSize > 100000000) {
    {
      echo "<script> alert('immagine troppo grande');</script>";
    }
  }else{
    $newImageName= uniqid();
    $newImageName .= '.' . $imageExtension;
    move_uploaded_file($tmpName, 'img/'. $newImageName);
    $query = "INSERT INTO grafica VALUES ('','$newid','$newImageName')";
    mysqli_query($conn, $query);
    echo
    "<script>alert('caricamento eseguito');</script>";
  }

}?>
</p>
<!-- se non ho cercato nulla verranno mostrati tutti i post esietenti, se invece ho cercato una categoria particolare verranno mostrate solo le cose di una categoria -->
<?php 
if(!(isset($ric))||($ric=="")){
$rows=mysqli_query($conn, "SELECT * FROM post where post.idblog='$idblog' order by idpost desc");
foreach($rows as $row):
  echo "<div style='background:#E5DDC8; padding:10px 20px; border-radius:10px; width:60%;  margin-left:20%;margin-top:10px;border:1px solid black;'>";
  
echo "<p><b>categoria: </b>". $row['categoria']."</p>";
echo "<p> <b>". $row['titolo']."</b></p>";
echo "<p style='max-height:auto; max-width:900px;'>". $row['testo']."</p>";
echo "<p><b>autore: </b> ". $row['autore']."</p>";
echo "<p><b>coautore: </b>". $row['coautore']."</p>";
echo "<p>". $row['dora']."</p>";
$idcercato=$row['idpost'];


$rows1=mysqli_query($conn, "SELECT * FROM grafica where nome='$idcercato' ");
foreach($rows1 as $row1):
?>
 

<img style="max-height:200px; max-width:500px; border-radius:5%;border:1px solid black;" src="img/<?php echo $row1['immagine']; ?>" alt=""><br>


<?php
endforeach;$i=1;?>

<button  name="commentii" class="commentii" value="<?php echo $row['idpost']; ?>" onclick="sendAJAXX(this.value)">commenti</button>
<button class="likes" id="<?php echo $row['idpost']; ?>" value="<?php echo $row['idpost']; ?>" onclick="like(this.value)"><i id="colora"class='fas fa-heart'></i></button>
<?php $tt=$row['idpost'];$li=0;$v=0;
$row12=mysqli_query($conn, "SELECT * from mette where idpost='$tt' and nomeutente='$nome' ");
foreach($row12 as $rows12):
  $v++;
endforeach;
if($v>0){?><script>$("#<?php echo $row['idpost']; ?>").css("color","red")</script><?php $v=0;}
$row1=mysqli_query($conn, "SELECT likes.likes from likes where idpost='$tt' ");
            foreach($row1 as $rows1):
              $li=$rows1['likes'];
            endforeach;
?>
<p name="likess" value="<?php echo $row['idpost']; ?>" id="www"><?php echo $li . "likes"; ?></p>
  <?php
    if(($creatore==$nome)||($revisore1==$nome)||($revisore2==$nome)){?><br><br><button value="<?php echo $row['idpost'];?>" onclick="elp(this.value)">elimina post</button><?php
    }
  echo "</div>";
endforeach;
}else{
  $rows=mysqli_query($conn, "SELECT * FROM post where categoria='$ric' order by idpost desc");
  foreach($rows as $row):
    echo "<div style='background:#E5DDC8; padding:10px 20px; border-radius:10px; width:60%;  margin-left:20%;margin-top:10px;'>";
    
  echo "<p><b>categoria: </b>". $row['categoria']."</p>";
  echo "<p> <b>". $row['titolo']."</b></p>";
  echo "<p style='max-height:auto; max-width:900px;'>". $row['testo']."</p>";
  echo "<p><b>autore: </b> ". $row['autore']."</p>";
  echo "<p><b>coautore: </b>". $row['coautore']."</p>";
  echo "<p>". $row['dora']."</p>";
  $idcercato=$row['idpost'];
  $i=1;
  $rows1=mysqli_query($conn, "SELECT * FROM grafica where nome='$idcercato' ");?>
  
  
  <?php
  foreach($rows1 as $row1):
    
  ?>
   
  
  <img style="max-height:200px; max-width:500px; border-radius:5%;border:1px solid black;" src="img/<?php echo $row1['immagine']; ?>" alt=""><br>
  
  
  <?php
  endforeach;?>
  
<button name="commentii" class="commentii" value="<?php echo $row['idpost']; ?>" onclick="sendAJAXX(this.value)">commenti</button>
<button  class="likes" id="<?php echo $row['idpost']; ?>"value="<?php echo $row['idpost']; ?>" onclick="like(this.value)"><i  id="colora"class='fas fa-heart'></i></button>
<?php $tt=$row['idpost'];$li=0;
$row12=mysqli_query($conn, "SELECT * from mette where idpost='$tt' and nomeutente='$nome' ");$v=0;
foreach($row12 as $rows12):
  $v++;
endforeach;
if($v>0){?><script>$("#<?php echo $row['idpost']; ?>").css("color","red")</script><?php $v=0;}
$row1=mysqli_query($conn, "SELECT likes.likes from likes where idpost='$tt' ");
            foreach($row1 as $rows1):
              $li=$rows1['likes'];
            endforeach;
?>
<p name="likess" value="<?php echo $row['idpost']; ?>" id="www"><?php echo $li . "likes"; ?></p>
  <!-- i bottoni dei commenti funzionano che ogni volta che ne viene creato uno, questo ha il valore del post a cui viene associato  in modo poi da riconoscere il post selezionato quando lo clicco-->
    <?php
    if(($creatore==$nome)||($revisore1==$nome)||($revisore2==$nome)){?><br><br><button value="<?php echo $row['idpost'];?>" onclick="elp(this.value)">elimina post</button><?php
    }
    echo "</div>";
  endforeach;
  $ric="";}
?>
</div>
<div style="background:#ffffff; padding:10px 20px; border-radius:10px; width:10%; position:absolute; margin-left:10px;margin-top:-700px;vertical-align:top;">
<h3>categorie</h3>
<?php 

$rows=mysqli_query($conn, "SELECT * FROM post where post.idblog='$idblog' group by categoria");
foreach($rows as $row):
  

?><a><?php echo $row['categoria']; ?></a><br><?php

  
endforeach;

?>
</div>
</body>

</html>
<script>
  
function sendAJAXX(q1)
{
  
var xmlhttp;

      var headvalue = q1;
document.cookie = "ww="+headvalue;
         
         location.reload();
    window.location.href = "cookie.php";
}
function sendAJAXXX(q1)
{
  
var xmlhttp;

      var headvalue = q1;
document.cookie = "ff="+headvalue;
         
         location.reload();
    window.location.href = "new.php";
}


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
        xmlhttp.open("GET", "ricerca.php?q=" + str, true);
        xmlhttp.send();
    }
}


  function posta(){$("#creapost").css("display","block");
    $("#vedi").css("display","none");
    $("#creablog").css("display","none");}
    function posta1(){$("#creapost").css("display","none");
    $("#vedi").css("display","block");
    $("#creablog").css("display","none");}

    
        function like(ac){
            var like= ac;
            
var data ="like=" + like;
            $.ajax({
                method: "post",
                url: "likesajax.php",
                data: data,
                success: function(data){
                    $("#"+ ac).css("color","red");
                    document.cookie = "punto="+ "#" + ac;
                   
                    window.location.href = "home.php?likess=" +"#"+ ac;
                }})
               
        };
    
        $("#moderatori").click(function(){
            var blog= <?php echo $idblog; ?>;
            
document.cookie = "blog="+blog;
    window.location.href = "moderatori.php";});

    $(document).ready(function(){
        $("#elblog").click(function(){
            var nom= $("#elblog").val();
            var u="blog";
           
var data = "nom=" + nom + "&des=" + u;

            $.ajax({
                method: "post",
                url: "eliminajax.php",
                data: data,
                
                
            })
            
            alert('blog n.' +nom + '' + 'eliminato');
            location.reload();
            window.location.href="scegliblog.php";

        });
    });


    function elp(nom){ 
            var u="post";
           
var data = "nom=" + nom + "&des=" + u;

            $.ajax({
                method: "post",
                url: "eliminajax.php",
                data: data,
                
                
            })
            alert('post n.' +nom + '' + 'eliminato');
            location.reload();
        };
   
  </script>