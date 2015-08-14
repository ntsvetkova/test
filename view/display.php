<?php

require_once '../controllers/Request.php';
$req = new Request();
$req->buildRequest("flickr.photos.getRecent","per_page",3);

/**
 * @param PhotoCollection $photos
 */
function display(PhotoCollection $photos) {

    include_once '../templates/header.html';
//    var_dump($photos);
    foreach($photos->items as $photo) {
//        var_dump($photo);
        $tpl = file_get_contents('../templates/photo.html');
        $tpl = str_replace('{SRCLARGE}', $photo->getSrcLarge(), $tpl);
        $tpl = str_replace('{SRCTHUMBNAIL}', $photo->getSrcThumbnail(), $tpl);
        $tpl = str_replace('{TITLE}', $photo->getTitle(), $tpl);
        $tpl = str_replace('{OWNER}', urlencode($photo->getOwner()), $tpl);
        $tpl = str_replace('{ID}', urlencode($photo->getId()), $tpl);
        echo $tpl;
    }
    include_once '../templates/footer.html';

}