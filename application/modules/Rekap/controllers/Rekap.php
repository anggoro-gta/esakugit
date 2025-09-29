<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		// $this->load->model('MRapat');
		// $this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		$this->load->model('MKwitansiHr');
		$this->load->model('MMsKegiatan');
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
		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrBulan'] = $this->help->namaBulan();
		$this->template->load('Home/template','Rekap/list',$data);
	}

	public function getListDetail(){
		$data['bulan'] = $this->input->post('bulan');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->arrBagian();

		$this->load->view('Rekap/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

        $tahun = $this->tahun;
		$bulan = $this->input->post('bulan');
		$fk_bagian_id = $this->input->post('fk_bagian_id');
		$fk_program_id = $this->input->post('fk_program_id');
		$fk_kegiatan_id = $this->input->post('fk_kegiatan_id');

		$this->datatables->where('tahun',$tahun);
		// $this->db->where_not_in('dari_tabel', 't_gaji_tpp');
		$this->datatables->where("dari_tabel!=","t_gaji_tpp");
		if($bulan){
			$this->datatables->where("spj_bulan",$bulan);
		}
		if($fk_bagian_id){
			$this->datatables->where('fk_bagian_id',$fk_bagian_id);
		}
		if($fk_program_id){
			$this->datatables->where('fk_program_id',$fk_program_id);
		}
		if($fk_kegiatan_id){
			$this->datatables->where('fk_kegiatan_id',$fk_kegiatan_id);
		}

        $this->datatables->select('id,nama_bulan,kategori_rekap,info_no_bku,hasil_bku,singkatan_bagian,kegiatan,nama_rek_belanja,jml_dana_idr,pengajuan_sebelum_idr,pengajuan_sekarang_idr,sisa_kas_idr,tabelnya,dari_tabel,status_pencairan,kategori_hr');
        $this->datatables->select("DATE_FORMAT(tgl_rekap, '%d/%m/%Y') AS tgl_rekap", FALSE);
        $this->datatables->from("v_pjd_dan_rekap_dana");
        $this->db->order_by("v_pjd_dan_rekap_dana.tgl_rekap", "desc");
        echo $this->datatables->generate();
	}

	public function getKegiatanRekap(){
 		$kategori_rekap=$this->input->post('kategori_rekap');
 		$kolomTahun='tahun';
 		if($kategori_rekap=='Perjadin'){
 			$tabel = 't_pjd';
 		}
 		if($kategori_rekap=='Lembur'){
 			$tabel = 't_entri_lembur';
 		}
 		if($kategori_rekap=='Rapat'){
 			$tabel = 't_rapat';
 		}
 		if($kategori_rekap=='Honorarium'){
 			$tabel = 't_kwitansi_hr';
 		}

 		$andWhere='';
 		if($kategori_rekap=='Barang_ATK'){
 			$tabel = 'pb_pesanan_barang';
 			$andWhere=" AND terima_pesanan='1' AND fk_rekanan_id!=2";
 			$kolomTahun='tahun_anggaran';
 		}

 		if($kategori_rekap=='Barang_Lainnya'){
 			$tabel = 't_kwitansi';
 			$andWhere=" AND jenis_belanja='Barang'";
 		}
 		if($kategori_rekap=='Jasa_Lainnya'){
 			$tabel = 't_kwitansi';
 			$andWhere=" AND jenis_belanja LIKE '%Jasa Lainnya%'";
 		}
 		if($kategori_rekap=='Swakelola'){
 			$tabel = 't_kwitansi';
 			$andWhere=" AND jenis_belanja='Swakelola'";
 		}
 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$que = "SELECT fk_kegiatan_id,kegiatan FROM $tabel WHERE $kolomTahun=$this->tahun AND is_spj='0' AND fk_bagian_id=$fk_bagian_id $andWhere GROUP BY fk_kegiatan_id";
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

 		$que = "SELECT rb.id,kode_rek_belanja,nama_rek_belanja FROM ms_rekening_belanja rb INNER JOIN ms_kegiatan kb ON kb.id=rb.fk_kegiatan_id WHERE kb.tahun=$this->tahun AND kb.fk_bagian_id=$fk_bagian_id AND rb.fk_kegiatan_id=$fk_kegiatan_id"; 	
 		$hasil = $this->db->query($que)->result_array();

 		$data['nama_rek'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hasil as $val) {
 			$data['nama_rek'] .= "<option value=\"".$val['id']."\">".$val['kode_rek_belanja'].' ['.$val['nama_rek_belanja'].']'."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getCariDanaSblm(){
 		$id_rek=$this->input->post('id_rek');
 		$kategori_rekap=$this->input->post('kategori_rekap');
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

 		if($kategori_rekap=='Honorarium'){
	 		$que = "SELECT sum(bpjs_kes_pemkab+bpjs_kes_peserta+bpjs_krj_jkk+bpjs_krj_jkm) pajak_bpjs, sum(((sub_total_bruto*jml_kali)*pajak_persen)/100) pajak_kegiatan FROM t_rekap_dana rd INNER JOIN t_kwitansi_hr h ON h.fk_rekap_dana_id=rd.id INNER JOIN t_kwitansi_hr_detail hd ON hd.fk_kwitansi_hr_id=h.id WHERE rd.fk_rekening_belanja_id=$id_rek";
	 		$hsl3 = $this->db->query($que)->row();
	 		$data['pajak_bpjs']=!empty($hsl3->pajak_bpjs)?$hsl3->pajak_bpjs:0;
	 		$data['pajak_kegiatan']=!empty($hsl3->pajak_kegiatan)?$hsl3->pajak_kegiatan:0;
	 	}

	 	if($kategori_rekap=='Barang_Lainnya' || $kategori_rekap=='Jasa_Lainnya' || $kategori_rekap=='Swakelola'){
	 		$que4="SELECT sum((IF(ppn IS NULL, 0, ppn))+(IF(pph_21 IS NULL, 0, pph_21))+(IF(pph_22 IS NULL, 0, pph_22))+(IF(pph_23 IS NULL, 0, pph_23))) tot_pajak_sebelum FROM t_rekap_dana rd INNER JOIN t_kwitansi k ON k.fk_rekap_dana_id=rd.id WHERE rd.fk_rekening_belanja_id=$id_rek";
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

	 	if($kategori_rekap=='Rapat'){
	 		$que5="SELECT sum((IF(pajak_daerah IS NULL, 0, pajak_daerah))+(IF(pph_23 IS NULL, 0, pph_23))) tot_pajak_sebelum FROM t_rekap_dana rd INNER JOIN t_rapat k ON k.fk_rekap_dana_id=rd.id WHERE rd.fk_rekening_belanja_id=$id_rek";
	 		$hsl5 = $this->db->query($que5)->row();
	 		$data['pajak_rapat_sblm']=!empty($hsl5->tot_pajak_sebelum)?$hsl5->tot_pajak_sebelum:0;
	 	}

	 	if($kategori_rekap=='Lembur'){
	 		$que6="SELECT (uang_makan * sum(jml_makan)) jumlah, sum(((tarif*jml_jam)*pph21)/100) jml_21,pph_23_persen FROM t_rekap_dana rd 
	 		INNER JOIN t_entri_lembur k ON k.fk_rekap_dana_id=rd.id 
	 		INNER JOIN t_entri_lembur_detail td ON td.fk_entri_lembur_id=k.id
	 		WHERE k.fk_rekening_belanja_id=$id_rek";
	 		$hsl6 = $this->db->query($que6)->row();
	 		$pjkDrh = $this->help->pembulatanSeratus(ceil($hsl6->jumlah*(10/100)));
            $nilaipph = $this->help->pembulatanSeratus(ceil(($hsl6->jumlah)*($hsl6->pph_23_persen/100))+$hsl6->jml_21);
            $totPjk = $pjkDrh+$nilaipph;
            
            $data['pajak_lembur_sblm']=$totPjk;
	 	}

 		echo json_encode($data);
 	}

 	public function updateTgl(){
		$id_rekap_dana = $this->input->post('id_rekap_dana');
		$tgl_rekap = $this->help->ReverseTgl($this->input->post('tgl_rekap'));
		$namaTabelnya = $this->input->post('namaTabelnya');
		if($namaTabelnya=='rekap_dana'){
			$tabel = 't_rekap_dana';
		}else{
			$tabel = 't_pjd_dana';
		}
		$this->db->trans_start();

			$data2 = array(
			        'tgl_rekap' => $tgl_rekap,
			);
			$this->db->where('id', $id_rekap_dana);
			$this->db->update($tabel, $data2);
		 	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal dihapus.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Tgl Berhasil diupdate.');
		}

		redirect('Rekap');
	}

 	public function get_dataUpdateRekap(){
		$tahun=$this->tahun;
 		$kategori_rekap=$this->input->post('kategori_rekap');
 		if($kategori_rekap=='Lembur'){
 			$tabel = 't_entri_lembur';
 		}
 		if($kategori_rekap=='Rapat'){
 			$tabel = 't_rapat';
 		}
 		if($kategori_rekap=='Honorarium'){
 			$tabel = 't_kwitansi_hr';
 		}
 		if($kategori_rekap=='Barang_Lainnya' || $kategori_rekap=='Jasa_Lainnya' || $kategori_rekap=='Swakelola'){
 			$tabel = 't_kwitansi';
 		}
 		if($kategori_rekap=='Barang_ATK'){
 			$tabel = 'pb_pesanan_barang';
 		}
 		if($kategori_rekap=='Perjadin'){
 			$tabel = 't_pjd';
 		}

		$data['tabel']=$tabel;
		$fk_bagian_id=$this->input->post('fk_bagian_id');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$fk_rekening_belanja_id=$this->input->post('fk_rekening_belanja_id');
		$data['updateRkp']=true;

		if($tabel=='t_kwitansi_hr'){
			$queB = "SELECT DISTINCT t.*,sum((sub_total_bruto*jml_kali)+bpjs_kes_pemkab+bpjs_krj_jkk+bpjs_krj_jkm) total_akhir_all FROM $tabel t
 				JOIN t_kwitansi_hr_detail td ON td.fk_kwitansi_hr_id=t.id
 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND fk_rekening_belanja_id='$fk_rekening_belanja_id' AND is_spj='0'
 				GROUP BY t.id
 				ORDER BY t.hr_bulan, t.tgl_kwitansi"; 	
 			$data['is_kwi_hr']='yes';
 		}	
 		if($tabel=='t_kwitansi'){ 			
			if($kategori_rekap=='Jasa_Lainnya'){
				$kategorinya='Jasa Lainnya/ Jasa Konsultansi/ Pekerjaan Kontruksi';
			}
			if($kategori_rekap=='Barang_Lainnya'){
				$kategorinya='Barang';
			}
			if($kategori_rekap=='Swakelola'){
				$kategorinya='Swakelola';
			}
 			$data['is_kwi_hr']='no';
 			$queB = "SELECT id,tgl_kwitansi,untuk_pembayaran,kegiatan,banyaknya_uang total_akhir_all FROM $tabel t
 				WHERE tahun='$tahun' AND jenis_belanja LIKE '%$kategorinya%' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND fk_rekening_belanja_id='$fk_rekening_belanja_id' AND is_spj='0'
 				GROUP BY t.id
 				ORDER BY tgl_kwitansi";
 		}	
 		if($tabel=='t_rapat'){
 			$queB = "SELECT id,tgl,hari,pukul,tempat,acara,tgl_kwitansi,kegiatan,total_all total_akhir_all FROM $tabel t
 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND fk_rekening_belanja_id='$fk_rekening_belanja_id' AND is_spj='0'
 				GROUP BY t.id
 				ORDER BY tgl_kwitansi"; 
 		}
 		if($tabel=='t_entri_lembur'){
 			$queB = "SELECT t.id,tgl_surat_tugas,perihal,tgl_kegiatan_dari,tgl_kegiatan_sampai,kegiatan,(uang_makan * sum(jml_makan)+(sum(jml_jam*tarif))) total_akhir_all FROM $tabel t
 				INNER JOIN t_entri_lembur_detail td ON td.fk_entri_lembur_id=t.id
 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND fk_rekening_belanja_id='$fk_rekening_belanja_id' AND is_spj='0'
 				GROUP BY t.id
 				ORDER BY tgl_surat_tugas"; 
 		}
		if($tabel=='t_pjd'){
 			$kategori_pjd=$this->input->post('kategori_pjd');
			$queB = "SELECT DISTINCT t.*,count(td.id) total_pjd, sum(total_akhir) total_akhir_all FROM $tabel t
 				JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND fk_rekening_belanja_id='$fk_rekening_belanja_id' AND kategori='$kategori_pjd'
 					AND (bulan IS NULL OR fk_pjd_dana_id IS NULL)
 				GROUP BY t.id
 				ORDER BY t.bulan, t.tgl_tiba"; 
 		}
 		if($tabel=='pb_pesanan_barang'){
			$data['updateRkp']=true;

			$queB = "SELECT DISTINCT pb.*, rc.nama_rekanan, sum(harga_satuan_beli*qty_akhir) total_akhir_all FROM pb_pesanan_barang_detail pbd INNER JOIN pb_pesanan_barang pb ON pb.id=pbd.fk_pesanan_barang_id INNER JOIN pb_ms_rekanan rc ON rc.id=pb.fk_rekanan_id WHERE tahun_anggaran=$tahun AND fk_bagian_id=$fk_bagian_id AND fk_kegiatan_id=$fk_kegiatan_id AND is_spj='0'
				GROUP BY pb.id
				ORDER BY pb.tgl_kuitansi"; 	
 		}

 		$data['hasil'] = $this->db->query($queB)->result_array();
		$this->load->view('Rekap/gridDataUpdateRekap',$data);
	}

	public function create(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->arrBagian();
		$data['url'] = base_url().'Rekap/proses_update_rekap';
		
		$this->template->load('Home/template','Rekap/form',$data);
	}

	public function proses_update_rekap(){
		$kategori_rekap=$this->input->post('kategori_rekap');
		$bulan=$this->input->post('bulan');
		$fk_bagian_id=$this->input->post('fk_bagian_id');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$fk_rekening_belanja_id=$this->input->post('fk_rekening_belanja_id');
		$no_bku=$this->input->post('no_bku');
		$tgl_rekap=$this->help->ReverseTgl($this->input->post('tgl_rekap'));
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
			redirect('Rekap/create');
		}

		$oderTgl = 'tgl_kwitansi';
		if($kategori_rekap=='Lembur'){
 			$driTabel = 't_entri_lembur';
 		}
 		if($kategori_rekap=='Rapat'){
 			$driTabel = 't_rapat';
 		}
 		if($kategori_rekap=='Honorarium'){
 			$driTabel = 't_kwitansi_hr';
 		}
 		if($kategori_rekap=='Barang_Lainnya' || $kategori_rekap=='Jasa_Lainnya' || $kategori_rekap=='Swakelola'){
 			$driTabel = 't_kwitansi';
 		}
 		if($kategori_rekap=='Barang_ATK'){
 			$driTabel = 'pb_pesanan_barang';
 			$oderTgl = 'tgl_kuitansi';
 		}
 		if($kategori_rekap=='Perjadin'){
 			$driTabel = 't_pjd';
 			$oderTgl = 'tgl_surat_tugas';
 		}


		$qwe = "SELECT id FROM $driTabel WHERE id in ($plh2) ORDER BY $oderTgl";
		$dtl = $this->db->query($qwe)->result();

		
		$this->db->trans_start();	
			$jml_dana=str_replace(',', '', $this->input->post('jml_dana'));
			$pengajuan_sebelum=str_replace(',', '', $this->input->post('pengajuan_sebelum'));
			$pengajuan_sekarang=str_replace(',', '', $this->input->post('pengajuan_sekarang'));
			$sisa_kas=str_replace(',', '', $this->input->post('sisa_kas'));	
				$pjkBpjs = $this->input->post('tot_pajak_bpjs');
			$pajak_bpjs=!empty($pjkBpjs)?$pjkBpjs:0;
				$pjkKgtan = $this->input->post('tot_pajak_kegiatan');
			$pajak_kegiatan=!empty($pjkKgtan)?$pjkKgtan:0;
				$pjkKwtnsi = $this->input->post('tot_pajak_sblm');
			$pajak_tbl_kwitansi=!empty($pjkKwtnsi)?$pjkKwtnsi:0;
				$pjkRapat=$this->input->post('tot_pajak_rapat_sblm');
			$pajak_rapat=!empty($pjkRapat)?$pjkRapat:0;
				$pjkLmbur = $this->input->post('tot_pajak_lembur_sblm');		
			$pajak_lembur=!empty($pjkLmbur)?$pjkLmbur:0;	

			$user_act = $this->session->id;
			$time_act = date('Y-m-d H:i:s');

			if($kategori_rekap=='Perjadin'){
				$kategori_pjd=$this->input->post('kategori_pjd');
				$noBaru = '001';
				$que = "insert into t_pjd_dana (spj_bulan,kategori_rekap,tgl_rekap,fk_bagian_id,fk_kegiatan_id,kategori,info_no_bku,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,fk_rekening_belanja_id,user_act,time_act)
					values('$bulan','$kategori_rekap','$tgl_rekap',$fk_bagian_id,$fk_kegiatan_id,'$kategori_pjd','$no_bku',$jml_dana,$pengajuan_sebelum,$pengajuan_sekarang,$sisa_kas,$fk_rekening_belanja_id,$user_act,'$time_act')";
				$this->db->query($que);
				$idRekap = $this->db->insert_id();

				$data['bulan']=$bulan;
				$data['is_spj']='1';
				// $data['no_bku']=$no_bku;
				$data['fk_pjd_dana_id']=$idRekap;
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

			}else{
				$noBaru = '1';				
				$que = "insert into t_rekap_dana (dari_tabel,spj_bulan,kategori_rekap,tgl_rekap,fk_bagian_id,fk_kegiatan_id,fk_rekening_belanja_id,info_no_bku,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,pajak_bpjs,pajak_kegiatan,pajak_tbl_kwitansi,pajak_rapat,pajak_lembur,user_act,time_act)
					values('$driTabel','$bulan','$kategori_rekap','$tgl_rekap',$fk_bagian_id,$fk_kegiatan_id,$fk_rekening_belanja_id,'$no_bku',$jml_dana,$pengajuan_sebelum,$pengajuan_sekarang,$sisa_kas,$pajak_bpjs,$pajak_kegiatan,$pajak_tbl_kwitansi,$pajak_rapat,$pajak_lembur,$user_act,'$time_act')";
				$this->db->query($que);
				$idRekap = $this->db->insert_id();

				foreach ($dtl as $val) {
					$data2[] =  array(
				      'id' => $val->id,
				      'spj_bulan' => $bulan,
				      'is_spj' => '1',
				      // 'no_bku' => $no_bku,
				      'no_kwitansi_rekap' => $noBaru,
				      'fk_rekap_dana_id' => $idRekap,
				   	);
					$noBaru = $noBaru+1;
				}
				$this->db->update_batch("$driTabel", $data2, 'id');
	 
				$this->session->set_flashdata('success', 'Buat Rekap berhasil.');
			}

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
		}	
		
		redirect('Rekap');
	}

	public function delRekap($ket,$id_rekap){
		$cek = $this->db->query("SELECT dari_tabel,status_pencairan FROM v_pjd_dan_rekap_dana WHERE tabelnya='$ket' AND id=$id_rekap")->row();
		$dariTable= $cek->dari_tabel;

		if($cek->status_pencairan==1){
			$this->session->set_flashdata('error', 'Data sudah dilakukan Proses Pencairan.');
			redirect('Rekap');
		}

		$this->db->trans_start();
			if($ket=='pjd_dana'){	
				$tableRekap='t_pjd_dana';			
		    	$data = array(
			        'bulan' => NULL,
			        'is_spj' => '0',
			        'no_bku' => NULL,
			        'fk_pjd_dana_id' => NULL,
				);
		    	$this->db->where('fk_pjd_dana_id', $id_rekap);
			}else{
				$tableRekap='t_rekap_dana';
				$data = array(
			        'spj_bulan' => NULL,
			        'is_spj' => '0',
			        'no_bku' => NULL,
			        'no_kwitansi_rekap' => NULL,
			        'fk_rekap_dana_id' => NULL,
				);
				$this->db->where('fk_rekap_dana_id', $id_rekap);
			}
			$this->db->update("$dariTable", $data);

			$this->db->delete("$tableRekap", array('id' => $id_rekap));
		   	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal dihapus.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil dihapus.');
		}

		redirect('Rekap');
	}

	public function updateNarsum($id_rekap){
		$data['arrKwitansiHr'] = $this->MKwitansiHr->get(array('fk_rekap_dana_id'=>$id_rekap));
		$this->template->load('Home/template','Rekap/listHRNarsum',$data);
	}

	public function updateNarsumDtl($id_rekap,$id_hr){
		$data['id_rekap']=$id_rekap;
		$data['arrKwitansiHRDetail'] = $this->MKwitansiHr->getDetail(array('fk_kwitansi_hr_id'=>$id_hr));
		$this->template->load('Home/template','Rekap/formEditKwiHrDtl',$data);
	}

	public function saveNamaNarsum(){
		$idRekap=$this->input->post('idRekap');
		$listNamaNarsum=$this->input->post('listNamaNarsum');
		$listRekeningNarsum=$this->input->post('listRekeningNarsum');
		$listBankNarsum=$this->input->post('listBankNarsum');
		$listNpwpNarsum=$this->input->post('listNpwpNarsum');

		if(isset($listNamaNarsum)){
			foreach ($listNamaNarsum as $key => $val) {
				$data[] = array(
							'id'=>$key,
							'nama'=>$val,
							'no_rekening_narsum'=>$listRekeningNarsum[$key],
							'nama_bank_narsum'=>$listBankNarsum[$key],
							'npwp_narsum'=>$listNpwpNarsum[$key],
						);
			}
			$this->db->update_batch('t_Kwitansi_hr_detail', $data, 'id');
		}

		$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		redirect('Rekap/updateNarsum/'.$idRekap);
	}

	public function cetakRekap($ket,$id_rekap){
		$cek = $this->db->query("SELECT tahun,dari_tabel,tgl_rekap,spj_bulan,fk_bagian_id,info_no_bku,kode_rek_belanja FROM v_pjd_dan_rekap_dana WHERE tabelnya='$ket' AND id=$id_rekap")->row();

		$fkBagian=$cek->fk_bagian_id;
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}
		$data['bag'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();
		$data['info_no_bku']=$cek->info_no_bku;
		$data['kode_rek_belanja']=$cek->kode_rek_belanja;

		$dariTabel= $cek->dari_tabel;
		$tgl_rekap=$this->help->ReverseTgl($cek->tgl_rekap);

		if($dariTabel=='t_pjd'){
			$queAwl="SELECT * FROM t_pjd_dana WHERE id=$id_rekap ";
			$pjdDana=$this->db->query($queAwl)->row();
	 		$data['dana']=$pjdDana;


			$que = "SELECT no_bku,nama_bagian,singkatan_kegiatan,tgl_berangkat,tgl_tiba,tujuan_skpd,kota,acara,td.* FROM t_pjd t
	 	 			JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
	 	 			WHERE fk_pjd_dana_id=$id_rekap
	 			";
	 		$que2 = " GROUP BY fk_sdm_id,td.fk_pjd_id ORDER BY tgl_berangkat,eselon"; //no_surat_tugas
	 		$data['hasil']=$this->db->query($que.$que2)->result_array(); 			

			$que1 = "SELECT no_bku,nama_bagian,singkatan_kegiatan,td.* FROM t_pjd t
	 				JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
	 				WHERE fk_pjd_dana_id=$id_rekap
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

	 		$data['tahun']=$cek->tahun;
	 		$data['bulan']=$cek->spj_bulan;
	 	///	
	 		$data['kategori']=$pjdDana->kategori;
	 		$keg = $this->MMsKegiatan->get(array('id'=>$pjdDana->fk_kegiatan_id));
	 		$data['keg'] = $keg[0];
	 		$idProgram = $keg[0]['fk_program_id'];
	 		// $data['prog'] = $this->MMsProgram->get(array('id'=>$keg[0]['fk_program_id']));
	 		$data['prog'] = $this->db->query("SELECT CONCAT(kode,'.',kode_program) kode FROM ms_program p LEFT JOIN ms_program_utama pu ON pu.id=p.fk_program_utama_id WHERE p.id=$idProgram")->row();

	 		$data['tgl_cetak']=$tgl_rekap;

	 			$cari = $this->db->query("SELECT nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara FROM t_pjd WHERE fk_pjd_dana_id=$id_rekap ORDER BY id DESC limit 1")->row();
	 		// $data['kpa']='';
	 		$data['nama_pejabat_pptk']=$cari->nama_pejabat_pptk;
	 		$data['nip_pejabat_pptk']=$cari->nip_pejabat_pptk;
	 		$data['nama_bendahara']=$cari->nama_bendahara;
	 		$data['nip_bendahara']=$cari->nip_bendahara;

			$html=$this->load->view('Rekap/cetakRekapPjd',$data,true);
			$title = 'Cetak Rekap Pjd '.$tgl_rekap;
		}

		if($dariTabel=='t_entri_lembur'){
			$data['tgl_rekap']=$tgl_rekap;
			$que = "SELECT rd.id,k.id id_kwi_hr,k.no_bku,k.spj_bulan,CONCAT(k.singkatan_bagian,'.',k.singkatan_kegiatan) singkat_keg,tahun,kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_pa,nip_pejabat_pa ,nama_pejabat_kpa,nip_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_lembur FROM t_rekap_dana rd INNER JOIN t_entri_lembur k ON k.fk_rekap_dana_id=rd.id INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id WHERE rd.id=$id_rekap"; 
			$hsl = $this->db->query($que)->row();
			$data['hasil'] = $hsl;

			$qweDtl = "SELECT t.id,tgl_kwitansi,no_bku,no_kwitansi_rekap,perihal untuk_pembayaran,(uang_makan * sum(jml_makan)) banyaknya_uang,pph_23_persen, sum(tarif*jml_jam) uHLmbur, sum(((tarif*jml_jam)*pph21)/100) totPph21  FROM t_entri_lembur t INNER JOIN t_entri_lembur_detail td ON t.id=td.fk_entri_lembur_id WHERE fk_rekap_dana_id=$id_rekap GROUP BY t.id ORDER BY no_kwitansi_rekap";
			$hsl2 = $this->db->query($qweDtl)->result();
			$data['detail'] = $hsl2;
			$pjkDaerah=array(); $pph23=array();$tot_pjk_daerah=0;$tot_pph23=0;$tot_pph21=0;
			foreach ($hsl2 as $val) {
				$totpjkDrh = $this->help->pembulatanSeratus(ceil($val->banyaknya_uang*(10/100)));
				$pjkDaerah[$val->id] = $totpjkDrh;
				$totPph23 = $this->help->pembulatanSeratus(ceil($val->banyaknya_uang*($val->pph_23_persen/100)));
				$pph23[$val->id] = $totPph23;
				$uhLmbr[$val->id] = $val->uHLmbur;
				$pph21[$val->id] = $val->totPph21;

				$tot_pjk_daerah+=$totpjkDrh;
				$tot_pph23+=$totPph23;
				$tot_pph21+=$val->totPph21;
			}
			$data['pjkDaerah'] = $pjkDaerah;
			$data['pph23'] = $pph23;
			$data['uhLmbr'] = $uhLmbr;
			$data['pph21'] = $pph21;

				//update kolom skrg untuk sum di proses TNT dan DTH
			$cek = $this->db->query("SELECT pjk_daerah_skrg FROm t_rekap_dana WHERE id=$id_rekap")->row();
			if(empty($cek->pjk_daerah_skrg)){
				$this->db->query("UPDATE t_rekap_dana SET pjk_daerah_skrg=$tot_pjk_daerah, pph21_skrg=$tot_pph21, pph23_skrg=$tot_pph23 WHERE id=$id_rekap");
			}

			$html=$this->load->view('Lembur/cetakRekap',$data,true);
			$title = 'Lembur';
		}

		if($dariTabel=='t_rapat'){
			$data['tgl_rekap']=$tgl_rekap;
			$que = "SELECT rd.id,k.id id_kwi_hr,k.no_bku,k.spj_bulan,CONCAT(k.singkatan_bagian,'.',k.singkatan_kegiatan) singkat_keg,tahun,kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_pa,nip_pejabat_pa ,nama_pejabat_kpa,nip_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_rapat FROM t_rekap_dana rd INNER JOIN t_rapat k ON k.fk_rekap_dana_id=rd.id INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id WHERE rd.id=$id_rekap ORDER BY k.id desc"; 
			$hsl = $this->db->query($que)->row();
			$data['hasil'] = $hsl;

			$qweDtl = "SELECT tgl_kwitansi,no_bku,no_kwitansi_rekap,acara untuk_pembayaran,total_all banyaknya_uang,pajak_daerah,pph_23,harga_mamin,harga_snack,harga_mamin_vip,harga_snack_vip FROM t_rapat WHERE fk_rekap_dana_id=$id_rekap ORDER BY no_kwitansi_rekap";
			$hsl2 = $this->db->query($qweDtl)->result();
			$data['detail'] = $hsl2;

			$tot_pjk_daerah=0;$tot_pph23=0;
			foreach ($hsl2 as $val) {
				$tot_pjk_daerah+=$val->pajak_daerah;
				$tot_pph23+=$val->pph_23;
			}

				//update kolom skrg untuk sum di proses TNT dan DTH
			$this->db->query("UPDATE t_rekap_dana SET pjk_daerah_skrg=$tot_pjk_daerah, pph23_skrg=$tot_pph23 WHERE id=$id_rekap");

			$html=$this->load->view('Rapat/cetakRekap',$data,true);
			$title = 'Rapat';
		}

		if($dariTabel=='t_kwitansi_hr'){
			$data['tgl_rekap']=$tgl_rekap;
			$que = "SELECT rd.id,k.id id_kwi_hr,k.no_bku,k.spj_bulan,CONCAT(k.singkatan_bagian,'.',k.singkatan_kegiatan) singkat_keg,tahun,kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_pa,nip_pejabat_pa
			,nama_pejabat_kpa,nip_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_bpjs,pajak_kegiatan,k.kategori
				FROM t_rekap_dana rd INNER JOIN t_kwitansi_hr k ON k.fk_rekap_dana_id=rd.id 
				INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id
				WHERE rd.id=$id_rekap";
			$hsl = $this->db->query($que)->row();
			$data['hasil'] = $hsl;

			$qweDtl = "SELECT tgl_kwitansi,no_bku,no_kwitansi_rekap,untuk_pembayaran,sum((sub_total_bruto*jml_kali)+bpjs_kes_pemkab+bpjs_krj_jkk+bpjs_krj_jkm) tot_bruto,sum(bpjs_kes_pemkab) tot_bpjs_kes_pemkab,sum(bpjs_krj_jkk) tot_bpjs_krj_jkk,sum(bpjs_krj_jkm) tot_bpjs_krj_jkm,sum(bpjs_kes_peserta) tot_bpjs_kes_peserta,sum(((sub_total_bruto*jml_kali)*pajak_persen)/100) tot_pajak_kegiatan FROM t_kwitansi_hr_detail hd INNER JOIN t_kwitansi_hr h ON h.id=hd.fk_kwitansi_hr_id WHERE fk_rekap_dana_id=$id_rekap GROUP BY h.id ORDER BY no_kwitansi_rekap";
			$dtl = $this->db->query($qweDtl)->result();
			$data['detail'] = $dtl;

			$totPph21 = 0;
			foreach ($dtl as $val) {
				if($hsl->kategori=='NARASUMBER'){
					$totPph21+=$val->tot_pajak_kegiatan;
				}
			}
				//update kolom skrg untuk sum di proses DTH
			$this->db->query("UPDATE t_rekap_dana SET pph21_skrg=$totPph21 WHERE id=$id_rekap");

			$html=$this->load->view('KwitansiHR/cetakRekap',$data,true);
			$title = 'Kwitansi HR';
		}

		if($dariTabel=='pb_pesanan_barang'){
			$data['tgl_rekap']=$tgl_rekap;
			$que = "SELECT rd.id,k.id id_pesanan_barang,k.no_bku,k.spj_bulan,CONCAT(bi.singkatan_bagian,'.',kb.singkatan) singkat_keg,k.tahun_anggaran tahun,b.kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_pa,nip_pejabat_pa
			,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_tbl_kwitansi
				FROM t_rekap_dana rd 
				INNER JOIN pb_pesanan_barang k ON k.fk_rekap_dana_id=rd.id 
				INNER JOIN ms_bagian bi ON bi.id=k.fk_bagian_id
				INNER JOIN ms_kegiatan kb ON kb.id=k.fk_kegiatan_id
				INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id
				WHERE rd.id=$id_rekap";
			$hsl = $this->db->query($que)->row();
			$data['hasil'] = $hsl;

			$qweDtl = "SELECT tgl_pesanan,tgl_kuitansi,no_bku,no_kwitansi_rekap,jenis_pajak,perihal untuk_pembayaran,sum(harga_satuan_beli*qty_akhir) banyaknya_uang,mr.npwp FROM pb_pesanan_barang p INNER join pb_pesanan_barang_detail pd ON pd.fk_pesanan_barang_id=p.id INNER JOIN pb_ms_rekanan mr ON mr.id=p.fk_rekanan_id WHERE fk_rekap_dana_id=$id_rekap GROUP BY p.id ORDER BY no_kwitansi_rekap";
			$dtl = $this->db->query($qweDtl)->result();
			$data['detail'] = $dtl;

			$totPpn = 0; $totPph22 = 0; $totPph23 = 0;
			foreach ($dtl as $val) {
				$totAll=$val->banyaknya_uang;
				foreach ((array)json_decode($val->jenis_pajak) as $val2) {
                    if($val2=='PPN'){
                        $ppn1=11;
                        $PmbgiPpn1=111;
                        $ppn10Persen = $totAll*($ppn1/$PmbgiPpn1);
                        $ppn = $this->help->pembulatanSeratus(ceil($ppn10Persen));
                        $totPpn+=$ppn;
                    }
                    if($val2=='PPH_22'){
                        $ph22 = "ada";
                        if($val->npwp=='' || $val->npwp=='-'){ //tidak punya npwp
                            $nilaipph22 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(3/100)));
                        }else{
                            $nilaipph22 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(1.5/100)));
                        }
                        $totPph22+=$nilaipph22;
                    }
                    if($val2=='PPH_23'){
                        $ph23 = "ada";
                        if($val->npwp=='' || $val->npwp=='-'){ //tidak punya npwp
                            $nilaipph23 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(4/100)));
                        }else{
                            $nilaipph23 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(2/100)));
                        }
                        $totPph23+=$nilaipph23;
                    }
                }
            }

            	//update kolom skrg untuk sum di proses TNT dan DTH
			$this->db->query("UPDATE t_rekap_dana SET ppn_skrg=$totPpn, pph22_skrg=$totPph22, pph23_skrg=$totPph23 WHERE id=$id_rekap");
			

			$html=$this->load->view('PesananBarang/cetakRekap',$data,true);
			$title = 'PesananBarang';
		}

		if($dariTabel=='t_kwitansi'){
			$data['tgl_rekap']=$tgl_rekap;
			$que = "SELECT rd.id,k.id id_kwi_hr,k.no_bku,k.spj_bulan,CONCAT(k.singkatan_bagian,'.',k.singkatan_kegiatan) singkat_keg,tahun,kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_pa,nip_pejabat_pa
			,nama_pejabat_kpa,nip_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_tbl_kwitansi
				FROM t_rekap_dana rd INNER JOIN t_kwitansi k ON k.fk_rekap_dana_id=rd.id 
				INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id
				WHERE rd.id=$id_rekap";
			$hsl = $this->db->query($que)->row();
			$data['hasil'] = $hsl;

			$qweDtl = "SELECT tgl_kwitansi,no_bku,no_kwitansi_rekap,untuk_pembayaran,banyaknya_uang,ppn,pph_21,pph_22,pph_23 FROM t_kwitansi WHERE fk_rekap_dana_id=$id_rekap ORDER BY no_kwitansi_rekap";
			$detail = $this->db->query($qweDtl)->result();
			$data['detail'] = $detail;

			$totPpn = 0; $totPph21 = 0; $totPph22 = 0; $totPph23 = 0;
			foreach ((array)$detail as $val) {
				if(!empty($val->ppn)){
					$totPpn += $val->ppn;
				}
				if(!empty($val->pph_21)){
					$totPph21 += $val->pph_21;
				}
				if(!empty($val->pph_22)){
					$totPph22 += $val->pph_22;
				}
				if(!empty($val->pph_23)){
					$totPph23 += $val->pph_23;
				}
			}

				//update kolom skrg untuk sum di proses TNT dan DTH
			$this->db->query("UPDATE t_rekap_dana SET ppn_skrg=$totPpn, pph21_skrg=$totPph21, pph22_skrg=$totPph22, pph23_skrg=$totPph23 WHERE id=$id_rekap");

			$html=$this->load->view('Kwitansi/cetakRekap',$data,true);
			$title = 'Kwitansi';
		}
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	public function cetakNPD($ket,$id_rekap){
		$cek = $this->db->query("SELECT dari_tabel,fk_bagian_id,tgl_rekap,tahun,nama_bulan FROM v_pjd_dan_rekap_dana WHERE tabelnya='$ket' AND id=$id_rekap")->row();
		$dariTabel= $cek->dari_tabel;
		$bdg_id = $cek->fk_bagian_id;
		$tgl_rekap = $cek->tgl_rekap;

		$hslPjd=null;
		if($dariTabel=='t_pjd'){
			$data['pjbt'] = $this->db->query("SELECT jabatan_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk FROM t_pjd WHERE fk_pjd_dana_id=$id_rekap")->row();

			$quePjd= "SELECT no_bku,(SELECT kode_program FROM ms_program WHERE id=t.fk_program_id) kode_program,nama_program,kode_kegiatan,kegiatan,kode_rekening,nama_rek_belanja,acara,sum(td.total_akhir) pengajuan_sekarang 
				FROM t_pjd t
				INNER JOIN t_pjd_detail td ON td.fk_pjd_id=t.id
				INNER JOIN t_pjd_dana pd ON pd.id=t.fk_pjd_dana_id
				INNER JOIN ms_rekening_belanja rb ON rb.id=t.fk_rekening_belanja_id
				WHERE pd.fk_bagian_id=$bdg_id AND pd.tgl_rekap='$tgl_rekap'
				GROUP BY t.id "; 
			$hslPjd = $this->db->query($quePjd)->result();
		}
		$data['hslPjd'] = $hslPjd; 

		$hslEntriLmbr=null;
		if($dariTabel=='t_entri_lembur'){
			$que = "SELECT jabatan_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk FROM t_rekap_dana rd INNER JOIN t_entri_lembur k ON k.fk_rekap_dana_id=rd.id WHERE rd.id=$id_rekap"; 
			$hsl = $this->db->query($que)->row();
			$data['pjbt'] = $hsl;

			$queLmbr = "SELECT no_bku,(SELECT kode_program FROM ms_program WHERE id=t.fk_program_id),nama_program,kode_kegiatan,kegiatan,kode_rekening,nama_rek_belanja,perihal,sum(tarif * jml_jam) banyaknya_uang, sum((tarif*jml_jam)*pph21/100) pph21nya
					FROM t_rekap_dana rd
					INNER JOIN t_entri_lembur t ON t.fk_rekap_dana_id=rd.id
					INNER JOIN t_entri_lembur_detail td ON t.id=td.fk_entri_lembur_id
					INNER JOIN ms_rekening_belanja rb ON rb.id=t.fk_rekening_belanja_id
					WHERE rd.fk_bagian_id=$bdg_id AND rd.tgl_rekap='$tgl_rekap'
					GROUP BY t.id
					ORDER BY nama_program,kegiatan,nama_rek_belanja ASC";
				$hslEntriLmbr = $this->db->query($queLmbr)->result();
		}
		$data['hslEntriLmbr'] = $hslEntriLmbr;

		$hslRpt=null;
		if($dariTabel=='t_rapat'){
			$que = "SELECT jabatan_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk FROM t_rapat WHERE fk_rekap_dana_id=$id_rekap"; 
			$hsl = $this->db->query($que)->row();
			$data['pjbt'] = $hsl;

			$queRpt = "SELECT no_bku,(SELECT kode_program FROM ms_program WHERE id=t.fk_program_id),nama_program,kode_kegiatan,kegiatan,kode_rekening,nama_rek_belanja,acara,total banyaknya_uang,pajak_daerah,pph_23
				FROM t_rekap_dana rd
				INNER JOIN t_rapat t ON t.fk_rekap_dana_id=rd.id
				INNER JOIN ms_rekening_belanja rb ON rb.id=t.fk_rekening_belanja_id
				WHERE rd.fk_bagian_id=$bdg_id AND rd.tgl_rekap='$tgl_rekap'
				ORDER BY nama_program,kegiatan,nama_rek_belanja ASC";
			$hslRpt = $this->db->query($queRpt)->result();
		}
		$data['hslRapat'] = $hslRpt;

		$hslHonor=null;
		if($dariTabel=='t_kwitansi_hr'){
			$que = "SELECT jabatan_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk FROM t_kwitansi_hr WHERE fk_rekap_dana_id=$id_rekap";
			$hsl = $this->db->query($que)->row();
			$data['pjbt'] = $hsl;

			$queHonor = "SELECT no_bku,(SELECT kode_program FROM ms_program WHERE id=t.fk_program_id),nama_program,kode_kegiatan,kegiatan,kode_rekening,nama_rek_belanja,untuk_pembayaran,
				sum(( sub_total_bruto * jml_kali )+ bpjs_kes_pemkab + bpjs_krj_jkk + bpjs_krj_jkm ) tot_bruto,
				sum( bpjs_kes_pemkab ) tot_bpjs_kes_pemkab,
				sum( bpjs_krj_jkk ) tot_bpjs_krj_jkk,
				sum( bpjs_krj_jkm ) tot_bpjs_krj_jkm,
				sum( bpjs_kes_peserta ) tot_bpjs_kes_peserta,
				sum((( sub_total_bruto * jml_kali )* pajak_persen )/ 100 ) tot_pph21
				FROM t_rekap_dana rd
				INNER JOIN t_kwitansi_hr t ON t.fk_rekap_dana_id=rd.id
				INNER JOIN t_kwitansi_hr_detail td ON td.fk_kwitansi_hr_id=t.id
				INNER JOIN ms_rekening_belanja rb ON rb.id=t.fk_rekening_belanja_id
				WHERE rd.fk_bagian_id=$bdg_id AND rd.tgl_rekap='$tgl_rekap'
				GROUP BY t.id
				ORDER BY nama_program,kegiatan,nama_rek_belanja ASC";
			$hslHonor = $this->db->query($queHonor)->result();
		}
		$data['hslHonor'] = $hslHonor;

		$hslKwitansi=null;
		if($dariTabel=='t_kwitansi'){
			$que = "SELECT jabatan_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk FROM t_kwitansi WHERE fk_rekap_dana_id=$id_rekap";
			$hsl = $this->db->query($que)->row();
			$data['pjbt'] = $hsl;

			$queKw = "SELECT no_bku,(SELECT kode_program FROM ms_program WHERE id=t.fk_program_id),nama_program,kode_kegiatan,kegiatan,kode_rekening,nama_rek_belanja,untuk_pembayaran,rd.pengajuan_sekarang,jenis_pajak,ppn,pph_21,pph_22,pph_23,pjk_daerah FROM t_rekap_dana rd
					INNER JOIN t_kwitansi kw ON kw.fk_rekap_dana_id=rd.id
					INNER JOIN ms_rekening_belanja rb ON rb.id=kw.fk_rekening_belanja_id
					WHERE rd.fk_bagian_id=$bdg_id AND rd.tgl_rekap='$tgl_rekap'
					ORDER BY nama_program,kegiatan,nama_rek_belanja ASC";
			$hslKwitansi = $this->db->query($queKw)->result();
		}
		$data['hslKwitansi'] = $hslKwitansi; 

		$hslBrg=null;
		if($dariTabel=='pb_pesanan_barang'){
			$que = "SELECT jabatan_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk FROM pb_pesanan_barang WHERE fk_rekap_dana_id=$id_rekap";
			$hsl = $this->db->query($que)->row();
			$data['pjbt'] = $hsl;

			$queBrg = "SELECT no_bku,(SELECT kode_program FROM ms_program WHERE id=t.fk_program_id),nama_program,kode_kegiatan,kegiatan,kode_rekening,nama_rek_belanja,perihal untuk_pembayaran,sum(harga_satuan_beli*qty_akhir) banyaknya_uang,npwp,jenis_pajak
				FROM t_rekap_dana rd
				INNER JOIN pb_pesanan_barang t ON t.fk_rekap_dana_id=rd.id
				INNER JOIN pb_pesanan_barang_detail td ON td.fk_pesanan_barang_id=t.id
				INNER JOIN ms_rekening_belanja rb ON rb.id=t.fk_rekening_belanja_id
				LEFT JOIN pb_ms_rekanan mr ON mr.id=t.fk_rekanan_id
				WHERE rd.fk_bagian_id=$bdg_id AND rd.tgl_rekap='$tgl_rekap'
				GROUP BY t.id
				ORDER BY nama_program,kegiatan,nama_rek_belanja ASC";
			$hslBrg = $this->db->query($queBrg)->result();
		}
		$data['hslBrg'] = $hslBrg;

		$tgl_rkp=$this->help->ReverseTgl($tgl_rekap);
		$data['bidang'] = $this->db->query("SELECT nama_bagian FROM ms_bagian WHERE id=$bdg_id ")->row();
		$data['bulan'] = $cek->nama_bulan;
		$data['tahun'] = $cek->tahun;
		$data['title'] = $tgl_rkp;
		$html=$this->load->view('Rekap/cetakRekapNPD',$data,true);

		$this->pdf($title,$html,'A4-P',true);
	}

	public function cetakSSPD($ket,$id_rekap){
		$cek = $this->db->query("SELECT tahun,dari_tabel,tgl_rekap,spj_bulan,fk_bagian_id FROM v_pjd_dan_rekap_dana WHERE tabelnya='$ket' AND id=$id_rekap")->row();

		$fkBagian=$cek->fk_bagian_id;
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}
		$data['bag'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$dariTabel= $cek->dari_tabel;
		$tgl_rekap=$this->help->ReverseTgl($cek->tgl_rekap);

		if($dariTabel=='t_entri_lembur'){
			$data['tgl_cetak']=$tgl_rekap;

			$hsl = $this->db->query("SELECT * FROM t_entri_lembur WHERE fk_rekap_dana_id=$id_rekap")->result_array();
			
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
		}
		if($dariTabel=='t_rapat'){
			$data['tgl_cetak']=$tgl_rekap;

			$hsl = $this->db->query("SELECT tahun,kegiatan,nama_bendahara,nip_bendahara,fk_rekanan_catering_id,sum(pajak_daerah) totPjkDaerah FROM t_rapat WHERE fk_rekap_dana_id=$id_rekap")->result_array();
			$hasil1 = $hsl[0];

			$data['pajakDaerah'] = $hsl[0]['totPjkDaerah'];

			$criPem="SELECT DISTINCT nama_bendahara_pembantu, nip_bendahara_pembantu FROM t_rapat WHERE	fk_rekap_dana_id = $id_rekap ORDER BY id DESC";
			$hslPem=$this->db->query($criPem)->result_array();
			$hasil2 = $hslPem[0];
			
			$data['hasil'] = array_merge($hasil1,$hasil2);

			$rekananId = $hsl[0]['fk_rekanan_catering_id'];
			$rknn = $this->MMsRekananCatering->get(array('id'=>$rekananId));
			$data['rekanan'] = $rknn[0];


			$data['kategori'] = 'rapat';

			$html=$this->load->view('Lembur/cetakSSPD',$data,true);
			$title = 'Cetak SSPD';
		}
		
		// echo $html;
		$this->pdf($title,$html,$this->help->folio_P(),true);
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

    protected function msword($title,$html){
        header("Content-type: application/vnd.ms-word");
        header("Expires: 0");
        header("Content-Disposition: attachment; filename=$title.doc");
        header("Pragma: no-cache");
        echo $html;
    }

}
