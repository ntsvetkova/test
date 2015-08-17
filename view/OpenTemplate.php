<?php
namespace Test;

require_once '../settings.php';

/**
 * Class OpenTemplate
 * @package Test
 */
class OpenTemplate
{

    /**
     * @var string
     */
    private static $source = CONTENTS_TPL;
    /**
     * @var string
     */
    private $tpl;
    /**
     * @var
     */
    private static $instance;

    /**
     * @throws ErrorException
     */
    private function __construct() {
        $this->tpl = file_get_contents(self::$source);
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
     * @return string
     */
    public function getTemplate() {
        return $this->tpl;
    }

}