<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsProgramUtama extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgramUtama');
		$this->level = $this->session->userdata("level");
	}

	public function index(){
		$this->template->load('Home/template','MsProgramUtama/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
     
        $this->datatables->select('id,program_utama,kode');
        $this->datatables->from("ms_program_utama");
        $this->db->order_by('kode');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsProgramUtama/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsProgramUtama/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'program_utama' => set_value('program_utama'),
			'kode' => set_value('kode'),
			'id' => set_value('id'),
		);
		$this->template->load('Home/template','MsProgramUtama/form',$data);
	}

	public function update($id){
		$kat = $this->MMsProgramUtama->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'program_utama' => set_value('program_utama',$kat['program_utama']),
			'kode' => set_value('kode',$kat['kode']),
			'id' => set_value('id',$kat['id']),
		);
		$this->template->load('Home/template','MsProgramUtama/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['program_utama'] = $this->input->post('program_utama');
		$data['kode'] = $this->input->post('kode');

		if(empty($id)){
			$this->MMsProgramUtama->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsProgramUtama->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsProgramUtama');
	}

	public function delete($id){       
        $result = $this->MMsProgramUtama->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsProgramUtama');
	}
}
