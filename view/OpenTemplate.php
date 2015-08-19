<?php
namespace Test;

require_once __DIR__ . '/../settings.php';
require_once __DIR__ . '/../errors.php';
require_once __DIR__ . '/../models/TemplateLoadingException.php';

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
                $errors = unserialize(ERROR_MESSAGE);
                throw new TemplateLoadingException($errors["FILE_NOT_FOUND"]);
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