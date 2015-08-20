<?php
namespace Test;

require_once __DIR__ . '/AppException.php';
require_once __DIR__ . '/../errors.php';

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
//        return parent::__toString();
//        return \Exception::__toString();
        $errors = unserialize(ERROR_DESCRIPTION);
        return "{$errors["FLICKR_API"]}: {$this->message}";
    }

}