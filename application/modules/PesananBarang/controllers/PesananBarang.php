<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PesananBarang extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		$this->load->model('MPesananBarang');
		$this->load->model('MMsBarang');
		$this->load->model('MMsRekanan');
		$this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		$this->load->model('MMsKategoriBarang');		
		$this->load->model('MMsProgram');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsRekeningBelanja');
		$this->tahun = $this->session->userdata("tahun");
		$this->level = $this->session->userdata("level");
		$this->fkBagianId = $this->session->userdata("fk_bagian_id");
	}

	public function index(){
		$data['arrMsRekanan'] = $this->MMsRekanan->get(array('status'=>'1'));
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrBulan'] = $this->help->namaBulan();
		$this->template->load('Home/template','PesananBarang/list',$data);
	}

	public function getListDetail(){
		$data['nomor'] = $this->input->post('nomor');
		$data['fk_rekanan_id'] = $this->input->post('fk_rekanan_id');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['bulan'] = $this->input->post('bulan');
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->MMsBagian->get();

		$this->load->view('PesananBarang/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

		$nomor = $this->input->post('nomor');
		$fk_rekanan_id = $this->input->post('fk_rekanan_id');
		$fk_bagian_id = $this->input->post('fk_bagian_id');
		$bulan = $this->input->post('bulan');

		$this->datatables->where('pb_pesanan_barang.tahun_anggaran',$this->tahun);
		if($nomor){
			$this->datatables->where('pb_pesanan_barang.nomor',$nomor);
		}
		if($fk_rekanan_id){
			$this->datatables->where('pb_pesanan_barang.fk_rekanan_id',$fk_rekanan_id);
		}
		if($fk_bagian_id){
			$this->datatables->where('pb_pesanan_barang.fk_bagian_id',$fk_bagian_id);
		}
		if($bulan){
			$this->datatables->where('pb_pesanan_barang.spj_bulan',$bulan);
		}
        $this->datatables->select('pb_pesanan_barang.id,is_spj,pb_pesanan_barang.spj_bulan,nama_program, kegiatan,t_rekap_dana.info_no_bku,fk_rekap_dana_id,ms_bagian.singkatan_bagian,nomor,fk_rekanan_id,perihal,pb_ms_rekanan.nama_rekanan,nama_ppk,nama_pejabat_pptk,count(pb_pesanan_barang_detail.id) total_barang,terima_pesanan,sum(harga_satuan_beli*qty_akhir) as total_harga_beli,nama_rek_belanja,is_spj');
        $this->datatables->select("DATE_FORMAT(tgl_pesanan, '%d-%m-%Y') AS tgl_pesanan", FALSE);
        $this->datatables->from("pb_pesanan_barang");
        $this->datatables->join('ms_bagian','ms_bagian.id=pb_pesanan_barang.fk_bagian_id','inner');
        $this->datatables->join('pb_ms_rekanan','pb_ms_rekanan.id=pb_pesanan_barang.fk_rekanan_id','inner');
        $this->datatables->join('pb_pesanan_barang_detail','pb_pesanan_barang_detail.fk_pesanan_barang_id=pb_pesanan_barang.id','left');        
        $this->datatables->join('t_rekap_dana','t_rekap_dana.id=pb_pesanan_barang.fk_rekap_dana_id','left');
        $this->datatables->join('ms_rekening_belanja','ms_rekening_belanja.id=t_rekap_dana.fk_rekening_belanja_id','left');
        $this->datatables->group_by('fk_pesanan_barang_id');
        $this->db->order_by("pb_pesanan_barang.tgl_pesanan", "desc");
        echo $this->datatables->generate();
	}

	public function getBndhrPmbantu(){
 		$fk_bagian_id=$_POST['fk_bagian_id'];
 		$sdm = $this->MMsSdm->get(array('status'=>1, 'bendahara_pembantu'=>1));

 		$data['bnhrPmbt'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$sdm as $val) {
 			$selected = $val['fk_bagian_id']==$fk_bagian_id?'selected':'';
 			$data['bnhrPmbt'] .= "<option $selected value=\"".$val['nama'].'_'.$val['nip']."\">".$val['nama']."</option>\n";
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
			'tgl_pesanan' => set_value('tgl_pesanan'),
			'nomor' => set_value('nomor'),
			'idPerihal' => set_value('idPerihal'),
			'perihal' => set_value('perihal'),
			'fk_rekanan_id' => set_value('fk_rekanan_id'),
			'nama_ppk' => set_value('nama_ppk'),
			'fk_bagian_id' => set_value('fk_bagian_id'),
			'fk_program_id' => set_value('fk_program_id'),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id'),
			'no_kontrak' => set_value('no_kontrak'),
			'tgl_kontrak' => set_value('tgl_kontrak'),
			'nilai_kontrak' => set_value('nilai_kontrak'),
			'tgl_kuitansi' => set_value('tgl_kuitansi'),
			'no_kuitansi' => set_value('no_kuitansi'),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa'),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk'),
			'nama_bendahara' => set_value('nama_bendahara'),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu'),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id'),
			'jenis_pajak' => set_value('jenis_pajak'),
			'id' => set_value('id'),
		);

		$data['arrMsRekanan'] = $this->MMsRekanan->get(array('status'=>'1'));
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrKategoriBarang'] = $this->MMsKategoriBarang->get(array('status'=>1));
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pejabat_ppk'=>'1'));
		$data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['arrPPTK'] = $this->help->ttd_pptk();
		$data['tahun'] = $this->tahun;

		$this->template->load('Home/template','PesananBarang/form',$data);
	}

	public function update($id){
		$hsl = $this->MPesananBarang->get(array('id'=>$id));
		$hsl = $hsl[0];

		$data = array(
			'button' => 'Update',
			'tgl_pesanan' => set_value('tgl_pesanan',$this->help->ReverseTgl($hsl['tgl_pesanan'])),
			'nomor' => set_value('nomor',$hsl['nomor']),
			'idPerihal' => set_value('idPerihal',$hsl['id_perihal']),
			'perihal' => set_value('perihal',$hsl['perihal']),
			'fk_rekanan_id' => set_value('fk_rekanan_id',$hsl['fk_rekanan_id']),
			'nama_ppk' => set_value('nama_ppk',$hsl['nama_ppk']),
			'fk_bagian_id' => set_value('fk_bagian_id',$hsl['fk_bagian_id']),
			'fk_program_id' => set_value('fk_program_id',$hsl['fk_program_id']),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id',$hsl['fk_kegiatan_id']),
			'no_kontrak' => set_value('no_kontrak',$hsl['no_kontrak']),
			'tgl_kontrak' => set_value('tgl_kontrak',$this->help->ReverseTgl($hsl['tgl_kontrak'])),
			'nilai_kontrak' => set_value('nilai_kontrak',$hsl['nilai_kontrak']),
			'tgl_kuitansi' => set_value('tgl_kuitansi',$this->help->ReverseTgl($hsl['tgl_kuitansi'])),
			'nama_pejabat_kpa' => set_value('nama_pejabat_kpa',$hsl['nama_pejabat_kpa']),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk',$hsl['nama_pejabat_pptk']),
			'nama_bendahara' => set_value('nama_bendahara',$hsl['nama_bendahara']),
			'nama_bendahara_pembantu' => set_value('nama_bendahara_pembantu',$hsl['nama_bendahara_pembantu']),
			'no_kuitansi' => set_value('no_kuitansi',$hsl['no_kuitansi']),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id',$hsl['fk_rekening_belanja_id']),
			'jenis_pajak' => set_value('jenis_pajak',json_decode($hsl['jenis_pajak'])),
			'id' => set_value('id',$id),
		);

		$data['arrPesananDetail'] = $this->MPesananBarang->getDetail((array('fk_pesanan_barang_id'=>$id)));
		$data['arrMsRekanan'] = $this->MMsRekanan->get(array('status'=>'1'));
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrKategoriBarang'] = $this->MMsKategoriBarang->get();
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pejabat_ppk'=>'1'));
		$data['arrKPA'] = $this->help->ttd_kpa();
		$data['arrBendahara'] = $this->help->ttd_bendahara($this->tahun);
		$data['arrPPTK'] = $this->help->ttd_pptk();
		$data['tahun'] = $hsl['tahun_anggaran'];
		$data['is_spj'] = $hsl['is_spj'];

		$this->template->load('Home/template','PesananBarang/form',$data);
	}

	public function get_cari_barang() {
	    $namaBrg = $this->input->get('term'); 
	    $perihal = explode('_', $this->input->get('perihal'));
	    if($perihal==''){
	    	$Brg[] = array(
	            'label' => 'Perihal Pengadaan Tidak Boleh Kosong !!',
	            'id_barang' =>'',
	            'satuan' => '' ,
	            'std_harga_satuan' => '' ,
	        );
	    }else{
		    $this->db->select('pb_ms_barang.*'); 
		    $this->db->join('pb_ms_kategori_barang','pb_ms_kategori_barang.id=pb_ms_barang.fk_kategori_barang_id','inner');
		    $this->db->where("masa_thn_awal <=",$this->tahun);
        	$this->db->where("masa_thn_akhir >=",$this->tahun);
		    $this->db->where('pb_ms_kategori_barang.id',$perihal[0]);
		    $this->db->where("(nama_barang LIKE '%$namaBrg%' OR merk LIKE '%$namaBrg%') "); 
		    
		    $this->db->limit(20); 
		    $query = $this->db->get("pb_ms_barang");
		    $Brg       =  array();

		    foreach ($query->result() as $d) {
		    	$mrk='';
		    	if($d->merk){
		    		$mrk=' - '.$d->merk;
		    	}
		    	$spe='';
		    	if($d->spesifikasi){
		    		$spe=' ['.$d->spesifikasi.']';
		    	}
		        $Brg[]     = array(
		            'label' => $d->nama_barang.$mrk.' ('.$d->satuan.' - '.number_format($d->std_harga_satuan).')',
		            'nama_barangnya' => $d->nama_barang.$mrk,
		            'id_barang' => $d->id,
		            'satuan' => $d->satuan ,
		            'std_harga_satuan' => $d->std_harga_satuan ,
		            'std_harga_satuan_view' => number_format($d->std_harga_satuan) ,
		        );
		    }
		}
	    echo json_encode($Brg);   
	}

	public function getProgram(){
 		$fk_bagian_id=$_POST['fk_bagian_id'];
 		$fk_program_id=$_POST['fk_program_id'];
 			$this->MMsProgram->thn_in($this->tahun);
 		$bid = $this->MMsProgram->get(array('fk_bagian_id'=>$fk_bagian_id));

 		$data['Bagian'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$bid as $val) {
 			$selected = $val['id']==$fk_program_id?'selected':'';
 			$data['Bagian'] .= "<option $selected value=\"".$val['id']."\">".$val['nama_program']."</option>\n";
 		}
 		echo json_encode($data);
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

	public function save(){		
		$id = $this->input->post('id');
		$listBrgId = $this->input->post('listBrgId');
		if(empty($id) && !isset($listBrgId)){
			$this->session->set_flashdata('error', 'Detail Barang tidak boleh kosong.');
			redirect('PesananBarang/create');
		}

		$bdgId=$this->input->post('fk_bagian_id');
		$data['fk_bagian_id'] = $bdgId;

		// if($bdgId==5){ //sementara utk Bagian ANDAT per bln Feb 2019
		// 	$data['nama_bendahara_pembantu'] = 'DONI HENDRA H., SE';
		// 	$data['nip_bendahara_pembantu'] = '19831222 201101 1 006';
		// // }else{
		// 	$bndhrPmbt=$this->MMsSdm->get(array('fk_bagian_id'=>$bdgId,'bendahara_pembantu'=>1));
		// 	$data['nama_bendahara_pembantu'] = $bndhrPmbt[0]['nama'];
		// 	$data['nip_bendahara_pembantu'] = $bndhrPmbt[0]['nip'];
		// }

		$bndPm = explode('_', $this->input->post('nama_bendahara_pembantu'));
		$data['nama_bendahara_pembantu'] = $bndPm[0];
		$data['nip_bendahara_pembantu'] = $bndPm[1];

		$data['tgl_pesanan'] = $this->help->ReverseTgl($this->input->post('tgl_pesanan'));
		$data['nomor'] = $this->input->post('nomor');
			$prhl = explode('_', $this->input->post('perihal'));
		$data['id_perihal'] = $prhl[0];
		$data['perihal'] = $prhl[1];
		$data['fk_rekanan_id'] = $this->input->post('fk_rekanan_id');
		// $data['no_kontrak'] = $this->input->post('no_kontrak');
		// $data['tgl_kontrak'] = $this->help->ReverseTgl($this->input->post('tgl_kontrak'));
		$nilaiKontrak = $this->input->post('nilai_kontrak');
		$data['nilai_kontrak'] = empty($nilaiKontrak)?null:str_replace(',', '', $nilaiKontrak);

		$prgId=$this->input->post('fk_program_id');
		$data['fk_program_id'] = $prgId;
			$msPrg = $this->MMsProgram->get(array('id'=>$prgId));
		$data['nama_program'] = $msPrg[0]['nama_program'];

		$kegBppdId=$this->input->post('fk_kegiatan_id');
		$data['fk_kegiatan_id'] = $kegBppdId;
			$msKeg = $this->MMsKegiatan->get(array('id'=>$kegBppdId));
		$data['kegiatan'] = $msKeg[0]['kegiatan'];

		$rekId=$this->input->post('fk_rekening_belanja_id');
		$data['fk_rekening_belanja_id'] = $rekId;
			$msRek = $this->MMsRekeningBelanja->get(array('id'=>$rekId));
		$data['kode_rekening'] = $msRek[0]['kode_rek_belanja'];


		$ppkEx = explode('_', $this->input->post('nama_ppk'));
		$data['nama_ppk'] = $ppkEx[0];
		$data['nip_ppk'] = $ppkEx[1];
		$data['pangkat_ppk'] = $ppkEx[2];
		$data['jabatan_ppk'] = $ppkEx[3];

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
			
			$TglKw=$this->input->post('tgl_kuitansi');
		$data['tgl_kuitansi'] = !empty($TglKw)?$this->help->ReverseTgl($TglKw):null;
		$data['no_kuitansi'] = $this->input->post('no_kuitansi');

		$data['jenis_pajak']  = json_encode($this->input->post('jenis_pajak'));

		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		if(empty($id)){
			$data['tahun_anggaran'] = $this->tahun;
				
			$pphp=$this->db->query("SELECT nama,nip FROM ms_sdm WHERE pphp=1")->row();
			$data['nama_pphp'] = $pphp->nama;
			$data['nip_pphp'] = $pphp->nip;

			$this->db->trans_start(); 

				$this->MPesananBarang->insert($data);				
				$pesananId = $this->db->insert_id();

				$brgNm = $this->input->post('listBrgNm');
				$qtyAwal = $this->input->post('listQtyAwal');
				$satuan = $this->input->post('listSatuan');
				$hrgMak = $this->input->post('listHrgMak');
								
				foreach ($listBrgId as $key => $val) {
					$hrgMakNya = null;
					if($hrgMak[$key]){
						$hrgMakNya = $hrgMak[$key]+($hrgMak[$key]*11/100); //harga + ppn 11%
					}
					$dataDetail[] = array(
						'fk_pesanan_barang_id'=>$pesananId,
						'fk_barang_id'=>empty($val)?null:$val,
						'nm_brg_gabung'=>$brgNm[$key],
						'qty_awal'=>$qtyAwal[$key],
						'satuan'=>$satuan[$key],
						'harga_maksimal'=>$hrgMakNya,
					);
				}				
				$this->db->insert_batch('pb_pesanan_barang_detail', $dataDetail);

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

				$this->MPesananBarang->update($id,$data);		

				$brgNm = $this->input->post('listBrgNm');
				$qtyAwal = $this->input->post('listQtyAwal');
				$satuan = $this->input->post('listSatuan');
				$hrgMak = $this->input->post('listHrgMak');
				
				if(isset($listBrgId)){
					foreach ($listBrgId as $key => $val) {
						$hrgMakNya = null;
						if($hrgMak[$key]){
							$hrgMakNya = $hrgMak[$key]+($hrgMak[$key]*10/100);
						}
						$dataDetail[] = array(
							'fk_pesanan_barang_id'=>$id,
							'fk_barang_id'=>empty($val)?null:$val,
							'nm_brg_gabung'=>$brgNm[$key],
							'qty_awal'=>$qtyAwal[$key],
							'satuan'=>$satuan[$key],
							'harga_maksimal'=>$hrgMakNya,
						);
					}
					$this->db->insert_batch('pb_pesanan_barang_detail', $dataDetail);
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
        redirect('PesananBarang');
	}

	public function delete($id){   
		$this->db->trans_start();  
			$result = $this->MPesananBarang->delete($id);
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

        redirect('PesananBarang');
	}

	public function detail($id){
		$hsl = $this->MPesananBarang->get(array('id'=>$id));
		$data['hsl'] = $hsl[0];

		$data['Bagian'] = $this->MMsBagian->get(array('id'=>$hsl[0]['fk_bagian_id']));
		
		$data['detail'] = $this->MPesananBarang->getDetail((array('fk_pesanan_barang_id'=>$id)));
		$data['rekanan'] = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));

		$this->template->load('Home/template','PesananBarang/viewDetail',$data);
	}

	public function deleteDetail($fkPjdId, $id){
		$result = $this->MPesananBarang->deleteDetail($id);
		if($result){
        	$this->session->set_flashdata('success', 'Detail PJD berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Detail PJD gagal dihapus.');
        }
        redirect('PesananBarang/update/'.$fkPjdId);
	}

	public function getCariDataDetail(){
		$id=$this->input->post('id');
		$hsl=$this->MPesananBarang->getDetail((array('id'=>$id)));
		$hsl=$hsl[0];
		$data = array(
			'nm_brg'=>$hsl['nm_brg_gabung'],
			'satuan'=>$hsl['satuan'],
		);

		echo json_encode($data);
	}

	public function updateDetail(){
		$id=$this->input->post('detail_id');
		$fk_pesanan_barang_id=$this->input->post('detail_fk_pesanan_barang_id');
		$data['qty_awal']=$this->input->post('detail_qty');
		
		$this->MPesananBarang->updateDetail($id,$data);
		redirect('PesananBarang/update/'.$fk_pesanan_barang_id);
	}

	public function getKegiatanRekap(){
 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$que = "SELECT fk_kegiatan_id,kegiatan FROM pb_pesanan_barang WHERE tahun_anggaran=$this->tahun AND terima_pesanan='1' AND fk_rekanan_id!=2 AND is_spj='0' AND fk_bagian_id=$fk_bagian_id GROUP BY fk_kegiatan_id";
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

 	public function get_dataUpdateRekap(){
		$tahun=$this->tahun;
		$fk_bagian_id=$this->input->post('fk_bagian_id');
		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
		$data['updateRkp']=true;

		$queB = "SELECT DISTINCT pb.*, rc.nama_rekanan, sum(harga_satuan_beli*qty_akhir) total_akhir_all FROM pb_pesanan_barang_detail pbd INNER JOIN pb_pesanan_barang pb ON pb.id=pbd.fk_pesanan_barang_id INNER JOIN pb_ms_rekanan rc ON rc.id=pb.fk_rekanan_id WHERE tahun_anggaran=$tahun AND fk_bagian_id=$fk_bagian_id AND fk_kegiatan_id=$fk_kegiatan_id AND is_spj='0'
			GROUP BY pb.id
			ORDER BY pb.tgl_kuitansi"; 	
 					
 		$data['hasil'] = $this->db->query($queB)->result_array();
		$this->load->view('PesananBarang/gridDataUpdateRekap',$data);
	}

	public function updateRekap(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->MMsBagian->get();
		$data['url'] = base_url().'PesananBarang/proses_update_rekap';
		
		$this->template->load('Home/template','PesananBarang/form_rekap',$data);
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
			redirect('PesananBarang/updateRekap');
		}

		$driTabel = 'pb_pesanan_barang';
		$qwe = "SELECT id FROM $driTabel WHERE id in ($plh2) ORDER BY tgl_kuitansi";
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
				values('$driTabel','$bulan',$fk_bagian_id,$fk_kegiatan_id,$fk_rekening_belanja_id,'$no_bku',$jml_dana,$pengajuan_sebelum,$pengajuan_sekarang,$sisa_kas,'$tot_pajak_sblm',$user_act,'$time_act')";
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
			$this->session->set_flashdata('success', 'Proses Rekap berhasil.');
		}	
		
		redirect('PesananBarang');
	}

	public function updateBKU(){
		$id_rekap_dana = $this->input->post('id_rekap_dana');
		$no_bku = $this->input->post('no_bku');

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
			$this->db->update('pb_pesanan_barang', $data2);
		   	
		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal diupdate.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data BKU Berhasil diupdate.');
		}

		redirect('PesananBarang');
	}

	public function deleteRekap(){
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrBagian'] = $this->MMsBagian->get();
		$data['url'] = base_url().'PesananBarang/proses_delete_rekap';
		$data['judul']='Pesanan Barang';
		
		$this->template->load('Home/template','PesananBarang/form_rekap_delete',$data);
	}

	public function getKegiatanRekapDel(){
 		$fk_bagian_id=$this->input->post('fk_bagian_id');
 		$bulan=$this->input->post('bulan');
 		$que = "SELECT fk_kegiatan_id,kegiatan FROM pb_pesanan_barang WHERE tahun_anggaran=$this->tahun AND spj_bulan='$bulan' AND is_spj='1' AND fk_bagian_id=$fk_bagian_id GROUP BY fk_kegiatan_id";
 		$nmKeg = $this->db->query($que)->result_array();

 		$data['nama_keg'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$nmKeg as $val) {
 			$data['nama_keg'] .= "<option value=\"".$val['fk_kegiatan_id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getCariRekeningBelanjaDel(){
 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');

 		$que = "SELECT DISTINCT rb.id,kode_rek_belanja,nama_rek_belanja FROM ms_rekening_belanja rb INNER JOIN t_rekap_dana rd ON rd.fk_rekening_belanja_id=rb.id WHERE dari_tabel='pb_pesanan_barang' AND rd.fk_kegiatan_id=$fk_kegiatan_id"; 	
 		$hasil = $this->db->query($que)->result_array();

 		$data['nama_rek'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hasil as $val) {
 			$data['nama_rek'] .= "<option value=\"".$val['id']."\">".$val['kode_rek_belanja'].' ['.$val['nama_rek_belanja'].']'."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getCariBKU(){
 		$id_rek=$this->input->post('id_rek');
 		$bulan=$this->input->post('bulan');
 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');

 		$que = "SELECT id,info_no_bku FROM t_rekap_dana WHERE spj_bulan=$bulan AND fk_kegiatan_id=$fk_kegiatan_id AND fk_rekening_belanja_id=$id_rek"; 	
 		$hasil = $this->db->query($que)->result_array();

 		$data['bku'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hasil as $val) {
 			$data['bku'] .= "<option value=\"".$val['id']."\">".$val['info_no_bku']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function get_dataDeleteRekap(){
		$tahun=$this->tahun;
		$id_rekap_dana=$this->input->post('id_rekap_dana');
		$data['updateRkp']=false;

 		$queB = "SELECT DISTINCT pb.*, mr.nama_rekanan, sum(harga_satuan_beli*qty_akhir) total_akhir_all FROM pb_pesanan_barang_detail pbd INNER JOIN pb_pesanan_barang pb ON pb.id=pbd.fk_pesanan_barang_id INNER JOIN pb_ms_rekanan mr ON mr.id=pb.fk_rekanan_id WHERE tahun_anggaran=$tahun AND fk_rekap_dana_id=$id_rekap_dana
			GROUP BY pb.id
			ORDER BY pb.no_kwitansi_rekap"; 

 		$data['hasil'] = $this->db->query($queB)->result_array();
		$this->load->view('PesananBarang/gridDataUpdateRekap',$data);
	}

	public function proses_delete_rekap(){
		$id_rekap_dana=$this->input->post('id_rekap_dana');
		$cek=$this->db->query("SELECT status_pengajuan_dana FROM t_rekap_dana WHERE id=$id_rekap_dana")->row();
		if($cek->status_pengajuan_dana==1){
			$this->session->set_flashdata('error', 'Data sudah dilakukan Pengajuan Dana.');
			redirect('PesananBarang');
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
			$this->db->update('pb_pesanan_barang', $data);

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

		redirect('PesananBarang');
	}

	public function cetakRekap(){		
		$id_rekap_dana=$this->input->post('id_rekap_dana');

		$data['tgl_rekap']=$this->input->post('tgl_rekap');
		$que = "SELECT rd.id,k.id id_pesanan_barang,k.no_bku,k.spj_bulan,CONCAT(bi.singkatan_bagian,'.',kb.singkatan) singkat_keg,k.tahun_anggaran tahun,b.kode_rek_belanja,nama_rek_belanja,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,kegiatan,nama_pejabat_kpa,nip_pejabat_kpa
		,nama_pejabat_pptk,nip_pejabat_pptk,nama_bendahara,nip_bendahara,nama_bendahara_pembantu,nip_bendahara_pembantu,pajak_tbl_kwitansi
			FROM t_rekap_dana rd 
			INNER JOIN pb_pesanan_barang k ON k.fk_rekap_dana_id=rd.id 
			INNER JOIN ms_bagian bi ON bi.id=k.fk_bagian_id
			INNER JOIN ms_kegiatan kb ON kb.id=k.fk_kegiatan_id
			INNER JOIN ms_rekening_belanja b ON b.id=rd.fk_rekening_belanja_id
			WHERE rd.id=$id_rekap_dana";
		$hsl = $this->db->query($que)->row();
		$data['hasil'] = $hsl;

		$qweDtl = "SELECT tgl_pesanan,tgl_kuitansi,no_bku,no_kwitansi_rekap,jenis_pajak,perihal untuk_pembayaran,sum(harga_satuan_beli*qty_akhir) banyaknya_uang,mr.npwp FROM pb_pesanan_barang p INNER join pb_pesanan_barang_detail pd ON pd.fk_pesanan_barang_id=p.id INNER JOIN pb_ms_rekanan mr ON mr.id=p.fk_rekanan_id WHERE fk_rekap_dana_id=$id_rekap_dana GROUP BY p.id ORDER BY no_kwitansi_rekap";
		$data['detail'] = $this->db->query($qweDtl)->result();

		$html=$this->load->view('PesananBarang/cetakRekap',$data,true);
		$title = 'PesananBarang';
		
		echo $html;
		// $this->pdf($title,$html,$this->help->folio_L());
	}

	public function verifikasi($id){
		$hsl = $this->MPesananBarang->get(array('id'=>$id));
		$hsl = $hsl[0];
		$data['hsl'] = $hsl;

		$data['Bagian'] = $this->MMsBagian->get(array('id'=>$hsl['fk_bagian_id']));
		
		$dtl = $this->MPesananBarang->getDetail((array('fk_pesanan_barang_id'=>$id)));
		$data['detail'] = $dtl;
		$brg_id=''; $no=1;
		foreach ($dtl as $val) {
			$brg_id.=$val['fk_barang_id'];
			if(count($dtl) != $no){
				$brg_id.=',';
			}
			$no++;
		}

		if($hsl['id_perihal']=='4'){ //pengadaan / fotocopy
			$andWhere = " AND fk_barang_id IS NULL";
			$groupBy = " satuan";
			$form = "verifikasi_pengadaan";
		}else{
			$andWhere = " AND fk_barang_id IN ($brg_id)";
			$groupBy = " fk_barang_id";
			$form = "verifikasi";
		}

		$crTgl = explode('-', $hsl['tgl_pesanan']);
		$tglPsn = $crTgl[1];

		$fkRekananId = $hsl['fk_rekanan_id'];
		$thn=$this->tahun;
		$que = "SELECT
					satuan,fk_barang_id,
					max(harga_satuan_beli) harga_satuan_beli
				FROM
					pb_pesanan_barang_detail td
					JOIN pb_pesanan_barang t ON td.fk_pesanan_barang_id=t.id 
				WHERE
					harga_satuan_beli IS NOT NULL 
					AND status_verifikasi='1'
					AND YEAR(tgl_brg_dtg)='$thn' AND MONTH(tgl_brg_dtg) <= '$tglPsn'	
					$andWhere
					AND (fk_rekanan_id=$fkRekananId)
				GROUP BY $groupBy
				"; 
					// AND (fk_rekanan_id=$fkRekananId || fk_rekanan_id=2)
					// AND YEAR (date_update_verifikasi) = '$thn' 
		$crDt = $this->db->query($que)->result();

		$cariData=array();
		if($hsl['id_perihal']=='4'){ //pengadaan / fotocopy
			foreach ($crDt as $dt) {
				$cariData[$dt->satuan]=$dt->harga_satuan_beli;
			}
		}else{			
			foreach ($crDt as $dt2) {
				$cariData[$dt2->fk_barang_id]=$dt2->harga_satuan_beli;
			}
		}

		$data['cariData'] = $cariData;		

		$data['rekanan'] = $this->MMsRekanan->get(array('id'=>$hsl['fk_rekanan_id']));

		$this->template->load('Home/template',"PesananBarang/$form",$data);
	}

	public function saveVerifikasi(){
		$idPesananBrg = $this->input->post('idPesananBrg');
		// $listStatusVer = $this->input->post('listStatusVer');
		// if(!isset($listStatusVer)){
		// 	$this->session->set_flashdata('error', 'Silahkan centang data yang akan di Verifikasi.');
		// 	redirect("PesananBarang/verifikasi/$idPesananBrg");
		// }
		$tglVer = $this->help->ReverseTgl($this->input->post('tgl_ver'));
		// $kepPA = $this->db->query("SELECT * FROM pb_ms_keputusan_pa WHERE keterangan='KPA' AND (tgl_awal <= '$tglVer' AND tgl_akhir >= '$tglVer')")->row();
		$kepPjPHP = $this->db->query("SELECT * FROM pb_ms_keputusan_pa WHERE keterangan='PjPHP' AND (tgl_awal <= '$tglVer' AND tgl_akhir >= '$tglVer')")->row();
	
		$this->db->trans_start(); 

			// $data['no_keputusan_pa'] = $kepPA->nomor;
			// $data['tgl_keputusan_pa'] = $kepPA->tgl_awal;
			$data['no_keputusan_pjphp'] = $kepPjPHP->nomor;
			$data['tgl_keputusan_pjphp'] = $kepPjPHP->tgl_awal;
			$data['tgl_brg_dtg'] = $tglVer;
			$data['terima_pesanan'] = '1';
			$data['user_act_terima'] = $this->session->id;
			$data['time_act_terima'] = date('Y-m-d H:i:s');
			$this->MPesananBarang->update($idPesananBrg,$data);

			$listIdDetail = $this->input->post('listIdDetail');
			$listIdBrg = $this->input->post('listIdBrg');
			$qtyAkhir = $this->input->post('listQtyAkhir');
			$hargaSatBeli = $this->input->post('listHargaSatBeli');
			$hargaMin = $this->input->post('listHargaMin');

			foreach ($listIdDetail as $key => $val) {
				$dataDetail[] = array(
					'id'=>$val,
					'harga_minimal'=>$hargaMin[$val],
					'qty_akhir'=>$qtyAkhir[$val],
					'sisa_stok_blm_diambil'=>$qtyAkhir[$val],
					'harga_satuan_beli'=>str_replace(',', '', $hargaSatBeli[$val]),
					'status_verifikasi'=>'1',
					'date_update_verifikasi'=>date('Y-m-d H:i:s'),
				);

			}
				
			$this->db->update_batch('pb_pesanan_barang_detail', $dataDetail, 'id');

		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		}	

		redirect('PesananBarang');
	}

	public function batalverifikasi($id){
		$dtl = $this->MPesananBarang->getDetail(array('fk_pesanan_barang_id'=>$id));
		
		$this->db->trans_start();
			
			$data['no_keputusan_pa'] = null;
			$data['tgl_keputusan_pa'] = null;
			$data['no_keputusan_pjphp'] = null;
			$data['tgl_keputusan_pjphp'] = null;
			$data['tgl_brg_dtg'] = null;
			$data['terima_pesanan'] = '0';
			$data['user_act_terima'] = null;
			$data['time_act_terima'] = null;
			$this->MPesananBarang->update($id,$data);

			$dataDetail = array(
				'harga_minimal'=>null,
				'qty_akhir'=>null,
				'harga_satuan_beli'=>null,
				'status_verifikasi'=>null,
				'date_update_verifikasi'=>null,
			);
			$this->db->where('fk_pesanan_barang_id', $id);
			$this->db->update('pb_pesanan_barang_detail', $dataDetail);

		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Pembatalan Verifikasi Gagal Diproses.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Pembatalan Verifikasi Berhasil Diproses.');
		}	

		redirect('PesananBarang');
	}

	public function verifikasiPerItem(){
		$id = $this->input->post('id'); 
		$hrgMin = $this->input->post('hrgMin'); 
		$qtyAkhr = $this->input->post('qtyAkhr'); 
		$hargaBeli = $this->input->post('hargaBeli'); 

		$dataDetail = array(
			'harga_minimal'=>$hrgMin,
			'qty_akhir'=>$qtyAkhr,
			'sisa_stok_blm_diambil'=>$qtyAkhr,
			'harga_satuan_beli'=>str_replace(',', '', $hargaBeli),
			'status_verifikasi'=>'1',
			'date_update_verifikasi'=>date('Y-m-d H:i:s'),
		);
		$this->db->where('id', $id);
		$this->db->update('pb_pesanan_barang_detail', $dataDetail);

		$data['notif'] = "Simpan Data Berhasil Diproses.";
		echo json_encode($data); 
	}

	protected function totalNilaiVer($id){
		$que = "SELECT
					SUM(qty_akhir*harga_satuan_beli) total 
				FROM
					pb_pesanan_barang_detail 
				WHERE
					fk_pesanan_barang_id =$id";
		return $this->db->query($que)->row()->total;
	}

	public function surat_pesanan($id){
		$hsl = $this->MPesananBarang->get(array('id'=>$id));
		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));

		$data['header'] = $this->help->headerLaporan();
		$data['hasil'] = $hsl[0];
		$data['rekanan'] = $rkn[0];
			 
		$data['detail'] = $this->MPesananBarang->getDetail((array('fk_pesanan_barang_id'=>$id)));

		$html=$this->load->view('PesananBarang/cetakSuratPesanan',$data,true);
		$title = 'Surat Pesanan';

		echo $html;
		die();
		
		$this->pdf($title,$html,$this->help->folio_P());
	}

	public function kwitansi($id){
		$que = "SELECT * FROM v_pesanan_barang WHERE id=$id";
		$data['hasil'] = $this->db->query($que)->row();

		$html=$this->load->view('PesananBarang/cetakKwitansi',$data,true);
		$title = 'Kwitansi';
		echo $html;die();
		// $this->pdf($title,$html,'A5-L',false,true);
	}

	public function bahp($id){
		$hsl = $this->MPesananBarang->get(array('id'=>$id));
		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));

		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bag'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$data['header'] = $this->help->headerLaporan();
		$data['hasil'] = $hsl[0];
		$data['rekanan'] = $rkn[0];
		$data['total_nilai'] = $this->totalNilaiVer($id);

		$tglnya = $hsl[0]['tgl_brg_dtg'];
		$data['kepPPK'] = $this->db->query("SELECT nomor,tgl_awal FROM ms_ppk WHERE (tgl_awal <= '$tglnya' AND tgl_akhir >= '$tglnya')")->row();
	
		$data['detail'] = $this->MPesananBarang->getDetail((array('fk_pesanan_barang_id'=>$id)));

		$html=$this->load->view('PesananBarang/cetakBAHP',$data,true);
		$title = 'BAHP';

		echo $html;
		die();

		$this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function bast($id){
		$hsl = $this->MPesananBarang->get(array('id'=>$id));
		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
		$fkBagian=$hsl[0]['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data['bag'] = $this->db->query("SELECT kode_bagian,nama_bagian FROM ms_bagian WHERE id=$fkBagian")->row();

		$data['header'] = $this->help->headerLaporan();
		$data['hasil'] = $hsl[0];
		$data['rekanan'] = $rkn[0];
		$data['total_nilai'] = $this->totalNilaiVer($id);

		$tglnya = $hsl[0]['tgl_brg_dtg'];
		$data['kepPPK'] = $this->db->query("SELECT nomor,tgl_awal FROM ms_ppk WHERE (tgl_awal <= '$tglnya' AND tgl_akhir >= '$tglnya')")->row();
			 
		$data['detail'] = $this->MPesananBarang->getDetail((array('fk_pesanan_barang_id'=>$id)));

		$html=$this->load->view('PesananBarang/cetakBAST',$data,true);
		$title = 'BAST-PPK';

		echo $html;
		die();

		$this->pdf($title,$html,$this->help->folio_P());
	}

	public function bahpab($id){
		$hsl = $this->MPesananBarang->get(array('id'=>$id));
		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));

		$tglBrg = $hsl[0]['tgl_brg_dtg'];
		$dpa = $this->db->query("SELECT * FROM ms_dpa WHERE (tgl_awal <= '$tglBrg' AND tgl_akhir >= '$tglBrg')")->row();
		$data['tgl_dpa'] = $this->help->ReverseTgl($dpa->tgl);
		$data['no_dpa'] = $dpa->nomor;

		$ppk = $this->db->query("SELECT * FROM ms_ppk WHERE (tgl_awal <= '$tglBrg' AND tgl_akhir >= '$tglBrg')")->row();
		$data['tgl_ppk'] = $this->help->ReverseTgl($ppk->tgl_awal);
		$data['no_ppk'] = $ppk->nomor;

		$data['header'] = $this->help->headerLaporan();
		$data['hasil'] = $hsl[0];
		$data['rekanan'] = $rkn[0];
		$data['total_nilai'] = $this->totalNilaiVer($id);
			 
		$data['detail'] = $this->MPesananBarang->getDetail((array('fk_pesanan_barang_id'=>$id)));

		$html=$this->load->view('PesananBarang/cetakBAHPAB',$data,true);
		$title = 'BAHPAB';

		$this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function spl($id){
		$hsl = $this->MPesananBarang->get(array('id'=>$id));
		$rkn = $this->MMsRekanan->get(array('id'=>$hsl[0]['fk_rekanan_id']));
		$data['rekanan'] = $rkn[0];

		$data['header'] = $this->help->headerLaporan();
		$data['hasil'] = $hsl[0];
			 
		$data['detail'] = $this->MPesananBarang->getDetail((array('fk_pesanan_barang_id'=>$id)));

		$html=$this->load->view('PesananBarang/cetakSPL',$data,true);
		$title = 'Surat Pembelian Langsung';

		echo $html;die();
		// $this->pdf($title,$html,$this->help->folio_P(),true);
	}

	public function keluarBarang($id){
		$hsl = $this->MPesananBarang->get(array('id'=>$id));
		$data['hasil'] = $hsl;
		$hslDtl = $this->MPesananBarang->getDetail(array('fk_pesanan_barang_id'=>$id));
		$data['detail'] = $hslDtl;

		$data = array(
			'button' => 'Proses',
			'tgl' => set_value('tgl',date('d-m-Y')),
			'nomor' => set_value('nomor'),
			'fk_bagian_id_dituju' => set_value('fk_bagian_id_dituju'),
			'kategori' => set_value('kategori'),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id'),
			'nama_ppk' => set_value('nama_ppk'),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk'),
			'id' => set_value('id'),
		);

		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pejabat_ppk'=>'1'));
		$data['arrPPTK'] = $this->help->ttd_pptk();

		$this->template->load('Home/template','PesananBarang/keluarBarangForm',$data);
	}
	
	protected function pdf($title,$html,$page,$batas=false,$kwi=false){
		// echo $html;
		if($batas){
			$mpdf = new mPDF('utf-8', $page);
		}else{
        	$mpdf = new mPDF('utf-8', $page, 0, '', 8, 8, 8, 8, 8, 8);
        }
        if($kwi){
        	$mpdf = new mPDF('utf-8', $page, 0, '', 5, 5, 5, 3, 8, 8);
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
