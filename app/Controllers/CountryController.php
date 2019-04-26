<?php

namespace App\Controllers;

use App\core\BaseController;
use \App\Helpers\DataService;

require '../app/Helpers/DataService.php';

class CountryController extends BaseController
{
    public function __construct()
    {
        $this->dataService = new DataService();
    }

    public function getCountries()
    {
        $response = $this->dataService->getAllCountries();
        return $this->prepareResponse(
            $response[0],
            $response[1],
            $response[2]
        );
    }

    public function getStates($country)
    {
        $response = $this->dataService->getCountryStates($country);
        return $this->prepareResponse(
            $response[0],
            $response[1],
            $response[2]
        );
    }
}