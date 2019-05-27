<?php
class FE_Controller extends MY_Controller {
	function __Construct() {
        parent::__construct();
        ini_set("SMTP", "smtp.zzz.com.ua");
        ini_set("sendmail_from", "admin@ice-shop.su");
		$this->load->model('page_model');
		$this->load->model('categories_model');
		$this->load->model('blacklist_model');
		$ips = $this->blacklist_model->get_nested(); //Блокировка IP
		$excp_uris = array('blocked');
		if(in_array(uri_string(), $excp_uris) == FALSE) { 
			if(in_array($_SERVER["HTTP_X_REAL_IP"], $ips)) {
				redirect('blocked');
			}
		}
		$this->data['categories']=$this->categories_model->get();
		$this->data['menu'] = $this->page_model->get_nested();
    }
}
?>