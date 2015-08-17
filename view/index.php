<?php
namespace Test;

require_once '../settings.php';
include_once HEADER_TPL;
require_once '../controllers/Request.php';
$req = new Request();
$req->buildRequest("flickr.photos.geRecent","per_page",3);
