<?php
namespace TestSecond;

/**
 * Class PhotoCollection
 * @package TestSecond
 */
class PhotoCollection extends \Test\PhotoCollection
{
    /**
     * @var array
     */
    private $items = [];

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

    /**
     * @return array
     */
    public function getItems() {
        return $this->items;
    }

}