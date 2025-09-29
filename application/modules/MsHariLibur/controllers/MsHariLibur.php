<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsHariLibur extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsHariLibur');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$this->template->load('Home/template','MsHariLibur/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('id,tanggal,keterangan');
        $this->datatables->select("DATE_FORMAT(tanggal, '%d-%m-%Y') AS tanggal", FALSE);
        $this->datatables->from("ms_hari_libur");
        $this->datatables->where("DATE_FORMAT(tanggal, '%Y')=",$this->tahun);
        $this->db->order_by('ms_hari_libur.tanggal','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsHariLibur/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsHariLibur/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'tanggal' => set_value('tanggal'),
			'keterangan' => set_value('keterangan'),
			'id' => set_value('id'),
		);
		$this->template->load('Home/template','MsHariLibur/form',$data);
	}

	public function update($id){
		$kat = $this->MMsHariLibur->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'tanggal' => set_value('tanggal',$this->help->ReverseTgl($kat['tanggal'])),
			'keterangan' => set_value('keterangan',$kat['keterangan']),
			'id' => set_value('id',$kat['id']),
		);
		$this->template->load('Home/template','MsHariLibur/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['tanggal'] = $this->help->ReverseTgl($this->input->post('tanggal'));
		$data['keterangan'] = $this->input->post('keterangan');

		if(empty($id)){
			$this->MMsHariLibur->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsHariLibur->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsHariLibur');
	}

	public function delete($id){       
        $result = $this->MMsHariLibur->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsHariLibur');
	}
}
