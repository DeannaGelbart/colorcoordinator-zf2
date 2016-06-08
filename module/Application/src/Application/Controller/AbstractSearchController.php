<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

abstract class AbstractSearchController extends AbstractActionController
{
    protected $utilitiesService;
    protected $tinEyeService;
    protected $tinEyeConfig;

    public function __construct($utilitiesService, $tinEyeService, $tinEyeConfig)
    {
        $this->utilitiesService = $utilitiesService;
        $this->tinEyeService = $tinEyeService;
        $this->tinEyeConfig = $tinEyeConfig;
    }

    protected function errorResponse($message)
    {
        $this->response->setStatusCode(500);
        $error = new JsonModel(array(
            'message' => $message
        ));
        return $error;
    }

    // This JSON web service performs a TinEye API search by color.
    //
    // This service takes a single GET parameter named color which is an RGB color expressed as 6 hex digits.
    //
    // Example: a GET request to "/tin-eye-search?color=836cc7" will search for color 836cc7.
    //
    // If there is an error, this service returns HTTP status code 500 and the JSON body contains
    // one field 'message' containing the error message.
    //
    // Otherwise, this service returns HTTP status code 200 and this JSON body:
    //    match_count: An integer giving the number of matching images (may be 0).
    //    matches: A list containing one entry for each matching image. Each entry has these fields:
    //      filename: the filename of the matching image.
    //      name: the display name of the matching image.
    //      score: A numerical score for how well the image matched the search color.
    public abstract function searchAction();
}