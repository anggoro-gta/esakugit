<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsProgram extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->load->model('MMsProgramUtama');
		$this->tahun = $this->session->userdata("tahun");
		$this->level = $this->session->userdata("level");
		$this->fkBagianId = $this->session->userdata("fk_bagian_id");
	}

	protected function arrBagian(){
		$Bagian =null;
		if($this->level!='1' && $this->level!='3'){
			$Bagian =array('id'=>$this->fkBagianId);
		}
		return $this->MMsBagian->get($Bagian);
	}

	public function index(){
		$data['arrMsBagian'] = $this->arrBagian();
		$this->template->load('Home/template','MsProgram/list',$data);
	}

	public function getListDetail(){
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');

		$this->load->view('MsProgram/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $fk_bagian_id = $this->input->post('fk_bagian_id');        

        if($fk_bagian_id){
			$this->datatables->where('ms_program.fk_bagian_id',$fk_bagian_id);
		}
        $this->datatables->select('ms_program.id,fk_bagian_id,program_utama,nama_program,kode_program,nama_bagian,thn_dari,thn_sampai');
        $this->datatables->from("ms_program");
        $this->datatables->join('ms_program_utama', "ms_program_utama.id = ms_program.fk_program_utama_id", 'left');
        $this->datatables->join('ms_bagian', "ms_bagian.id = ms_program.fk_bagian_id", 'inner');
        $this->datatables->where('thn_dari <=',$this->tahun);
		$this->datatables->where('thn_sampai >=',$this->tahun);
        $this->db->order_by('nama_bagian');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsProgram/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsProgram/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'fk_program_utama_id' => set_value('fk_program_utama_id'),
			'fk_bagian_id' => set_value('fk_bagian_id'),
			'nama_program' => set_value('nama_program'),
			'kode_program' => set_value('kode_program'),
			'id' => set_value('id'),
			'thn_dari' => $this->tahun,
			'thn_sampai' => $this->tahun,
		);
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrMsProgUtama'] = $this->MMsProgramUtama->get();
		$this->template->load('Home/template','MsProgram/form',$data);
	}

	public function update($id){
		$kat = $this->MMsProgram->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'fk_program_utama_id' => set_value('fk_program_utama_id',$kat['fk_program_utama_id']),
			'fk_bagian_id' => set_value('fk_bagian_id',$kat['fk_bagian_id']),
			'nama_program' => set_value('nama_program',$kat['nama_program']),
			'kode_program' => set_value('kode_program',$kat['kode_program']),
			'thn_dari' => set_value('thn_dari',$kat['thn_dari']),
			'thn_sampai' => set_value('thn_sampai',$kat['thn_sampai']),
			'id' => set_value('id',$kat['id']),
		);
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrMsProgUtama'] = $this->MMsProgramUtama->get();
		$this->template->load('Home/template','MsProgram/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['fk_program_utama_id'] = $this->input->post('fk_program_utama_id');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['nama_program'] = $this->input->post('nama_program');
		$data['kode_program'] = $this->input->post('kode_program');
		$data['thn_dari'] = $this->input->post('thn_dari');
		$data['thn_sampai'] = $this->input->post('thn_sampai');

		if(empty($id)){
			$this->MMsProgram->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsProgram->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsProgram');
	}

	public function delete($id){       
        $result = $this->MMsProgram->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsProgram');
	}
}
