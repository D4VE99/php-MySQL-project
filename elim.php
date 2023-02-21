<?php
include 'connection.php';
session_start();


if (isset($_COOKIE["temp"])){$h = $_COOKIE["temp"];} 
else{echo "Cookie Not Set";}

$sql=mysqli_query($conn,"DELETE from post where idpost='$h'");
header("location:profile.php");

?>
<!-- se il cookie temp ha un valore allora cerco quel valore in idpost e elimino il post con quel valore id -->