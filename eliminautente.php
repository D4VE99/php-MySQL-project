<?php 
include 'connection.php';
session_start();
$nome=$_SESSION["nomeut"];
$ql=mysqli_query($conn, "DELETE from utente where nomeutente= '$nome'");
$_SESSION["nomeut"]="guest";
header("location:scegliblog.php");

?>
<!-- dopo aver eliminato l'utente registrato trovandolo grazie al valore salvato nella session, do a quel campo session il valore di guest che sarebbe il visitatore non iscritto e torno alla home -->