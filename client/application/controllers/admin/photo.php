<?php
class photo extends Admin_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('photo_model');
        if (in_array($this->session->userdata('group'), array("2","3"))) {
            show_404(); exit;
        }
    }
    public function index()
    {
        $this->data['subview'] = 'admin/photo';
        $this->load->view('admin/layout_main', $this->data);
        
        
    }
    
    
    
}

?>