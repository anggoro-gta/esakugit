<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pjd extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		$this->load->model('MPjd');
		$this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsRekeningBelanja');
		$this->load->model('MMsHariLibur');
		$this->load->model('MEntriGu');
		$this->load->model('MMsDpa');
		$this->load->model('MPjdTransportHotel');
		$this->load->model('MPjdTransportLokal');
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
		$this->template->load('Home/template','Pjd/list',$data);
	}

	public function getKegiatan(){
 		$fk_bagian_id=$_POST['fk_bagian_id'];
 		$fk_program_id=$_POST['fk_program_id'];
 		$fk_kegiatan_id=$_POST['fk_kegiatan_id'];
 		$keg = $this->MMsKegiatan->get(array('fk_bagian_id'=>$fk_bagian_id,'fk_program_id'=>$fk_program_id,'tahun'=>$this->tahun));

 		$data['kegiatan'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$keg as $val) {
 			$selected = $val['id']==$fk_kegiatan_id?'selected':'';
 			$data['kegiatan'] .= "<option $selected value=\"".$val['id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getRekBelanja(){
 		$fk_kegiatan_id=$_POST['fk_kegiatan_id'];
 		$fk_rekening_belanja_id=$_POST['fk_rekening_belanja_id'];
 		$rek = $this->MMsRekeningBelanja->get(array('fk_kegiatan_id'=>$fk_kegiatan_id));

 		$data['rek_belanja'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$rek as $val) {
 			$selected = $val['id']==$fk_rekening_belanja_id?'selected':'';
 			$data['rek_belanja'] .= "<option $selected value=\"".$val['id']."\">".$val['kode_rek_belanja'].' ('.$val['nama_rek_belanja'].')'."</option>\n";
 		}
 		echo json_encode($data);
 	}

	public function getListDetail(){
		$data['no_surat_tugas'] = $this->input->post('no_surat_tugas');
		$data['bulan'] = $this->input->post('bulan');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');
		$data['kategori'] = $this->input->post('kategori');

		$formnya = 'Pjd/listDetail';
		// if($this->level=='1'){
		// 	$formnya = 'Pjd/listDetailUji';
		// }

		$this->load->view($formnya,$data);
	}

	public function namaBndhraPmbntu(){
 		$fk_bagian_id=$_POST['fk_bagian_id'];
 		$bndhra_pembntu=$_POST['bndhra_pembntu'];

 		$hsl = $this->db->query("SELECT nama,nip FROM ms_sdm WHERE fk_bagian_id=$fk_bagian_id AND bendahara_pembantu=1 ")->result();

 		$data['hasil'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hsl as $val) {
 			$selected = $val->nama==$bndhra_pembntu?'selected':'';
 			$data['hasil'] .= "<option $selected value=\"".$val->nama.'_'.$val->nip."\">".$val->nama."</option>\n";
 		}
 		echo json_encode($data);
 	}

	public function getDatatables(){
		header('Content-Type: application/json');

        $tahun = $this->tahun;
		$no_surat_tugas = $this->input->post('no_surat_tugas');
		$bulan = $this->input->post('bulan');
		$fk_bagian_id = $this->input->post('fk_bagian_id');
		$fk_program_id = $this->input->post('fk_program_id');
		$fk_kegiatan_id = $this->input->post('fk_kegiatan_id');
		$kategori = $this->input->post('kategori');

		$this->datatables->where('t_pjd.tahun',$tahun);
		if($no_surat_tugas){
			$this->datatables->where('t_pjd.no_surat_tugas',$no_surat_tugas);
		}
		if($bulan){
			// $this->datatables->where('MONTH(t_pjd.tgl_berangkat)',$bulan);
			$this->datatables->where('t_pjd.bulan',$bulan);
		}
		if($fk_bagian_id){
			$this->datatables->where('t_pjd.fk_bagian_id',$fk_bagian_id);
		}
		if($fk_program_id){
			$this->datatables->where('t_pjd.fk_program_id',$fk_program_id);
		}
		if($fk_kegiatan_id){
			$this->datatables->where('t_pjd.fk_kegiatan_id',$fk_kegiatan_id);
		}
		if($kategori){
			$this->datatables->where('t_pjd.kategori',$kategori);
		}
        $this->datatables->select('t_pjd.id,tahun,bulan,nama_bagian,t_pjd.kategori,no_surat_tugas,count(t_pjd_detail.id) total_pjd,t_pjd_detail.no_kwitansi,t_pjd_dana.info_no_bku,kota,tujuan_skpd,acara,alat_transportasi,jenis_pjd,fk_pjd_dana_id,nama_program,kegiatan,nama_rek_belanja');
        $this->datatables->select("DATE_FORMAT(tgl_surat_tugas, '%d/%m/%Y') AS tgl_surat_tugas", FALSE);
        $this->datatables->select("DATE_FORMAT(tgl_berangkat, '%d/%m/%Y') AS tgl_berangkat", FALSE);
        $this->datatables->select("DATE_FORMAT(tgl_tiba, '%d/%m/%Y') AS tgl_tiba", FALSE);
        $this->datatables->from("t_pjd");
        $this->datatables->join('t_pjd_detail','t_pjd_detail.fk_pjd_id=t_pjd.id','left');
        $this->datatables->join('t_pjd_dana','t_pjd_dana.id=t_pjd.fk_pjd_dana_id','left');
        $this->datatables->join('ms_rekening_belanja','ms_rekening_belanja.id=t_pjd_dana.fk_rekening_belanja_id','left');
        $this->datatables->group_by('fk_pjd_id');
        $this->db->order_by("t_pjd.tgl_surat_tugas,t_pjd.tgl_berangkat", "desc");
        echo $this->datatables->generate();
	}

	public function create(){
		$Bagian=null;
		if($this->level!='1'){
			$Bagian=$this->fkBagianId;
		}
		$data = array(
			'button' => 'Simpan',
			'kategori' => set_value('kategori'),
			'jenis_pjd' => set_value('jenis_pjd'),
			'fk_sub_kategori_id' => set_value('fk_sub_kategori_id'),
			'tahun' => set_value('tahun',$this->tahun),
			'bulan' => set_value('bulan'),
			'asal_surat_tugas' => set_value('asal_surat_tugas','Dalam'),
			'no_surat_tugas' => set_value('no_surat_tugas'),
			'tgl_surat_tugas' => set_value('tgl_surat_tugas'),
			'dasar_surat_tugas' => set_value('dasar_surat_tugas'),
			'kota' => set_value('kota'),
			'tujuan_skpd' => set_value('tujuan_skpd'),
			'alat_transportasi' => set_value('alat_transportasi'),
			'acara' => set_value('acara'),
			'tgl_berangkat' => set_value('tgl_berangkat'),
			'tgl_tiba' => set_value('tgl_tiba'),
			'tgl_rincian' => set_value('tgl_rincian'),
			'nama_ttd_surat_tugas' => set_value('nama_ttd_surat_tugas'),
			'jabatan_ttd_surat_tugas' => set_value('jabatan_ttd_surat_tugas'),
			'nama_ttd_sppd' => set_value('nama_ttd_sppd'),
			'jabatan_ttd_sppd' => set_value('jabatan_ttd_sppd'),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa'),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa'),
			'nama_bendahara' => set_value('nama_bendahara'),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu'),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk'),
			'fk_bagian_id' => set_value('fk_bagian_id',$Bagian),
			'fk_program_id' => set_value('fk_program_id'),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id'),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id'),
			'is_uang_harian' => set_value('is_uang_harian'),
			'is_transport' => set_value('is_transport'),
			'is_penginapan' => set_value('is_penginapan'),
			'is_kontribusi' => set_value('is_kontribusi'),
			'jml_hari' => set_value('jml_hari'),
			'tgl_tengah_1' => set_value('tgl_tengah_1'),
			'tgl_tengah_2' => set_value('tgl_tengah_2'),
			'tgl_tengah_3' => set_value('tgl_tengah_3'),
			'tgl_tengah_4' => set_value('tgl_tengah_4'),
			'tgl_tengah_5' => set_value('tgl_tengah_5'),
			'tgl_tengah_6' => set_value('tgl_tengah_6'),
			'tgl_tengah_7' => set_value('tgl_tengah_7'),
			'tgl_tengah_8' => set_value('tgl_tengah_8'),
			'id' => set_value('id'),
		);

		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->arrBagian();
		// $data['arrTtd'] = $this->help->ttd_atasan();
		$data['arrPA'] = $this->help->ttd_pa();
		$data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['arrPPTK'] = $this->help->ttd_pptk();
		// $data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1));

		$formnya = 'Pjd/formBaru';
		// if($this->level=='1'){
		// 	$formnya = 'Pjd/formBaruUji';
		// }

		$this->template->load('Home/template',$formnya,$data);
	}

	public function update($id){
		// $cek = $this->MPjd->getDetail(array('fk_pjd_id'=>$id));
		// if($cek[0]['no_kwitansi']){
		// 	show_404();
		// }

		$hsl = $this->MPjd->get(array('id'=>$id));
		$hsl = $hsl[0];

		$fkBagian=$hsl['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data = array(
			'button' => 'Update',
			'kategori' => set_value('kategori',$hsl['kategori']),
			'jenis_pjd' => set_value('jenis_pjd',$hsl['jenis_pjd']),
			'fk_sub_kategori_id' => set_value('fk_sub_kategori_id',$hsl['fk_sub_kategori_id']),
			'tahun' => set_value('tahun',$hsl['tahun']),
			'bulan' => set_value('bulan',$hsl['bulan']),
			'asal_surat_tugas' => set_value('asal_surat_tugas',$hsl['asal_surat_tugas']),
			'no_surat_tugas' => set_value('no_surat_tugas',$hsl['no_surat_tugas']),
			'tgl_surat_tugas' => set_value('tgl_surat_tugas',$this->help->ReverseTgl($hsl['tgl_surat_tugas'])),
			'dasar_surat_tugas' => set_value('dasar_surat_tugas',$hsl['dasar_surat_tugas']),
			'kota' => set_value('kota',$hsl['kota']),
			'tujuan_skpd' => set_value('tujuan_skpd',$hsl['tujuan_skpd']),
			'alat_transportasi' => set_value('alat_transportasi',$hsl['alat_transportasi']),
			'acara' => set_value('acara',$hsl['acara']),
			'tgl_berangkat' => set_value('tgl_berangkat',$this->help->ReverseTgl($hsl['tgl_berangkat'])),
			'tgl_tiba' => set_value('tgl_tiba',$this->help->ReverseTgl($hsl['tgl_tiba'])),
			'tgl_rincian' => set_value('tgl_rincian',$this->help->ReverseTgl($hsl['tgl_rincian'])),
			'nama_ttd_surat_tugas' => set_value('nama_ttd_surat_tugas',$hsl['nama_ttd_surat_tugas']),
			'jabatan_ttd_surat_tugas' => set_value('jabatan_ttd_surat_tugas',$hsl['jabatan_ttd_surat_tugas']),
			'nama_ttd_sppd' => set_value('nama_ttd_sppd',$hsl['nama_ttd_sppd']),
			'jabatan_ttd_sppd' => set_value('jabatan_ttd_sppd',$hsl['jabatan_ttd_sppd']),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa',$hsl['nama_pejabat_pa']),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa',$hsl['nama_pejabat_kpa']),
			'nama_bendahara' => set_value('nama_bendahara',$hsl['nama_bendahara']),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu',$hsl['nama_bendahara_pembantu']),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk',$hsl['nama_pejabat_pptk']),
			'fk_bagian_id' => set_value('fk_bagian_id',$hsl['fk_bagian_id']),
			'fk_program_id' => set_value('fk_program_id',$hsl['fk_program_id']),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id',$hsl['fk_kegiatan_id']),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id',$hsl['fk_rekening_belanja_id']),
			'is_uang_harian' => set_value('is_uang_harian',$hsl['is_uang_harian']),
			'is_transport' => set_value('is_transport',$hsl['is_transport']),
			'is_penginapan' => set_value('is_penginapan',$hsl['is_penginapan']),
			'is_kontribusi' => set_value('is_kontribusi',$hsl['is_kontribusi']),
			'jml_hari' => set_value('jml_hari',$hsl['jml_hari']),
			'tgl_tengah_1' => set_value('tgl_tengah_1',$this->help->ReverseTgl($hsl['tgl_tengah_1'])),
			'tgl_tengah_2' => set_value('tgl_tengah_2',$this->help->ReverseTgl($hsl['tgl_tengah_2'])),
			'tgl_tengah_3' => set_value('tgl_tengah_3',$this->help->ReverseTgl($hsl['tgl_tengah_3'])),
			'tgl_tengah_4' => set_value('tgl_tengah_4',$this->help->ReverseTgl($hsl['tgl_tengah_4'])),
			'tgl_tengah_5' => set_value('tgl_tengah_5',$this->help->ReverseTgl($hsl['tgl_tengah_5'])),
			'tgl_tengah_6' => set_value('tgl_tengah_6',$this->help->ReverseTgl($hsl['tgl_tengah_6'])),
			'tgl_tengah_7' => set_value('tgl_tengah_7',$this->help->ReverseTgl($hsl['tgl_tengah_7'])),
			'tgl_tengah_8' => set_value('tgl_tengah_8',$this->help->ReverseTgl($hsl['tgl_tengah_8'])),
			'id' => set_value('id',$id),
		);

		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->arrBagian();
		// $data['arrTtd'] = $this->help->ttd_atasan();
		$data['arrPA'] = $this->help->ttd_pa();
		$data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['arrPPTK'] = $this->help->ttd_pptk();
		$data['arrPjd'] = $this->MPjd->get((array('id'=>$id)));
		$data['arrPjdDetail'] = $this->MPjd->getDetail((array('fk_pjd_id'=>$id)));
		// $data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1));

		$formnya = 'Pjd/formBaru';
		// if($this->tahun=='2020'){
		// 	$formnya = 'Pjd/form';
		// }

		$this->template->load('Home/template',$formnya,$data);
	}

	public function getTtdSt(){
 		$nama_ttd_surat_tugas=$_POST['nama_ttd_surat_tugas'];
 		$fk_bagian_id=$_POST['fk_bagian_id'];

 		$hsl = $this->help->ttd_atasan($fk_bagian_id);

 		$data['arrTtdSt'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hsl as $val2) {	
 			$jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
 			$selected = $nama_ttd_surat_tugas==$val2->nama?'selected':'';	
 			$data['arrTtdSt'] .= "<option $selected value=\"".$val2->nama.'_'.$val2->nip.'_'.$val2->gol_pangkat.'_'.$jbtn.'_'.$val2->urut_ttd.'_'.$val2->gol_pangkat_baru.'_'.$val2->tmt_gol_pangkat_baru."\">".$val2->nama.' ['.$jbtn.']'."</option>\n"; 			
	 	}

 		echo json_encode($data);
 	}

	public function getKpa(){
 		$nama_pejabat_kpa=$_POST['nama_pejabat_kpa'];
 		$fk_bagian_id=$_POST['fk_bagian_id'];

 		$hsl = $this->help->ttd_kpa($fk_bagian_id);

 		$data['arrKpa'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hsl as $val2) {	
 			$jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
 			$selected = $nama_pejabat_kpa==$val2->nama?'selected':'';	
 			$data['arrKpa'] .= "<option $selected value=\"".$val2->nama.'_'.$val2->nip.'_'.$jbtn."\">".$val2->nama.' ['.$jbtn.']'."</option>\n"; 			
	 	}

 		echo json_encode($data);
 	}

 	public function getPptk(){
 		$nama_pejabat_pptk=$_POST['nama_pejabat_pptk'];
 		$fk_bagian_id=$_POST['fk_bagian_id'];

 		$hsl = $this->help->ttd_pptk($fk_bagian_id);

 		$data['arrPptk'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hsl as $val2) {	
 			$jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
 			$selected = $nama_pejabat_pptk==$val2->nama?'selected':'';	
 			$data['arrPptk'] .= "<option $selected value=\"".$val2->nama.'_'.$val2->nip.'_'.$jbtn."\">".$val2->nama.' ['.$jbtn.']'."</option>\n"; 			
	 	}

 		echo json_encode($data);
 	}

	public function getNamaPegawai(){
 		$fk_bagian_id=$_POST['fk_bagian_id'];

 		$hsl = $this->help->namaSdm(array('status'=>1),$fk_bagian_id);

 		$data['arrPegawai'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hsl as $val) {	
 			$jbtn = ($val['jabatan_baru']==' ')?$val['jabatan']:$val['jabatan_baru'];	
 			$data['arrPegawai'] .= "<option value=\"".$val['id']."\">".$val['nama'].' ['.$jbtn.'] - ('.$val['nama_bagian'].')'."</option>\n"; 			
	 	}

 		echo json_encode($data);
 	}

	public function cekTglLibur(){
		$tgl_berangkat = $this->help->ReverseTgl($this->input->post('tgl_berangkat'));
		$tgl_tiba = $this->help->ReverseTgl($this->input->post('tgl_tiba'));
		$hsl ='sukses';
		foreach ($this->MMsHariLibur->get() as $val) {
			if($val['tanggal']==$tgl_berangkat){
				$hsl = 'Tanggal Berangkat '.$this->input->post('tgl_berangkat').' Adalah '.$val['keterangan'];
			}
		}

		if($hsl=='sukses'){
			foreach ($this->MMsHariLibur->get() as $val) {
				if($val['tanggal']==$tgl_tiba){
					$hsl = 'Tanggal Tiba '.$this->input->post('tgl_tiba').' Adalah '.$val['keterangan'];
				}
			}
		}
		$data['hasil'] = $hsl;
		echo json_encode($data);
	}

	public function getKota(){
 		$fk_sub_kategori_id=$_POST['fk_sub_kategori_id'];
 		$kota=$_POST['kota'];

 		$sb = $this->db->query("SELECT * FROM ms_sub_kategori_pjd WHERE id='$fk_sub_kategori_id' ")->row();

 		$data['arrKota'] = "<option value=''>Pilih</option>\n";
 		if($sb->kategori=='DD'){
 			// $selected = $kota=='KEDIRI'?'selected':'';	
 			$data['arrKota'] .= "<option selected value='KEDIRI'>KEDIRI</option>\n";
 		}
 		else{
 			$lokasi = str_replace(' ', '', explode(',', $sb->lokasi));
	 		foreach ((array)$lokasi as $val) {
	 			$selected = $val==$kota?'selected':'';		
	 			$data['arrKota'] .= "<option $selected value=\"".$val."\">".$val."</option>\n";
	 		}
	 	}

 		echo json_encode($data);
 	}

 	public function getFormDetailPjd(){
 		$data['cbx_uang_harian']=$_POST['cbx_uang_harian'];
 		$data['cbx_transport']=$_POST['cbx_transport'];
 		$data['cbx_penginapan']=$_POST['cbx_penginapan'];
 		
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1));

 		echo $this->load->view('Pjd/form_detail_pjd',$data);
 	}

 	public function getTarifPjd(){
 		$id=$_POST['id'];
 		$fk_sub_kategori_id=$_POST['fk_sub_kategori_id'];
 		$tgl_berangkat=$this->help->ReverseTgl($_POST['tgl_berangkat']);

 		$sdm = $this->db->query("SELECT eselon,eselon_baru,status_pegawai FROM v_sdm WHERE id=$id ")->row();

 		$eselon = $sdm->eselon;
 		if($sdm->eselon_baru){
 			$eselon = $sdm->eselon_baru;
 		}

 		if($fk_sub_kategori_id==7){ //DD1 (semua)
			$andWhere = " AND eselon='Semua' ";
 		}else{
 			$andWhere = " AND eselon='".$eselon."' AND pegawai='".$sdm->status_pegawai."' ";
 		}
 		// die(var_dump("SELECT tarif,tarif_baru,tarif_representasi FROM ms_sub_kategori_tarif_pjd WHERE fk_sub_kategori_id='$fk_sub_kategori_id' $andWhere"));
 		$trf = $this->db->query("SELECT tarif,tarif_baru,tarif_representasi FROM ms_sub_kategori_tarif_pjd WHERE fk_sub_kategori_id='$fk_sub_kategori_id' $andWhere")->row();

 		$tarifnya = $trf->tarif;
 		// if(strtotime($tgl_berangkat) >= strtotime(date('2018-10-17'))){
 		// 	$tarifnya = $trf->tarif_baru;
 		// }
		$data['trfnya'] = number_format($tarifnya); 	

		$data['rpresntsi'] = empty($trf->tarif_representasi)?'':number_format($trf->tarif_representasi);

 		echo json_encode($data);
 	}

 	public function getTarifPjdBaru(){
 		$id=$_POST['id'];
 		$kategori=$_POST['kategori'];
 		$jenis_pjd=$_POST['jenis_pjd'];
 		$fk_sub_kategori_id=$_POST['fk_sub_kategori_id'];

 		$sdm = $this->db->query("SELECT eselon,eselon_baru FROM v_sdm WHERE id=$id ")->row();

 		$eselon = $sdm->eselon;
 		if($sdm->eselon_baru){
 			$eselon = $sdm->eselon_baru;
 		}
 	
 		$trf = $this->db->query("SELECT * FROM ms_tarif_provinsi WHERE  id=$fk_sub_kategori_id")->row();

 		$tarifnya = $trf->tarif_dd; //kategori DD
 		if($kategori=='DL'){ //koordinasi DL
 			$tarifnya = $trf->tarif_dl;
 		}
 		if($jenis_pjd=='Undangan/Rapat' && $kategori=='DL'){
 			// $tarifnya = '200000'; //undangan rapat DL
 			$tarifnya = $trf->tarif_dl;
 		}
 		if($jenis_pjd=='Diklat'){
 			$tarifnya = $trf->tarif_diklat;
 		}
 		if($jenis_pjd=='Fullboard'){
 			$tarifnya = $trf->tarif_fullboard;
 		}
 		if($jenis_pjd=='Bimtek'){
 			$tarifnya = $trf->tarif_bimtek;
 		}
		$data['trfnya'] = number_format($tarifnya); 

		$trfRpresntsi = '';
		// if($eselon=='2B'){
			$trfRep = $this->db->query("SELECT tarif FROM ms_tarif_representasi WHERE eselon='$eselon' AND kategori='$kategori'")->row();
			if(isset($trfRep)){
				$trfRpresntsi = number_format($trfRep->tarif);
			}
		// }

		$data['rpresntsi'] = $trfRpresntsi;

 		echo json_encode($data);
 	}

	public function cekNamaSdhAda($id_sdm,$tgl_berangkat,$tgl_tiba,$tglTngh1,$tglTngh2,$tglTngh3,$tglTngh4,$tglTngh5,$tglTngh6,$tglTngh7,$tglTngh8){
		$ql="select t.id,t.kategori,t.no_surat_tugas,nama_sdm,nama_bagian,bulan,kegiatan from t_pjd_detail td 
			join t_pjd t on t.id=td.fk_pjd_id
			where td.fk_sdm_id=$id_sdm AND (
				tgl_berangkat='$tgl_berangkat' OR tgl_berangkat='$tgl_tiba' OR tgl_berangkat='$tglTngh1' OR tgl_berangkat='$tglTngh2' OR tgl_berangkat='$tglTngh3' OR tgl_berangkat='$tglTngh4' OR tgl_berangkat='$tglTngh5' OR tgl_berangkat='$tglTngh6' OR tgl_berangkat='$tglTngh7' OR tgl_berangkat='$tglTngh8'
				OR tgl_tiba='$tgl_berangkat' OR tgl_tiba='$tgl_tiba' OR tgl_tiba='$tglTngh1' OR tgl_tiba='$tglTngh2' OR tgl_tiba='$tglTngh3' OR tgl_tiba='$tglTngh4' OR tgl_tiba='$tglTngh5' OR tgl_tiba='$tglTngh6' OR tgl_tiba='$tglTngh7' OR tgl_tiba='$tglTngh8'
				OR tgl_tengah_1='$tgl_berangkat' OR tgl_tengah_1='$tgl_tiba' OR tgl_tengah_1='$tglTngh1' OR tgl_tengah_1='$tglTngh2' OR tgl_tengah_1='$tglTngh3' OR tgl_tengah_1='$tglTngh4' OR tgl_tengah_1='$tglTngh5' OR tgl_tengah_1='$tglTngh6' OR tgl_tengah_1='$tglTngh7' OR tgl_tengah_1='$tglTngh8' 
				OR tgl_tengah_2='$tgl_berangkat' OR tgl_tengah_2='$tgl_tiba' OR tgl_tengah_2='$tglTngh1' OR tgl_tengah_2='$tglTngh2' OR tgl_tengah_2='$tglTngh3' OR tgl_tengah_2='$tglTngh4' OR tgl_tengah_2='$tglTngh5' OR tgl_tengah_2='$tglTngh6' OR tgl_tengah_2='$tglTngh7' OR tgl_tengah_2='$tglTngh8'
				OR tgl_tengah_3='$tgl_berangkat' OR tgl_tengah_3='$tgl_tiba' OR tgl_tengah_3='$tglTngh1' OR tgl_tengah_3='$tglTngh2' OR tgl_tengah_3='$tglTngh3' OR tgl_tengah_3='$tglTngh4' OR tgl_tengah_3='$tglTngh5' OR tgl_tengah_3='$tglTngh6' OR tgl_tengah_3='$tglTngh7' OR tgl_tengah_3='$tglTngh8'
				OR tgl_tengah_4='$tgl_berangkat' OR tgl_tengah_4='$tgl_tiba' OR tgl_tengah_4='$tglTngh1' OR tgl_tengah_4='$tglTngh2' OR tgl_tengah_4='$tglTngh3' OR tgl_tengah_4='$tglTngh4' OR tgl_tengah_4='$tglTngh5' OR tgl_tengah_4='$tglTngh6' OR tgl_tengah_4='$tglTngh7' OR tgl_tengah_4='$tglTngh8'
				OR tgl_tengah_5='$tgl_berangkat' OR tgl_tengah_5='$tgl_tiba' OR tgl_tengah_5='$tglTngh1' OR tgl_tengah_5='$tglTngh2' OR tgl_tengah_5='$tglTngh3' OR tgl_tengah_5='$tglTngh4' OR tgl_tengah_5='$tglTngh5' OR tgl_tengah_5='$tglTngh6' OR tgl_tengah_5='$tglTngh7' OR tgl_tengah_5='$tglTngh8'
				OR tgl_tengah_6='$tgl_berangkat' OR tgl_tengah_6='$tgl_tiba' OR tgl_tengah_6='$tglTngh1' OR tgl_tengah_6='$tglTngh2' OR tgl_tengah_6='$tglTngh3' OR tgl_tengah_6='$tglTngh4' OR tgl_tengah_6='$tglTngh5' OR tgl_tengah_6='$tglTngh6' OR tgl_tengah_6='$tglTngh7' OR tgl_tengah_6='$tglTngh8'
				OR tgl_tengah_7='$tgl_berangkat' OR tgl_tengah_7='$tgl_tiba' OR tgl_tengah_7='$tglTngh1' OR tgl_tengah_7='$tglTngh2' OR tgl_tengah_7='$tglTngh3' OR tgl_tengah_7='$tglTngh4' OR tgl_tengah_7='$tglTngh5' OR tgl_tengah_7='$tglTngh6' OR tgl_tengah_7='$tglTngh7' OR tgl_tengah_7='$tglTngh8'
				OR tgl_tengah_8='$tgl_berangkat' OR tgl_tengah_8='$tgl_tiba' OR tgl_tengah_8='$tglTngh1' OR tgl_tengah_8='$tglTngh2' OR tgl_tengah_8='$tglTngh3' OR tgl_tengah_8='$tglTngh4' OR tgl_tengah_8='$tglTngh5' OR tgl_tengah_8='$tglTngh6' OR tgl_tengah_8='$tglTngh7' OR tgl_tengah_8='$tglTngh8'
			) ";
		return $this->db->query($ql)->result();
	}

	public function cariNama(){
		$kategori = $this->input->post('kategori');
		$no_surat_tugas = $this->input->post('no_surat_tugas');
		$tgl_surat_tugas = $this->input->post('tgl_surat_tugas');
		$tgl_berangkat = $this->help->ReverseTgl($this->input->post('tgl_berangkat'));
		$tgl_tiba = $this->help->ReverseTgl($this->input->post('tgl_tiba'));
			
		$tngh1 = $this->input->post('tgl_tengah_1');
		if($tngh1){
			$tngh1 = $this->help->ReverseTgl($tngh1);
		}
		$tglTngh1 = $tngh1;

		$tngh2 = $this->input->post('tgl_tengah_2');
		if($tngh2){
			$tngh2 = $this->help->ReverseTgl($tngh2);
		}
		$tglTngh2 = $tngh2;

		$tngh3 = $this->input->post('tgl_tengah_3');
		if($tngh3){
			$tngh3 = $this->help->ReverseTgl($tngh3);
		}
		$tglTngh3 = $tngh3;

		$tngh4 = $this->input->post('tgl_tengah_4');
		if($tngh4){
			$tngh4 = $this->help->ReverseTgl($tngh4);
		}
		$tglTngh4 = $tngh4;

		$tngh5 = $this->input->post('tgl_tengah_5');
		if($tngh5){
			$tngh5 = $this->help->ReverseTgl($tngh5);
		}
		$tglTngh5 = $tngh5;

		$tngh6 = $this->input->post('tgl_tengah_6');
		if($tngh6){
			$tngh6 = $this->help->ReverseTgl($tngh6);
		}
		$tglTngh6 = $tngh6;

		$tngh7 = $this->input->post('tgl_tengah_7');
		if($tngh7){
			$tngh7 = $this->help->ReverseTgl($tngh7);
		}
		$tglTngh7 = $tngh7;

		$tngh8 = $this->input->post('tgl_tengah_8');
		if($tngh8){
			$tngh8 = $this->help->ReverseTgl($tngh8);
		}
		$tglTngh8 = $tngh8;

		$fk_kegiatan_id = $this->input->post('fk_kegiatan_id');
		$id_sdm = $this->input->post('id_sdm');
		$fk_bagian_id = $this->input->post('fk_bagian_id');
		$pejabatPa = explode('_', $this->input->post('nama_pejabat_pa'));
		$pejabatKpa = explode('_', $this->input->post('nama_pejabat_kpa'));
		
		$cek = $this->cekNamaSdhAda($id_sdm,$tgl_berangkat,$tgl_tiba,$tglTngh1,$tglTngh2,$tglTngh3,$tglTngh4,$tglTngh5,$tglTngh6,$tglTngh7,$tglTngh8);

		$hslCek='';$ktgri='';$adaRapat=''; 
		if(isset($cek)){
			foreach ($cek as $val) {
				if($val->kategori=='DD' && $val->no_surat_tugas!=$no_surat_tugas){
					$hslCek='Sudah ada kegiatan Perjalanan Dinas Dalam Daerah '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Sub Kegiatan '.$val->kegiatan.' (Error ID pjd_detail : '.$val->id.')';
					$ktgri = 'DD';
				}
				if($val->kategori=='DL' && $val->no_surat_tugas!=$no_surat_tugas){
					$hslCek='Sudah ada kegiatan Perjalanan Dinas Luar Daerah '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Sub Kegiatan '.$val->kegiatan.' (Error ID pjd_detail : '.$val->id.')';
					$ktgri = 'DL';
				}
			}			
		}

		if($hslCek==''){ 
			$cekLbr = "select td.id,nama_sdm,singkatan_bagian,spj_bulan,kegiatan from t_entri_lembur_detail td 
				join t_entri_lembur t on t.id=td.fk_entri_lembur_id
				where td.fk_sdm_id=$id_sdm AND (td.tgl='$tgl_berangkat' OR td.tgl='$tgl_tiba' OR td.tgl='$tglTngh1' OR td.tgl='$tglTngh2')";
			$hslLbr = $this->db->query($cekLbr)->result();
			if($hslLbr){
				foreach ($hslLbr as $valLbr) {
					$kegiatanNya .= $valLbr->kegiatan.', ';
					$hslCek='Sudah ada kegiatan Lembur '.$valLbr->singkatan_bagian.', '.$this->help->namaBulan($valLbr->spj_bulan).', Sub Kegiatan ('.$kegiatanNya.'). (Error ID lembur_detail : '.$valLbr->id.')';
				}
				$ktgri = 'Lembur';
			}

			$qweRpt = "SELECT td.id,singkatan_bagian,pukul,kegiatan FROM t_rapat_detail td INNER JOIN t_rapat t ON t.id=td.fk_rapat_id WHERE fk_sdm_id=$id_sdm AND (tgl='$tgl_berangkat' OR tgl='$tgl_tiba' OR tgl='$tglTngh1' OR tgl='$tglTngh2')";
			$cekRapat= $this->db->query($qweRpt)->row();
			if(isset($cekRapat)){
				$hslCek='Ada Kegiatan Rapat di '.$cekRapat->singkatan_bagian.', Pukul : '.$cekRapat->pukul.', Sub Kegiatan '.$cekRapat->kegiatan.' (Error ID rapat_detail : '.$cekRapat->id.')';
				$ktgri = 'Rapat';

			}
		}

		$data['kategori'] = $ktgri;
		$data['hslCek'] = $hslCek;

		$nma = $this->help->namaSdm(array('ms_sdm.id'=>$id_sdm));
		$nma = $nma[0];

		$que = "SELECT nama,nip,gol_pangkat,jabatan,urut_ttd,gol_pangkat_baru,tmt_gol_pangkat_baru,jabatan_baru,tmt_jabatan_baru
				FROM ms_sdm ms
				JOIN ms_jabatan mj ON mj.id=ms.fk_jabatan_id";
		if($fk_bagian_id==1){ //1=Bagian sekretariat tdk punya KPA dan ditarik ke PA
			$que .= " WHERE fk_jabatan_id=2 && nip='".$pejabatPa[1]."' "; //nip kepala bappeda //yg lama -- fk_jabatan_id=2 and ms.status=1 and 
		}else{
			$que .= " WHERE pejabat_kpa=1 and nip='".$pejabatKpa[1]."'"; //nip kabid //yg lama --ms.fk_bagian_id=$fk_bagian_id and pejabat_kpa=1 and ms.status=1
		}
		// die(var_dump($que));
		$rnc = $this->db->query($que)->row();
		
		$data['nama'] = $nma['nama'];
		$data['nip'] = $nma['nip'];
		$gol_pngkt = $nma['gol_pangkat'];
		if(!empty($nma['tmt_gol_pangkat_baru']) && (strtotime($nma['tmt_gol_pangkat_baru']) <= strtotime($tgl_surat_tugas)) ){
			$gol_pngkt = $nma['gol_pangkat_baru'];
		}
		$data['gol_pangkat'] = $gol_pngkt;
		$jbtn_baru = $nma['jabatan'];
		if(!empty($nma['tmt_jabatan_baru']) && (strtotime($nma['tmt_jabatan_baru']) <= strtotime($tgl_surat_tugas)) ){
			$jbtn_baru = $nma['jabatan_baru'];
		}
		$data['jabatan'] = $jbtn_baru;
		$data['eselon'] = $nma['eselon'];
		$data['nama_rincian'] = $rnc->nama;
		$data['nip_rincian'] = $rnc->nip;
		$pngkt_rncn = $rnc->gol_pangkat;
		if(!empty($rnc->tmt_gol_pangkat_baru) && (strtotime($rnc->tmt_gol_pangkat_baru) <= strtotime($tgl_surat_tugas)) ){
			$pngkt_rncn = $rnc->gol_pangkat_baru;
		}
		$data['pangkat_rincian'] = $pngkt_rncn;
		$jbtn_rnc_baru = $rnc->jabatan;
		if(!empty($rnc->tmt_jabatan_baru) && (strtotime($rnc->tmt_jabatan_baru) <= strtotime($tgl_surat_tugas)) ){
			$jbtn_rnc_baru = $rnc->jabatan_baru;
		}
		$data['jabatan_rincian'] = $jbtn_rnc_baru;
		$data['urut_ttd_rincian'] = $rnc->urut_ttd;
		echo json_encode($data);
	}

	public function save(){		
		$id = $this->input->post('id');
		$listSdmId = $this->input->post('listSdmId');
		// if(empty($id) && !isset($listSdmId)){
		// 	$this->session->set_flashdata('error', 'Detail PJD tidak boleh kosong.');
		// 	redirect('Pjd/create');
		// }

			$bdgId=$this->input->post('fk_bagian_id');
		$data['fk_bagian_id'] = $bdgId;
			$msBdg = $this->MMsBagian->get(array('id'=>$bdgId));
		$data['nama_bagian'] = $msBdg[0]['singkatan_bagian'];
		
		// if($bdgId==5 && strtotime($this->input->post('tgl_surat_tugas')) >= strtotime(date('2019-02-01'))){ //sementara utk Bagian ANDAT per bln Feb 2019
		// 	$data['nama_bendahara_pembantu'] = 'DONI HENDRA H., SE';
		// 	$data['nip_bendahara_pembantu'] = '19831222 201101 1 006';
		// }else{
			// $bndhrPmbt=$this->MMsSdm->get(array('fk_bagian_id'=>$bdgId,'bendahara_pembantu'=>1));
			// $data['nama_bendahara_pembantu'] = $bndhrPmbt[0]['nama'];
			// $data['nip_bendahara_pembantu'] = $bndhrPmbt[0]['nip'];
		// }

		$bndhrPmbt=explode('_', $this->input->post('nama_bendahara_pembantu'));
			$data['nama_bendahara_pembantu'] = $bndhrPmbt[0];
			$data['nip_bendahara_pembantu'] = $bndhrPmbt[1];

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

		$idRekBlnj = $this->input->post('fk_rekening_belanja_id');
		$data['fk_rekening_belanja_id'] = $idRekBlnj;
			$msRek = $this->MMsRekeningBelanja->get(array('id'=>$idRekBlnj));
		$data['kode_rekening'] = $msRek[0]['kode_rek_belanja'];

			$kategori = $this->input->post('kategori');
		$data['kategori'] = $kategori;
		$data['jenis_pjd'] = $this->input->post('jenis_pjd');

			$sub_kategori = $this->input->post('fk_sub_kategori_id');
		$data['fk_sub_kategori_id'] = $sub_kategori;
		$data['tahun'] = $this->input->post('tahun');
		// $data['bulan'] = $this->input->post('bulan');
		$data['asal_surat_tugas'] = $this->input->post('asal_surat_tugas');
			$no_surat_tugas = $this->input->post('no_surat_tugas');
		$data['no_surat_tugas'] = $no_surat_tugas;

			$tglSrtTgs = $this->input->post('tgl_surat_tugas');
		$data['tgl_surat_tugas'] = $this->help->ReverseTgl($tglSrtTgs);

		$dasar = $this->input->post('dasar_surat_tugas');		
		$data['dasar_surat_tugas'] = $dasar;
		
		// if($this->tahun=='2020'){
		// 	if($sub_kategori=='12'){
		// 		$kot = $this->input->post('kota_text');
		// 	}else{
		// 		$kot = $this->input->post('kota_dropdown');
		// 	}
		// }else{
			$kot = $this->input->post('kota_text');
		// }

		$data['kota'] = $kot;

		$data['tujuan_skpd'] = $this->input->post('tujuan_skpd');
		$data['alat_transportasi'] = $this->input->post('alat_transportasi');
		$data['acara'] = $this->input->post('acara');
			$tgl_berangkat = $this->help->ReverseTgl($this->input->post('tgl_berangkat'));
		$data['tgl_berangkat'] = $tgl_berangkat;
			$tgl_tiba = $this->help->ReverseTgl($this->input->post('tgl_tiba'));
		$data['tgl_tiba'] = $tgl_tiba;
		$data['jml_hari'] = $this->input->post('jml_hari');

			$tglTngh1 = $this->input->post('tgl_tengah_1');
		$tngh1=NULL;
		if($tglTngh1){
			$tngh1 =  $this->help->ReverseTgl($tglTngh1);
		}
		$data['tgl_tengah_1'] = $tngh1;

			$tglTngh2 = $this->input->post('tgl_tengah_2');
		$tngh2=NULL;
		if($tglTngh2){
			$tngh2 = $this->help->ReverseTgl($tglTngh2);
		}
		$data['tgl_tengah_2'] = $tngh2;

			$tglTngh3 = $this->input->post('tgl_tengah_3');
		$tngh3=NULL;
		if($tglTngh3){
			$tngh3 = $this->help->ReverseTgl($tglTngh3);
		}
		$data['tgl_tengah_3'] = $tngh3;

			$tglTngh4 = $this->input->post('tgl_tengah_4');
		$tngh4=NULL;
		if($tglTngh4){
			$tngh4 = $this->help->ReverseTgl($tglTngh4);
		}
		$data['tgl_tengah_4'] = $tngh4;

			$tglTngh5 = $this->input->post('tgl_tengah_5');
		$tngh5=NULL;
		if($tglTngh5){
			$tngh5 = $this->help->ReverseTgl($tglTngh5);
		}
		$data['tgl_tengah_5'] = $tngh5;

			$tglTngh6 = $this->input->post('tgl_tengah_6');
		$tngh6=NULL;
		if($tglTngh6){
			$tngh6 = $this->help->ReverseTgl($tglTngh6);
		}
		$data['tgl_tengah_6'] = $tngh6;

			$tglTngh7 = $this->input->post('tgl_tengah_7');
		$tngh7=NULL;
		if($tglTngh7){
			$tngh7 = $this->help->ReverseTgl($tglTngh7);
		}
		$data['tgl_tengah_7'] = $tngh7;

			$tglTngh8 = $this->input->post('tgl_tengah_8');
		$tngh8=NULL;
		if($tglTngh8){
			$tngh8 = $this->help->ReverseTgl($tglTngh8);
		}
		$data['tgl_tengah_8'] = $tngh8;

		$tglRnci = $this->input->post('tgl_rincian');
		if($tglRnci){
			$tglRnci = $this->help->ReverseTgl($tglRnci);
		}else{
			$tglRnci=null;
		}
		$data['tgl_rincian'] = $tglRnci;

		if($this->input->post('nama_ttd_surat_tugas')){
			$srtTgs = explode('_', $this->input->post('nama_ttd_surat_tugas'));
			$data['nama_ttd_surat_tugas'] = $srtTgs[0];
			$data['nip_ttd_surat_tugas'] = $srtTgs[1];

			$pngkt = $srtTgs[2];
			if(!empty($srtTgs[6]) && (strtotime($srtTgs[6]) <= strtotime($tglSrtTgs)) ){
				$pngkt = $srtTgs[5];
			}
			
			$data['pangkat_ttd_surat_tugas'] = $pngkt;
			$data['jabatan_ttd_surat_tugas'] = $srtTgs[3];
			$data['urut_ttd_surat_tugas'] = $srtTgs[4];

			// $data['nama_pejabat_kpa'] = $srtTgs[0];
			// $data['nip_pejabat_kpa'] = $srtTgs[1];
			// $data['jabatan_kpa'] = $srtTgs[3];
		}
		if($this->input->post('nama_ttd_sppd')){
			$ttdSppd = explode('_', $this->input->post('nama_ttd_sppd'));
			$data['nama_ttd_sppd'] = $ttdSppd[0];
			$data['nip_ttd_sppd'] = $ttdSppd[1];

			$pngkt = $ttdSppd[2];
			if(!empty($ttdSppd[6]) && (strtotime($ttdSppd[6]) <= strtotime($tglSrtTgs)) ){
				$pngkt = $ttdSppd[5];
			}

			$data['pangkat_ttd_sppd'] = $pngkt;
			$data['jabatan_ttd_sppd'] = $ttdSppd[3];
			$data['urut_ttd_sppd'] = $ttdSppd[4];
		}
	
		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		$cbx_uang_harian = $this->input->post('cbx_uang_harian');
		$cbx_transport = $this->input->post('cbx_transport');
		$cbx_penginapan = $this->input->post('cbx_penginapan');
		$cbx_kontribusi = $this->input->post('cbx_kontribusi');

		$is_uh = null;
		if($cbx_uang_harian){
			$is_uh = 1;
		}
		$data['is_uang_harian'] = $is_uh;

		$is_tspt = null;
		if($cbx_transport){
			$is_tspt = 1;
		}
		$data['is_transport'] = $is_tspt;

		$is_png = null;
		if($cbx_penginapan){
			$is_png = 1;
		}
		$data['is_penginapan'] = $is_png;

		$is_kont = null;
		if($cbx_kontribusi){
			$is_kont = 1;
		}
		$data['is_kontribusi'] = $is_kont;

		foreach ($listSdmId as $key => $idSdm) {
			$cek = $this->cekNamaSdhAda($idSdm,$tgl_berangkat,$tgl_tiba,$tngh1,$tngh2,$tngh3,$tngh4,$tngh5,$tngh6,$tngh7,$tngh8);
			$hslCek='';
			if(isset($cek)){
				foreach ($cek as $val) {
					// if($kategori=='DD' && $val->no_surat_tugas!=$no_surat_tugas){
					// 	$hslCek .= $val->nama_sdm.' Sudah ada kegiatan Perjalanan Dinas Dalam Daerah '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Kegiatan '.$val->kegiatan;
					// }
					// if($kategori=='DL' && $val->no_surat_tugas!=$no_surat_tugas){
					// 	$hslCek .= $val->nama_sdm.' Sudah ada kegiatan Perjalanan Dinas Luar Daerah '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Kegiatan '.$val->kegiatan;
					// }
					if($kategori=='DD' && $val->no_surat_tugas!=$no_surat_tugas){
						$hslCek .= $val->nama_sdm.'Sudah ada kegiatan Perjalanan Dinas Dalam Daerah '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Kegiatan '.$val->kegiatan.' (Error ID pjd_detail : '.$val->id.')';
					}
					if($kategori=='DL' && $val->no_surat_tugas!=$no_surat_tugas){
						$hslCek .= $val->nama_sdm.'Sudah ada kegiatan Perjalanan Dinas Luar Daerah '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Kegiatan '.$val->kegiatan.' (Error ID pjd_detail : '.$val->id.')';
					}
				}			
			}
			if($hslCek){
				$this->session->set_flashdata('error2', $hslCek);
				redirect('Pjd');
			}
		}

		$pa = explode('_', $this->input->post('nama_pejabat_pa'));
		$data['nama_pejabat_pa'] = $pa[0];
		$data['nip_pejabat_pa'] = $pa[1];
		$data['jabatan_pejabat_pa'] = $pa[2];

		$kpa = explode('_', $this->input->post('nama_pejabat_kpa'));
		$data['nama_pejabat_kpa'] = $kpa[0];
		$data['nip_pejabat_kpa'] = $kpa[1];
		$data['jabatan_pejabat_kpa'] = $kpa[2];

		$bndhr = explode('_', $this->input->post('nama_bendahara'));
		$data['nama_bendahara'] = $bndhr[0];
		$data['nip_bendahara'] = $bndhr[1];
		$data['jabatan_bendahara'] = $bndhr[2];

		$pptk = explode('_', $this->input->post('nama_pejabat_pptk'));
		$data['nama_pejabat_pptk'] = $pptk[0];
		$data['nip_pejabat_pptk'] = $pptk[1];
		$data['jabatan_pejabat_pptk'] = $pptk[2];

		if(empty($id)){
			$this->db->trans_start(); 
				if(empty($dasar) && !empty($tglSrtTgs)){
					$tglSt = $this->help->ReverseTgl($tglSrtTgs);
					$dpa = $this->db->query("SELECT * FROM ms_dpa WHERE (tgl_awal <= '$tglSt' AND tgl_akhir >= '$tglSt')")->row();
					$data['dasar_surat_tugas'] = $dpa->keterangan;
				}

				$data['is_spj'] = '0'; 
				$this->MPjd->insert($data);				
				$pjdId = $this->db->insert_id();

				$nama_sdm = $this->input->post('listNamaSdm');
				$nip = $this->input->post('listNip');
				$pangkat_gol = $this->input->post('listGolPangkat');
				$jabatan = $this->input->post('listJabatan');
				$eselon = $this->input->post('listEselon');
				$tarif = $this->input->post('listTarif');
				$hari = $this->input->post('listHari');
				$persen = $this->input->post('listPersen');
				$total = $this->input->post('listTotal');
				$representasi = $this->input->post('listRepresentasi');
				$transport = $this->input->post('listTransport');
				$penginapan = $this->input->post('listPenginapan');
				$total_akhir = $this->input->post('listTotalAkhir');	
				$kontribusi = $this->input->post('listKontribusi');	
				$nama_rincian = $this->input->post('listNamaRincian');
				$nip_rincian = $this->input->post('listNipRincian');
				$pangkat_rincian = $this->input->post('listPangkatRincian');
				$jabatan_rincian = $this->input->post('listJabatanRincian');
				$urut_ttd_rincian = $this->input->post('listUrutTtdRincian');
				$keterangan = $this->input->post('listKeterangan');
				
				if(isset($listSdmId)){
					foreach ($listSdmId as $key => $val) {
						$dataDetail[] = array(
									'fk_pjd_id'=>$pjdId,
									'fk_sdm_id'=>$val,
									'nama_sdm'=>$nama_sdm[$key],
									'nip'=>$nip[$key],
									'pangkat_gol'=>$pangkat_gol[$key],
									'jabatan'=>$jabatan[$key],
									'eselon'=>$eselon[$key],
									'tarif'=>str_replace(',', '', $tarif[$key]),
									'hari'=>$hari[$key],
									'persen'=>$persen[$key],
									'total'=>str_replace(',', '', $total[$key]),
									'representasi'=> empty($representasi[$key])?null:str_replace(',', '', $representasi[$key]),
									'transport'=> empty($transport[$key])?null:str_replace(',', '', $transport[$key]),
									'penginapan'=> empty($penginapan[$key])?null:str_replace(',', '', $penginapan[$key]),
									'total_akhir'=>str_replace(',', '', $total_akhir[$key]),
									'kontribusi'=>str_replace(',', '', $kontribusi[$key]),
									'nama_rincian'=>$nama_rincian[$key],
									'nip_rincian'=>$nip_rincian[$key],
									'pangkat_rincian'=>$pangkat_rincian[$key],
									'jabatan_rincian'=>$jabatan_rincian[$key],
									'urut_ttd_rincian'=>$urut_ttd_rincian[$key],
									'keterangan'=>$keterangan[$key],
								);
					}
					$this->db->insert_batch('t_pjd_detail', $dataDetail);
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

				$this->MPjd->update($id,$data);		

				$nama_sdm = $this->input->post('listNamaSdm');
				$nip = $this->input->post('listNip');
				$pangkat_gol = $this->input->post('listGolPangkat');
				$jabatan = $this->input->post('listJabatan');				
				$eselon = $this->input->post('listEselon');
				$tarif = $this->input->post('listTarif');
				$hari = $this->input->post('listHari');
				$persen = $this->input->post('listPersen');
				$total = $this->input->post('listTotal');
				$representasi = $this->input->post('listRepresentasi');
				$transport = $this->input->post('listTransport');
				$penginapan = $this->input->post('listPenginapan');
				$total_akhir = $this->input->post('listTotalAkhir');	
				$kontribusi = $this->input->post('listKontribusi');			
				$nama_rincian = $this->input->post('listNamaRincian');
				$nip_rincian = $this->input->post('listNipRincian');
				$pangkat_rincian = $this->input->post('listPangkatRincian');
				$jabatan_rincian = $this->input->post('listJabatanRincian');
				$urut_ttd_rincian = $this->input->post('listUrutTtdRincian');
				$keterangan = $this->input->post('listKeterangan');
				
				if(isset($listSdmId)){
					foreach ($listSdmId as $key => $val) {
						$dataDetail[] = array(
									'fk_pjd_id'=>$id,
									'fk_sdm_id'=>$val,
									'nama_sdm'=>$nama_sdm[$key],
									'nip'=>$nip[$key],
									'pangkat_gol'=>$pangkat_gol[$key],
									'jabatan'=>$jabatan[$key],
									'eselon'=>$eselon[$key],
									'tarif'=>str_replace(',', '', $tarif[$key]),
									'hari'=>$hari[$key],
									'persen'=>$persen[$key],
									'total'=>str_replace(',', '', $total[$key]),
									'representasi'=> empty($representasi[$key])?null:str_replace(',', '', $representasi[$key]),
									'transport'=> empty($transport[$key])?null:str_replace(',', '', $transport[$key]),
									'penginapan'=> empty($penginapan[$key])?null:str_replace(',', '', $penginapan[$key]),
									'total_akhir'=>str_replace(',', '', $total_akhir[$key]),
									'kontribusi'=>str_replace(',', '', $kontribusi[$key]),
									'nama_rincian'=>$nama_rincian[$key],
									'nip_rincian'=>$nip_rincian[$key],
									'pangkat_rincian'=>$pangkat_rincian[$key],
									'jabatan_rincian'=>$jabatan_rincian[$key],
									'urut_ttd_rincian'=>$urut_ttd_rincian[$key],
									'keterangan'=>$keterangan[$key],
								);
					}
					$this->db->insert_batch('t_pjd_detail', $dataDetail);
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
        redirect('Pjd');
	}

	public function delete($id){   
		$this->db->trans_start();  
			$this->MPjd->deleteAllDetail($id);
			$result = $this->MPjd->delete($id);
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

        redirect('Pjd');
	}

	public function detail($id){
		$hsl = $this->MPjd->get(array('id'=>$id));
		$data['hsl'] = $hsl[0];
		
		$data['detail'] = $this->MPjd->getDetail((array('fk_pjd_id'=>$id)));

		$this->template->load('Home/template','Pjd/viewDetail',$data);
	}

	public function deleteDetail($fkPjdId, $id){
		$result = $this->MPjd->deleteDetail($id);
		if($result){
        	$this->session->set_flashdata('success', 'Detail PJD berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Detail PJD gagal dihapus.');
        }
        redirect('Pjd/update/'.$fkPjdId);
	}

	public function cariNamaDiPjdDetail(){
		$fk_pjd_detail_id = $this->input->post('fk_pjd_detail_id');
		$cri = $this->db->query("SELECT nama_sdm FROM t_pjd_detail WHERE id=$fk_pjd_detail_id")->row();

		$data['nama']=$cri->nama_sdm;

		echo json_encode($data);
	}

	public function transportHotel($fk_pjd_id){
		$hsl = $this->MPjdTransportHotel->get(array('fk_pjd_id'=>$fk_pjd_id));
		$hsl = $hsl[0];	
		$id = $hsl['id'];

		$hsl2 = $this->MPjdTransportLokal->get(array('fk_pjd_id'=>$fk_pjd_id));
		$lokal= $hsl2[0];

		$data = array(
			'button' => 'Simpan',
			'fk_pjd_id' => set_value('fk_pjd_id',$fk_pjd_id),
			'alat_transport_brk' => set_value('alat_transport_brk',$hsl['alat_transport_brk']),
			'nama_transport_brk' => set_value('nama_transport_brk',$hsl['nama_transport_brk']),
			'dari_brk' => set_value('dari_brk',$hsl['dari_brk']),
			'tujuan_brk' => set_value('tujuan_brk',$hsl['tujuan_brk']),
			'harga_sewa' => set_value('harga_sewa',$hsl['harga_sewa']),
			'keterangan' => set_value('keterangan',$hsl['keterangan']),
			'alat_transport_plg' => set_value('alat_transport_plg',$hsl['alat_transport_plg']),
			'nama_transport_plg' => set_value('nama_transport_plg',$hsl['nama_transport_plg']),
			'dari_plg' => set_value('dari_plg',$hsl['dari_plg']),
			'tujuan_plg' => set_value('tujuan_plg',$hsl['tujuan_plg']),
			'id' => set_value('id',$id),
			'idTransportLokal' => set_value('idTransportLokal',$lokal['id']),
			'nama_trans_lokal_brk' => set_value('nama_trans_lokal_brk',$lokal['nama_trans_lokal_brk']),
			'biaya_trans_lokal_brk' => set_value('biaya_trans_lokal_brk',$lokal['biaya_trans_lokal_brk']),
			'nama_trans_lokal_plg' => set_value('nama_trans_lokal_plg',$lokal['nama_trans_lokal_plg']),
			'biaya_trans_lokal_plg' => set_value('biaya_trans_lokal_plg',$lokal['biaya_trans_lokal_plg']),
		);
		
		$data['acara']=$this->db->query("SELECT acara,tujuan_skpd,kota FROM t_pjd WHERE id=$fk_pjd_id")->row();
		$data['arrMsSdm']=$this->db->query("SELECT id,nama_sdm FROM t_pjd_detail WHERE fk_pjd_id=$fk_pjd_id")->result();

		if($id){
			$data['transBrngkt']=$this->db->query("SELECT b.*,d.nama_sdm FROM t_pjd_transport_hotel_brngkt b INNER JOIN t_pjd_detail d ON d.id=b.fk_pjd_detail_id WHERE fk_pjd_transport_id=$id")->result();		
			$data['transPlg']=$this->db->query("SELECT p.*,d.nama_sdm FROM t_pjd_transport_hotel_plg p INNER JOIN t_pjd_detail d ON d.id=p.fk_pjd_detail_id WHERE fk_pjd_transport_id=$id")->result();		
			$data['transHtl']=$this->db->query("SELECT h.*,d.nama_sdm FROM t_pjd_transport_hotel_htl h INNER JOIN t_pjd_detail d ON d.id=h.fk_pjd_detail_id WHERE fk_pjd_transport_id=$id")->result();
		}		

		$this->template->load('Home/template','Pjd/formTransportHotel',$data);
	}

	public function saveTransportHotel(){
		$id = $this->input->post('id');
		$fk_pjd_id = $this->input->post('fk_pjd_id');
		$data['fk_pjd_id'] = $fk_pjd_id;
		
		$data['alat_transport_brk'] = $this->input->post('alat_transport_brk');
		$data['nama_transport_brk'] = $this->input->post('nama_transport_brk');
		$data['dari_brk'] = $this->input->post('dari_brk');
		$data['tujuan_brk'] = $this->input->post('tujuan_brk');
		
		$data['harga_sewa'] = str_replace(',', '', $this->input->post('harga_sewa'));
		$data['keterangan'] = $this->input->post('keterangan');
		$data['alat_transport_plg'] = $this->input->post('alat_transport_plg');
		$data['nama_transport_plg'] = $this->input->post('nama_transport_plg');
		$data['dari_plg'] = $this->input->post('dari_plg');
		$data['tujuan_plg'] = $this->input->post('tujuan_plg');

		$idTransportLokal = $this->input->post('idTransportLokal');
		$dataLokal['fk_pjd_id'] = $fk_pjd_id;
		$dataLokal['nama_trans_lokal_brk'] = $this->input->post('nama_trans_lokal_brk');
		$dataLokal['biaya_trans_lokal_brk'] = str_replace(',', '', $this->input->post('biaya_trans_lokal_brk'));
		$dataLokal['nama_trans_lokal_plg'] = $this->input->post('nama_trans_lokal_plg');
		$dataLokal['biaya_trans_lokal_plg'] = str_replace(',', '', $this->input->post('biaya_trans_lokal_plg'));
		$dataLokal['user_act'] = $this->session->id;
		$dataLokal['time_act'] = date('Y-m-d H:i:s');
		if(empty($idTransportLokal)){
			$this->MPjdTransportLokal->insert($dataLokal);
		}else{
			$this->MPjdTransportLokal->update($idTransportLokal,$dataLokal);
		}

		if(empty($id)){
			$data['user_act'] = $this->session->id;
			$data['time_act'] = date('Y-m-d H:i:s');

			$this->db->trans_start(); 				
			$this->MPjdTransportHotel->insert($data);				
			$TrnsprtHtlId = $this->db->insert_id();

			$fk_pjd_detail_id_brk = $this->input->post('listFkPjdDetailId_brk');
			$no_tiket_brk = $this->input->post('listTiket_brk');
			$no_penerbangan_brk = $this->input->post('listPenerbangan_brk');
			$kode_booking_brk = $this->input->post('listKdeBooking_brk');
			$harga_brk = $this->input->post('listHarga_brk');
			
			if(isset($fk_pjd_detail_id_brk)){
				foreach ($fk_pjd_detail_id_brk as $key => $val) {
					$dataDetailBrk[] = array(
								'fk_pjd_transport_id'=>$TrnsprtHtlId,
								'fk_pjd_detail_id'=>$val,
								'no_tiket_brk'=>$no_tiket_brk[$key],
								'no_penerbangan_brk'=>$no_penerbangan_brk[$key],
								'kode_booking_brk'=>$kode_booking_brk[$key],
								'harga_brk'=>str_replace(',', '', $harga_brk[$key]),
							);
				}
				$this->db->insert_batch('t_pjd_transport_hotel_brngkt', $dataDetailBrk);
			}

			$fk_pjd_detail_id_plg = $this->input->post('listFkPjdDetailId_plg');
			$no_tiket_plg = $this->input->post('listTiket_plg');
			$no_penerbangan_plg = $this->input->post('listPenerbangan_plg');
			$kode_booking_plg = $this->input->post('listKdeBooking_plg');
			$harga_plg = $this->input->post('listHarga_plg');
			
			if(isset($fk_pjd_detail_id_plg)){
				foreach ($fk_pjd_detail_id_plg as $key => $val) {
					$dataDetailPlg[] = array(
								'fk_pjd_transport_id'=>$TrnsprtHtlId,
								'fk_pjd_detail_id'=>$val,
								'no_tiket_plg'=>$no_tiket_plg[$key],
								'no_penerbangan_plg'=>$no_penerbangan_plg[$key],
								'kode_booking_plg'=>$kode_booking_plg[$key],
								'harga_plg'=>str_replace(',', '', $harga_plg[$key]),
							);
				}
				$this->db->insert_batch('t_pjd_transport_hotel_plg', $dataDetailPlg);
			}

			$fk_pjd_detail_id_htl = $this->input->post('listFkPjdDetailId_htl');
			$nama_hotel = $this->input->post('listNamaHotel');
			$tgl_check_in = $this->input->post('listTglCheckIn');
			$tgl_check_out = $this->input->post('listTglCheckOut');
			$harga_hotel = $this->input->post('listHargaHotel');
			
			if(isset($fk_pjd_detail_id_htl)){
				foreach ($fk_pjd_detail_id_htl as $key => $val) {
					$dataDetailHtl[] = array(
								'fk_pjd_transport_id'=>$TrnsprtHtlId,
								'fk_pjd_detail_id'=>$val,
								'nama_hotel'=>$nama_hotel[$key],
								'tgl_check_in'=>$tgl_check_in[$key],
								'tgl_check_out'=>$tgl_check_out[$key],
								'harga_hotel'=>str_replace(',', '', $harga_hotel[$key]),
							);
				}
				$this->db->insert_batch('t_pjd_transport_hotel_htl', $dataDetailHtl);
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
			$this->MPjdTransportHotel->update($id,$data);

			$fk_pjd_detail_id_brk = $this->input->post('listFkPjdDetailId_brk');
			$no_tiket_brk = $this->input->post('listTiket_brk');
			$no_penerbangan_brk = $this->input->post('listPenerbangan_brk');
			$kode_booking_brk = $this->input->post('listKdeBooking_brk');
			$harga_brk = $this->input->post('listHarga_brk');
			
			if(isset($fk_pjd_detail_id_brk)){
				foreach ($fk_pjd_detail_id_brk as $key => $val) {
					$dataDetailBrk[] = array(
								'fk_pjd_transport_id'=>$id,
								'fk_pjd_detail_id'=>$val,
								'no_tiket_brk'=>$no_tiket_brk[$key],
								'no_penerbangan_brk'=>$no_penerbangan_brk[$key],
								'kode_booking_brk'=>$kode_booking_brk[$key],
								'harga_brk'=>str_replace(',', '', $harga_brk[$key]),
							);
				}
				$this->db->insert_batch('t_pjd_transport_hotel_brngkt', $dataDetailBrk);
			}

			$fk_pjd_detail_id_plg = $this->input->post('listFkPjdDetailId_plg');
			$no_tiket_plg = $this->input->post('listTiket_plg');
			$no_penerbangan_plg = $this->input->post('listPenerbangan_plg');
			$kode_booking_plg = $this->input->post('listKdeBooking_plg');
			$harga_plg = $this->input->post('listHarga_plg');
			
			if(isset($fk_pjd_detail_id_plg)){
				foreach ($fk_pjd_detail_id_plg as $key => $val) {
					$dataDetailPlg[] = array(
								'fk_pjd_transport_id'=>$id,
								'fk_pjd_detail_id'=>$val,
								'no_tiket_plg'=>$no_tiket_plg[$key],
								'no_penerbangan_plg'=>$no_penerbangan_plg[$key],
								'kode_booking_plg'=>$kode_booking_plg[$key],
								'harga_plg'=>str_replace(',', '', $harga_plg[$key]),
							);
				}
				$this->db->insert_batch('t_pjd_transport_hotel_plg', $dataDetailPlg);
			}

			$fk_pjd_detail_id_htl = $this->input->post('listFkPjdDetailId_htl');
			$nama_hotel = $this->input->post('listNamaHotel');
			$tgl_check_in = $this->input->post('listTglCheckIn');
			$tgl_check_out = $this->input->post('listTglCheckOut');
			$harga_hotel = $this->input->post('listHargaHotel');
			
			if(isset($fk_pjd_detail_id_htl)){
				foreach ($fk_pjd_detail_id_htl as $key => $val) {
					$dataDetailHtl[] = array(
								'fk_pjd_transport_id'=>$id,
								'fk_pjd_detail_id'=>$val,
								'nama_hotel'=>$nama_hotel[$key],
								'tgl_check_in'=>$tgl_check_in[$key],
								'tgl_check_out'=>$tgl_check_out[$key],
								'harga_hotel'=>str_replace(',', '', $harga_hotel[$key]),
							);
				}
				$this->db->insert_batch('t_pjd_transport_hotel_htl', $dataDetailHtl);
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
		
        redirect('Pjd');
	}

	public function delTransportBrgkt($fkPjdId,$id){
		$que = $this->db->query("DELETE FROM t_pjd_transport_hotel_brngkt WHERE id=$id");

        $this->session->set_flashdata('success', 'Detail berhasil dihapus.');
        
        redirect('Pjd/transportHotel/'.$fkPjdId);
	}

	public function delTransportPlg($fkPjdId,$id){
		$que = $this->db->query("DELETE FROM t_pjd_transport_hotel_plg WHERE id=$id");

        $this->session->set_flashdata('success', 'Detail berhasil dihapus.');
        
        redirect('Pjd/transportHotel/'.$fkPjdId);
	}

	public function delTransportHtl($fkPjdId,$id){
		$que = $this->db->query("DELETE FROM t_pjd_transport_hotel_htl WHERE id=$id");

        $this->session->set_flashdata('success', 'Detail berhasil dihapus.');
        
        redirect('Pjd/transportHotel/'.$fkPjdId);
	}

	public function ProsesKwitansi($id){
		$hsl=$this->MPjd->get((array('id'=>$id)));
		$hsl=$hsl[0];
		$thn = $hsl['tahun'];
		$bln = $hsl['bulan'];
		$bdg_id = $hsl['fk_bagian_id'];
		$keg_id = $hsl['fk_kegiatan_id'];
		
		$que = "SELECT
					max(no_kwitansi) nomor
				FROM
					t_pjd_detail td
					JOIN t_pjd t ON t.id = td.fk_pjd_id 
				WHERE
					tahun = '$thn' 
					AND bulan = '$bln' 
					AND fk_bagian_id = $bdg_id
					AND fk_kegiatan_id = $keg_id ";
		$cekNo = $this->db->query($que)->row();

			$this->MPjd->groupDetail();
		$dtl=$this->MPjd->getDetail((array('fk_pjd_id'=>$id)));
		
		$noBaru = '001';
		if(!empty($cekNo->nomor)){
			$noBaru = $cekNo->nomor+1;				
		}
		foreach ($dtl as $val) {
			if(strlen($noBaru)==1){
				$noBaru = '00'.$noBaru;
			}
			if(strlen($noBaru)==2){
				$noBaru = '0'.$noBaru;
			}
			$data[] =  array(
		      'id' => $val['id'] ,
		      'no_kwitansi' => $noBaru ,
		   	);
			$noBaru = $noBaru+1;
		}

		$this->db->trans_start();			
			$this->db->update_batch('t_pjd_detail', $data, 'id');
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Pembuatan Nomor Kwitansi gagal di proses.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Pembuatan Nomor Kwitansi berhasil di proses.');
		}			

		redirect('Pjd');
	}

	public function updateBku(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->MMsBagian->get();
		
		$this->template->load('Home/template','Pjd/form_bku',$data);
	}

	public function update_bku(){
		$tahun=$this->tahun;
		$bulan = $this->input->post('bulan');
		$data['bulan']=$bulan;
		$no_bku=$this->input->post('no_bku');
		$data['no_bku']=$no_bku;
		
		$fk_bagian_id=$this->input->post('fk_bagian_id');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$kategori=$this->input->post('kategori');
		$fk_rekening_belanja_id=$this->input->post('fk_rekening_belanja_id');

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
			redirect('Pjd');
		}

		$qwe = "SELECT td.id,no_surat_tugas FROM t_pjd_detail td
				JOIN t_pjd t ON t.id=td.fk_pjd_id
				WHERE fk_pjd_id in ($plh2)
				GROUP BY fk_pjd_id,fk_sdm_id
				ORDER BY t.tgl_berangkat,no_surat_tugas,td.id";
		$dtl = $this->db->query($qwe)->result();

		foreach ($dtl as $cek) {
			if(empty($cek->no_surat_tugas)){
				$this->session->set_flashdata('error', 'No Surat Tugas Wajib Diisi.');
				redirect('Pjd');
			}
		}

		// $que = "SELECT
		// 			max(no_kwitansi) nomor
		// 		FROM
		// 			t_pjd_detail td
		// 			JOIN t_pjd t ON t.id = td.fk_pjd_id 
		// 		WHERE
		// 			tahun = '$tahun' 
		// 			AND bulan = '$bulan' 
		// 			AND fk_bagian_id = $fk_bagian_id
		// 			AND fk_kegiatan_id = $fk_kegiatan_id ";
		// $cekNo = $this->db->query($que)->row();

		$noBaru = '001';
		// if(!empty($cekNo->nomor)){
		// 	$noBaru = $cekNo->nomor+1;				
		// }

		$this->db->trans_start();			

			// if($this->db->affected_rows()){			
				$jml_dana=str_replace(',', '', $this->input->post('jml_dana'));
				$pengajuan_sebelum=str_replace(',', '', $this->input->post('pengajuan_sebelum'));
				$pengajuan_sekarang=str_replace(',', '', $this->input->post('pengajuan_sekarang'));
				$sisa_kas=str_replace(',', '', $this->input->post('sisa_kas'));
				$user_act = $this->session->id;
				$time_act = date('Y-m-d H:i:s');
				$que = "insert into t_pjd_dana (spj_bulan,fk_bagian_id,fk_kegiatan_id,kategori,info_no_bku,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,fk_rekening_belanja_id,user_act,time_act)
					values('$bulan',$fk_bagian_id,$fk_kegiatan_id,'$kategori','$no_bku',$jml_dana,$pengajuan_sebelum,$pengajuan_sekarang,$sisa_kas,$fk_rekening_belanja_id,$user_act,'$time_act')";
				$this->db->query($que);
				$idRekap = $this->db->insert_id();

				$data['fk_pjd_dana_id']=$idRekap;
				$this->db->where('tahun', $tahun);
				$this->db->where('fk_bagian_id', $fk_bagian_id);
				$this->db->where('fk_kegiatan_id', $fk_kegiatan_id);
				$this->db->where('kategori', $kategori);
				$this->db->where_in('id', $plh);
				$this->db->update('t_pjd', $data);

				foreach ($dtl as $val) {
					if(strlen($noBaru)==1){
						$noBaru = '00'.$noBaru;
					}
					if(strlen($noBaru)==2){
						$noBaru = '0'.$noBaru;
					}
					$data2[] =  array(
				      'id' => $val->id ,
				      'no_kwitansi' => $noBaru ,
				   	);
					$noBaru = $noBaru+1;
				}
				$this->db->update_batch('t_pjd_detail', $data2, 'id');

				$this->session->set_flashdata('success', 'Update Rekap PJD berhasil di proses.');

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
		}	
		
		redirect('Pjd');
	}

	public function deleteBku(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->MMsBagian->get();	

		$this->template->load('Home/template','Pjd/form_bku_delete',$data);
	}

	public function cetakBku(){
		if($this->session->userdata("level")==2){
			show_404();
		}
		$data['arrBulan'] = $this->help->namaBulan();
		
		$this->template->load('Home/template','Pjd/formCetakBku',$data);
	}

	public function getNamaGu(){
 		$bln=$_POST['bln'];
 		$nm = $this->MEntriGu->get(array('tahun'=>$this->tahun,'bulan'=>$bln));

 		$data['nama_gu'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$nm as $val) {
 			$data['nama_gu'] .= "<option value=\"".$val['id']."\">".$val['nama']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getBagianGU(){
 		$fk_gu_id=$_POST['fk_gu_id'];
 		$fk_gu_id=$_POST['fk_gu_id'];

 		$andWhere = '';
 		if($this->session->userdata("level")!=1){
 			$andWhere = " AND fk_bagian_id = $this->fkBagianId";
 		}
 		$bd = $this->db->query("SELECT DISTINCT fk_bagian_id,nama_bagian FROM t_entri_gu_detail WHERE fk_entri_gu_id='$fk_gu_id' $andWhere ORDER BY fk_bagian_id")->result_array();

 		$data['Bagian'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$bd as $val) {
 			$data['Bagian'] .= "<option value=\"".$val['fk_bagian_id']."\">".$val['nama_bagian']."</option>\n";
 		}
 		$nm_gu = $this->MEntriGu->get(array('id'=>$fk_gu_id));
 		$data['nama_gu']=$nm_gu[0]['nama'];
 		echo json_encode($data);
 	}

 	public function getKegiatanGU(){
 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$que = "SELECT fk_kegiatan_id,kegiatan FROM t_pjd WHERE tahun=$this->tahun AND fk_bagian_id=$fk_bagian_id AND bulan IS NULL GROUP BY fk_kegiatan_id";
 		$nmKeg = $this->db->query($que)->result_array();

 		$data['nama_keg'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$nmKeg as $val) {
 			$data['nama_keg'] .= "<option value=\"".$val['fk_kegiatan_id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getKegiatanGUDel(){
 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$bulan=$this->input->post('bulan');
 		$que = "SELECT fk_kegiatan_id,kegiatan FROM t_pjd WHERE tahun=$this->tahun AND bulan='$bulan' AND fk_bagian_id=$fk_bagian_id GROUP BY fk_kegiatan_id";
 		$nmKeg = $this->db->query($que)->result_array();

 		$data['nama_keg'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$nmKeg as $val) {
 			$data['nama_keg'] .= "<option value=\"".$val['fk_kegiatan_id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getKegiatanPjdDana(){
 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$bulan=$this->input->post('bulan');
 		$que = "SELECT fk_kegiatan_id,kegiatan FROM t_pjd WHERE tahun=$this->tahun AND bulan='$bulan' AND fk_bagian_id=$fk_bagian_id GROUP BY fk_kegiatan_id";
 		$nmKeg = $this->db->query($que)->result_array();

 		$data['nama_keg'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$nmKeg as $val) {
 			$data['nama_keg'] .= "<option value=\"".$val['fk_kegiatan_id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getCariRekeningBelanjaDelPjd(){
 		$bulan=$this->input->post('bulan');
 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');

 		$que = "SELECT DISTINCT rb.id,kode_rek_belanja,nama_rek_belanja FROM ms_rekening_belanja rb INNER JOIN t_pjd_dana rd ON rd.fk_rekening_belanja_id=rb.id WHERE spj_bulan='$bulan' AND rd.fk_kegiatan_id=$fk_kegiatan_id";
 		$hasil = $this->db->query($que)->result_array();

 		$data['nama_rek'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hasil as $val) {
 			$data['nama_rek'] .= "<option value=\"".$val['id']."\">".$val['kode_rek_belanja'].' ['.$val['nama_rek_belanja'].']'."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	// public function getCariDana(){
 	// 	$fk_kegiatan_id=$_POST['fk_kegiatan_id'];
 	// 	$hsl = $this->db->query("SELECT jml_dana from t_pjd_dana where fk_kegiatan_id=$fk_kegiatan_id ORDER BY fk_gu_id desc limit 1")->row();
 	// 	$data['jml_dana']=number_format($hsl->jml_dana);
 	// 	echo json_encode($data);
 	// }

 	public function getCariDanaPjd(){
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

 		$hsl1 = $this->db->query("SELECT id, sum(pengajuan_sekarang) totPengajuanSblmRekap FROM t_rekap_dana where fk_rekening_belanja_id=$id_rek")->row();

 		$hsl2 = $this->db->query("SELECT sum(pengajuan_sekarang) totPengajuanSblm FROM t_pjd_dana where fk_rekening_belanja_id=$id_rek")->row();
 		$data['dana_sebelum']=number_format($hsl1->totPengajuanSblmRekap+$hsl2->totPengajuanSblm);

 		echo json_encode($data);
 	}

 	public function getCariNoBKU(){
		$bulan=$this->input->post('bulan');
		$id_rek=$this->input->post('id_rek');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$kategori=$this->input->post('kategori');
		$del=$this->input->post('del');

 		$bd = $this->db->query("SELECT pd.id,no_bku FROM t_pjd t INNER JOIN t_pjd_dana pd ON pd.id=t.fk_pjd_dana_id WHERE bulan='$bulan' AND pd.fk_kegiatan_id=$fk_kegiatan_id AND pd.kategori='$kategori' AND fk_rekening_belanja_id=$id_rek")->result_array();

 		$data['nomorBKU'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$bd as $val) {
 			if($del){
 				if(intval($val['info_no_bku']) == 0){
 					$data['nomorBKU'] .= "<option value=\"".$val['id']."\">".$val['no_bku']."</option>\n";
 				}
 			}
 			else{
 				$data['nomorBKU'] .= "<option value=\"".$val['id']."\">".$val['no_bku']."</option>\n";
 			}
 		}
 		echo json_encode($data);
 	}

 	// protected function cariDataBKU($tahun,$fk_bagian_id,$fk_kegiatan_id,$kategori,$fk_gu_id=null,$no_bku=null){
 	// 	if($fk_gu_id){
 	// 		$andWhere = " AND fk_gu_id='$fk_gu_id' AND no_bku='$no_bku'";
 	// 	}else{
 	// 		$andWhere = " AND fk_gu_id IS NULL";
 	// 	}
 	// 	$que = "SELECT DISTINCT t.*,count(td.id) total_pjd FROM t_pjd t
 	// 			JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
 	// 			WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND kategori='$kategori' $andWhere
 	// 			GROUP BY t.id
 	// 			ORDER BY t.bulan";
 	// 	return $this->db->query($que)->result_array();
 	// }

 	public function get_dataUpdateBKU(){
		$tahun=$this->tahun;
		$fk_bagian_id=$this->input->post('fk_bagian_id');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$kategori=$this->input->post('kategori');
		$data['updateBku']=true;

		$queB = "SELECT DISTINCT t.*,count(td.id) total_pjd, sum(total_akhir) total_akhir_all FROM t_pjd t
 				JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND kategori='$kategori'
 					AND (bulan IS NULL OR fk_pjd_dana_id IS NULL)
 				GROUP BY t.id
 				ORDER BY t.bulan, t.tgl_tiba"; 				
 		$data['hasil'] = $this->db->query($queB)->result_array();
		$this->load->view('Pjd/gridDataUpdateBKU',$data);
	}

	public function get_dataDeleteBKU(){
		$tahun=$this->tahun;
		// $bulan=$this->input->post('bulan');
		// $fk_bagian_id=$this->input->post('fk_bagian_id');
		// $fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		// $kategori=$this->input->post('kategori');
		$id_pjd_dana=$this->input->post('id_pjd_dana');
		$data['updateBku']=false;

		$queB = "SELECT DISTINCT t.*,sum(total)total_akhir_all, count(td.id) total_pjd FROM t_pjd t
 				JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
 				WHERE tahun='$tahun' AND fk_pjd_dana_id=$id_pjd_dana
 				GROUP BY t.id
 				ORDER BY t.bulan";	
 		$data['hasil'] = $data['hasil'] = $this->db->query($queB)->result_array();
		$this->load->view('Pjd/gridDataUpdateBKU',$data);
	}

	public function delete_bku(){
		$tahun=$this->tahun;
		$bulan=$this->input->post('bulan');
		$fk_bagian_id=$this->input->post('fk_bagian_id');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$kategori=$this->input->post('kategori');
		$fk_rekening_belanja_id=$this->input->post('fk_rekening_belanja_id');
		$id_pjd_dana=$this->input->post('id_pjd_dana');

		$cek=$this->db->query("SELECT status_pengajuan_dana FROM t_pjd_dana WHERE id=$id_pjd_dana ")->row();
		if($cek->status_pengajuan_dana==1){
			$this->session->set_flashdata('error', 'Data sudah dilakukan Pengajuan Dana.');
			redirect('Pjd');
		}

		$this->db->trans_start();
			$this->db->where('tahun', $tahun);
			$this->db->where('fk_pjd_dana_id', $id_pjd_dana);
			$data['bulan'] = null;		
			$data['no_bku'] = null;		
			$data['fk_pjd_dana_id'] = null;		
			$this->db->update('t_pjd', $data);
					
			$que = "DELETE FROM t_pjd_dana WHERE id=$id_pjd_dana ";
			$this->db->query($que);			

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('warning', 'Delete Rekap PJD gagal di proses.');
		} 
		else {
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Delete Rekap PJD berhasil di proses.');
		}	
		
		redirect('Pjd');
	}

	// public function updateNoBKUSaja(){
	// 	$id_pjd_dana = $this->input->post('id_pjd_dana');
	// 	$no_bku = $this->input->post('no_bku');

	// 	$this->db->trans_start();

	// 	    $data = array(
	// 		        'info_no_bku' => $no_bku,
	// 		);
	// 		$this->db->where('id', $id_pjd_dana);
	// 		$this->db->update('t_pjd_dana', $data);

	// 		$data2 = array(
	// 		        'no_bku' => $no_bku,
	// 		);
	// 		$this->db->where('fk_pjd_dana_id', $id_pjd_dana);
	// 		$this->db->update('t_pjd', $data2);
		   	
	// 	$this->db->trans_complete();			
	// 	if ($this->db->trans_status() === FALSE) {
	// 	    $this->db->trans_rollback();
	// 	    $this->session->set_flashdata('error', 'Data Gagal dihapus.');
	// 	} 
	// 	else {
	// 	    $this->db->trans_commit();
	// 		$this->session->set_flashdata('success', 'Data BKU Berhasil diupdate.');
	// 	}

	// 	redirect('Pjd');
	// }

 // 	public function get_dataBKU(){
	// 	$tahun=$this->tahun;
	// 	// $bulan=$this->input->post('bulan');
	// 	$fk_gu_id=$this->input->post('fk_gu_id');
	// 	$fk_bagian_id=$this->input->post('fk_bagian_id');
	// 	$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
	// 	$kategori=$this->input->post('kategori');
	// 	$no_bku=$this->input->post('no_bku');

 // 		$data['hasil'] = $this->cariDataBKU($tahun,$fk_bagian_id,$fk_kegiatan_id,$kategori,$fk_gu_id,$no_bku);

 // 		// $data['bulan']=$bulan;
 // 		$data['fk_gu_id']=$fk_gu_id;
 // 		$data['fk_bagian_id']=$fk_bagian_id;
 // 		$data['fk_kegiatan_id']=$fk_kegiatan_id;
 // 		$data['kategori']=$kategori;
 // 		$data['no_bku']=$no_bku;

	// 	$this->load->view('Pjd/gridDataBKU',$data);
	// }

	public function getCariDataDetail(){
		$id=$this->input->post('id');
		$hsl=$this->MPjd->getDetail((array('id'=>$id)));
		$hsl=$hsl[0];
		$data = array(
			'nama_sdm'=>$hsl['nama_sdm'],
			'tarif'=>number_format($hsl['tarif']),
			'hari'=>$hsl['hari'],
			'persen'=>$hsl['persen'],
			'total'=>number_format($hsl['total']),
			'representasi'=>empty($hsl['representasi'])?'':number_format($hsl['representasi']),
			'transport'=>empty($hsl['transport'])?'':number_format($hsl['transport']),
			'penginapan'=>empty($hsl['penginapan'])?'':number_format($hsl['penginapan']),
			'total_akhir'=>number_format($hsl['total_akhir']),
			'kontribusi'=>empty($hsl['kontribusi'])?'':number_format($hsl['kontribusi']),
		);

		$data['dataSdmRincian'] = "<option value=''></option>\n";
 		foreach ((array)$this->help->ttd_atasan() as $val) {
 			$gol = $val->gol_pangkat;
 			if(!empty($val->gol_pangkat_baru)){
 				$gol = $val->gol_pangkat_baru;
 			}
 			$jbtn = ($val->jabatan_baru==' ')?$val->jabatan:$val->jabatan_baru;
 			
 			$selected = $val->nip==$hsl['nip_rincian']?'selected':'';
 			$data['dataSdmRincian'] .= "<option $selected value=\"".$val->nama."_".$val->nip."_".$gol."_".$jbtn."_".$val->urut_ttd."\">".$val->nama." [".$jbtn."]"."</option>\n";
 		}

 		$hslPjd=$this->MPjd->get((array('id'=>$hsl['fk_pjd_id'])));
 		$data['dataSdmKwitansi'] = "<option value=''></option>\n";
 		foreach ((array)$this->help->ttd_atasan() as $val) {
 			$gol = $val->gol_pangkat;
 			if(!empty($val->gol_pangkat_baru)){
 				$gol = $val->gol_pangkat_baru;
 			}
 			$selected = $val->nip==$hslPjd[0]['nip_pejabat_kpa']?'selected':'';
 			$data['dataSdmKwitansi'] .= "<option $selected value=\"".$val->nama."_".$val->nip."_".$val->jabatan."\">".$val->nama." [".$val->jabatan."]"."</option>\n";
 		}

		echo json_encode($data);
	}

	public function getJmlSdm(){
 		$id=$_POST['id'];
 			$this->MPjd->groupDetail();
 		$hsl = $this->MPjd->getDetail(array('fk_pjd_id'=>$id));

 		$data['dataSdm'] = "<option value='all'>- Semua -</option>\n";
 		foreach ((array)$hsl as $val) {
 			$data['dataSdm'] .= "<option value=\"".$val['id']."\">".$val['nama_sdm']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getAtsnLngsng(){
 		$id=$_POST['id'];
 			$this->MPjd->groupDetail();
 		$hsl = $this->MPjd->getDetail(array('fk_pjd_id'=>$id));

 		$data['dataSdm'] = "<option value='all'>- Semua -</option>\n";
 		foreach ((array)$hsl as $val) {
 			$data['dataSdm'] .= "<option value=\"".$val['fk_sdm_id']."\">".$val['nama_sdm']."</option>\n";
 		}

 		$data['dataAtsn'] = "<option value=''>.: Pilih :.</option>\n";
 		foreach ((array)$this->help->ttd_pptk() as $val1) {                                                
 			$data['dataAtsn'] .= "<option value=\"".$val1->nama.'_'.$val1->nip."\">".$val1->nama."</option>\n";
 		}

 		$data['dataKpa'] = "<option value=''>.: Pilih :.</option>\n";
 		foreach ((array)$this->help->ttd_pa() as $val3) {
 			$data['dataKpa'] .= "<option value=\"".$val3->nama.'_'.$val3->nip.'_Pengguna Anggaran'."\">".$val3->nama."</option>\n";
 		}

 		$dat = $this->MPjd->get(array('id'=>$id));
		$fk_bagian_id = $dat[0]['fk_bagian_id'];
 		
 		foreach ((array)$this->help->ttd_kpa($fk_bagian_id) as $val2) {
 			$data['dataKpa'] .= "<option value=\"".$val2->nama.'_'.$val2->nip.'_Kuasa Pengguna Anggaran'."\">".$val2->nama."</option>\n";
 		}

 		echo json_encode($data);
 	}

	public function updateDetail(){
		$id=$this->input->post('detail_id');
		$fk_pjd_id=$this->input->post('detail_fk_pjd_id');
		$data['tarif']=str_replace(',', '',$this->input->post('detail_tarif'));
		$data['hari']=$this->input->post('detail_hari');
		$data['persen']=$this->input->post('detail_persen');
		$data['total']=str_replace(',', '',$this->input->post('detail_total'));
			$trsprt = $this->input->post('detail_transport');
		$data['transport']=empty($trsprt)?null:str_replace(',', '', $trsprt);
			$pngnpn = $this->input->post('detail_penginapan');
		$data['penginapan']=empty($pngnpn)?null:str_replace(',', '', $pngnpn);
		$data['total_akhir']=str_replace(',', '',$this->input->post('detail_total_akhir'));
			$kontribusi = $this->input->post('detail_kontribusi');
		$data['kontribusi']=empty($kontribusi)?null:str_replace(',', '', $kontribusi);
			$representasi = $this->input->post('detail_representasi');
		$data['representasi']=empty($representasi)?null:str_replace(',', '', $representasi);

		$ttdRincian = explode('_', $this->input->post('ttd_nama_rincian'));
		$data['nama_rincian']=$ttdRincian[0];
		$data['nip_rincian']=$ttdRincian[1];
		$data['pangkat_rincian']=$ttdRincian[2];
		$data['jabatan_rincian']=$ttdRincian[3];
		$data['urut_ttd_rincian']=$ttdRincian[4];

		$this->MPjd->updateDetail($id,$data);

		if($this->input->post('ttd_nama_kwitansi')){
			$ttdKpa = explode('_', $this->input->post('ttd_nama_kwitansi'));
			$dataKpa['nama_pejabat_kpa']=$ttdKpa[0];
			$dataKpa['nip_pejabat_kpa']=$ttdKpa[1];
			$dataKpa['jabatan_pejabat_kpa']=$ttdKpa[2];
			$this->MPjd->update($fk_pjd_id,$dataKpa);
		}
		
		$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		redirect('Pjd/update/'.$fk_pjd_id);
	}

	// public function pdfKwitansiAll(){
	// 	$tahun=$this->tahun;
	// 	// $bulan=$this->input->post('bulan');
	// 	$fk_gu_id=$this->input->post('fk_gu_id');
	// 	$fk_bagian_id=$this->input->post('fk_bagian_id');
	// 	$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
	// 	$kategori=$this->input->post('kategori');
	// 	$no_bku=$this->input->post('no_bku');

	// 	$hsl = $this->MPjd->get(array('id'=>$id));
	// 	$hsl = $this->cariDataBKU($tahun,$fk_bagian_id,$fk_kegiatan_id,$kategori,$fk_gu_id,$no_bku);
	// 	$data['hasil'] = $hsl;

	// 	$dtl = array();
	// 	foreach ($hsl as $key => $val) {
	// 		$this->MPjd->sumDetail();
	// 		$this->MPjd->groupDetail();
	// 		$dtl[$val['id']]  = $this->MPjd->getDetail((array('fk_pjd_id'=>$val['id'])));
	// 	}
	// 	$data['detail']=$dtl;

	// 	$html=$this->load->view('Pjd/cetakKwitansiAll',$data,true);
	// 	$title = 'Kwitansi All';
	// 	$this->pdf($title,$html,'A5-L');
	// }

	// public function kwi($id){
	// 	$hsl = $this->MPjd->get(array('id'=>$id));
	// 	$data['hasil'] = $hsl[0];
	// 	$dtlAll = $this->MPjd->getDetail((array('fk_pjd_id'=>$id)));
	// 	$arrDetail = array();
	// 	foreach ($dtlAll as $val) {
	// 		$arrDetail[$val['fk_sdm_id']][]=$val;
	// 	}
	// 	$data['detailAll']=$arrDetail;
	// 		$this->MPjd->groupDetail();
	// 	$data['detailGroup']=$this->MPjd->getDetail((array('fk_pjd_id'=>$id)));

	// 	$fkBagian=$hsl[0]['fk_bagian_id'];
	// 	if($this->level != 1){
	// 		if($fkBagian!=$this->fkBagianId){
	// 			show_404();;
	// 		}
	// 	}

	// 	$data['bagn'] = $this->db->query("SELECT nama_bagian,kode_bagian FROM ms_bagian WHERE id=$fkBagian ")->row();

	// 	$html=$this->load->view('Pjd/cetakKwitansi',$data,true);
	// 	$title = 'Kwitansi';
		
	// 	// echo $html;
	// 	$this->pdf($title,$html,'A5-L');
	// }

	// public function cetakKwiPerSdm(){
	// 	$id=$this->input->post('id_detail');
	// 	$id_pjd=$this->input->post('id_pjd');

	// 	if($id=='all'){
	// 		$this->kwi($id_pjd);
	// 	}else{
	// 		$crSdmId = $this->MPjd->getDetail((array('id'=>$id)));

	// 		$dtlAll = $this->MPjd->getDetail((array('fk_pjd_id'=>$id_pjd,'fk_sdm_id'=>$crSdmId[0]['fk_sdm_id'])));
	// 		$arrDetail = array();
	// 		foreach ($dtlAll as $val) {
	// 			$arrDetail[$val['fk_sdm_id']][]=$val;
	// 		}
	// 		$data['detailAll']=$arrDetail;
	// 		$data['detailGroup']=$this->MPjd->getDetail((array('id'=>$id)));

	// 		$hsl = $this->MPjd->get(array('id'=>$dtlAll[0]['fk_pjd_id']));
	// 		$data['hasil'] = $hsl[0];

	// 		$fkBagian=$hsl[0]['fk_bagian_id'];

	// 		if($this->level != 1){
	// 			if($fkBagian!=$this->fkBagianId){
	// 				show_404();;
	// 			}
	// 		}

	// 		$data['bagn'] = $this->db->query("SELECT nama_bagian,kode_bagian FROM ms_bagian WHERE id=$fkBagian ")->row();

	// 		$html=$this->load->view('Pjd/cetakKwitansi',$data,true);
	// 		$title = 'Kwitansi';
			
	// 		// echo $html;
	// 		$this->pdf($title,$html,'A5-L');
	// 	}
	// }

	public function kwiTot($id){
		$hsl = $this->MPjd->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];
		
		$data['detail']=$this->db->query("SELECT sum(total_akhir) total_akhir, nama_sdm,nip FROM t_pjd_detail WHERE fk_pjd_id=$id")->row();

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bagn'] = $this->db->query("SELECT nama_bagian,kode_bagian FROM ms_bagian WHERE id=$fkBagian ")->row();

		$html=$this->load->view('Pjd/cetakKwitansiGlobal',$data,true);
		$title = 'Kwitansi';
		
		echo $html;
		// $this->pdf($title,$html,'A5-L');
	}

	public function surat_tugas($id){
		$hsl = $this->MPjd->get(array('id'=>$id));
		if($hsl[0]['urut_ttd_surat_tugas']==1){
			$hdr = $this->help->headerLaporanBupati();
		}else{
			$hdr = $this->help->headerLaporan();
		}
		$data['header'] = $hdr;
		$data['hasil'] = $hsl[0];
		$fkBagId = $hsl[0]['fk_bagian_id'];

		if($this->level != 1){
			if($fkBagId!=$this->fkBagianId){
				show_404();;
			}
		}

		$data['kelAss'] = $this->db->query("SELECT kelompok_asisten,kode_bagian FROM ms_bagian WHERE id=$fkBagId")->row();
			$this->MPjd->groupDetail();
		$data['detail'] = $this->MPjd->getDetail((array('fk_pjd_id'=>$id)));

		$html=$this->load->view('Pjd/cetakSuratTugas',$data,true);
		$title = 'Surat Tugas';

		// $fkBagian=$hsl[0]['fk_bagian_id'];
		// $ukrCtk = $this->db->query("SELECT * FROM ms_ukuran_cetak WHERE fk_bagian_id=$fkBagian ")->row();
		// $ukuran = array($ukrCtk->width,$ukrCtk->height);

		echo $html;die();
		$this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function hal1($id){
		$hsl = $this->MPjd->get(array('id'=>$id));
		if($hsl[0]['urut_ttd_sppd']==1){
			$hdr = $this->help->headerLaporanBupati();
		}else{
			$hdr = $this->help->headerLaporan();
		}
		$data['header'] = $hdr;
		$data['hasil'] = $hsl[0];
			$this->MPjd->groupDetail(); 
		$data['detail'] = $this->MPjd->getDetail((array('fk_pjd_id'=>$id)));

		$fkBagian=$hsl[0]['fk_bagian_id'];

		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();;
			}
		}

		$data['bagn'] = $this->db->query("SELECT nama_bagian FROM ms_bagian WHERE id=$fkBagian ")->row();
		$data['kelAss'] = $this->db->query("SELECT kelompok_asisten,kode_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$html=$this->load->view('Pjd/cetakHal1',$data,true);
		$title = 'Halaman 1';

		echo $html;die();
		$this->pdf($title,$html,$this->help->folio_P());
	}

	public function hal2($id){
		$hsl = $this->MPjd->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$html=$this->load->view('Pjd/cetakHal2',$data,true);
		$title = 'Halaman 2';

		// $fkBagian=$hsl[0]['fk_bagian_id'];
		// $ukrCtk = $this->db->query("SELECT * FROM ms_ukuran_cetak WHERE fk_bagian_id=$fkBagian ")->row();
		// $ukuran = array($ukrCtk->width,$ukrCtk->height);

		echo $html;die();
		$this->pdf($title,$html,$this->help->folio_P());
	}

	public function cetakHal2ab(){
		$id_pjd=$this->input->post('hal2_id_pjd');
		$hal2_kode=$this->input->post('hal2_kode');
		if($hal2_kode=="A"){
			$this->hal2($id_pjd);
		}else{
			$data['jabatan']=$this->input->post('hal2_jabatan');
			$data['nama']=$this->input->post('hal2_nama');
			$data['nip']=$this->input->post('hal2_nip');

			$hsl = $this->MPjd->get(array('id'=>$id_pjd));
			$data['hasil'] = $hsl[0];

			$html=$this->load->view('Pjd/cetakHal2b',$data,true);
			$title = 'Halaman 2';

			// $fkBagian=$hsl[0]['fk_bagian_id'];
			// $ukrCtk = $this->db->query("SELECT * FROM ms_ukuran_cetak WHERE fk_bagian_id=$fkBagian ")->row();
			// $ukuran = array($ukrCtk->width,$ukrCtk->height);

			$this->pdf($title,$html,$ukuran);
		}
	}

	public function rincian_biaya($id){
		$hsl = $this->MPjd->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];
		$dtlAll = $this->MPjd->getDetail((array('fk_pjd_id'=>$id)));
		$arrDetail = array();
		foreach ($dtlAll as $val) {
			$arrDetail[$val['fk_sdm_id']][]=$val;
		}
		// echo "<pre>";
		// print_r($arrDetail);
		// echo "<pre>";
		// die();

		$fkBagian=$hsl[0]['fk_bagian_id'];
		
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();;
			}
		}

		$data['kelAss'] = $this->db->query("SELECT kode_bagian FROM ms_bagian WHERE id=$fkBagian")->row();
		
		$data['detailAll']=$arrDetail;
			$this->MPjd->groupDetail();
		$data['detailGroup']=$this->MPjd->getDetail((array('fk_pjd_id'=>$id)));

		$html=$this->load->view('Pjd/cetakRincianBiaya',$data,true);
		
		$title = 'Rincian Biaya Perjalanan Dinas';

		$this->pdf($title,$html,$this->help->folio_P());
	}

	public function laporan_staf($id){
		$que = "SELECT t.*, b.nama_bagian Bagiannya FROM t_pjd t JOIN ms_bagian b ON b.id=t.fk_bagian_id WHERE t.id=$id";
		$data['hasil'] = $this->db->query($que)->row();

		$html=$this->load->view('Pjd/cetkLapStaf',$data,true);
		$title = 'LaporanStaf_'.$id;		
// echo $html;die();
		// $this->msword($title,$html);
		$this->pdf($title,$html,$this->help->folio_P());
	}

	public function cetakSpDD(){
		$id=$this->input->post('id_pjd');
		// $id_detail=$this->input->post('id_detail_SP');
		
		$brgkt = $this->input->post('waktu_berangkat');
		$kmbli = $this->input->post('waktu_kembali');

		$this->save_surat_pernyataan($id,$brgkt,$kmbli);

		$data['waktu_berangkat']='pukul '.$brgkt.' wib';
		$data['waktu_kembali']='pukul '.$kmbli.' wib';
		// $id_sdm = $this->input->post('id_sdm');
		// $data['is_peg'] = $this->db->query("SELECT pegawai FROM ms_sdm WHERE id=$id_sdm")->row();
		// $data['atasan_langsung1'] = $this->input->post('atasan_langsung1');
		// $data['atasan_langsung2'] = $this->input->post('atasan_langsung2');
		// $data['atasan_langsung3'] = $this->input->post('atasan_langsung3');
		$data['kpa_pa'] = $this->input->post('kpa_pa');

			$gbgBrk = date('Y-m-d').' '.$brgkt;
			$gbgKbl = date('Y-m-d').' '.$kmbli;
		$data['waktu_total']=$this->selisih_jam($gbgBrk,$gbgKbl);
		$data['header'] = $this->help->headerLaporan();

		$data['detail'] = $this->MPjd->getDetail((array('fk_pjd_id'=>$id)));

		// $data['sdm'] = $this->MPjd->getDetail((array('fk_pjd_id'=>$id,'fk_sdm_id'=>$id_sdm)));
		
		$hsl = $this->MPjd->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		$data['kelAss'] = $this->db->query("SELECT kode_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$data['kategori_pjd'] ='DALAM';

		$html=$this->load->view('Pjd/cetakSuratPernyataanDD',$data,true);
		$title = 'Surat Pernyataan DD';

		echo $html;die();
		// $this->pdf($title,$html,$this->help->folio_P());
	}

	public function selisih_jam($waktu_awal,$waktu_akhir){  
		$waktu_awal        =strtotime($waktu_awal.":00");
        $waktu_akhir    =strtotime($waktu_akhir.":00");      
        //menghitung selisih dengan hasil detik
        $diff    =$waktu_akhir - $waktu_awal;
        
        //membagi detik menjadi jam
        $jam    =floor($diff / (60 * 60));
        
        //membagi sisa detik setelah dikurangi $jam menjadi menit
        $menit    =$diff - $jam * (60 * 60);

        return $jam.' jam '.floor( $menit / 60 ).' menit';
    
	}

	public function cetakSpDL(){
		$id=$this->input->post('id_pjd');
		// $id_detail=$this->input->post('id_detail_SP_dl');

		$brgkt = $this->input->post('waktu_berangkat');
		$kmbli = $this->input->post('waktu_kembali');

		$this->save_surat_pernyataan($id,$brgkt,$kmbli);
		
		// $id_sdm = $this->input->post('id_sdm');
		// $data['is_peg'] = $this->db->query("SELECT pegawai_setda FROM ms_sdm WHERE id=$id_sdm")->row();
		// $data['atasan_langsung1'] = $this->input->post('atasan_langsung1');		

		$data['kpa_pa'] = $this->input->post('kpa_pa');
		
			$brk = explode(' ', $brgkt);
			$brk2 = explode('-', $brk[0]);
			$gbgBrk = $brk2[2].'-'.$brk2[1].'-'.$brk2[0].' '.$brk[1];
		
			$kbl = explode(' ', $kmbli);
			$kbl2 = explode('-', $kbl[0]);
			$gbgKbl = $kbl2[2].'-'.$kbl2[1].'-'.$kbl2[0].' '.$kbl[1];

		$data['waktu_berangkat']='tanggal '.$brk[0].' pukul '.$brk[1];
		$data['waktu_kembali']='tanggal '.$kbl[0].' pukul '.$kbl[1];
		$data['waktu_total']=$this->selisih_jam($gbgBrk,$gbgKbl);
		$data['header'] = $this->help->headerLaporan();

		$data['detail'] = $this->MPjd->getDetail((array('fk_pjd_id'=>$id)));

		// $this->db->group_by('fk_sdm_id');
		// $data['sdm'] = $this->MPjd->getDetail((array('fk_pjd_id'=>$id,'fk_sdm_id'=>$id_sdm)));
		
		$hsl = $this->MPjd->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		$data['kelAss'] = $this->db->query("SELECT kode_bagian FROM ms_bagian WHERE id=$fkBagian")->row();
		
		$data['kategori_pjd'] ='LUAR';

		$html=$this->load->view('Pjd/cetakSuratPernyataanDD',$data,true);
		$title = 'Surat Pernyataan DL';

		echo $html;die();
		// $this->pdf($title,$html,$this->help->folio_P());
	}

	public function save_surat_pernyataan($id,$brgkt,$kbli){
		$this->db->query("UPDATE t_pjd SET tgl_sp_berangkat='$brgkt',tgl_sp_kembali='$kbli' WHERE id=$id");
	}
	
	protected function pdf($title,$html,$page,$batas=false){
		// echo $html;
		if($batas){
			$mpdf = new mPDF('utf-8', $page);
		}else{
        	$mpdf = new mPDF('utf-8', $page, 0, '', 8, 8, 5, 2, 8, 8);
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
