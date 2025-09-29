<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rapat extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		$this->load->model('MRapat');
		$this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsRekeningBelanja');
		$this->load->model('MMsRekananCatering');
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
		// if($this->level!='1'){
		// 	die('<b>Coming Soon.. :-D</b>, <br> Silahkan dipakai untuk pelaporan SPJ pada Anggaran Tahun 2022.');
		// }
		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrBulan'] = $this->help->namaBulan();
		$this->template->load('Home/template','Rapat/list',$data);
	}

	public function getListDetail(){
		$data['bulan'] = $this->input->post('bulan');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->arrBagian();

		$this->load->view('Rapat/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

        $tahun = $this->tahun;
		$bulan = $this->input->post('bulan');
		$fk_bagian_id = $this->input->post('fk_bagian_id');
		$fk_program_id = $this->input->post('fk_program_id');
		$fk_kegiatan_id = $this->input->post('fk_kegiatan_id');

		$this->datatables->where('tahun',$tahun);
		if($bulan){
			$this->datatables->where("t_rapat.spj_bulan",$bulan);
		}
		if($fk_bagian_id){
			$this->datatables->where('t_rapat.fk_bagian_id',$fk_bagian_id);
		}
		if($fk_program_id){
			$this->datatables->where('t_rapat.fk_program_id',$fk_program_id);
		}
		if($fk_kegiatan_id){
			$this->datatables->where('t_rapat.fk_kegiatan_id',$fk_kegiatan_id);
		}

        $this->datatables->select('t_rapat.id,t_rapat.spj_bulan,t_rekap_dana.info_no_bku,hari,pukul,tempat,acara,singkatan_bagian,nama_program,kegiatan,is_spj,fk_rekap_dana_id,nama_rek_belanja,total');
        $this->datatables->select("DATE_FORMAT(tgl, '%d/%m/%Y') AS tgl", FALSE);
        $this->datatables->from("t_rapat");
        $this->datatables->join('t_rekap_dana','t_rekap_dana.id=t_rapat.fk_rekap_dana_id','left');
        $this->datatables->join('ms_rekening_belanja','ms_rekening_belanja.id=t_rapat.fk_rekening_belanja_id','inner');
        $this->db->order_by("t_rapat.tgl", "desc");
        echo $this->datatables->generate();
	}

	public function cariNamaHari(){
		$daftar_hari = array(
			 'Sunday' => 'MINGGU',
			 'Monday' => 'SENIN',
			 'Tuesday' => 'SELASA',
			 'Wednesday' => 'RABU',
			 'Thursday' => 'KAMIS',
			 'Friday' => "JUM'AT",
			 'Saturday' => 'SABTU'
		);

		$tanggal = $this->help->ReverseTgl($this->input->post('tgl'));
		$data['hari']  = $daftar_hari[date('l', strtotime($tanggal))];

		echo json_encode($data);
	}

	public function cariNpwpCatering(){
		$ctrng_id=$this->input->post('ctrng_id');
		$hsl = $this->db->query("SELECT npwp FROM ms_rekanan_catering WHERE id=$ctrng_id")->row();
		$data['npwp']  = $hsl->npwp;

		$pph23=4;
		if($hsl->npwp){
			$pph23=2;
		}
		$data['pph23Prsen']  = $pph23;

		echo json_encode($data);
	}

	protected function cariTTD(){
		$que = "SELECT s.nama,s.nip,jl.eselon eselon_lama,jl.nama_jabatan jabatan_lama,jb.eselon eselon_baru,jb.nama_jabatan jabatan_baru,s.status_jabatan,s.status_jabatan_baru FROM ms_sdm s
				LEFT JOIN ms_jabatan jl ON jl.id=s.fk_jabatan_id
				LEFT JOIN ms_jabatan jb ON jb.id=s.fk_jabatan_id_baru
				WHERE s.status=1 AND (jl.eselon IN ('2A','2B','3A','3B','4A') OR jb.eselon IN ('2A','2B','3A','3B','4A')) AND S.status_pegawai='PNS'
				ORDER BY jl.eselon,jb.eselon";
		return $this->db->query($que)->result();
	}

	public function create(){
		$Bagian=null;
		if($this->level!='1'){
			$Bagian=$this->fkBagianId;
		}
		$data = array(
			'button' => 'Simpan',
			'tahun' => set_value('tahun',$this->tahun),
			'hari' => set_value('hari'),
			'tgl' => set_value('tgl'),
			'pukul' => set_value('pukul','. . .  s/d Selesai'),
			'tempat' => set_value('tempat'),
			'acara' => set_value('acara'),
			'tgl_kwitansi' => set_value('tgl_kwitansi'),
			'fk_rekanan_catering_id' => set_value('fk_rekanan_catering_id'),
			'npwp_catering' => set_value('npwp_catering'),
			'fk_bagian_id' => set_value('fk_bagian_id',$Bagian),
			'fk_program_id' => set_value('fk_program_id'),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id'),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id'),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa'),
			'nama_pejabat_ppk' => set_value('nama_pejabat_ppk'),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa'),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk'),
			'nama_bendahara' => set_value('nama_bendahara'),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu'),
			'harga_mamin' => set_value('harga_mamin'),
			'harga_snack' => set_value('harga_snack'),
			'jml_peserta' => set_value('jml_peserta'),
			'total' => set_value('total'),
			'harga_mamin_vip' => set_value('harga_mamin_vip'),
			'harga_snack_vip' => set_value('harga_snack_vip'),
			'jml_peserta_vip' => set_value('jml_peserta_vip'),
			'total_vip' => set_value('total_vip'),
			'total_all' => set_value('total_all'),
			'pajak_daerah' => set_value('pajak_daerah'),
			'pph_23' => set_value('pph_23'),
			'nama_ttd' => set_value('nama_ttd'),
			'nip_ttd' => set_value('nip_ttd'),
			'eselon_ttd' => set_value('eselon_ttd'),
			'nama_jabatan_ttd' => set_value('nama_jabatan_ttd'),
			'id' => set_value('id'),
		);

		$data['arrMsBagian'] = $this->arrBagian();
		// $data['arrTtd'] = $this->help->ttd_atasan();
		// $data['arrPA'] = $this->help->ttd_pa();
		// $data['arrPPK'] = $this->help->ttd_ppk();
		// $data['arrKPA'] = $this->help->ttd_kpa();
		// $data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pegawai_setda'=>1));
		$data['arrMsRekanan'] = $this->MMsRekananCatering->get(array('status'=>'1'));
		// $data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		// $data['arrPPTK'] = $this->help->ttd_pptk();
		// $data['arrTTD'] = $this->cariTTD();

		$this->template->load('Home/template','Rapat/form',$data);
	}

	public function update($id){
		$hsl = $this->MRapat->get(array('id'=>$id));
		$hsl = $hsl[0];

		$data = array(
			'button' => 'Update',
			'tahun' => set_value('tahun',$hsl['tahun']),
			'hari' => set_value('hari',$hsl['hari']),
			'tgl' => set_value('tgl',$this->help->ReverseTgl($hsl['tgl'])),
			'pukul' => set_value('pukul',$hsl['pukul']),
			'tempat' => set_value('tempat',$hsl['tempat']),
			'acara' => set_value('acara',$hsl['acara']),
			'tgl_kwitansi' => set_value('tgl_kwitansi',$this->help->ReverseTgl($hsl['tgl_kwitansi'])),
			'fk_rekanan_catering_id' => set_value('fk_rekanan_catering_id',$hsl['fk_rekanan_catering_id']),
			'npwp_catering' => set_value('npwp_catering',$hsl['npwp_catering']),
			'fk_bagian_id' => set_value('fk_bagian_id',$hsl['fk_bagian_id']),
			'fk_program_id' => set_value('fk_program_id',$hsl['fk_program_id']),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id',$hsl['fk_kegiatan_id']),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id',$hsl['fk_rekening_belanja_id']),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa',$hsl['nama_pejabat_pa']),
			'nama_pejabat_ppk' => set_value('nama_pejabat_ppk',$hsl['nama_pejabat_ppk']),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa',$hsl['nama_pejabat_kpa']),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk',$hsl['nama_pejabat_pptk']),
			'nama_bendahara' => set_value('nama_bendahara',$hsl['nama_bendahara']),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu',$hsl['nama_bendahara_pembantu']),
			'harga_mamin' => set_value('harga_mamin',$hsl['harga_mamin']),
			'harga_snack' => set_value('harga_snack',$hsl['harga_snack']),
			'jml_peserta' => set_value('jml_peserta',$hsl['jml_peserta']),
			'total' => set_value('total',$hsl['total']),
			'harga_mamin_vip' => set_value('harga_mamin_vip',$hsl['harga_mamin_vip']),
			'harga_snack_vip' => set_value('harga_snack_vip',$hsl['harga_snack_vip']),
			'jml_peserta_vip' => set_value('jml_peserta_vip',$hsl['jml_peserta_vip']),
			'total_vip' => set_value('total_vip',$hsl['total_vip']),
			'total_all' => set_value('total_all',$hsl['total_all']),
			'pajak_daerah' => set_value('pajak_daerah',$hsl['pajak_daerah']),
			'pph_23' => set_value('pph_23',$hsl['pph_23']),
			'nama_ttd' => set_value('nama_ttd',$hsl['nama_ttd']),
			'nip_ttd' => set_value('nip_ttd',$hsl['nip_ttd']),
			'eselon_ttd' => set_value('eselon_ttd',$hsl['eselon_ttd']),
			'nama_jabatan_ttd' => set_value('nama_jabatan_ttd',$hsl['nama_jabatan_ttd']),
			'id' => set_value('id',$id),
			'is_spj' => set_value('is_spj',$hsl['is_spj']),
		);

		$data['arrMsBagian'] = $this->arrBagian();
		// $data['arrTtd'] = $this->help->ttd_atasan();
		// $data['arrPA'] = $this->help->ttd_pa();
		// $data['arrPPK'] = $this->help->ttd_ppk();
		// $data['arrKPA'] = $this->help->ttd_kpa();
		// $data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pegawai_setda'=>1));
		$data['arrRapatDetail'] = $this->MRapat->getDetail((array('fk_rapat_id'=>$id)));
		$data['arrMsRekanan'] = $this->MMsRekananCatering->get(array('status'=>'1'));
		// $data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		// $data['arrPPTK'] = $this->help->ttd_pptk();
		// $data['arrTTD'] = $this->cariTTD();

		$this->template->load('Home/template','Rapat/form',$data);
	}

	public function save(){		
		$id = $this->input->post('id');
		$listSdmId = $this->input->post('listSdmId');		

		$data['tahun'] = $this->input->post('tahun');

		$data['hari'] = $this->input->post('hari');
		$data['tgl'] = $this->help->ReverseTgl($this->input->post('tgl'));		
		$data['pukul'] = $this->input->post('pukul');
		$data['tempat'] = $this->input->post('tempat');
		$data['acara'] = $this->input->post('acara');
			$tglKwi = $this->input->post('tgl_kwitansi');	
		if($tglKwi){
			$tglKwi = $this->help->ReverseTgl($tglKwi);
		}else{
			$tglKwi=null;
		}
		$data['tgl_kwitansi'] = $tglKwi;

		$rekCatrng = $this->input->post('fk_rekanan_catering_id');
		if($rekCatrng){
			$data['fk_rekanan_catering_id'] = $rekCatrng;		
			$data['npwp_catering'] = $this->input->post('npwp_catering');
		}else{
			$data['fk_rekanan_catering_id'] = null;
			$data['npwp_catering'] = null;
		}		
		
			$ttd = explode('_', $this->input->post('nama_ttd'));	
		$data['nama_ttd'] =	$ttd[0];
		$data['nip_ttd'] =	$ttd[1];
		$data['eselon_ttd'] =	$ttd[2];
		$data['nama_jabatan_ttd'] =	$ttd[3];		
		$data['urut_ttd'] =	$ttd[4];		

			$bdgId=$this->input->post('fk_bagian_id');
		$data['fk_bagian_id'] = $bdgId;
			$msBdg = $this->MMsBagian->get(array('id'=>$bdgId));
		$data['singkatan_bagian'] = $msBdg[0]['singkatan_bagian'];

			$prgId=$this->input->post('fk_program_id');
		$data['fk_program_id'] = $prgId;
			$msPrg = $this->MMsProgram->get(array('id'=>$prgId));
		$data['nama_program'] = $msPrg[0]['nama_program'];

		$kegBppdId=$this->input->post('fk_kegiatan_id');
		$data['fk_kegiatan_id'] = $kegBppdId;
			$msKeg = $this->MMsKegiatan->get(array('id'=>$kegBppdId));
		$data['kegiatan'] = $msKeg[0]['kegiatan'];
		$data['singkatan_kegiatan'] = $msKeg[0]['singkatan'];
		$data['kode_kegiatan'] = $msKeg[0]['kode_kegiatan'];

		$rekBlj=$this->input->post('fk_rekening_belanja_id');
		$data['fk_rekening_belanja_id'] = $rekBlj;
			$msRek = $this->MMsRekeningBelanja->get(array('id'=>$rekBlj));
		$data['kode_rekening'] = $msRek[0]['kode_rek_belanja'];

		$pa = explode('_', $this->input->post('nama_pejabat_pa'));
		$data['nama_pejabat_pa'] = $pa[0];
		$data['nip_pejabat_pa'] = $pa[1];
		$data['jabatan_pejabat_pa'] = $pa[2];

		$ppk = explode('_', $this->input->post('nama_pejabat_ppk'));
		$data['nama_pejabat_ppk'] = $ppk[0];
		$data['nip_pejabat_ppk'] = $ppk[1];
		$data['jabatan_pejabat_ppk'] = $ppk[2];

		$kpa = explode('_', $this->input->post('nama_pejabat_kpa'));
		if($kpa[0]){
			$data['nama_pejabat_kpa'] = $kpa[0];
			$data['nip_pejabat_kpa'] = $kpa[1];
			$jbtnKPA = $kpa[2];
			// if(!empty($kpa[7]) && (strtotime($kpa[7]) <= strtotime($tglKwi))){
			// 	$jbtnKPA = $kpa[6];
			// }
			$data['jabatan_pejabat_kpa'] = $jbtnKPA;
		}else{
			$data['nama_pejabat_kpa'] = null;
			$data['nip_pejabat_kpa'] = null;
			$data['jabatan_pejabat_kpa'] = null;
		}	

		$ptk = explode('_', $this->input->post('nama_pejabat_pptk'));
		$data['nama_pejabat_pptk'] = $ptk[0];
		$data['nip_pejabat_pptk'] = $ptk[1];
		$data['jabatan_pejabat_pptk'] = $ptk[2];

		$sdmBndhra = explode('_', $this->input->post('nama_bendahara'));
		$data['nama_bendahara'] = $sdmBndhra[0];
		$data['nip_bendahara'] = $sdmBndhra[1];

		$bndPm = explode('_', $this->input->post('nama_bendahara_pembantu'));
		$data['nama_bendahara_pembantu'] = $bndPm[0];
		$data['nip_bendahara_pembantu'] = $bndPm[1];

		$data['jml_peserta'] = $this->input->post('jml_peserta');	
		$data['harga_mamin'] = str_replace(',', '', $this->input->post('harga_mamin'));
		$data['harga_snack'] = str_replace(',', '', $this->input->post('harga_snack'));
		$data['total'] = str_replace(',', '', $this->input->post('total'));

		$data['jml_peserta_vip'] = $this->input->post('jml_peserta_vip');	
		$data['harga_mamin_vip'] = str_replace(',', '', $this->input->post('harga_mamin_vip'));
		$data['harga_snack_vip'] = str_replace(',', '', $this->input->post('harga_snack_vip'));
		$data['total_vip'] = str_replace(',', '', $this->input->post('total_vip'));

		$data['total_all'] = str_replace(',', '', $this->input->post('total_all'));
		$data['pajak_daerah'] = str_replace(',', '', $this->input->post('pajak_daerah'));
		$data['pph_23'] = str_replace(',', '', $this->input->post('pph_23'));

		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		if(empty($id)){
			$this->db->trans_start(); 
				
				$this->MRapat->insert($data);				
				$rptId = $this->db->insert_id();

				$nama_sdm = $this->input->post('listNamaSdm');
				$golongan = $this->input->post('listGolongan');
				$keterangan = $this->input->post('listKeterangan');
				
				if(isset($listSdmId)){
					foreach ($listSdmId as $key => $val) {
						$dataDetail[] = array(
									'fk_rapat_id'=>$rptId,
									'fk_sdm_id'=>$val,
									'nama_sdm'=>$nama_sdm[$key],
									'golongan'=>$golongan[$key],
									'keterangan'=>$keterangan[$key],
								);
					}
					$this->db->insert_batch('t_rapat_detail', $dataDetail);
				}

			$this->db->trans_complete();			
			if ($this->db->trans_status() === FALSE) {
			    $this->db->trans_rollback();
			    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
			} 
			else {
			    $this->db->trans_commit();
				$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
			}

		}else{
			$this->db->trans_start(); 

				$this->MRapat->update($id,$data);		

				$nama_sdm = $this->input->post('listNamaSdm');
				$golongan = $this->input->post('listGolongan');
				$keterangan = $this->input->post('listKeterangan');
				
				if(isset($listSdmId)){
					foreach ($listSdmId as $key => $val) {
						$dataDetail[] = array(
									'fk_rapat_id'=>$id,
									'fk_sdm_id'=>$val,
									'nama_sdm'=>$nama_sdm[$key],
									'golongan'=>$golongan[$key],
									'keterangan'=>$keterangan[$key],
								);
					}
					$this->db->insert_batch('t_rapat_detail', $dataDetail);
				}

			$this->db->trans_complete();			
			if ($this->db->trans_status() === FALSE) {
			    $this->db->trans_rollback();
			    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
			} 
			else {
			    $this->db->trans_commit();
				$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
			}

		}
        redirect('Rapat');
	}

	public function cekCariNama(){
		$id_sdm = $this->input->post('id_sdm');
		$tglIndo =$this->input->post('tgl');
		$tgl = $this->help->ReverseTgl($tglIndo);

		$que = "SELECT p.id,kategori,nama_bagian,bulan,kegiatan,tgl_sp_berangkat FROM t_pjd p INNER JOIN t_pjd_detail pd ON pd.fk_pjd_id=p.id WHERE pd.fk_sdm_id=$id_sdm AND (tgl_berangkat='$tgl' OR tgl_tiba='$tgl' OR tgl_tengah_1='$tgl' OR tgl_tengah_2='$tgl' OR tgl_tengah_3='$tgl')";
		$cekDL= $this->db->query($que)->row();

		$hslCek=''; $ktgri=''; $hslCekRpt=''; $rptLbh3Kli='';
		if(isset($cekDL)){
			if($cekDL->kategori=='DL'){
				$bln = !empty($cekDL->bulan)?$this->help->namaBulan($cekDL->bulan):'';
				$hslCek='Sudah ada kegiatan Perjalanan Dinas '.$cekDL->kategori.' '.$cekDL->nama_bagian.', '.$bln.', Sub Kegiatan '.$cekDL->kegiatan.', Jam Berangkat '.$cekDL->tgl_sp_berangkat.' (Error ID pjd_detail : '.$cekDL->id.')';
				$ktgri = 'DL';
			}
			if($cekDL->kategori=='DD'){	
				$bln = !empty($cekDL->bulan)?$this->help->namaBulan($cekDL->bulan):'';
				$hslCek='Sudah ada kegiatan Perjalanan Dinas '.$cekDL->kategori.' '.$cekDL->nama_bagian.', '.$bln.', Sub Kegiatan '.$cekDL->kegiatan.' (Error ID pjd_detail : '.$cekDL->id.')';
				$ktgri = 'DD';
			}
		}else{
			$celLmbr = "SELECT td.id,spj_bulan,singkatan_bagian,kegiatan FROM t_entri_lembur_detail td INNER JOIN t_entri_lembur t ON t.id=td.fk_entri_lembur_id WHERE fk_sdm_id=$id_sdm AND tgl='$tgl'";
			$cekLmbr= $this->db->query($celLmbr)->row();
			if(isset($cekLmbr)){
				$hslCek='Sudah ada kegiatan Lembur '.$cekLmbr->singkatan_bagian.', Bulan '.$this->help->namaBulan($cekLmbr->spj_bulan).', Sub Kegiatan '.$cekLmbr->kegiatan.' (Error ID lembur_detail : '.$cekLmbr->id.')';
				$ktgri = 'Lembur';

			}
		}
		//cek rapat
		$qweRpt = "SELECT count(td.id) jml FROM t_rapat_detail td INNER JOIN t_rapat t ON t.id=td.fk_rapat_id WHERE fk_sdm_id=$id_sdm AND tgl='$tgl'";
		$cekRapat= $this->db->query($qweRpt)->row();
		
		if($cekRapat->jml >= 3){
			$hslCekRpt ="Pada tgl $tglIndo ini Sudah melaksanakan rapat sejumlah = $cekRapat->jml Kali";
			$rptLbh3Kli = 'iya';
		}
			
		$data['kategori'] = $ktgri;
		$data['hslCek'] = $hslCek;

		$data['rptLbh3Kli'] = $rptLbh3Kli;
		$data['hslCekRpt'] = $hslCekRpt;

		echo json_encode($data);

	}

	public function cariNama(){
		$id_sdm = $this->input->post('id_sdm');
		$tgl = $this->help->ReverseTgl($this->input->post('tgl'));

		$que = "SELECT id,nama,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru FROM ms_sdm WHERE id=$id_sdm";
		$hsl = $this->db->query($que)->row();
		
		$data['nama'] = $hsl->nama;

		$pngkt = $hsl->gol_pangkat;
		if(!empty($hsl->tmt_gol_pangkat_baru) && (strtotime($hsl->tmt_gol_pangkat_baru) <= strtotime($tgl)) ){
			$pngkt = $hsl->gol_pangkat_baru;
		}
		$gol='-';
		if($pngkt!='-' && !empty($pngkt)){
			$ck = explode('(', $pngkt);
			$ck22 = explode(')', $ck[1]);	
			$gol=$ck22[0];	
		}
		$data['golongan'] = $gol;

		echo json_encode($data);
	}

	public function delete($id){   
		$this->db->trans_start();  
			$this->MRapat->deleteAllDetail($id);
			$result = $this->MRapat->delete($id);
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

        redirect('Rapat');
	}

	public function detail($id){
		$hsl = $this->MRapat->get(array('id'=>$id));
		$data['hsl'] = $hsl[0];

		$hsl = $this->MMsRekananCatering->get(array('id'=>$hsl[0]['fk_rekanan_catering_id']));
		$data['catering'] = $hsl[0];
		
		$data['detail'] = $this->MRapat->getDetail((array('fk_rapat_id'=>$id)));

		$this->template->load('Home/template','Rapat/viewDetail',$data);
	}

	public function deleteDetail($fkLmbrId, $id){
		$result = $this->MRapat->deleteDetail($id);
		if($result){
        	$this->session->set_flashdata('success', 'Detail Rapat berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Detail Rapat gagal dihapus.');
        }
        redirect('Rapat/update/'.$fkLmbrId);
	}

	public function updateRekap(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->arrBagian();
		$data['url'] = base_url().'Rapat/proses_update_rekap';
		$data['tabel']='t_rapat';
		$data['judul']='Rapat';
		
		$this->template->load('Home/template','KwitansiHR/form_rekap',$data);
	}

	public function proses_update_rekap(){
		$tahun=$this->tahun;
		$bulan=$this->input->post('bulan');
		$fk_bagian_id=$this->input->post('fk_bagian_id');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$fk_rekening_belanja_id=$this->input->post('fk_rekening_belanja_id');
		$no_bku=$this->input->post('no_bku');
		$datapilih=$this->input->post('dataPilih');
		$plh = array();
		$no=1;
		foreach ((array)$datapilih as $key => $value) {
			$plh[] = $key;
			$plh2 .= $key;
			if(count($datapilih)!=$no){
				$plh2 .= ",";
			}
			$no++;
		}
		if(!$plh){
			$this->session->set_flashdata('warning', 'Silahkan Pilih / Centang data terlebih dahulu.');
			redirect('Rapat/updateRekap');
		}

		$driTabel = 't_rapat';
		$qwe = "SELECT id FROM $driTabel WHERE id in ($plh2) ORDER BY tgl_kwitansi";
		$dtl = $this->db->query($qwe)->result();

		$noBaru = '1';
		$this->db->trans_start();		
			$jml_dana=str_replace(',', '', $this->input->post('jml_dana'));
			$pengajuan_sebelum=str_replace(',', '', $this->input->post('pengajuan_sebelum'));
			$pengajuan_sekarang=str_replace(',', '', $this->input->post('pengajuan_sekarang'));
			$sisa_kas=str_replace(',', '', $this->input->post('sisa_kas'));
			$tot_pajak_rapat_sblm=$this->input->post('tot_pajak_rapat_sblm');			
			$user_act = $this->session->id;
			$time_act = date('Y-m-d H:i:s');
			$que = "insert into t_rekap_dana (dari_tabel,spj_bulan,fk_bagian_id,fk_kegiatan_id,fk_rekening_belanja_id,info_no_bku,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,pajak_rapat,user_act,time_act)
				values('$driTabel','$bulan',$fk_bagian_id,$fk_kegiatan_id,$fk_rekening_belanja_id,'$no_bku',$jml_dana,$pengajuan_sebelum,$pengajuan_sekarang,$sisa_kas,$tot_pajak_rapat_sblm,$user_act,'$time_act')";
			$this->db->query($que);
			$idRekap = $this->db->insert_id();

			foreach ($dtl as $val) {
				$data2[] =  array(
			      'id' => $val->id,
			      'spj_bulan' => $bulan,
			      'is_spj' => '1',
			      'no_bku' => $no_bku,
			      'no_kwitansi_rekap' => $noBaru,
			      'fk_rekap_dana_id' => $idRekap,
			   	);
				$noBaru = $noBaru+1;
			}
			$this->db->update_batch("$driTabel", $data2, 'id');
 
			$this->session->set_flashdata('success', 'Buat Rekap berhasil.');

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
		}	
		
		redirect('Rapat');
	}

	public function deleteRekap(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->arrBagian();
		$data['url'] = base_url().'Rapat/proses_delete_rekap';
		$data['tabel']='t_rapat';
		$data['judul']='Rapat';
		
		$this->template->load('Home/template','KwitansiHR/form_rekap_delete',$data);
	}

	public function proses_delete_rekap(){
		$id_rekap_dana=$this->input->post('id_rekap_dana');
		$cek=$this->db->query("SELECT status_pengajuan_dana FROM t_rekap_dana WHERE id=$id_rekap_dana")->row();
		if($cek->status_pengajuan_dana==1){
			$this->session->set_flashdata('error', 'Data sudah dilakukan Pengajuan Dana.');
			redirect('Rapat');
		}
		
		$this->db->trans_start();

		    $data = array(
			        'spj_bulan' => NULL,
			        'is_spj' => '0',
			        'no_bku' => NULL,
			        'no_kwitansi_rekap' => NULL,
			        'fk_rekap_dana_id' => NULL,
			);
			$this->db->where('fk_rekap_dana_id', $id_rekap_dana);
			$this->db->update('t_rapat', $data);

			$this->db->delete('t_rekap_dana', array('id' => $id_rekap_dana));
		   	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal dihapus.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil dihapus.');
		}

		redirect('Rapat');
	}

	public function cetakDH(){
		$id = $this->input->post('id_rapat');
		$hsl = $this->MRapat->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}
		$data['bag'] = $this->db->query("SELECT nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$tg = explode('-', $hsl[0]['tgl']);
		$data['tanggal'] = $tg[2].' '.$this->help->namaBulan($tg[1]).' '.$tg[0];

		$data['tampilkan_acara'] = $this->input->post('tampilkan_acara');
		$data['tampilkan_hny_hari'] = $this->input->post('tampilkan_hny_hari');

		$data['header'] = $this->help->headerLaporan();

		$html=$this->load->view('Rapat/cetakDaftarHadir',$data,true);
		$title = 'Cetak Daftar Hadir';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function cetakRekap(){		
		$id_rekap_dana=$this->input->post('id_rekap_dana');

		$data['tgl_rekap']=$this->input->post('tgl_rekap');
		$que = "SELECT rd.id,k.id id_kwi_hr,k.no_bku,k.spj_bulan,CONCAT(k.singkatan_bagian,'.',k.singkatan_kegiatan) singkat_keg,tahun,kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_pa,nip_pejabat_pa ,nama_pejabat_kpa,nip_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_rapat FROM t_rekap_dana rd INNER JOIN t_rapat k ON k.fk_rekap_dana_id=rd.id INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id WHERE rd.id=$id_rekap_dana ORDER BY k.id desc"; 
		$hsl = $this->db->query($que)->row();
		$data['hasil'] = $hsl;

		$qweDtl = "SELECT tgl_kwitansi,no_bku,no_kwitansi_rekap,acara untuk_pembayaran,total banyaknya_uang,pajak_daerah,pph_23,harga_mamin,harga_snack FROM t_rapat WHERE fk_rekap_dana_id=$id_rekap_dana ORDER BY no_kwitansi_rekap";
		$data['detail'] = $this->db->query($qweDtl)->result();

		$html=$this->load->view('Rapat/cetakRekap',$data,true);
		$title = 'Rapat';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	public function cetakSU($id){

		$hsl = $this->MRapat->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}
		$bag = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();
		$data['kelAss'] = $bag;

		$data['header'] = $this->help->headerBagian($bag->nama_bagian);

		$html=$this->load->view('Rapat/cetakSU',$data,true);
		$title = 'Surat Undangan';
		
		// echo $html;
		$this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function cetak_sspd(){
		$id = $this->input->post('id_rapat');
		$data['tgl_cetak'] = $this->input->post('tgl_cetak');
		
		$hsl = $this->MRapat->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$rknn = $this->MMsRekananCatering->get(array('id'=>$hsl[0]['fk_rekanan_catering_id']));
		$data['rekanan'] = $rknn[0];

		$data['kategori'] = 'rapat';		

		$data['pajakDaerah'] = $hsl[0]['pajak_daerah'];

		$html=$this->load->view('Lembur/cetakSSPD',$data,true);
		$title = 'Cetak SSPD';
		
		// echo $html;
		$this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function cetak_sspd_rekap(){
		$data['tgl_cetak']=$this->input->get('tgl_sspd');
		$id_rekap_dana=$this->input->get('id_rekap_dana');

		$hsl = $this->db->query("SELECT tahun,kegiatan,nama_bendahara,nip_bendahara,fk_rekanan_catering_id,sum(pajak_daerah) totPjkDaerah FROM t_rapat WHERE fk_rekap_dana_id=$id_rekap_dana")->result_array();
		$hasil1 = $hsl[0];

		$data['pajakDaerah'] = $hsl[0]['totPjkDaerah'];

		$criPem="SELECT DISTINCT nama_bendahara_pembantu, nip_bendahara_pembantu FROM t_rapat WHERE	fk_rekap_dana_id = $id_rekap_dana ORDER BY id DESC";
		$hslPem=$this->db->query($criPem)->result_array();
		$hasil2 = $hslPem[0];
		
		$data['hasil'] = array_merge($hasil1,$hasil2);

		$rekananId = $hsl[0]['fk_rekanan_catering_id'];
		$rknn = $this->MMsRekananCatering->get(array('id'=>$rekananId));
		$data['rekanan'] = $rknn[0];


		$data['kategori'] = 'rapat';

		$html=$this->load->view('Lembur/cetakSSPD',$data,true);
		$title = 'Cetak SSPD';
		
		// echo $html;
		$this->pdf($title,$html,$this->help->folio_P(),true);

	}

	public function cetakKwi($id){
		// $id = $this->input->get('id');
		$hsl = $this->MRapat->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$rknn = $this->MMsRekananCatering->get(array('id'=>$hsl[0]['fk_rekanan_catering_id']));
		$data['rekanan'] = $rknn[0];

		$html=$this->load->view('Rapat/cetakKwitansi',$data,true);
		$title = 'Kwitansi Rapat';
		
		echo $html;
		// $this->pdf($title,$html,'A5-L');
	}

	public function lapRapat($id){
		// $id = $this->input->get('id');

		$hsl = $this->MRapat->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$html=$this->load->view('Rapat/cetakLapRapat',$data,true);
		$title = 'Lap. Rapat';
	// echo $html;die();	
		// $this->pdf($title,$html,$this->help->folio_P(),true);
		$this->msword($title,$html);
	}

	public function cetakSP($id){
		$hsl = $this->MRapat->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$rkn = $this->MMsRekananCatering->get(array('id'=>$hsl[0]['fk_rekanan_catering_id']));
		$data['rekananCatering'] = $rkn[0];

		$dtl = $this->MRapat->getDetail(array('fk_rapat_id'=>$id));
		$data['detail'] = $dtl;

		$data['header'] = $this->help->headerLaporan();

		$html=$this->load->view('Rapat/cetakSuratPesanan',$data,true);
		$title = 'Surat Pesanan';

		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function cetakBahp($id){
		$hsl = $this->MRapat->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$dtl = $this->MRapat->getDetail(array('fk_rapat_id'=>$id));
		$data['detail'] = $dtl;

		$data['header'] = $this->help->headerLaporan();
			 
		$tglKwi = $hsl[0]['tgl_kwitansi'];
		$data['kepPPK'] = $this->db->query("SELECT nomor,tgl_awal FROM ms_ppk WHERE (tgl_awal <= '$tglKwi' AND tgl_akhir >= '$tglKwi')")->row();

		$html=$this->load->view('Rapat/cetakBAHP',$data,true);			

		$title = 'BAHP';

		echo $html;
		die();

		$this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function cetakBast($id){
		$hsl = $this->MRapat->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$dtl = $this->MRapat->getDetail(array('fk_rapat_id'=>$id));
		$data['detail'] = $dtl;
		
		$rkn = $this->MMsRekananCatering->get(array('id'=>$hsl[0]['fk_rekanan_catering_id']));
		$data['rekanan'] = $rkn[0];

		$tglKwi = $hsl[0]['tgl_kwitansi'];
		$data['kepPPK'] = $this->db->query("SELECT nomor,tgl_awal FROM ms_ppk WHERE (tgl_awal <= '$tglKwi' AND tgl_akhir >= '$tglKwi')")->row();

		$data['header'] = $this->help->headerLaporan();

		$html=$this->load->view('Rapat/cetakBast',$data,true);

		$title = 'BAST';

		echo $html;
		die();

		$this->pdf($title,$html,$this->help->folio_P());
	}

	// public function cetakKesanggupan($id){
	// 	$hsl = $this->MKwitansi->get(array('id'=>$id));
	// 	$data['hasil'] = $hsl[0];

	// 	$dtl = $this->MKwitansi->getDetail(array('fk_kwitansi_id'=>$id));
	// 	$data['detail'] = $dtl;

	// 	$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
	// 	$data['rekanan'] = $rkn[0];

	// 	$html=$this->load->view('Kwitansi/cetakKesanggupan',$data,true);
	// 	$title = 'KesanggupanKerja';

	// 	// echo $html;
	// 	// die();
		
	// 	$this->msword($title,$html);
	// }

	// public function cetakKesepakatanHarga($id){
	// 	$hsl = $this->MKwitansi->get(array('id'=>$id));
	// 	$data['hasil'] = $hsl[0];

	// 	$dtl = $this->MKwitansi->getDetail(array('fk_kwitansi_id'=>$id));
	// 	$data['detail'] = $dtl;

	// 	$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
	// 	$data['rekanan'] = $rkn[0];

	// 	$data['header'] = $this->help->headerLaporan();

	// 	$html=$this->load->view('Kwitansi/cetakKesepakatanHarga',$data,true);
	// 	$title = 'KesepakatanHarga';

	// 	echo $html;
	// 	die();

	// 	$this->pdf($title,$html,$this->help->folio_P());
	// }
	
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

    protected function msword($title,$html){
        header("Content-type: application/vnd.ms-word");
        header("Expires: 0");
        header("Content-Disposition: attachment; filename=$title.doc");
        header("Pragma: no-cache");
        echo $html;
    }

}
