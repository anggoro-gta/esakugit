<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembur extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		$this->load->model('MLembur');
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
		if($this->level!='1'){
			$Bagian =array('id'=>$this->fkBagianId);
		}
		return $this->MMsBagian->get($Bagian);
	}

	public function index(){
		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrBulan'] = $this->help->namaBulan();
		$this->template->load('Home/template','Lembur/list',$data);
	}

	public function getListDetail(){
		$data['bulan'] = $this->input->post('bulan');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->arrBagian();

		$this->load->view('Lembur/listDetail',$data);
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
			$this->datatables->where('spj_bulan',$bulan);
		}
		if($fk_bagian_id){
			$this->datatables->where('t_entri_lembur.fk_bagian_id',$fk_bagian_id);
		}
		if($fk_program_id){
			$this->datatables->where('fk_program_id',$fk_program_id);
		}
		if($fk_kegiatan_id){
			$this->datatables->where('t_entri_lembur.fk_kegiatan_id',$fk_kegiatan_id);
		}

        $this->datatables->select('t_entri_lembur.id,t_entri_lembur.spj_bulan,t_rekap_dana.info_no_bku,perihal,singkatan_bagian,nama_program,kegiatan,is_spj,fk_rekap_dana_id');
        $this->datatables->select("DATE_FORMAT(tgl_surat_tugas, '%d/%m/%Y') AS tgl_surat_tugas", FALSE);
        $this->datatables->select("DATE_FORMAT(tgl_kegiatan_dari, '%d/%m/%Y') AS tgl_kegiatan_dari", FALSE);
        $this->datatables->select("DATE_FORMAT(tgl_kegiatan_sampai, '%d/%m/%Y') AS tgl_kegiatan_sampai", FALSE);
        $this->datatables->from("t_entri_lembur");
        $this->datatables->join('t_rekap_dana','t_rekap_dana.id=t_entri_lembur.fk_rekap_dana_id','left');
        $this->db->order_by("t_entri_lembur.tgl_surat_tugas", "desc");
        echo $this->datatables->generate();
	}

	// protected function ttd_pengusul(){
	// 	$que = "SELECT s.id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,jabatan,j.urut_ttd,jabatan_baru,tmt_jabatan_baru 
	// 			FROM ms_sdm s
	// 			JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
	// 			LEFT JOIN ms_jabatan jb ON jb.id = s.fk_jabatan_id_baru 
	// 			WHERE s.`status` = 1 AND pegawai_setda=1 AND j.eselon IN ('3A', '3B','4A') OR jb.eselon IN ('3A', '3B','4A','6') OR (j.eselon='4A' AND SUBSTR(jabatan,1,3)='Plt') OR (jb.eselon='6' AND SUBSTR(jabatan_baru,1,3)='Plt')
	// 			ORDER BY urut_ttd";
	// 	return $this->db->query($que)->result();	
	// }

	public function getTarifLembur(){
		$id_sdm = $this->input->post('id_sdm');
		$tgl_surat_tugas = $this->input->post('tgl_surat_tugas');

		$que = "SELECT id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,status_jabatan,jabatan,status_jabatan_baru,jabatan_baru,tmt_jabatan_baru,status_pegawai FROM ms_sdm WHERE id=$id_sdm";
		$hsl = $this->db->query($que)->row();
		
		$data['nama'] = $hsl->nama;
		$data['nip'] = $hsl->nip;
		$pngkt = $hsl->gol_pangkat;
		if(!empty($hsl->tmt_gol_pangkat_baru) && (strtotime($hsl->tmt_gol_pangkat_baru) <= strtotime($tgl_surat_tugas)) ){
			$pngkt = $hsl->gol_pangkat_baru;
		}

		$whreGol = 'NON ASN';
		$gol='-';
		if($hsl->status_pegawai=='PNS'){
			if($pngkt!='-' && !empty($pngkt)){
				$ck = explode('(', $pngkt);
				$ck22 = explode(')', $ck[1]);	
				$gol=$ck22[0];	

				$ck33 = explode('/', $ck[1]);
				$whreGol = $ck33[0];
			}
		}
		if($hsl->status_pegawai=='PPPK'){
			$whreGol = $pngkt;
		}
		$kat = $hsl->status_pegawai;
		if(preg_match("/Golongan 3/",$hsl->gol_pangkat)){
			$whreGol = 'III';
			$kat = 'PNS';
		}

		$que2 = "SELECT tarif,pot_pph,uang_makan FROM ms_tarif_lembur WHERE golongan='$whreGol' AND kategori='$kat'";
		$hsl2 = $this->db->query($que2)->row();
		$data['golongan'] = $gol;

		$jbtn = $hsl->status_jabatan.' '.$hsl->jabatan;
		if(!empty($hsl->tmt_jabatan_baru) && (strtotime($hsl->tmt_jabatan_baru) <= strtotime($tgl_surat_tugas)) ){
			$jbtn = $hsl->status_jabatan_baru.' '.$hsl->jabatan_baru;
		}

		$trfLmbr = $hsl2->tarif;
		$uangMkn = $hsl2->uang_makan;

		$data['jabatan'] = $jbtn;
		$data['tarif'] = $trfLmbr;
		$data['tarifNominal'] = number_format($trfLmbr);
		$data['uang_makan'] = $uangMkn;
		$data['uangMknNominal'] = number_format($uangMkn);
		$data['pph21'] = $hsl2->pot_pph;
		$data['status_pegawai'] = $hsl->status_pegawai;

		echo json_encode($data);
	}

 // 	public function cariNama(){
	// 	$id_sdm = $this->input->post('id_sdm');
	// 	$tgl_surat_tugas = $this->input->post('tgl_surat_tugas');
	// 	$isLibr = $this->input->post('isLibr');
	// 	$jam = $this->input->post('jam');

	// 	$que = "SELECT id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,jabatan,jabatan_baru,tmt_jabatan_baru,status_pegawai FROM ms_sdm WHERE id=$id_sdm";
	// 	$hsl = $this->db->query($que)->row();
		
	// 	$data['nama'] = $hsl->nama;
	// 	$data['nip'] = $hsl->nip;
	// 	$pngkt = $hsl->gol_pangkat;
	// 	if(!empty($hsl->tmt_gol_pangkat_baru) && (strtotime($hsl->tmt_gol_pangkat_baru) <= strtotime($tgl_surat_tugas)) ){
	// 		$pngkt = $hsl->gol_pangkat_baru;
	// 	}

	// 	$whreGol = 'NON ASN';
	// 	$gol='-';
	// 	if($pngkt!='-' && !empty($pngkt)){
	// 		$ck = explode('(', $pngkt);
	// 		$ck22 = explode(')', $ck[1]);	
	// 		$gol=$ck22[0];	

	// 		$ck33 = explode('/', $ck[1]);
	// 		$whreGol = $ck33[0];
	// 	}

	// 	$que2 = "SELECT tarif,pot_pph,uang_makan FROM ms_tarif_lembur WHERE golongan='$whreGol'";
	// 	$hsl2 = $this->db->query($que2)->row();
	// 	$data['golongan'] = $gol;

	// 	$jbtn = $hsl->jabatan;
	// 	if(!empty($hsl->tmt_jabatan_baru) && (strtotime($hsl->tmt_jabatan_baru) <= strtotime($tgl_surat_tugas)) ){
	// 		$jbtn = $hsl->jabatan_baru;
	// 	}

	// 	$trfLmbr = $hsl2->tarif;
	// 	$uangMkn = $hsl2->uang_makan;
	// 	// $trfLmbr = NULL;
	// 	$jmlMkn = 0;
	// 	// if($isLibr=='Ya'){
	// 	// 	$trfLmbr = $hsl2->tarif*2;
	// 	// 	$jmlMkn = 1;
	// 	// 	if($jam >= 5){
	// 	// 		// $uangMkn = $hsl2->uang_makan*2;
	// 	// 		$jmlMkn = 2;
	// 	// 	}
	// 	// }else{
	// 		if($jam >= 2){
	// 			$jmlMkn = 1;
	// 		}
	// 	// }
	// 	$data['jabatan'] = $jbtn;
	// 	$data['tarif'] = $trfLmbr;
	// 	$data['tarifNominal'] = number_format($trfLmbr);
	// 	$data['uang_makan'] = $uangMkn;
	// 	$data['jml_makan'] = $jmlMkn;
	// 	$data['pph21'] = $hsl2->pot_pph;
	// 	$data['status_pegawai'] = $hsl->status_pegawai;

	// 	echo json_encode($data);
	// }

	public function create(){
		$Bagian=null;
		if($this->level!='1'){
			$Bagian=$this->fkBagianId;
		}
		$data = array(
			'button' => 'Simpan',
			'tahun' => set_value('tahun',$this->tahun),
			'tgl_surat_tugas' => set_value('tgl_surat_tugas'),
			'latar_belakang' => set_value('latar_belakang'),
			'perihal' => set_value('perihal'),
			'tgl_kegiatan_dari' => set_value('tgl_kegiatan_dari'),
			'tgl_kegiatan_sampai' => set_value('tgl_kegiatan_sampai'),
			'tgl_kwitansi' => set_value('tgl_kwitansi'),
			'fk_bagian_id' => set_value('fk_bagian_id',$Bagian),
			'fk_program_id' => set_value('fk_program_id'),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id'),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id'),
			'nama_penandatangan_st' => set_value('nama_penandatangan_st'),
			'nama_pengusul' => set_value('nama_pengusul'),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa',$hsl['nama_pejabat_pa']),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa'),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk'),
			'nama_bendahara' => set_value('nama_bendahara'),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu'),
			'fk_rekanan_catering_id' => set_value('fk_rekanan_catering_id'),
			'is_spj' => set_value('is_spj'),
			'pph_23_persen' => set_value('pph_23_persen'),
			'id' => set_value('id'),
		);

		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrTtd'] = $this->help->ttd_atasan();
		// $data['arrTtdPengusul'] = $this->ttd_pengusul();
		$data['arrPA'] = $this->help->ttd_pa();
		$data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pegawai_setda'=>1));
		$data['arrMsRekanan'] = $this->MMsRekananCatering->get(array('status'=>'1'));
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['arrPPTK'] = $this->help->ttd_pptk();

		$this->template->load('Home/template','Lembur/form',$data);
	}

	public function update($id){
		$hsl = $this->MLembur->get(array('id'=>$id));
		$hsl = $hsl[0];

		$fkBagian=$hsl['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data = array(
			'button' => 'Update',
			'tahun' => set_value('tahun',$hsl['tahun']),
			'tgl_surat_tugas' => set_value('tgl_surat_tugas',$this->help->ReverseTgl($hsl['tgl_surat_tugas'])),
			'latar_belakang' => set_value('latar_belakang',$hsl['latar_belakang']),
			'perihal' => set_value('perihal',$hsl['perihal']),
			'tgl_kegiatan_dari' => set_value('tgl_kegiatan_dari',$this->help->ReverseTgl($hsl['tgl_kegiatan_dari'])),
			'tgl_kegiatan_sampai' => set_value('tgl_kegiatan_sampai',$this->help->ReverseTgl($hsl['tgl_kegiatan_sampai'])),
			'tgl_kwitansi' => set_value('tgl_kwitansi',$this->help->ReverseTgl($hsl['tgl_kwitansi'])),
			'fk_bagian_id' => set_value('fk_bagian_id',$hsl['fk_bagian_id']),
			'fk_program_id' => set_value('fk_program_id',$hsl['fk_program_id']),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id',$hsl['fk_kegiatan_id']),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id',$hsl['fk_rekening_belanja_id']),
			'nama_penandatangan_st' => set_value('nama_penandatangan_st',$hsl['nama_penandatangan_st']),
			'nama_pengusul' => set_value('nama_pengusul',$hsl['nama_pengusul']),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa',$hsl['nama_pejabat_pa']),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa',$hsl['nama_pejabat_kpa']),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk',$hsl['nama_pejabat_pptk']),
			'nama_bendahara' => set_value('nama_bendahara',$hsl['nama_bendahara']),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu',$hsl['nama_bendahara_pembantu']),
			'fk_rekanan_catering_id' => set_value('fk_rekanan_catering_id',$hsl['fk_rekanan_catering_id']),
			'is_spj' => set_value('is_spj',$hsl['is_spj']),
			'pph_23_persen' => set_value('pph_23_persen',$hsl['pph_23_persen']),
			'id' => set_value('id',$id),
		);

		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrTtd'] = $this->help->ttd_atasan();
		// $data['arrTtdPengusul'] = $this->ttd_pengusul();
		$data['arrPA'] = $this->help->ttd_pa();
		$data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pegawai_setda'=>1));
		$data['arrLemburDetail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id)));
		$data['arrMsRekanan'] = $this->MMsRekananCatering->get(array('status'=>'1'));
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['arrPPTK'] = $this->help->ttd_pptk();

		$this->template->load('Home/template','Lembur/form',$data);
	}

	public function save(){		
		$id = $this->input->post('id');
		$listSdmId = $this->input->post('listSdmId');		

		$data['tahun'] = $this->input->post('tahun');

			$tglSrtTgs = $this->input->post('tgl_surat_tugas');
			$tglRever = $this->help->ReverseTgl($tglSrtTgs);
		$data['tgl_surat_tugas'] = $tglRever;		
		$data['latar_belakang'] = $this->input->post('latar_belakang');
		$data['perihal'] = $this->input->post('perihal');
		$data['tgl_kegiatan_dari'] = $this->help->ReverseTgl($this->input->post('tgl_kegiatan_dari'));		
		$data['tgl_kegiatan_sampai'] = $this->help->ReverseTgl($this->input->post('tgl_kegiatan_sampai'));	
			$tglKwi = $this->input->post('tgl_kwitansi');	
		if($tglKwi){
			$tglKwi = $this->help->ReverseTgl($tglKwi);
		}else{
			$tglKwi=null;
		}
		$data['tgl_kwitansi'] = $tglKwi;

		$data['pph_23_persen'] = $this->input->post('pph_23_persen');		

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
		
			$pndST = explode('_', $this->input->post('nama_penandatangan_st'));
		$data['nama_penandatangan_st'] = $pndST[0];
		$data['nip_penandatangan_st'] = $pndST[1];
		$jbtnST = $pndST[3];
		if(!empty($pndST[7]) && (strtotime($pndST[7]) <= strtotime($tglSrtTgs))){
			$jbtnST = $pndST[6];
		}
		$data['jabatan_penandatangan_st'] = $jbtnST;

			$pngsl = explode('_', $this->input->post('nama_pengusul'));
		$data['nama_pengusul'] = $pngsl[0];
		$data['nip_pengusul'] = $pngsl[1];
		$jbtnUsl = $pngsl[3];
		if(!empty($pngsl[7]) && (strtotime($pngsl[7]) <= strtotime($tglSrtTgs))){
			$jbtnUsl = $pngsl[6];
		}
		$data['jabatan_pengusul'] = $jbtnUsl;

		$pa = explode('_', $this->input->post('nama_pejabat_pa'));
		$data['nama_pejabat_pa'] = $pa[0];
		$data['nip_pejabat_pa'] = $pa[1];
		$data['jabatan_pejabat_pa'] = $pa[2];

		$kpa = explode('_', $this->input->post('nama_pejabat_kpa'));
		if($kpa[0]){
			$data['nama_pejabat_kpa'] = $kpa[0];
			$data['nip_pejabat_kpa'] = $kpa[1];
			$data['jabatan_pejabat_kpa'] = $kpa[2];
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

		$rekCatrng = $this->input->post('fk_rekanan_catering_id');
		if($rekCatrng){
			$data['fk_rekanan_catering_id'] = $rekCatrng;	
		}else{
			$data['fk_rekanan_catering_id'] = null;
		}

		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		if(empty($id)){
			// $que = "SELECT nama,nip,jabatan,jabatan_baru FROM ms_sdm WHERE fk_jabatan_id=2 AND status=1";
			// $sdm = $this->db->query($que)->row();
			// $data['nama_pejabat_pa'] = $sdm->nama;
			// $data['nip_pejabat_pa'] = $sdm->nip;
			// $data['jabatan_pejabat_pa'] = !empty($sdm->jabatan_baru)?$sdm->jabatan_baru:$sdm->jabatan;

			// $que2 = "SELECT nama,nip FROM ms_sdm WHERE bendahara=1 AND status=1 AND (bendahara_mulai <= '$tglRever' AND bendahara_sampai >= '$tglRever')";
			// $sdmBndhra = $this->db->query($que2)->row();
			// $data['nama_bendahara'] = $sdmBndhra->nama;
			// $data['nip_bendahara'] = $sdmBndhra->nip;

			$this->db->trans_start(); 
				
				$this->MLembur->insert($data);				
				$lmbrId = $this->db->insert_id();

				$nama_sdm = $this->input->post('listNamaSdm');
				$nip = $this->input->post('listNip');
				$golongan = $this->input->post('listGol');
				$jabatan = $this->input->post('listJabatan');
				$tgl = $this->input->post('listTgl');
				$jam = $this->input->post('listJam');
				$tarif = $this->input->post('listTarif');
				$pph = $this->input->post('listPph');
				$statPeg = $this->input->post('listStatPeg');
				$hrLbr = $this->input->post('listHrLbr');
				$uangMakan = $this->input->post('listUangMakan');
				$jmlMakan = $this->input->post('listJmlMakan');
				$keterangan = $this->input->post('listKeterangan');
				
				if(isset($listSdmId)){
					foreach ($listSdmId as $key => $val) {
						$dataDetail[] = array(
									'fk_entri_lembur_id'=>$lmbrId,
									'fk_sdm_id'=>$val,
									'nama_sdm'=>$nama_sdm[$key],
									'nip'=>$nip[$key],
									'golongan'=>$golongan[$key],
									'jabatan'=>$jabatan[$key],
									'tgl'=>$this->help->ReverseTgl($tgl[$key]),
									'jml_jam'=>$jam[$key],
									'tarif'=>str_replace(',', '', $tarif[$key]),
									'pph21'=>$pph[$key],
									'status_pegawai'=>$statPeg[$key],
									'is_libur'=>$hrLbr[$key],
									'uang_makan'=>str_replace(',', '', $uangMakan[$key]),
									'jml_makan'=>$jmlMakan[$key],
									'keterangan'=>$keterangan[$key],
								);
					}
					$this->db->insert_batch('t_entri_lembur_detail', $dataDetail);
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

				$this->MLembur->update($id,$data);		

				$nama_sdm = $this->input->post('listNamaSdm');
				$nip = $this->input->post('listNip');
				$golongan = $this->input->post('listGol');
				$jabatan = $this->input->post('listJabatan');
				$tgl = $this->input->post('listTgl');
				$jam = $this->input->post('listJam');
				$tarif = $this->input->post('listTarif');
				$pph = $this->input->post('listPph');
				$statPeg = $this->input->post('listStatPeg');
				$hrLbr = $this->input->post('listHrLbr');
				$uangMakan = $this->input->post('listUangMakan');
				$jmlMakan = $this->input->post('listJmlMakan');
				$keterangan = $this->input->post('listKeterangan');
				
				if(isset($listSdmId)){
					foreach ($listSdmId as $key => $val) {
						$dataDetail[] = array(
									'fk_entri_lembur_id'=>$id,
									'fk_sdm_id'=>$val,
									'nama_sdm'=>$nama_sdm[$key],
									'nip'=>$nip[$key],
									'golongan'=>$golongan[$key],
									'jabatan'=>$jabatan[$key],
									'tgl'=>$this->help->ReverseTgl($tgl[$key]),
									'jml_jam'=>$jam[$key],
									'tarif'=>str_replace(',', '', $tarif[$key]),
									'pph21'=>$pph[$key],
									'status_pegawai'=>$statPeg[$key],
									'is_libur'=>$hrLbr[$key],
									'uang_makan'=>str_replace(',', '', $uangMakan[$key]),
									'jml_makan'=>$jmlMakan[$key],
									'keterangan'=>$keterangan[$key],
								);
					}
					$this->db->insert_batch('t_entri_lembur_detail', $dataDetail);
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
        redirect('Lembur');
	}

	public function cekCariNama(){
		$id_sdm = $this->input->post('id_sdm');
		$tgl = $this->help->ReverseTgl($this->input->post('tgl'));

		// $que = "SELECT p.id,kategori,nama_bagian,bulan,kegiatan FROM t_pjd p INNER JOIN t_pjd_detail pd ON pd.fk_pjd_id=p.id where pd.fk_sdm_id=$id_sdm AND kategori='DL' AND (tgl_berangkat='$tgl' OR tgl_tiba='$tgl') "; 
		$que = "SELECT p.id,kategori,nama_bagian,bulan,kegiatan,tgl_sp_berangkat FROM t_pjd p INNER JOIN t_pjd_detail pd ON pd.fk_pjd_id=p.id WHERE pd.fk_sdm_id=$id_sdm AND (tgl_berangkat='$tgl' OR tgl_tiba='$tgl' OR tgl_tengah_1='$tgl' OR tgl_tengah_2='$tgl' OR tgl_tengah_3='$tgl')";
		$cekDL= $this->db->query($que)->row();

		$hslCek=''; $ktgri=''; $hslCekRpt=''; $katRapat='';
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
		$qweRpt = "SELECT td.id,singkatan_bagian,pukul,kegiatan FROM t_rapat_detail td INNER JOIN t_rapat t ON t.id=td.fk_rapat_id WHERE fk_sdm_id=$id_sdm AND tgl='$tgl'";
		$cekRapat= $this->db->query($qweRpt)->row();
		if(isset($cekRapat)){
			$hslCekRpt='Ada Kegiatan Rapat di '.$cekRapat->singkatan_bagian.', Pukul : '.$cekRapat->pukul.', Sub Kegiatan '.$cekRapat->kegiatan.' (Error ID rapat_detail : '.$cekRapat->id.')';
			$adaRapat = 'iya';

		}
			
		$data['kategori'] = $ktgri;
		$data['hslCek'] = $hslCek;

		$data['hslCekRpt'] = $hslCekRpt;
		$data['adaRapat'] = $adaRapat;

		echo json_encode($data);

	}

	public function delete($id){   
		$this->db->trans_start();  
			$this->MLembur->deleteAllDetail($id);
			$result = $this->MLembur->delete($id);
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

        redirect('Lembur');
	}

	public function detail($id){
		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hsl'] = $hsl[0];
		
		$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id)));

		$this->template->load('Home/template','Lembur/viewDetail',$data);
	}

	public function deleteDetail($fkLmbrId, $id){
		$result = $this->MLembur->deleteDetail($id);
		if($result){
        	$this->session->set_flashdata('success', 'Detail Lembur berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Detail Lembur gagal dihapus.');
        }
        redirect('Lembur/update/'.$fkLmbrId);
	}

	public function getCariDataDetail(){
		$id=$this->input->post('id');
		$hsl=$this->MLembur->getDetail((array('id'=>$id)));
		$hsl=$hsl[0];
		$data = array(
			'nama_sdm'=>$hsl['nama_sdm'],
			'tgl'=>$this->help->ReverseTgl($hsl['tgl']),
			'jml_jam'=>$hsl['jml_jam'],
			'is_libur'=>$hsl['is_libur'],
			'jml_makan'=>$hsl['jml_makan'],
		);

		echo json_encode($data);
	}

	public function updateDetail(){
		$id=$this->input->post('detail_id');
		$lembur_detail_id=$this->input->post('detail_lembur_detail_id');
		$data['jml_jam']=$this->input->post('detail_jml_jam');
		$data['jml_makan']=$this->input->post('detail_jml_makan');

		$this->MLembur->updateDetail($lembur_detail_id,$data);
		$this->session->set_flashdata('success', 'Detail Lembur berhasil diupdate.');
		redirect('Lembur/update/'.$id);
	}

	public function updateRekap(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->arrBagian();
		$data['url'] = base_url().'Lembur/proses_update_rekap';
		$data['tabel']='t_entri_lembur';
		$data['judul']='Lembur';
		
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

		$driTabel = 't_entri_lembur';
		$qwe = "SELECT id FROM $driTabel WHERE id in ($plh2) ORDER BY tgl_kwitansi";
		$dtl = $this->db->query($qwe)->result();

		$noBaru = '1';
		$this->db->trans_start();		
			$jml_dana=str_replace(',', '', $this->input->post('jml_dana'));
			$pengajuan_sebelum=str_replace(',', '', $this->input->post('pengajuan_sebelum'));
			$pengajuan_sekarang=str_replace(',', '', $this->input->post('pengajuan_sekarang'));
			$sisa_kas=str_replace(',', '', $this->input->post('sisa_kas'));
			$tot_pajak_lembur_sblm=$this->input->post('tot_pajak_lembur_sblm');			
			$user_act = $this->session->id;
			$time_act = date('Y-m-d H:i:s');
			$que = "insert into t_rekap_dana (dari_tabel,spj_bulan,fk_bagian_id,fk_kegiatan_id,fk_rekening_belanja_id,info_no_bku,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,pajak_lembur,user_act,time_act)
				values('$driTabel','$bulan',$fk_bagian_id,$fk_kegiatan_id,$fk_rekening_belanja_id,'$no_bku',$jml_dana,$pengajuan_sebelum,$pengajuan_sekarang,$sisa_kas,$tot_pajak_lembur_sblm,$user_act,'$time_act')";
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
		
		redirect('Lembur');
	}

	public function deleteRekap(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->arrBagian();
		$data['url'] = base_url().'Lembur/proses_delete_rekap';
		$data['tabel']='t_entri_lembur';
		$data['judul']='Lembur';
		
		$this->template->load('Home/template','KwitansiHR/form_rekap_delete',$data);
	}

	public function proses_delete_rekap(){
		$id_rekap_dana=$this->input->post('id_rekap_dana');
		$cek=$this->db->query("SELECT status_pengajuan_dana FROM t_rekap_dana WHERE id=$id_rekap_dana")->row();
		if($cek->status_pengajuan_dana==1){
			$this->session->set_flashdata('error', 'Data sudah dilakukan Pengajuan Dana.');
			redirect('Lembur');
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
			$this->db->update('t_entri_lembur', $data);

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

		redirect('Lembur');
	}

	public function cetakRekap(){		
		$id_rekap_dana=$this->input->post('id_rekap_dana');

		$data['tgl_rekap']=$this->input->post('tgl_rekap');
		$que = "SELECT rd.id,k.id id_kwi_hr,k.no_bku,k.spj_bulan,CONCAT(k.singkatan_bagian,'.',k.singkatan_kegiatan) singkat_keg,tahun,kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_pa,nip_pejabat_pa ,nama_pejabat_kpa,nip_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_lembur FROM t_rekap_dana rd INNER JOIN t_entri_lembur k ON k.fk_rekap_dana_id=rd.id INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id WHERE rd.id=$id_rekap_dana"; 
		$hsl = $this->db->query($que)->row();
		$data['hasil'] = $hsl;

		$qweDtl = "SELECT t.id,tgl_kwitansi,no_bku,no_kwitansi_rekap,perihal untuk_pembayaran,(uang_makan * sum(jml_makan)) banyaknya_uang,pph_23_persen FROM t_entri_lembur t INNER JOIN t_entri_lembur_detail td ON t.id=td.fk_entri_lembur_id WHERE fk_rekap_dana_id=$id_rekap_dana GROUP BY t.id ORDER BY no_kwitansi_rekap";
		$hsl = $this->db->query($qweDtl)->result();
		$data['detail'] = $hsl;
		$pjkDaerah=array(); $pph23=array();
		foreach ($hsl as $val) {
			$pjkDaerah[$val->id]=$this->help->pembulatanSeratus(ceil($val->banyaknya_uang*(10/100)));
			$pph23[$val->id]=$this->help->pembulatanSeratus(ceil($val->banyaknya_uang*($val->pph_23_persen/100)));
		}
		$data['pjkDaerah'] = $pjkDaerah;
		$data['pph23'] = $pph23;

		$html=$this->load->view('Lembur/cetakRekap',$data,true);
		$title = 'Lembur';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	public function cetakTelaah(){
		$id = $this->input->get('id');
		$data['header'] = $this->help->headerLaporan();

		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];
			$this->MLembur->groupSdm();
		$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id)));

		$html=$this->load->view('Lembur/cetakTelaah',$data,true);
		$title = 'Telaah Staf';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_P());
	}

	public function cetakST($id){
		$hsl = $this->MLembur->get(array('id'=>$id));

		$fkBagian=$hsl[0]['fk_bagian_id'];
		$bag = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();
		$data['kelAss'] = $bag;

		$data['header'] = $this->help->headerBagian($bag->nama_bagian);

		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['hasil'] = $hsl[0];
			$this->MLembur->groupSdm();
		$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id)));

		$html=$this->load->view('Lembur/cetakST',$data,true);
		$title = 'Surat Tugas';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_P());
	}

	// protected function DHGroupDtl($id,$statPeg){
	// 	$que = "SELECT
	// 				fk_sdm_id,nama_sdm,is_libur,tarif,count(id) jml_hari, sum(jml_jam) jml_jam, (tarif*count(id)*sum(jml_jam)) jumlah
	// 			FROM
	// 				t_entri_lembur_detail
	// 			WHERE fk_entri_lembur_id=$id AND status_pegawai='$statPeg'
	// 			GROUP BY fk_sdm_id,is_libur";
	// 	return $this->db->query($que)->result();
	// }

	public function cetakDhPNS($id){
		// $id = $this->input->get('id');

		$hsl = $this->MLembur->get(array('id'=>$id));

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['hasil'] = $hsl[0];

			$this->MLembur->groupSdm();
		$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id)));

		$que = "SELECT DISTINCT tgl FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id ORDER BY tgl ASC";
		$data['tglPlksnaan'] = $this->db->query($que)->result();

		$que2 = "SELECT fk_sdm_id,tgl,jml_jam FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id ";
		$detJam= $this->db->query($que2)->result();
		$arrDetailJam = array();
		foreach ($detJam as $val) {
			$arrDetailJam[$val->fk_sdm_id][$val->tgl]=$val->jml_jam;
		}
		$data['detailJam'] = $arrDetailJam;

		   //TIDAK JADI
		// $queDtl = "SELECT id,fk_sdm_id,nama_sdm,tgl,jml_jam FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id ORDER BY tgl ASC";
		// $datHsl = $this->db->query($queDtl)->result();

		// $kelSdm = array();
		// foreach ($datHsl as $val1) {
		// 	$kelSdm[$val1->fk_sdm_id][]=$val1;
		// }
		// $data['kelSdm']=$kelSdm;

		$html=$this->load->view('Lembur/cetakDhPNS',$data,true);
		$title = 'Daftar Hadir Lembur';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	public function cetakDhNonPNS(){
		$id = $this->input->get('id');

		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];
			$this->MLembur->groupSdm();
		$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id,'status_pegawai'=>'NON ASN')));

		$que = "SELECT DISTINCT tgl FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id AND status_pegawai='NON ASN' ORDER BY tgl ASC";
		$data['tglPlksnaan'] = $this->db->query($que)->result();

		$que2 = "SELECT fk_sdm_id,tgl,jml_jam FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id AND status_pegawai='NON ASN' ";
		$detJam= $this->db->query($que2)->result();
		$arrDetailJam = array();
		foreach ($detJam as $val) {
			$arrDetailJam[$val->fk_sdm_id][$val->tgl]=$val->jml_jam;
		}
		$data['detailJam'] = $arrDetailJam;

		$html=$this->load->view('Lembur/cetakDhPNS',$data,true);
		$title = 'Daftar Hadir NON ASN';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	protected function DPGroupDtl($id,$statPeg){
		$que = "SELECT
					fk_sdm_id,nama_sdm,is_libur,tarif,count(id) jml_hari, jml_jam
				FROM
					t_entri_lembur_detail
				WHERE fk_entri_lembur_id=$id AND status_pegawai='$statPeg'
				GROUP BY fk_sdm_id,is_libur,jml_jam";
		return $this->db->query($que)->result();
	}

	public function cetakDpPNS(){
		$id = $this->input->get('id');

		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];
			$this->MLembur->groupSdm();
		$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id,'status_pegawai'=>'PNS')));

		$groupDtl = $this->DPGroupDtl($id,'PNS');
		$groupDetailnya=array();
		foreach ($groupDtl as $val) {
			$groupDetailnya[$val->fk_sdm_id][]=$val;
		}
		
		// echo "<pre>";
		// print_r($groupDetailnya);
		// echo "</pre>";die();
		$data['groupDetail'] = $groupDetailnya;

		$uangPns = $this->jmlUangLmbur($id,'PNS');
		$data['nilaiUang'] = $uangPns->total;
		$data['untPmbyrn'] = 'Uang Lembur PNS ';

		$html=$this->load->view('Lembur/cetakDpPNS',$data,true);
		$title = 'Daftar Penerimaan Uang Lembur PNS';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	public function cetakDpNonPNS(){
		$id = $this->input->get('id');

		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];
			$this->MLembur->groupSdm();
		$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id,'status_pegawai'=>'NON ASN')));

		$groupDtl = $this->DPGroupDtl($id,'NON ASN');
		$groupDetailnya=array();
		foreach ($groupDtl as $val) {
			$groupDetailnya[$val->fk_sdm_id][]=$val;
		}
		
		// echo "<pre>";
		// print_r($groupDetailnya);
		// echo "</pre>";die();
		$data['groupDetail'] = $groupDetailnya;

		$uangPns = $this->jmlUangLmbur($id,'NON ASN');
		$data['nilaiUang'] = $uangPns->total;
		$data['untPmbyrn'] = 'Uang Lembur NON ASN ';

		$html=$this->load->view('Lembur/cetakDpPNS',$data,true);
		$title = 'Daftar Penerimaan Uang Lembur NON ASN';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	protected function DPUMGroupDtl($id){
		$que = "SELECT
					fk_sdm_id,nama_sdm,is_libur,tarif,count(id) jml_hari, (uang_makan*sum(jml_makan)) jumlah, uang_makan, sum(jml_makan) jml_makan
				FROM
					t_entri_lembur_detail
				WHERE fk_entri_lembur_id=$id
				GROUP BY fk_sdm_id,is_libur";
		return $this->db->query($que)->result();
	}

	public function cetakDpUMPNS(){
		$id = $this->input->get('id');

		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];
			$this->MLembur->groupSdm();
		$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id)));

		$groupDtl = $this->DPUMGroupDtl($id);
		$groupDetailnya=array();
		foreach ($groupDtl as $val) {
			$groupDetailnya[$val->fk_sdm_id][]=$val;
		}
		
		// echo "<pre>";
		// print_r($groupDetailnya);
		// echo "</pre>";die();
		$data['groupDetail'] = $groupDetailnya;

		$uangMkn = $this->jmlUangMknLmbur($id);
		$data['nilaiUang'] = $uangMkn['totAll'];
		$data['untPmbyrn'] = 'Uang Makan Lembur ';

		$html=$this->load->view('Lembur/cetakDpUMPNS',$data,true);
		$title = 'Daftar Penerimaan Uang Makan Lembur';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	public function cetakDftrUpah($id){
		$hsl = $this->MLembur->get(array('id'=>$id));

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['hasil'] = $hsl[0];

		$queDtl = "SELECT count(fk_sdm_id) jml_hari,nama_sdm,golongan,sum(jml_jam) jml_jam,tarif,is_libur,pph21 FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id AND tarif > 0 GROUP BY fk_sdm_id,is_libur ORDER BY golongan desc";
		$data['detail'] = $this->db->query($queDtl)->result();

		$html=$this->load->view('Lembur/cetakDftrUpah',$data,true);
		$title = 'Daftar Penerimaan Uang Lembur';
		
		echo $html;
	}

	public function lapLembur($id){
		// $id = $this->input->get('id');

		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		$data['kelAss'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

			$this->MLembur->groupSdm();
		$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id)));

		$html=$this->load->view('Lembur/cetakLapLembur',$data,true);
		$title = 'Lap. Lembur';
	// echo $html;die();	
		// $this->pdf($title,$html,$this->help->folio_P(),true);
		$this->msword($title,$html);
	}

	// public function cetakDpUMNonPNS(){
	// 	$id = $this->input->get('id');

	// 	$hsl = $this->MLembur->get(array('id'=>$id));
	// 	$data['hasil'] = $hsl[0];
	// 		$this->MLembur->groupSdm();
	// 	$data['detail'] = $this->MLembur->getDetail((array('fk_entri_lembur_id'=>$id,'status_pegawai'=>'NON ASN')));

	// 	$groupDtl = $this->DPUMGroupDtl($id,'NON ASN');
	// 	$groupDetailnya=array();
	// 	foreach ($groupDtl as $val) {
	// 		$groupDetailnya[$val->fk_sdm_id][]=$val;
	// 	}
		
	// 	// echo "<pre>";
	// 	// print_r($groupDetailnya);
	// 	// echo "</pre>";die();
	// 	$data['groupDetail'] = $groupDetailnya;

	// 	$html=$this->load->view('Lembur/cetakDpUMPNS',$data,true);
	// 	$title = 'Daftar Penerimaan Uang Makan Lembur NON ASN';
		
	// 	// echo $html;
	// 	$this->pdf($title,$html,$this->help->folio_L());
	// }

	protected function jmlUangLmbur($id,$statPeg){
		$que = "SELECT count(tgl) jml_hari,sum(jml_jam*tarif) total,ROUND(sum((jml_jam*tarif*pph21)/100),0) tot_pph21 FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id AND status_pegawai='$statPeg'";

		return $this->db->query($que)->row();
	}

	protected function jmlUangMknLmbur($id){
		$que = "SELECT	fk_rekanan_catering_id,fk_sdm_id,nama_sdm,(max(uang_makan) * sum(jml_makan)) jumlah, sum(jml_makan) jml_makan, uang_makan, pph_23_persen
				FROM t_entri_lembur_detail td
				INNER JOIN t_entri_lembur t ON t.id=td.fk_entri_lembur_id
				WHERE fk_entri_lembur_id = $id 
				-- GROUP BY fk_sdm_id, is_libur
				-- ORDER BY status_pegawai,fk_sdm_id
				";		
		$hsl = $this->db->query($que)->row();

		$pjkDrh=0;
		if(!empty($hsl->fk_rekanan_catering_id)){
			$pjkDrh = $this->help->pembulatanSeratus(ceil($hsl->jumlah*(10/100)));
		}
		// if($isRekanan!=''){
		$nilaipph=0;
		if(!empty($hsl->fk_rekanan_catering_id)){
            $nilaipph = $this->help->pembulatanSeratus(ceil(($hsl->jumlah)*($hsl->pph_23_persen/100)));
        }
        // }else{
        //     $nilaipph = $this->help->pembulatanSeratus(ceil(($hsl->jumlah-$pjkDrh)*(4/100)));
        // }

		// $totAll = 0;
		// $cekPph = array();
		// foreach ($hsl as $val) {
		// 	$totAll += $val->jumlah;

		// 	$cekPph[$val->fk_sdm_id][$val->pph21][] = $val->jumlah;
		// }

		// $jmlPPH=array(); $totPph21=0;
		// foreach ($cekPph as $sdmId => $value) {
		// 	foreach ($value as $pphnya => $jumlahnya) { 
		// 		$jmlnya = 0;
		// 		foreach ($jumlahnya as $hsl) {
		// 			$jmlnya +=	$hsl;
		// 		}
		// 		$totPph21 += ($jmlnya*$pphnya)/100;
		// 	}
		// }
		// $data['totPph21'] = $totPph21;

		$data['totAll'] = $hsl->jumlah;
		$data['jml_makan'] = $hsl->jml_makan;
		$data['uang_makan'] = $hsl->uang_makan;
		$data['pajakDaerah'] = $pjkDrh;
		$data['totPph23'] = $nilaipph;

		return $data;
	}


	public function cetakKwiMamin($id){
		// $id = $this->input->post('id_lembur_kwi');
		// $data['tampilkan_pajak'] = $this->input->post('tampilkan_pajak');
		// $id = $this->input->get('id');
		$data['tampilkan_pajak'] = 'tampil';
		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bagn'] = $this->db->query("SELECT nama_bagian,kode_bagian FROM ms_bagian WHERE id=$fkBagian ")->row();

		$rknn = $this->MMsRekananCatering->get(array('id'=>$hsl[0]['fk_rekanan_catering_id']));
		$data['rekanan'] = $rknn[0];

		if(!isset($rknn)){
			$data['rekanan'] = array(
					'nama_pemilik'=>'',
					'nama_rekanan'=>'',
					'npwp'=>'',
				);
		}

		// $que = "SELECT MIN(id) id,nama_sdm,nip FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id ";
		// $pnrmPns = $this->db->query($que)->row();

		// $que2 = "SELECT MIN(id) id,nama_sdm,nip FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id AND status_pegawai='NON ASN'";
		// $pnrmnonPns = $this->db->query($que2)->row();

		// 	$uangPns = $this->jmlUangLmbur($id,'PNS');;
		// $data['Pph21'][1] = $uangPns->tot_pph21;
		// $data['nilaiUang'][1] = $uangPns->total;
		// $data['pnrmNama'][1] = $pnrmPns->nama_sdm;
		// $data['pnrmNIP'][1] = 'NIP. '.$pnrmPns->nip;

		// 	$uangNonPns = $this->jmlUangLmbur($id,'NON ASN');
		// $data['Pph21'][2] = $uangNonPns->tot_pph21;
		// $data['nilaiUang'][2] = $uangNonPns->total;
		// $data['pnrmNama'][2] = $pnrmnonPns->nama_sdm;
		// $data['pnrmNIP'][2] = '';

			$uangMkn = $this->jmlUangMknLmbur($id);
		$data['Pph23'][3] = $uangMkn['totPph23'];
		$data['nilaiUang'][3] = $uangMkn['totAll'];
		$data['jml_makan'][3] = $uangMkn['jml_makan'];
		$data['uang_makan'][3] = $uangMkn['uang_makan'];
		$data['pajakDaerah'][3] = $uangMkn['pajakDaerah'];
		// $data['pnrmNama'][3] = $pnrmPns->nama_sdm;
		// $data['pnrmNIP'][3] = 'NIP. '.$pnrmPns->nip;


		// $data['untPmbyrn'][1] = 'Uang Lembur ';
		// $data['untPmbyrn'][2] = 'Uang Lembur NON ASN ';
		$data['untPmbyrn'][3] = 'Makan Minum Lembur ';

		$html=$this->load->view('Lembur/cetakKwitansiMamin',$data,true);
		$title = 'Kwitansi Mamin Lembur';
		
		echo $html;
		// $this->pdf($title,$html,'A5-L');
	}

	public function cetakKwiUpah($id){
		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['detail']=$this->db->query("SELECT sum(jml_jam*tarif) totTarif,nama_sdm,nip FROM t_entri_lembur_detail WHERE fk_entri_lembur_id=$id")->row();

		$data['bagn'] = $this->db->query("SELECT nama_bagian,kode_bagian FROM ms_bagian WHERE id=$fkBagian ")->row();

		$html=$this->load->view('Lembur/cetakKwitansiUpah',$data,true);
		$title = 'Kwitansi Upah Lembur';
		
		echo $html;
		// $this->pdf($title,$html,'A5-L');
	}

	public function cetak_sspd(){
		$id = $this->input->post('id_lembur');
		$data['tgl_cetak'] = $this->input->post('tgl_cetak');
		
		$hsl = $this->MLembur->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$rknn = $this->MMsRekananCatering->get(array('id'=>$hsl[0]['fk_rekanan_catering_id']));
		$data['rekanan'] = $rknn[0];

		$uangMkn = $this->jmlUangMknLmbur($id);
		$data['pajakDaerah'] = $uangMkn['pajakDaerah'];

		$data['kategori'] = 'lembur';

		$html=$this->load->view('Lembur/cetakSSPD',$data,true);
		$title = 'Cetak SSPD';
		
		// echo $html;
		$this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function cetak_sspd_rekap(){
		$data['tgl_cetak']=$this->input->get('tgl_sspd');
		$id_rekap_dana=$this->input->get('id_rekap_dana');

		$hsl = $this->db->query("SELECT * FROM t_entri_lembur WHERE fk_rekap_dana_id=$id_rekap_dana")->result_array();
		
		$no=1;
		foreach ($hsl as $val) {
			$plh2 .= $val['id'];
			if(count($hsl)!=$no){
				$plh2 .= ",";
			}

			$rekananId = $val['fk_rekanan_catering_id'];
			$no++;
			$data['hasil'] = $val;
		}
		

		$rknn = $this->MMsRekananCatering->get(array('id'=>$rekananId));
		$data['rekanan'] = $rknn[0];

		$que = "SELECT (uang_makan * sum(jml_makan)) jumlah
				FROM t_entri_lembur_detail td
				INNER JOIN t_entri_lembur t ON t.id=td.fk_entri_lembur_id
				WHERE fk_entri_lembur_id IN ($plh2) 
			";	
		$hsl = $this->db->query($que)->row();
		$pjkDrh = $this->help->pembulatanSeratus(ceil($hsl->jumlah*(10/100)));
		$data['pajakDaerah'] = $pjkDrh;

		$data['kategori'] = 'lembur';

		$html=$this->load->view('Lembur/cetakSSPD',$data,true);
		$title = 'Cetak SSPD';
		
		// echo $html;
		$this->pdf($title,$html,$this->help->folio_P(),true);

	}
	
	protected function pdf($title,$html,$page,$batas=false){
		// echo $html;
		if($batas){
			$mpdf = new mPDF('utf-8', $page);
		}else{
        	$mpdf = new mPDF('utf-8', $page, 0, '', 5, 5, 4, 2, 5, 5);
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
