<?php

class Taxonomy_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_taxonomy($tid = FALSE)
	{
		if ($tid === FALSE)
        {
            $query = $this->db->get('taxonomy');
            return $query->result_array();
        }

        $query = $this->db->get_where('taxonomy', array('tid' => $tid));
        return $query->row_array();
	}

	private $lastQuery = '';
	
	public function getTotalRow()
	{
		$sql = explode('LIMIT', $this->lastQuery);
		$query = $this->db->query($sql[0]);
		$result = $query->result();
		return count($result);
	}

	public function get_tax()
	{
		//$gettax = $this->db->query('SELECT * FROM taxonomy');
		//return $gettax->result_array();

		$this->db->order_by('tid', 'ASC');
		$query = $this->db->get('taxonomy');
		return $query->result();
	}

	public function getTaxonomyList($limit, $start)
	{
		//$this->db->order_by('tid', 'ASC');
		$this->db->limit($limit, $start);
		$this->db->where('status', '1');
		$query = $this->db->get('taxonomy');
		$this->lastQuery = $this->db->last_query();
		return $query->result_array();
	}

	public function set_taxonomy()
	{
	    $this->load->helper('url');
		  
	    $data = array(
	        'name' => $this->input->post('name'),
	        'description' => $this->input->post('description'),
	        'status' => 1
	    );
	    return $this->db->insert('taxonomy', $data);	    
	}

	public function getTaxonomyEdit($tid)
	{
        $this->db->where('tid', $tid);
	   	$query = $this->db->get('taxonomy');
        return $query->row_array();
	}

	public function editTaxonomy($tid)
	{
		$this->load->helper('url');
		  
	    $data = array(
	        'name' => $this->input->post('name'),
	        'description' => $this->input->post('description')
	    );
	    $this->db->where('tid', $tid);
	    return $this->db->update('taxonomy', $data);	
	}

	public function getTaxonomyDelete($tid)
	{
        $this->db->where('tid', $tid);
	   	$query = $this->db->get('taxonomy');
        return $query->row_array();
	}

	public function deleteTaxonomy($tid)
	{
		$this->load->helper('url');	  
	    $data = array(
	        'status' => 0
	    );

		$this->db->where('tid', $tid);
		return $this->db->update('taxonomy', $data);
	}

}

?>