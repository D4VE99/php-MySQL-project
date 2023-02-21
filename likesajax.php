<?php
include 'connection.php';
session_start();
$nome=$_SESSION["nomeut"];
$like = $_POST['like'];
$r=0;
$a=0;
$row=mysqli_query($conn, "SELECT idpost,nomeutente from mette where mette.idpost='$like' and mette.nomeutente='$nome' ");
foreach($row as $rows):
  $r++;
endforeach;
if(($r>0)||($nome=="guest"))
{
  die();
  echo "";
  $r=0;
}else{mysqli_query($conn, "INSERT INTO mette (mette.idpost,mette.nomeutente) 
        VALUES ('$like','$nome')"); 

$row=mysqli_query($conn, "SELECT idpost from likes where idpost='$like' ");
        foreach($row as $rows):
          $a++;
        endforeach;
        if($a==0){mysqli_query($conn, "INSERT INTO likes VALUES ( 1, '$like')");

            
          
        }else{mysqli_query($conn, "UPDATE likes SET likes.likes=(likes.likes+1) where idpost='$like' ");
            

          
        
        }
      }
        
?>