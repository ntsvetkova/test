<?php

require_once '../settings.php';
require_once '../controllers/Request.php';

/**
 * Class Display
 */
class Display
{

    public function __construct() {}

    /**
     * @param PhotoCollection $photos
     * @throws Exception
     */
    public function display(PhotoCollection $photos) {

        include_once HEADER_TPL;
        $filename = CONTENTS_TPL;
        if (!file_get_contents($filename)) {
            throw new Exception('!');
        }
        try {
            foreach($photos->items as $photo) {
                $tpl = file_get_contents($filename);
                $patterns = array('/{{SRCLARGE}}/i', '/{{SRCTHUMBNAIL}}/i', '/{{TITLE}}/i', '/{{OWNER}}/i', '/{{ID}}/i');
                $replacements = array($photo->getSrcLarge(), $photo->getSrcThumbnail(), $photo->getTitle(), urlencode($photo->getOwner()), urlencode($photo->getId()));
                echo preg_replace($patterns, $replacements, $tpl);
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        include_once FOOTER_TPL;
    }

}