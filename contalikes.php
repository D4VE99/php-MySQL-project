<?php
include 'connection.php';

$nw=$_COOKIE["zi"];
  $query=mysqli_query($conn,"SELECT likes.likes from likes where idpost='$nw'");
  foreach($query as $querys):
    echo $querys['likes'];
  endforeach;
  