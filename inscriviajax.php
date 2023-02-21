
<?php
include 'connection.php';
session_start();
$nome=$_SESSION["nomeut"];
$nom = $_POST['nom'];
$des = $_POST['des'];
$stil = $_POST['stil'];
$col = $_POST['col'];
$r=0;
$row=mysqli_query($conn, "SELECT nomeb from blog where blog.nomeb='$nom' ");
foreach($row as $rows):
  $r++;
endforeach;
if(!$nom & !$des)
{
  echo "nome e descrizione sono fondamentali!";
}else{
  if(!$nom){
    echo "inserisci nome";
  }else{
    if(!$des){
      echo "inserisci descrizione";
    }else{
      if(($nome=="guest")||($nome=="")||($nome==null)){
        echo "<script>alert('iscriviti prima di poter creare blog')</script>";
      }
      else {if($r>0){
        echo "nome esistente";
        $r=0;
      }else{mysqli_query($conn, "INSERT INTO blog (blog.nomeb,blog.descrizione, blog.stile, blog.colore) 
        VALUES ('$nom','$des','$stil','$col')"); 

        $row=mysqli_query($conn, "SELECT idblog from blog where blog.nomeb='$nom' ");
        foreach($row as $rows):
          $newid=$rows['idblog'];
        endforeach;
        mysqli_query($conn, "INSERT INTO scrive VALUES ('$newid', '$nome')");
        echo "success";
      }}
    }
  }
}
?>