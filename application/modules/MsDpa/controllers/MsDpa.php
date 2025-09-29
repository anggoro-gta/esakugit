<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsDpa extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsDpa');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$this->template->load('Home/template','MsDpa/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('id,nomor,keterangan');
        $this->datatables->select("DATE_FORMAT(tgl_awal, '%d-%m-%Y') AS tgl_awal", FALSE);
        $this->datatables->select("DATE_FORMAT(tgl_akhir, '%d-%m-%Y') AS tgl_akhir", FALSE);
        $this->datatables->from("ms_dpa");
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsDpa/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsDpa/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'nomor' => set_value('nomor'),
			'keterangan' => set_value('keterangan'),
			'tgl_awal' => set_value('tgl_awal'),
			'tgl_akhir' => set_value('tgl_akhir'),
			'id' => set_value('id'),
		);
		$this->template->load('Home/template','MsDpa/form',$data);
	}

	public function update($id){
		$kat = $this->MMsDpa->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'nomor' => set_value('nomor',$kat['nomor']),
			'keterangan' => set_value('keterangan',$kat['keterangan']),
			'tgl_awal' => set_value('tgl_awal',$this->help->ReverseTgl($kat['tgl_awal'])),
			'tgl_akhir' => set_value('tgl_akhir',$this->help->ReverseTgl($kat['tgl_akhir'])),
			'id' => set_value('id',$kat['id']),
		);
		$this->template->load('Home/template','MsDpa/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['nomor'] = $this->input->post('nomor');
		$data['keterangan'] = $this->input->post('keterangan');
		$data['tgl_awal'] = $this->help->ReverseTgl($this->input->post('tgl_awal'));
		$data['tgl_akhir'] = $this->help->ReverseTgl($this->input->post('tgl_akhir'));

		if(empty($id)){
			$this->MMsDpa->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsDpa->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsDpa');
	}

	public function delete($id){       
        $result = $this->MMsDpa->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsDpa');
	}
}
