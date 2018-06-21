<?php 
session_start();
require_once('database.php');
if(isset($_POST['updateimage'])){

	$id = $_POST['id'];
	$getimage = $_POST['existImage'];
	$fileName = $_FILES['images']['name'];
	$tmpName  = $_FILES['images']['tmp_name'];
	//print_r($tmpName);
	$targetDir = "uploads/"; 
	$allowTypes = array('jpg','png','jpeg','gif');
	$fileName = basename($_FILES['images']['name']);
	if(!empty($fileName)){
	$targetFilePath = __DIR__."/uploads/". $fileName;
    $existFilePath = __DIR__."/uploads/". $getimage;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    if(in_array($fileType, $allowTypes)){
    if($fileName){
    	$sql = "UPDATE images SET image='$fileName' WHERE id=$id";
        $runQuery = mysqli_query($conn, $sql);

        //print_r($runQuery);
        if($runQuery){
        	if (file_exists($existFilePath))
			{
			unlink($existFilePath);
			}
        	move_uploaded_file($tmpName,$targetFilePath);
		    $_SESSION['Error'] = "Successfully Updated...";
            header("Location: index.php");

        }else{
        	echo "not update.";
        }
    }else{
    	/*echo "<script>
		   		 alert('Plz select image..');
		   		 window.location.href='edit.php?id=$id';
		    </script>";*/
		    $_SESSION['msg'] = "Please select Image..";
            header("Location: edit.php?id=$id");
    }
    }else{
    	$_SESSION['msg']  = "Only JPG, JPEG, PNG or GIF files are allowed";
        header("Location: edit.php?id=$id");
    }
	}else{
		 $_SESSION['Error'] = "Successfully Updated..";
         header("Location: index.php");
    }
    
}

?>