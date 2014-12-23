wispr
=====

open source social network for blogging and meeting friends

For first time setup, copy all files to your server via your prefered method and create the database and tables as below

Database {
-Table: friends<br>
  Columns:<br>
  friend_a varchar(45)<br> 
  friend_b varchar(45) <br>
  approved int(11) <br>
  blocked int(11)<br>
<br>
-Table: img_usr<br>
  Columns:<br>
  pic_id int(11) AI PK <br>
  username varchar(45) <br>
  imgname text <br>
  caption text<br>
  
-Table: users
  Columns:
  id int(11) AI PK 
  username varchar(255) 
  password char(64) 
  salt char(16) 
  title text 
  about longtext 
  email varchar(255) 
  profilepic text 
  disp_name text 
  opt_promode int(11)
  }
  
