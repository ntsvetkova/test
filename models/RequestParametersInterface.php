<?php

interface RequestParametersInterface
{
    /**
     * @return mixed
     */
    public function getEndPoint();

    /**
     * @return mixed
     */
    public function getApiKey();

    /**
     * @return mixed
     */
    public function getFormat();

}