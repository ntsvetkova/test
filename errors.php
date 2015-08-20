<?php
define("ERROR_DESCRIPTION", serialize([
    "TEMPLATE_LOADING" => "Error loading template",
    "FLICKR_API" => "Flickr API error"
]));

define("ERROR_MESSAGE", serialize([
    "FILE_NOT_FOUND" => "No file",
    JSON_ERROR_DEPTH => "Max depth",
    JSON_ERROR_STATE_MISMATCH => "Error state mismatch",
    JSON_ERROR_CTRL_CHAR => "Control char error",
    JSON_ERROR_SYNTAX => "Syntax error",
    JSON_ERROR_UTF8 => "UTF8 error",
    "NO_METHOD" => "This app can not work with this API method",
]));