<h1>wispr <em>beta</em></h1>

<p>Open source social network for blogging and meeting friends using <strike>bootstrap</strike> <a href="https://materializecss.com">Materialize css</a>... for now.</p>

<p>For first time setup, copy all files to your server via your prefered method and create the database and tables as below</p>

<h2><em>ESSENTIAL</em></h2> 
<p>create a <code>.htaccess</code> file in the root of the site with the following contents:</p>
<pre>
RewriteEngine On
RewriteRule ^([a-zA-Z0-9_-]+)$ profile.php?id=$1
RewriteRule ^([a-zA-Z0-9_-]+)/$ profile.php?id=$1
RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
RewriteRule ^(.*)$ http://%1%{REQUEST_URI} [R=301,QSA,NC,L]
DirectoryIndex index.php
ErrorDocument 404 /404.php
</pre>

<ul>
<li>
<h2>Database</h2>
<ul>
<li><strong>Table</strong>: friends<br>
  <strong>Columns</strong>:<br>
  friend_a varchar(45)<br> 
  friend_b varchar(45) <br>
  approved int(11) <br>
  blocked int(11)</li>
<li><strong>Table</strong>: img_usr<br>
  <strong>Columns</strong>:<br>
  pic_id int(11) AI PK <br>
  username varchar(45) <br>
  imgname text <br>
  caption text<br>
</li>  
<li><strong>Table</strong>: users<br>
  <strong>Columns:</strong><br>
  id int(11) AI PK <br>
  username varchar(255) <br>
  password char(64)<br> 
  salt char(16) <br>
  title text <br>
  about longtext <br>
  email varchar(255) <br>
  profilepic text <br>
  disp_name text <br>
  opt_promode int(11)
  </li>
  </ul>
  }</li></ul>
