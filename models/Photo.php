<?php

/**
 * Class Photo
 */
class Photo
{
    protected $srcLarge;
    protected $srcThumbnail;

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

}