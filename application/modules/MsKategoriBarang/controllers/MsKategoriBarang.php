<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsKategoriBarang extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsKategoriBarang');
	}

	public function index(){
		$this->template->load('Home/template','MsKategoriBarang/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('id,nama_kategori');
        $this->datatables->select("CASE status WHEN 0 THEN 'Tidak Aktif' ELSE 'Aktif' END as statusnya");
        $this->datatables->from("pb_ms_kategori_barang");
        $this->db->order_by('id','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsKategoriBarang/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsKategoriBarang/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'nama_kategori' => set_value('nama_kategori'),
			'status' => set_value('status'),
			'id' => set_value('id'),
		);
		$this->template->load('Home/template','MsKategoriBarang/form',$data);
	}

	public function update($id){
		$kat = $this->MMsKategoriBarang->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'nama_kategori' => set_value('nama_kategori',$kat['nama_kategori']),
			'status' => set_value('status',$kat['status']),
			'id' => set_value('id',$kat['id']),
		);
		$this->template->load('Home/template','MsKategoriBarang/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['nama_kategori'] = $this->input->post('nama_kategori');
		$data['status'] = $this->input->post('status');

		if(empty($id)){
			$this->MMsKategoriBarang->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsKategoriBarang->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsKategoriBarang');
	}

	public function delete($id){       
        $result = $this->MMsKategoriBarang->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsKategoriBarang');
	}
}
