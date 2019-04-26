<?php

namespace App\Helpers;

class DataService
{
    private $allCountriesUrl = 'http://services.groupkt.com/country/get/all';
    private $countryStatesUrl = 'http://services.groupkt.com/state/get/';
    private $recordsPerPage = 50;

    public function getApiData(string $url)
    {
        $jsonData = file_get_contents($url);
        return json_decode($jsonData)->RestResponse;
    }

    public function getAllCountries()
    {
        $data = $this->getApiData($this->allCountriesUrl);
        return [
            $data->messages[0],
            http_response_code(200),
            $this->paginate(
                $data->result,
                $this->recordsPerPage)
        ];
    }

    public function getCountryStates($countryCode)
    {
        $url = $this->countryStatesUrl . $countryCode . '/all';
        $data = $this->getApiData($url);
        return [
            $data->messages[0],
            http_response_code(200),
            $this->paginate(
                $data->result,
                $this->recordsPerPage)
        ];
    }

    public function paginate($data, $resultsPerPage)
    {
        $index = 1;
        $key = $index;      // keys represent page numbers
        $pages[$key] = [];
        $counter = 1;

        foreach ($data as $item) {
            if ($counter > $resultsPerPage) {
                $index++;
                $key = $index;
                $pages[$key] = [];
                $counter = 1;
            }
            array_push($pages[$key], $item);
            $counter++;
        }
        return [$pages, $index];
    }
}