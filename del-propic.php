<?php
require('core.common.php');
$picid = $_GET['id'];
$progress = 0;
	
	
	$stmt0 = $db->prepare("SELECT * FROM img_usr WHERE pic_id='{$picid}';");
 		$stmt0->execute();
 		$file = $stmt0->fetchAll();
 		//print $file[0]['imgname'];
 		unlink($file[0]['imgname']);
 		$progress = 1;
 		if($progress == 1){
 			$stmt1 = $db->prepare("DELETE FROM img_usr WHERE pic_id='{$picid}';");
 			$stmt1->execute();
 				$progress = 2;
 				if($progress == 2){
 					header("location: pictures.php?id=".$profile['username']);
 						}
 		};

