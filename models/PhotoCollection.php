<?php

/**
 * Class PhotoCollection
 */
class PhotoCollection
{

    public $items = array();
    private $count = 0;

    public function add(FlickrPhoto $value) {
        $this->items[$this->count++] = $value;
    }

}