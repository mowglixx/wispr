<?php require('core.common.php');?>
<!DOCTYPE html>
<html class="no-js">
    <!-- #BeginTemplate "Template.dwt" -->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- #BeginEditable "title" -->
		<title>Wispr Beta&nbsp; Home</title>
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
    <div id="ads" class="col-md-5 col-md-offset-2 hidden-sm hidden-xs">
		<script src="js/ads_banner.js"></script></div>
    </div>
    </div>
    <div class="container">
          <!-- #BeginEditable "Body" -->

<?php

$friend_a = $_GET['a']; // Recipient
$friend_b = $profile['username']; // Sender

$stmt0 = $db->query("SELECT 
    *
FROM
    friends
WHERE
    	friend_a = '{$friend_a}'
        AND friend_b = '{$friend_b}'
        OR 
        friend_a = '{$friend_b}'
        AND friend_b = '{$friend_a}'
 		AND approved = '1';");
 	$friendcheck = $stmt0->fetch(PDO::FETCH_ASSOC);

if($friend_a == $friend_b){ echo "<h3>You are trying to add yourself! =/</h3>"; } else{
if($friendcheck['approved'] == '1'){ echo "<h3>You are friends with " . $friend_a . "!</h3>"; }
if($friendcheck['approved'] !== '1'){ echo "<h3>You are not friends with " . $friend_a . "!</h3>"; };
};

echo "friend_a = ". $friend_a;
echo "<br>";
echo "friend_b = ". $friend_b;
echo "<br>";
echo "<h2>&#36;friendcheck Array Summary</h2>";
echo "<pre>";
if(!empty($friendcheck)){
print_r ($friendcheck);}
else{ print "if you are not friends this message should be here, if you are something is wrong...";};
echo "</pre>";?>


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
