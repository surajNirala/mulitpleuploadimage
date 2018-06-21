<?php 

error_reporting(E_ALL & ~E_NOTICE);

$conn = mysqli_connect("localhost","root","suraj@321","testing");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

 ?>