<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imageupload extends CI_Controller {


	function __construct() {
        parent::__construct();

        $this->load->model('save_image_details');
		$this->load->helper('url');

		

	}

	
	public function index()
	{
		$data='';
		$this->load->view('welcome_imagepage',$data);
	}



	public function save_image(){

			$fname = $_POST["username"];
			if(isset($_FILES['file'])){
			    //The error validation could be done on the javascript client side.
			   
			   	$errors='';
			    $file_name = $_FILES['file']['name'];
			    $file_size =$_FILES['file']['size'];
			    $file_tmp =$_FILES['file']['tmp_name'];
			    $file_type=$_FILES['file']['type'];   
			    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			    $extensions = array("jpeg","jpg","png");        
			    if(in_array($file_ext,$extensions )=== false){
			     $errors="image extension not allowed, please choose a JPEG or PNG file.";
			    }
			    if($file_size > 800000){
			    $errors='File size cannot exceed 800KB';
			    }               
			    if($file_size > 800000){

			    echo $errors;

			    

			    }
			    else
			    {
			      
			    $data = file_get_contents($file_tmp);
				$base64 = 'data:' .$file_type.';base64,'.base64_encode($data);    
				$arr=array('image_label'=>$fname,'image_base64'=>$base64,'image_type'=>$file_type);
				$this->load->database();
				$this->save_image_details->insert_images($arr);
				echo "success";
			    }
			}
	}

	public function show_all_images()
	{
		$data['all_images']=$this->save_image_details->load_all_images();

		$this->load->view('show_images',$data);
	}

	public function delete_images()
	{
		if($this->input->post('image_id'))
		{
			$image_id=$this->input->post('image_id');

			if(!empty($image_id))
			{
				$this->save_image_details->delete_images($image_id);
			}

			echo "success";

		}
	}





}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */