<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsKegiatanOrang extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsKegiatanOrang');
	}

	public function index(){
		$this->template->load('Home/template','MsKegiatanOrang/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('id,kegiatan');
        $this->datatables->from("ms_kegiatan_orang");
        $this->db->order_by('kegiatan','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsKegiatanOrang/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsKegiatanOrang/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'kegiatan' => set_value('kegiatan'),
			'id' => set_value('id'),
		);
		$this->template->load('Home/template','MsKegiatanOrang/form',$data);
	}

	public function update($id){
		$kat = $this->MMsKegiatanOrang->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'kegiatan' => set_value('kegiatan',$kat['kegiatan']),
			'id' => set_value('id',$kat['id']),
		);
		$this->template->load('Home/template','MsKegiatanOrang/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['kegiatan'] = $this->input->post('kegiatan');

		if(empty($id)){
			$this->MMsKegiatanOrang->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsKegiatanOrang->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsKegiatanOrang');
	}

	public function delete($id){       
        $result = $this->MMsKegiatanOrang->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsKegiatanOrang');
	}
}
