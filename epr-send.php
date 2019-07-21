<?php 
    require("core.common.php"); 
    $id       = $user['id'];
    $noscript = array("<script>", "<script", "< script", "<javascript>", "<javascript", "< javascript", "<?");
    $about 	  = str_replace($noscript, "&nbsp;", $_POST['about']);
    $title    = str_replace($noscript, "&nbsp;", $_POST['title']);
    $dn    = str_replace($noscript, "&nbsp;", $_POST['disp_name']);
    
    //PDO or SQL Stuff BLAH!
    $stmt = $db->prepare("UPDATE users SET about=:about, title=:title, disp_name=:dn WHERE id=:id");
    $stmt->bindValue(':about', $about, PDO::PARAM_STR);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':dn', $dn, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
 	$stmt->execute();
 	if($stmt->execute()){
        header("Location: editprofile.php?p=success");
    };

