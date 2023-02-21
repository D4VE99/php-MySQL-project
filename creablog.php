<?php
include 'connection.php';
 session_start();
 $b=1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
<title>creazione blog</title>
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
</div><br><!-- form per inserimento dati per la creazione di un blog, dati inseriti utilizzando ajax -->
<h1>Creazione nuovo blog</h1>
<div class="creapost" id="creapost" style="max-width:70%;margin:0 15% 0 15%;">
<label>Nome del Blog</label> <br>
    <input type="text" id="nomeb" /> <br> <br>
    <label>Descrizione breve</label> <br>
    <input type="text" id="desc" /> <br> <br>
    <label>stile testo</label> <br>
    <input type="text" id="stile" /> <br> <br>
    <label>colore</label> <br>
    <input type="text" id="colore" /> <br>
    <br> <br>
    <button id="register">fatto</button>

<p>
    <div id="register_output"></div>
</p>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#register").click(function(){
            var nom= $("#nomeb").val();
            var des= $("#desc").val();
            var stil= $("#stile").val();
            var col= $("#colore").val();
var data = "nom=" + nom + "&des=" + des + "&stil=" + stil + "&col=" + col;

            $.ajax({
                method: "post",
                url: "inscriviajax.php",
                data: data,
                success: function(data){
                    $("#register_output").html(data);
                    window.location.href="scegliblog.php";
                }
            })
        });
    });
</script>