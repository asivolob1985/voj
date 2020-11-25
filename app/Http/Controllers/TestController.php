<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller {

	public function __invoke(Request $request){
        $action = $request->action;
		return $this->$action();
	}

	public function test(){
		return view('test');
	}

	public function sendform(){
	    $name = 'andrey';
	    $tel = '89652707522';
	    $data = compact('name', 'tel');
        $request = Request::create(route('form.order'), 'POST', $data);
        $orc = new FormController();
        $data = $orc->order($request);


        dd($data);

    }
}