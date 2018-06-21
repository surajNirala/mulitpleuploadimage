<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once('database.php');
if(isset($_POST['submit'])){
    $targetDir = "uploads/";
    $allowTypes = array('jpg','png','jpeg','gif');
    
    $images_arr = array();
    foreach($_FILES['images']['name'] as $key=>$val){
        if($_FILES['images']['name'][$key] == ''){
            $_SESSION['msg'] = "Please select the image.";
            header("Location: index.php");
            return false;
        }
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name   = $_FILES['images']['tmp_name'][$key];
        $size       = $_FILES['images']['size'][$key];
        $type       = $_FILES['images']['type'][$key];
        $error      = $_FILES['images']['error'][$key];

        //print_r($image_name);
        
        // File upload path
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = __DIR__."/uploads/". $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){   
        $sql = "INSERT INTO images (image) value ('".$image_name."')";
        $Inserted = mysqli_query($conn, $sql);
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                chmod($targetFilePath, 0755);
                $images_arr[] = $targetFilePath;
            $_SESSION['Error'] = "Image upload successfully.";
            header("Location: index.php");
            }else{
                echo 'not upload';
            }
        }else{
            $_SESSION['msg']  = "Only JPG, PNG or GIF files are allowed! Your file ". $type;
             header("Location: index.php");
        }
    }
}
?>

