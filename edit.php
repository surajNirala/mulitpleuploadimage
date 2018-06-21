<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
require_once('database.php');

$id = $_GET['id'];

$getImages = "SELECT * FROM images where id = $id";
	$posts_result = mysqli_query($conn, $getImages);
	$res = mysqli_num_rows($posts_result);
	if($res > 0){
		$data = ($totalImage = mysqli_fetch_assoc($posts_result));
		
	}else{
		echo "not found any imges";
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Image</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style type="text/css">
	body{background: #eee url(http://subtlepatterns.com/patterns/sativa.png);}
	.btn-block {
	display: block;
	width: 44%;
	}
	.alertt {
	padding: 20px;
    background-color: #f44336; /* Red */
    color: white;
    margin-bottom: 15px;
	}
</style>
<script type="text/javascript">
$( document ).ready(function() {
    
    $("#images").on('change', function () {

     //Get count of selected files
     var countFiles = $(this)[0].files.length;

     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#image-holder");
     image_holder.empty();

     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {

             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {

                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumb-image",
                             "height":"100",
                             "width":"100",
                     }).appendTo(image_holder);
                 }

                 image_holder.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }

         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         var errName = $("#errorMsg"); //Element selector
   		 errName.html("Only JPG, PNG or GIF files are allowed! Your file "+ extn);
   		 errName.attr("class", "alertt");
   		 return false;
     }
 });
});
</script>
<body>
	<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-md-9 text-center">
			<form name="edit_news" action="uploadimage.php" method="post" enctype="multipart/form-data" class="pic-template">    
			    <h3 class="text-center"> Change picture </h3>
			    <?php if( isset($_SESSION['msg']) )
				{ ?>
				<div class="alert alert-danger alert-dismissible">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>Error!</strong> <?php echo $_SESSION['msg']; ?>
				</div>
				<?php unset($_SESSION['msg']);} ?> 
				<div id="errorMsg"></div>
			    <img class="img-thumbnail" src="uploads/<?php echo $data['image']; ?>" alt="no Image" width=350 height=130 >
			    <div style="padding-top:20px; ">	 
					<span class="input-group-btn">
						<span class="btn btn-default btn-file">
							<input type="file" name="images" id="images" />
						</span>
					</span>
			    </div>
			    <input type="hidden" name="id" value="<?php echo $id ;?>" />
			    <input type="hidden" name="existImage" value="<?php echo $data['image'] ;?>" />

			    <!-- div submit start-->
			    <div style="margin:10px 0 0 0" >
			    <center><button class="btn btn-info btn-block" type="submit" name="updateimage">Update</button></center>
			    <div id="image-holder"></div>
			    <br>
			    <center><a href="index.php">Back</a></center>
			    </div>
			    <!--div submit end -->
			</form>
		</div>
	</div>
</div>
</body>
</html>