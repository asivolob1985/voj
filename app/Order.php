<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Order extends Model {

	public $errors;

	protected $rules = [
		'name'  => 'required',
        'tel'   => 'required|numeric',
	];

	public function validate($inputs) {
		$v = Validator::make($inputs, $this->rules);
		if ($v->passes()) {
			return true;
		}
		$this->errors = $v->messages();

		return false;
	}
}
