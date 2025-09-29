<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsBidang extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsBidang');
	}

	public function index(){
		$this->template->load('Home/template','MsBidang/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('id,nama_bidang,singkatan_bidang');
        $this->datatables->from("ms_bidang");
        $this->db->order_by('nama_bidang','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsBidang/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsBidang/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'nama_bidang' => set_value('nama_bidang'),
			'singkatan_bidang' => set_value('singkatan_bidang'),
			'id' => set_value('id'),
		);
		$this->template->load('Home/template','MsBidang/form',$data);
	}

	public function update($id){
		$kat = $this->MMsBidang->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'nama_bidang' => set_value('nama_bidang',$kat['nama_bidang']),
			'singkatan_bidang' => set_value('singkatan_bidang',$kat['singkatan_bidang']),
			'id' => set_value('id',$kat['id']),
		);
		$this->template->load('Home/template','MsBidang/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['nama_bidang'] = $this->input->post('nama_bidang');
		$data['singkatan_bidang'] = $this->input->post('singkatan_bidang');

		if(empty($id)){
			$this->MMsBidang->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsBidang->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsBidang');
	}

	public function delete($id){       
        $result = $this->MMsBidang->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsBidang');
	}
}
