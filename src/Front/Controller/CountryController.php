<?php

namespace App\Front\Controller;

use App\API\Entity\City;
use App\API\Repository\CityRepository;
use App\API\Repository\CountryRepository;
use App\Front\Controller\AbstractController;


class CountryController extends AbstractController
{
    private $countryRepository;
    private $cityRepository;

    public function __construct(CountryRepository $countryRepository, CityRepository $cityRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
    }

    public function index(array $uriVars = [])
	{
	    $countries = $this->countryRepository->findAll();
	    //TO FINISH
		$this->render('country/index', [
			'id' => $uriVars['id']
		]);
	}
}
