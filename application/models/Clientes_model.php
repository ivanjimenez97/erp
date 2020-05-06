<?php

class Clientes_model extends CI_Model {



        public function __construct()
        {
                $this->load->database();
        }

		
        public function get_clients($client_id = FALSE)
		{

			if ($client_id === FALSE)
	        {
	                $query = $this->db->get('clients');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('clients', array('client_id' => $client_id));
	        return $query->row_array();
		}

		//Función para obetener data de las tablas de clients, address, municipios y estados. 
		//Recuperados con INNER JOIN
		public function get_all_clients($client_id = FALSE) {

			if ($client_id === false) {
				
				$this->db->select('c.client_id, c.name as cliente, c.fiscal_name, c.rfc, c.email, c.contact, 
				c.tel, a.calle, a.col, a.cp, m.name as municipio, e.name as estado');
				$this->db->from('clients AS c');
				$this->db->join('address AS a', 'c.address_id = a.address_id');
				$this->db->join('municipios AS m', 'm.municipio_id = a.municipio_id');
				$this->db->join('estados AS e', 'e.estado_id = m.estado_id');
				$query = $this->db->get();
	            return $query->result_array();

			}
		
			$query = $this->get_where('clients', array('client_id' => $client_id));
			return $query->row_array();

		}

		public function getClientsList($limit, $start){

				$this->db->select('c.client_id, c.name as cliente, c.fiscal_name, c.rfc, c.email, c.contact, 
				c.tel, a.calle, a.col, a.cp, m.name as municipio, e.name as estado');
				$this->db->from('clients AS c');
				$this->db->join('address AS a', 'c.address_id = a.address_id');
				$this->db->join('municipios AS m', 'm.municipio_id = a.municipio_id');
				$this->db->join('estados AS e', 'e.estado_id = m.estado_id');
				$this->db->order_by('c.client_id', 'ASC');
				$this->db->limit($limit, $start);
				$this->db->where('c.status','1');

				$query = $this->db->get();
				$this->lastQuery = $this->db->last_query();
	            return $query->result_array();
		}


		public function set_clients()
		{
		    $this->load->helper('url');

		    
		  
		    $data = array(
		        'name' => $this->input->post('name'),
				'fiscal_name' => $this->input->post('fiscal_name')
				
		    );

		    return $this->db->insert('clients', $data);
		    
		}



		//Función para obtener estados desde la BD
		function fetch_estados() {
			$this->db->order_by('name', 'ASC');
			$query = $this->db->get('estados');
			return $query->result_array();
		}


		function getMunicipiosById($estado_id){
	        $query = $this->db->get_where('municipios', array('estado_id' => $estado_id));
	        return $query->result_array();
		}

		//Función para obtener municipios
		function fetch_municipios($estado_id) {

			

			$municipios = $this->getMunicipiosById($estado_id);

			$options = '<option>--- Seleccione municipio ---</option>';

			
			foreach ($municipios as $municipio) {
				$options .= '<option value="'.$municipio['municipio_id'].'">'.$municipio['name'].'</option>';
			}

			return $options;

		}

	public function getMunicipios(){
		$this->db->select('municipio_id, name');
		$query = $this->db->get('municipios');
		return $query->result_array();
	}

	public function getMunicipiosSelect($estado_id)
	{

		$this->db->where('estado_id', $estado_id);
		$this->db->order_by('municipio_id', 'ASC');
		$query = $this->db->get('municipios');

		$output = '<option value="0">Selecciona una opción</option>';
		foreach($query->result() as $municipio)
		{
			$output .= '<option value="'.$municipio->municipio_id.'">'.$municipio->name.'</option>';
		}
		return $output;	
	} 

		//Función para obtener data de inputs e insetarlos a la BD
		public function setClients() {

			$this->load->helper('url');

		    $data = array(

				'col'   	   => $this->input->post('col'),
				'calle' 	   => $this->input->post('calle'),
				'cp'	       => $this->input->post('cp'),
				'municipio_id' => $this->input->post('municipio')

			);

			$this->db->insert('address', $data);
			$last_id_address = $this->db->insert_id();


			$data = array(

				'name'        => $this->input->post('name'),
				'fiscal_name' => $this->input->post('fiscal_name'),
				'rfc'         => $this->input->post('rfc'),
				'email'		  => $this->input->post('email'),
				'contact' 	  => $this->input->post('contact'),
				'tel' 	      => $this->input->post('tel'),
				'status'	  => 1,
				'address_id'  => $last_id_address
			);
			$this->db->insert('clients', $data);
			$client_id = $this->db->insert_id();

			$this->setClientArea($client_id);
			
		}

		public function getClientDelete ($client_id){

			$this->db->select('client_id', 'name','fiscal_name','rfc');
			$this->db->where('client_id', $client_id);
			$query =$this->db->get('clients');
			return $query->result_array();
		}

		//Función para eliminar cliente
		public function deleteClient($client_id) {

		$this->load->helper('url');

		$data=array (
		'status'=>0
		);
			$this->db->where('client_id', $client_id);
			$this->db->update('clients', $data);

		}
		private $lastQuery = '';
		
		public function getTotalRow()
	{
		$sql = explode('LIMIT', $this->lastQuery);
		$query = $this->db->query($sql[0]);
		$result = $query->result();
		return count($result);
	}


		public function getClientEdit($client_id){

			$this->db->select('c.client_id, c.name as cliente, c.fiscal_name, c.rfc, c.email, c.contact, 
			c.tel, a.address_id, a.municipio_id as m_id, a.calle, a.col, a.cp, m.name as municipio, e.estado_id as e_id, e.name as estado, ca.client_id as clientareaid, ca.taxterm_id, ca.ca_id');
			$this->db->from('clients AS c');
			$this->db->join('address AS a', 'c.address_id = a.address_id');
			$this->db->join('municipios AS m', 'm.municipio_id = a.municipio_id');
			$this->db->join('estados AS e', 'e.estado_id = m.estado_id');
			$this->db->join('clients_areas AS ca', 'ca.client_id = c.client_id', 'left');
			$this->db->where('c.client_id', $client_id);
			$query = $this->db->get();
	        return $query->row_array();

			
		}

		public function getAdressEdit(){
			$this->db->select('*');
			$query = $this->db->get('address');
			return $query->row_array();
		}

	

		public function editClient($client_id,$address_id){

			$this->load->helper('url');

		    $data = array(

				'col'   	   => $this->input->post('col'),
				'calle' 	   => $this->input->post('calle'),
				'cp'	       => $this->input->post('cp'),
				'municipio_id' => $this->input->post('municipio')

			);
		    
			$this->db->where('address_id',$address_id);
			$this->db->update('address', $data);
			


			$data = array(

				'name'        => $this->input->post('name'),
				'fiscal_name' => $this->input->post('fiscal_name'),
				'rfc'         => $this->input->post('rfc'),
				'email'		  => $this->input->post('email'),
				'contact' 	  => $this->input->post('contact'),
				'tel' 	      => $this->input->post('tel'),
			

			);
			
			$this->db->where('client_id',$client_id);
			$this->db->update('clients', $data);

			$this->deleteClientArea($client_id);
			$this->setClientArea($client_id);
		}

	public function getAreas()
	{
        $this->db->where('parent', '0');
        $this->db->where('tid', '2');
        $this->db->order_by('term', 'ASC');
	   	$query = $this->db->get('taxonomy_terms');
        return $query->result_array();
	}
/*Esta funcion fue hecha para mostrar las areas que tiene ese cliente*/
	public function getAreasEdit($client_id)
	{
		$this->db->select('ca.taxterm_id, txt.term');
		$this->db->where('ca.client_id', $client_id);
		$this->db->from('clients_areas AS ca');
		$this->db->join('taxonomy_terms AS txt', 'txt.term_id = ca.taxterm_id');
		$query = $this->db->get();
	    $dbresult = $query->result_array();
	    $result = [];
	    foreach ($dbresult as $term) {
	    	$result[$term['taxterm_id']] = $term['term'];
	    }
	    return $result;
	}
/*Esta funcion fue hecha para insertar un area a un cliente*/
	public function setClientArea($client_id)
	{
		$taxterms = $this->input->post('clientarea');
		foreach ($taxterms as $taxterm => $taxterm_id) {
			$data = array(
			'client_id' => $client_id,
			'taxterm_id' => $taxterm_id['area']
			);
			$this->db->insert('clients_areas', $data);
		}
	}
/*esta funcion fue hecha para eliminar un area de un cliente*/
	public function deleteClientArea($client_id)
	{
		$this->db->where('client_id', $client_id);
		$this->db->delete('clients_areas');
	}
}

?>