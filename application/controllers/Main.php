<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");  
	} 

	public function index()
	{  
		$data=array(); 
		// session_destroy();
		$data ['check_error'] = '';  
		$this->load->view ('add_product', $data);

	} 
	public function add_cart()
	{	 
		$cart=array();
		
		if(isset($_SESSION['cart'])){
			$cart=$_SESSION['cart']; 
		}

		$cart_one['name']=$_POST['name']; 
        $cart_one['qty']=$_POST['qty']; 
        $cart_one['price']=$_POST['price'];
        $cart_one['tax']=$_POST['tax']; 
        $cart_one['total']=$_POST['total']; 
        $cart[]=$cart_one;
        $_SESSION['cart']=$cart; 
        $data=array();
        foreach ($cart as $key => $value) { 
        	@$data['net_total']+=$value['price']*$value['qty'];
        	@$data['tot_tax']+=$value['tax'];
        	@$data['gross_total']+=$value['total'];
        }  
        echo json_encode($data);

	}
	public function add_cart_disc()
	{	   
		$_SESSION['discount']=$_POST['discount']; 
	}

	public function generate_invoice()
	{   
		$data['cart']=$_SESSION['cart']; 
		$data['discount']=@$_SESSION['discount']; 
		$this->load->view ('invoice', $data);

	} 
 
}
