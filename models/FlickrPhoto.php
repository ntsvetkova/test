<?php

/**
 * Class FlickrPhoto
 */
class FlickrPhoto
{

    protected $id;
    protected $owner;
    protected $title;
    protected $srcThumbnail;
    protected $srcLarge;

    /**
     * @param $id
     * @param $owner
     * @param $title
     */
    public function __construct($id, $owner, $title) {
        $this->id = $id;
        $this->owner = $owner;
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSrcLarge()
    {
        return $this->srcLarge;
    }

    /**
     * @param mixed $srcLarge
     */
    public function setSrcLarge($srcLarge)
    {
        $this->srcLarge = $srcLarge;
    }

    /**
     * @return mixed
     */
    public function getSrcThumbnail()
    {
        return $this->srcThumbnail;
    }

    /**
     * @param mixed $srcThumbnail
     */
    public function setSrcThumbnail($srcThumbnail)
    {
        $this->srcThumbnail = $srcThumbnail;
    }

    /**
     * @param $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param $owner
     */
    public function setOwner($owner) {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * @param $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

}