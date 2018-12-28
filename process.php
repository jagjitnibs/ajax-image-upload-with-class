<?php
############ Configuration ##############
$img_info["generate_image_file"]			= true;
$img_info["generate_thumbnails"]			= true;
$img_info["image_max_size"] 				= 500; //Maximum image size (height and width)
$img_info["thumbnail_size"]  				= 200; //Thumbnails will be cropped to 200x200 pixels
$img_info["thumbnail_prefix"]				= "thumb_"; //Normal thumb Prefix
$img_info["destination_folder"]				= 'home/ajax-img-upload/ajax-image-upload-advance/uploads/'; //upload directory ends with / (slash)
$img_info["thumbnail_destination_folder"]	= 'home/Websites/ajax-img-upload/ajax-image-upload-advance/uploads/thumbs/'; //upload directory ends with / (slash)
$img_info["quality"] 						= 90; //jpeg quality
$img_info["random_file_name"]				= true; //randomize each file name
##########################################

include("resize.class.php"); //include resize class

//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	//$var2 = $_POST["value1"]; 
	//$var2 = $_POST["value2"]; 
	
	if(isset($_FILES["image_file"])){
		
		$img_info["image_data"] = $_FILES["image_file"]; //specify file input field
		
		$im = new ImageResize($img_info);
		try{
			$response = $im->resize();
			
			echo json_encode(array( //output success message
				'type' => 'message', 
				'content' => $response
			));
			
		}catch(Exception $e){
			
			echo json_encode(array( //output error
				'type' => 'error', 
				'content' => $e->getMessage()
			));
		}
		
	}
		
}