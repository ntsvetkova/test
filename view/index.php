<?php

echo "<!DOCTYPE html>
      <html>
      <head>
        <meta charset='utf-8'>
        <title>Flickr Photos</title>
        <link rel='stylesheet' href='../css/main.css'>
      </head>
      <body>
    	<div class='header'>
    		<h1>flickr photos</h1>
    	</div>
		<div class='wrapper'>
			<div id='table'>";
//{{hjhjh}}

require '../controllers/Request.php';
$req = new Request();                                               // cURL request
$req->buildRequest("flickr.photos.getRecent","per_page",3);

echo "</div>
	  <div id='photo_large'></div>
    </body>
</html>";