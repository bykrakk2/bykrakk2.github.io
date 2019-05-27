<?php
class page extends FE_Controller {
	function __Construct() {
        parent::__construct();
		$this->load->model('page_model');
    }
	public function index()
	{
		
		$this->data['page'] = $this->page_model->get_by(array('slug' => (string) $this->uri->segment(2)),TRUE);
		count($this->data['page']) || show_404(current_url());
		$this->data['subview'] = 'page';
		$this->data['title'] = $this->data['page']->title;
		if ($this->data['page']->loader == '1') {
		$this->load->view('payr',$this->data);
		} else {
		$this->load->view('main_layout',$this->data);
		}


	}
}
?>