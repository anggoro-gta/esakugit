<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsBagian extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsBagian');
	}

	public function index(){
		$this->template->load('Home/template','MsBagian/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('id,nama_bagian,singkatan_bagian,kode_bagian,kelompok_asisten');
        $this->datatables->from("ms_bagian");
        $this->db->order_by('kode_bagian','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsBagian/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsBagian/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'nama_bagian' => set_value('nama_bagian'),
			'singkatan_bagian' => set_value('singkatan_bagian'),
			'kode_bagian' => set_value('kode_bagian'),
			'kelompok_asisten' => set_value('kelompok_asisten'),
			'id' => set_value('id'),
		);
		$data['arrAssisten']=$this->db->query("SELECT nama_jabatan FROM ms_jabatan WHERE nama_jabatan LIKE '%Asisten%'")->result();
		$this->template->load('Home/template','MsBagian/form',$data);
	}

	public function update($id){
		$kat = $this->MMsBagian->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'nama_bagian' => set_value('nama_bagian',$kat['nama_bagian']),
			'singkatan_bagian' => set_value('singkatan_bagian',$kat['singkatan_bagian']),
			'kode_bagian' => set_value('kode_bagian',$kat['kode_bagian']),
			'kelompok_asisten' => set_value('kelompok_asisten',$kat['kelompok_asisten']),
			'id' => set_value('id',$kat['id']),
		);
		$data['arrAssisten']=$this->db->query("SELECT nama_jabatan FROM ms_jabatan WHERE nama_jabatan LIKE '%Asisten%'")->result();
		$this->template->load('Home/template','MsBagian/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['nama_bagian'] = $this->input->post('nama_bagian');
		$data['singkatan_bagian'] = $this->input->post('singkatan_bagian');
		$data['kode_bagian'] = $this->input->post('kode_bagian');
		$data['kelompok_asisten'] = $this->input->post('kelompok_asisten');

		if(empty($id)){
			$this->MMsBagian->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsBagian->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsBagian');
	}

	public function delete($id){       
        $result = $this->MMsBagian->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsBagian');
	}
}
