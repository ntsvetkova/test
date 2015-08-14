<?php

require_once '../controllers/Request.php';
$req = new Request();
$req->buildRequest("flickr.photos.getRecent","per_page",3);

/**
 * @param FlickrPhoto $photo
 */
function display($photos) {
    include_once '../templates/photo.html';
    var_dump($photos);
//    echo "<div class='cell'>
//                <a class='large' href='" . $photo->getSrcLarge() . "'>
//                    <div class='img' style='background-image:url(" . $photo->getSrcThumbnail() . ");'></div>
//                    <div class='title'>" .  $photo->getTitle() . "</div>
//                </a>
//                <a id='arrow' target='_blank' href='http://www.flickr.com/photos/" . urlencode($photo->getOwner()) . "/" . urlencode($photo->getId()) . "'> » </a>
//                <div class='clearfix'></div>
//              </div>";
}