<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$data=[];
		$today = date('Y-m-d');
		$result = $this->db->query("select * from todo where task_date>='{$today}'  order by task_date desc");
		$data['todos'] = $result->result_array();
		$this->load->view("home",$data);	
	}
	public function validate()
	{
		print_r($_POST);
		if(isset($_POST))
		{
			$title = $_POST["taskName"];
			$desc = $_POST["taskDesc"];
			$date = $_POST["selectdate"];
			$result = $this->db->query("INSERT INTO `todo`( `task_name`, `task_description`, `task_date`) VALUES ('$title','$desc','$date')");
			if($result)
			{
				redirect("welcome/");
			}
		}
	}

	public function update($id)
	{
		$result = $this->db->query("UPDATE todo set status=1 where id=$id");
		if($result)
		{
			echo "success";
		}
		else
		{
			echo "fail";
		}
	}
}
