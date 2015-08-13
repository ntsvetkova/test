<?php

require_once '../models/FlickrPhoto.php';
require_once '../models/RequestParameters.php';

/**
 * Constants for json_last_error()
 */
define("ERROR_DEPTH", "Max depth");
define("ERROR__STATE_MISMATCH", "Error state mismatch");
define("ERROR_CTRL_CHAR", "Control char error");
define("ERROR_SYNTAX", "Syntax error");
define("ERROR_UTF8", "UTF8 error");

/**
 * Class Request
 */
class Request //implements RequestInterface
{

    public $strReq = "";
    public $photo;

//    private $endPoint = "https://api.flickr.com/services/rest/";
//    private $apiKey = "3bd97586d21ffcffe1931f53c2883652";
//    private $format = "json";
//
//    /**
//     * @return string
//     */
//    public function getEndPoint() {
//        return $this->endPoint;
//    }
//
//    /**
//     * @return string
//     */
//    public function getFormat() {
//        return $this->format;
//    }
//
//    /**
//     * @return string
//     */
//    public function getApiKey() {
//        return $this->apiKey;
//    }

    /**
     * @param $method
     * @param $paramName
     * @param $paramValue
     */
    public function buildRequest($method, $paramName, $paramValue) {
        $request = new RequestParameters();
        var_dump($request);
        $strReq = $request->getEndPoint() . "?method=" . urlencode($method) . "&format=" . $request->getFormat() . "&api_key=" . $request->getApiKey() . "&" . urlencode($paramName) . "=" . urlencode($paramValue);
      //  $strReq = $this->getEndPoint() . "?method=" . urlencode($method) . "&format=" . $this->getFormat() . "&api_key=" . $this->getApiKey() . "&" . urlencode($paramName) . "=" . urlencode($paramValue);
    //    var_dump($strReq);
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
                echo ERROR_DEPTH;
                break;
            case JSON_ERROR_STATE_MISMATCH:
                echo ERROR__STATE_MISMATCH;
                break;
            case JSON_ERROR_CTRL_CHAR:
                echo ERROR_CTRL_CHAR;
                break;
            case JSON_ERROR_SYNTAX:
                echo ERROR_SYNTAX;
                break;
            case JSON_ERROR_UTF8:
                echo ERROR_UTF8;
                break;
            default:
                break;
        }

        //    var_dump($obj);     // NOT NECESSARY
        curl_close($req);   // close a cURL session

        if (property_exists($obj, "photos")) {
            for ($i = 0; $i < count($obj->photos->photo); $i++) {
                $this->photo = new FlickrPhoto($obj->photos->photo[$i]->id, $obj->photos->photo[$i]->owner, $obj->photos->photo[$i]->title);
                $this->buildRequest("flickr.photos.getSizes", "photo_id", $this->photo->getId());
            }
        }
        else if (property_exists($obj, "sizes")) {
//            $source = new PhotoSource();
//            $source->setSrcLarge($obj->sizes->size[count($obj->sizes->size) - 1]);
//            for ($i = 0; $i < count($obj->sizes->size); $i++) {
//                if ($obj->sizes->size[$i]->label == "Thumbnail") {
//                    $source->setSrcThumbnail($obj->sizes->size[$i]->source);
//                }
//            }
            $this->photo->setSrcLarge($obj->sizes->size[count($obj->sizes->size) - 1]->source);
            for ($i = 0; $i < count($obj->sizes->size); $i++) {
                if ($obj->sizes->size[$i]->label == "Thumbnail") {
                    $this->photo->setSrcThumbnail($obj->sizes->size[$i]->source);
                }
            }
            $this->display($this->photo);
            //    var_dump($this->photo);
        }
        else {
            echo "Unknown API method";
        }
    }

    /**
     * @param FlickrPhoto $photo
     * @throws Exception
     */
    public function display(FlickrPhoto $photo) {
        echo "<div class='cell'>
                <a class='large' href='" . $photo->getSrcLarge() . "'>
                    <div class='img' style='background-image:url(" . $photo->getSrcThumbnail() . ");'></div>
                    <div class='title'>" .  $photo->getTitle() . "</div>
                </a>
                <a id='arrow' target='_blank' href='http://www.flickr.com/photos/" . urlencode($photo->getOwner()) . "/" . urlencode($photo->getId()) . "'> » </a>
                <div class='clearfix'></div>
              </div>";
        /*   throw new Exception('!');
           try {

           }
           catch (Exception $e) {
               echo $e->getMessage();
           } */
        //    var_dump($photo);
    }

}