<?php
namespace Test;

require_once __DIR__ . '/RequestParametersInterface.php';

/**
 * Class RequestParameters
 * @package Test
 */
class RequestParameters implements RequestParametersInterface
{

    /**
     * @var string
     */
    private $endPoint = "https://api.flickr.com/services/rest/";
    /**
     * @var string
     */
    private $apiKey = "3bd97586d21ffcffe1931f53c2883652";
    /**
     * @var string
     */
    private $format = "json";
    /**
     * @var
     */
    private static $instance;

    /**
     * Constructor
     */
    private function __construct() {}

    /**
     * @return mixed
     */
    public static function getInstance() {
        if (empty(self::$instance)) {
            $classname = __CLASS__;
            self::$instance = new $classname;
        }
        return self::$instance;
    }

    /**
     * @return string
     */
    public function getEndPoint() {
        return $this->endPoint;
    }

    /**
     * @return string
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getApiKey() {
        return $this->apiKey;
    }

}