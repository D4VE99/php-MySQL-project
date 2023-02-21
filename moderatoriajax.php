<?php
include 'connection.php';
session_start();
$nom = $_POST['nom'];
$des = $_POST['des'];
$blog = $_POST['blog'];
$nom= filter_var($nom, FILTER_SANITIZE_STRING);
$des= filter_var($des, FILTER_SANITIZE_STRING);
$blog= filter_var($blog, FILTER_SANITIZE_STRING);
if($des==="primo"){
    $sql= mysqli_query($conn, "UPDATE blog Set coautore1='$nom' where idblog='$blog' ");
  
    
}else{
    $sql= mysqli_query($conn, "UPDATE blog Set coautore2='$nom' where idblog='$blog' ");
}

?>