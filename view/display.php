<?php

require_once '../controllers/Request.php';
$req = new Request();
$req->buildRequest("flickr.photos.getRecent","per_page",3);

/**
 * @param PhotoCollection $photos
 * @throws Exception
 */
function display(PhotoCollection $photos) {

    include_once '../templates/header.html';
//    var_dump($photos);
    $filename = '../templates/photo.html';
    if (!file_get_contents($filename)) {
        throw new Exception('!');
    }
    try {
        foreach($photos->items as $photo) {
//        var_dump($photo);
            $tpl = file_get_contents($filename);
            $patterns = array('/{{SRCLARGE}}/i', '/{{SRCTHUMBNAIL}}/i', '/{{TITLE}}/i', '/{{OWNER}}/i', '/{{ID}}/i');
            $replacements = array($photo->getSrcLarge(), $photo->getSrcThumbnail(), $photo->getTitle(), urlencode($photo->getOwner()), urlencode($photo->getId()));
            echo preg_replace($patterns, $replacements, $tpl);
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
//    foreach($photos->items as $photo) {
////        var_dump($photo);
//        $tpl = file_get_contents('../templates/photo.html');
//        $patterns = array('/{{SRCLARGE}}/i', '/{{SRCTHUMBNAIL}}/i', '/{{TITLE}}/i', '/{{OWNER}}/i', '/{{ID}}/i');
//        $replacements = array($photo->getSrcLarge(), $photo->getSrcThumbnail(), $photo->getTitle(), urlencode($photo->getOwner()), urlencode($photo->getId()));
//        echo preg_replace($patterns, $replacements, $tpl);
//    }
    include_once '../templates/footer.html';

}