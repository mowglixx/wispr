<?php require('core.common.php');
//Search page php
$sq		= htmlspecialchars($_POST['q'], ENT_QUOTES); 
$stmt = $db->query("SELECT `username`, disp_name, `title`, `profilepic` FROM users WHERE (`username` LIKE '%{$sq}%') OR (`disp_name` LIKE '%{$sq}%') OR (`email` LIKE '%{$sq}%');"); 
$viewprofile['user'] = $stmt->fetchAll(PDO::FETCH_ASSOC);	 	
?>
<!DOCTYPE html>
<html class="no-js" xmlns="http://www.w3.org/1999/xhtml">
    <!-- #BeginTemplate "Template.dwt" -->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- #BeginEditable "title" -->
		<title>Wispr - Search <?php echo $sq;?></title>
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
        <form action="search.php" method="post" class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control col-lg-12 col-md-12 col-sm-12" placeholder="Search..." name="q">
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



	<div class="container">
  <button data-toggle="collapse" data-target="#code">show dev console</button>
<div id="code" class="collapse">
<pre>
<?php 
var_dump($viewprofile);
?>
</pre>
</div>
<h1>Search</h1>
	<div class="col-lg-10 col-md-10 col-sm-10">
	<p class="lead">Here are your results for <em>"<?php echo $sq; ?>"</em></p>
		
	<?php foreach($viewprofile['user'] as $row): ?>
	 <?php //-------------!HELPERS!----------------//
		    //Empty Profile pic, displays default display pic
		    if(empty($row['profilepic'])){
			$propic = "https://picsum.photos/500/500/?random=".random_int(0,1000);}
			elseif(!empty($row['profilepic'])) {
			$propic = $row['profilepic'];
			};
			//empty display name show username
			if(empty($row['disp_name'])){
			$dispname = $row['username'];}
			elseif(!empty($row['disp_name'])) {
			$dispname = $row['disp_name'];
			};?>
			
	<div class="media">
    <a class="media-left media-middle" href="/<?php echo $row['username'];?>"><img class="media-img" src="<?php echo $propic; ?>" alt="display picture of <?php echo $dispname ?>"></a>
  	<div class="media-body">
  	<h4 class="media-heading"><a href="/<?php echo $row['username'];?>"><?php echo $dispname;?></a></h4>
  	<?php echo $row['title'];?>
  	</div>
  </div>
	<?php endforeach; ?>
	</div>
	
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs"><script src="js/ads_searchscraper.js"></script></div>



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
