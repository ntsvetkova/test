<?php
namespace Test;
use TestSecond\FlickrPhoto as Photo;
use TestSecond\PhotoCollection as Collection;
use TestSecond\Display as Disp;

require_once __DIR__ . '/../errors.php';
require_once __DIR__ . '/RequestInterface.php';
require_once __DIR__ . '/CurlInit.php';
require_once __DIR__ . '/../models/RequestParameters.php';
require_once __DIR__ . '/../models/FlickrPhoto.php';
require_once __DIR__ . '/../models/PhotoCollection.php';
require_once __DIR__ . '/../models/FlickrPhotoSecond.php';
require_once __DIR__ . '/../models/PhotoCollectionSecond.php';
require_once __DIR__ . '/../models/FlickrException.php';
require_once __DIR__ . '/../models/TitlesEdit.php';
require_once __DIR__ . '/../view/Display.php';
require_once __DIR__ . '/../view/DisplaySecond.php';


/**
 * Constants for json_last_error()
 */
//define("ERROR_DEPTH", "Max depth");
//define("ERROR__STATE_MISMATCH", "Error state mismatch");
//define("ERROR_CTRL_CHAR", "Control char error");
//define("ERROR_SYNTAX", "Syntax error");
//define("ERROR_UTF8", "UTF8 error");

/**
 * Class Request
 * @package Test
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
     * @var Photo
     */
    public $photoSecond;
    /**
     * @var Photo
     */
    public $arrPhotosSecond;

    /**
     * @param $method
     * @param $paramName
     * @param $paramValue
     * @return mixed
     */
    public function buildRequest($method, $paramName, $paramValue) {
        $request = RequestParameters::getInstance();
        $strReq = $request->getEndPoint() . "?method=" . urlencode($method) . "&format=" . $request->getFormat() . "&api_key=" . $request->getApiKey() . "&" . urlencode($paramName) . "=" . urlencode($paramValue);
        $this->sendRequest($strReq);
    }

    /**
     * @param $strReq
     * @return mixed
     */
    public function sendRequest($strReq) {
        $errors = unserialize(ERROR_MESSAGE);

        $req = CurlInit::getInstance();
        $handle = $req->getHandle();
        $options = [
            CURLOPT_URL => $strReq,
            CURLOPT_RETURNTRANSFER => 1
        ];
        curl_setopt_array($handle, $options);

        try {
            $data = substr(curl_exec($handle), 14, -1);

            if (curl_exec($handle) === false) {
                throw new AppException(curl_error($handle));
            }

            $obj = json_decode($data);

            switch (json_last_error()) {
                case JSON_ERROR_DEPTH:
                    echo $errors[JSON_ERROR_DEPTH];
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    echo $errors[JSON_ERROR_STATE_MISMATCH];
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    echo $errors[JSON_ERROR_CTRL_CHAR];
                    break;
                case JSON_ERROR_SYNTAX:
                    echo $errors[JSON_ERROR_SYNTAX];
                    break;
                case JSON_ERROR_UTF8:
                    echo $errors[JSON_ERROR_UTF8];
                    break;
                default:
                    break;
            }

            try {
                if (property_exists($obj, "photos")) {
                    $this->arrPhotos = new PhotoCollection();
                    for ($i = 0; $i < count($obj->photos->photo); $i++) {
                        $this->photo = new FlickrPhoto($obj->photos->photo[$i]->id, $obj->photos->photo[$i]->owner, $obj->photos->photo[$i]->title);
                        $this->buildRequest("flickr.photos.getSizes", "photo_id", $this->photo->getId());
                    }
                    $display = new Display();
                    $display->display($this->arrPhotos);

                    /**
                     * @todo Closure
                     */
                    $arrTitles = new TitlesEdit($this->arrPhotos);
                    $display->displayTitlesList($arrTitles);

                    /**
                     * @todo Reflection: access protected property
                     */
//                    $reflectionClass = new \ReflectionClass($this->photo);
//                    $id = $reflectionClass->getProperty('id');
//                    if ($id->isProtected() || $id->isPrivate()) {
//                        $id->setAccessible(true);
//                    }
//                    var_dump($id->getValue($this->photo));

                    /**
                     * @todo Closure: access protected property
                     */
//                    $id = function(FlickrPhoto $photo) {
//                        return $photo->id;
//                    };
//                    $id = \Closure::bind($id, null, $this->photo);
//                    $id = $id->bind($id, null, $this->photo);
//                    $id = $id->bindTo(null, $this->photo);
//                    var_dump($id($this->photo));

                    /**
                     * @todo Example of namespaces conflict
                     */
                    $this->photoSecond = new Photo();
                    $this->photoSecond->setTitle('Second Photo');
                    $this->photoSecond->setSrcLarge('https://farm1.staticflickr.com/744/20679448445_71662dc34b_o.jpg');
                    $this->photoSecond->setSrcThumbnail('https://farm1.staticflickr.com/744/20679448445_5c59945ece_t.jpg');
                    $this->arrPhotosSecond = new Collection();
                    $this->arrPhotosSecond->add($this->photoSecond);
                    $displaySecond = new Disp();
                    $displaySecond->display($this->arrPhotosSecond);

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
                else if ($obj->stat == "fail") {
                    throw new FlickrException($obj->message);
                }
                else {
                    throw new AppException($errors["NO_METHOD"]);
                }
            }
            catch (FlickrException $e) {
                echo $e;
            }
            catch (\Exception $e) {
                echo $e;
            }
        }
        catch (AppException $e) {
             echo $e;
        }

    }

}