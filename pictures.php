<?php 
    require('core.common.php'); 
    $getid = $_GET['id'];
    $viewid = $_GET['viewpic'];
    $stmt1 = $db->query("SELECT disp_name, username, profilepic FROM users WHERE username = '{$getid}'");
 	$stmt1->execute();
 	$viewprofile = $stmt1->fetch(PDO::FETCH_ASSOC);
 	
 	if(empty($viewid)){ //if on gallery get all pics
	 	$stmt2 = $db->query("SELECT pic_id, imgname, caption FROM img_usr WHERE username = '{$getid}'");
	 	$stmt2->execute();
	 	$pics = $stmt2->fetchAll();}
 	elseif(!empty($viewid)){ //if on viewer pull only one pic 
	 	$stmt3 = $db->query("SELECT pic_id, imgname, caption FROM img_usr WHERE pic_id = '{$viewid}'");
	 	$stmt3->execute();
	 	$viewpic = $stmt3->fetch(PDO::FETCH_ASSOC);};

	
	//Empty Profile pic, displays default display pic
	if(empty($viewprofile['disp_name'])){
		$dispname = $viewprofile['username'];}
	elseif(!empty($viewprofile['disp_name'])) {
		$dispname = htmlspecialchars($viewprofile['disp_name'], ENT_QUOTES);
		};

?>
<!DOCTYPE html>
<html class="no-js">
<!-- #BeginTemplate "Template.dwt" -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <!-- #BeginEditable "title" -->
  <title>Pictures - <?php echo $dispname;?></title>
  <!-- #EndEditable -->
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      padding-top: 50px;
      padding-bottom: 20px;
    }
  </style>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/jasny-bootstrap.min.css">
  <link rel="stylesheet" href="css/jasny-bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/jasny-bootstrap.min.js"></script>

</head>

