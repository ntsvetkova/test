<?php
namespace Test;

require_once '../settings.php';
require_once '../controllers/Request.php';
require_once 'OpenTemplate.php';

/**
 * Class Display
 * @package Test
 */
class Display
{

    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * @param PhotoCollection $photos
     * @throws Exception
     */
    public function display(PhotoCollection $photos) {

        include_once HEADER_TPL;
        foreach($photos->items as $photo) {
            $tpl = OpenTemplate::getInstance();
            $patterns = array('/{{SRCLARGE}}/i', '/{{SRCTHUMBNAIL}}/i', '/{{TITLE}}/i', '/{{OWNER}}/i', '/{{ID}}/i');
            $replacements = array($photo->getSrcLarge(), $photo->getSrcThumbnail(), $photo->getTitle(), urlencode($photo->getOwner()), urlencode($photo->getId()));
            echo preg_replace($patterns, $replacements, $tpl->getTemplate());
        }
        include_once FOOTER_TPL;
    }

}