<?php 
session_start();
require_once('database.php');

error_reporting(E_ALL & ~E_NOTICE);

$id = $_GET['id'];

$sql = "DELETE FROM images WHERE id = $id";

$posts_result = mysqli_query($conn, $sql);

if($posts_result){
	/*echo "<script>
		   		 alert('Delete Successfully ...');
		    	 window.location.href='index.php';
		    </script>"*/;
	$_SESSION['Error']  = "Image Delete Successfully...";
	header('Location:index.php');    
}else{
	$_SESSION['msg']  = "Not delete Successfully.";
	header('Location:index.php'); 
}

?>