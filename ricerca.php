<?php
include 'connection.php';
//creo un array di categorie che verranno mostrate nel caso abbiano le stesse lettere della ricerca nella pagina home
$rows=mysqli_query($conn, "SELECT categoria FROM post GROUP BY categoria;");

foreach($rows as $row):
    $a[]=$row['categoria'];
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
//metto come output categoria inesistente per far sapere che ne sta creando una nuova
echo $hint === "" ? "categoria inesistente" : $hint;
?>