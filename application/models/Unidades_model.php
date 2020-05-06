<?php

class Unidades_model extends CI_Model {

	public function __construct()
    {
    	$this->load->database();
    }

    public function get_units($unit_id = FALSE)
	{
		if ($unit_id === FALSE)
	    {
	        $query = $this->db->get('units');
	        return $query->result_array();
	    }

	    $query = $this->db->get_where('units', array('unit_id' => $unit_id));
	    return $query->row_array();
	}

	public function getAllUnits()
	{
		$this->db->order_by('unit_id', 'ASC');
		$query = $this->db->get('units');
		return $query->result();
	}

	private $lastQuery = '';
	
	public function getTotalRow()
	{
		$sql = explode('LIMIT', $this->lastQuery);
		$query = $this->db->query($sql[0]);
		$result = $query->result();
		return count($result);
	}

	public function getUnitsList($limit, $start)
	{
		//$this->db->order_by('tid', 'ASC');
		$this->db->limit($limit, $start);
		$this->db->where('status', '1');
		$query = $this->db->get('units');
		$this->lastQuery = $this->db->last_query();
		return $query->result_array();
	}


	public function set_units()
	{
	    $this->load->helper('url');
		  
	    $data = array(
	        'name' => $this->input->post('name'),
		        'status' => 1
	    );

	    return $this->db->insert('units', $data);
		    
	}

	public function getUnitEdit($unit_id)
	{
        $this->db->where('unit_id', $unit_id);
	   	$query = $this->db->get('units');
        return $query->row_array();
	}

	public function editUnit($unit_id)
	{
		$this->load->helper('url');
		  
	    $data = array(
	        'name' => $this->input->post('name')
	    );
	    $this->db->where('unit_id', $unit_id);
	    return $this->db->update('units', $data);	
	}

	public function getUnitDelete($unit_id)
	{
        $this->db->where('unit_id', $unit_id);
	   	$query = $this->db->get('units');
        return $query->row_array();
	}

	public function deleteUnit($unit_id)
	{
		$this->load->helper('url');	  
	    $data = array(
	        'status' => 0
	    );
		$this->db->where('unit_id', $unit_id);
	    return $this->db->update('units', $data);
	}

}

?>