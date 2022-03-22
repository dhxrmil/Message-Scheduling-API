<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Msgcon extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('form');
		$this->load->model('Msgmodel');
		//$this->load->library('upload');
	}

	public function index()
	{
		echo "hello";
	}

	public function insert()
	{
			/* $config = array(
				'file_name' => $_FILES['image']['name'],
				'upload_path' => './asset/uploads',
				'allowed_types' => 'gif|jpg|png',
			);
			//echo "<pre>"; print_r($config); exit;
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('image')) {
				$imagedata = $this->upload->data();
				$filename = $imagedata['file_name'];	
			} else {

			} */
		$recipients = $this->input->post('recipients');
		$arr = explode(',', $recipients);
		$msgtitle = $this->input->post('msgtitle');
		$msg = $this->input->post('msg');
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		//$image = $this->input->post('image');

		if ($recipients != ''  && $msgtitle != '' && $msg != '' && $date != '' &&  $time != '') {
			for ($i = 0; $i < count($arr); $i++) {
				$item = array(
					'recipients'   => $arr[$i],
					'msgtitle' => $msgtitle,
					'msg' => $msg,
					'date' => $date,
					'time' => $time,
					//'image' => $filename
				);

				$this->db->insert('msgtable', $item);
			}

			$result = (array('success' => true, 'message' => 'Data Inserted'));
		} 
		else 
		{
			$result = (array('error' => false, 'message' => 'Not Inserted!'));
		}

		echo json_encode($result);
	}
	

	public function local()
	{
		$demo = $this->Msgmodel->show();
		date_default_timezone_set("Asia/Kolkata");
		$trimfn = date("H:i");
		echo $trimfn;

		foreach ($demo as $abc) {
			if ($abc['Time'] == date("H:i") && $abc['date'] ==  date("Y-m-d")) {
				$results = (array('success' => true, 'message' => 'Data has been sent!'));
			} else {
				$results = (array('error' => false, 'message' => 'Try again!'));
			}
		}
		echo  json_encode($results);
	}
 }

