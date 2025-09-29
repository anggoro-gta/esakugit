<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KwitansiHR extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		$this->load->model('MKwitansiHr');
		$this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsRekeningBelanja');
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
		$this->template->load('Home/template','KwitansiHR/list',$data);
	}

	public function getListDetail(){
		$data['bulan'] = $this->input->post('bulan');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');		
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->arrBagian();

		$this->load->view('KwitansiHR/listDetail',$data);
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
			$this->datatables->where("t_kwitansi_hr.spj_bulan",$bulan);
		}
		if($fk_bagian_id){
			$this->datatables->where('t_kwitansi_hr.fk_bagian_id',$fk_bagian_id);
		}
		if($fk_program_id){
			$this->datatables->where('t_kwitansi_hr.fk_program_id',$fk_program_id);
		}
		if($fk_kegiatan_id){
			$this->datatables->where('t_kwitansi_hr.fk_kegiatan_id',$fk_kegiatan_id);
		}

        $this->datatables->select('t_kwitansi_hr.id,t_kwitansi_hr.spj_bulan,hr_bulan,untuk_pembayaran,singkatan_bagian,nama_program,kegiatan,is_spj,kategori,t_rekap_dana.info_no_bku,fk_rekap_dana_id,nama_rek_belanja');
        $this->datatables->select("DATE_FORMAT(tgl_kwitansi, '%d/%m/%Y') AS tgl_kwitansi", FALSE);
        $this->datatables->select("FORMAT(sum((sub_total_bruto*jml_kali)+bpjs_kes_pemkab+bpjs_krj_jkk+bpjs_krj_jkm),0) AS nominal_bruto", FALSE);
        $this->datatables->from("t_kwitansi_hr");
        $this->datatables->join('t_kwitansi_hr_detail','t_kwitansi_hr_detail.fk_kwitansi_hr_id=t_kwitansi_hr.id','inner');
        $this->datatables->join('t_rekap_dana','t_rekap_dana.id=t_kwitansi_hr.fk_rekap_dana_id','left');
        $this->datatables->join('ms_rekening_belanja','ms_rekening_belanja.id=t_kwitansi_hr.fk_rekening_belanja_id','left');
        $this->db->order_by("t_kwitansi_hr.tgl_kwitansi,spj_bulan,hr_bulan", "desc");
        $this->datatables->group_by('t_kwitansi_hr.id');
        echo $this->datatables->generate();
	}

	public function cariNamaKeg(){
		$id_sdm = $this->input->post('id_sdm');

		$que = "SELECT id,nama,jabatan_kegiatan from ms_sdm WHERE id=$id_sdm";
		$hsl = $this->db->query($que)->row();
		
		$data['nama'] = $hsl->nama;
		$data['jabatan_kegiatan'] = $hsl->jabatan_kegiatan;

		echo json_encode($data);
	}

	protected function namaSDMKegiatan(){
		//$que = "SELECT id,nama,jabatan_kegiatan from ms_sdm WHERE jabatan_kegiatan!='' ORDER BY nama ASC";
		$que = "SELECT id,nama,jabatan_kegiatan from ms_sdm WHERE status=1 ORDER BY nama ASC";
		return $this->db->query($que)->result();
	}

	protected function namaSDMKontrak(){
		$que = "SELECT id,nama from ms_sdm WHERE pegawai_setda=1 AND status=1 AND (status_pegawai = 'NON ASN' OR id=196) ORDER BY id ASC";
		return $this->db->query($que)->result();
	}

	public function namaSdmHR(){
 		$kategori=$_POST['val'];
 		$data['hasil'] = "<option value=''>Pilih</option>\n";
 		if($kategori=='KEGIATAN'){
 			foreach ((array)$this->namaSDMKegiatan() as $val) {
	 			$data['hasil'] .= "<option value=\"".$val->id."\">".$val->nama.' ['.$val->jabatan_kegiatan.']'."</option>\n";
	 		}
 		}else{
 			$data['hasil'] .= "<option value='narasumber'>Narasumber</option>\n";
 			$data['hasil'] .= "<option value='moderator'>Moderator</option>\n";
 		}

 		
 		echo json_encode($data);
 	}

	public function create(){
		$Bagian=null;
		if($this->level!='1'){
			$Bagian=$this->fkBagianId;
		}
		$data = array(
			'button' => 'Simpan',
			'tahun' => set_value('tahun',$this->tahun),
			'hr_bulan' => set_value('hr_bulan'),
			'kategori' => set_value('kategori'),
			'tgl_kwitansi' => set_value('tgl_kwitansi'),
			'untuk_pembayaran' => set_value('untuk_pembayaran'),
			'fk_bagian_id' => set_value('fk_bagian_id',$Bagian),
			'fk_program_id' => set_value('fk_program_id'),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id'),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id'),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa'),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa'),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk'),
			'nama_bendahara' => set_value('nama_bendahara'),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu'),
			'satuan_narsum' => set_value('satuan_narsum'),
			'id' => set_value('id'),
		);

		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrPA'] = $this->help->ttd_pa();
		$data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrSdmKontrak'] = $this->namaSDMKontrak();
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['arrPPTK'] = $this->help->ttd_pptk();

		$this->template->load('Home/template','KwitansiHR/form',$data);
	}

	public function update($id){
		$hsl = $this->MKwitansiHr->get(array('id'=>$id));
		$hsl = $hsl[0];

		$data = array(
			'button' => 'Update',
			'tahun' => set_value('tahun',$hsl['tahun']),
			'hr_bulan' => set_value('hr_bulan',$hsl['hr_bulan']),
			'kategori' => set_value('kategori',$hsl['kategori']),
			'tgl_kwitansi' => set_value('tgl_kwitansi',$this->help->ReverseTgl($hsl['tgl_kwitansi'])),
			'untuk_pembayaran' => set_value('untuk_pembayaran',$hsl['untuk_pembayaran']),
			'fk_bagian_id' => set_value('fk_bagian_id',$hsl['fk_bagian_id']),
			'fk_program_id' => set_value('fk_program_id',$hsl['fk_program_id']),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id',$hsl['fk_kegiatan_id']),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id',$hsl['fk_rekening_belanja_id']),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa',$hsl['nama_pejabat_pa']),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa',$hsl['nama_pejabat_kpa']),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk',$hsl['nama_pejabat_pptk']),
			'nama_bendahara' => set_value('nama_bendahara',$hsl['nama_bendahara']),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu',$hsl['nama_bendahara_pembantu']),
			'satuan_narsum' => set_value('satuan_narsum',$hsl['satuan_narsum']),
			'satuan_narsum' => set_value('satuan_narsum',$hsl['satuan_narsum']),
			'is_spj' => set_value('is_spj',$hsl['is_spj']),
			'id' => set_value('id',$id),
		);

		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrPA'] = $this->help->ttd_pa();
		$data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrSdmKontrak'] = $this->namaSDMKontrak();
		$data['arrKwitansiHRDetail'] = $this->MKwitansiHr->getDetail((array('fk_kwitansi_hr_id'=>$id)));
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['arrPPTK'] = $this->help->ttd_pptk();

		$this->template->load('Home/template','KwitansiHR/form',$data);
	}

	public function save(){		
		$id = $this->input->post('id');		

		$data['tahun'] = $this->input->post('tahun');

		$data['hr_bulan'] = $this->input->post('hr_bulan');

			$kategori = $this->input->post('kategori');
		
			$tglKwi = $this->input->post('tgl_kwitansi');	
		if($tglKwi){
			$tglKwi = $this->help->ReverseTgl($tglKwi);
		}else{
			$tglKwi=null;
		}
		$data['tgl_kwitansi'] = $tglKwi;

		$data['untuk_pembayaran'] = $this->input->post('untuk_pembayaran');	
		$data['satuan_narsum'] = $this->input->post('satuan_narsum');	

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

		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		if(empty($id)){
			$data['kategori'] = $kategori;
			$isKtrk = $this->input->post('is_kontrak_it');
			if($isKtrk){
				$data['is_kontrak_it']  = 1;
			}
			$this->db->trans_start(); 
				
				$this->MKwitansiHr->insert($data);				
				$KwiHrId = $this->db->insert_id();

				if($kategori=='KEGIATAN'){
					$listSdmId = $this->input->post('listSdmId');
					$nama_sdm = $this->input->post('listNamaSdm');
					$jabKeg = $this->input->post('listJabKeg');
					$nominal = $this->input->post('listNominal');
					$kali = $this->input->post('listKali');
					$pajak = $this->input->post('listPajak');
					$jmlDiterima = $this->input->post('listJmlDiterima');
					
					if(isset($listSdmId)){
						foreach ($listSdmId as $key => $val) {
							$dataDetail[] = array(
										'fk_kwitansi_hr_id'=>$KwiHrId,
										'fk_sdm_id'=>$val,
										'nama'=>$nama_sdm[$key],
										'jabatan_kegiatan'=>$jabKeg[$key],
										'nominal_bruto'=>$nominal[$key],
										'sub_total_bruto'=>$nominal[$key],
										'jml_kali'=>$kali[$key],
										'pajak_persen'=>$pajak[$key],
										'jml_diterima'=>$jmlDiterima[$key],
									);
						}
						$this->db->insert_batch('t_Kwitansi_hr_detail', $dataDetail);
					}
				}

				if($kategori=='NARASUMBER'){
					$listSdmId = $this->input->post('listSdmIdNarsum');
					$nama_sdm = $this->input->post('listNamaSdmNarsum');
					$jabNarsum = $this->input->post('listJabNarsum');
					$nominal = $this->input->post('listNominaNarsum');
					$persenKali = $this->input->post('listPersenKaliNarsum');
					$subTotal = $this->input->post('listSubTotalNarsum');
					$kali = $this->input->post('listJmlKaliNarsum');
					$pajak = $this->input->post('listPajakNarsum');
					$jmlDiterima = $this->input->post('listJmlDiterimaNarsum');
					
					if(isset($listSdmId)){
						foreach ($listSdmId as $key => $val) {
							$dataDetail[] = array(
										'fk_kwitansi_hr_id'=>$KwiHrId,
										'fk_sdm_id'=>$val,
										'nama'=>$nama_sdm[$key],
										'jabatan_kegiatan'=>$jabNarsum[$key],
										'nominal_bruto'=>$nominal[$key],
										'persen_kali'=>$persenKali[$key],
										'sub_total_bruto'=>$subTotal[$key],
										'jml_kali'=>$kali[$key],
										'pajak_persen'=>$pajak[$key],
										'jml_diterima'=>$jmlDiterima[$key],
									);
						}
						$this->db->insert_batch('t_Kwitansi_hr_detail', $dataDetail);
					}
				}

				if($kategori=='KONTRAK'){
					$listSdmIdKon = $this->input->post('listSdmIdKon');
					$nama_sdmKon = $this->input->post('listNamaSdmKon');
					$nominalKon = $this->input->post('listNominalKon');
					$bpjsKesPmkab = $this->input->post('listBpjsKesPmkab');
					$bpjsKrjJKK = $this->input->post('listBpjsKrjJKK');
					$bpjsKrjJKM = $this->input->post('listBpjsKrjJKM');
					$hasilKotor = $this->input->post('listHasilKotor');
					$bpjsKesPsrta = $this->input->post('listBpjsKesPsrta');
					$jmlKluar = $this->input->post('listJmlKluar');
					$jmlDiterimaKon = $this->input->post('listJmlDiterimaKon');
					
					if(isset($listSdmIdKon)){
						foreach ($listSdmIdKon as $key => $val) {
							$dataDetailKon[] = array(
										'fk_kwitansi_hr_id'=>$KwiHrId,
										'fk_sdm_id'=>$val,
										'nama'=>$nama_sdmKon[$key],
										'nominal_bruto'=>$nominalKon[$key],
										'sub_total_bruto'=>$nominalKon[$key],
										'jml_kali'=>1,
										'bpjs_kes_pemkab'=>$bpjsKesPmkab[$key],
										'penghasilan_kotor'=>$hasilKotor[$key],
										'bpjs_kes_peserta'=>$bpjsKesPsrta[$key],
										'jml_pengeluaran'=>$jmlKluar[$key],
										'jml_diterima'=>$jmlDiterimaKon[$key],
										'bpjs_krj_jkk'=>$bpjsKrjJKK[$key],
										'bpjs_krj_jkm'=>$bpjsKrjJKM[$key],
									);
						}
						$this->db->insert_batch('t_Kwitansi_hr_detail', $dataDetailKon);
					}
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

				$this->MKwitansiHr->update($id,$data);		

				if($kategori=='KEGIATAN'){
					$listSdmId = $this->input->post('listSdmId');
					$nama_sdm = $this->input->post('listNamaSdm');
					$jabKeg = $this->input->post('listJabKeg');
					$nominal = $this->input->post('listNominal');
					$kali = $this->input->post('listKali');
					$pajak = $this->input->post('listPajak');
					$jmlDiterima = $this->input->post('listJmlDiterima');
					
					if(isset($listSdmId)){
						foreach ($listSdmId as $key => $val) {
							$dataDetail[] = array(
										'fk_kwitansi_hr_id'=>$id,
										'fk_sdm_id'=>$val,
										'nama'=>$nama_sdm[$key],
										'jabatan_kegiatan'=>$jabKeg[$key],
										'nominal_bruto'=>$nominal[$key],
										'sub_total_bruto'=>$nominal[$key],
										'jml_kali'=>$kali[$key],
										'pajak_persen'=>$pajak[$key],
										'jml_diterima'=>$jmlDiterima[$key],
									);
						}
						$this->db->insert_batch('t_Kwitansi_hr_detail', $dataDetail);
					}
				}

				if($kategori=='NARASUMBER'){
					$listSdmId = $this->input->post('listSdmIdNarsum');
					$nama_sdm = $this->input->post('listNamaSdmNarsum');
					$jabNarsum = $this->input->post('listJabNarsum');
					$nominal = $this->input->post('listNominaNarsum');
					$persenKali = $this->input->post('listPersenKaliNarsum');
					$subTotal = $this->input->post('listSubTotalNarsum');
					$kali = $this->input->post('listJmlKaliNarsum');
					$pajak = $this->input->post('listPajakNarsum');
					$jmlDiterima = $this->input->post('listJmlDiterimaNarsum');
					
					if(isset($listSdmId)){
						foreach ($listSdmId as $key => $val) {
							$dataDetail[] = array(
										'fk_kwitansi_hr_id'=>$id,
										'fk_sdm_id'=>$val,
										'nama'=>$nama_sdm[$key],
										'jabatan_kegiatan'=>$jabNarsum[$key],
										'nominal_bruto'=>$nominal[$key],
										'persen_kali'=>$persenKali[$key],
										'sub_total_bruto'=>$subTotal[$key],
										'jml_kali'=>$kali[$key],
										'pajak_persen'=>$pajak[$key],
										'jml_diterima'=>$jmlDiterima[$key],
									);
						}
						$this->db->insert_batch('t_Kwitansi_hr_detail', $dataDetail);
					}
				}

				if($kategori=='KONTRAK'){
					$listSdmIdKon = $this->input->post('listSdmIdKon');
					$nama_sdmKon = $this->input->post('listNamaSdmKon');
					$nominalKon = $this->input->post('listNominalKon');
					$bpjsKesPmkab = $this->input->post('listBpjsKesPmkab');
					$bpjsKrjJKK = $this->input->post('listBpjsKrjJKK');
					$bpjsKrjJKM = $this->input->post('listBpjsKrjJKM');
					$hasilKotor = $this->input->post('listHasilKotor');
					$bpjsKesPsrta = $this->input->post('listBpjsKesPsrta');
					$jmlKluar = $this->input->post('listJmlKluar');
					$jmlDiterimaKon = $this->input->post('listJmlDiterimaKon');
					
					if(isset($listSdmIdKon)){
						foreach ($listSdmIdKon as $key => $val) {
							$dataDetailKon[] = array(
										'fk_kwitansi_hr_id'=>$id,
										'fk_sdm_id'=>$val,
										'nama'=>$nama_sdmKon[$key],
										'nominal_bruto'=>$nominalKon[$key],
										'sub_total_bruto'=>$nominalKon[$key],
										'jml_kali'=>1,
										'bpjs_kes_pemkab'=>$bpjsKesPmkab[$key],
										'bpjs_krj_jkk'=>$bpjsKrjJKK[$key],
										'bpjs_krj_jkm'=>$bpjsKrjJKM[$key],
										'penghasilan_kotor'=>$hasilKotor[$key],
										'bpjs_kes_peserta'=>$bpjsKesPsrta[$key],
										'jml_pengeluaran'=>$jmlKluar[$key],
										'jml_diterima'=>$jmlDiterimaKon[$key],
									);
						}
						$this->db->insert_batch('t_Kwitansi_hr_detail', $dataDetailKon);
					}
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
        redirect('KwitansiHR');
	}

	public function cekCariNama(){
		$id_sdm = $this->input->post('id_sdm');
		$tgl = $this->help->ReverseTgl($this->input->post('tgl'));

		$que = "SELECT p.id,kategori,nama_bagian,bulan,kegiatan FROM t_pjd p INNER JOIN t_pjd_detail pd ON pd.fk_pjd_id=p.id where pd.fk_sdm_id=$id_sdm AND kategori='DL' AND (tgl_berangkat='$tgl' OR tgl_tiba='$tgl' OR tgl_tengah_1='$tgl' OR tgl_tengah_2='$tgl' OR tgl_tengah_3='$tgl') "; 
		$cekDL= $this->db->query($que)->row();

		$hslCek='';
		if(isset($cekDL)){
			if($cekDL->kategori=='DL'){
				$bln = !empty($cekDL->bulan)?$this->help->namaBulan($cekDL->bulan):'';
				$hslCek='Sudah ada kegiatan Perjalanan Dinas '.$cekDL->kategori.' '.$cekDL->nama_bagian.', '.$bln.', Kegiatan '.$cekDL->kegiatan.' (Error ID : '.$cekDL->id.')';
			}	
		}else{
			$celLmbr = "SELECT td.id,bulan,singkatan_bagian,kegiatan FROM t_KwitansiHR_detail td INNER JOIN t_KwitansiHR t ON t.id=td.fk_kwitansi_hr_id WHERE fk_sdm_id=$id_sdm AND tgl='$tgl'";
			$cekLmbr= $this->db->query($celLmbr)->row();
			if(isset($cekLmbr)){
				$hslCek='Sudah ada kegiatan KwitansiHR '.$cekLmbr->singkatan_bagian.', Bulan '.$this->help->namaBulan($cekLmbr->bulan).', Kegiatan '.$cekLmbr->kegiatan.' (Error ID Dtl : '.$cekLmbr->id.')';
			}
		}
		$data['hslCek'] = $hslCek;

		echo json_encode($data);

	}

	public function delete($id){   
		$this->db->trans_start();  
			$result = $this->MKwitansiHr->delete($id);
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

        redirect('KwitansiHR');
	}

	public function detail($id){
		$hsl = $this->MKwitansiHr->get(array('id'=>$id));
		$data['hsl'] = $hsl[0];
		
		$data['detail'] = $this->MKwitansiHr->getDetail((array('fk_kwitansi_hr_id'=>$id)));

		$this->template->load('Home/template','KwitansiHR/viewDetail',$data);
	}

	public function deleteDetail($fkLmbrId, $id){
		$result = $this->MKwitansiHr->deleteDetail($id);
		if($result){
        	$this->session->set_flashdata('success', 'Detail KwitansiHR berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Detail KwitansiHR gagal dihapus.');
        }
        redirect('KwitansiHR/update/'.$fkLmbrId);
	}

	public function getKegiatanRekap(){
 		$tabel=$this->input->post('tabel');
 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$que = "SELECT fk_kegiatan_id,kegiatan FROM $tabel WHERE tahun=$this->tahun AND is_spj='0' AND fk_bagian_id=$fk_bagian_id GROUP BY fk_kegiatan_id";
 		$nmKeg = $this->db->query($que)->result_array();

 		$data['nama_keg'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$nmKeg as $val) {
 			$data['nama_keg'] .= "<option value=\"".$val['fk_kegiatan_id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getKegiatanRekapDel(){
 		$kategori=$this->input->post('kategori');
 		$tabel=$this->input->post('tabel');

 		$andWhere='';
 		if($tabel=='t_kwitansi'){
 			$andWhere=" AND jenis_belanja LIKE '%$kategori%'";
 		}

 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$bulan=$this->input->post('bulan');
 		$que = "SELECT fk_kegiatan_id,kegiatan FROM $tabel WHERE tahun=$this->tahun $andWhere AND spj_bulan='$bulan' AND is_spj='1' AND fk_bagian_id=$fk_bagian_id GROUP BY fk_kegiatan_id";
 		$nmKeg = $this->db->query($que)->result_array();

 		$data['nama_keg'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$nmKeg as $val) {
 			$data['nama_keg'] .= "<option value=\"".$val['fk_kegiatan_id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getCariRekeningBelanja(){
 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$tabel=$this->input->post('tabel');

 		$andWhere='';
 		if($tabel=='t_entri_lembur'){
 			$andWhere=" AND (nama_rek_belanja LIKE '%Lembur%')";
 		}


 		$que = "SELECT rb.id,kode_rek_belanja,nama_rek_belanja FROM ms_rekening_belanja rb INNER JOIN ms_kegiatan kb ON kb.id=rb.fk_kegiatan_id WHERE kb.tahun=$this->tahun AND kb.fk_bagian_id=$fk_bagian_id AND rb.fk_kegiatan_id=$fk_kegiatan_id $andWhere"; 	
 		$hasil = $this->db->query($que)->result_array();

 		$data['nama_rek'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hasil as $val) {
 			$data['nama_rek'] .= "<option value=\"".$val['id']."\">".$val['kode_rek_belanja'].' ['.$val['nama_rek_belanja'].']'."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getCariRekeningBelanjaDel(){
 		$tabel=$this->input->post('tabel');
 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
 		$bulan=$this->input->post('bulan');

 		$que = "SELECT DISTINCT rb.id,kode_rek_belanja,nama_rek_belanja FROM ms_rekening_belanja rb INNER JOIN t_rekap_dana rd ON rd.fk_rekening_belanja_id=rb.id WHERE dari_tabel='$tabel' AND rd.fk_kegiatan_id=$fk_kegiatan_id AND spj_bulan='$bulan'"; 	
 		$hasil = $this->db->query($que)->result_array();

 		$data['nama_rek'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hasil as $val) {
 			$data['nama_rek'] .= "<option value=\"".$val['id']."\">".$val['kode_rek_belanja'].' ['.$val['nama_rek_belanja'].']'."</option>\n";
 		}
 		echo json_encode($data);
 	}

	public function getCariDanaSblm(){
 		$id_rek=$this->input->post('id_rek');
 		$tabel=$this->input->post('tabel');
 		$bulan=$this->input->post('bulan');

 		$hsl = $this->db->query("SELECT anggaran,anggaran_per_perbup1,anggaran_per_perbup2,anggaran_per_perbup3,anggaran_per_perbup4,anggaran_pak,bts_anggaran_semester_1 FROM ms_rekening_belanja WHERE id=$id_rek")->row(); 		
 		$angg=$hsl->anggaran;
 		if(!empty($hsl->anggaran_per_perbup1)){
 			$angg=$hsl->anggaran_per_perbup1;
 		}
 		if(!empty($hsl->anggaran_per_perbup2)){
 			$angg=$hsl->anggaran_per_perbup2;
 		}
 		if(!empty($hsl->anggaran_per_perbup3)){
 			$angg=$hsl->anggaran_per_perbup3;
 		}
 		if(!empty($hsl->anggaran_per_perbup4)){
 			$angg=$hsl->anggaran_per_perbup4;
 		}
 		if(!empty($hsl->anggaran_pak)){
 			$angg=$hsl->anggaran_pak;
 		}
 		$data['anggaran']=number_format($angg);

 		$btsSmstr = $hsl->bts_anggaran_semester_1;
 		if(intval($bulan) >= 7){ // semester 2
 			$btsSmstr = $angg;
 		}
 		$data['bts_smster']=number_format($btsSmstr);

 		$hsl1 = $this->db->query("SELECT sum(pengajuan_sekarang) totPengajuanSblmPjd FROM t_pjd_dana where fk_rekening_belanja_id=$id_rek")->row();
 		$hsl2 = $this->db->query("SELECT id, sum(pengajuan_sekarang) totPengajuanSblm FROM t_rekap_dana where fk_rekening_belanja_id=$id_rek")->row();
 		$data['dana_sebelum']=number_format($hsl1->totPengajuanSblmPjd+$hsl2->totPengajuanSblm);

 		if($tabel=='t_kwitansi_hr'){
	 		$que = "SELECT sum(bpjs_kes_pemkab+bpjs_kes_peserta+bpjs_krj_jkk+bpjs_krj_jkm) pajak_bpjs, sum(((sub_total_bruto*jml_kali)*pajak_persen)/100) pajak_kegiatan FROM t_rekap_dana rd INNER JOIN $tabel h ON h.fk_rekap_dana_id=rd.id INNER JOIN t_kwitansi_hr_detail hd ON hd.fk_kwitansi_hr_id=h.id WHERE fk_rekening_belanja_id=$id_rek";
	 		$hsl3 = $this->db->query($que)->row();
	 		$data['pajak_bpjs']=!empty($hsl3->pajak_bpjs)?$hsl3->pajak_bpjs:0;
	 		$data['pajak_kegiatan']=!empty($hsl3->pajak_kegiatan)?$hsl3->pajak_kegiatan:0;
	 	}

	 	if($tabel=='t_kwitansi'){
	 		$que4="SELECT sum((IF(ppn IS NULL, 0, ppn))+(IF(pph_21 IS NULL, 0, pph_21))+(IF(pph_22 IS NULL, 0, pph_22))+(IF(pph_23 IS NULL, 0, pph_23))) tot_pajak_sebelum FROM t_rekap_dana rd INNER JOIN $tabel k ON k.fk_rekap_dana_id=rd.id WHERE fk_rekening_belanja_id=$id_rek";
	 		$hsl4 = $this->db->query($que4)->row();
	 		$que44="SELECT b.tgl_pesanan,sum(bd.qty_akhir * bd.harga_satuan_beli) tot_all,npwp FROM t_rekap_dana rd
					INNER JOIN pb_pesanan_barang b ON b.fk_rekap_dana_id=rd.id
					INNER JOIN pb_pesanan_barang_detail bd ON bd.fk_pesanan_barang_id=b.id
					INNER JOIN pb_ms_rekanan e ON e.id = b.fk_rekanan_id 
					WHERE fk_rekening_belanja_id=$id_rek;";
	 		$hsl44 = $this->db->query($que44)->row();
	 		$totAll=$hsl44->tot_all;
	 		$ppn=0; $nilaipph=0;
	 		if(!empty($totAll)){
                $ppn1=10;
				$PmbgiPpn1=110;
				$btsBlnja=1000000;
				if(strtotime($hsl44->tgl_pesanan) > strtotime(date('2022-03-31'))){
					$ppn1=11;
					$PmbgiPpn1=111;
					$btsBlnja=2000000;
				}
	 			//if($totAll >= $btsBlnja){ //lebih dari 1 juta / 2 juta
	                $ppn10Persen = $totAll*($ppn1/$PmbgiPpn1);
	                $ppn = $this->help->pembulatanSeratus(ceil($ppn10Persen));
	            //}
	           // if($totAll >= 2000000){ //lebih dari dua juta
	                if($hsl44->npwp=='' || $hsl44->npwp=='-'){ //tidak punya npwp
	                    $nilaipph = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(3/100)));
	                }else{
	                    $nilaipph = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(1.5/100)));
	                }
	            //}
	 		}
	 		$totPjkKwitansiATK = $hsl4->tot_pajak_sebelum+$ppn+$nilaipph;
	 		$data['pajak_sblm']= $totPjkKwitansiATK;
	 	}

	 	if($tabel=='t_rapat'){
	 		$que5="SELECT sum((IF(pajak_daerah IS NULL, 0, pajak_daerah))+(IF(pph_23 IS NULL, 0, pph_23))) tot_pajak_sebelum FROM t_rekap_dana rd INNER JOIN $tabel k ON k.fk_rekap_dana_id=rd.id WHERE fk_rekening_belanja_id=$id_rek";
	 		$hsl5 = $this->db->query($que5)->row();
	 		$data['pajak_rapat_sblm']=!empty($hsl5->tot_pajak_sebelum)?$hsl5->tot_pajak_sebelum:0;
	 	}

	 	if($tabel=='t_entri_lembur'){
	 		$que6="SELECT (uang_makan * sum(jml_makan)) jumlah,pph_23_persen FROM t_rekap_dana rd 
	 		INNER JOIN $tabel k ON k.fk_rekap_dana_id=rd.id 
	 		INNER JOIN t_entri_lembur_detail td ON td.fk_entri_lembur_id=k.id
	 		WHERE fk_rekening_belanja_id=$id_rek";
	 		$hsl6 = $this->db->query($que6)->row();
	 		$pjkDrh = $this->help->pembulatanSeratus(ceil($hsl6->jumlah*(10/100)));
            $nilaipph = $this->help->pembulatanSeratus(ceil(($hsl6->jumlah)*($hsl6->pph_23_persen/100)));
            $totPjk = $pjkDrh+$nilaipph;
            
            $data['pajak_lembur_sblm']=$totPjk;
	 	}

 		echo json_encode($data);
 	}

 	public function getCariBKU(){
 		$id_rek=$this->input->post('id_rek');
 		$bulan=$this->input->post('bulan');
 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
 		$del=$this->input->post('del');

 		$que = "SELECT id,info_no_bku FROM t_rekap_dana WHERE spj_bulan=$bulan AND fk_kegiatan_id=$fk_kegiatan_id AND fk_rekening_belanja_id=$id_rek"; 
 		$hasil = $this->db->query($que)->result_array();

 		$data['bku'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hasil as $val) {
 			if($del){
 				if(intval($val['info_no_bku']) == 0){
 					$data['bku'] .= "<option value=\"".$val['id']."\">".$val['info_no_bku']."</option>\n";
 				}
 			}
 			else{
 				$data['bku'] .= "<option value=\"".$val['id']."\">".$val['info_no_bku']."</option>\n";
 			}
 		}
 		echo json_encode($data);
 	}

	public function updateRekap(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->arrBagian();
		$data['url'] = base_url().'KwitansiHR/proses_update_rekap';
		$data['tabel']='t_kwitansi_hr';
		$data['judul']='Kwitansi HR';
		
		$this->template->load('Home/template','KwitansiHR/form_rekap',$data);
	}

 	public function get_dataUpdateRekap(){
		$tahun=$this->tahun;
 		$tabel=$this->input->post('tabel');
		$data['tabel']=$tabel;
		$fk_bagian_id=$this->input->post('fk_bagian_id');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$data['updateRkp']=true;

		if($tabel=='t_kwitansi_hr'){
			$queB = "SELECT DISTINCT t.*,sum((sub_total_bruto*jml_kali)+bpjs_kes_pemkab+bpjs_krj_jkk+bpjs_krj_jkm) total_akhir_all FROM $tabel t
 				JOIN t_kwitansi_hr_detail td ON td.fk_kwitansi_hr_id=t.id
 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND is_spj='0'
 				GROUP BY t.id
 				ORDER BY t.hr_bulan, t.tgl_kwitansi"; 	
 			$data['is_kwi_hr']='yes';
 		}	
 		if($tabel=='t_kwitansi'){ 			
			$kategori=$this->input->post('kategori');
			// if($kategori=='lainnya'){
			// 	$kategori='Jasa Lainnya/ Jasa Konsultansi/ Pekerjaan Kontruksi';
			// }
 			$data['is_kwi_hr']='no';
 			$queB = "SELECT id,tgl_kwitansi,untuk_pembayaran,kegiatan,banyaknya_uang total_akhir_all FROM $tabel t
 				WHERE tahun='$tahun' AND jenis_belanja LIKE '%$kategori%' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND is_spj='0'
 				GROUP BY t.id
 				ORDER BY tgl_kwitansi";
 		}	
 		if($tabel=='t_rapat'){
 			$queB = "SELECT id,tgl,hari,pukul,tempat,acara,tgl_kwitansi,kegiatan,total total_akhir_all FROM $tabel t
 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND is_spj='0'
 				GROUP BY t.id
 				ORDER BY tgl_kwitansi"; 
 		}
 		if($tabel=='t_entri_lembur'){
 			$queB = "SELECT t.id,tgl_surat_tugas,perihal,tgl_kegiatan_dari,tgl_kegiatan_sampai,kegiatan,(uang_makan * sum(jml_makan))total_akhir_all FROM $tabel t
 				INNER JOIN t_entri_lembur_detail td ON td.fk_entri_lembur_id=t.id
 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND is_spj='0'
 				GROUP BY t.id
 				ORDER BY tgl_surat_tugas"; 
 		}		
 		$data['hasil'] = $this->db->query($queB)->result_array();
		$this->load->view('KwitansiHR/gridDataUpdateRekap',$data);
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
			redirect('KwitansiHR/updateRekap');
		}

		$driTabel = 't_kwitansi_hr';
		$qwe = "SELECT id FROM $driTabel WHERE id in ($plh2) ORDER BY tgl_kwitansi";
		$dtl = $this->db->query($qwe)->result();

		$noBaru = '1';
		$this->db->trans_start();		
			$jml_dana=str_replace(',', '', $this->input->post('jml_dana'));
			$pengajuan_sebelum=str_replace(',', '', $this->input->post('pengajuan_sebelum'));
			$pengajuan_sekarang=str_replace(',', '', $this->input->post('pengajuan_sekarang'));
			$sisa_kas=str_replace(',', '', $this->input->post('sisa_kas'));
			$pajak_bpjs=$this->input->post('tot_pajak_bpjs');
			$pajak_kegiatan=$this->input->post('tot_pajak_kegiatan');
			$user_act = $this->session->id;
			$time_act = date('Y-m-d H:i:s');
			$que = "insert into t_rekap_dana (dari_tabel,spj_bulan,fk_bagian_id,fk_kegiatan_id,fk_rekening_belanja_id,info_no_bku,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,pajak_bpjs,pajak_kegiatan,user_act,time_act)
				values('$driTabel','$bulan',$fk_bagian_id,$fk_kegiatan_id,$fk_rekening_belanja_id,'$no_bku',$jml_dana,$pengajuan_sebelum,$pengajuan_sekarang,$sisa_kas,$pajak_bpjs,$pajak_kegiatan,$user_act,'$time_act')";
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
		
		redirect('KwitansiHR');
	}

	public function deleteRekap(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->arrBagian();
		$data['url'] = base_url().'KwitansiHR/proses_delete_rekap';
		$data['tabel']='t_kwitansi_hr';
		$data['judul']='Kwitansi HR';
		
		$this->template->load('Home/template','KwitansiHR/form_rekap_delete',$data);
	}

	public function get_dataDeleteRekap(){
		$tahun=$this->tahun;
 		$tabel=$this->input->post('tabel');
		$data['tabel']=$tabel;
		$id_rekap_dana=$this->input->post('id_rekap_dana');
		$data['updateRkp']=false;

		if($tabel=='t_kwitansi_hr'){
			$queB = "SELECT DISTINCT t.*,sum((sub_total_bruto*jml_kali)+bpjs_kes_pemkab) total_akhir_all FROM $tabel t
 				JOIN t_kwitansi_hr_detail td ON td.fk_kwitansi_hr_id=t.id
 				WHERE tahun='$tahun' AND fk_rekap_dana_id=$id_rekap_dana
 				GROUP BY t.id
 				ORDER BY no_kwitansi_rekap"; 
 			$data['is_kwi_hr']='yes';
 		}
 		if($tabel=='t_kwitansi'){
 			$data['is_kwi_hr']='no';
 			$queB = "SELECT id,tgl_kwitansi,untuk_pembayaran,kegiatan,banyaknya_uang total_akhir_all FROM $tabel t
 				WHERE tahun='$tahun' AND fk_rekap_dana_id=$id_rekap_dana
 				GROUP BY t.id
 				ORDER BY no_kwitansi_rekap"; 
 		}
 		if($tabel=='t_rapat'){
 			$queB = "SELECT id,tgl,hari,pukul,tempat,acara,tgl_kwitansi,kegiatan,total total_akhir_all FROM $tabel t
 				WHERE tahun='$tahun' AND fk_rekap_dana_id=$id_rekap_dana
 				GROUP BY t.id
 				ORDER BY no_kwitansi_rekap"; 
 		}		
 		if($tabel=='t_entri_lembur'){
 			$queB = "SELECT t.id,tgl_surat_tugas,perihal,tgl_kegiatan_dari,tgl_kegiatan_sampai,kegiatan,(uang_makan * sum(jml_makan))total_akhir_all FROM $tabel t
 				INNER JOIN t_entri_lembur_detail td ON td.fk_entri_lembur_id=t.id
 				WHERE tahun='$tahun' AND fk_rekap_dana_id=$id_rekap_dana
 				GROUP BY t.id
 				ORDER BY no_kwitansi_rekap";
 		}	
 		$data['hasil'] = $this->db->query($queB)->result_array();
		$this->load->view('KwitansiHR/gridDataUpdateRekap',$data);
	}

	public function proses_delete_rekap(){
		$id_rekap_dana=$this->input->post('id_rekap_dana');
		$cek=$this->db->query("SELECT status_pengajuan_dana FROM t_rekap_dana WHERE id=$id_rekap_dana")->row();
		if($cek->status_pengajuan_dana==1){
			$this->session->set_flashdata('error', 'Data sudah dilakukan Pengajuan Dana.');
			redirect('KwitansiHR');
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
			$this->db->update('t_kwitansi_hr', $data);

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

		redirect('KwitansiHR');
	}

	public function updateBKU(){
		$id_rekap_dana = $this->input->post('id_rekap_dana');
		$no_bku = $this->input->post('no_bku');
		$formnya = $this->input->post('formnya');

		if($formnya=='Lembur'){
			$tabel='t_entri_lembur';
		}
		if($formnya=='Rapat'){
			$tabel='t_rapat';
		}
		if($formnya=='Kwitansi'){
			$tabel='t_kwitansi';
		}
		if($formnya=='KwitansiHR'){
			$tabel='t_kwitansi_hr';
		}		

		$this->db->trans_start();

		    $data = array(
			        'info_no_bku' => $no_bku,
			);
			$this->db->where('id', $id_rekap_dana);
			$this->db->update('t_rekap_dana', $data);

			$data2 = array(
			        'no_bku' => $no_bku,
			);
			$this->db->where('fk_rekap_dana_id', $id_rekap_dana);
			$this->db->update($tabel, $data2);
		   	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal dihapus.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data TBP Berhasil diupdate.');
		}

		redirect($formnya);
	}

	public function cetakKwi($id){
		$hsl = $this->MKwitansiHr->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bag'] = $this->db->query("SELECT nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$form = '';
		if($hsl[0]['kategori']=='KEGIATAN' || $hsl[0]['kategori']=='NARASUMBER'){
			$form = 'KwitansiHR/cetakKwitansiKegiatan';
			$que = $this->db->query("select sum(sub_total_bruto*jml_kali) total_bruto from t_kwitansi_hr_detail where fk_kwitansi_hr_id=$id")->row();
		}
		if($hsl[0]['kategori']=='KONTRAK'){
			$form = 'KwitansiHR/cetakKwitansiKontrak';
			$que = $this->db->query("select sum(penghasilan_kotor) total_bruto from t_kwitansi_hr_detail where fk_kwitansi_hr_id=$id")->row();
		}
		$data['total_bruto'] = $que->total_bruto;	

		$data['detail'] = $this->db->query("select * from t_kwitansi_hr_detail where fk_kwitansi_hr_id=$id")->result();

		$html=$this->load->view($form,$data,true);
		$title = 'Kwitansi HR';
		
		// echo $html;
		$this->pdf($title,$html,$this->help->folio_L());
	}

	public function cekKategori(){
 		$id=$_POST['id'];
 		$hsl = $this->MKwitansiHr->get(array('id'=>$id));

 		$data['kategori']=$hsl[0]['kategori'];
 		echo json_encode($data);
 	}

	public function cetakDHKontrak(){
		$id=$_GET['id'];
		$hsl = $this->MKwitansiHr->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bag'] = $this->db->query("SELECT nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$kalender = CAL_GREGORIAN;
		$bulan=$hsl[0]['hr_bulan'];
		$tahun=$hsl[0]['tahun'];

		$jml = cal_days_in_month($kalender, $bulan, $tahun);
		$hariArr=array();
		for ($i=1; $i <= $jml ; $i++) { 
			$tgl=$i.'-'.$bulan.'-'.$tahun;
			$hari=$this->help->namaHari($tgl);
			if($hari!='Minggu' && $hari!='Sabtu'){
				$hariArr[$i]=$hari;
			}
		}
		$data['hariArr']=$hariArr;
		$data['tglAkhir']=$jml;
		$data['nama_bulan']=$this->help->namaBulan($bulan);
		$data['tahun']=$tahun;

		$data['detail'] = $this->db->query("select nama from t_kwitansi_hr_detail where fk_kwitansi_hr_id=$id")->result();

		$html=$this->load->view('KwitansiHR/cetakDftrHadirKontrak',$data,true);
		$title = 'Daftar Hadir HR';
		
		// echo $html;
		$this->pdf($title,$html,$this->help->folio_L());
	}

	public function cetakRekap(){		
		$id_rekap_dana=$this->input->post('id_rekap_dana');

		$data['tgl_rekap']=$this->input->post('tgl_rekap');
		$que = "SELECT rd.id,k.id id_kwi_hr,k.no_bku,k.spj_bulan,CONCAT(k.singkatan_bagian,'.',k.singkatan_kegiatan) singkat_keg,tahun,kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_pa,nip_pejabat_pa
		,nama_pejabat_kpa,nip_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_bpjs,pajak_kegiatan,k.kategori
			FROM t_rekap_dana rd INNER JOIN t_kwitansi_hr k ON k.fk_rekap_dana_id=rd.id 
			INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id
			WHERE rd.id=$id_rekap_dana";
		$hsl = $this->db->query($que)->row();
		$data['hasil'] = $hsl;

		$qweDtl = "SELECT tgl_kwitansi,no_bku,no_kwitansi_rekap,untuk_pembayaran,sum((sub_total_bruto*jml_kali)+bpjs_kes_pemkab+bpjs_krj_jkk+bpjs_krj_jkm) tot_bruto,sum(bpjs_kes_pemkab) tot_bpjs_kes_pemkab,sum(bpjs_krj_jkk) tot_bpjs_krj_jkk,sum(bpjs_krj_jkm) tot_bpjs_krj_jkm,sum(bpjs_kes_peserta) tot_bpjs_kes_peserta,sum(((sub_total_bruto*jml_kali)*pajak_persen)/100) tot_pajak_kegiatan FROM t_kwitansi_hr_detail hd INNER JOIN t_kwitansi_hr h ON h.id=hd.fk_kwitansi_hr_id WHERE fk_rekap_dana_id=$id_rekap_dana GROUP BY h.id ORDER BY no_kwitansi_rekap";
		$data['detail'] = $this->db->query($qweDtl)->result();

		$html=$this->load->view('KwitansiHR/cetakRekap',$data,true);
		$title = 'Kwitansi HR';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}
	
	protected function pdf($title,$html,$page,$batas=false){
		// echo $html;
		if($batas){
			$mpdf = new mPDF('utf-8', $page);
		}else{
        	$mpdf = new mPDF('utf-8', $page, 0, '', 8, 8, 8, 8, 5, 5);
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
