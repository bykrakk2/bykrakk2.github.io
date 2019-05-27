<?php
class config extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('siteconfig');
		$group = $this->session->userdata('group');
        if (in_array($this->session->userdata('group'), array("2","3"))) {
            show_404(); exit;
        }
    }
	public function index()
	{
		if ($_GET['set'] == 'pr') {
			$fp = fopen ("payeer_".config_item('pr_id').".txt", "w");  
            fwrite($fp,config_item('pr_id'));  
            fclose($fp);  
			$this->data['info'] = '<div class="alert alert-success">Файл активации успешно создан и доступе по адресу http://'.$_SERVER['SERVER_NAME'].'/payeer_'.config_item('pr_id').'.txt</div>';
		}
		$rules = $this->siteconfig->rules;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE) {
			$this->load->library('encrypt');
			$query = $this->db->query("SELECT * FROM `config_data` WHERE `key` LIKE 'qiwi_%'");
			if($query->num_rows() != 2)
			{
				$this->db->query("INSERT INTO `config_data` VALUES('qiwi_num','')");
				$this->db->query("INSERT INTO `config_data` VALUES('qiwi_pass','')");
			}
				$data = $this->siteconfig->array_from_post(array('yad_client_id','yad_token','qiwi_num','qiwi_pass','wmid','WMR','WMZ','WMU','wm_pass','site_pwebmoney','site_pqiwi','site_pyandex','site_ppkolvo','f_id','f_key_1','f_key_2','site_pkassa','block_1','ik_id','ik_key','ik_test','ik_status','pr_id','pr_status','pr_key','rk_password_1','rk_password_2','rk_login','rk_status','block_2'));
			if($data['wm_pass'] == "******")
			$data['wm_pass'] = $this->encrypt->decode($this->config->item('wm_pass'));
			$data['wm_pass'] = $this->encrypt->encode($data['wm_pass']);

			if (empty($data['site_pwebmoney'])) { $data['site_pwebmoney'] = 0; } else { $data['site_pwebmoney'] = 1;}
			if (empty($data['site_pqiwi'])) { $data['site_pqiwi'] = 0; } else { $data['site_pqiwi'] = 1;}
			if (empty($data['rk_status'])) { $data['rk_status'] = 0; } else { $data['rk_status'] = 1;}
			if (empty($data['site_pyandex'])) { $data['site_pyandex'] = 0; } else { $data['site_pyandex'] = 1;}
			if (empty($data['site_pkassa'])) { $data['site_pkassa'] = 0; } else { $data['site_pkassa'] = 1;}
			if (empty($data['ik_status'])) { $data['ik_status'] = 0; } else { $data['ik_status'] = 1;}
			if (empty($data['pr_status'])) { $data['pr_status'] = 0; } else { $data['pr_status'] = 1;}
			if($data['qiwi_pass'] == "******")
			$data['qiwi_pass'] = $this->encrypt->decode($this->config->item('qiwi_pass'));
			$data['qiwi_pass'] = $this->encrypt->encode($data['qiwi_pass']);
			$this->siteconfig->update_config($data);
			if (!empty($_FILES['userfile']['name'])) {
				$this->load->helper("file"); 
				$uppath = './assets/uploads/'.preg_replace('/[^\p{L}\p{N}\s]/u','', md5(config_item('encryption_key').site_url())).'/';
				delete_files($uppath, true);
				if(!is_dir($uppath)) {
					mkdir($uppath);
				}
				$config['upload_path'] = $uppath;
				$config['allowed_types'] = 'kwm';
				$config['max_size']	= '1';

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
					$wmk_file = array(
					'name' => $filename['client_name'],
					);
					$wmk_file = $this->encrypt->encode(serialize($wmk_file));
					$this->siteconfig->save('wmk_file',$wmk_file);
					$this->siteconfig->save('wm_key_date',$chg_date);
				}
			}
			$this->data['ok'] = TRUE;
			$this->data['subview'] = 'admin/config';
			$this->load->view('admin/layout_main',$this->data);
		}
		else 
		{
		$this->data['subview'] = 'admin/config';
		$this->load->view('admin/layout_main',$this->data);
		}
	}
		
	}              
	
?>