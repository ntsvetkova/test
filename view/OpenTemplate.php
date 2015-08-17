<?php
namespace Test;

require_once '../settings.php';
require_once '../models/TemplateLoadingException.php';

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
     * @throws TemplateLoadingException
     */
    private function __construct() {
        try {
            if (!file_exists(self::$source)) {
                throw new TemplateLoadingException("No file");
            }
            else {
                $this->tpl = file_get_contents(self::$source);
            }
        }
        catch (TemplateLoadingException $e) {
            echo $e;
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