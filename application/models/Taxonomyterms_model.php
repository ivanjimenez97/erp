<?php

class Taxonomyterms_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_taxonomyterms($term_id = FALSE)
	{
		if ($term_id === FALSE)
	    {
	        $query = $this->db->get('taxonomy_terms');
	                return $query->result_array();
	    }

	    $query = $this->db->get_where('taxonomy_terms', array('term_id' => $term_id));
	    return $query->row_array();
	}

	public function get_all_taxtermquery($tid)
	{
		//opcion de consulta 1
		/*$selectedOption = $this->input->post("option");
		$taxtermbyparent = $this->db->query('SELECT * FROM taxonomy_terms WHERE parent = 0 AND tid = '".$selectedOption."';');
		return $taxtermbyparent->result_array();*/

		//opcion de consulta 2
		$this->db->where('tid', $tid);
		$this->db->order_by('term_id', 'ASC');
		$query = $this->db->get('taxonomy_terms');
		$output = '<option value="0">Selecciona una opción</option>';
		foreach($query->result() as $taxterms)
		{
			$output .= '<option value="'.$taxterms->term_id.'">'.$taxterms->term.'</option>';
		}
		return $output;

		//opcion de consulta 3

		/*$query = $this->db->get_where('taxonomy_terms', array('tid' => $tid));
		return $query->result();*/
	}

	private $lastQuery = '';
	
	public function getTotalRow()
	{
		$sql = explode('LIMIT', $this->lastQuery);
		$query = $this->db->query($sql[0]);
		$result = $query->result();
		return count($result);
	}

	public function getTaxonomytermsList($limit, $start)
	{
		//$this->db->order_by('tid', 'ASC');
		$this->db->select('txt.term_id, txt.term, txt.tid, tax.name');
		$this->db->from('taxonomy_terms AS txt');
		$this->db->join('taxonomy AS tax', 'tax.tid = txt.tid');
		$this->db->limit($limit, $start);
		$this->db->where('txt.status', '1');
		$query = $this->db->get();
		$this->lastQuery = $this->db->last_query();
		return $query->result_array();
	}


	public function set_taxonomyterms()
	{
	    $this->load->helper('url');
	  
	    $data = array(

	        'term' => $this->input->post('term'),
	        'status' => 1,
	        'parent' => $this->input->post('parent'),
	        'tid' => $this->input->post('tid')

	    );

	    return $this->db->insert('taxonomy_terms', $data);
		    
	}

	public function getTaxonomytermEdit($term_id)
	{
		$this->db->select('txt.term_id, txt.term, txt.tid AS taxtid, tax.name, txt.parent, tc.term_id AS catid, tc.term AS cat');
		//$this->db->select('txt.term_id, txt.term, txt.tid AS taxtid, tax.name, txt.parent, tc.term_id AS catid, tc.term AS cat, ts.term_id AS subcatid, ts.term AS subcat');
		$this->db->from('taxonomy_terms AS txt');
		$this->db->join('taxonomy_terms AS tc', 'tc.term_id = txt.term_id OR tc.term_id = txt.parent');
		//$this->db->join('taxonomy_terms AS ts', 'ts.term_id = txt.parent');
		$this->db->join('taxonomy AS tax', 'tax.tid = txt.tid');
		$this->db->where('txt.term_id', $term_id);
		$query = $this->db->get();
		return $query->row_array();

	}

	public function getTaxonomyEdit()
	{
        $this->db->order_by('tid', 'ASC');
	   	$query = $this->db->get('taxonomy');
        return $query->result_array();
	}

	public function editTaxonomyterm($term_id)
	{
	    $this->load->helper('url');
	  
	    $data = array(

	        'term' => $this->input->post('term'),
	        'parent' => $this->input->post('parent'),
	        'tid' => $this->input->post('tid')

	    );
		$this->db->where('term_id', $term_id);
	    return $this->db->update('taxonomy_terms', $data);
		    
	}


	public function getTaxtermDelete($term_id)
	{
		$this->db->select('txt.term_id, txt.term, txt.tid AS taxtid, tax.name');
		$this->db->from('taxonomy_terms AS txt');
		$this->db->join('taxonomy AS tax', 'tax.tid = txt.tid');
		$this->db->where('term_id', $term_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function deleteTaxterm($term_id)
	{
		/*$this->db->where('term_id', $term_id);
		$this->db->delete('taxonomy_terms');*/

		$this->load->helper('url');
	  
	    $data = array(

	        'status' => 0

	    );
		$this->db->where('term_id', $term_id);
	    return $this->db->update('taxonomy_terms', $data);
	}


}

?>