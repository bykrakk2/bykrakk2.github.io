<?php
class Coments_Model extends MY_Model
{
	
	protected $table_name = 'coments';
	protected $order_by = 'created desc';
	public $count;
	public $listing;
	public $perpage=10;
	
	public $rules = array(
		'body' => array(
			'field' => 'body', 
			'label' => 'body', 
			'rules' => 'trim|required'
		),
		'user_name' => array(
			'field' => 'user_name', 
			'label' => 'user_name', 
			'rules' => 'trim|required'
		)
	);
	function __construct ()
	{
		parent::__construct();
		
		if ($this->input->post('coments'))
		{

			$this->save_coment();

		}
	}
	
	public function get_new ()
	{
		$coment = new stdClass();
		$coment->title = '';
		$coment->slug = '';
		$coment->body = '';
		$coment->show = '0';
		$coment->created = date('Y-m-d');
		return $coment;
	}
		
	
	function save_coment()
	{
		
			$this->form_validation->set_rules($this->rules);
			
			// Process the form
			if ($this->form_validation->run() == TRUE) 
			{
				$data = $this->array_from_post(array( 'parent_id','user_name','body'));
				$data['type']='items';
				$data['item']=$this->uri->segment(2);
				$data['created']=date('Y-m-d H:i:s');
				
				$this->save($data);
				redirect(current_url());
			}
	}
	function get_coments($type=FALSE,$id=FALSE)
	{
		
		
		$this->uri->segment(1)=='admin' ? $segment=3 : $segment=3;
		$this->uri->segment(1)=='reviews' ? $segment=2 : $segment=3;
		//select coments
		$offset = $this->uri->segment($segment)?$this->uri->segment($segment):0;
		//select coments
		$data=array();
		$type ?  $data['type']=$type : '';
		$id ? $data['item'] = $id : '';
		
		if ($this->uri->segment(1)=='reviews') $data['item']=0;
		
		$this->db->select('SQL_CALC_FOUND_ROWS coments.id, coments.item, coments.body, coments.created, coments.user_name ',FALSE);
		$this->db->limit($this->perpage, $offset);

		$data= $this->get_by($data);

 		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$this->count = $query->row()->Count;


		 if ( $this->count > $this->perpage) {

            $this->load->library('pagination');
			$config['base_url']='';
            
            foreach( $this->uri->segments as $key => $val):
            	if ($key < $segment)  $config['base_url'] .=$val . '/';	
            endforeach;
            $config['prev_link'] = '&#9664;';
            $config['next_link'] = '&#9654;';
			$config['base_url']=site_url($config['base_url']);
           // $config['base_url'] = site_url($this->uri->segment(1) . '/' .$this->uri->segment(2). '/' .$this->uri->segment(3)  );
            $config['total_rows'] = $this->count;
            $config['per_page'] = $this->perpage;
            $config['uri_segment'] = $segment;
			$this->pagination->initialize($config);
            $this->listing = $this->pagination->create_links();
            
        	}
        else {
             $this->listing  = '';
            
        }



		return $data;
	}

	
}