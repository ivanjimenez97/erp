<?php      
        
        $config['uri_segment'] = 3;
        $config['per_page'] = 10;
        $config["use_page_numbers"] = FALSE;

        //pagination style

        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] ='<li class="page-link">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-link">';
        $config['last_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-link">';
        $config['prev_tag_close'] = '</li>'; 
        $config['next_tag_open'] = '<li class="page-link">';
        $config['next_tag_close'] ='</li>';
        $config['num_tag_open'] = '<li class="page-link">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a  class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config["num_links"] = 2;


?>
