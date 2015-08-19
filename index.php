<?php
namespace Test;

require_once '/var/www/main/test.com/web/settings.php';
include_once HEADER_TPL;
require_once '/var/www/main/test.com/web/controllers/Request.php';
$req = new Request();
$req->buildRequest("flickr.photos.getRecent","per_page",3);
