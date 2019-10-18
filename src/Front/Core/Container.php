<?php

namespace App\Front\Core;

class Container
{
    private $services = [];
	public function get(string $idService)
	{
		$this->services = [
			'controller.homepage' => function(){
				return new \App\Front\Controller\HomepageController();
			},
			'controller.countries' => function(){
				return new \App\Front\Controller\CountryController(
                    $this->services['repository.countries'](),
                    $this->services['repository.city']());
			},
			'controller.not.found' => function(){
				return new \App\Front\Controller\NotFoundController();
			},
            'core.dotenv' => function(){
                return new \App\API\Core\Dotenv();
            },
            'core.database' => function(){
                return new \App\API\Core\Database(
                    $this->services['core.dotenv']()
                );
            },
            'repository.city' => function() {
                return new \App\API\Repository\CityRepository(
                    $this->services['core.database']()
                );
            },
            'repository.countries' => function() {
                return new \App\API\Repository\CountryRepository(
                    $this->services['core.database']()
                );
            },
		];
		return $this->services[$idService]();
	}
}
