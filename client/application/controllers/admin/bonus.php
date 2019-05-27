<?php
class bonus extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('siteconfig');
		$this->load->model('user_model');
    }
	public function index()
	{
		$rules = $this->siteconfig->rules;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE) {
			$this->load->library('encrypt');
			$query = $this->db->query("SELECT * FROM `config_data` WHERE `key` LIKE 'qiwi_%'");
			if($query->num_rows() != 2)
			{
				
				
			}
			$data = $this->siteconfig->array_from_post(array('c_discount_ot','c_discount','c_discount_sum','referal_procent'));
			$this->siteconfig->update_config($data);
			if (!empty($_FILES['userfile']['name'])) {

				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload())
				{
					$error = $this->upload->display_errors();
					$this->data['error'] = $error;
				}
				else
				{
					$filename = $this->upload->data();
					$chg_date = date('d-m-Y H:i');
				}
			}
			$this->data['ok'] = TRUE;
			$this->data['subview'] = 'admin/bonus';
			$this->load->view('admin/layout_main',$this->data);
		}
		else 
		{
		$this->data['subview'] = 'admin/bonus';
		$this->load->view('admin/layout_main',$this->data);
		}
	}
		
	}              
	
?>