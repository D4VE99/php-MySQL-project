<?php
include 'connection.php';
$rows=mysqli_query($conn, "SELECT nomeutente FROM utente order by nomeutente desc");
foreach($rows as $row):
     $a[]=$row['nomeutente'];
  
endforeach;

$q = $_REQUEST["q"];

$hint = "";
echo "<p style='display:none;'>";

if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}
echo "</p>";

echo $hint === "" ? "nome utente libero" : $hint;

?>
<!-- creo un array con tutti i nomi utente e che poi manda la risposta alla funzione che mostra i nomiutente già utilizzati -->