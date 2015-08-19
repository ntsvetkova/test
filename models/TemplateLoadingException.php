<?php
namespace Test;
require_once 'AppException.php';

/**
 * Class ErrorException
 * @package Test
 */
class TemplateLoadingException extends AppException
{
    public function __toString() {
        return "Error loading template: {$this->message}";
    }
}