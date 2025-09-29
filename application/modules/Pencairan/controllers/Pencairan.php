<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencairan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		// $this->load->model('MRapat');
		// $this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		// $this->load->model('MMsProgram');
		// $this->load->model('MMsKegiatan');
		$this->load->model('MPencairanDana');
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
		$data['arrBulan'] = $this->help->namaBulan();
		$this->template->load('Home/template','Pencairan/list',$data);
	}

	public function getListDetail(){
		$data['bulan'] = $this->input->post('bulan');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->arrBagian();

		$this->load->view('Pencairan/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

        $tahun = $this->tahun;
		$bulan = $this->input->post('bulan');
		$fk_bagian_id = $this->input->post('fk_bagian_id');
		$fk_program_id = $this->input->post('fk_program_id');
		$fk_kegiatan_id = $this->input->post('fk_kegiatan_id');

		$this->datatables->where('tahun',$tahun);		
		if($fk_bagian_id){
			$this->datatables->where('fk_bagian_id',$fk_bagian_id);
		}

        $this->datatables->select('id,singkatan_bagian,jenis_anggaran,status_update_tbp');
        $this->datatables->select("DATE_FORMAT(tgl_pencairan, '%d/%m/%Y') AS tgl_pencairan", FALSE);
        $this->datatables->from("t_pencairan_dana");
        $this->db->order_by("t_pencairan_dana.tgl_pencairan", "desc");
        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa'),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk'),
			'nama_pejabat_pptk2' => set_value('nama_pejabat_pptk2'),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu'),
		);

		$data['arrBagian'] = $this->arrBagian();

			$fkBag = null;
			if($this->level!='1'){
				$fkBag = $this->fkBagianId;
			}
		$data['arrKPA'] = $this->help->ttd_kpa($fkBag);
		$data['arrPPTK'] = $this->help->ttd_pptk();
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['url'] = base_url().'Pencairan/proses_update_pencairan';
		
		$this->template->load('Home/template','Pencairan/form',$data);
	}

	public function get_dataUpdatePencairan(){
		$tahun=$this->tahun;
 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$tgl_pencairan=$this->help->ReverseTgl($this->input->post('tgl_pencairan'));
 		
		$queB = "SELECT id,tabelnya,kategori_rekap,nama_bulan,tgl_rekap,singkatan_bagian,kegiatan,nama_rek_belanja,jml_dana_idr,pengajuan_sebelum_idr,pengajuan_sekarang_idr,sisa_kas_idr FROM v_pjd_dan_rekap_dana
 				WHERE tahun='$tahun' AND tgl_rekap='$tgl_pencairan' AND status_pencairan=0 AND fk_bagian_id='$fk_bagian_id' 
 				ORDER BY tgl_rekap ASC";
 		
 		$data['hasil'] = $this->db->query($queB)->result_array();
 		$data['updateRkp']=true;
		$this->load->view('Pencairan/gridDataUpdatePencairan',$data);
	}

	public function proses_update_pencairan(){
		$data['tahun']=$this->tahun;
		$data['jenis_anggaran']=$this->input->post('jenis_anggaran');
		$data['tgl_pencairan']=$this->help->ReverseTgl($this->input->post('tgl_pencairan'));
			$fk_bagian_id=$this->input->post('fk_bagian_id');
		$data['fk_bagian_id']=$fk_bagian_id;
			$msBdg = $this->MMsBagian->get(array('id'=>$fk_bagian_id));
		$data['singkatan_bagian'] = $msBdg[0]['singkatan_bagian'];
		$datapilih=$this->input->post('dataPilih');
		$tabelnya=$this->input->post('tabelnya'); 
		$plh = array();
		$plhRkp = array();
		$plhPjd = array();
		$no=1;
		foreach ((array)$datapilih as $key => $value) {
			$plh[] = $key;
			if($tabelnya[$key]=='rekap_dana'){
				$plhRkp[]= $key;		
			}else{
				$plhPjd[]= $key;
			}			
		}

		if(!$plh){
			$this->session->set_flashdata('warning', 'Silahkan Pilih / Centang data terlebih dahulu.');
			redirect('Pencairan/create');
		}

		$kpa = explode('_', $this->input->post('nama_pejabat_kpa'));
		$data['nama_pejabat_kpa'] = $kpa[0];
		$data['nip_pejabat_kpa'] = $kpa[1];
		$data['jabatan_pejabat_kpa'] = $kpa[2];

		$ptk = explode('_', $this->input->post('nama_pejabat_pptk'));
		$data['nama_pejabat_pptk'] = $ptk[0];
		$data['nip_pejabat_pptk'] = $ptk[1];
		$data['jabatan_pejabat_pptk'] = $ptk[2];

		$pptk2 = $this->input->post('nama_pejabat_pptk2');
		if($pptk2){
			$ptk2 = explode('_', $pptk2);
			$data['nama_pejabat_pptk2'] = $ptk2[0];
			$data['nip_pejabat_pptk2'] = $ptk2[1];
			$data['jabatan_pejabat_pptk2'] = $ptk2[2];
		}

		$sdmBndhraPem = explode('_', $this->input->post('nama_bendahara_pembantu'));
		$data['nama_bendahara_pembantu'] = $sdmBndhraPem[0];
		$data['nip_bendahara_pembantu'] = $sdmBndhraPem[1];
	
		$this->db->trans_start();	
			$data['user_act'] = $this->session->id;
			$data['time_act'] = date('Y-m-d H:i:s');

			$this->MPencairanDana->insert($data);				
			$idRekap = $this->db->insert_id();

			if($plhRkp){
				foreach ($plhRkp as $val) {
					$dataRekapDana[] =  array(
					      'id' => $val,
					      'fk_pencairan_dana_id' => $idRekap,
					      'status_pencairan' => '1',
					   	);					
				}
				$this->db->update_batch("t_rekap_dana", $dataRekapDana, 'id');
			}

			if($plhPjd){
				foreach ($plhPjd as $val) {
					$dataPjdDana[] =  array(
					      'id' => $val,
					      'fk_pencairan_dana_id' => $idRekap,
					      'status_pencairan' => '1',
					   	);					
				}
				$this->db->update_batch("t_pjd_dana", $dataPjdDana, 'id');
			}
 
			$this->session->set_flashdata('success', 'Buat Rekap berhasil.');
			
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
		}	
		
		redirect('Pencairan');
	}

	public function updateTBP($id){
		$data['detail'] = $this->db->query("SELECT * FROM v_pjd_dan_rekap_dana WHERE fk_pencairan_dana_id=$id")->result();
		$data['hasil'] = $this->db->query("SELECT * FROM t_pencairan_dana WHERE id=$id")->row();
		$data['url'] = base_url().'Pencairan/proses_update_tbp';

		$this->template->load('Home/template','Pencairan/gridDataUpdateTBP',$data);
	}

	public function proses_update_tbp(){
		$id_pencairan = $this->input->post('id_pencairan');
		$listId = $this->input->post('listId');
		$listTabelnya = $this->input->post('listTabelnya');

		$this->db->trans_start();	
			$data['status_update_tbp']='1';
			$this->MPencairanDana->update($id_pencairan,$data);			
				$dataRekapDana='';
				$dataPjdDana='';
				foreach ($listTabelnya as $key => $val) {
					if($val=='rekap_dana'){
						$dataRekapDana[] =  array(
						      'id' => $key,
						      'info_no_bku' => $listId[$key],
					   	);	
					}
					if($val=='pjd_dana'){
						$dataPjdDana[] =  array(
						      'id' => $key,
						      'info_no_bku' => $listId[$key],
					   	);	
					}
									
				}
				if($dataRekapDana){
					$this->db->update_batch("t_rekap_dana", $dataRekapDana, 'id');					
				}
				if($dataPjdDana){
					$this->db->update_batch("t_pjd_dana", $dataPjdDana, 'id');					
				}
			
 
			$this->session->set_flashdata('success', 'Update TBP berhasil.');
			
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
		}	

		redirect('Pencairan');
	}

	public function deleteTBP($id){
		$data['status_update_tbp']='0';
		$this->db->trans_start();
			$this->MPencairanDana->update($id,$data);

			$dataHapusTBP[] =  array(
			      'fk_pencairan_dana_id' => $id,
			      'info_no_bku' => '. . . . .',
		   	);

			$this->db->update_batch("t_rekap_dana", $dataHapusTBP, 'fk_pencairan_dana_id');	
			$this->db->update_batch("t_pjd_dana", $dataHapusTBP, 'fk_pencairan_dana_id');

		$this->session->set_flashdata('success', 'Hapus TBP berhasil.');
			
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
		}	

		redirect('Pencairan');	
	}

	public function delete($id){
		$cek = $this->db->query("SELECT tabelnya FROM v_pjd_dan_rekap_dana WHERE fk_pencairan_dana_id=$id GROUP BY tabelnya")->result();

		$this->db->trans_start();
			foreach ($cek as $val) {
				if($val->tabelnya=='pjd_dana'){				
			    	$data = array(
				        'fk_pencairan_dana_id' => NULL,
						'status_pencairan' => '0',
					);
					$this->db->where('fk_pencairan_dana_id', $id);
					$this->db->update("t_pjd_dana", $data);
				}
				if($val->tabelnya=='rekap_dana'){
					$data = array(
				        'fk_pencairan_dana_id' => NULL,
						'status_pencairan' => '0',
					);
					$this->db->where('fk_pencairan_dana_id', $id);
					$this->db->update("t_rekap_dana", $data);
				}			    
			}

			$this->db->delete("t_pencairan_dana", array('id' => $id));
		   	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal dihapus.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil dihapus.');
		}

		redirect('Pencairan');
	}

	public function cetakSPP($id){
		$cri = $this->db->query("SELECT * FROM t_pencairan_dana WHERE id=$id")->row();
		$Bagian = $cri->fk_bagian_id;
		$tglPncairan = $cri->tgl_pencairan;
		$data['hasil']=$cri;
		$data['jenis_anggaran']=$cri->jenis_anggaran;

		$andBagian=" AND kb.fk_bagian_id=$Bagian";
		$queBid="SELECT nama_bagian FROM ms_bagian WHERE id=$Bagian";
		$data['hslBid'] = $this->db->query($queBid)->row();
		
		$joinQuery = "INNER JOIN ms_kegiatan kb ON kb.id=rb.fk_kegiatan_id
					 INNER JOIN ms_program p ON p.id=kb.fk_program_id
					 INNER JOIN ms_program_utama pu ON pu.id=p.fk_program_utama_id
					 WHERE kb.tahun=$this->tahun $andBagian";

		//-----------------------------------

		$queProg = " SELECT pu.id id_prog,pu.kode kode_prog, program_utama, sum(anggaran)tot_anggaran_prog,sum(anggaran_per_perbup1)tot_angg_perbup1_prog,sum(anggaran_per_perbup2)tot_angg_perbup2_prog,sum(anggaran_per_perbup3)tot_angg_perbup3_prog,sum(anggaran_per_perbup4)tot_angg_perbup4_prog,sum(anggaran_pak)tot_anggaran_pak_prog  
					FROM ms_rekening_belanja rb
					$joinQuery
					GROUP BY pu.id
					ORDER BY pu.kode";
		$data['hslProg'] = $this->db->query($queProg)->result();
		//------------------------------------------------------//

		$queKeg = " SELECT pu.id id_prog,p.id id_keg,CONCAT(pu.kode,'.',kode_program)kode_keg, nama_program, sum(anggaran)tot_anggaran_keg,sum(anggaran_per_perbup1)tot_angg_perbup1_keg,sum(anggaran_per_perbup2)tot_angg_perbup2_keg,sum(anggaran_per_perbup3)tot_angg_perbup3_keg,sum(anggaran_per_perbup4)tot_angg_perbup4_keg,sum(anggaran_pak)tot_anggaran_pak_keg  
					FROM ms_rekening_belanja rb
					$joinQuery
					GROUP BY p.id
					ORDER BY pu.kode,kode_program";
		$hslKeg = $this->db->query($queKeg)->result();
		$arrKeg=array();
		foreach ($hslKeg as $valKeg) {
			$arrKeg[$valKeg->id_prog][]=$valKeg;
		}
		$data['arrKeg']=$arrKeg;
		//------------------------------------------------------//

		$queSubKeg = " SELECT p.id id_keg,kb.id id_sub_keg, CONCAT(pu.kode,'.',kode_program,'.',kode_kegiatan)kode_sub_keg, kegiatan, sum(anggaran)tot_anggaran_sub_keg,sum(anggaran_per_perbup1)tot_angg_perbup1_sub_keg,sum(anggaran_per_perbup2)tot_angg_perbup2_sub_keg,sum(anggaran_per_perbup3)tot_angg_perbup3_sub_keg,sum(anggaran_per_perbup4)tot_angg_perbup4_sub_keg,sum(anggaran_pak)tot_anggaran_pak_sub_keg
					FROM ms_rekening_belanja rb
					$joinQuery
					GROUP BY kb.id
					ORDER BY pu.kode,kode_program,kode_kegiatan";
		$hslSubKeg = $this->db->query($queSubKeg)->result();
		$arrSubKeg=array();
		foreach ($hslSubKeg as $valSub) {
			$arrSubKeg[$valSub->id_keg][]=$valSub;
		}
		$data['arrSubKeg']=$arrSubKeg;
		//------------------------------------------------------//

		$queRekBlj = " SELECT rb.id id_rek,p.id id_keg,kb.id id_sub_keg,rb.id id_rek_blj,kode_rek_belanja, nama_rek_belanja, anggaran,anggaran_per_perbup1,anggaran_per_perbup2,anggaran_per_perbup3,anggaran_per_perbup4,anggaran_pak
					FROM ms_rekening_belanja rb
					$joinQuery
					GROUP BY rb.id
					ORDER BY kode_rek_belanja";
		$hslRekBlj = $this->db->query($queRekBlj)->result();
		$arrRekBlj=array();
		foreach ($hslRekBlj as $valRek) {
			$arrRekBlj[$valRek->id_sub_keg][]=$valRek;
		}
		$data['arrRekBlj']=$arrRekBlj;
		//------------------------------------------------------//

		$joinQueryDana = "INNER JOIN ms_kegiatan kb ON kb.id = pd.fk_kegiatan_id
					 INNER JOIN ms_program p ON p.id=kb.fk_program_id
					 INNER JOIN ms_program_utama pu ON pu.id=p.fk_program_utama_id
					 INNER JOIN t_pencairan_dana tp ON tp.id=pd.fk_pencairan_dana_id
					 WHERE kb.tahun=$this->tahun AND status_pencairan=1 $andBagian";

		//---------Program Bulan Lalu-----------//
		$joinLalu = " AND (tgl_pencairan < '$tglPncairan')";
		$quelaluPjd = "SELECT
						pu.id id_prog,p.id id_keg,kb.id id_sub_keg,pd.fk_rekening_belanja_id,sum(pengajuan_sekarang) pengajuan_sekarang_pd
					FROM
						t_pjd_dana pd
						$joinQueryDana $joinLalu";
		$data['hslLaluAwlPjd'] = $this->db->query($quelaluPjd)->row();

		$groupPU=" GROUP BY pu.id";
		$hslLaluPjd = $this->db->query($quelaluPjd.$groupPU)->result();
		$arrLaluPjd=array();
		foreach ($hslLaluPjd as $valLuPjd) {
			$arrLaluPjd[$valLuPjd->id_prog]=$valLuPjd->pengajuan_sekarang_pd;
		}
		$data['arrLaluPjd']=$arrLaluPjd;

		$quelaluRkp = "SELECT
						pu.id id_prog,p.id id_keg,kb.id id_sub_keg,pd.fk_rekening_belanja_id,sum(pengajuan_sekarang) pengajuan_sekarang_rd
					FROM
						t_rekap_dana pd
						$joinQueryDana $joinLalu";
		$data['hslLaluAwlRkp'] = $this->db->query($quelaluRkp)->row();

		$hslLaluRkp = $this->db->query($quelaluRkp.$groupPU)->result();
		$arrLaluRkp=array();
		foreach ($hslLaluRkp as $valLuRkp) {
			$arrLaluRkp[$valLuRkp->id_prog]=$valLuRkp->pengajuan_sekarang_rd;
		}
		$data['arrLaluRkp']=$arrLaluRkp;

		// ---------------kegiatan bulan lalu-----------//
		$groupKeg=" GROUP BY p.id";
		$hslLaluPjdKeg = $this->db->query($quelaluPjd.$groupKeg)->result();
		$arrLaluPjdKeg=array();
		foreach ($hslLaluPjdKeg as $valLuPjdKeg) {
			$arrLaluPjdKeg[$valLuPjdKeg->id_keg]=$valLuPjdKeg->pengajuan_sekarang_pd;
		}
		$data['arrLaluPjdKeg']=$arrLaluPjdKeg;

		$hslLaluRkpKeg = $this->db->query($quelaluRkp.$groupKeg)->result();
		$arrLaluRkpKeg=array();
		foreach ($hslLaluRkpKeg as $valLuRkpKeg) {
			$arrLaluRkpKeg[$valLuRkpKeg->id_keg]=$valLuRkpKeg->pengajuan_sekarang_rd;
		}
		$data['arrLaluRkpKeg']=$arrLaluRkpKeg;

		// ---------------Sub kegiatan bulan lalu-----------//
		$groupSubKeg=" GROUP BY kb.id";
		$hslLaluPjdSubKeg = $this->db->query($quelaluPjd.$groupSubKeg)->result();
		$arrLaluPjdSubKeg=array();
		foreach ($hslLaluPjdSubKeg as $valLuPjdSubKeg) {
			$arrLaluPjdSubKeg[$valLuPjdSubKeg->id_sub_keg]=$valLuPjdSubKeg->pengajuan_sekarang_pd;
		}
		$data['arrLaluPjdSubKeg']=$arrLaluPjdSubKeg;

		$hslLaluRkpSubKeg = $this->db->query($quelaluRkp.$groupSubKeg)->result();
		$arrLaluRkpSubKeg=array();
		foreach ($hslLaluRkpSubKeg as $valLuRkpSubKeg) {
			$arrLaluRkpSubKeg[$valLuRkpSubKeg->id_sub_keg]=$valLuRkpSubKeg->pengajuan_sekarang_rd;
		}
		$data['arrLaluRkpSubKeg']=$arrLaluRkpSubKeg;

		// ---------------Rekening Belanja bulan lalu-----------//
		$groupPjdRekBlj=" GROUP BY pd.fk_rekening_belanja_id";
		$hslLaluPjdRekBlj = $this->db->query($quelaluPjd.$groupPjdRekBlj)->result();
		$arrLaluPjdRekBlj=array();
		foreach ($hslLaluPjdRekBlj as $valLuPjdRekBlj) {
			$arrLaluPjdRekBlj[$valLuPjdRekBlj->fk_rekening_belanja_id]=$valLuPjdRekBlj->pengajuan_sekarang_pd;
		}
		$data['arrLaluPjdRekBlj']=$arrLaluPjdRekBlj;

		$hslLaluRkpRekBlj = $this->db->query($quelaluRkp.$groupPjdRekBlj)->result();
		$arrLaluRkpRekBlj=array();
		foreach ($hslLaluRkpRekBlj as $valLuRkpRekBlj) {
			$arrLaluRkpRekBlj[$valLuRkpRekBlj->fk_rekening_belanja_id]=$valLuRkpRekBlj->pengajuan_sekarang_rd;
		}
		$data['arrLaluRkpRekBlj']=$arrLaluRkpRekBlj;

		//---------Program Bulan INI-------//
		$joinSkrg = " AND (tgl_pencairan = '$tglPncairan')";
		$queSkrgPjd = "SELECT
						pu.id id_prog,p.id id_keg,kb.id id_sub_keg,pd.fk_rekening_belanja_id,sum(pengajuan_sekarang) pengajuan_sekarang_pd
					FROM
						t_pjd_dana pd
						$joinQueryDana $joinSkrg";
		$data['hslSkrgAwlPjd'] = $this->db->query($queSkrgPjd)->row();

		$hslSkrgPjd = $this->db->query($queSkrgPjd.$groupPU)->result();
		$arrSkrgPjd=array();
		foreach ($hslSkrgPjd as $valSkgPjd) {
			$arrSkrgPjd[$valSkgPjd->id_prog]=$valSkgPjd->pengajuan_sekarang_pd;
		}
		$data['arrSkrgPjd']=$arrSkrgPjd;

		$queSkrgRkp = "SELECT
						pu.id id_prog,p.id id_keg,kb.id id_sub_keg,pd.fk_rekening_belanja_id,sum(pengajuan_sekarang) pengajuan_sekarang_rd
					FROM
						t_rekap_dana pd
						$joinQueryDana $joinSkrg";
		$data['hslSkrgAwlRkp'] = $this->db->query($queSkrgRkp)->row();
		
		$hslSkrgRkp = $this->db->query($queSkrgRkp.$groupPU)->result();
		$arrSkrgRkp=array();
		foreach ($hslSkrgRkp as $valSkgRkp) {
			$arrSkrgRkp[$valSkgRkp->id_prog]=$valSkgRkp->pengajuan_sekarang_rd;
		}
		$data['arrSkrgRkp']=$arrSkrgRkp;

		// ---------------kegiatan bulan ini-----------//
		$hslSkrgPjdKeg = $this->db->query($queSkrgPjd.$groupKeg)->result();
		$arrSkrgPjdKeg=array();
		foreach ($hslSkrgPjdKeg as $valSkgPjdKeg) {
			$arrSkrgPjdKeg[$valSkgPjdKeg->id_keg]=$valSkgPjdKeg->pengajuan_sekarang_pd;
		}
		$data['arrSkrgPjdKeg']=$arrSkrgPjdKeg;

		$hslSkrgRkpKeg = $this->db->query($queSkrgRkp.$groupKeg)->result();
		$arrSkrgRkpKeg=array();
		foreach ($hslSkrgRkpKeg as $valSkgRkpKeg) {
			$arrSkrgRkpKeg[$valSkgRkpKeg->id_keg]=$valSkgRkpKeg->pengajuan_sekarang_rd;
		}
		$data['arrSkrgRkpKeg']=$arrSkrgRkpKeg;

		// ---------------Sub kegiatan bulan ini-----------//
		$hslSkrgPjdSubKeg = $this->db->query($queSkrgPjd.$groupSubKeg)->result();
		$arrSkrgPjdSubKeg=array();
		foreach ($hslSkrgPjdSubKeg as $valSkgPjdSubKeg) {
			$arrSkrgPjdSubKeg[$valSkgPjdSubKeg->id_sub_keg]=$valSkgPjdSubKeg->pengajuan_sekarang_pd;
		}
		$data['arrSkrgPjdSubKeg']=$arrSkrgPjdSubKeg;

		$hslSkrgRkpSubKeg = $this->db->query($queSkrgRkp.$groupSubKeg)->result();
		$arrSkrgRkpSubKeg=array();
		foreach ($hslSkrgRkpSubKeg as $valSkgRkpSubKeg) {
			$arrSkrgRkpSubKeg[$valSkgRkpSubKeg->id_sub_keg]=$valSkgRkpSubKeg->pengajuan_sekarang_rd;
		}
		$data['arrSkrgRkpSubKeg']=$arrSkrgRkpSubKeg;

		// ---------------Rekening Belanja bulan ini-----------//
		$hslSkrgPjdRekBlj = $this->db->query($queSkrgPjd.$groupPjdRekBlj)->result();
		$arrSkrgPjdRekBlj=array();
		foreach ($hslSkrgPjdRekBlj as $valSkrgPjdRekBlj) {
			$arrSkrgPjdRekBlj[$valSkrgPjdRekBlj->fk_rekening_belanja_id]=$valSkrgPjdRekBlj->pengajuan_sekarang_pd;
		}
		$data['arrSkrgPjdRekBlj']=$arrSkrgPjdRekBlj;

		$hslSkrgRkpRekBlj = $this->db->query($queSkrgRkp.$groupPjdRekBlj)->result();
		$arrSkrgRkpRekBlj=array();
		foreach ($hslSkrgRkpRekBlj as $valSkrgRkpRekBlj) {
			$arrSkrgRkpRekBlj[$valSkrgRkpRekBlj->fk_rekening_belanja_id]=$valSkrgRkpRekBlj->pengajuan_sekarang_rd;
		}
		$data['arrSkrgRkpRekBlj']=$arrSkrgRkpRekBlj;

		//-----------------------------------------//

		$html=$this->load->view('Pencairan/pdfSPP',$data,true);
		$title = 'SPP_'.date('d-m-Y');

		echo $html;die();
		$this->pdf($title,$html,$this->help->folio_L());
	}

	protected function queryPjd($id){
		$que = "SELECT rb.kode_rek_belanja,rb.nama_rek_belanja,td.total_akhir,nama_rekening,nama_bank,no_rekening,npwp,t.kategori,kb.singkatan 
				FROM t_pjd_dana dn 
				INNER JOIN ms_rekening_belanja rb ON rb.id=dn.fk_rekening_belanja_id
				INNER JOIN t_pjd t ON t.fk_pjd_dana_id=dn.id
				INNER JOIN t_pjd_detail td ON t.id=td.fk_pjd_id
				INNER JOIN ms_sdm dm ON dm.id=td.fk_sdm_id
				INNER JOIN ms_kegiatan kb ON kb.id=t.fk_kegiatan_id
				WHERE fk_pencairan_dana_id=$id
				ORDER BY t.tgl_berangkat ASC";		
		return $this->db->query($que)->result();
	}

	protected function queryHr($id){
		$queHr = "SELECT t.id,rb.kode_rek_belanja,rb.nama_rek_belanja,nama_rekening,nama_bank,no_rekening,npwp,td.nama nama_narsum,no_rekening_narsum,nama_bank_narsum,npwp_narsum,t.kategori,kb.singkatan,((sub_total_bruto*jml_kali)+bpjs_kes_pemkab+bpjs_krj_jkk+bpjs_krj_jkm) total_bruto,ROUND(((sub_total_bruto * jml_kali)*pajak_persen)/100) pajak21 ,bpjs_kes_pemkab,bpjs_kes_peserta,bpjs_krj_jkk,bpjs_krj_jkm,jml_diterima,
			(CASE t.kategori WHEN 'KONTRAK' THEN 'Gaji' ELSE 'Honorarium' END) kategori
				FROM t_rekap_dana dn 
				INNER JOIN ms_rekening_belanja rb ON rb.id=dn.fk_rekening_belanja_id
				INNER JOIN t_kwitansi_hr t ON t.fk_rekap_dana_id=dn.id
				INNER JOIN t_kwitansi_hr_detail td ON t.id=td.fk_kwitansi_hr_id
				LEFT JOIN ms_sdm dm ON dm.id=td.fk_sdm_id
				INNER JOIN ms_kegiatan kb ON kb.id=t.fk_kegiatan_id
				WHERE fk_pencairan_dana_id=$id
				ORDER BY t.tgl_kwitansi ASC";
		return $this->db->query($queHr)->result();
	}

	protected function queryLmbr($id){
		$queLmbr = "SELECT t.id,rb.kode_rek_belanja,rb.nama_rek_belanja, pengajuan_sekarang,pjk_daerah_skrg,pph23_skrg,rc.nama_pemilik,rc.nama_bank,rc.no_rekening,rc.npwp,t.singkatan_kegiatan
				FROM t_rekap_dana dn 
				INNER JOIN ms_rekening_belanja rb ON rb.id=dn.fk_rekening_belanja_id
				INNER JOIN t_entri_lembur t ON t.fk_rekap_dana_id=dn.id
				INNER JOIN ms_rekanan_catering rc On rc.id=t.fk_rekanan_catering_id
				WHERE fk_pencairan_dana_id=$id
				GROUP BY dn.id
				ORDER BY dn.tgl_rekap,dn.id ASC";
		return $this->db->query($queLmbr)->result();
	}

	protected function queryRapat($id){
		$queRpt = "SELECT t.id,rb.kode_rek_belanja,rb.nama_rek_belanja, sum(t.total_all) total, sum(t.pph_23) tot_pph23, sum(t.pajak_daerah) tot_pajak_daerah, rc.nama_pemilik,rc.nama_bank,rc.no_rekening,rc.npwp,t.singkatan_kegiatan
				FROM t_rekap_dana dn 
				INNER JOIN ms_rekening_belanja rb ON rb.id=dn.fk_rekening_belanja_id
				INNER JOIN t_rapat t ON t.fk_rekap_dana_id=dn.id
				INNER JOIN ms_rekanan_catering rc On rc.id=t.fk_rekanan_catering_id
				WHERE fk_pencairan_dana_id=$id
				GROUP BY dn.fk_rekening_belanja_id,rc.id
				ORDER BY dn.tgl_rekap,dn.id ASC";
		return $this->db->query($queRpt)->result();
	}

	protected function queryAtk($id){
		$queAtk = "SELECT t.id,rb.kode_rek_belanja,rb.nama_rek_belanja, pengajuan_sekarang,ppn_skrg,pph22_skrg,pph23_skrg,ra.nama_pimpinan,ra.nama_bank,ra.no_rekening,ra.npwp,kb.singkatan
				FROM t_rekap_dana dn 
				INNER JOIN ms_rekening_belanja rb ON rb.id=dn.fk_rekening_belanja_id
				INNER JOIN pb_pesanan_barang t ON t.fk_rekap_dana_id=dn.id
				INNER JOIN pb_ms_rekanan ra On ra.id=t.fk_rekanan_id
				INNER JOIN ms_kegiatan kb ON kb.id=t.fk_kegiatan_id
				WHERE fk_pencairan_dana_id=$id
				GROUP BY dn.id
				ORDER BY dn.tgl_rekap,dn.id ASC";
		return $this->db->query($queAtk)->result();
	}

	protected function queryBrglainnya($id){
		$queBrglainnya = "SELECT t.id,rb.kode_rek_belanja,rb.nama_rek_belanja,t.banyaknya_uang,t.ppn,t.pph_22,mr.atas_nama_rekening,mr.nama_bank,mr.no_rekening,mr.npwp,t.singkatan_kegiatan
				FROM t_rekap_dana dn 
				INNER JOIN ms_rekening_belanja rb ON rb.id=dn.fk_rekening_belanja_id
				INNER JOIN t_kwitansi t ON t.fk_rekap_dana_id=dn.id
				LEFT JOIN pb_ms_rekanan mr On mr.id=t.fk_rekanan_id
				WHERE fk_pencairan_dana_id=$id AND dn.kategori_rekap='Barang_Lainnya'
				ORDER BY dn.tgl_rekap,dn.id ASC";
		return $this->db->query($queBrglainnya)->result();
	}

	protected function queryJasaLainnya($id){
		$queJasaLainnya = "SELECT t.id,rb.kode_rek_belanja,rb.nama_rek_belanja,t.banyaknya_uang,t.ppn,t.pph_23,mr.atas_nama_rekening,mr.nama_bank,mr.no_rekening,mr.npwp,t.singkatan_kegiatan
				FROM t_rekap_dana dn 
				INNER JOIN ms_rekening_belanja rb ON rb.id=dn.fk_rekening_belanja_id
				INNER JOIN t_kwitansi t ON t.fk_rekap_dana_id=dn.id
				LEFT JOIN pb_ms_rekanan mr On mr.id=t.fk_rekanan_id
				WHERE fk_pencairan_dana_id=$id AND dn.kategori_rekap='Jasa_Lainnya'
				ORDER BY dn.tgl_rekap,dn.id ASC";
		return $this->db->query($queJasaLainnya)->result();
	}

	protected function querySwakelola($id){
		$queSwa = "SELECT t.id,rb.kode_rek_belanja,rb.nama_rek_belanja,t.banyaknya_uang,t.ppn,t.pph_23,mr.atas_nama_rekening,mr.nama_bank,mr.no_rekening,mr.npwp,t.singkatan_kegiatan
				FROM t_rekap_dana dn 
				INNER JOIN ms_rekening_belanja rb ON rb.id=dn.fk_rekening_belanja_id
				INNER JOIN t_kwitansi t ON t.fk_rekap_dana_id=dn.id
				LEFT JOIN pb_ms_rekanan mr On mr.id=t.fk_rekanan_id
				WHERE fk_pencairan_dana_id=$id AND dn.kategori_rekap='Swakelola'
				ORDER BY dn.tgl_rekap,dn.id ASC";
		return $this->db->query($queSwa)->result();
	}


	public function cetakTNT($id){
		$cri = $this->db->query("SELECT * FROM t_pencairan_dana WHERE id=$id")->row();
		$Bagian = $cri->fk_bagian_id;
		$tglPncairan = $cri->tgl_pencairan;
		$data['hasil']=$cri;
		$data['Bagian']=$this->MMsBagian->get(array('id'=>$Bagian));
// echo "<pre>";
// print_r($this->queryRapat($id));
// echo "</pre>";die();
		$data['dataPjd'] = $this->queryPjd($id);
		$data['dataHr'] = $this->queryHr($id);
		$data['dataLmbr'] = $this->queryLmbr($id);
		$data['dataRpt'] = $this->queryRapat($id);
		$data['dataAtk'] = $this->queryAtk($id);
		$data['dataBrglainnya'] = $this->queryBrglainnya($id);
		$data['dataJasaLainnya'] = $this->queryJasaLainnya($id);
		$data['dataSwa'] = $this->querySwakelola($id);
		$data['isExcel'] = false;

		$html=$this->load->view('Pencairan/pdfTNT',$data,true);
		$title = 'TNT_'.date('d-m-Y');

		echo $html;die();
		$this->pdf($title,$html,$this->help->folio_L());
	}

	public function cetakTNTExcel($id){		
		$cri = $this->db->query("SELECT * FROM t_pencairan_dana WHERE id=$id")->row();
		$Bagian = $cri->fk_bagian_id;
		$tglPncairan = $cri->tgl_pencairan;
		$data['hasil']=$cri;
		$data['Bagian']=$this->MMsBagian->get(array('id'=>$Bagian));

		$data['dataPjd'] = $this->queryPjd($id);
		$data['dataHr'] = $this->queryHr($id);
		$data['dataLmbr'] = $this->queryLmbr($id);
		$data['dataRpt'] = $this->queryRapat($id);
		$data['dataAtk'] = $this->queryAtk($id);
		$data['dataBrglainnya'] = $this->queryBrglainnya($id);
		$data['dataJasaLainnya'] = $this->queryJasaLainnya($id);
		$data['dataSwa'] = $this->querySwakelola($id);
		$data['isExcel'] = true;

		$html=$this->load->view('Pencairan/pdfTNT',$data,true);
		$title = 'TNT_'.date('d-m-Y');

		$this->excel($title,$html);
	}
	
	protected function pdf($title,$html,$page,$batas=false){
		// echo $html;
		if($batas){
			$mpdf = new mPDF('utf-8', $page);
		}else{
        	$mpdf = new mPDF('utf-8', $page, 0, '', 8, 8, 4, 5, 5, 5);
        }
        $mpdf->AddPage();
        // $mpdf->SetFooter('{PAGENO}/{nbpg}');
        $mpdf->WriteHTML($html);
        $mpdf->Output($title.'.pdf','I');
    }

    protected function excel($title,$html,$ext='xls'){
        header("Content-type: application/x-msdownload");
        header("Content-Disposition: attachment; filename=$title.$ext");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $html;
    }

}
