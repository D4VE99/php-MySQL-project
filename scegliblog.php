<?php
include 'connection.php';
 session_start();
 $b=1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
<title>scegli blog</title>
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
</ul><!-- al digitare di una lettera, la funzione mostra il blog corrispondente per facilitare la ricerca -->
</div><br>
<h2>Scegli il blog con cui vuoi interagire o creane uno</h2>

  <input type="text" id="testocer" name="testocer" value="" onkeyup="showHint(this.value)" placeholder="digita la parola da cercare">
  <br> <div id="txtHint"></div><br>

<a href="creablog.php" style="text-decoration:none; background:#efefef; padding:4px; border: 1px solid black;border-radius:10px;">+ crea nuovo blog</a><br><br><br>
<div style="width:80%;text-align:center;margin-left:10%; background-color: #01949A; border-radius: 25px;padding:20px 0;">
    <!-- mostro tutti i blog esistenti e con il bottone che prende come value il id del blog per renderlo unico -->
   <?php
   $rows=mysqli_query($conn, "SELECT * FROM blog order by idblog desc");
  foreach($rows as $row):
    $c=$row['stile'];
    ?>
    <div style="display:inline-block; padding:10px;">
    <p style="vertical-align:top;margin-top:10px;background-color:<?php echo $row['colore']; ?>;border:1px solid black;border-radius:10px;width:200px;height:200px;"><?php
echo "<br><br><br><a style='font-family:$c;height:50px;vertical-align:middle;'> <b>".$row['nomeb']."</b></a><br>";
?><br><button value="<?php echo $row['idblog'] ?>" onclick='al(this.value)'>entra</button><br>

</p>
  </div>
<?php
  endforeach;?>
</div>


</body>
</html>
<script>
  function al(a){
      var headvalue = a;
document.cookie = "idblog="+headvalue; 
 window.location.href = "home.php";
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
        xmlhttp.open("GET", "ricercablog.php?q=" + str, true);
        xmlhttp.send();
    }
}

</script>