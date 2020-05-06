<?php

class Marcas_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_brands($brand_id = FALSE)
		{
			if ($brand_id === FALSE)
	        {
	                $query = $this->db->get('brands');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('brands', array('brand_id' => $brand_id));
	        return $query->row_array();
		}
		
		public function getAllBrands()
		{
			$this->db->order_by('brand_id', 'ASC');
			$query = $this->db->get('brands');
			return $query->result();
		}
		public function set_brands()
		
		{
		    $this->load->helper('url');
		  
		    $data = array(
		        'name' => $this->input->post('name'),
		        'status' => 1
		    );

		    return $this->db->insert('brands', $data);
		    
		}

	private $lastQuery = '';
	
	public function getTotalRow()
	{
		$sql = explode('LIMIT', $this->lastQuery);
		$query = $this->db->query($sql[0]);
		$result = $query->result();
		return count($result);
	}

	public function getBrandsList($limit, $start)
	{
		$this->db->order_by('name', 'ASC');
		$this->db->limit($limit, $start);
		$this->db->where('status', '1');
		$query = $this->db->get('brands');
		$this->lastQuery = $this->db->last_query();
		return $query->result_array();
	}

	public function getBrandEdit($brand_id)
	{
        $this->db->where('brand_id', $brand_id);
	   	$query = $this->db->get('brands');
        return $query->row_array();
	}

	public function editBrand($brand_id)
	{
		$this->load->helper('url');
		  
	    $data = array(
	        'name' => $this->input->post('name')
	    );
	    $this->db->where('brand_id', $brand_id);
	    return $this->db->update('brands', $data);	
	}

	public function getBrandDelete($brand_id)
	{
        $this->db->where('brand_id', $brand_id);
	   	$query = $this->db->get('brands');
        return $query->row_array();
	}

	public function deleteBrand($brand_id)
	{
		$this->load->helper('url');	  
	    $data = array(
	        'status' => 0
	    );

		$this->db->where('brand_id', $brand_id);
		return $this->db->update('brands', $data);
	}


}

?>