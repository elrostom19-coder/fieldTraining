<?php 
$server="localhost";
$uname="root";
$pass="";
$dbname="training";
$conn=mysqli_connect($server , $uname,$pass,$dbname);
if (!$conn) {
    echo "error";
}
?>