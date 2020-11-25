<?php
namespace App\Http\Controllers\Ajax;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class OrderController extends Controller{

	public function send(Request $request)	{
		if ($request->isMethod('post')) {
			$data = $request->all();
dump($data);

			$validatedData = $request->validate([
				'email' => 'required|email',
			]);

			dd($validatedData);

			if(!isset($validatedData['email'])){
				return json_encode(['res' => false, 'error' => 'Не заполнены обязательные поля']);
			}
		}
		return true;






		$title = 'Новое сообщение с сайта';
		$ar = ['service', 'budget', 'known'];
		foreach($ar as $entity){
			if($data[$entity]!=''){
				$entity_val = '';
				$datas = explode(',', $data[$entity]);
				foreach($datas as $item){
					$entity_val.= Brief::get_questions($entity, $item).'    ';
				}
				$data[$entity.'_val'] = $entity_val;
				$entity_val = '';
			}else{
				$data[$entity.'_val'] = '';
			}
		}
		$view = 'emails.brief';
		$body = view($view, ['data' => $data]);
		$to = setting('admin.post_emails');
		$res = $this->send_email($title, $body, $to, $_FILES);

		return json_encode(['res' => $res]);
	}

	private function send_email($to, $data) {
		Mail::to($to)->send($data);
	}
}