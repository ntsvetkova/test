<?php
namespace Test;

require_once getcwd() . '/settings.php';
include_once HEADER_TPL;

require_once __DIR__ . '/controllers/Request.php';
$req = new Request();
$req->buildRequest("flickr.photos.getRecent","per_page",3);

include_once FOOTER_TPL;