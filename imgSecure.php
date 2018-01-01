<?php

// an attempt at making images a little bit harder to save online

function jQuery(){
	return "<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
}

function block_all_actions(){
	return '
	<script type="text/javascript">
	$(document).ready(function () {
		//Disable cut copy paste
		$("body").bind("cut copy paste", function (e) {
			e.preventDefault();
		});
   
		//Disable mouse right click
		$("body").on("contextmenu",function(e){
			return false;
		});
	});
</script>';
}

function imgSecure($imagePath){
	$type = pathinfo($imagePath, PATHINFO_EXTENSION);
	$data = file_get_contents($imagePath);
	$encoded = 'data:image/' . $type . ';base64,' . base64_encode($data);
	list($width, $height) = getimagesize($imagePath);
	$bkig = "<div style='background-image:url(\"$encoded\"); width: $width; height:$height; display:inline-block;'>&nbsp;</div>";
	return $bkig;
}

echo jQuery();

echo imgSecure("image.jpg");

echo block_all_actions();
