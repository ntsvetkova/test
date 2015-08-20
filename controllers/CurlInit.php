<?php
namespace Test;

/**
 * Class CurlInit
 * @package Test
 */
class CurlInit
{
     /**
     * @var
     */
    private static $instance;
    /**
     * @var resource
     */
    private $handle;

    /**
     *
     */
    private function __construct() {
        $this->handle = curl_init();
    }

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
     * @return resource
     */
    public function getHandle() {
        return $this->handle;
    }

    /**
     * Restricted to clone
     */
    private function __clone() {}

    /**
     * Destructor
     */
    public function __destructor() {
        curl_close($this->handle);
    }

}