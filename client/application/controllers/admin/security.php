<?php
class security extends Admin_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('sitesecurity');
		$this->load->model('vk_auth');
		$this->load->model('users_model');
        if (in_array($this->session->userdata('group'), array("2","3"))) {
            show_404(); exit;
        }
    }
	public function index()
	{
		if(!empty($_GET['code'])) {
			$url = 'http://'.$_SERVER['HTTP_HOST'].'/admin/security';
			$user_id = get_vk_id($_GET['code'],$url);
			if(empty($user_id)) die(show_error('Ошибка авторизации.'));
			$user = $this->users_model->get_by(array('vk_id' => $user_id));
			$data['vk_id'] = $user_id;
			if(empty($user->id)) $this->users_model->save($data, $this->session->userdata('id'));
			redirect('/admin/security');
		}
		if ($this->input->post('submit'))
		{
                $rules = $this->sitesecurity->rules;
				$this->form_validation->set_rules($rules);

				$this->form_validation->set_rules('old_password', 'Текущий пароль', 'required|callback__check_pass');
				$this->form_validation->set_rules('password', 'Пароль', 'required|matches[password1]');
				$this->form_validation->set_rules('password1', 'Повтор пароля', 'required');
		

					if($this->form_validation->run() == TRUE)
					 {
				 	$data = $this->sitesecurity->array_from_post(array('old_password','password','password1',''));
					if ($this->user_model->save_pass($data['password'])) $this->data['ok']=TRUE;
					}
		
		}
		$this->data['subview'] = 'admin/security/index';
		$this->load->view('admin/layout_main',$this->data);
	}
    public function vk_exit()
    {
	   $data['vk_id'] = '';
	   $this->users_model->save($data,$this->session->userdata('id'));
	   redirect('/admin/security/');
    }

	function _check_pass($password)
	{
		if (!$this->user_model->get_by(array('id'=>$this->session->userdata('id'),'password'=>$this->user_model->hash($password))))
		{
			$this->form_validation->set_message('_check_pass', '<div class="alert alert-error">Ошибка ввода текущего пароля</div>');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}


		
	}              
	
?>