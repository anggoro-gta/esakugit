<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsTarifPjd extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsTarifPjd');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$this->template->load('Home/template','MsTarifPjd/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('t.id,eselon,pegawai,kategori,sub_kategori,t.keterangan,lokasi');
        $this->datatables->select('format(tarif,0)tarif,format(tarif_representasi,0)tarif_representasi');
        $this->datatables->from("ms_sub_kategori_tarif_pjd t");        
        $this->datatables->join('ms_sub_kategori_pjd p', "p.id = t.fk_sub_kategori_id", 'left');
        $this->db->order_by('kategori,eselon,sub_kategori','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsTarifPjd/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsTarifPjd/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'eselon' => set_value('eselon'),
			'pegawai' => set_value('pegawai'),
			'kategori' => set_value('kategori'),
			'fk_sub_kategori_id' => set_value('fk_sub_kategori_id'),
			'tarif' => set_value('tarif'),
			'tarif_representasi' => set_value('tarif_representasi'),
			'keterangan' => set_value('keterangan'),
			'id' => set_value('id'),
		);
			
		$data['arrMsEselon'] = $this->db->query("SELECT * FROM ms_eselon")->result_array();
		$this->template->load('Home/template','MsTarifPjd/form',$data);
	}

	public function update($id){
		$que = "SELECT t.id,eselon,pegawai,kategori,fk_sub_kategori_id,tarif,tarif_representasi,t.keterangan FROM ms_sub_kategori_tarif_pjd t JOIN ms_sub_kategori_pjd k ON k.id=t.fk_sub_kategori_id WHERE t.id=$id ";
		$kat = $this->db->query($que)->row();

		$data = array(
			'button' => 'Update',
			'eselon' => set_value('eselon',$kat->eselon),
			'pegawai' => set_value('pegawai',$kat->pegawai),
			'kategori' => set_value('kategori',$kat->kategori),
			'fk_sub_kategori_id' => set_value('fk_sub_kategori_id',$kat->fk_sub_kategori_id),
			'tarif' => set_value('tarif',$kat->tarif),
			'tarif_representasi' => set_value('tarif_representasi',$kat->tarif_representasi),
			'keterangan' => set_value('keterangan',$kat->keterangan),
			'id' => set_value('id',$kat->id),
		);
		$data['arrMsEselon'] = $this->db->query("SELECT * FROM ms_eselon")->result_array();
		$this->template->load('Home/template','MsTarifPjd/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');	
		$data['eselon'] = $this->input->post('eselon');
		$data['pegawai'] = $this->input->post('pegawai');
		$data['fk_sub_kategori_id'] = $this->input->post('fk_sub_kategori_id');
		$data['tarif'] = str_replace(',', '', $this->input->post('tarif'));
		$rep = $this->input->post('tarif_representasi');
		$data['tarif_representasi'] = empty($rep)?null:str_replace(',', '', $this->input->post('tarif_representasi'));
		$data['keterangan'] = $this->input->post('keterangan');

		if(empty($id)){
			$this->MMsTarifPjd->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsTarifPjd->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsTarifPjd');
	}

	public function delete($id){       
        $result = $this->MMsTarifPjd->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsTarifPjd');
	}

	public function getSubKategori(){
 		$kategori=$_POST['kategori'];
 		$subKat=$_POST['subKat'];

 		$sb = $this->db->query("SELECT * FROM ms_sub_kategori_pjd WHERE kategori='$kategori' ")->result_array();

 		$data['sub'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$sb as $val) {
 			$selected = $val['id']==$subKat?'selected':'';
 			$data['sub'] .= "<option $selected value=\"".$val['id']."\">".$val['sub_kategori']. ' ('.$val['lokasi'].')'."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getSubKategoriBaru(){
 		$kategori=$_POST['kategori'];
 		$subKat=$_POST['subKat'];

 		$andWhere = '';
 		if($kategori=='DD'){
 			$andWhere = "WHERE id=16";
 		}

 		$sb = $this->db->query("SELECT * FROM ms_tarif_provinsi $andWhere ORDER BY provinsi ASC ")->result_array();

 		$data['sub'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$sb as $val) {
 			$selected = $val['id']==$subKat?'selected':'';
 			$data['sub'] .= "<option $selected value=\"".$val['id']."\">".$val['provinsi']."</option>\n";
 		}
 		echo json_encode($data);
 	}
}
