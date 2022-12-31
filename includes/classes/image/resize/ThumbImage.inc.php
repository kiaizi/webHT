<?php
include ('Thumbnail.class.php');

class ThumbImage{
	function createThumbImage($storeThumbDir,$imagePath,$width,$height){
	
		
		
		
		
		$lastSlashPos =  strrpos($imagePath,"/");
		$imageBase =  substr($imagePath,0,$lastSlashPos );
		$imageName =  substr($imagePath,$lastSlashPos + 1);
		
		
		$thumb=new Thumbnail($imagePath);
		
		
		
		
		$thumb->size($width,$height);		                // [OPTIONAL] set the biggest width and height for thumbnail
		$thumb->process(); 

		


		/////////////////////////////////
		// save image
		/////////////////////////////////
		if($storeThumbDir != ''){
			$thumbFolder = $imageBase."/".$storeThumbDir;
		}else{
			$thumbFolder = $imageBase;
		}

		if (!is_dir($thumbFolder)){
			mkdir( $thumbFolder, 777);
		}

		$thumbImage = $thumbFolder."/".$imageName;
		$status = $thumb->save($thumbImage);
		
		
		
		
		
		if ($status) {
			return $thumbImage;
		} else {
    		return 'ERROR: '.$thumb->error_msg;
		}
		
		
		
		
		
	}
}



?>
