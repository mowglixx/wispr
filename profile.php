<?php 
require('core.common.php'); 
  //get data from db based on sanatised $_GET['id']
    $getid = htmlspecialchars($_GET['id'], ENT_QUOTES);
    $stmt = $db->query("SELECT id, username, about, title, profilepic, disp_name FROM users WHERE username = '{$getid}'");
    $viewprofile = $stmt->fetch(PDO::FETCH_ASSOC);
      if(empty($viewprofile['id'])){
        header("Location: 404.php");};
  //-------------!HELPERS!----------------//
      //If Profile pic is empty display random display pic
        if(empty($viewprofile['profilepic'])){
          $propic = "https://picsum.photos/500/500/?random=".random_int(0,1000);}
        elseif(!empty($viewprofile['profilepic'])) {
          $propic = $viewprofile['profilepic'];
        };
      //If display name is empty show username in place
        if(empty($viewprofile['disp_name'])){
          $dispname = $viewprofile['username'];}
        elseif(!empty($viewprofile['disp_name'])) {
          $dispname = $viewprofile['disp_name'];
        };

      //No Profile Content Message
        if(!empty($viewprofile['about'])){
            $iabout = $viewprofile['about'];}
        elseif(empty($viewprofile['about'])){
            $iabout = $dispname . " has not entered anything...";
        };
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Wispr - <?php echo $dispname;?></title>
  <meta name="description" content="<?php echo $user['username']; ?>'s userprofile on wispr.">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--Jquery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <!--Import Google Icon Font-->
  <link href="css/icons.css" rel="stylesheet">

  <!--Import materialize css and js files-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <script src="js/materialize.min.js"></script>

</head>

<body>
  <ul id="profilemenu" class="dropdown-content">
    <li><a href="editprofile.php">Edit Profile</a></li>
    <li><a href="/<?php echo $user['username']; ?>"><?php echo $user['username']; ?></a></li>
    <li class="divider"></li>
    <li><a href="messages.php">Messages</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
  <nav>
    <div class="container">
      <div class="nav-wrapper blue">
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <a class="brand-logo center" href="home.php">Wispr <em>Beta</em></a>
        <ul class="right">
          <li><a href="index.php"> Home</a></li>
          <li><a class="dropdown-trigger" href="#!" data-target="profilemenu"><?php echo $user['username']; ?><i
                class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </div>
    </div>
  </nav>
  <div class="container">
    <form action="search.php" method="post">
      <div class="input-field">
        <input id="search" type="search" name="q" required>
        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
        <i class="material-icons">close</i>
      </div>
    </form>
  </div>

  <main>
    <div class="row">
      <div class="col m3">
        <ul id="slide-out" class="sidenav sidenav-fixed">
          <li>
            <div class="user-view">
              <div class="background blue">

              </div>
              <a href="#user"><img class="circle" src="<?php echo $propic; ?>"></a>
              <a href="#name"><span class="white-text name"><?php echo $dispname;?></span></a>
              <a href="#email"><span class="white-text truncate"><?php echo $viewprofile['title']; ?></span></a>
            </div>
          </li>
          <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
          <li><a href="#!">Second Link</a></li>
          <li>
            <div class="divider"></div>
          </li>
          <li><a class="subheader">Subheader</a></li>
          <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
        </ul>
      </div>
      <div class="col m9">
        <div class="container">
          <!--Row 1-->
          <div class="row">
            <!--[ COL1 ]-->
            <div class="col s12 m4">
              <div class="card">
                <div class="card-image">
                  <a href="pictures.php?id=<?php echo $getid?>">
                    <img src="<?php echo $propic;?>"
                      alt="Display Picture of <?php echo htmlspecialchars($dispname,ENT_QUOTES);?>">
                  </a>
                  <span class="card-title"><?php echo $dispname;?></span>
                  <a class="btn-floating halfway-fab waves-effect waves-light blue modal-trigger tooltipped"
                    data-position="left" data-tooltip="Change proile picture" href="#chg-prof-pic"><i
                      class="material-icons">edit</i></a>
                </div>
                <div class="card-content">
                  <ul id="usernav" class="">
                    <li><a href="pictures.php?id=<?php echo $viewprofile['username']?>"><span
                          class="glyphicon glyphicon-picture"></span> Pictures</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <!--[ COL2 ]-->
            <div class="col s12 m8">
              <div class="card">
                <div class="card-content">
                  <span class="card-title"><?php echo $viewprofile['title']; ?></span>
                  <?php echo $iabout; ?>
                </div>
              </div>
            </div>
          </div>
          <!-- end row 1-->
        </div>
        <!-- Upload pictures Modal  -->
        <div id="chg-prof-pic" class="modal">
          <div class="row modal-content">
            <h4>Change Your Profile Picture</h4>
            <div class="col s12 m4" title="current display picture">
              <img class="responsive-img" alt="Current Display Picture" src="<?php echo $profile['profilepic'];?>">
            </div>
            <div class="col s12 m8">
              <form action="uploading.php?rdr=home" method="post" enctype="multipart/form-data" class="col s12">
                <div class="row">
                  <label>Upload Picture</label>
                  <div class="file-field input-field">
                    <div class="btn blue">
                      <span>Browse</span>
                      <input name="chg-propic" type="file" accept="img/*">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text">
                    </div>
                  </div>
                  <div class="row">
                    <label for="caption">Caption</label><br>
                    <input placeholder="Type a Caption for the image here..." name="caption"><br>
                    <label for="chg-dp">
                      <input type="checkbox" value="1" id="chg-dp" name="chg-dp">
                      <span>Make my display picture</span>
                    </label><br>
                    <button class="btn blue left" type="submit">Upload</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!--End modal-->
      </div>
    </div>
    </div>
  </main>
  <footer class="blue page-footer">
    <div class="container">
      <div class="row">
        <div class="col m12">
          <h5 class="white-text">Wispr<em>Beta</em></h5>
          <p class="grey-text text-lighten-4">Host your own wispr and contribute on <a class="grey-text text-lighten-3"
              href="https://github.com/<?php echo $user['username']; ?>/wispr">Github</a></p>
        </div>
        <div class="col m4">
          <h5 class="white-text">Links</h5>
          <ul>
            <li><a class="grey-text text-lighten-3"
                href="https://github.com/<?php echo $user['username']; ?>/wispr"><svg xmlns="http://www.w3.org/2000/svg"
                  width="16" height="16" viewBox="0 0 16 16">
                  <path fill="white" fill-rule="evenodd"
                    d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                </svg> GitHub</a></li>
            <li><a class="grey-text text-lighten-3" href="#">Privacy</a></li>
            <li><a class="grey-text text-lighten-3" href="#">T&amp;C</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        &copy; 2012-2019 Wispr
      </div>
    </div>
  </footer>

  <script src="js/activator.js"></script>
</body>

</html>