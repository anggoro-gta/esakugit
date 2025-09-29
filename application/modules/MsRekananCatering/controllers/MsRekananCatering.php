<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsRekananCatering extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsRekananCatering');
	}

	public function index(){
		$this->template->load('Home/template','MsRekananCatering/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('id,nama_rekanan,npwp,nama_bank,no_rekening,atas_nama_rekening,nama_pemilik,jalan,desa_kel,kecamatan,kab_kota,status,jabatan');
        $this->datatables->from("ms_rekanan_catering");
        $this->db->order_by('nama_rekanan');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsRekananCatering/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsRekananCatering/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'nama_rekanan' => set_value('nama_rekanan'),
			'nama_pemilik' => set_value('nama_pemilik'),
			'jabatan' => set_value('jabatan'),
			'npwp' => set_value('npwp'),
			'nama_bank' => set_value('nama_bank'),
			'no_rekening' => set_value('no_rekening'),
			'atas_nama_rekening' => set_value('atas_nama_rekening'),
			'jalan' => set_value('jalan'),
			'desa_kel' => set_value('desa_kel'),
			'kecamatan' => set_value('kecamatan'),
			'kab_kota' => set_value('kab_kota'),
			'status' => set_value('status'),
			'id' => set_value('id'),
		);

		$this->template->load('Home/template','MsRekananCatering/form',$data);
	}

	public function update($id){
		$kat = $this->MMsRekananCatering->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'nama_rekanan' => set_value('nama_rekanan',$kat['nama_rekanan']),
			'nama_pemilik' => set_value('nama_pemilik',$kat['nama_pemilik']),
			'jabatan' => set_value('jabatan',$kat['jabatan']),
			'npwp' => set_value('npwp',$kat['npwp']),
			'nama_bank' => set_value('nama_bank',$kat['nama_bank']),
			'no_rekening' => set_value('no_rekening',$kat['no_rekening']),
			'atas_nama_rekening' => set_value('atas_nama_rekening',$kat['atas_nama_rekening']),
			'jalan' => set_value('jalan',$kat['jalan']),
			'desa_kel' => set_value('desa_kel',$kat['desa_kel']),
			'kecamatan' => set_value('kecamatan',$kat['kecamatan']),
			'kab_kota' => set_value('kab_kota',$kat['kab_kota']),
			'status' => set_value('status',$kat['status']),
			'id' => set_value('id',$kat['id']),
		);

		$this->template->load('Home/template','MsRekananCatering/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['nama_rekanan'] = $this->input->post('nama_rekanan');
		$data['nama_pemilik'] = $this->input->post('nama_pemilik');
		$data['jabatan'] = $this->input->post('jabatan');
		$data['npwp'] = $this->input->post('npwp');
		$data['nama_bank'] = $this->input->post('nama_bank');
		$data['no_rekening'] = $this->input->post('no_rekening');
		$data['atas_nama_rekening'] = $this->input->post('atas_nama_rekening');
		$data['jalan'] = $this->input->post('jalan');
		$data['desa_kel'] = $this->input->post('desa_kel');
		$data['kecamatan'] = $this->input->post('kecamatan');
		$data['kab_kota'] = $this->input->post('kab_kota');
		$data['status'] = $this->input->post('status');
		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		if(empty($id)){
			$this->MMsRekananCatering->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsRekananCatering->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsRekananCatering');
	}

	public function delete($id){       
        $result = $this->MMsRekananCatering->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsRekananCatering');
	}
}
