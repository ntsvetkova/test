<?php
namespace Test;

/**
 * Class PhotoFactory
 * @package Test
 */
class PhotoFactory
{

    public static function create($type) {
        try {
            $obj = ucwords($type) . "Photo";
            if (class_exists($obj)) {
                return new $obj();
            } else {
                throw new AppException("Invalid type");
            }
        }
        catch (AppException $e) {
            echo $e;
        }
    }

}