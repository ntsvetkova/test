<?php

/**
 * Interface RequestInterface
 */
interface RequestInterface
{

    public function buildRequest($method, $paramName, $paramValue);
    public function sendRequest($strReq);
    public function display(FlickrPhoto $photo);

}
