<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		$this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsProgram');
		$this->load->model('MEntriGu');
		$this->load->model('MPjd');
		$this->tahun = $this->session->userdata("tahun");
		$this->level = $this->session->userdata("level");
		$this->fkBagianId = $this->session->userdata("fk_bagian_id");
	}

	public function perSdm(){
		$data['arrMsSdm'] = $this->MMsSdm->get(array('status'=>1,'pegawai_setda'=>1));
    	$data['arrBulan'] = $this->help->namaBulan();

		$this->template->load('Home/template','Laporan/formPerSdm',$data);
	}

	public function get_perSdm(){
		$data['nama'] = $this->input->post('nama');
		$data['bulan_awal'] = $this->input->post('bulan_awal');
		$data['bulan_akhir'] = $this->input->post('bulan_akhir');

		$this->load->view('Laporan/gridPerSdm',$data);
	}

	public function getDatatablesPerSdm(){
		header('Content-Type: application/json');

        $nama = $this->input->post('nama');
		$bulan_awal = $this->input->post('bulan_awal');
		$bulan_akhir = $this->input->post('bulan_akhir');
		
		$this->datatables->where("DATE_FORMAT(tgl, '%m') >=",$bulan_awal);
		$this->datatables->where("DATE_FORMAT(tgl, '%m') <=",$bulan_akhir);	
		$this->datatables->where('t_entri_detail.fk_sdm_id',$nama);
		$this->datatables->where('t_entri.tahun',$this->tahun);
		
        $this->datatables->select('t_entri_detail.id,nomor,nama_kegiatan_orang,kegiatan');        
        $this->datatables->select("DATE_FORMAT(tgl, '%d-%m-%Y') AS tglnya", FALSE);
        $this->datatables->from("t_entri_detail");
        $this->datatables->join('t_entri','t_entri.id=t_entri_detail.fk_entri_id','inner');
        $this->datatables->join('ms_kegiatan','ms_kegiatan.id=t_entri.fk_kegiatan_id','inner');
        $this->db->order_by("tgl", "asc");
        echo $this->datatables->generate();
	}

	protected function querySdm($nama,$bulan_awal,$bulan_akhir){
		$this->db->where("DATE_FORMAT(tgl, '%m') >=",$bulan_awal);
		$this->db->where("DATE_FORMAT(tgl, '%m') <=",$bulan_akhir);	
		$this->db->where('t_entri_detail.fk_sdm_id',$nama);
		$this->db->where('t_entri.tahun',$this->tahun); 

        $this->db->select('t_entri_detail.id,nomor,nama_kegiatan_orang,kegiatan,nama_sdm');        
        $this->db->select("DATE_FORMAT(tgl, '%d-%m-%Y') AS tglnya", FALSE);
        $this->db->from("t_entri_detail");
        $this->db->join('t_entri','t_entri.id=t_entri_detail.fk_entri_id','inner');
        $this->db->join('ms_kegiatan','ms_kegiatan.id=t_entri.fk_kegiatan_id','inner');
        $this->db->order_by("tgl", "asc");

        return $this->db->get()->result();
	}

	public function pdfSdm(){
		$nama = $this->input->post('nama');
		$bulan_awal = $this->input->post('bulan_awal');
		$bulan_akhir = $this->input->post('bulan_akhir');
		if(empty($nama)){
			die('halama tidak bisa di refresh. Silahkan ulangi cetak PDF.');
		}
		$data['judul'] = "Bulan ".$this->help->namaBulan($bulan_awal). ' s/d '.$this->help->namaBulan($bulan_akhir);
		$data['hasil'] = $this->querySdm($nama,$bulan_awal,$bulan_akhir);
		$html=$this->load->view('Laporan/pdfPerSdm',$data,true);
		$title = 'LapPerSdm_'.date('d-m-Y');

		$this->pdf($title,$html,'A4-P');
	}

	public function excelSdm(){
		$nama=$_GET['nama'];
        $bulan_awal=$_GET['bulan_awal'];
        $bulan_akhir=$_GET['bulan_akhir'];
		
		$data['judul'] = "Bulan ".$this->help->namaBulan($bulan_awal). ' s/d '.$this->help->namaBulan($bulan_akhir);
		$data['hasil'] = $this->querySdm($nama,$bulan_awal,$bulan_akhir);
		$html=$this->load->view('Laporan/pdfPerSdm',$data,true);
		$title = 'LapPerSdm_'.date('d-m-Y');

		$this->excel($title,$html);
	}

	public function perBulan(){
		$data['arrMsSdm'] = $this->MMsSdm->get(array('status'=>1,'pegawai_setda'=>1));
    	$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->MMsBagian->get();

		$this->template->load('Home/template','Laporan/formPerBulan',$data);
	}

	protected function queryPerBulan1($bln,$nama,$fk_bagian_id){
		$thn = $this->tahun;
		$andWhere='';
		if($nama){
			$no=1;$idSdm='';
			foreach ($nama as $val) {
				$koma='';
				if(count($nama) != $no){
					$koma=',';
				}
				$idSdm .= $val.$koma; 
				$no++;
			}
			$andWhere .= " AND fk_sdm_id in ($idSdm)";
		}
		if($fk_bagian_id){
			$no=1;$idBagian='';
			foreach ($fk_bagian_id as $bd) {
				$kma='';
				if(count($fk_bagian_id) != $no){
					$kma=',';
				}
				$idBagian .= $bd.$kma; 
				$no++;
			}
			$andWhere .= " AND fk_bagian_current in ($idBagian)";
		}

		$que = "SELECT fk_sdm_id,nama_sdm FROM t_entri_detail td
				JOIN t_entri t ON t.id=td.fk_entri_id
				WHERE tahun='$thn' AND DATE_FORMAT(tgl, '%m')='$bln' $andWhere
				GROUP BY fk_sdm_id";
		return $this->db->query($que)->result();
	}

	protected function queryPerBulan2($bln,$nama,$fk_bagian_id){
		$thn = $this->tahun;
		$andWhere='';
		if($nama){
			$no=1;$idSdm='';
			foreach ($nama as $val) {
				$koma='';
				if(count($nama) != $no){
					$koma=',';
				}
				$idSdm .= $val.$koma; 
				$no++;
			}
			$andWhere .= " AND fk_sdm_id in ($idSdm)";
		}
		if($fk_bagian_id){
			$no=1;$idBagian='';
			foreach ($fk_bagian_id as $bd) {
				$kma='';
				if(count($fk_bagian_id) != $no){
					$kma=',';
				}
				$idBagian .= $bd.$kma; 
				$no++;
			}
			$andWhere .= " AND fk_bagian_current in ($idBagian)";
		}
		$que2 = "SELECT fk_sdm_id,fk_kegiatan_orang_id,CAST(DATE_FORMAT(tgl,'%d') AS UNSIGNED INTEGER) tgl FROM t_entri_detail td
				JOIN t_entri t ON t.id=td.fk_entri_id
				WHERE tahun='$thn' AND DATE_FORMAT(tgl, '%m')='$bln' $andWhere";
		$hsl = $this->db->query($que2)->result();
		$hasil=array();
		foreach ($hsl as $val) {
			$hasil[$val->fk_sdm_id][]=$val;
		}
		return $hasil;
	}

	public function get_perBulan(){		
		$bln = $this->input->post('bulan');
		$nama = $this->input->post('nama');
		$fk_bagian_id = $this->input->post('Bagian');

		$data['namaSDM'] = $this->queryPerBulan1($bln,$nama,$fk_bagian_id);
		$data['hasil'] = $this->queryPerBulan2($bln,$nama,$fk_bagian_id);
		$data['bulan'] = $bln;
		$data['nama'] = json_encode($nama);
		$data['Bagian'] = json_encode($fk_bagian_id);
		$this->load->view('Laporan/gridPerBulan',$data);
	}

	public function pdfPerBulan(){
		$bln = $this->input->post('bulan');
		$nama = json_decode($this->input->post('nama'));
		$fk_bagian_id = json_decode($this->input->post('Bagian'));
		if(empty($bln)){
			die('halama tidak bisa di refresh. Silahkan ulangi cetak PDF.');
		}
		$data['judul'] = "Bulan ".$this->help->namaBulan($bln). ' Tahun '.$this->tahun;
		$data['namaSDM'] = $this->queryPerBulan1($bln,$nama,$fk_bagian_id);
		$data['hasil'] = $this->queryPerBulan2($bln,$nama,$fk_bagian_id);
		$html=$this->load->view('Laporan/pdfPerBulan',$data,true);
		$title = 'LapPerBulan_'.$bln.'-'.$this->tahun;

		$this->pdf($title,$html,'A4-L');
	}

	public function excelPerBulan(){
        $bln=$_GET['bulan'];
		$nama=$_GET['nama'];
		if($nama!='null'){
			$nama = explode(',', $nama);

		}else{
			$nama='';
		}
		$fk_bagian_id=$_GET['Bagian'];
		if($fk_bagian_id!='null'){
			$fk_bagian_id = explode(',', $fk_bagian_id);

		}else{
			$fk_bagian_id='';
		}
	
		$data['judul'] = "Bulan ".$this->help->namaBulan($bln). ' Tahun '.$this->tahun;
		$data['namaSDM'] = $this->queryPerBulan1($bln,$nama,$fk_bagian_id);
		$data['hasil'] = $this->queryPerBulan2($bln,$nama,$fk_bagian_id);
		$html=$this->load->view('Laporan/pdfPerBulan',$data,true);
		$title = 'LapPerBulan_'.$bln.'-'.$this->tahun;

		$this->excel($title,$html);
	}

	public function perGu(){
		$data['arrEntriGu'] = $this->MEntriGu->get(array('tahun'=>$this->tahun));

		$this->template->load('Home/template','Laporan/formPerGu',$data);
	}

	public function get_perGu(){
		$id_gu = $this->input->post('id_gu');
		$data['hasil'] = $this->queryPerGu($id_gu);
		$data['id_gu'] = $id_gu;

		$this->load->view('Laporan/gridPerGu',$data);
	}

	public function queryPerGu($id_gu){			
		$this->db->where('fk_entri_gu_id',$id_gu);		
        $this->db->select('t_entri_gu_detail.id,nama_bagian,nama_kegiatan,jumlah,warna,warna_laporan,keterangan');  
        $this->db->from("t_entri_gu_detail");
        $this->db->join('status_warna_spj','status_warna_spj.id=t_entri_gu_detail.status_spj_detail','left');
        return $this->db->get()->result();
	}

	public function pdfPerGu(){
		$id_gu = $this->input->post('id_gu');
		if(empty($id_gu)){
			die('halama tidak bisa di refresh. Silahkan ulangi cetak PDF.');
		}
		$nama_gu = $this->MEntriGu->get(array('id'=>$id_gu));
		$data['namaGU'] = $nama_gu[0];
		$data['hasil'] = $this->queryPerGu($id_gu);
		$html=$this->load->view('Laporan/pdfPerGu',$data,true);
		$title = 'LapPerGu_'.$nama_gu[0]['nama'];

		$this->pdf($title,$html,'A4-P');
	}

	public function excelPerGu(){
		$id_gu=$_GET['id_gu'];
		
		$nama_gu = $this->MEntriGu->get(array('id'=>$id_gu));
		$data['namaGU'] = $nama_gu[0];
		$data['hasil'] = $this->queryPerGu($id_gu);
		$html=$this->load->view('Laporan/pdfPerGu',$data,true);
		$nm = str_replace(' ', '_', $nama_gu[0]['nama']);
		$title = 'LapPerGu_'.$nm;

		$this->excel($title,$html);
	}

	protected function querySeluruhGu(){
		$qw = "	SELECT dt.id,fk_entri_gu_id,fk_kegiatan_id,sw.warna,sw.warna_laporan FROM t_entri_gu_detail dt
				JOIN t_entri_gu t ON t.id=dt.fk_entri_gu_id
				JOIN status_warna_spj sw ON sw.id=dt.status_spj_detail
				WHERE tahun='$this->tahun'
				ORDER BY dt.fk_bagian_id";
		$hsl = $this->db->query($qw)->result();

		$hsl2=array();
		foreach ($hsl as $val) {
			$hsl2[$val->fk_entri_gu_id][$val->fk_kegiatan_id] = $val;
		}
		return $hsl2;
	}

	protected function kegiatan(){
		$qw = " SELECT * from kegiatan_v WHERE tahun='$this->tahun'";
		return $this->db->query($qw)->result();
	}

	public function seluruhGu(){
		$data['arrKegBappeda'] = $this->kegiatan();
		$data['arrEntriGu'] = $this->MEntriGu->get(array('tahun'=>$this->tahun));
		$data['arrDetailGu'] = $this->querySeluruhGu();

		$this->template->load('Home/template','Laporan/gridSeluruhGu',$data);
	}

	public function pdfSeluruhGu(){
		$data['arrKegBappeda'] = $this->kegiatan();
		$data['arrEntriGu'] = $this->MEntriGu->get(array('tahun'=>$this->tahun));
		$data['arrDetailGu'] = $this->querySeluruhGu();

		$html=$this->load->view('Laporan/pdfSeluruhGu',$data,true);
		$title = 'LapSeluruhGu'.$this->tahun;

		$mpdf = new mPDF('', $this->help->folio_L(), 0, '', 5, 5, 5, 5, 8, 8);
        $mpdf->AddPage();
        $mpdf->WriteHTML($html);
        $mpdf->Output($title.'.pdf','I');
	}

	public function excelSeluruhGu(){
		$data['arrKegBappeda'] = $this->kegiatan();
		$data['arrEntriGu'] = $this->MEntriGu->get(array('tahun'=>$this->tahun));
		$data['arrDetailGu'] = $this->querySeluruhGu();

		$html=$this->load->view('Laporan/pdfSeluruhGu',$data,true);
		$title = 'LapSeluruhGu'.$this->tahun;

		$this->excel($title,$html);
	}

	public function rekapPjd(){
		$data['arrBulan'] = $this->help->namaBulan();	
		$data['arrBendaharaPem'] = $this->MMsSdm->get(array('status'=>1,'bendahara_pembantu'=>1));
		$data['arrPa'] = $this->help->ttd_pa();
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['arrPPTK'] = $this->help->ttd_pptk();
		$data['arrMsBagian'] = $this->MMsBagian->get();

		$this->template->load('Home/template','Laporan/formRekapPjd',$data);
	}

	public function cetakRekapPjd(){
		// $fk_gu_id=$this->input->post('fk_gu_id');
		$bulan=$this->input->post('bulan');
		$fk_bagian_id=$this->input->post('fk_bagian_id');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$fk_rekening_belanja_id=$this->input->post('fk_rekening_belanja_id');
		$kategori=$this->input->post('kategori');
		$id_pjd_dana=$this->input->post('id_pjd_dana');
		$tgl_cetak=$this->input->post('tgl_cetak');
		$kpa=$this->input->post('kpa');
		$ptk=$this->input->post('ptk');
		$bendahara_pembantu=$this->input->post('bendahara_pembantu');
		$bendahara=$this->input->post('bendahara');

		$no_bku_akomodasi = $this->input->post('no_bku_akomodasi');
		$jml_dana_akomodasi = $this->input->post('jml_dana_akomodasi');
		$pengajuan_sebelum_akomodasi = $this->input->post('pengajuan_sebelum_akomodasi');
		$pengajuan_sekarang_akomodasi = $this->input->post('pengajuan_sekarang_akomodasi');
		$sisa_kas_akomodasi = $this->input->post('sisa_kas_akomodasi');

 		$this->printRekapPjd($fk_rekening_belanja_id,$fk_bagian_id,$fk_kegiatan_id,$kategori,$id_pjd_dana,$bulan,$tgl_cetak,$kpa,$ptk,$bendahara_pembantu,$no_bku_akomodasi,$jml_dana_akomodasi,$pengajuan_sebelum_akomodasi,$pengajuan_sekarang_akomodasi,$sisa_kas_akomodasi,$bendahara);
	}

	public function excelRekapPjd(){
		// $fk_gu_id=$this->input->get('fk_gu_id');
		$fk_bagian_id=$this->input->get('fk_bagian_id');
		$fk_kegiatan_id=$this->input->get('fk_kegiatan_id');
		$fk_rekening_belanja_id=$this->input->get('fk_rekening_belanja_id');
		$kategori=$this->input->get('kategori');
		$id_pjd_dana=$this->input->get('id_pjd_dana');
		$bulan=$this->input->get('bulan');
		$tgl_cetak=$this->input->get('tgl_cetak');
		$kpa=$this->input->get('kpa');
		$ptk=$this->input->get('ptk');
		$bendahara_pembantu=$this->input->get('bendahara_pembantu');
		$bendahara=$this->input->get('bendahara');

		$no_bku_akomodasi = $this->input->get('no_bku_akomodasi');
		$jml_dana_akomodasi = $this->input->get('jml_dana_akomodasi');
		$pengajuan_sebelum_akomodasi = $this->input->get('pengajuan_sebelum_akomodasi');
		$pengajuan_sekarang_akomodasi = $this->input->get('pengajuan_sekarang_akomodasi');
		$sisa_kas_akomodasi = $this->input->get('sisa_kas_akomodasi');

		$this->printRekapPjd($fk_rekening_belanja_id,$fk_bagian_id,$fk_kegiatan_id,$kategori,$no_bku,$bulan,$tgl_cetak,$kpa,$ptk,$bendahara_pembantu,$no_bku_akomodasi,$jml_dana_akomodasi,$pengajuan_sebelum_akomodasi,$pengajuan_sekarang_akomodasi,$sisa_kas_akomodasi,$bendahara,true);
	}

	protected function printRekapPjd($fk_rekening_belanja_id,$fk_bagian_id,$fk_kegiatan_id,$kategori,$id_pjd_dana,$bulan,$tgl_cetak,$kpa,$ptk,$bendahara_pembantu,$no_bku_akomodasi,$jml_dana_akomodasi,$pengajuan_sebelum_akomodasi,$pengajuan_sekarang_akomodasi,$sisa_kas_akomodasi,$bendahara,$is_excel=false){

		$tahun=$this->tahun;

		$queAwl="SELECT * FROM t_pjd_dana WHERE id=$id_pjd_dana ";
 		$data['dana']=$this->db->query($queAwl)->row();


		$que = "SELECT no_bku,nama_bagian,singkatan_kegiatan,tgl_berangkat,tgl_tiba,tujuan_skpd,kota,acara,td.* FROM t_pjd t
 	 			JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
 	 			WHERE fk_pjd_dana_id=$id_pjd_dana
 			";
 		$que2 = " GROUP BY fk_sdm_id,td.fk_pjd_id ORDER BY tgl_berangkat,no_kwitansi"; //no_surat_tugas
 		$data['hasil']=$this->db->query($que.$que2)->result_array(); 			

		$que1 = "SELECT no_bku,nama_bagian,singkatan_kegiatan,td.* FROM t_pjd t
 				JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
 				WHERE fk_pjd_dana_id=$id_pjd_dana
 				";
 		$dtl=$this->db->query($que1)->result_array();
 		$detailGroup = array();
 		foreach ($dtl as $val) {
 			$detailGroup[$val['fk_pjd_id']][$val['fk_sdm_id']]=$val;
 		}
 		$data['hasilGroup']=$detailGroup;

 		$detailAll = array();
 		foreach ($dtl as $val2) {
 			$detailAll[$val2['fk_pjd_id']][$val2['fk_sdm_id']][]=$val2;
 		}
 		$data['hasilDetail']=$detailAll;

 		$data['tahun']=$tahun;
 		$data['bulan']=$bulan;
 		$data['kategori']=$kategori;
 		$keg = $this->MMsKegiatan->get(array('id'=>$fk_kegiatan_id));
 		$data['keg'] = $keg[0];
 		$idProgram = $keg[0]['fk_program_id'];
 		// $data['prog'] = $this->MMsProgram->get(array('id'=>$keg[0]['fk_program_id']));
 		$data['prog'] = $this->db->query("SELECT CONCAT(kode,'.',kode_program) kode FROM ms_program p LEFT JOIN ms_program_utama pu ON pu.id=p.fk_program_utama_id WHERE p.id=$idProgram")->row();

 		$data['tgl_cetak']=$tgl_cetak;
 		$data['kpa']=$this->MMsSdm->get(array('id'=>$kpa));
 		$data['ptk']=$this->MMsSdm->get(array('id'=>$ptk));
 		if($bendahara_pembantu){
 			$data['bendahara_pem']=$this->MMsSdm->get(array('id'=>$bendahara_pembantu));
 		}else{
 			$data['bendahara_pem']='';
 		}
 		$bndhr = explode('_', $bendahara);
 		$data['nama_bendahara']=$bndhr[0];
 		$data['nip_bendahara']=$bndhr[1];

 			// khusus Lap Akomodasi TP3 		
 		$data['hasilAkomodasi']=$this->db->query($que.' AND penginapan is NOT NULL '.$que2)->result_array();

 		$dtlAkom=$this->db->query($que1.' AND penginapan IS NOT NULL')->result_array();
 		$detailGroupAkom = array();
 		foreach ($dtlAkom as $val) {
 			$detailGroupAkom[$val['fk_pjd_id']][$val['fk_sdm_id']]=$val;
 		}
 		$data['hasilGroupAkom']=$detailGroupAkom;

 		$data['no_bku_akomodasi']=$no_bku_akomodasi;
 		$data['jml_dana_akomodasi']=$jml_dana_akomodasi;
 		$data['pengajuan_sebelum_akomodasi']=$pengajuan_sebelum_akomodasi;
 		$data['pengajuan_sekarang_akomodasi']=$pengajuan_sekarang_akomodasi;
 		$data['sisa_kas_akomodasi']=$sisa_kas_akomodasi;

		$html=$this->load->view('Laporan/pdfRekapPjd',$data,true);
		$title = 'Cetak Rekap Pjd '.$data['tgl_cetak'];
		
		if($is_excel){
			$this->excel($title,$html);
		}else{
			echo $html;die();
		}
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	public function cetak_kwitansi(){
		$tahun=$this->tahun;
		$fk_gu_id=$this->input->get('fk_gu_id');
		$fk_bagian_id=$this->input->get('fk_bagian_id');
		$fk_kegiatan_id=$this->input->get('fk_kegiatan_id');
		$kategori=$this->input->get('kategori');
		$no_bku=$this->input->get('no_bku');

		$hsl = $this->cariDataBKU($tahun,$fk_bagian_id,$fk_kegiatan_id,$kategori,$fk_gu_id,$no_bku);
		$data['hasil'] = $hsl;

		$dtl = array();
		foreach ($hsl as $key => $val) {
			$this->MPjd->sumDetail();
			$this->MPjd->groupDetail();
			$dtl[$val['id']]  = $this->MPjd->getDetail((array('fk_pjd_id'=>$val['id'])));
		}
		$data['detail']=$dtl;

		$html=$this->load->view('Laporan/cetakKwitansiAll',$data,true);
		$title = 'Kwitansi All';
		$this->pdf($title,$html,'A5-L',false);
	}

	protected function cariDataBKU($tahun,$fk_bagian_id,$fk_kegiatan_id,$kategori,$fk_gu_id=null,$no_bku=null){
 		if($fk_gu_id){
 			$andWhere = " AND fk_gu_id='$fk_gu_id' AND no_bku='$no_bku'";
 		}else{
 			$andWhere = " AND fk_gu_id IS NULL";
 		}
 		$que = "SELECT DISTINCT t.*,count(td.id) total_pjd FROM t_pjd t
 				JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND kategori='$kategori' $andWhere
 				GROUP BY t.id
 				ORDER BY t.bulan";
 		return $this->db->query($que)->result_array();
 	}

 	public function cetak_rincian(){
 		$tahun=$this->tahun;
		$fk_gu_id=$this->input->get('fk_gu_id');
		$fk_bagian_id=$this->input->get('fk_bagian_id');
		$fk_kegiatan_id=$this->input->get('fk_kegiatan_id');
		$kategori=$this->input->get('kategori');
		$no_bku=$this->input->get('no_bku');

		$hsl = $this->cariDataBKU($tahun,$fk_bagian_id,$fk_kegiatan_id,$kategori,$fk_gu_id,$no_bku);
		$data['hasil'] = $hsl;
		
		$dtl = array();
		foreach ($hsl as $key => $val) {
			// $this->MPjd->sumDetail();
			// $this->MPjd->groupDetail();
			$dtl[$val['id']]  = $this->MPjd->getDetail((array('fk_pjd_id'=>$val['id'])));
		}
		// $data['detail']=$dtl;
		
		$arrDetail = array();
		foreach ($dtl as $key => $val2) {
			foreach ($val2 as$val3) {
				$arrDetail[$key][$val3['fk_sdm_id']][]=$val3;				
			}
		}	
		$data['detailAll']=$arrDetail;

		// echo "<pre>";
		// print_r($arrDetail);
		// echo "<pre>";
		// die();

		$html=$this->load->view('Laporan/cetakRincianBiayaAll',$data,true);
		$title = 'Rincian Biaya Perjalanan Dinas';

		$ukrCtk = $this->db->query("SELECT * FROM ms_ukuran_cetak WHERE fk_bagian_id=$fk_bagian_id ")->row();
		$ukuran = array($ukrCtk->width,$ukrCtk->height);

		$this->pdf($title,$html,$ukuran,false,true);
	}

	public function rekapPjdTahunan(){
		$data=false;
		$this->template->load('Home/template','Laporan/formRekapPjdTahunan',$data);
	}

	public function cetakRekapPjdTahunan(){
		$tahun=$this->tahun;
		$kategori=$this->input->post('kategori');

		$data['kategori'] = $kategori;
		$data['tahun'] = $tahun;

		// $kpl = $this->MMsSdm->get(array('fk_jabatan_id'=>2,'status'=>1));
		// $data['kepala'] = $kpl[0];

		$andWhere='';
		$fk_bagian_id = NULL;
		if($this->level!=1){
			$fk_bagian_id = $this->fkBagianId;
			$andWhere=" AND fk_bagian_id=$fk_bagian_id";
			$data['bag'] = $this->db->query("SELECT nama_bagian FROM ms_bagian WHERE id=$fk_bagian_id")->row();
		}
		$data['fk_bagian_id']=$fk_bagian_id;

		if($kategori=='DD'){
			$que = "SELECT * FROM v_rekap_pjd_dd
 	 			WHERE tahun='$tahun' $andWhere
 			";
 			$data['hasil']=$this->db->query($que)->result();
			$html=$this->load->view('Laporan/pdfRekapPjdTahunanDD',$data,true);
			$title = 'LapRekapPjdDD_'.$this->tahun;
		}else{
			$que = "SELECT * FROM v_rekap_pjd_dl
 	 			WHERE tahun='$tahun' AND tgl_surat_tugas!='00/00/0000' $andWhere
 			";
 			$data['hasil']=$this->db->query($que)->result();

 			$form='Laporan/pdfRekapPjdTahunanDL';
 			// if($tahun=='2021'){
 			// 	$form='Laporan/pdfRekapPjdTahunanDL2021';
 			// }
			$html=$this->load->view($form,$data,true);
			$title = 'LapRekapPjdDL_'.$this->tahun;
		}
// echo $html;die();
		$this->excel($title,$html);
	}

	public function excelMasterLap(){
		$tahun=$this->tahun;
		$fk_gu_id=$this->input->get('fk_gu_id');
		$fk_bagian_id=$this->input->get('fk_bagian_id');
		$fk_kegiatan_id=$this->input->get('fk_kegiatan_id');
		$kategori=$this->input->get('kategori');
		$no_bku=$this->input->get('no_bku');
		$bulan=$this->input->get('bulan');

		$que = "SELECT t.*,d.nama_sdm,d.nip,d.pangkat_gol,d.jabatan FROM t_pjd t JOIN t_pjd_detail d ON t.id=d.fk_pjd_id 
		WHERE no_bku='$no_bku' AND tahun=$tahun AND bulan='$bulan' AND (d.jabatan!='Plt. KEPALA BAPPEDA' AND d.jabatan!='KEPALA BAPPEDA')
		GROUP BY fk_pjd_id
		ORDER BY d.no_kwitansi";
		$data['hasil'] = $this->db->query($que)->result();
		$data['no_bku'] = $no_bku;
		$html=$this->load->view('Laporan/excelMasterLap',$data,true);
		$title = 'master_laporan_'.$no_bku;

		$this->excel($title,$html,'html');
	}

	public function DLPerBulan(){
		$data['arrMsSdm'] = $this->MMsSdm->get(array('status'=>1,'pegawai_setda'=>1));
    	$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->MMsBagian->get();

		$this->template->load('Home/template','Laporan/formDLPerBulan',$data);
	}

	protected function queryDLPerBulan1($bln,$nama,$fk_bagian_id){
		$thn = $this->tahun;
		$andWhere='';
		if($nama){
			$no=1;$idSdm='';
			foreach ($nama as $val) {
				$koma='';
				if(count($nama) != $no){
					$koma=',';
				}
				$idSdm .= $val.$koma; 
				$no++;
			}
			$andWhere .= " AND fk_sdm_id in ($idSdm)";
		}
		if($fk_bagian_id!=''){
			// $no=1;$idBagian='';
			// foreach ($fk_bagian_id as $bd) {
			// 	$kma='';
			// 	if(count($fk_bagian_id) != $no){
			// 		$kma=',';
			// 	}
			// 	$idBagian .= $bd.$kma; 
			// 	$no++;
			// }
			// $andWhere .= " AND fk_bagian_id in ($idBagian)";
			$andWhere .= " AND fk_bagian_id=$fk_bagian_id";
		}

		$que = "SELECT fk_sdm_id,nama_sdm
				FROM t_pjd_detail td
				INNER JOIN t_pjd t ON t.id = td.fk_pjd_id 
				WHERE
					tahun = '$thn' 
					AND ( DATE_FORMAT( tgl_berangkat, '%m' ) = '$bln' OR DATE_FORMAT( tgl_tiba, '%m' ) = '$bln' ) $andWhere
				-- UNION
				-- SELECT fk_sdm_id,nama_sdm 
				-- FROM t_entri_lembur_detail eld
				-- INNER JOIN t_entri_lembur el ON el.id = eld.fk_entri_lembur_id 
				-- WHERE
				-- 	tahun = '$thn' 
				-- 	AND ( DATE_FORMAT( tgl_kegiatan_dari, '%m' ) = '$bln' OR DATE_FORMAT( tgl_kegiatan_sampai, '%m' ) = '$bln' ) $andWhere
				"; 
				// die(var_dump($que));
		return $this->db->query($que)->result();
	}

	protected function queryDLPerBulan2($bln,$nama,$fk_bagian_id){
		$thn = $this->tahun;
		$andWhere='';
		if($nama){
			$no=1;$idSdm='';
			foreach ($nama as $val) {
				$koma='';
				if(count($nama) != $no){
					$koma=',';
				}
				$idSdm .= $val.$koma; 
				$no++;
			}
			$andWhere .= " AND td.fk_sdm_id in ($idSdm)";
		}
		if($fk_bagian_id!=''){
			// $no=1;$idBagian='';
			// foreach ($fk_bagian_id as $bd) {
			// 	$kma='';
			// 	if(count($fk_bagian_id) != $no){
			// 		$kma=',';
			// 	}
			// 	$idBagian .= $bd.$kma; 
			// 	$no++;
			// }
			// $andWhere .= " AND fk_bagian_id in ($idBagian)";
			$andWhere .= " AND fk_bagian_id = $fk_bagian_id";
		}
		$que2 = "SELECT	fk_sdm_id,nama_sdm,kategori,
					DATE_FORMAT(tgl_berangkat, '%d-%m') tgl_berangkat,
					DATE_FORMAT(tgl_tiba, '%d-%m') tgl_tiba 	
				FROM
					t_pjd_detail td
				INNER JOIN t_pjd t ON t.id = td.fk_pjd_id 
				WHERE
					tahun = '$thn' 
					AND (DATE_FORMAT( tgl_berangkat, '%m' ) = '$bln' OR DATE_FORMAT( tgl_tiba, '%m' ) = '$bln') $andWhere
				GROUP BY fk_pjd_id,fk_sdm_id";
				// die(var_dump($que2));
		$hsl = $this->db->query($que2)->result();
		$hasil=array();
		foreach ($hsl as $val) {
			$hasil[$val->fk_sdm_id][]=$val;
		}
		return $hasil;
	}

	public function get_DLPerBulan(){		
		$bln = $this->input->post('bulan');
		$nama = $this->input->post('nama');
		$fk_bagian_id = $this->input->post('fk_bagian_id');

		$data['namaSDM'] = $this->queryDLPerBulan1($bln,$nama,$fk_bagian_id);
		$data['hasil'] = $this->queryDLPerBulan2($bln,$nama,$fk_bagian_id);
		$data['bulan'] = $bln;
		$data['nama'] = json_encode($nama);
		$data['fk_bagian_id'] = json_encode($fk_bagian_id);
		$this->load->view('Laporan/gridDLPerBulan',$data);
	}

	public function pdfDLPerBulan(){
		$bln = $this->input->post('bulan');
		$nama = json_decode($this->input->post('nama'));
		$fk_bagian_id = json_decode($this->input->post('fk_bagian_id'));
		if(empty($bln)){
			die('halama tidak bisa di refresh. Silahkan ulangi cetak PDF.');
		}
		$data['judul'] = "Bulan ".$this->help->namaBulan($bln). ' Tahun '.$this->tahun;
		$data['namaSDM'] = $this->queryDLPerBulan1($bln,$nama,$fk_bagian_id);
		$data['hasil'] = $this->queryDLPerBulan2($bln,$nama,$fk_bagian_id);
		$html=$this->load->view('Laporan/pdfDLPerBulan',$data,true);
		$title = 'LapPerBulanReaL_'.$bln.'-'.$this->tahun;

		$this->pdf($title,$html,'A4-L');
	}

	public function DLPerSdm(){
		$fk_bagian_id=null;
		if($this->level!=1){
			$fk_bagian_id=$this->fkBagianId;
		}
		$data['fk_bagian_id']=$fk_bagian_id;
		// $data['arrMsSdm'] = $this->MMsSdm->get(array('status'=>1,'pegawai_setda'=>1));
    	$data['arrBulan'] = $this->help->namaBulan();

		$this->template->load('Home/template','Laporan/formDLPerSdm',$data);
	}

	public function get_DLPerSdm(){
		$data['nama'] = $this->input->post('nama');
		$data['bulan_awal'] = $this->input->post('bulan_awal');
		$data['bulan_akhir'] = $this->input->post('bulan_akhir');
		$data['kategori'] = $this->input->post('kategori');

		$this->load->view('Laporan/gridDLPerSdm',$data);
	}

	public function getDatatablesDLPerSdm(){
		header('Content-Type: application/json');

        $nama = $this->input->post('nama');
		$bulan_awal = $this->input->post('bulan_awal');
		$bulan_akhir = $this->input->post('bulan_akhir');
		$kategori = $this->input->post('kategori');
		if($kategori){
			$this->datatables->where('kategori',$kategori);
		}
		
		$this->datatables->where("DATE_FORMAT(mulai, '%m') >=",$bulan_awal);
		$this->datatables->where("DATE_FORMAT(sampai, '%m') <=",$bulan_akhir);	
		$this->datatables->where('fk_sdm_id',$nama);
		$this->datatables->where('tahun',$this->tahun);
		
        $this->datatables->select('*');        
        $this->datatables->from("v_rekap_t_pjd_entri_lembur");
        $this->db->order_by("tgl_surat_tugas,mulai", "asc");
        echo $this->datatables->generate();
	}

	protected function queryDLPerSdm($nama,$bulan_awal,$bulan_akhir,$kategori){	
		if($kategori){
			$this->db->where('kategori',$kategori);
		}	
		$this->db->where("DATE_FORMAT(tgl_berangkat, '%m') >=",$bulan_awal);
		$this->db->where("DATE_FORMAT(tgl_berangkat, '%m') <=",$bulan_akhir);	
		$this->db->where('t_pjd_detail.fk_sdm_id',$nama);
		$this->db->where('t_pjd.tahun',$this->tahun);
		
        $this->db->select('t_pjd_detail.id,kategori,nama_sdm,no_surat_tugas,tujuan_skpd,acara,kegiatan');        
        $this->db->select("DATE_FORMAT(tgl_surat_tugas, '%d-%m-%Y') AS tglST", FALSE);
        $this->db->select("DATE_FORMAT(tgl_berangkat, '%d-%m-%Y') AS tglBrgkt", FALSE);
        $this->db->select("DATE_FORMAT(tgl_tiba, '%d-%m-%Y') AS tglTiba", FALSE);
        $this->db->from("t_pjd_detail");
        $this->db->join('t_pjd','t_pjd.id=t_pjd_detail.fk_pjd_id','inner');
        $this->db->order_by("t_pjd.tgl_surat_tugas,t_pjd.tgl_berangkat", "asc");

        return $this->db->get()->result();
	}

	public function pdfDLPerSdm(){
		$nama = $this->input->post('nama');
		$bulan_awal = $this->input->post('bulan_awal');
		$bulan_akhir = $this->input->post('bulan_akhir');
		$kategori = $this->input->post('kategori');
		if(empty($nama)){
			die('halama tidak bisa di refresh. Silahkan ulangi cetak PDF.');
		}
		$data['judul'] = "Bulan ".$this->help->namaBulan($bulan_awal). ' s/d '.$this->help->namaBulan($bulan_akhir);
		$data['hasil'] = $this->queryDLPerSdm($nama,$bulan_awal,$bulan_akhir,$kategori);
		$html=$this->load->view('Laporan/pdfDLPerSdm',$data,true);
		$title = 'LapDLPerSdm_'.date('d-m-Y');

		$this->pdf($title,$html,'A4-P');
	}

	public function excelDLPerSdm(){
		$nama=$_GET['nama'];
        $bulan_awal=$_GET['bulan_awal'];
        $bulan_akhir=$_GET['bulan_akhir'];
		
		$data['judul'] = "Bulan ".$this->help->namaBulan($bulan_awal). ' s/d '.$this->help->namaBulan($bulan_akhir);
		$data['hasil'] = $this->queryDLPerSdm($nama,$bulan_awal,$bulan_akhir);
		$html=$this->load->view('Laporan/pdfPerSdm',$data,true);
		$title = 'LapPerSdm_'.date('d-m-Y');

		$this->excel($title,$html);
	}

	//------------------------------------------------------//
	public function rekapLRA(){
    	$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->MMsBagian->get();

		$que = "SELECT DATE_FORMAT(max(tgl_per_perbup1),'%d/%m/%Y') tgl_per_perbup1, DATE_FORMAT(max(tgl_per_perbup2),'%d/%m/%Y') tgl_per_perbup2, DATE_FORMAT(max(tgl_per_perbup3),'%d/%m/%Y') tgl_per_perbup3, DATE_FORMAT(max(tgl_per_perbup4),'%d/%m/%Y') tgl_per_perbup4, DATE_FORMAT(max(tgl_pak),'%d/%m/%Y') tgl_pak FROM ms_rekening_belanja r INNER JOIN ms_kegiatan k ON k.id=r.fk_kegiatan_id
			WHERE k.tahun=$this->tahun";
		$data['tglPer'] = $this->db->query($que)->row(); 

		$this->template->load('Home/template','Laporan/formRekapLRA',$data);
	}

	public function cetakLRA(){
		$kategori = $this->input->post('kategori');
		$bulan = $this->input->post('bulan');
		$fk_bagian_id = $this->input->post('Bagian');
		$data['jenis_anggaran'] = $this->input->post('jenis_anggaran');
		$data['tampil_rekening'] = $this->input->post('tampil_rekening');

		$data['bulannya']=strtoupper($this->help->namaBulan($bulan)).' '.$this->tahun;

		$andBagian='';
		if($fk_bagian_id){
			$andBagian=" AND kb.fk_bagian_id=$fk_bagian_id";
			$queBid="SELECT id,nama_bagian FROM ms_bagian WHERE id=$fk_bagian_id";
			$data['hslBid'] = $this->db->query($queBid)->row();
		}

		$joinQuery = "INNER JOIN ms_kegiatan kb ON kb.id=rb.fk_kegiatan_id
					 INNER JOIN ms_program p ON p.id=kb.fk_program_id
					 INNER JOIN ms_program_utama pu ON pu.id=p.fk_program_utama_id
					 WHERE kb.tahun=$this->tahun $andBagian";

		//-------Perencanaan awal-----
		$queAwl = "SELECT sum(anggaran)tot_anggaran_all,sum(anggaran_per_perbup1)tot_anggaran_perbup1,sum(anggaran_per_perbup2)tot_anggaran_perbup2,sum(anggaran_per_perbup3)tot_anggaran_perbup3,sum(anggaran_per_perbup4)tot_anggaran_perbup4,sum(anggaran_pak)tot_anggaran_pak_all 
					FROM ms_rekening_belanja rb
					$joinQuery";
		$data['hslAwal'] = $this->db->query($queAwl)->row();
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
		if($kategori=='keuangan'){
			$whereBKU='info_no_bku > 0';
		}else{ //fisik
			$whereBKU='info_no_bku IS NOT NULL';
		}
		$data['kategori']=$kategori;

		$joinQueryDana = "INNER JOIN ms_kegiatan kb ON kb.id = pd.fk_kegiatan_id
					 INNER JOIN ms_program p ON p.id=kb.fk_program_id
					 INNER JOIN ms_program_utama pu ON pu.id=p.fk_program_utama_id
					 WHERE kb.tahun=$this->tahun AND status_pencairan=1 $andBagian AND $whereBKU";

		//---------Program Bulan Lalu-----------//
		$quelaluPjd = "SELECT
						pu.id id_prog,p.id id_keg,kb.id id_sub_keg,pd.fk_rekening_belanja_id,sum(pengajuan_sekarang) pengajuan_sekarang_pd
					FROM
						t_pjd_dana pd
						$joinQueryDana
						AND spj_bulan < $bulan";
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
						$joinQueryDana
						AND spj_bulan < $bulan";
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
		$queSkrgPjd = "SELECT
						pu.id id_prog,p.id id_keg,kb.id id_sub_keg,pd.fk_rekening_belanja_id,sum(pengajuan_sekarang) pengajuan_sekarang_pd
					FROM
						t_pjd_dana pd
						$joinQueryDana
						AND spj_bulan = $bulan";
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
						$joinQueryDana
						AND spj_bulan = $bulan";
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

		$html=$this->load->view('Laporan/pdfLRA',$data,true);
		$title = 'RincianLRA_'.date('d-m-Y');

		$this->pdf($title,$html,$this->help->folio_L());
	}

	
		// DAFTAR PERSEDIAAN

	protected function kategoriBrg(){
		$que="SELECT id_perihal,perihal 
				FROM pb_pesanan_barang 
				WHERE tahun_anggaran = '$this->tahun' AND terima_pesanan = '1'  AND id_perihal NOT IN (5,6)
				GROUP BY id_perihal";
		return $this->db->query($que)->result();
	}

	protected function queryPersediaanBarang(){
 		$que = "SELECT
					pbd.id, pb.id_perihal, pbd.fk_barang_id, nm_brg_gabung,satuan
				FROM
					pb_pesanan_barang_detail pbd
				  JOIN pb_pesanan_barang pb ON pb.id = pbd.fk_pesanan_barang_id 
				WHERE
					 pb.tahun_anggaran = '$this->tahun' AND status_verifikasi = '1' 
				GROUP BY fk_barang_id
				ORDER BY nm_brg_gabung";
		$hsl= $this->db->query($que)->result();
		$hslnya = array();
		foreach ($hsl as $val) {
			$hslnya[$val->id_perihal][]=$val;
		}

		return $hslnya;
	}

	protected function queryRekapSaldoAwal2(){
		$que="SELECT
					pbd.id, pbd.fk_barang_id, nm_brg_gabung, sum(qty_akhir) tot_qty_sa,satuan,harga_satuan_beli,sum(harga_satuan_beli*qty_akhir) tot_awal_beli
				FROM
					pb_pesanan_barang_detail pbd
				  JOIN pb_pesanan_barang pb ON pb.id = pbd.fk_pesanan_barang_id 
				WHERE
					 pb.tahun_anggaran = '$this->tahun' AND status_verifikasi = '1' AND fk_rekanan_id = 2 
				GROUP BY fk_barang_id
				ORDER BY nm_brg_gabung ";
		$hsl= $this->db->query($que)->result();
		$hsl1 = array();
		foreach ($hsl as $val) {
			$hsl1[$val->fk_barang_id]=$val;
		}

		return $hsl1;
	}

	protected function queryPengadaanSatuTahun(){
		$que="SELECT
					pbd.id, pbd.fk_barang_id, nm_brg_gabung, sum(qty_akhir) tot_qty_sa,satuan,sum(harga_satuan_beli*qty_akhir) tot_satuan_beli
				FROM
					pb_pesanan_barang_detail pbd
				  JOIN pb_pesanan_barang pb ON pb.id = pbd.fk_pesanan_barang_id 
				WHERE
					 pb.tahun_anggaran = '$this->tahun' AND status_verifikasi = '1' AND fk_rekanan_id != 2 
				GROUP BY fk_barang_id
				ORDER BY nm_brg_gabung ";
		$hsl= $this->db->query($que)->result();
		$hsl1 = array();
		foreach ($hsl as $val) {
			$hsl1[$val->fk_barang_id]=$val;
		}

		return $hsl1;
	}

	protected function queryBarangKeluarSatuTahun(){
		$que="SELECT
					pkd.id, pkd.fk_barang_id, nm_brg_gabung, sum(qty) tot_qty,satuan,SUM(harga_satuan*qty) tot_harga_keluar
				FROM
					pb_barang_keluar_detail pkd
					JOIN pb_barang_keluar pk ON pk.id = pkd.fk_barang_keluar_id
				WHERE
					 pk.tahun_anggaran = '$this->tahun' 
				GROUP BY fk_barang_id
				ORDER BY nm_brg_gabung ";
		$hsl= $this->db->query($que)->result();
		$hsl1 = array();
		foreach ($hsl as $val) {
			$hsl1[$val->fk_barang_id]=$val;
		}

		return $hsl1;
	}

	protected function queryHarga(){
		$que="SELECT
					pbd.id, pbd.fk_barang_id, nm_brg_gabung, harga_satuan_beli, jj.hrg_sat_beli_trkhir, SUM(harga_satuan_beli*qty_akhir) tot_harga_masuk
				FROM
					pb_pesanan_barang_detail pbd
				  JOIN pb_pesanan_barang pb ON pb.id = pbd.fk_pesanan_barang_id 
				  left JOIN (
						SELECT fk_barang_id,harga_satuan_beli as hrg_sat_beli_trkhir from pb_pesanan_barang_detail where sisa_stok_blm_diambil !=0 GROUP BY fk_barang_id
					) jj ON jj.fk_barang_id=pbd.fk_barang_id
				WHERE
					 pb.tahun_anggaran = '$this->tahun' AND status_verifikasi = '1' 
				GROUP BY fk_barang_id
				ORDER BY nm_brg_gabung ";
		$hsl= $this->db->query($que)->result();
		$hsl1 = array();
		foreach ($hsl as $val) {
			$hsl1[$val->fk_barang_id]=$val;
		}

		return $hsl1;
	}

	protected function ttd_atasan(){
        $que = "SELECT s.id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru, status_jabatan,status_jabatan_baru,
                CONCAT_WS('',status_jabatan,' ',jabatan) jabatan,CONCAT_WS('',status_jabatan_baru,' ',jabatan_baru)jabatan_baru,tmt_jabatan_baru,
                CASE WHEN jabatan_baru IS NULL THEN j.urut_ttd  ELSE jb.urut_ttd END AS urut_ttd
                FROM ms_sdm s
                JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
                LEFT JOIN ms_jabatan jb ON jb.id = s.fk_jabatan_id_baru
				WHERE s.`status` = 1 AND (j.eselon IN ( '2B' ) OR jb.eselon IN ( '2B'))
                ORDER BY urut_ttd";
        return $this->db->query($que)->result();    
    }

	protected function pejabat_pjphp(){
		$que = "SELECT s.id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,jabatan,j.urut_ttd FROM ms_sdm s
				JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
				WHERE s.id='34'
				ORDER BY urut_ttd";
		return $this->db->query($que)->result();	
	}

	protected function ksb_keu(){
		$que = "SELECT s.id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,jabatan,j.urut_ttd FROM ms_sdm s
				JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
				WHERE s.`status` = 1 AND j.id=26
				ORDER BY urut_ttd";
		return $this->db->query($que)->result();	
	}

	public function getNamaKepala(){
 		$data['dataNama'] = "<option value=''>.: Pilih :.</option>\n";
 		foreach ((array)$this->ttd_atasan() as $val) {
 			$jbtnBaru = $val->jabatan;
 			if($val->jabatan_baru!=' '){
 				$jbtnBaru = $val->jabatan_baru;
 			}
 			$data['dataNama'] .= "<option value=\"".$val->nama."_".$val->nip."_".$jbtnBaru."\">".$val->nama." [".$jbtnBaru."]"."</option>\n";
 		}

 		$data['dataPejabatPjphp'] = "<option value=''>.: Pilih :.</option>\n";
 		foreach ((array)$this->pejabat_pjphp() as $val) {
 			$data['dataPejabatPjphp'] .= "<option value=\"".$val->nama."_".$val->nip."_".$val->jabatan."_".$val->gol_pangkat."_".$val->gol_pangkat_baru."\">".$val->nama." [".$val->jabatan."]"."</option>\n";
 		}

 		$data['dataKsbKeu'] = "<option value=''>.: Pilih :.</option>\n";
 		foreach ((array)$this->ksb_keu() as $val) {
 			$data['dataKsbKeu'] .= "<option value=\"".$val->nama."_".$val->nip."_".$val->jabatan."\">".$val->nama." [".$val->jabatan."]"."</option>\n";
 		}

 		echo json_encode($data);
 	}

 	protected function pejabat_pengurus_brg(){
		$que = "SELECT id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,jabatan,jabatan_baru 
				FROM ms_sdm	WHERE id='34'";
		return $this->db->query($que)->result();	
	}

	protected function bndhr_pngluaran(){
		$que = "SELECT id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,jabatan,jabatan_baru 
				FROM ms_sdm	WHERE bendahara='1'";
		return $this->db->query($que)->result();	
	}

 	public function getPejabatPersediaan(){
 		$data['dataNama'] = "<option value=''>.: Pilih :.</option>\n";
 		foreach ((array)$this->ttd_atasan() as $val) {
 			$jbtnBaru = $val->jabatan;
 			if($val->jabatan_baru!=' '){
 				$jbtnBaru = $val->jabatan_baru;
 			}
 			$data['dataNama'] .= "<option value=\"".$val->nama."_".$val->nip."_".$jbtnBaru."\">".$val->nama." [".$jbtnBaru."]"."</option>\n";
 		}

 		$data['dataPejabatPengurusBrg'] = "<option value=''>.: Pilih :.</option>\n";
 		foreach ((array)$this->pejabat_pengurus_brg() as $val) {
 			$data['dataPejabatPengurusBrg'] .= "<option value=\"".$val->nama."_".$val->nip."\">".$val->nama." [".$val->jabatan."]"."</option>\n";
 		}

 		$data['dataBndhrPengeluaran'] = "<option value=''>.: Pilih :.</option>\n";
 		foreach ((array)$this->bndhr_pngluaran() as $val) {
 			$data['dataBndhrPengeluaran'] .= "<option value=\"".$val->nama."_".$val->nip."\">".$val->nama." [".$val->jabatan."]"."</option>\n";
 		}

 		echo json_encode($data);
 	}
 	
	public function daftarPersediaan(){
		$data['tahun'] = $this->tahun;
		$data['kategori'] = $this->kategoriBrg();
		$data['hasil'] = $this->queryPersediaanBarang();
		$data['saldoAwal'] = $this->queryRekapSaldoAwal2();
		$data['pengadaan1Thn'] = $this->queryPengadaanSatuTahun();
		$data['barangKeluar1Thn'] = $this->queryBarangKeluarSatuTahun();
		$data['hargaBarang'] = $this->queryHarga();

		$this->template->load('Home/template','Laporan/gridDaftarPersediaan',$data);
	}

	public function pdfDaftarPersediaan(){
		$kpl = explode('_', $this->input->post('nama_kepala'));
		$data['nama_kepala'] = $kpl[0];
		$data['nip_kepala'] = $kpl[1];
		$data['jabatan_kepala'] = $kpl[2];

		$pjp = explode('_', $this->input->post('nama_pjphp'));
		$data['nama_pjphp'] = $pjp[0];
		$data['nip_pjphp'] = $pjp[1];
		$data['jabatan_pjphp'] = $pjp[2];

		$tgl = explode('-', $this->input->post('tanggal'));
		$data['tanggal'] = $tgl[0].' '.$this->help->namaBulan($tgl[1]).' '.$tgl[2];
		
		$data['tahun'] = $this->tahun;
		$data['kategori'] = $this->kategoriBrg();
		$data['hasil'] = $this->queryPersediaanBarang();
		$data['saldoAwal'] = $this->queryRekapSaldoAwal2();
		$data['pengadaan1Thn'] = $this->queryPengadaanSatuTahun();
		$data['barangKeluar1Thn'] = $this->queryBarangKeluarSatuTahun();
		$data['hargaBarang'] = $this->queryHarga();
		
		$html=$this->load->view('Laporan/pdfDaftarPersediaan',$data,true);
		$title = 'DaftarPersediaan_'.$this->tahun;

		$this->pdf($title,$html,$this->help->folio_L());
	}

	public function pdfDaftarPersediaan2(){
		$kpl = explode('_', $this->input->post('nama_kepala2'));
		$data['nama_kepala'] = $kpl[0];
		$data['nip_kepala'] = $kpl[1];
		$data['jabatan_kepala'] = $kpl[2];

		$pjp = explode('_', $this->input->post('nama_pngrs_brg'));
		$data['nama_pngrs'] = $pjp[0];
		$data['nip_pngrs'] = $pjp[1];

		$bnd = explode('_', $this->input->post('nama_bndhr_pnglrn'));
		$data['nama_bndhra'] = $bnd[0];
		$data['nip_bndhra'] = $bnd[1];
		
		$data['tahun'] = $this->tahun;
		$data['kategori'] = $this->kategoriBrg();
		$data['hasil'] = $this->queryPersediaanBarang();
		$data['saldoAwal'] = $this->queryRekapSaldoAwal2();
		$data['pengadaan1Thn'] = $this->queryPengadaanSatuTahun();
		$data['barangKeluar1Thn'] = $this->queryBarangKeluarSatuTahun();
		$data['hargaBarang'] = $this->queryHarga();
		
		$html=$this->load->view('Laporan/pdfDaftarPersediaan2',$data,true);
		$title = 'DaftarPersediaan_'.$this->tahun;

		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
		// $this->excel($title,$html);
	}

	public function pdfBeritaAcara(){
		$kpl = explode('_', $this->input->get('nama_kepala'));
		$data['nama_kepala'] = $kpl[0];
		$data['nip_kepala'] = $kpl[1];
		$data['jabatan_kepala'] = $kpl[2];

		$pjp = explode('_', $this->input->get('nama_pjphp'));
		$data['nama_pjphp'] = $pjp[0];
		$data['nip_pjphp'] = $pjp[1];
		$data['jabatan_pjphp'] = $pjp[2];
		$data['gol'] = $pjp[3];
		$data['gol_baru'] = $pjp[4];

		$keu = explode('_', $this->input->get('nama_ksb_keu'));
		$data['nama_ksb_keu'] = $keu[0];
		$data['nip_ksb_keu'] = $keu[1];
		$data['jabatan_ksb_keu'] = $keu[2];

		$tgg = $this->input->get('tanggal');
		$tgl = explode('-', $tgg);
		$data['tanggal'] = $tgl[0].' '.$this->help->namaBulan($tgl[1]).' '.$tgl[2];
		$data['tanggal2'] = $tgg;

		$data['tahun'] = $this->tahun;
		$data['kategori'] = $this->kategoriBrg();
		$data['hasil'] = $this->queryPersediaanBarang();
		$data['saldoAwal'] = $this->queryRekapSaldoAwal2();
		$data['pengadaan1Thn'] = $this->queryPengadaanSatuTahun();
		$data['barangKeluar1Thn'] = $this->queryBarangKeluarSatuTahun();
		$data['hargaBarang'] = $this->queryHarga();

		$data['header'] = $this->help->headerLaporan();

		$html=$this->load->view('Laporan/pdfBeritaAcara',$data,true);
		$title = 'BeritaAcaraStok_'.$this->tahun;
		$pageNo=false;

		// echo $html;
		$this->pdf($title,$html,$this->help->folio_P(),$pageNo);
	}

	public function transaksiHarian(){
    	$data['arrBulan'] = $this->help->namaBulan();

		$this->template->load('Home/template','Laporan/formTransaksiHarian',$data);
	}

	public function cetakTransaksiHarian(){
		$bulan = $this->input->post('bulan');

		$que = "SELECT rb.id,rb.nama_rek_belanja,rb.kode_rek_belanja,DATE_FORMAT(pn.tgl_pencairan,'%d-%m-%Y') tgl_pencairan,r.ppn_skrg,r.pph21_skrg,r.pph22_skrg,r.pph23_skrg
				FROM t_rekap_dana r
				INNER JOIN t_pencairan_dana pn ON pn.id=r.fk_pencairan_dana_id
				INNER JOIN ms_rekening_belanja rb ON rb.id=r.fk_rekening_belanja_id
				WHERE tahun=$this->tahun AND r.status_pencairan=1 AND DATE_FORMAT(tgl_pencairan,'%m')='$bulan' AND (ppn_skrg > 0 OR pph21_skrg > 0 OR pph22_skrg > 0 OR pph23_skrg > 0)
				ORDER BY pn.tgl_pencairan,r.fk_bagian_id ASC";
		$data['hasil'] = $this->db->query($que)->result();

		$data['bulan']=$this->help->namaBulan($bulan);
		$data['tahun']=$this->tahun;

		$html=$this->load->view('Laporan/pdfTransaksiHarian',$data,true);
		$title = 'DaftarTransaksiHariab_'.$bulan.$this->tahun;

		// echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
		$this->excel($title,$html);
	}

	protected function pdf($title,$html,$page,$footer=true,$batas=false){
		// echo $html;
        if($batas){
			$mpdf = new mPDF('utf-8', $page);
		}else{
        	$mpdf = new mPDF('', $page, 0, '', 8, 8, 8, 10, 8, 8);
        }
        $mpdf->AddPage();
        if($footer){
        	$mpdf->SetFooter('{PAGENO}/{nbpg}');
        }
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