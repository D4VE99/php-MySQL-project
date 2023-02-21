<?php
include 'connection.php';
 session_start();
 $blog = $_COOKIE["blog"];
 
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
  <body> <br><br><br>
  <h1>Pagina di modifica dei moderatori del blog</h1>
 <label>inserisci nuovo moderatore 1</label><br>
 <input type="text" id="v1" ></input><button id="btn1">modifica</button><br><br>
 <a>oppure</a><br><br>
 <label>inserisci nuovo moderatore 2</label><br>
 <input type="text" id="v2" ></input><button id="btn2">modifica</button><br><br>
 <a href="home.php">torna al blog</a>
 <p id="register_output"></p>

</body>
</html>
 <script>$(document).ready(function(){
        $("#btn1").click(function(){
            var nom= $("#v1").val();
            var nu="primo";
            var blg=<?php echo $blog; ?>;
var data = "nom=" + nom + "&des=" + nu + "&blog=" + blg;

            $.ajax({
                method: "post",
                url: "moderatoriajax.php",
                data: data,
                
            })
            alert(nom + ' ' + 'inserito');
        });
    });

    $(document).ready(function(){
        $("#btn2").click(function(){
            var nom= $("#v2").val();
            var nu="se";
            var blg=<?php echo $blog; ?>;
var data = "nom=" + nom + "&des=" + nu + "&blog=" + blg;

            $.ajax({
                method: "post",
                url: "moderatoriajax.php",
                data: data,
                
                
            })
            alert(nom + ' ' + 'inserito');
        });
    });
    </script>