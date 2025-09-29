<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsKegiatan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
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
		$this->template->load('Home/template','MsKegiatan/list',$data);
	}

	public function getListDetail(){
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');

		$this->load->view('MsKegiatan/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $fk_bagian_id = $this->input->post('fk_bagian_id');        

        if($fk_bagian_id){
			$this->datatables->where('ms_kegiatan.fk_bagian_id',$fk_bagian_id);
		}
        $this->datatables->select('ms_kegiatan.id,ms_kegiatan.tahun,fk_program_id,kegiatan,kode_kegiatan,nama_program,nama_bagian,singkatan');
        $this->datatables->from("ms_kegiatan");
        $this->datatables->join('ms_program', "ms_program.id = ms_kegiatan.fk_program_id", 'inner');
        $this->datatables->join('ms_bagian', "ms_bagian.id = ms_kegiatan.fk_bagian_id", 'inner');
        $this->datatables->where('tahun',$this->tahun);
        $this->db->order_by('nama_bagian');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsKegiatan/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsKegiatan/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'tahun' => set_value('tahun',$this->tahun),
			'fk_bagian_id' => set_value('fk_bagian_id'),
			'fk_program_id' => set_value('fk_program_id'),
			'kegiatan' => set_value('kegiatan'),
			'kode_kegiatan' => set_value('kode_kegiatan'),
			'singkatan' => set_value('singkatan'),
			'id' => set_value('id'),
		);
			
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$this->template->load('Home/template','MsKegiatan/form',$data);
	}

	public function update($id){
		$kat = $this->MMsKegiatan->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'tahun' => set_value('tahun',$kat['tahun']),
			'fk_bagian_id' => set_value('fk_bagian_id',$kat['fk_bagian_id']),
			'fk_program_id' => set_value('fk_program_id',$kat['fk_program_id']),
			'kegiatan' => set_value('kegiatan',$kat['kegiatan']),
			'kode_kegiatan' => set_value('kode_kegiatan',$kat['kode_kegiatan']),
			'singkatan' => set_value('singkatan',$kat['singkatan']),
			'id' => set_value('id',$kat['id']),
		);
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$this->template->load('Home/template','MsKegiatan/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['tahun'] = $this->input->post('tahun');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['kegiatan'] = $this->input->post('kegiatan');
		$data['kode_kegiatan'] = $this->input->post('kode_kegiatan');
		$data['singkatan'] = $this->input->post('singkatan');

		if(empty($id)){
			$this->MMsKegiatan->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsKegiatan->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsKegiatan');
	}

	public function delete($id){       
        $result = $this->MMsKegiatan->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsKegiatan');
	}

	public function getProgram(){
 		$fk_bagian_id=$_POST['fk_bagian_id'];
 		$fk_program_id=$_POST['fk_program_id'];
 			$this->MMsProgram->thn_in($this->tahun);
 		
 		$andWhere = array('fk_bagian_id'=>$fk_bagian_id);
 		// if($this->tahun!='2020'){
 		// 	$andWhere = '';
 		// }
 		$bid = $this->MMsProgram->get($andWhere);

 		$data['Bagian'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$bid as $val) {
 			$selected = $val['id']==$fk_program_id?'selected':'';
 			$data['Bagian'] .= "<option $selected value=\"".$val['id']."\">".$val['nama_program']."</option>\n";
 		}
 		echo json_encode($data);
 	}
}
