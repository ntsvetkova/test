<?php
namespace TestSecond;

/**
 * Class PhotoCollection
 * @package TestSecond
 */
class PhotoCollection extends \Test\PhotoCollection
{

    /**
     * @var int
     */
    private $count = 0;

    /**
     * @param FlickrPhoto $value
     */
    public function add(FlickrPhoto $value) {
        $this->items[$this->count++] = $value;
    }

}