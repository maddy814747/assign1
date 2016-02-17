<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class save_image_details extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();

        
    }

    public function insert_images($arr)
    {
    	$this->db->database;
    	$this->db->insert('image_details',$arr);
    }

    public function load_all_images()
	{
		$this->db->select('*');
		$this->db->from('image_details');
		$sql=$this->db->get();
		return $sql->result();
	}

	public function delete_images($image_id)
	{
		$this->db->where('image_details_id',$image_id);
		$this->db->delete('image_details');
	}



}