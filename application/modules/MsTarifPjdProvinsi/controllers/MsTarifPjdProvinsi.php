<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsTarifPjdProvinsi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsTarifPjdProvinsi');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$this->template->load('Home/template','MsTarifPjdProvinsi/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('id,provinsi');
        $this->datatables->select('FORMAT(tarif_dd,0) tarif_dd');
        $this->datatables->select('FORMAT(tarif_dl,0) tarif_dl');
        $this->datatables->select('FORMAT(tarif_diklat,0) tarif_diklat');
        $this->datatables->select('FORMAT(tarif_fullboard,0) tarif_fullboard');
        $this->datatables->select('FORMAT(tarif_bimtek,0) tarif_bimtek');
        $this->datatables->from("ms_tarif_provinsi");        
        $this->db->order_by('provinsi','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsTarifPjdProvinsi/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsTarifPjdProvinsi/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'provinsi' => set_value('provinsi'),
			'tarif_dd' => set_value('tarif_dd'),
			'tarif_dl' => set_value('tarif_dl'),
			'tarif_diklat' => set_value('tarif_diklat'),
			'tarif_fullboard' => set_value('tarif_fullboard'),
			'tarif_bimtek' => set_value('tarif_bimtek'),
			'id' => set_value('id'),
		);
			
		$this->template->load('Home/template','MsTarifPjdProvinsi/form',$data);
	}

	public function update($id){
		$que = "SELECT id,provinsi,tarif_dd,tarif_dl,tarif_diklat,tarif_fullboard,tarif_bimtek FROM ms_tarif_provinsi WHERE id=$id ";
		$kat = $this->db->query($que)->row();

		$data = array(
			'button' => 'Update',
			'provinsi' => set_value('provinsi',$kat->provinsi),
			'tarif_dd' => set_value('tarif_dd',$kat->tarif_dd),
			'tarif_dl' => set_value('tarif_dl',$kat->tarif_dl),
			'tarif_diklat' => set_value('tarif_diklat',$kat->tarif_diklat),
			'tarif_fullboard' => set_value('tarif_fullboard',$kat->tarif_fullboard),
			'tarif_bimtek' => set_value('tarif_bimtek',$kat->tarif_bimtek),
			'id' => set_value('id',$kat->id),
		);
		$this->template->load('Home/template','MsTarifPjdProvinsi/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');	
		$data['provinsi'] = $this->input->post('provinsi');
		
			$repTrfDD = $this->input->post('tarif_dd');
		$data['tarif_dd'] = empty($repTrfDD)?null:str_replace(',', '', $repTrfDD);
			$repTrfDL = $this->input->post('tarif_dl');
		$data['tarif_dl'] = empty($repTrfDL)?null:str_replace(',', '', $repTrfDL);
			$repTrfDklat = $this->input->post('tarif_diklat');
		$data['tarif_diklat'] = empty($repTrfDklat)?null:str_replace(',', '', $repTrfDklat);
			$repTrfFullboard = $this->input->post('tarif_fullboard');
		$data['tarif_fullboard'] = empty($repTrfFullboard)?null:str_replace(',', '', $repTrfFullboard);
			$repTrfBmtek = $this->input->post('tarif_bimtek');
		$data['tarif_bimtek'] = empty($repTrfBmtek)?null:str_replace(',', '', $repTrfBmtek);

		if(empty($id)){
			$this->MMsTarifPjdProvinsi->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsTarifPjdProvinsi->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsTarifPjdProvinsi');
	}

	public function delete($id){       
        $result = $this->MMsTarifPjdProvinsi->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsTarifPjdProvinsi');
	}

}
