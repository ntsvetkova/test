<?php
namespace TestSecond;
use Test\OpenTemplate;

/**
 * Class Display
 * @package TestSecond
 */
class Display extends \Test\Display
{
    /**
     * @param PhotoCollection $photos
     */
    public function display(PhotoCollection $photos) {

        foreach($photos->getItems() as $photo) {
            $tpl = OpenTemplate::getInstance();
            $patterns = array('/{{SRCLARGE}}/i', '/{{SRCTHUMBNAIL}}/i', '/{{TITLE}}/i','/{{OWNER}}/i', '/{{ID}}/i');
            $replacements = array($photo->getSrcLarge(), $photo->getSrcThumbnail(), $photo->getTitle(), "", "");
            echo preg_replace($patterns, $replacements, $tpl->getTemplate());
        }
    }

}