<?php

/**
 * Class PhotoCollection
 */
class PhotoCollection
{
    /**
     * @var array
     */
    public $items = [];
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