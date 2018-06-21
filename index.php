<?php 
session_start();

require_once('database.php');

	$getImages = "SELECT * FROM images ORDER BY created_at DESC";
	$posts_result = mysqli_query($conn, $getImages);
	$res = mysqli_num_rows($posts_result);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Multple Images</title>
</head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="alert.js"></script>

<style type="text/css">
	.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }
	.alertt {
	padding: 20px;
    background-color: #f44336; /* Red */
    color: white;
    margin-bottom: 15px;
	}
    /*body{background: #eee url(http://subtlepatterns.com/patterns/sativa.png);}*/
}
</style>
<script type="text/javascript">
$( document ).ready(function() {    
    $("#images").on('change', function () {
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
       /*  alert("Pls select only images");
         return false;*/
         var errName = $("#errorMsg"); //Element selector
   		 errName.html("Only JPG, PNG or GIF files are allowed! Your file "+ extn);
   		 errName.attr("class", "alertt");
   		 //errName.fadeOut(3000, function() { errName });
   		 $("#errorMsg").delay(3000).slideUp(300);
   		 $("#images").val('');
         return false;
     }
 })
    $("#successMessage").delay(3000).slideUp(300);
});

function validate()
	{
		if(document.myform.images.value == "")
		{
			document.getElementById("images").style.borderColor = "red";
			document.myform.images.focus();
			return false;
		}
	}

</script>
<body>
 <!-- <input type="file" name="images[]" id="images" multiple > -->
<!-- display upload status -->
	<center><div class="container"><br>
		<?php if( isset($_SESSION['Error']) )
		{ ?>
		<div id="successMessage" class="alert alert-success alert-dismissible">
		  <strong>Success!</strong> <?php echo $_SESSION['Error']; ?>
		</div>
		<?php unset($_SESSION['Error']);} ?>
		<br>
		<?php if( isset($_SESSION['msg']) )
		{ ?>
		<div id="successMessage" class="alert alert-danger alert-dismissible">
		  <strong>Error!</strong> <?php echo $_SESSION['msg']; ?>
		</div>
		<?php unset($_SESSION['msg']);} ?>
		<form method="post" id="uploadForm" onsubmit="return(validate());" name="myform" enctype="multipart/form-data" action="upload.php">
	    <label class="label"><i class="fa fa-upload"></i> Choose Images</label>
	  <!--   <div class="input-group"> -->
        <input type="file" name="images[]" id="images" multiple >
	    <span >
	    	<input class="btn btn-success btn-sm" type="submit" name="submit" value="UPLOAD" />
	    </span>
	</form>
	<div id="image-holder"></div>
	<div id="errorMsg" ></div>
	<br>
    <div class="row col-md-6 col-md-offset-2 custyle">
    <table class="table table-striped custab">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>CreateDate</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <?php $i = 1 ; while($posts_result_rows = mysqli_fetch_assoc($posts_result)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                	<img class="rounded-circle" src="uploads/<?php echo $posts_result_rows['image']; ?>" width=80 height=70 alt="no image" >
                </td>
                <td><?php echo date('d-m-Y', strtotime($posts_result_rows['created_at'])); ?></td>
                <td class="text-center"><a class='btn btn-info btn-xs' href="edit.php?id=<?php echo $posts_result_rows['id'] ?>"><span class="glyphicon glyphicon-edit"></span> <i class="fa fa-edit" ></i>Edit</a> <a onClick="return confirm('Are you sure you want to delete this record?')" href="delete.php?id=<?php echo $posts_result_rows['id'] ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span><i class="fa fa-trash" ></i> Delete</a></td>
            </tr>
     <?php $i++; }  ?>       
    </table>
    </div>
</div></center>				

</body>
</html>