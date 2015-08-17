<?php
namespace Test;

require_once '../settings.php';

/**
 * Class OpenTemplate
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
     * @throws Exception
     */
    private function __construct() {
        if (!file_get_contents(self::$source)) {
            throw new Exception('Error: template can not be opened');
        }
        try {
            $this->tpl = file_get_contents(self::$source);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
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