<?php
namespace Test;

require_once __DIR__ . '/AppException.php';
require_once __DIR__ .'/../errors.php';

/**
 * Class ErrorException
 * @package Test
 */
class TemplateLoadingException extends AppException
{
    public function __toString() {
        $errors = unserialize(ERROR_DESCRIPTION);
        return "{$errors["TEMPLATE_LOADING"]}: {$this->message}";
    }
}