<?php

require_once './controllers/Request.php';
$req = new Request();
$req->buildRequest("flickr.photos.getRecent","per_page",3);
