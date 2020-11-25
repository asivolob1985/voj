<?php

namespace App\Http\Controllers\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Page;
class PagesController extends VoyagerBaseController
{
	public function geturl(){
		$path = \request("path");

		return redirect($path);
	}
}
