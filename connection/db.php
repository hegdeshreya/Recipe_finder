<?php
$server="localhost";
$username="root";
$port = 4306;
$password="";
$database="recipefinder";

$conn = mysqli_connect($server, $username, $password, $database,$port);
//  if($conn){
//          echo"success";
//      }
//  else {
//        die("Error". mysqli_connect_error());
//   }

?>
