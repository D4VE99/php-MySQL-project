<?php
include 'connection.php';
//creo un array di categorie che verranno mostrate nel caso abbiano le stesse lettere della ricerca nella pagina home
$rows=mysqli_query($conn, "SELECT * FROM blog");

foreach($rows as $row):
    $a[]=$row['nomeb'];

endforeach;

$q = $_REQUEST["q"];

$hint = "";
echo "<p style='display:none;'>";?>

    <?php

if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {$j=$name;
            if ($hint === "") {
                $hint = $name;
                 $rows1=mysqli_query($conn, "SELECT * FROM blog where nomeb='$hint'");
                    foreach ($rows1 as $row1):
                    ?><div style="display:inline-block; padding:10px;">
                        <p style="vertical-align:top;margin-top:10px;background-color:<?php echo $row1['colore']; ?>;border:1px solid black;border-radius:10px;width:200px;height:200px;">
                        <br><br><br><a style="font-family:<?php echo $row1['stile']?>;height:50px;vertical-align:middle;"> <b><?php echo $row1['nomeb']?></b></a><br>
                        <br><button value="<?php echo $row1['idblog'] ?>" onclick='al(this.value)'>entra</button><br>
                    </p><?php endforeach;
                
            } else {
                
                $hint .= ", $name";
               
            }
        }
    }
}

echo "</p>";
//metto come output  inesistente per far sapere che non esiste il blog cercato
echo $hint === "" ? " inesistente" : $hint;
?>
