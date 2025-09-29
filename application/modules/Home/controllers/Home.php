<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	function __construct(){
		parent::__construct();

	}

	public function index(){
		$data['contents']=null;
		
		$this->template->load('Home/template','Home/beranda',$data);
	}

	public function changeYear(){
		$tahun = $this->input->post('tahun');
		$this->session->set_userdata(
               array(
               'tahun'  =>  $tahun
                ));
		
		$data=null;
		echo json_encode($data);
	}
}
