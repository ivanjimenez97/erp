<?php

class Productos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    

    public function get_products($product_id = FALSE)
	{
		if ($product_id === FALSE)
        {
	        
            $this->db->select('p.product_id, p.name, p.description, t.term, u.name AS nameu, b.name AS nameb, p.price, p.barcode, p.image');
            $this->db->from('products AS p');
            $this->db->join('taxonomy_terms AS t', 't.term_id = p.term_id');
            $this->db->join('units AS u', 'u.unit_id = p.unit_id');
            $this->db->join('brands AS b', 'b.brand_id = p.brand_id');
            $query = $this->db->get();
            $this->db->last_query();
            return $query->result_array();

        }

        $query = $this->db->get_where('products', array('product_id' => $product_id));
        return $query->row_array();
	}    

	public function setProducts($image)
	{
	    $this->load->helper('url');
		  
	    $data = array(

	    	'name' => $this->input->post('name'),
	    	'description' => $this->input->post('description'),
	        'term_id' => $this->input->post('subterm'),
	        'unit_id' => $this->input->post('unit'),
	        'brand_id' => $this->input->post('brand'),
	        'price' => $this->input->post('price'),
	        'barcode' => $this->input->post('barcode'),
	        'image' => $image

	    );

	    return $this->db->insert('products', $data);
		    
	}

	//Esta funcion es para mostrar los datos de las categorias cuando seleccionas un taxonomy
	public function get_all_taxtermquery($tid)
	{
			$this->db->where('tid', $tid);
			$this->db->order_by('term_id', 'ASC');
			$query = $this->db->get('taxonomy_terms');
			$output = '<option value="0">Selecciona una opción</option>';
			foreach($query->result() as $taxterms)
			{
				$output .= '<option value="'.$taxterms->term_id.'">'.$taxterms->term.'</option>';
			}
			return $output;
		}	
 		
 	public function getProductsList($limit, $start)
	{
	    $this->db->select('p.product_id, p.name, p.description, t.term, u.name AS nameu, b.name AS nameb, p.price, p.barcode, p.image, p.status');
        $this->db->from('products AS p');
        $this->db->join('taxonomy_terms AS t', 't.term_id = p.term_id');
        $this->db->join('units AS u', 'u.unit_id = p.unit_id');
        $this->db->join('brands AS b', 'b.brand_id = p.brand_id');
        $this->db->order_by('product_id', 'ASC');
        $this->db->limit($limit, $start);
        $this->db->where('p.status', '1');
        $query = $this->db->get();
        $this->lastQuery = $this->db->last_query();
        return $query->result_array();
	}
	// esta funcion es para consultar ciertos datos de los inputs a mostrar en el formulario de edit.
	public function getProductEdit($product_id)
	{
	    $this->db->select('p.product_id, p.name, p.description, t.term, p.term_id, p.unit_id, u.name AS nameu, p.brand_id, b.name AS nameb, p.price, p.barcode, p.image, cat.term AS categoria, cat.term_id AS categoria_id');
        $this->db->from('products AS p');
        $this->db->where('product_id', $product_id);
        $this->db->join('taxonomy_terms AS t', 't.term_id = p.term_id');
        $this->db->join('taxonomy_terms AS cat', 'cat.term_id = t.parent');
        $this->db->join('units AS u', 'u.unit_id = p.unit_id');
        $this->db->join('brands AS b', 'b.brand_id = p.brand_id');
	   	$query = $this->db->get();
        return $query->row_array();
	}
	
	public function editProduct($product_id, $image)
	{
		    	//$this->db->where('product_id', $product_id);
		    	//$this->db->where('image', $image);
				//$this->db->update('products');
		$this->load->helper('url');
		  
	    $data = array(

	    	'name' => $this->input->post('name'),
	    	'description' => $this->input->post('description'),
	        'term_id' => $this->input->post('subterm'),
	        'unit_id' => $this->input->post('unit'),
	        'brand_id' => $this->input->post('brand'),
	        'price' => $this->input->post('price'),
	        'barcode' => $this->input->post('barcode'),
	        'image' => $image

	    );
	    $this->db->where('product_id', $product_id);

	    return $this->db->update('products', $data);    
	}

	public function editProduct2($product_id)
	{
		    	//$this->db->where('product_id', $product_id);
		    	//$this->db->where('image', $image);
				//$this->db->update('products');
		$this->load->helper('url');
		  
	    if (!$this->input->post('subterm')) {
		    $data = array(

		    	'name' => $this->input->post('name'),
		    	'description' => $this->input->post('description'),
		        'term_id' => $this->input->post('term'),
		        'unit_id' => $this->input->post('unit'),
		        'brand_id' => $this->input->post('brand'),
		        'price' => $this->input->post('price'),
		        'barcode' => $this->input->post('barcode')
		    );
	    }
	    else
	    {
		    $data = array(

		    	'name' => $this->input->post('name'),
		    	'description' => $this->input->post('description'),
		        'term_id' => $this->input->post('subterm'),
		        'unit_id' => $this->input->post('unit'),
		        'brand_id' => $this->input->post('brand'),
		        'price' => $this->input->post('price'),
		        'barcode' => $this->input->post('barcode')
		    );
		}
	    $this->db->where('product_id', $product_id);

	    return $this->db->update('products', $data);    
	}

	public function deleteProduct($product_id)
	{
		$this->load->helper('url');	  
	    $data = array(
	        'status' => 0
	    );

		$this->db->where('product_id', $product_id);
		return $this->db->update('products', $data);
	}
	private $lastQuery = '';
	
	public function getTotalRow()
	{
		$sql = explode('LIMIT', $this->lastQuery);
		$query = $this->db->query($sql[0]);
		$result = $query->result();
		return count($result);
	}

	//esta funcion es para obtener los datos de las categorias
	//ordenadas por term_id donde el parent sea igual a 0 y el tid sea igual a la cat 1 para la vista create

	public function getCategoryProduct()
	{
        $this->db->where('parent', '0');
        $this->db->where('tid', '1');
        $this->db->order_by('term', 'ASC');
	   	$query = $this->db->get('taxonomy_terms');
        return $query->result_array();
	}

	//vista edit
	public function getCategoryProductEdit()
	{
		$this->db->select('cat.term_id AS catid, cat.term AS catname, sub.term_id, sub.term');
        $this->db->from('taxonomy_terms AS cat');
        $this->db->join('taxonomy_terms AS sub', 'sub.term_id = cat.term_id');
        //$this->db->join('products AS p', 'p.term_id = t.term_id');
        //$this->db->where('term_id', $subterm);
        $this->db->where('cat.parent', '0');
        //$this->db->or_where('parent', $subterm);
        $this->db->where('cat.tid', '1');
        $this->db->order_by('term', 'ASC');
	   	//$query = $this->db->get('taxonomy_terms');
	   	$query = $this->db->get();
        return $query->result_array();
	}


	//esta funcion muestra en un select las sub categorias de la categoria seleccionada.
	//codigo para llamar los taxonomy terms cuando ya has seleccionado un taxonomy
	public function getSubCategoryQuery($term_id)
	{
		//$this->db->where('term_id', $term_id);
		$this->db->where('parent', $term_id);
		$this->db->order_by('term_id', 'ASC');
		$query = $this->db->get('taxonomy_terms');
		//$output = '<option value="'.'">Selecciona una opción</option>';

		$output = '<option value="0">Selecciona una opción</option>';
		foreach($query->result() as $taxterms)
		{
			$output .= '<option value="'.$taxterms->term_id.'">'.$taxterms->term.'</option>';
		}
		return $output;	
	}


	public function getUnitProduct()
	{
		//$this->db->where();

		$this->db->select('p.unit_id, u.name AS nameu');
		$this->db->from('products AS p');
		$this->db->join('units AS u', 'u.unit_id = p.unit_id');
		$this->db->order_by('unit_id', 'ASC');
		$query = $this->db->get();
        return $query->row_array();
	}

	public function getBrandProduct()
	{
		$query = $this->db->get('brands');
        return $query->result_array();
	}

	public function getProductCart($product_ids){
		$this->db->select('p.product_id, p.name, p.description, t.term, p.term_id, p.unit_id, u.name AS nameu, p.brand_id, b.name AS nameb, p.price, p.barcode, p.image, cat.term AS categoria, cat.term_id AS categoria_id');
        $this->db->from('products AS p');
        $this->db->where_in('product_id', $product_ids);
        $this->db->join('taxonomy_terms AS t', 't.term_id = p.term_id');
        $this->db->join('taxonomy_terms AS cat', 'cat.term_id = t.parent');
        $this->db->join('units AS u', 'u.unit_id = p.unit_id');
        $this->db->join('brands AS b', 'b.brand_id = p.brand_id');
	   	$query = $this->db->get();
        return $query->result_array();
	}

	public function getProductCartEmpty(){
		$this->db->select('*');
        $this->db->from('products AS p');
        $this->db->where('product_id', '');
	   	$query = $this->db->get();
        return $query->result_array();
	}


}

?>