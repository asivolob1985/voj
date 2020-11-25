<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PagesController extends SiteController{

	public function index($alias){
		$page = Page::findByAlias($alias);
		$view = $page->type;

		return view('pages.'.$view, ['page' => $page]);
	}

    public function geturl(){
        $path = \request("path");

        return redirect($path);
    }
}