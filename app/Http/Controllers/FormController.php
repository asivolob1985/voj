<?php

namespace App\Http\Controllers;

use App\Mail\orders;
use App\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class FormController extends SiteController {

	public function order(Request $request)	{
		if ($request->isMethod('post')) {
			$data = $request->all();
			$order = new Order();
			$validation = $order->validate($request->all());
			if(!$validation){
				$messages = $order->errors->all();
				$errors = implode('<br/>', $messages);
				return response()->json(['errors'=> $errors]);
			}

			Mail::send(new orders($order, true));

			$success_text = __("forms.success");
			return response()->json(['success' => $success_text]);

		}

		return false;
	}
}