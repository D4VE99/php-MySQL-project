<?php
include 'connection.php';
session_start();
$des = $_POST['des'];
$blog = $_POST['nom'];

if($des==="blog"){
    $sql= mysqli_query($conn, "DELETE FROM blog WHERE idblog='$blog' ");
    $sql= mysqli_query($conn, "DELETE FROM post WHERE idblog='$blog'  ");
   
}else{
    $sql= mysqli_query($conn, "DELETE FROM post WHERE idpost='$blog'  ");
}

?>