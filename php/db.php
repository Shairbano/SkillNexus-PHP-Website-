<?php
$host='localhost';
$user='root';
$password=null;
$database='partner_connect';
$connection=mysqli_connect($host,$user,$password,$database);
if(!$connection){
    die("Database connection failed: " . mysqli_connect_error());
}
else
{
   //echo("Connected successfully to the database.");
}
?>