<?php

/**
 * Class flickrPhoto
 */
class flickrPhoto {

    protected $id;
    protected $owner;
    protected $title;

    /**
     * @param $id
     * @param $owner
     * @param $title
     */
    public function __construct($id, $owner, $title) {
        $this->id = $id;
        $this->owner = $owner;
        $this->title = $title;
    }

    /**
     * @param $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param $owner
     */
    public function setOwner($owner) {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * @param $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

}

/**
 * Class request
 */
class request {

    private $endPoint = "https://api.flickr.com/services/rest/";
    private $apiKey = "3bd97586d21ffcffe1931f53c2883652";
    private $format = "json";
    public $strReq = "";

    /**
     * @return string
     */
    public function getEndPoint() {
        return $this->endPoint;
    }

    /**
     * @return string
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * @param $method
     * @param $paramName
     * @param $paramValue
     */
    public function sendRequest($method, $paramName, $paramValue) {
        $strReq = $this->getEndPoint() . "?method=" . $method . "&format=" . $this->getFormat() . "&api_key=" . $this->getApiKey() . "&" . $paramName . "=" . $paramValue;
        $req = curl_init($strReq);
        curl_setopt($req, CURLOPT_RETURNTRANSFER, 1);   // CURLOPT_RETURNTRANSFER - returns a string instead of direct output
        $data = substr(curl_exec($req), 14, -1);    // cutting jsonFlickrApi()
        $obj = json_decode($data);  //converts a JSON encoded string into a PHP variable
        var_dump($obj);     // NOT NECESSARY
        curl_close($req);   // close a cURL session
        $arr = array();
        for ($i = 0; $i < count($obj->photos->photo); $i++) {
            $arr[$i] = new flickrPhoto($obj->photos->photo[$i]->id, $obj->photos->photo[$i]->owner, $obj->photos->photo[$i]->title);
        }
        foreach ($arr as $value) {
            echo $value->getId() . "\n";
        }
     //   print_r($arr);
        return;
    }

}

$req = new request();
$req->sendRequest("flickr.photos.getRecent","per_page",3);