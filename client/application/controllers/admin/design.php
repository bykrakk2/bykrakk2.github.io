<?php
class design extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('sitedesign');
        if (in_array($this->session->userdata('group'), array("2"))) {
            show_404(); exit;
        }
    }
	
	public function index()
	{
	
		if ($this->input->post('submit'))
		{

		
				$rules = $this->sitedesign->rules;
				$this->form_validation->set_rules($rules);

				if($this->form_validation->run() == TRUE)
				 {
				 	$data = $this->sitedesign->array_from_post(array('block_3','site_name','slide1','slide2','slide3','block_2','metadescr','sitendfon','site_tptovar','site_logo','site_flogo','site_kvbloga','vptsite','jobsite','vkid','skod','ssb','vkidc','templates','vk_active'));
					if (empty($data['jobsite'])) { $data['jobsite'] = 1; } else { $data['jobsite'] = 0;}
					$this->sitedesign->update_config($data);
					$this->data['ok'] = TRUE;
					redirect('admin/design');
                 }
		
		}

		$this->data['subview'] = 'admin/design';
		$this->load->view('admin/layout_main',$this->data);
	
		
	}


		
	}              
	
?>