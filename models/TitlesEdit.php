<?php
namespace Test;

/**
 * Class TitlesEdit
 * @package Test
 */
class TitlesEdit
{
    /**
     * @var array
     */
    private $arrTitles = [];

    /**
     * @param PhotoCollection $arrPhotos
     */
    public function __construct(PhotoCollection $arrPhotos) {
        foreach ($arrPhotos->getItems() as $value) {
            array_push($this->arrTitles, $value->getTitle());
        }
        $date = new \DateTime();
        $writeTitles = function($oldTitle) use ($date) {
            if (empty($oldTitle)) {
                $oldTitle = "No title";
            }
            return $date->format('Y-m-d') . ': ' . $oldTitle;
        };
        $this->arrTitles = array_map($writeTitles, $this->arrTitles);
    }

    /**
     * @return array
     */
    public function getTitles() {
        return $this->arrTitles;
    }
}