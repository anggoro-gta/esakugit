<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsRekeningBelanja extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsRekeningBelanja');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsBagian');
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
		$this->template->load('Home/template','MsRekeningBelanja/list',$data);
	}

	public function getListDetail(){
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');

		$this->load->view('MsRekeningBelanja/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

		$fk_bagian_id = $this->input->post('fk_bagian_id');        

        if($fk_bagian_id){
			$this->datatables->where('ms_kegiatan.fk_bagian_id',$fk_bagian_id);
		}
		
		$this->datatables->where('ms_kegiatan.tahun',$this->tahun);
		// if($this->level!='1'){
		// 	$this->datatables->where('ms_kegiatan.fk_bagian_id',$this->fkBagianId);
		// }
        
        $this->datatables->select('ms_rekening_belanja.id,nama_bagian,kegiatan,kode_rek_belanja,nama_rek_belanja');
        $this->datatables->select("FORMAT(anggaran, 0) AS anggaran");
        $this->datatables->select("FORMAT(anggaran_per_perbup1, 0) AS anggaran_per_perbup1");
        $this->datatables->select("DATE_FORMAT(tgl_per_perbup1, '%d/%m/%Y') AS tgl_per_perbup1", FALSE);
        $this->datatables->select("FORMAT(anggaran_per_perbup2, 0) AS anggaran_per_perbup2");
        $this->datatables->select("DATE_FORMAT(tgl_per_perbup2, '%d/%m/%Y') AS tgl_per_perbup2", FALSE);
        $this->datatables->select("FORMAT(anggaran_per_perbup3, 0) AS anggaran_per_perbup3");
        $this->datatables->select("DATE_FORMAT(tgl_per_perbup3, '%d/%m/%Y') AS tgl_per_perbup3", FALSE);
        $this->datatables->select("FORMAT(anggaran_per_perbup4, 0) AS anggaran_per_perbup4");
        $this->datatables->select("DATE_FORMAT(tgl_per_perbup4, '%d/%m/%Y') AS tgl_per_perbup4", FALSE);
        $this->datatables->select("FORMAT(anggaran_pak, 0) AS anggaran_pak");
        $this->datatables->select("DATE_FORMAT(tgl_pak, '%d/%m/%Y') AS tgl_pak", FALSE);
        $this->datatables->select("FORMAT(bts_anggaran_semester_1, 0) AS bts_anggaran_semester_1");
        $this->datatables->from("ms_rekening_belanja");
        $this->datatables->join('ms_kegiatan', "ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id", 'inner');
        $this->datatables->join('ms_bagian', "ms_bagian.id = ms_kegiatan.fk_bagian_id", 'inner');
        $this->db->order_by('fk_bagian_id','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsRekeningBelanja/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsRekeningBelanja/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'fk_kegiatan_id' => set_value('fk_kegiatan_id'),
			'kode_rek_belanja' => set_value('kode_rek_belanja'),
			'nama_rek_belanja' => set_value('nama_rek_belanja'),
			'anggaran' => set_value('anggaran'),
			'anggaran_per_perbup1' => set_value('anggaran_per_perbup1'),
			'tgl_per_perbup1' => set_value('tgl_per_perbup1'),
			'anggaran_per_perbup2' => set_value('anggaran_per_perbup2'),
			'tgl_per_perbup2' => set_value('tgl_per_perbup2'),
			'anggaran_per_perbup3' => set_value('anggaran_per_perbup3'),
			'tgl_per_perbup3' => set_value('tgl_per_perbup3'),
			'anggaran_per_perbup4' => set_value('anggaran_per_perbup4'),
			'tgl_per_perbup4' => set_value('tgl_per_perbup4'),
			'anggaran_pak' => set_value('anggaran_pak'),
			'tgl_pak' => set_value('tgl_pak'),
			'bts_anggaran_semester_1' => set_value('bts_anggaran_semester_1'),
			'id' => set_value('id'),
		);
		$data['arrKegiatan']=$this->MMsKegiatan->get(array('tahun'=>$this->tahun));

		$this->template->load('Home/template','MsRekeningBelanja/form',$data);
	}

	public function update($id){
		$kat = $this->MMsRekeningBelanja->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'fk_kegiatan_id' => set_value('fk_kegiatan_id',$kat['fk_kegiatan_id']),
			'kode_rek_belanja' => set_value('kode_rek_belanja',$kat['kode_rek_belanja']),
			'nama_rek_belanja' => set_value('nama_rek_belanja',$kat['nama_rek_belanja']),
			'anggaran' => set_value('anggaran',$kat['anggaran']),
			'anggaran_per_perbup1' => set_value('anggaran_per_perbup1',$kat['anggaran_per_perbup1']),
			'tgl_per_perbup1' => set_value('tgl_per_perbup1',$this->help->ReverseTgl($kat['tgl_per_perbup1'])),
			'anggaran_per_perbup2' => set_value('anggaran_per_perbup2',$kat['anggaran_per_perbup2']),
			'tgl_per_perbup2' => set_value('tgl_per_perbup2',$this->help->ReverseTgl($kat['tgl_per_perbup2'])),
			'anggaran_per_perbup3' => set_value('anggaran_per_perbup3',$kat['anggaran_per_perbup3']),
			'tgl_per_perbup3' => set_value('tgl_per_perbup3',$this->help->ReverseTgl($kat['tgl_per_perbup3'])),
			'anggaran_per_perbup4' => set_value('anggaran_per_perbup4',$kat['anggaran_per_perbup4']),
			'tgl_per_perbup4' => set_value('tgl_per_perbup4',$this->help->ReverseTgl($kat['tgl_per_perbup4'])),
			'anggaran_pak' => set_value('anggaran_pak',$kat['anggaran_pak']),
			'tgl_pak' => set_value('tgl_pak',$this->help->ReverseTgl($kat['tgl_pak'])),
			'bts_anggaran_semester_1' => set_value('bts_anggaran_semester_1',$kat['bts_anggaran_semester_1']),
			'id' => set_value('id',$kat['id']),
		);
		$data['arrKegiatan']=$this->MMsKegiatan->get(array('tahun'=>$this->tahun));

		$this->template->load('Home/template','MsRekeningBelanja/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');
		$data['kode_rek_belanja'] = $this->input->post('kode_rek_belanja');
		$data['nama_rek_belanja'] = $this->input->post('nama_rek_belanja');
		$data['anggaran'] = str_replace(',', '', $this->input->post('anggaran'));
		
			$prbp1 = str_replace(',', '', $this->input->post('anggaran_per_perbup1'));
			$angprbp1=$prbp1;
			if($prbp1==''){
				$angprbp1 = null;
			}
		$data['anggaran_per_perbup1'] = $angprbp1;
		$data['tgl_per_perbup1'] = !empty($this->input->post('tgl_per_perbup1'))?$this->help->ReverseTgl($this->input->post('tgl_per_perbup1')):null;
		
			$prbp2 = str_replace(',', '', $this->input->post('anggaran_per_perbup2'));
			$angprbp2=$prbp2;
			if($prbp2==''){
				$angprbp2 = null;
			}
		$data['anggaran_per_perbup2'] = $angprbp2;
		$data['tgl_per_perbup2'] = !empty($this->input->post('tgl_per_perbup2'))?$this->help->ReverseTgl($this->input->post('tgl_per_perbup2')):null;
		
			$prbp3 = str_replace(',', '', $this->input->post('anggaran_per_perbup3'));
			$angprbp3=$prbp3;
			if($prbp3==''){
				$angprbp3 = null;
			}
		$data['anggaran_per_perbup3'] = $angprbp3;
		$data['tgl_per_perbup3'] = !empty($this->input->post('tgl_per_perbup3'))?$this->help->ReverseTgl($this->input->post('tgl_per_perbup3')):null;
		
			$prbp4 = str_replace(',', '', $this->input->post('anggaran_per_perbup4'));
			$angprbp4=$prbp4;
			if($prbp4==''){
				$angprbp4 = null;
			}
		$data['anggaran_per_perbup4'] = $angprbp4;
		$data['tgl_per_perbup4'] = !empty($this->input->post('tgl_per_perbup4'))?$this->help->ReverseTgl($this->input->post('tgl_per_perbup4')):null;
			
			$pak = str_replace(',', '', $this->input->post('anggaran_pak'));
			$angPAK=$pak;
			if($pak==''){
				$angPAK = null;
			}
		$data['anggaran_pak'] = $angPAK;
		$data['tgl_pak'] = !empty($this->input->post('tgl_pak'))?$this->help->ReverseTgl($this->input->post('tgl_pak')):null;
		
		$data['bts_anggaran_semester_1'] = str_replace(',', '', $this->input->post('bts_anggaran_semester_1'));

		if(empty($id)){
			$this->MMsRekeningBelanja->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsRekeningBelanja->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsRekeningBelanja');
	}

	public function delete($id){       
        $result = $this->MMsRekeningBelanja->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsRekeningBelanja');
	}
	
	public function updatePerbup1(){
		$que = "UPDATE ms_rekening_belanja as t1,
					(SELECT ms_rekening_belanja.id,anggaran FROM ms_rekening_belanja 
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					WHERE tahun = '{$this->tahun}') as t2
				SET t1.anggaran_per_perbup1 = t2.anggaran
				WHERE t1.id = t2.id";
		$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

	public function updateTglPerbup1(){
		$tgl_perbup_1 = $this->help->ReverseTgl($this->input->post('tgl_perbup_1'));
		$this->db->trans_start();

			$que = "UPDATE ms_rekening_belanja
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					SET ms_rekening_belanja.tgl_per_perbup1 = '$tgl_perbup_1'
					WHERE ms_kegiatan.tahun = '{$this->tahun}'";
			$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Tgl Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

	public function updatePerbup2(){
		$que = "UPDATE ms_rekening_belanja as t1,
					(SELECT ms_rekening_belanja.id,anggaran_per_perbup1 FROM ms_rekening_belanja 
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					WHERE tahun = '{$this->tahun}') as t2
				SET t1.anggaran_per_perbup2 = t2.anggaran_per_perbup1
				WHERE t1.id = t2.id";
		$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

	public function updateTglPerbup2(){
		$tgl_perbup_2 = $this->help->ReverseTgl($this->input->post('tgl_perbup_2'));
		$this->db->trans_start();

			$que = "UPDATE ms_rekening_belanja
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					SET ms_rekening_belanja.tgl_per_perbup2 = '$tgl_perbup_2'
					WHERE ms_kegiatan.tahun = '{$this->tahun}'";
			$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Tgl Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

	public function updatePerbup3(){
		$que = "UPDATE ms_rekening_belanja as t1,
					(SELECT ms_rekening_belanja.id,anggaran_per_perbup2 FROM ms_rekening_belanja 
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					WHERE tahun = '{$this->tahun}') as t2
				SET t1.anggaran_per_perbup3 = t2.anggaran_per_perbup2
				WHERE t1.id = t2.id";
		$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

	public function updateTglPerbup3(){
		$tgl_perbup_3 = $this->help->ReverseTgl($this->input->post('tgl_perbup_3'));
		$this->db->trans_start();

			$que = "UPDATE ms_rekening_belanja
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					SET ms_rekening_belanja.tgl_per_perbup3 = '$tgl_perbup_3'
					WHERE ms_kegiatan.tahun = '{$this->tahun}'";
			$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Tgl Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

	public function updatePerbup4(){
		$que = "UPDATE ms_rekening_belanja as t1,
					(SELECT ms_rekening_belanja.id,anggaran_per_perbup3 FROM ms_rekening_belanja 
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					WHERE tahun = '{$this->tahun}') as t2
				SET t1.anggaran_per_perbup4 = t2.anggaran_per_perbup3
				WHERE t1.id = t2.id";
		$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

	public function updateTglPerbup4(){
		$tgl_perbup_4 = $this->help->ReverseTgl($this->input->post('tgl_perbup_4'));
		$this->db->trans_start();

			$que = "UPDATE ms_rekening_belanja
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					SET ms_rekening_belanja.tgl_per_perbup4 = '$tgl_perbup_4'
					WHERE ms_kegiatan.tahun = '{$this->tahun}'";
			$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Tgl Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

	public function updatePAK(){
		$que = "UPDATE ms_rekening_belanja as t1,
					(SELECT ms_rekening_belanja.id,anggaran_per_perbup4 FROM ms_rekening_belanja 
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					WHERE tahun = '{$this->tahun}') as t2
				SET t1.anggaran_pak = t2.anggaran_per_perbup4
				WHERE t1.id = t2.id";
		$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

	public function updateTglPAK(){
		$tgl_pak = $this->help->ReverseTgl($this->input->post('tgl_pak'));
		$this->db->trans_start();

			$que = "UPDATE ms_rekening_belanja
					INNER JOIN ms_kegiatan ON ms_kegiatan.id = ms_rekening_belanja.fk_kegiatan_id
					SET ms_rekening_belanja.tgl_pak = '$tgl_pak'
					WHERE ms_kegiatan.tahun = '{$this->tahun}'";
			$this->db->query($que);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Tgl Berhasil diupdate.');
		}

		redirect('MsRekeningBelanja');
	}

}
