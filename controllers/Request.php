<?php
namespace Test;
//use Test\Photo;

require_once 'RequestInterface.php';
require_once '../models/FlickrPhoto.php';
require_once '../models/RequestParameters.php';
require_once '../models/PhotoCollection.php';
require_once '../view/Display.php';

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
class Request implements RequestInterface
{

    /**
     * @var string
     */
    public $strReq = "";
    /**
     * @var FlickrPhoto
     */
    public $photo;
    /**
     * @var PhotoCollection
     */
    public $arrPhotos;

    /**
     * @param $method
     * @param $paramName
     * @param $paramValue
     */
    public function buildRequest($method, $paramName, $paramValue) {
        $request = RequestParameters::getInstance();
        $strReq = $request->getEndPoint() . "?method=" . urlencode($method) . "&format=" . $request->getFormat() . "&api_key=" . $request->getApiKey() . "&" . urlencode($paramName) . "=" . urlencode($paramValue);
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

        curl_close($req);   // close a cURL session

        if (property_exists($obj, "photos")) {
            $this->arrPhotos = new PhotoCollection();
            for ($i = 0; $i < count($obj->photos->photo); $i++) {
                $this->photo = new FlickrPhoto($obj->photos->photo[$i]->id, $obj->photos->photo[$i]->owner, $obj->photos->photo[$i]->title);
                $this->buildRequest("flickr.photos.getSizes", "photo_id", $this->photo->getId());
            }
            $display = new Display($this->arrPhotos);
            $display->display($this->arrPhotos);
        }
        else if (property_exists($obj, "sizes")) {
            $this->photo->setSrcLarge($obj->sizes->size[count($obj->sizes->size) - 1]->source);
            for ($i = 0; $i < count($obj->sizes->size); $i++) {
                if ($obj->sizes->size[$i]->label == "Thumbnail") {
                    $this->photo->setSrcThumbnail($obj->sizes->size[$i]->source);
                }
            }
            $this->arrPhotos->add($this->photo);
        }
        else {
            echo "Unknown API method";
        }

    }

}