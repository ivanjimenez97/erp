<?php

class Cotizaciones_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function getClientQuote()
    {
    	$this->db->order_by('name', 'ASC');
    	$query = $this->db->get('clients');
    	return $query->result_array();
    }

    public function getClientDetails($client)
    {

    	$this->db->select('c.client_id, c.name, c.contact, c.tel, a.address_id, a.calle as direccion, a.col, a.cp');
    	$this->db->from('address AS a');
    	$this->db->join('clients AS c', 'c.address_id = a.address_id');
    	$this->db->where('c.client_id', $client);
    	
    	return $this->db->get();
    	
    }

    public function saveQuote()
    {
    	$this->load->helper('url');
		  
	    $data = array(
	    	'clientfolio' => $this->input->post('foliocliente'),
	    	'description' => $this->input->post('description'),
	        'subtotal' => str_replace(",", "", $this->input->post('subtotal')),
	        'iva' => str_replace(",", "", $this->input->post('iva')),
	        'total' => str_replace(",", "", $this->input->post('total')),
	        'date' =>time(),
	        'client_id' => $this->input->post('client'),
	        'areacliente' => $this->input->post('area_cliente'),
	        'status' => 1
	    );

	    $this->db->insert('quotes', $data);

	    $quote_id = $this->db->insert_id();

	    $productos = $this->input->post('producto'); 
		
	    foreach ($productos as $productid => $product) {
	     
		    $data2 = array(
		
		    	'product_id' => $productid,
		        'unit_price' => $product['unit_price'],
		        'quantity' 	 => $product['quantity'],
		        'pricetopay' => $product['pricetopay'],
		        'status' => 1,
		        'quote_id' => $quote_id
		    	);
			
		    $this->db->insert('items_quote', $data2);
	    }

	}
		    

	//codigo utilizado para el paginador
	private $lastQuery = '';
	
	public function getTotalRow()
	{
		$sql = explode('LIMIT', $this->lastQuery);
		$query = $this->db->query($sql[0]);
		$result = $query->result();
		return count($result);
	}
	//funcion para la consulta del listado de cotizaciones
	public function getQuotesList($limit, $start)
	{
		$this->db->select('q.quote_id, q.description, q.subtotal, q.iva, q.total, q.date, q.client_id, c.name AS clientname');
		$this->db->from('quotes AS q');
		$this->db->join('clients AS c', 'c.client_id = q.client_id');
        //$this->db->order_by('q.quote_id', 'ASC');
        $this->db->limit($limit, $start);
        $this->db->where('q.status', '1');
        $query = $this->db->get();
        $this->lastQuery = $this->db->last_query();
        return $query->result_array();
	}

	public function getProductEdit($quote_id)
	{
		$this->db->select('p.product_id, p.name, p.description, t.term, p.term_id, p.unit_id, u.name AS nameu, p.brand_id, b.name AS nameb, p.price, p.barcode, p.image, cat.term AS categoria, cat.term_id AS categoria_id, iq.itemq_id, iq.unit_price, iq.quantity, iq.pricetopay');
        $this->db->from('quotes AS q');
        
        $this->db->join('items_quote AS iq', 'iq.quote_id = q.quote_id');
        $this->db->join('products AS p', 'p.product_id = iq.product_id');
         $this->db->join('taxonomy_terms AS t', 't.term_id = p.term_id');
        $this->db->join('taxonomy_terms AS cat', 'cat.term_id = t.parent');
        $this->db->join('units AS u', 'u.unit_id = p.unit_id');
        $this->db->join('brands AS b', 'b.brand_id = p.brand_id');
        $this->db->where('iq.status', '1');
        $this->db->where('q.quote_id', $quote_id);
	   	$query = $this->db->get();
        return $query->result_array();
	}

	public function getQuoteEdit($quote_id)
	{
		$this->db->select('p.product_id, p.name, p.description, t.term, p.term_id, p.unit_id, u.name AS nameu, p.brand_id, b.name AS nameb, p.price, p.barcode, p.image, cat.term AS categoria, cat.term_id AS categoria_id, iq.unit_price, iq.quantity, iq.pricetopay, q.quote_id AS cotizacion_id, q.clientfolio, q.description, q.subtotal, q.iva, q.total, q.client_id AS clientidquote, q.date, c.name AS clientname, q.areacliente');
        $this->db->from('quotes AS q');
        $this->db->join('clients AS c', 'c.client_id = q.client_id');
        
        $this->db->join('items_quote AS iq', 'iq.quote_id = q.quote_id');
        $this->db->join('products AS p', 'p.product_id = iq.product_id');
         $this->db->join('taxonomy_terms AS t', 't.term_id = p.term_id');
        $this->db->join('taxonomy_terms AS cat', 'cat.term_id = t.parent');
        $this->db->join('units AS u', 'u.unit_id = p.unit_id');
        $this->db->join('brands AS b', 'b.brand_id = p.brand_id');

        $this->db->where_in('q.quote_id', $quote_id);
	   	$query = $this->db->get();
        return $query->row_array();
	}

    public function editQuote($quote_id)
    {
    	$this->load->helper('url');
		  
	    $data = array(

	    	'client_id' => $this->input->post('client'),
	    	'description' => $this->input->post('description'),
	        'subtotal' => str_replace(",", "", $this->input->post('subtotal')),
	        'iva' => str_replace(",", "", $this->input->post('iva')),
	        'total' => str_replace(",", "", $this->input->post('total')),
	        //'subtotal' => $this->input->post('subtotal'),
	        //'iva' => $this->input->post('iva'),
	        //'total' => $this->input->post('total'),
	        'areacliente' => $this->input->post('area_cliente')

	    );
	    
	    $this->db->where('quote_id', $quote_id);
	    $this->db->update('quotes', $data);


	    $productos = $this->input->post('producto');

	    foreach ($productos as $productid => $product) {

	    
	    $data2 = array(

	        'unit_price' => $product['unit_price'],
	        'quantity' => $product['quantity'],
	        'pricetopay' => $product['pricetopay'],

	    	);
		
		$this->db->where('product_id', $productid);
		$this->db->where('quote_id', $quote_id);
	    $this->db->update('items_quote', $data2);
	    }   

	}

	public function deleteItemFromQuote($itemq_id)
	{
		$this->load->helper('url');
	  
	    $data = array(

	        'status' => 0

	    );
		$this->db->where('itemq_id', $itemq_id);
	    $this->db->update('items_quote', $data);
	}

	public function getQuoteDelete($quote_id)
	{
		$this->db->select('p.product_id, p.name, p.description, t.term, p.term_id, p.unit_id, u.name AS nameu, p.brand_id, b.name AS nameb, p.price, p.barcode, p.image, cat.term AS categoria, cat.term_id AS categoria_id, iq.unit_price, iq.quantity, iq.pricetopay, q.quote_id, q.quote_id AS cotizacion_id, q.description AS qdescription, q.subtotal, q.iva, q.total, q.date, q.client_id, c.name AS clientname');
        $this->db->from('quotes AS q');
        $this->db->join('clients AS c', 'c.client_id = q.client_id');
        
        $this->db->join('items_quote AS iq', 'iq.quote_id = q.quote_id');
        $this->db->join('products AS p', 'p.product_id = iq.product_id');
         $this->db->join('taxonomy_terms AS t', 't.term_id = p.term_id');
        $this->db->join('taxonomy_terms AS cat', 'cat.term_id = t.parent');
        $this->db->join('units AS u', 'u.unit_id = p.unit_id');
        $this->db->join('brands AS b', 'b.brand_id = p.brand_id');
        $this->db->where_in('q.quote_id', $quote_id);
	   	$query = $this->db->get();
        return $query->row_array();
	}

	public function deleteQuote($quote_id)
	{
		$this->load->helper('url');
		$this->db->where('quote_id', $quote_id);
	    $this->db->delete('quotes');
	}

	public function getClientAreaQuote($client)
	{
		$this->db->select('ca.taxterm_id, txt.term');
		$this->db->from('clients_areas AS ca');
		$this->db->join('taxonomy_terms AS txt', 'txt.term_id = ca.taxterm_id');
		$this->db->where('ca.client_id', $client);
		$query = $this->db->get();

		$output = '<option value="0">Selecciona una opción</option>';
		foreach($query->result() as $area)
		{
			$output .= '<option value="'.$area->taxterm_id.'">'.$area->term.'</option>';
		}
		if ($query->num_rows() == 0) {
			# code...
		}
		return $output;

	}

	public function getClientAreaQuoteEdit($quote_id)
	{
		$this->db->select('ca.client_id, ca.taxterm_id, txt.term');
		$this->db->from('quotes AS q');
		$this->db->join('clients_areas AS ca', 'ca.client_id = q.client_id');
		$this->db->join('taxonomy_terms AS txt', 'txt.term_id = ca.taxterm_id');
		$this->db->where('q.quote_id', $quote_id);
		$query = $this->db->get();
		return $query->result_array();
	}


}