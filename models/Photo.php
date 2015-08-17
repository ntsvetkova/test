<?php
namespace Test;

/**
 * Class Photo
 */
class Photo
{
    /**
     * @var string
     */
    protected $srcLarge;
    /**
     * @var string
     */
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