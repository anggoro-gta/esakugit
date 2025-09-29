<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EntriGu extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MEntriGu');
		$this->load->model('MMsBagian');
		$this->load->model('MMsKegiatan');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$this->template->load('Home/template','EntriGu/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

        $this->datatables->select('t_entri_gu.id,t_entri_gu.nama,nama_bulan,status_spj,count(t_entri_gu_detail.id) jml_kegiatan');
        $this->datatables->from("t_entri_gu");
        $this->datatables->join('t_entri_gu_detail','t_entri_gu_detail.fk_entri_gu_id=t_entri_gu.id','inner');
        $this->datatables->join('ms_bulan','ms_bulan.kode=t_entri_gu.bulan','inner');
        $this->datatables->where('t_entri_gu.tahun',$this->tahun);
        $this->datatables->group_by('fk_entri_gu_id');
        $this->db->order_by('bulan','desc');
        $this->db->order_by('t_entri_gu.nama','asc');

        echo $this->datatables->generate();
	}

	public function getKegiatan(){
 		$Bagian=$_POST['Bagian'];
 		$keg = $this->MMsKegiatan->get(array('fk_bagian_id'=>$Bagian,'tahun'=>$this->tahun));

 		$data['kegiatan'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$keg as $val) {
 			$data['kegiatan'] .= "<option value=\"".$val['id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

	public function create(){	
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->MMsBagian->get();

		$this->template->load('Home/template','EntriGu/form',$data);
	}

	public function cariNama(){
		$Bagian = $this->input->post('Bagian');
		$kegiatan = $this->input->post('kegiatan');

		$nma = $this->MMsBagian->get(array('id'=>$Bagian));
		$kg = $this->MMsKegiatan->get(array('id'=>$kegiatan));

		$data['namaBagian'] = $nma[0]['nama_bagian'];
		$data['namakegBappeda'] = $kg[0]['kegiatan'];
		echo json_encode($data);
	}

	public function save(){			
		$listBagian = $this->input->post('listBagian');
		if(!isset($listBagian)){
			$this->session->set_flashdata('error', 'Detail Kegiatan tidak boleh kosong.');
			redirect('EntriGu/create');
		}
		
		$data['bulan'] = $this->input->post('bulan');
		$data['nama'] = $this->input->post('nama_gu');
		$data['tahun'] = $this->tahun;		
		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		$this->db->trans_start(); 

			$this->MEntriGu->insert($data);				
			$guId = $this->db->insert_id();

			$namaBagian = $this->input->post('listNamaBagian');
			$kegiatanBapppeda = $this->input->post('listKegiatanBapppeda');
			$namaKegiatanBapppeda = $this->input->post('listNamaKegiatanBapppeda');
			$jml = $this->input->post('listJml');
			
			foreach ($listBagian as $key => $val) {

				$dataDetail[] = array(
							'fk_entri_gu_id'=>$guId,
							'fk_bagian_id'=>$val,
							'nama_bagian'=>$namaBagian[$key],
							'fk_kegiatan_id'=>$kegiatanBapppeda[$key],
							'nama_kegiatan_bappeda'=>$namaKegiatanBapppeda[$key],
							'jumlah'=>$this->help->MoneyToDouble($jml[$key]),
						);
			}
			$this->db->insert_batch('t_entri_gu_detail', $dataDetail);

		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		}
        redirect('EntriGu');
	}

	public function updateNama(){
		$id = $this->input->post('id');
		$data['nama'] = $this->input->post('nama_gu');

		$this->MEntriGu->update($id,$data);
		$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		redirect('EntriGu');
	}

	public function delete($id){   
		$this->db->trans_start();  
			$this->MEntriGu->deleteAllDetail($id);
			$result = $this->MEntriGu->delete($id);
			if($result){
	        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
	        }else{
	        	$this->session->set_flashdata('error', 'Data gagal dihapus.');
	        }
	    $this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
		}

        redirect('EntriGu');
	}

	public function detail($id){
		$gu= $this->MEntriGu->get(array('id'=>$id));
		$data['entriGu'] = $gu[0];
		
		$dtl = $this->MEntriGu->getDetail((array('fk_entri_gu_id'=>$id)));
		$data['detail'] = $dtl;

		$this->template->load('Home/template','EntriGu/viewDetail',$data);
	}

	public function edit($id){
		$gu= $this->MEntriGu->get(array('id'=>$id));
		$data['entriGu'] = $gu[0];
		
		$dtl = $this->MEntriGu->getDetail((array('fk_entri_gu_id'=>$id)));
		$data['detail'] = $dtl;

		$data['arrMsBagian'] = $this->MMsBagian->get();

		$this->template->load('Home/template','EntriGu/edit',$data);
	}

	public function deleteDetail($idGu, $id, $fkKegId){
		$cek = $this->db->query("SELECT fk_gu_id FROM t_pjd_dana WHERE fk_gu_id=$idGu AND fk_kegiatan_id=$fkKegId")->row();
		if(!isset($cek)){
			$result = $this->MEntriGu->deleteDetail($id);
			if($result){
	        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
	        }else{
	        	$this->session->set_flashdata('error', 'Data Detail gagal dihapus.');
	        }
	    }else{
	    	$this->session->set_flashdata('error', 'Data gagal dihapus. hanya bisa diupdate');
	    }
        redirect('EntriGu/edit/'.$idGu);
	}

	public function getCariDataDetail(){
		$id=$this->input->post('id');
		$hsl = $this->db->query("SELECT nama_kegiatan_bappeda,FORMAT(jumlah,0) jumlah FROM t_entri_gu_detail WHERE id=$id")->row();
		$data['nama_keg'] = $hsl->nama_kegiatan_bappeda;
		$data['jumlah'] = $hsl->jumlah;
		echo json_encode($data);
	}

	public function updateDetail(){
		$id=$this->input->post('detail_id');
		$fk_gu_id=$this->input->post('detail_fk_gu_id');
		$data['jumlah']=str_replace(',', '',$this->input->post('detail_jumlah'));

		$this->MEntriGu->updateDetail($id,$data);

		$this->session->set_flashdata('success', 'Data berhasil diupdate.');
		redirect('EntriGu/edit/'.$fk_gu_id);
	}

	public function update(){
		$listBagian = $this->input->post('listBagian');
		if(!isset($listBagian)){
			$this->session->set_flashdata('error', 'Detail Kegiatan tidak boleh kosong.');
			redirect('EntriGu/create');
		}

		$this->db->trans_start(); 

			$guId = $this->input->post('fk_entri_gu_id');
			$namaBagian = $this->input->post('listNamaBagian');
			$kegiatanBapppeda = $this->input->post('listKegiatanBapppeda');
			$namaKegiatanBapppeda = $this->input->post('listNamaKegiatanBapppeda');
			$jml = $this->input->post('listJml');
			
			foreach ($listBagian as $key => $val) {

				$dataDetail[] = array(
							'fk_entri_gu_id'=>$guId,
							'fk_bagian_id'=>$val,
							'nama_bagian'=>$namaBagian[$key],
							'fk_kegiatan_id'=>$kegiatanBapppeda[$key],
							'nama_kegiatan_bappeda'=>$namaKegiatanBapppeda[$key],
							'jumlah'=>$this->help->MoneyToDouble($jml[$key]),
						);
			}
			$this->db->insert_batch('t_entri_gu_detail', $dataDetail);

		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal diupdate.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}

        redirect('EntriGu');
	}

}
