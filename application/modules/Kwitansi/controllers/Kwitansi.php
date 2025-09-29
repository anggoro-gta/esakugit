<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwitansi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		$this->load->model('MKwitansi');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsRekeningBelanja');
		$this->load->model('MMsRekananCatering');
		$this->load->model('MMsRekanan');
		$this->load->model('MMsRekananSwakelola');
		$this->load->model('MMsSdm');
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
		$this->template->load('Home/template','Kwitansi/list',$data);
	}

	public function barangLainnya(){
		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrBulan'] = $this->help->namaBulan();
		$this->template->load('Home/template','Kwitansi/listBarangLainnya',$data);
	}

	public function swakelola(){
		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrBulan'] = $this->help->namaBulan();
		$this->template->load('Home/template','Kwitansi/listSwakelola',$data);
	}

	public function getListDetail(){
		$data['kategori'] = $this->input->post('kategori');
		$data['buttonCreate'] = $this->input->post('buttonCreate');
		$data['bulan'] = $this->input->post('bulan');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->arrBagian();

		$this->load->view('Kwitansi/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

        $tahun = $this->tahun;
		$bulan = $this->input->post('bulan');
		$fk_bagian_id = $this->input->post('fk_bagian_id');
		$fk_program_id = $this->input->post('fk_program_id');
		$fk_kegiatan_id = $this->input->post('fk_kegiatan_id');
		$kategori = $this->input->post('kategori');

		$this->datatables->where('tahun',$tahun);
		if($bulan){
			$this->datatables->where("t_kwitansi.spj_bulan",$bulan);
		}
		if($fk_bagian_id){
			$this->datatables->where('t_kwitansi.fk_bagian_id',$fk_bagian_id);
		}
		if($fk_program_id){
			$this->datatables->where('t_kwitansi.fk_program_id',$fk_program_id);
		}
		if($fk_kegiatan_id){
			$this->datatables->where('t_kwitansi.fk_kegiatan_id',$fk_kegiatan_id);
		}
		if($kategori){
			$this->datatables->where('t_kwitansi.jenis_belanja',$kategori);
		}

        $this->datatables->select('t_kwitansi.id,t_kwitansi.spj_bulan,t_rekap_dana.info_no_bku,untuk_pembayaran,singkatan_bagian,nama_program,kegiatan,is_spj,fk_rekap_dana_id,nama_rek_belanja,jenis_belanja,banyaknya_uang');
        $this->datatables->select("DATE_FORMAT(tgl_kwitansi,'%d/%m/%Y') AS tgl_kwitansi", FALSE);
        $this->datatables->select("FORMAT(banyaknya_uang,0) AS banyaknya_uang_idr", FALSE);
        $this->datatables->from("t_kwitansi");
        $this->datatables->join('t_rekap_dana','t_rekap_dana.id=t_kwitansi.fk_rekap_dana_id','left');
        $this->datatables->join('ms_rekening_belanja','ms_rekening_belanja.id=t_kwitansi.fk_rekening_belanja_id','left');
        $this->db->order_by("t_kwitansi.tgl_kwitansi", "desc");
        echo $this->datatables->generate();
	}

	public function create($kat){
		$Bagian=null;
		if($this->level!='1'){
			$Bagian=$this->fkBagianId;
		}

		if($kat=='barang'){
			$formnya = 'formBarang';
		}
		if($kat=='lainnya'){
			$formnya = 'formLainnya';
		}
		if($kat=='swakelola'){
			$formnya = 'formSwakelola';
		}

		$data = array(
			'button' => 'Simpan',
			'tahun' => set_value('tahun',$this->tahun),
			'jenis_belanja' => set_value('jenis_belanja'),
			'sub_jenis_belanja' => set_value('sub_jenis_belanja'),
			'tgl_pesanan' => set_value('tgl_pesanan'),
			'tgl_kesepakatan_harga' => set_value('tgl_kesepakatan_harga'),
			'tgl_kwitansi' => set_value('tgl_kwitansi'),
			'fk_rekanan_catering_id' => set_value('fk_rekanan_catering_id'),
			'banyaknya_uang' => set_value('banyaknya_uang'),
			'fk_rekanan_id' => set_value('fk_rekanan_id'),
			'npwp_penerima' => set_value('npwp_penerima'),
			'nama_penerima' => set_value('nama_penerima'),
			'jabatan_penerima' => set_value('jabatan_penerima'),
			'alamat_penerima' => set_value('alamat_penerima'),
			'jenis_pajak' => set_value('jenis_pajak'),
			'ppn' => set_value('ppn'),
			'pph_21' => set_value('pph_21'),
			'pph_22' => set_value('pph_22'),
			'pph_23' => set_value('pph_23'),
			'perihal' => set_value('perihal'),
			'untuk_pembayaran' => set_value('untuk_pembayaran'),
			'qty' => set_value('qty'),
			'satuan' => set_value('satuan'),
			'fk_bagian_id' => set_value('fk_bagian_id',$Bagian),
			'fk_program_id' => set_value('fk_program_id'),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id'),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id'),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa'),
			'nama_pejabat_ppk' => set_value('nama_pejabat_ppk'),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa'),
			'nama_pejabat_ppk' => set_value('nama_pejabat_ppk'),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk'),
			'nama_bendahara' => set_value('nama_bendahara'),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu'),
			'id_pengawas' => set_value('id_pengawas'),
			'no_sk_pengawas_swakelola' => set_value('no_sk_pengawas_swakelola'),
			'tgl_sk_pengawas_swakelola' => set_value('tgl_sk_pengawas_swakelola'),
			'id' => set_value('id'),
		);

		$data['arrMsBagian'] = $this->arrBagian();
		// $data['arrTtd'] = $this->help->ttd_atasan();
		// $data['arrPA'] = $this->help->ttd_pa();
		// $data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pejabat_ppk'=>'1'));
		$data['arrMsRekanan'] = $this->MMsRekanan->get(array('status'=>'1'));
		$data['arrMsRekananSwakelola'] = $this->MMsRekananSwakelola->get(array('status'=>'1'));
		// $data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		// $data['arrPPTK'] = $this->help->ttd_pptk();
		// $data['namaSdm'] = $this->MMsSdm->get(array('status'=>1, 'pegawai_setda'=>1));

		$this->template->load('Home/template','Kwitansi/'.$formnya,$data);
	}

	public function update($kat,$id){
		$hsl = $this->MKwitansi->get(array('id'=>$id));
		$hsl = $hsl[0];

		if($kat=='barang'){
			$formnya = 'formBarang';
		}
		if($kat=='lainnya'){
			$formnya = 'formLainnya';
		}
		if($kat=='swakelola'){
			$formnya = 'formSwakelola';
		}

		$data = array(
			'button' => 'Update',
			'tahun' => set_value('tahun',$hsl['tahun']),
			'jenis_belanja' => set_value('jenis_belanja',$hsl['jenis_belanja']),
			'sub_jenis_belanja' => set_value('sub_jenis_belanja',$hsl['sub_jenis_belanja']),
			'tgl_pesanan' => set_value('tgl_pesanan',$this->help->ReverseTgl($hsl['tgl_pesanan'])),
			'tgl_kesepakatan_harga' => set_value('tgl_kesepakatan_harga',$this->help->ReverseTgl($hsl['tgl_kesepakatan_harga'])),
			'tgl_kwitansi' => set_value('tgl_kwitansi',$this->help->ReverseTgl($hsl['tgl_kwitansi'])),
			'fk_rekanan_catering_id' => set_value('fk_rekanan_catering_id',$hsl['fk_rekanan_catering_id']),
			'banyaknya_uang' => set_value('banyaknya_uang',$hsl['banyaknya_uang']),
			'fk_rekanan_id' => set_value('fk_rekanan_id',$hsl['fk_rekanan_id']),
			'npwp_penerima' => set_value('npwp_penerima',$hsl['npwp_penerima']),
			'nama_penerima' => set_value('nama_penerima',$hsl['nama_penerima']),
			'jabatan_penerima' => set_value('jabatan_penerima',$hsl['jabatan_penerima']),
			'alamat_penerima' => set_value('alamat_penerima',$hsl['alamat_penerima']),
			'jenis_pajak' => set_value('jenis_pajak',json_decode($hsl['jenis_pajak'])),
			'ppn' => set_value('ppn',$hsl['ppn']),
			'pph_21' => set_value('pph_21',$hsl['pph_21']),
			'pph_22' => set_value('pph_22',$hsl['pph_22']),
			'pph_23' => set_value('pph_23',$hsl['pph_23']),
			'perihal' => set_value('perihal',$hsl['perihal']),
			'untuk_pembayaran' => set_value('untuk_pembayaran',$hsl['untuk_pembayaran']),
			'qty' => set_value('qty',$hsl['qty']),
			'satuan' => set_value('satuan',$hsl['satuan']),
			'fk_bagian_id' => set_value('fk_bagian_id',$hsl['fk_bagian_id']),
			'fk_program_id' => set_value('fk_program_id',$hsl['fk_program_id']),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id',$hsl['fk_kegiatan_id']),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id',$hsl['fk_rekening_belanja_id']),
			'nama_pejabat_pa' => set_value('nama_pejabat_pa',$hsl['nama_pejabat_pa']),
			'nama_pejabat_ppk' => set_value('nama_pejabat_ppk',$hsl['nama_pejabat_ppk']),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa',$hsl['nama_pejabat_kpa']),
			'nama_pejabat_ppk' => set_value('nama_pejabat_ppk',$hsl['nama_pejabat_ppk']),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk',$hsl['nama_pejabat_pptk']),
			'nama_bendahara' => set_value('nama_bendahara',$hsl['nama_bendahara']),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu',$hsl['nama_bendahara_pembantu']),
			'id_pengawas' => set_value('id_pengawas',$hsl['id_pengawas']),
			'no_sk_pengawas_swakelola' => set_value('no_sk_pengawas_swakelola',$hsl['no_sk_pengawas_swakelola']),
			'tgl_sk_pengawas_swakelola' => set_value('tgl_sk_pengawas_swakelola',$hsl['tgl_sk_pengawas_swakelola']),
			'is_spj' => set_value('is_spj',$hsl['is_spj']),
			
			'id' => set_value('id',$id),
		);

		$data['arrMsBagian'] = $this->arrBagian();
		// $data['arrTtd'] = $this->help->ttd_atasan();
		// $data['arrPA'] = $this->help->ttd_pa();
		// $data['arrPPK'] = $this->help->ttd_ppk();
		// $data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrMsRekanan'] = $this->MMsRekanan->get();
		$data['kwitansiDetail'] = $this->MKwitansi->getDetail(array('fk_kwitansi_id'=>$id));
		$data['arrMsRekananSwakelola'] = $this->MMsRekananSwakelola->get();
		// $data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		// $data['arrPPTK'] = $this->help->ttd_pptk();
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pejabat_ppk'=>'1'));

		$this->template->load('Home/template','Kwitansi/'.$formnya,$data);
	}

	public function getNamaPengawas(){
 		$fk_bagian_id=$_POST['fk_bagian_id'];
 		$idPengawas=$_POST['idPengawas'];

 		$hsl = $this->help->namaSdm(array('status'=>1),$fk_bagian_id);

 		$data['arrPegawai'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hsl as $val) {	
 			$selected = $val['id']==$idPengawas?'selected':'';
 			$jbtn = ($val['jabatan_baru']==' ')?$val['jabatan']:$val['jabatan_baru'];	
 			$data['arrPegawai'] .= "<option $selected value=\"".$val['id']."\">".$val['nama'].' ['.$jbtn.']'."</option>\n"; 			
	 	}

 		echo json_encode($data);
 	}

	public function save(){		
		$id = $this->input->post('id');
			$tglPsn = $this->input->post('tgl_pesanan');
		$data['tgl_pesanan'] = !empty($tglPsn)?$this->help->ReverseTgl($tglPsn):null;
			$tglKspHrg = $this->input->post('tgl_kesepakatan_harga');
		$data['tgl_kesepakatan_harga'] = !empty($tglKspHrg)?$this->help->ReverseTgl($tglKspHrg):null;
			$tglKwi = $this->input->post('tgl_kwitansi');
		$data['tgl_kwitansi'] = !empty($tglKwi)?$this->help->ReverseTgl($tglKwi):null;
		
		$data['perihal'] = $this->input->post('perihal');	
		$data['untuk_pembayaran'] = $this->input->post('untuk_pembayaran');	
		$data['qty'] = $this->input->post('qty');	
		$data['satuan'] = $this->input->post('satuan');	
		$data['fk_rekanan_id'] = $this->input->post('fk_rekanan_id');	
		$data['npwp_penerima'] = $this->input->post('npwp_penerima');	
		$data['nama_penerima'] = $this->input->post('nama_penerima');	
		$data['jabatan_penerima'] = $this->input->post('jabatan_penerima');	
		$data['alamat_penerima'] = $this->input->post('alamat_penerima');	
		$data['tahun'] = $this->input->post('tahun');
			$jnsBlnja = $this->input->post('jenis_belanja');
		$data['jenis_belanja'] = $jnsBlnja;
		$data['sub_jenis_belanja'] = $this->input->post('sub_jenis_belanja');
		$data['jenis_pajak']  = json_encode($this->input->post('jenis_pajak'));
		$data['banyaknya_uang'] = str_replace(',', '', $this->input->post('banyaknya_uang'));
			$ppn = $this->input->post('ppn');
		$data['ppn'] = !empty($ppn)?str_replace(',', '', $ppn):null;
			$pph_21 = $this->input->post('pph_21');
		$data['pph_21'] = !empty($pph_21)?str_replace(',', '', $pph_21):null;
			$pph_22 = $this->input->post('pph_22');
		$data['pph_22'] = !empty($pph_22)?str_replace(',', '', $pph_22):null;
			$pph_23 = $this->input->post('pph_23');
		$data['pph_23'] = !empty($pph_23)?str_replace(',', '', $pph_23):null;	

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
		$data['jabatan_pejabat_ppk'] = $ppk[3];

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

		$ppkEx = explode('_', $this->input->post('nama_pejabat_ppk'));
		$data['nama_pejabat_ppk'] = $ppkEx[0];
		$data['nip_pejabat_ppk'] = $ppkEx[1];
		$data['pangkat_pejabat_ppk'] = $ppkEx[2];
		$data['jabatan_pejabat_ppk'] = $ppkEx[3];

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

		$idPngws = $this->input->post('id_pengawas');
			$peng = $this->MMsSdm->get(array('id'=>$idPngws));
		$data['id_pengawas'] = $idPngws;
		$data['nama_pengawas'] = $peng[0]['nama'];
		$data['nip_pengawas'] = $peng[0]['nip'];

		$data['no_sk_pengawas_swakelola'] = $this->input->post('no_sk_pengawas_swakelola');
		$data['tgl_sk_pengawas_swakelola'] = $this->input->post('tgl_sk_pengawas_swakelola');

		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		if(empty($id)){
			$this->db->trans_start(); 
				
				$this->MKwitansi->insert($data);			
				$KwiId = $this->db->insert_id();

				$listUraian = $this->input->post('listUraian');
				$jml = $this->input->post('listJml');
				$satuan = $this->input->post('listSatuan');
				$hargaSatuan = $this->input->post('listHargaSatuan');
				
				if(isset($listUraian)){
					foreach ($listUraian as $key => $val) {
						$dataDetail[] = array(
									'fk_kwitansi_id'=>$KwiId,
									'uraian'=>$val,
									'jml'=>$jml[$key],
									'satuan'=>$satuan[$key],
									'harga_satuan'=>str_replace(',', '', $hargaSatuan[$key]),
								);
					}
					$this->db->insert_batch('t_Kwitansi_detail', $dataDetail);
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

				$this->MKwitansi->update($id,$data);

				$listUraian = $this->input->post('listUraian');
				$jml = $this->input->post('listJml');
				$satuan = $this->input->post('listSatuan');
				$hargaSatuan = $this->input->post('listHargaSatuan');
				
				if(isset($listUraian)){
					foreach ($listUraian as $key => $val) {
						$dataDetail[] = array(
									'fk_kwitansi_id'=>$id,
									'uraian'=>$val,
									'jml'=>$jml[$key],
									'satuan'=>$satuan[$key],
									'harga_satuan'=>str_replace(',', '', $hargaSatuan[$key]),
								);
					}
					$this->db->insert_batch('t_Kwitansi_detail', $dataDetail);
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

		$link = '';
		if($jnsBlnja=='Barang'){
			$link = 'barangLainnya';
		}
		if($jnsBlnja=='Swakelola'){
			$link = 'swakelola';
		}
        redirect('Kwitansi/'.$link);
	}

	public function deleteDetail($fkKwiId,$jnsBlnj,$id){
		$result = $this->MKwitansi->deleteDetail($id);
		if($result){
        	$this->session->set_flashdata('success', 'Detail Kwitansi berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Detail Kwitansi gagal dihapus.');
        }
        redirect('Kwitansi/update/'.$jnsBlnj.'/'.$fkKwiId);
	}

	public function cariRekanan(){
		$fk_rekanan_id = $this->input->post('fk_rekanan_id');

		$cri = $this->db->query("select * from pb_ms_rekanan where id=$fk_rekanan_id")->row();

		$data['npwp_penerima']=$cri->npwp;
		$data['nama_penerima']=$cri->nama_pimpinan;
		$data['jabatan_penerima']=$cri->jabatan.' '.$cri->nama_rekanan;
		$data['alamat_penerima']=$cri->alamat;

		echo json_encode($data);
	}

	public function cariRekananSwakelola(){
		$fk_rekanan_id = $this->input->post('fk_rekanan_id');

		$cri = $this->db->query("select * from ms_rekanan_swakelola where id=$fk_rekanan_id")->row();

		$data['npwp_penerima']=$cri->npwp;
		$data['nama_penerima']=$cri->nama_pimpinan;
		$data['jabatan_penerima']=$cri->jabatan.' '.$cri->nama_rekanan;
		$data['alamat_penerima']=$cri->alamat;

		echo json_encode($data);
	}

	public function hitungPajak(){
		$uang = str_replace(',', '', $this->input->post('uang'));
		$tgl_pesanan = $this->help->ReverseTgl($this->input->post('tgl_pesanan'));
		$jenisPajak = $this->input->post('jenis');
		$npwp_penerima = $this->input->post('npwp_penerima');

		// $ppn1=10;
		// $PmbgiPpn1=110;
		// if(strtotime($tgl_pesanan) > strtotime(date('2022-03-31'))){
			$ppn1=11;
			$PmbgiPpn1=111;
		// }
		
		$ppn='';
		$pph21='';
		$pph22='';
		$pph23='';
		$ppnnya=0;			
		foreach ((array)$jenisPajak as $val) {
			if($val=='PPN'){
				$ppnnya=($uang*$ppn1)/$PmbgiPpn1;
				$ppn = number_format($ppnnya);
			}
			if($val=='PPH_21'){
				if(strlen($npwp_penerima) > 2){
					$pngliPph21=5;
				}else{
					$pngliPph21=6;					
				}
				$pph21=number_format((($uang)*$pngliPph21)/100);
			}
			if($val=='PPH_22'){
				if(strlen($npwp_penerima) > 2){
					$pngliPph22=1.5;
				}else{
					$pngliPph22=3;					
				}
				$pph22=number_format((($uang-$ppnnya)*$pngliPph22)/100);
			}
			if($val=='PPH_23'){
				if(strlen($npwp_penerima) > 2){
					$pngliPph23=2;
				}else{
					$pngliPph23=4;					
				}
				
				$pph23=number_format((($uang-$ppnnya)*$pngliPph23)/100);
			}
		}

		$data['ppn']=$ppn;
		$data['pph21']=$pph21;
		$data['pph22']=$pph22;
		$data['pph23']=$pph23;
		echo json_encode($data);
	}

	public function delete($id){   
        $cek = $this->db->query("select jenis_belanja from t_kwitansi where id=$id")->row();
        $link = '';
		if($cek->jenis_belanja=='Barang'){
			$link = 'barangLainnya';
		}
		if($cek->jenis_belanja=='Swakelola'){
			$link = 'swakelola';
		}

		$result = $this->MKwitansi->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data gagal dihapus.');
        }

        redirect('Kwitansi/'.$link);
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

	// ------------REKAP-------------------

	public function updateRekap($kat){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->arrBagian();
		$data['url'] = base_url().'Kwitansi/proses_update_rekap';
		$data['tabel']='t_kwitansi';
		if($kat=='barang'){
			$jdl = 'Barang lainnya';
		}
		if($kat=='swakelola'){
			$jdl = 'Swakelola';
		}
		if($kat=='lainnya'){
			$jdl = 'Jasa Lainnya';
		}
		$data['judul']=$jdl;
		$data['kategori']=$kat;
		
		$this->template->load('Home/template','KwitansiHR/form_rekap',$data);
	}

	// public function getKegiatanRekap(){
 // 		$tabel=$this->input->post('tabel');
 // 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 // 		$que = "SELECT fk_kegiatan_id,kegiatan FROM $tabel WHERE tahun=$this->tahun AND is_spj='0' AND fk_bagian_id=$fk_bagian_id GROUP BY fk_kegiatan_id";
 // 		$nmKeg = $this->db->query($que)->result_array();

 // 		$data['nama_keg'] = "<option value=''>Pilih</option>\n";
 // 		foreach ((array)$nmKeg as $val) {
 // 			$data['nama_keg'] .= "<option value=\"".$val['fk_kegiatan_id']."\">".$val['kegiatan']."</option>\n";
 // 		}
 // 		echo json_encode($data);
 // 	}

 // 	public function getKegiatanRekapDel(){
 // 		$tabel=$this->input->post('tabel');
 // 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 // 		$bulan=$this->input->post('bulan');
 // 		$que = "SELECT fk_kegiatan_id,kegiatan FROM $tabel WHERE tahun=$this->tahun AND spj_bulan='$bulan' AND is_spj='1' AND fk_bagian_id=$fk_bagian_id GROUP BY fk_kegiatan_id";
 // 		$nmKeg = $this->db->query($que)->result_array();

 // 		$data['nama_keg'] = "<option value=''>Pilih</option>\n";
 // 		foreach ((array)$nmKeg as $val) {
 // 			$data['nama_keg'] .= "<option value=\"".$val['fk_kegiatan_id']."\">".$val['kegiatan']."</option>\n";
 // 		}
 // 		echo json_encode($data);
 // 	}

 // 	public function getCariRekeningBelanjaDel(){
 // 		$tabel=$this->input->post('tabel');
 // 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');

 // 		$que = "SELECT DISTINCT rb.id,kode_rek_belanja,nama_rek_belanja FROM ms_rekening_belanja rb INNER JOIN t_rekap_dana rd ON rd.fk_rekening_belanja_id=rb.id WHERE dari_tabel='$tabel' AND rd.fk_kegiatan_id=$fk_kegiatan_id"; 	
 // 		$hasil = $this->db->query($que)->result_array();

 // 		$data['nama_rek'] = "<option value=''>Pilih</option>\n";
 // 		foreach ((array)$hasil as $val) {
 // 			$data['nama_rek'] .= "<option value=\"".$val['id']."\">".$val['kode_rek_belanja'].' ['.$val['nama_rek_belanja'].']'."</option>\n";
 // 		}
 // 		echo json_encode($data);
 // 	}

 // 	public function getCariBKU(){
 // 		$id_rek=$this->input->post('id_rek');
 // 		$bulan=$this->input->post('bulan');
 // 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');

 // 		$que = "SELECT id,info_no_bku FROM t_rekap_dana WHERE spj_bulan=$bulan AND fk_kegiatan_id=$fk_kegiatan_id AND fk_rekening_belanja_id=$id_rek"; 	
 // 		$hasil = $this->db->query($que)->result_array();

 // 		$data['bku'] = "<option value=''>Pilih</option>\n";
 // 		foreach ((array)$hasil as $val) {
 // 			$data['bku'] .= "<option value=\"".$val['id']."\">".$val['info_no_bku']."</option>\n";
 // 		}
 // 		echo json_encode($data);
 // 	}

 // 	public function getCariRekeningBelanja(){
 // 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
 // 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 // 		$tabel=$this->input->post('tabel');

 // 		$andWhere='';
 // 		if($tabel=='t_entri_lembur'){
 // 			$andWhere=" AND (nama_rek_belanja LIKE '%Lembur%')";
 // 		}
 // 		if($tabel=='t_pjd'){
 // 			$andWhere=" AND (nama_rek_belanja LIKE '%Perjalanan%')";
 // 		}

 // 		$que = "SELECT rb.id,kode_rek_belanja,nama_rek_belanja FROM ms_rekening_belanja rb INNER JOIN ms_kegiatan kb ON kb.id=rb.fk_kegiatan_id WHERE kb.tahun=$this->tahun AND kb.fk_bagian_id=$fk_bagian_id AND rb.fk_kegiatan_id=$fk_kegiatan_id $andWhere"; 	
 // 		$hasil = $this->db->query($que)->result_array();

 // 		$data['nama_rek'] = "<option value=''>Pilih</option>\n";
 // 		foreach ((array)$hasil as $val) {
 // 			$data['nama_rek'] .= "<option value=\"".$val['id']."\">".$val['kode_rek_belanja'].' ['.$val['nama_rek_belanja'].']'."</option>\n";
 // 		}
 // 		echo json_encode($data);
 // 	}

 // 	public function getCariDanaSblm(){
 // 		$id_rek=$this->input->post('id_rek');
 // 		// $tabel=$this->input->post('tabel');
 // 		$bulan=$this->input->post('bulan');

 // 		$hsl = $this->db->query("SELECT anggaran,anggaran_per_perbup1,anggaran_per_perbup2,anggaran_per_perbup3,anggaran_per_perbup4,anggaran_pak,bts_anggaran_semester_1 FROM ms_rekening_belanja WHERE id=$id_rek")->row(); 		
 // 		$angg=$hsl->anggaran;
 // 		if(!empty($hsl->anggaran_per_perbup1)){
 // 			$angg=$hsl->anggaran_per_perbup1;
 // 		}
 // 		if(!empty($hsl->anggaran_per_perbup2)){
 // 			$angg=$hsl->anggaran_per_perbup2;
 // 		}
 // 		if(!empty($hsl->anggaran_per_perbup3)){
 // 			$angg=$hsl->anggaran_per_perbup3;
 // 		}
 // 		if(!empty($hsl->anggaran_per_perbup4)){
 // 			$angg=$hsl->anggaran_per_perbup4;
 // 		}
 // 		if(!empty($hsl->anggaran_pak)){
 // 			$angg=$hsl->anggaran_pak;
 // 		}
 // 		$data['anggaran']=number_format($angg);

 // 		$btsSmstr = $hsl->bts_anggaran_semester_1;
 // 		if(intval($bulan) >= 7){ // semester 2
 // 			$btsSmstr = $angg;
 // 		}
 // 		$data['bts_smster']=number_format($btsSmstr);

 // 		$hsl1 = $this->db->query("SELECT sum(pengajuan_sekarang) totPengajuanSblmPjd FROM t_pjd_dana where fk_rekening_belanja_id=$id_rek")->row();
 // 		$hsl2 = $this->db->query("SELECT id, sum(pengajuan_sekarang) totPengajuanSblm FROM t_rekap_dana where fk_rekening_belanja_id=$id_rek")->row();
 // 		$data['dana_sebelum']=number_format($hsl1->totPengajuanSblmPjd+$hsl2->totPengajuanSblm);

	//  	// if($tabel=='t_kwitansi'){
	//  		$que4="SELECT sum((IF(ppn IS NULL, 0, ppn))+(IF(pph_21 IS NULL, 0, pph_21))+(IF(pph_22 IS NULL, 0, pph_22))+(IF(pph_23 IS NULL, 0, pph_23))) tot_pajak_sebelum FROM t_rekap_dana rd INNER JOIN t_kwitansi k ON k.fk_rekap_dana_id=rd.id WHERE fk_rekening_belanja_id=$id_rek";
	//  		$hsl4 = $this->db->query($que4)->row();
	//  		$que44="SELECT b.tgl_pesanan,sum(bd.qty_akhir * bd.harga_satuan_beli) tot_all,npwp,jenis_pajak FROM t_rekap_dana rd
	// 				INNER JOIN pb_pesanan_barang b ON b.fk_rekap_dana_id=rd.id
	// 				INNER JOIN pb_pesanan_barang_detail bd ON bd.fk_pesanan_barang_id=b.id
	// 				INNER JOIN pb_ms_rekanan e ON e.id = b.fk_rekanan_id 
	// 				WHERE fk_rekening_belanja_id=$id_rek;";
	//  		$hsl44 = $this->db->query($que44)->row();
	//  		$totAll=$hsl44->tot_all;
	//  		$ppn=0; $nilaipph22=0; $nilaipph23=0; $ppn10Persen=0;
	//  		if(!empty($totAll)){
 //    //             $ppn1=10;
	// 			// $PmbgiPpn1=110;
	// 			// $btsBlnja=1000000;
	// 			// if(strtotime($hsl44->tgl_pesanan) > strtotime(date('2022-03-31'))){
	// 				// $ppn1=11;
	// 				// $PmbgiPpn1=111;
	// 				// $btsBlnja=2000000;
	// 			// }
	//  			//if($totAll >= $btsBlnja){ //lebih dari 1 juta / 2 juta
	//                 // $ppn10Persen = $totAll*($ppn1/$PmbgiPpn1);
	//                 // $ppn = $this->help->pembulatanSeratus(ceil($ppn10Persen));
	//             //}
	//            // if($totAll >= 2000000){ //lebih dari dua juta
	//                 // if($hsl44->npwp=='' || $hsl44->npwp=='-'){ //tidak punya npwp
	//                 //     $nilaipph22 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(3/100)));
	//                 // }else{
	//                 //     $nilaipph22 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(1.5/100)));
	//                 // }
	//             //}
	//  			foreach ((array)json_decode($hsl44->jenis_pajak) as $val) {
	//                 if($val=='PPN'){
 //                        $ppn1=11;
 //                        $PmbgiPpn1=111;
 //                        $ppn10Persen = $totAll*($ppn1/$PmbgiPpn1);
 //                        $ppn = number_format($this->help->pembulatanSeratus(ceil($ppn10Persen)));
 //                    }
 //                    if($val=='PPH_22'){
 //                        if($hsl44->npwp=='' || $hsl44->npwp=='-'){ //tidak punya npwp
 //                            $nilaipph22 = number_format($this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(3/100))));
 //                        }else{
 //                            $nilaipph22 = number_format($this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(1.5/100))));
 //                        }
 //                    }
 //                    if($val=='PPH_23'){
 //                        if($hsl44->npwp=='' || $hsl44->npwp=='-'){ //tidak punya npwp
 //                            $nilaipph23 = number_format($this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(4/100))));
 //                        }else{
 //                            $nilaipph23 = number_format($this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(2/100))));
 //                        }
 //                    }
 //                }
	//  		}
	//  		$totPjkKwitansiATK = $hsl4->tot_pajak_sebelum+$ppn+$nilaipph22+$nilaipph23;
	//  		$data['pajak_sblm']= $totPjkKwitansiATK;
	//  	// }

 // 		echo json_encode($data);
 // 	}

 // 	public function get_dataUpdateRekap(){
	// 	$tahun=$this->tahun;
 // 		$tabel=$this->input->post('tabel');
	// 	$data['tabel']=$tabel;
	// 	$fk_bagian_id=$this->input->post('fk_bagian_id');
	// 	$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
	// 	$data['updateRkp']=true;
			
 // 		if($tabel=='t_kwitansi'){
 // 			$data['is_kwi_hr']='no';
 // 			$queB = "SELECT id,tgl_kwitansi,untuk_pembayaran,kegiatan,banyaknya_uang total_akhir_all FROM $tabel t
 // 				WHERE tahun='$tahun' AND fk_bagian_id='$fk_bagian_id' AND fk_kegiatan_id='$fk_kegiatan_id' AND is_spj='0'
 // 				GROUP BY t.id
 // 				ORDER BY tgl_kwitansi"; 
 // 		}

 // 		$data['hasil'] = $this->db->query($queB)->result_array();
	// 	$this->load->view('Kwitansi/gridDataUpdateRekap',$data);
	// }

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
			redirect('Kwitansi/updateRekap');
		}

		$driTabel = 't_kwitansi';
		$qwe = "SELECT id, jenis_belanja FROM $driTabel WHERE id in ($plh2) ORDER BY tgl_kwitansi";
		$dtl = $this->db->query($qwe)->result();

		$noBaru = '1';
		$this->db->trans_start();		
			$jml_dana=str_replace(',', '', $this->input->post('jml_dana'));
			$pengajuan_sebelum=str_replace(',', '', $this->input->post('pengajuan_sebelum'));
			$pengajuan_sekarang=str_replace(',', '', $this->input->post('pengajuan_sekarang'));
			$sisa_kas=str_replace(',', '', $this->input->post('sisa_kas'));
			$tot_pajak_sblm=$this->input->post('tot_pajak_sblm');
			$user_act = $this->session->id;
			$time_act = date('Y-m-d H:i:s');
			$que = "insert into t_rekap_dana (dari_tabel,spj_bulan,fk_bagian_id,fk_kegiatan_id,fk_rekening_belanja_id,info_no_bku,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,pajak_tbl_kwitansi,user_act,time_act)
				values('$driTabel','$bulan',$fk_bagian_id,$fk_kegiatan_id,$fk_rekening_belanja_id,'$no_bku',$jml_dana,$pengajuan_sebelum,$pengajuan_sekarang,$sisa_kas,$tot_pajak_sblm,$user_act,'$time_act')";
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
 

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Buat Rekap berhasil.');
		}	

		$link = '';
		if($dtl[0]->jenis_belanja=='Barang'){
			$link = 'barangLainnya';
		}
		if($dtl[0]->jenis_belanja=='Swakelola'){
			$link = 'swakelola';
		}
        redirect('Kwitansi/'.$link);
	}

	public function deleteRekap($kat){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->arrBagian();
		$data['url'] = base_url().'Kwitansi/proses_delete_rekap';
		$data['tabel']='t_kwitansi';
		if($kat=='barang'){
			$jdl = 'Barang lainnya';
		}
		if($kat=='swakelola'){
			$jdl = 'Swakelola';
		}
		if($kat=='lainnya'){
			$jdl = 'Jasa Lainnya';
		}
		$data['judul']=$jdl;
		$data['kategori']=$kat;
		
		$this->template->load('Home/template','KwitansiHR/form_rekap_delete',$data);
	}

	// public function get_dataDeleteRekap(){
	// 	$tahun=$this->tahun;
 // 		$tabel=$this->input->post('tabel');
	// 	$data['tabel']=$tabel;
	// 	$id_rekap_dana=$this->input->post('id_rekap_dana');
	// 	$data['updateRkp']=false;
		
 // 		if($tabel=='t_kwitansi'){
 // 			$data['is_kwi_hr']='no';
 // 			$queB = "SELECT id,tgl_kwitansi,untuk_pembayaran,kegiatan,banyaknya_uang total_akhir_all FROM $tabel t
 // 				WHERE tahun='$tahun' AND fk_rekap_dana_id=$id_rekap_dana
 // 				GROUP BY t.id
 // 				ORDER BY no_kwitansi_rekap"; 
 // 		}

 // 		$data['hasil'] = $this->db->query($queB)->result_array();
	// 	$this->load->view('Kwitansi/gridDataUpdateRekap',$data);
	// }


	public function proses_delete_rekap(){
		$id_rekap_dana=$this->input->post('id_rekap_dana');
		$cek=$this->db->query("SELECT jenis_belanja FROM t_kwitansi WHERE fk_rekap_dana_id=$id_rekap_dana")->row();
		// $cek=$this->db->query("SELECT status_pengajuan_dana FROM t_rekap_dana WHERE id=$id_rekap_dana")->row();
		// if($cek->status_pengajuan_dana==1){
		// 	$this->session->set_flashdata('error', 'Data sudah dilakukan Pengajuan Dana.');
		// 	redirect('Kwitansi');
		// }
		
		$this->db->trans_start();

		    $data = array(
			        'spj_bulan' => NULL,
			        'is_spj' => '0',
			        'no_bku' => NULL,
			        'no_kwitansi_rekap' => NULL,
			        'fk_rekap_dana_id' => NULL,
			);
			$this->db->where('fk_rekap_dana_id', $id_rekap_dana);
			$this->db->update('t_kwitansi', $data);

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

		$link = '';
		if($cek->jenis_belanja=='Barang'){
			$link = 'barangLainnya';
		}
		if($cek->jenis_belanja=='Swakelola'){
			$link = 'swakelola';
		}
        redirect('Kwitansi/'.$link);
	}

	// public function updateBKU(){
	// 	$id_rekap_dana = $this->input->post('id_rekap_dana');
	// 	$no_bku = $this->input->post('no_bku');
	// 	$formnya = $this->input->post('formnya');

	// 	// if($formnya=='Lembur'){
	// 	// 	$tabel='t_entri_lembur';
	// 	// }
	// 	// if($formnya=='Rapat'){
	// 	// 	$tabel='t_rapat';
	// 	// }
	// 	// if($formnya=='Kwitansi'){
	// 		$tabel='t_kwitansi';
	// 	// }
	// 	// if($formnya=='KwitansiHR'){
	// 	// 	$tabel='t_kwitansi_hr';
	// 	// }		

	// 	$this->db->trans_start();

	// 	    $data = array(
	// 		        'info_no_bku' => $no_bku,
	// 		);
	// 		$this->db->where('id', $id_rekap_dana);
	// 		$this->db->update('t_rekap_dana', $data);

	// 		$data2 = array(
	// 		        'no_bku' => $no_bku,
	// 		);
	// 		$this->db->where('fk_rekap_dana_id', $id_rekap_dana);
	// 		$this->db->update($tabel, $data2);
		   	
	// 	$this->db->trans_complete();			
	// 	if ($this->db->trans_status() === FALSE) {
	// 	    $this->db->trans_rollback();
	// 	    $this->session->set_flashdata('error', 'Data Gagal dihapus.');
	// 	} 
	// 	else {
	// 	    $this->db->trans_commit();
	// 		$this->session->set_flashdata('success', 'Data BKU Berhasil diupdate.');
	// 	}

	// 	redirect($formnya);
	// }

	public function cetakKwi($id){
		$hsl = $this->MKwitansi->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
		$data['rekanan'] = $rkn[0];

		$html=$this->load->view('Kwitansi/cetakKwitansi',$data,true);
		$title = 'Kwitansi';
		
		echo $html;
		// $this->pdf($title,$html,'A5-L');
	}

	public function cetakSP($id){
		$hsl = $this->MKwitansi->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bag'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
		$data['rekanan'] = $rkn[0];

		$dtl = $this->MKwitansi->getDetail(array('fk_kwitansi_id'=>$id));
		$data['detail'] = $dtl;

		$data['header'] = $this->help->headerLaporan();

		$html=$this->load->view('Kwitansi/cetakSuratPesanan',$data,true);
		$title = 'Surat Pesanan';

		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function cetakBahp($id){
		$hsl = $this->MKwitansi->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bag'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$dtl = $this->MKwitansi->getDetail(array('fk_kwitansi_id'=>$id));
		$data['detail'] = $dtl;

		$data['header'] = $this->help->headerLaporan();
			 
		$tglKwi = $hsl[0]['tgl_kwitansi'];
		$data['kepPPK'] = $this->db->query("SELECT nomor,tgl_awal FROM ms_ppk WHERE (tgl_awal <= '$tglKwi' AND tgl_akhir >= '$tglKwi')")->row();

		if($hsl[0]['jenis_belanja']=='Swakelola'){
			$html=$this->load->view('Kwitansi/cetakBAHP_swakelola',$data,true);			
		}else{
			$html=$this->load->view('Kwitansi/cetakBAHP_biasa',$data,true);			
		}

		$title = 'BAHP';

		echo $html;
		die();

		$this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function cetakBast($id){
		$hsl = $this->MKwitansi->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bag'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$dtl = $this->MKwitansi->getDetail(array('fk_kwitansi_id'=>$id));
		$data['detail'] = $dtl;
		
		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
		$data['rekanan'] = $rkn[0];

		$tglKwi = $hsl[0]['tgl_kwitansi'];
		$data['kepPPK'] = $this->db->query("SELECT nomor,tgl_awal FROM ms_ppk WHERE (tgl_awal <= '$tglKwi' AND tgl_akhir >= '$tglKwi')")->row();

		$data['header'] = $this->help->headerLaporan();

		if($hsl[0]['jenis_belanja']=='Swakelola'){
			$html=$this->load->view('Kwitansi/cetakBAST_swakelola',$data,true);			
		}else{
			$html=$this->load->view('Kwitansi/cetakBAST_biasa',$data,true);			
		}

		$title = 'BAST';

		echo $html;
		die();

		$this->pdf($title,$html,$this->help->folio_P());
	}

	public function cetakKesanggupan($id){
		$hsl = $this->MKwitansi->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bag'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$dtl = $this->MKwitansi->getDetail(array('fk_kwitansi_id'=>$id));
		$data['detail'] = $dtl;

		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
		$data['rekanan'] = $rkn[0];

		$html=$this->load->view('Kwitansi/cetakKesanggupan',$data,true);
		$title = 'KesanggupanKerja';

		// echo $html;
		// die();
		
		$this->msword($title,$html);
	}

	public function cetakKesepakatanHarga($id){
		$hsl = $this->MKwitansi->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bag'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$dtl = $this->MKwitansi->getDetail(array('fk_kwitansi_id'=>$id));
		$data['detail'] = $dtl;

		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
		$data['rekanan'] = $rkn[0];

		$data['header'] = $this->help->headerLaporan();

		$html=$this->load->view('Kwitansi/cetakKesepakatanHarga',$data,true);
		$title = 'KesepakatanHarga';

		echo $html;
		die();

		$this->pdf($title,$html,$this->help->folio_P());
	}

	public function cetakSPK($id){
		$hsl = $this->MKwitansi->get(array('id'=>$id));
		$data['hasil'] = $hsl[0];

		$dtl = $this->MKwitansi->getDetail(array('fk_kwitansi_id'=>$id));
		$data['detail'] = $dtl;

		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
		$data['rekanan'] = $rkn[0];

		$data['header'] = $this->help->headerLaporan();

		$html=$this->load->view('Kwitansi/cetakSPK',$data,true);
		$title = 'SPK';

		echo $html;
		die();

		$this->pdf($title,$html,$this->help->folio_P());
	}

	public function cetakRekap(){		
		$id_rekap_dana=$this->input->post('id_rekap_dana');

		$data['tgl_rekap']=$this->input->post('tgl_rekap');
		$que = "SELECT rd.id,k.id id_kwi_hr,k.no_bku,k.spj_bulan,CONCAT(k.singkatan_bagian,'.',k.singkatan_kegiatan) singkat_keg,tahun,kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_pa,nip_pejabat_pa
		,nama_pejabat_kpa,nip_pejabat_kpa,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_tbl_kwitansi
			FROM t_rekap_dana rd INNER JOIN t_kwitansi k ON k.fk_rekap_dana_id=rd.id 
			INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id
			WHERE rd.id=$id_rekap_dana";
		$hsl = $this->db->query($que)->row();
		$data['hasil'] = $hsl;

		$qweDtl = "SELECT tgl_kwitansi,no_bku,no_kwitansi_rekap,untuk_pembayaran,banyaknya_uang,ppn,pph_21,pph_22,pph_23 FROM t_kwitansi WHERE fk_rekap_dana_id=$id_rekap_dana ORDER BY no_kwitansi_rekap";
		$data['detail'] = $this->db->query($qweDtl)->result();

		$html=$this->load->view('Kwitansi/cetakRekap',$data,true);
		$title = 'Kwitansi';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
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
