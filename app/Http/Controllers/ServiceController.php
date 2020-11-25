<?php

namespace App\Http\Controllers;

use App\Section;
use App\SiteService;
use App\Tariff;

class ServiceController extends SiteController{

	public function create_sites(){

		$service = Section::where('alias', 'services-create')->get();
		$all_sections = Section::getAllSections();
		$services_create_sites = SiteService::active()->get();

		return view('services.create_sites', compact('service', 'all_sections', 'services_create_sites'));
	}

    public function support(){

        $service = Section::where('alias', 'support')->get();
        $all_sections = Section::getAllSections();
        $tariffs = Tariff::all();

        return view('services.support', compact('service', 'all_sections', 'tariffs'));
    }
}

 
