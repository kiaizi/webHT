<?php
include('snapshot.class.php');

class CropThumbImage{
	function createThumbImage($storeThumbDir,$imagePath,$width,$height,$resize,$resizeScale,$snapShotPosition,$compression){
	
		$myimage = new ImageSnapshot;
		
		
		
		$lastSlashPos =  strrpos($imagePath,"/");
		$imageBase =  substr($imagePath,0,$lastSlashPos );
		$imageName =  substr($imagePath,$lastSlashPos + 1);
		
		
		

		
		
		$myimage->ImageFile = $imageBase."/".$imageName;
	
		$myimage->Width = $width;
		$myimage->Height =  $height;
		$myimage->Resize = $resize; //if false, snapshot takes a portion from the unsized image.
		$myimage->ResizeScale = $resizeScale; //0 -100
		//"center","random","topleft","topcenter","topright","bottomleft","bottomcenter","bottomright"
		$myimage->Position =$snapShotPosition;
		$myimage->Compression=$compression;	//e.g.100
		
		
		if($storeThumbDir != ''){
			$thumbFolder = $imageBase."/".$storeThumbDir;
		}else{
			$thumbFolder = $imageBase;
		}
		
		
		
		if (!is_dir($thumbFolder)){
			mkdir( $thumbFolder, 777);
		}
		
		
		
		$thumbImage = $thumbFolder."/".$imageName;
	
		
		
		
		if($myimage->SaveImageAs($thumbImage)){
		
			$thumbImageSize = getimagesize($thumbImage);
			$thumbImageWidth = $thumbImageSize[0];
			$thumbImageHeight = $thumbImageSize[1];
			
			$widthDiff = ($width - $thumbImageWidth)/2;
			$heightDiff = ($height - $thumbImageHeight)/2;
			
			
			$thumbImageInfo["widthDiff"] = $widthDiff;
			$thumbImageInfo["heightDiff"] = $heightDiff;
			$thumbImageInfo["width"] = $thumbImageWidth;
			$thumbImageInfo["height"] = $thumbImageHeight;
			$thumbImageInfo["imagePath"] = $thumbImage;
			return $thumbImageInfo;
		}
		
		return $myimage->Err;
		
	}
}



?>
