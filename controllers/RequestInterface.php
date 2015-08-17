<?php

/**
 * Interface RequestInterface
 */
interface RequestInterface
{
    /**
     * @param $method
     * @param $paramName
     * @param $paramValue
     * @return mixed
     */
    public function buildRequest($method, $paramName, $paramValue);

    /**
     * @param $strReq
     * @return mixed
     */
    public function sendRequest($strReq);

}
