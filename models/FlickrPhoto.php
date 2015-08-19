<?php
namespace Test;

require_once __DIR__ . '/Photo.php';
require_once __DIR__ . '/Titled.php';

/**
 * Class FlickrPhoto
 * @package Test
 */
class FlickrPhoto extends Photo
{

    use Titled;

    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $owner;

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

}