<?php

/**
 * Interface cRequest
 */
interface cRequest {

    public function getEndPoint();
    public function getFormat();
    public function getApiKey();
    public function buildRequest($method, $paramName, $paramValue);
    public function sendRequest($strReq);
    public function display(flickrPhoto $photo);

}

/**
 * Class flickrPhoto
 */
class flickrPhoto {

    protected $id;
    protected $owner;
    protected $title;
    protected $srcT;
    protected $srcL;

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
     * @return mixed
     */
    public function getSrcL()
    {
        return $this->srcL;
    }

    /**
     * @param mixed $srcL
     */
    public function setSrcL($srcL)
    {
        $this->srcL = $srcL;
    }

    /**
     * @return mixed
     */
    public function getSrcT()
    {
        return $this->srcT;
    }

    /**
     * @param mixed $srcT
     */
    public function setSrcT($srcT)
    {
        $this->srcT = $srcT;
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
class request implements cRequest {

    private $endPoint = "https://api.flickr.com/services/rest/";
    private $apiKey = "3bd97586d21ffcffe1931f53c2883652";
    private $format = "json";
    public $strReq = "";
    public $photo;

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
    public function buildRequest($method, $paramName, $paramValue) {
        $strReq = $this->getEndPoint() . "?method=" . $method . "&format=" . $this->getFormat() . "&api_key=" . $this->getApiKey() . "&" . $paramName . "=" . $paramValue;
        $this->sendRequest($strReq);
    }

    /**
     * @param $strReq
     */
    public function sendRequest($strReq) {
        $req = curl_init($strReq);
        curl_setopt($req, CURLOPT_RETURNTRANSFER, 1);   // CURLOPT_RETURNTRANSFER - returns a string instead of direct output
        $data = substr(curl_exec($req), 14, -1);    // cutting jsonFlickrApi()
        $obj = json_decode($data)  //converts a JSON encoded string into a PHP variable
            or die("Unable to decode data");

        switch (json_last_error()) {
           case JSON_ERROR_DEPTH:
                echo ' - Max depth';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                echo ' - Error state mismatch';
                break;
            case JSON_ERROR_CTRL_CHAR:
                echo ' - Control char error';
                break;
            case JSON_ERROR_SYNTAX:
                echo ' - Syntax error';
                break;
            case JSON_ERROR_UTF8:
                echo ' - UTF8 error';
                break;
            default:
               break;
        }

    //    var_dump($obj);     // NOT NECESSARY
        curl_close($req);   // close a cURL session

        if (property_exists($obj, "photos"))
            for ($i = 0; $i < count($obj->photos->photo); $i++) {
                $this->photo = new flickrPhoto($obj->photos->photo[$i]->id, $obj->photos->photo[$i]->owner, $obj->photos->photo[$i]->title);
                $this->buildRequest("flickr.photos.getSizes", "photo_id", $this->photo->getId());
            }
        else
            if (property_exists($obj, "sizes")) {
                $this->photo->setSrcL($obj->sizes->size[count($obj->sizes->size) - 1]->source);
                for ($i = 0; $i < count($obj->sizes->size); $i++)
                    if ($obj->sizes->size[$i]->label == "Thumbnail")
                        $this->photo->setSrcT($obj->sizes->size[$i]->source);
                $this->display($this->photo);
            //    var_dump($this->photo);

            }
            else
                echo "Unknown API method";
    }

    /**
     * @param flickrPhoto $photo
     */
    public function display(flickrPhoto $photo) {
        echo "<div class='cell'>
                <a class='large' href='" . $photo->getSrcL() . "'>
                    <div class='img' style='background-image:url(" . $photo->getSrcT() . ");'></div>
                    <div class='title'>" . $photo->getTitle() . "</div>
                </a>
                <a id='arrow' target='_blank' href='http://www.flickr.com/photos/" . $photo->getOwner() . "/" . $photo->getId() . "'> » </a>
                <div class='clearfix'></div>
              </div>";
    //    var_dump($photo);
    }

}

echo "<!DOCTYPE html>
      <html>
      <head>
        <meta charset='utf-8'>
        <title>Flickr Photos</title>
        <link rel='stylesheet' href='css/main.css'>
      </head>
      <body>
    	<div class='header'>
    		<h1>flickr photos</h1>
    	</div>
		<div class='wrapper'>
			<div id='table'>";

$req = new request();                                               // cURL request
$req->buildRequest("flickr.photos.getRecent","per_page",3);

echo "</div>
	  <div id='photo_large'></div>
    </body>
</html>";