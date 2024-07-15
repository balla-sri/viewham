<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller{
	
	 function  __construct(){
		parent::__construct();
		
		// Load paypal library & product model
		$this->load->library('paypal_lib');
		$this->load->library('session');
		$this->load->model('Users');
		$this->load->model('Coins_model');
		$this->load->model('Notification_model');
	}
	function Pay(){
		// Set variables for paypal form
		$returnURL = base_url().'payment/success'; //payment success url
		$cancelURL = base_url().'payment/cancel'; //payment cancel url
		$notifyURL = base_url().'payment/ipn'; //ipn url
		
		// Get product data from the database
		$product = $this->input->post();
		$userID = $this->session->userdata('user'); 
		
		// Add fields to paypal form
		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('item_name', 'CoinsAdd');
		$this->paypal_lib->add_field('custom', $userID);
		$this->paypal_lib->add_field('item_number',  $product['tid']);
		$this->paypal_lib->add_field('amount',  $product['amount']);
		
		// Render paypal form
		$this->paypal_lib->paypal_auto_form();
	} 
	 
	public function ipn(){
		$paypalInfo = $this->input->post();
		
		if(!empty($paypalInfo)){
			$ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);
			if($ipnCheck){
				$data['user_id']	= $paypalInfo["custom"];
				$data['product_id']	= $paypalInfo["item_number"];
				$data['txn_id']	= $paypalInfo["txn_id"];
				$data['payment_gross']	= $paypalInfo["mc_gross"];
				$data['currency_code']	= $paypalInfo["mc_currency"];
				$data['payer_email']	= $paypalInfo["payer_email"];
				$data['payment_status'] = $paypalInfo["payment_status"];
				$inseert = $this->Coins_model->insertTransaction($data);
				if($inseert){
					$data['amount'] = $data['payment_gross'];
					$data['tracking_id'] = $data['txn_id'];
					$data['payment_mode'] = 'Paypal';
					$data['card_name'] = 'Test';
					$coins_insert = $this->saveCoins($data);
						if($coins_insert){
							$notification_insert = $this->saveNotification($coins_insert);
						}
				}
			}
		}
    }
	public function success(){
		// Get the transaction data
		$this->ipn();
		$msg = "Successfully added Coins";
		$this->session->set_flashdata('transaction_msg', $msg);
		redirect("Coins/add");

	}
	 
	public function cancel(){
		$msg = "Canceled payment";
		$this->session->set_flashdata('transaction_msg', $msg);
		redirect("Coins/add");
	 }

	private function saveCoins($data){
		$session_user = $this->session->userdata('user');

		$coins['credit'] = $data['amount'];
		$coins['userid'] = $session_user;
		$coins['source'] = 'Paypal';
		$coins['txn_id'] = $data['tracking_id'];
		$coins['create_date'] = date("Y-m-d H:i:s");
		return $this->Coins_model->insertCoins($coins);
	}
	private function saveNotification($coins_insert){
		$session_user = $this->session->userdata('user');
		$notification['notification_type'] = 2;
		$notification['to_id'] = $session_user;
		$notification['from_id'] = $session_user;
		$notification['text'] = 'credit';
		$notification['post_id'] = $coins_insert;
		$notification['created_on'] = date("Y-m-d H:i:s");
		$this->Notification_model->insertNotification($notification);
	}
}