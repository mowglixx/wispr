<? require('core.common.php'); 
if(empty($_SESSION['user'])) 
    { header("Location: index.php"); 
      die('You need to log in...');};
      
      	//Empty Profile pic, displays default display pic
	if(empty($profile['profilepic'])){
		$propic = "img/DefaultUserImg.jpg";}
	elseif(!empty($profile['profilepic'])) {
		$propic = $profile['profilepic'];
		};

      
      ?>
<!DOCTYPE html>
<html class="no-js">
    <!-- #BeginTemplate "Template.dwt" -->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- #BeginEditable "title" -->
		<title>Wispr - <?php print $user['username']; ?></title>
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
          <input type="text" class="form-control col-lg-12 col-md-12 col-sm-12 disabled" placeholder="Search..." name="q" disabled="disabled">
        </div>
      </form>
      </div>
         <ul class="nav navbar-nav navbar-right">
         <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
         <?php if(!empty($user)): ?>
		 <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $profile['username'];?> <span class="caret"></span></a>
	         <ul class="dropdown-menu" role="menu">
		         <li><a href="editprofile.php"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a></li>
		         <li><a href="/<?php echo $profile['username'];?>"><span class="glyphicon glyphicon-user"></span> View Profile</a></li>
		         <li class="divider"></li>
		         <li><a href="messages.php"><del><span class="glyphicon glyphicon-envelope"></span> Messages</del></a></li>
		         <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
	         </ul></li>
	     <?php endif;?>
         
         </ul>
         </div><!--/.navbar-collapse -->
      </div>
    </div>
    
    <div class="container">
    <div class="row">
    <p>&nbsp;</p>
    <div id="ads" class="col-md-5 col-md-offset-2 hidden-sm hidden-xs"><script src="js/ads_banner.js"></script></div>
    </div>
    </div>
    <div class="container">
          <!-- #BeginEditable "Body" -->



<div class="row"><h1>Home</h1></div>
<div class="row">
<!--[ COL1 ]-->	
<?php 

	if($_GET['i'] == "successp"){
		echo '<div class="alert alert-success alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
		<span class="sr-only">Close</span></button>
		<span class="glyphicon glyphicon-ok"></span> <strong>Uploaded!</strong></div>';
}elseif($_GET['i'] == "failp"){
		echo '<div class="alert alert-warning alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
		<span class="sr-only">Close</span></button>
		<span class="glyphicon glyphicon-remove"></span> <strong>Something went wrong!</strong></div>';
};?>
	<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><?php echo $profile['username']; ?></div>
			<div class="panel-body">
			<img class="img-responsive img-rounded" src="<?php echo $propic;?>" alt="<?php echo $profile['username']; ?>'s Display Picture"><br>
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chg-prof-pic">Upload Profile Picture</button>
</p>
			<p>Email: <a href="mailto:<?php echo $profile['email']; ?>"><?php echo $profile['email']; ?></a><br>
			</p>
			<span class="hidden-xs" ><label>Share</label> <input value="http://wisp-r.com/<?php echo $user['username']; ?>"></span>
			</div>
	</div>
	</div>
<!--[ COL2 ]-->
	<div class="col-md-4">
	<div class=" panel panel-default">
		<div class="panel-heading">Profile</div>
			<div class="panel-body">
			<span class="glyphicon glyphicon-user"></span> <?php echo $profile['username'];?><br>
				 <a href="editprofile.php"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a><br>
				 <a href="/<?php echo $profile['username'];?>"><span class="glyphicon glyphicon-user"></span> View Profile</a><br>
		         <a href="messages.php"><del><span class="glyphicon glyphicon-envelope"></span> Messages</del></a><br>
		         <a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a><br>

			</div>
	</div>
	</div>
<!--[ COL3 ]-->
<div class="col-md-4">
<!--[ SpeedyAds ]-->
<script src="js/ads_homebox.js"></script>
</div>



    </div>

<!-- Upload pictures  -->
<div class="modal fade" id="chg-prof-pic" tabindex="-1" role="dialog" aria-labelledby="Change Profile Pic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Change Your Profile Picture</h4>
      </div>
      <img class="img-responsive" alt="Current Display Picture" src="<?php echo $profile['profilepic'];?>">
      <form action="uploading.php?rdr=home" method="post" enctype="multipart/form-data" >
      <div class="modal-body">
        <div class="form-group">
        <label class="label" for="chg-propic">File Upload</label>
        <input id="chg-propic" name="chg-propic" type="file" accept="img/*" class="">
        <label>Caption</label><br>
		<input class="input-lg col-lg-12 col-md-12 col-sm-12 col-xs-12" placeholder="Type a Caption for the image here..." name="caption"><br>
        <label for="chg-dp">
        <input type="checkbox" value="1" name="chg-dp"> Make the new image my display picture <span class="glyphicon glyphicon-question-sign" title="Your Picture that is shown in search results and on your profile"></span>
        </label>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
        
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
        <a href="#" class="disabled">Privacy</a> - <a href="#" class="disabled">T&amp;C</a> - <a href="#" class="disabled">Facebook</a> - <a href="#" class="disabled">Twitter</a>
      </footer> 
    </div> <!-- /container -->        
	<script src="js/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script>
        $(".alert-message").alert();
			window.setTimeout(function() { $(".alert-message").alert('close'); }, 5000);
		</script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			  ga('create', 'UA-56127426-1', 'auto');
			  ga('send', 'pageview');
			</script>    
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>

</body>
<!-- #EndTemplate -->
</html>
