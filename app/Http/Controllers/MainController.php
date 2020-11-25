<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Page;
use App\Project;
use App\Section;
use App\Slider;

class MainController extends SiteController{

	public function index(){

		$page = Page::getMainPage();
		$banner = Banner::where('active', 1)->take(1)->get();
		$slider = Slider::ofType('on_main')->get();
		$projects = Project::ofType('main_page')->get();
		$services = Section::where('on_main', 1)->get();

		return view('main_page', compact('page', 'banner', 'slider', 'projects', 'services'));
	}
}

 
