<?php
class users extends Admin_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('users_model');
		$this->load->library('session');
        if (in_array($this->session->userdata('group'), array("2","3"))) {
            show_404(); exit;
        }
    }
    
    public function index()
    {
        $users = $this->users_model->get();
        if (!empty($users)) {
            foreach ($users as $key => $user) {
                if ($this->session->userdata('id') == $user->id) {
                    unset($users[$key]);
                }
            }
        }
        $this->data['users']   = $users;
        $this->data['subview'] = 'admin/users/index';
        $this->load->view('admin/layout_main', $this->data);
    }
    
    public function edit($id = NULL)
    {
		$user_id = $this->session->userdata('id');
		if ($id == $user_id) {
			redirect('admin/users');
			exit;
		}
        if ($id) {
            $this->data['users'] = $this->users_model->get($id);
            count($this->data['users']) || $this->data['errors'][] = 'Пользователь не найден';
        } else {
            $this->data['users'] = $this->users_model->get_new();
        }
        $rules = $this->users_model->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->users_model->array_from_post(array('email','name','password','group'));
			$this->db->where(array('email' => $data['email']));
            $this->db->from('users');
            $count = $this->db->count_all_results();
			if ($count > 0) {  redirect('admin/users'); exit ;}
            if (!in_array($data['group'], array("1", "2", "3"))) { redirect('admin/users'); }
            if (empty($data['password'])) { unset($data['password']); } else { $data['password'] = md5($data['password']); }
            $this->users_model->save($data, $id);
            redirect('admin/users');
        }
        
        $this->data['subview'] = 'admin/users/edit';
        $this->load->view('admin/layout_main', $this->data);
    }
    
    public function delete($id)
    {
        $this->users_model->delete($id);
        redirect('admin/users');
    }
}
?>