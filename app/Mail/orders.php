<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orders extends Mailable {
    use Queueable, SerializesModels;

	/**
	 * The order instance.
	 *
	 * @var Order
	 */
	protected $order;
	protected $test;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $test = false)   {
		$this->order = $order;
		$this->test = $test;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
		$to = setting('kontakty.post_emails');
		if($this->test == true){
            $to = env('MAIL_TEST_ADDRESS');
        }
		$from = env('MAIL_USERNAME');

		return $this->to($to)->from($from)->subject($this->order->form_name)->view('emails.email')->with(['order' => $this->order]);
    }
}
