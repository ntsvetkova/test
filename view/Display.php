<?php
namespace Test;

require_once __DIR__ . '/OpenTemplate.php';
require_once __DIR__ . '/../models/TitlesEdit.php';

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
     */
    public function display(PhotoCollection $photos) {

        foreach($photos->getItems() as $photo) {
            $tpl = OpenTemplate::getInstance();
            $patterns = array('/{{SRCLARGE}}/i', '/{{SRCTHUMBNAIL}}/i', '/{{TITLE}}/i', '/{{OWNER}}/i', '/{{ID}}/i');
            $replacements = array($photo->getSrcLarge(), $photo->getSrcThumbnail(), $photo->getTitle(), urlencode($photo->getOwner()), urlencode($photo->getId()));
            echo preg_replace($patterns, $replacements, $tpl->getTemplate());
        }
    }

    /**
     * @param TitlesEdit $arrTitles
     */
    public function displayTitlesList(TitlesEdit $arrTitles) {
        echo nl2br("Titles list: \n");
        foreach ($arrTitles->getTitles() as $value) {
            echo nl2br($value . "\n");
        }
    }

}