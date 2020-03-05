<?php

$servername="localhost";
  $username="root";
  $password="root";
  $database="mysqli";
  $conn=new mysqli($servername,$username,$password,$database);
  if(!$conn)
  {
  	 die("Connection Falied".$conn->connect_error);
  }
 



?>