<body>


  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home.php">Wispr <span class="label label-info">Beta</span></a>
      </div>
      <div class="navbar-collapse collapse">
        <div class="center-block">
          <form action="search.php" method="get" class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control col-lg-12 col-md-12 col-sm-12 disabled" placeholder="Search..."
                name="q" disabled="disabled">
            </div>
          </form>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <?php if(!empty($user)): ?>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                class="glyphicon glyphicon-user"></span> <?php echo $profile['username'];?> <span
                class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="editprofile.php"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a></li>
              <li><a href="/<?php echo $profile['username'];?>"><span class="glyphicon glyphicon-user"></span> View
                  Profile</a></li>
              <li class="divider"></li>
              <li><a href="messages.php"><del><span class="glyphicon glyphicon-envelope"></span> Messages</del></a></li>
              <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
            </ul>
          </li>
          <?php endif;?>

        </ul>
      </div>
      <!--/.navbar-collapse -->
    </div>
  </div>

  <div class="container">
    <div class="row">
      <p>&nbsp;</p>
      <div id="ads" class="col-md-5 col-md-offset-2 hidden-sm hidden-xs">
        <script src="js/ads_banner.js"></script>
      </div>
    </div>
  </div>
  <div class="container">
    <!-- #BeginEditable "Body" -->



    <h1><?php 
	if($viewprofile['username'] == $profile['username']){echo 'Your';}
	else{echo '<a href="/' . $viewprofile['username'] . '">' . $dispname . '&apos;s</a>';};?> Pictures
      <small><?php if($getid == $profile['username'] && $pic['imgname'] !== $viewprofile['profilepic']): ?>
        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#uploadpic">Upload a
          Picture!</button>
        <?php endif;?></small></h1>
    <?php if(empty($viewid)): ?>
    <ol class="breadcrumb">
      <li><a href="/<?php echo $getid; ?>"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
      <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li><a href="/<?php echo $getid; ?>"><?php echo $dispname; ?></a></li>
      <li class="active">Pictures</li>
    </ol>


    <?php if($_GET['i'] == "success"){
	echo '<div class="alert-message alert alert-success alert-dismissable alert-fixed-bottom fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><span class="glyphicon glyphicon-ok"></span> <strong>Uploaded!</strong></div>';
};?>
    <hr>
    <?php if(empty($pics)): ?>
    <h2><?php echo $dispname; ?> has no pictures! D=</h2>
    <?php endif;?>
    <div class="row">
      <?php foreach($pics as $pic):?>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="?id=<?php echo $getid; ?>&viewpic=<?php echo $pic['pic_id']; ?>"><img
              src="<?php echo $pic['imgname'];?>" class="img-responsive img-rounded propic-pro"
              alt="picture uploaded by <?php echo htmlspecialchars($dispname, ENT_QUOTES);?> Caption = <?php echo htmlspecialchars($pic['caption'], ENT_QUOTES); ?>"></a>
          <div class="caption">
            <p><?php echo $pic['caption'];?>&nbsp;</p>
            <?php if($getid == $profile['username'] && $pic['imgname'] !== $viewprofile['profilepic']): ?>
            <div class="container-fluid">
              <a class="btn btn-info pull-left" href="mk-propic.php?id=<?php echo $pic['pic_id'];?>"><span
                  class="glyphicon glyphicon-user"></span> Make Profile Pic</a> <a class="btn btn-danger pull-right"
                href="del-propic.php?id=<?php echo $pic['pic_id'];?>"><span class="glyphicon glyphicon-trash"></span>
                Delete</a></div>
            <?php endif;?>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>

    <!--{ VIEWING PICTURES! }-->
    <?php elseif(!empty($viewid)): ?>
    <ol class="breadcrumb">
      <li><a href="pictures.php?id=<?php echo $getid; ?>"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
      </li>
      <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li><a href="/<?php echo $getid; ?>"><?php echo $dispname; ?></a></li>
      <li><a href="pictures.php?id=<?php echo $getid; ?>">Pictures</a></li>
      <li class="active"><?php if(empty($viewpic['caption'])){echo "This picture";}else{echo $viewpic['caption'];}?>
      </li>
    </ol>
    <img
      alt="picture uploaded by <?php echo htmlspecialchars($dispname, ENT_QUOTES);?> Caption = <?php echo htmlspecialchars($viewpic['caption'], ENT_QUOTES); ?>"
      class="img-responsive img800 center-block" src="<?php echo $viewpic['imgname'];?>">
    <h2><?php echo $viewpic['caption'];?></h2>
    <h3>Comments <small>Coming Soon</small></h3>

    <?php endif; ?>

    <!-- Upload pictures  -->
    <div class="modal fade" id="uploadpic" tabindex="-1" role="dialog" aria-labelledby="Change Profile Pic"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span></button>
            <h4 class="modal-title">Upload a Picture!</h4>
          </div>
          <form action="uploading.php?rdr=pics" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label class="label" for="chg-propic">Image Upload</label>
                <input type="file" name="chg-propic"><br>
                <label class="label" for="caption">Caption</label>
                <input class="input-lg col-lg-12 col-md-12 col-sm-12 col-xs-12"
                  placeholder="Type a Caption for the image here..." name="caption"><br>
                <label for="chg-dp">
                  <input type="checkbox" value="1" name="chg-dp"> Make the new image my display picture <span
                    class="glyphicon glyphicon-question-sign"
                    title="Your Picture that is shown in search results and on your profile"></span>
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><span
                  class="glyphicon glyphicon-remove"></span> Cancel</button>
              <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span>
                Upload</button>

            </div>
          </form>
        </div>
      </div>
    </div>



    <!-- #EndEditable -->
  </div>
  <div class="container">
    <hr>


    <footer>
      <p>&copy; Wispr Productions 2014</p>
      <a href="#" class="disabled">Privacy</a> - <a href="#" class="disabled">T&amp;C</a> - <a href="#"
        class="disabled">Facebook</a> - <a href="#" class="disabled">Twitter</a>
    </footer>
  </div> <!-- /container -->
  <script src="js/jquery.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')
  </script>
  <script src="js/vendor/bootstrap.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
  <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <script>
    $(".alert-message").alert();
    window.setTimeout(function () {
      $(".alert-message").alert('close');
    }, 5000);
  </script>

  <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
  <script>
    (function (i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-56127426-1', 'auto');
    ga('send', 'pageview');
  </script>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
  </script>

</body>
<!-- #EndTemplate -->

</html>