<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsJabatan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsJabatan');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$this->template->load('Home/template','MsJabatan/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('ms_jabatan.id,nama_bagian,nama_jabatan,eselon,urut_ttd');
        $this->datatables->from("ms_jabatan");
        $this->datatables->join('ms_bagian', "ms_bagian.id = ms_jabatan.fk_bagian_id", 'left');
        $this->db->order_by('fk_bagian_id,urut_ttd,nama_jabatan,eselon','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsJabatan/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsJabatan/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'fk_bagian_id' => set_value('fk_bagian_id'),
			'nama_jabatan' => set_value('nama_jabatan'),
			'eselon' => set_value('eselon'),
			'urut_ttd' => set_value('urut_ttd'),
			'id' => set_value('id'),
		);
			
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrMsEselon'] = $this->db->query("SELECT * FROM ms_eselon")->result_array();
		$this->template->load('Home/template','MsJabatan/form',$data);
	}

	public function update($id){
		$kat = $this->MMsJabatan->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'fk_bagian_id' => set_value('fk_bagian_id',$kat['fk_bagian_id']),
			'nama_jabatan' => set_value('nama_jabatan',$kat['nama_jabatan']),
			'eselon' => set_value('eselon',$kat['eselon']),
			'urut_ttd' => set_value('urut_ttd',$kat['urut_ttd']),
			'id' => set_value('id',$kat['id']),
		);
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrMsEselon'] = $this->db->query("SELECT * FROM ms_eselon")->result_array();
		$this->template->load('Home/template','MsJabatan/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$fkBag = $this->input->post('fk_bagian_id');
		if($fkBag){
			$data['fk_bagian_id']=$fkBag;
		}		
		$data['nama_jabatan'] = $this->input->post('nama_jabatan');
		$data['eselon'] = $this->input->post('eselon');
		$data['urut_ttd'] = $this->input->post('urut_ttd');

		if(empty($id)){
			$this->MMsJabatan->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsJabatan->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsJabatan');
	}

	public function delete($id){       
        $result = $this->MMsJabatan->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsJabatan');
	}
}
