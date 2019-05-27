<?php
class MY_Model extends CI_Model {

	protected $table_name = '';
	protected $primary_key = 'id';
	protected $primary_filter = 'intval';
	protected $order_by = '';
	protected $rules = array();
	protected $timestamps = FALSE;
	
	function __Construct() {
        parent::__construct();
    }
    public function get_bynum($count, $start,$where=FALSE,$single=FALSE) {
		$this->db->order_by("rank", "");
		$start = $start*$count;
      if (empty($where)) {
	    $res = $this->db->get($this->table_name,$count,$start,$single);
	  } else {
	     $res = $this->db->get_where($this->table_name, $where,$count,$start,$single);
	  }
	   return $res->result();
	}
	public function get_count($where) {
	  if (empty($where)) {return $this->db->get($this->table_name)->num_rows;} else {return $this->db->get_where($this->table_name,$where)->num_rows;}
	}	
	public function get($id = NULL, $single = FALSE,$k) {
		if (empty($k)) {} else {$billing = $this->load->database('billing', TRUE, TRUE); $this->db = $billing;}
		if($id != NULL) {
			$filter = $this->primary_filter;
			$id = $filter($id);
			$this->db->where($this->primary_key,$id);
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		if(!count($this->db->ar_orderby)) {
			$this->db->order_by($this->order_by);
		}
		return $this->db->get($this->table_name)->$method();
	}
	public function get_by($where, $single = FALSE) {
		$this->db->where($where);
		return $this->get(NULL,$single);
	}
	public function get_billing($domain) {
		$billing = $this->load->database('billing', TRUE, TRUE);
		$k = $billing->get_where('sites', array('domain' => $domain));
		return $k->result();
		
	}
	public function save($data, $id = NULL) {
		if($this->timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		
		if($id === NULL) {
			!isset($data[$this->primary_key]) || $data[$this->primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->table_name);
			$id = $this->db->insert_id();
		}
		else {
			$filter = $this->primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->primary_key,$id);
			$this->db->update($this->table_name);
		}
		return $id;
	}
	public function delete($id) {
		$filter = $this->primary_filter;
		$id = $filter($id);
		
		if(!$id) {
			return FALSE;
		}
		$this->db->where($this->primary_key,$id);
		$this->db->limit(1);
		$this->db->delete($this->table_name);
	}	
	
	public function array_from_post($fields){

    $data = array();
    foreach ($fields as $field) {
        $data[$field] = $this->input->post($field);
    }
    return $data;
}
}
?>