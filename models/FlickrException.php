<?php
namespace Test;

require_once 'AppException.php';

/**
 * Class FlickrException
 * @package Test
 */
class FlickrException extends AppException
{
    /**
     * @return string
     */
    public function __toString() {
        return "Flickr API error: {$this->message}";
    }

}