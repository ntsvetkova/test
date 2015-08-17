<?php
namespace Test;

/**
 * Class FlickrException
 * @package Test
 */
class FlickrException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return "Flickr API error: {$this->message}";
    }

}