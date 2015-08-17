<?php
namespace Test;

/**
 * Class Titled
 */
trait Titled
{
    /**
     * @var
     */
    protected $title;

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle($title) {
        $this->title = 'Title:' . $title;
    }

}