<?php
require('core.common.php');
$picid = $_GET['id'];
$progress = 0;
	
	
	$stmt0 = $db->prepare("SELECT * FROM img_usr WHERE pic_id='{$picid}';");
 		$stmt0->execute();
 		$file = $stmt0->fetchAll();
 		$profilepic = $file[0]['imgname'];
 		$stmt1 = $db->prepare("UPDATE users SET profilepic='{$profilepic}' WHERE username='{$profile['username']}';");
 		if($stmt1->execute()){
 		$progress = 1;};
 		if($progress == 1){
 			header("location: pictures.php?id=".$profile['username']);
 		};

