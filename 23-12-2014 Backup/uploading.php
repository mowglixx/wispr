<?php
require('core.common.php');
$rdr = $_GET['rdr'];
$caption = $_POST['caption'];
$userimg = 'img/userimages/'. $profile['username'];
if (!file_exists($userimg)) {
    mkdir($userimg, 0777, true);
    $uploadOk = 1;
}elseif(file_exists($userimg)) {
	$uploadOk = 1;
}


$target_dir = "img/userimages/". $profile['username'] ."/";
$uploadOk = 1;
$target_file_dirty = $target_dir . basename($_FILES["chg-propic"]["name"]);
$imageFileType = pathinfo($target_file_dirty,PATHINFO_EXTENSION);
$target_file = $target_dir . SHA1($target_file_dirty). "." . $imageFileType;


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["chg-propic"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $target_file = $target_dir . MD5(SHA1($target_file_dirty). rand(1000,999999)) . "." . $imageFileType;;
    $uploadOk = 1;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"&& $imageFileType != "PNG"&& $imageFileType != "JPG"
&& $imageFileType != "JPEG"&& $imageFileType != "GIF" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 

else {
    if (move_uploaded_file($_FILES["chg-propic"]["tmp_name"], $target_file)) { //if2
        $stmt = $db->prepare("INSERT INTO img_usr (username, caption, imgname) VALUES ('{$profile['username']}', '{$caption}', '{$target_file}');");
 		$stmt->execute();
 		$uploadedok = 1;
		 	if($uploadedok == 1 && $_POST['chg-dp'] == 1){ //if2.1
				$stmt2 = $db->prepare("UPDATE users SET profilepic='{$target_file}' WHERE username='{$profile['username']}'");
		 		$stmt2->execute();
		 		$uploadedok = 1;
					if($uploadedok == 1){ 
						header("Location: pictures.php?id=" . $profile['username'] . "&i=success");} //success pics rdr
										
			        else{
			        	header("Location: pictures.php?id=" . $profile['username'] . "&i=fail");} //Success home rdr
		    } //end if2.1
	if($rdr == "home"){ 
		header("Location: home.php?i=success");}
	 if($rdr == "pics"){ 
		header("Location: pictures.php?id=" . $profile['username'] . "&i=success");}}//end if2
    else {
        header("Location: home.php?i=failp");}//FAIL
    }; 