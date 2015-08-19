<?php
namespace Test;

/**
 * Class PhotoCollection
 * @package Test
 */
class PhotoCollection
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

    /**
     * @param $arr array
     */
    public function addItems($arr) {
        $this->items = $arr;
    }

}