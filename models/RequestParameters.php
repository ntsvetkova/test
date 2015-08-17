<?php
require_once 'RequestParametersInterface.php';

/**
 * Class RequestParameters
 */
class RequestParameters implements RequestParametersInterface
{

    private $endPoint = "https://api.flickr.com/services/rest/";
    private $apiKey = "3bd97586d21ffcffe1931f53c2883652";
    private $format = "json";
    private static $instance;

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