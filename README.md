wispr
=====

open source social network for blogging and meeting friends

For first time setup, copy all files to your server via your prefered method and create the database and tables as below

Database {
-Table: friends
  Columns:
  friend_a varchar(45) 
  friend_b varchar(45) 
  approved int(11) 
  blocked int(11)

-Table: img_usr
  Columns:
  pic_id int(11) AI PK 
  username varchar(45) 
  imgname text 
  caption text
  
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
  
