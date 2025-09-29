<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangKeluar extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		$this->load->model('MBarangKeluar');
		$this->load->model('MMsBarang');
		$this->load->model('MMsRekanan');
		$this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		$this->load->model('MMsKategoriBarang');		
		$this->load->model('MMsProgram');
		$this->load->model('MMsKegiatan');
		$this->load->model('MPesananBarang');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$data['arrKategoriBarang'] = $this->MMsKategoriBarang->get();
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$this->template->load('Home/template','BarangKeluar/list',$data);
	}

	public function getListDetail(){
		$data['nomor'] = $this->input->post('nomor');
		$data['kategori'] = $this->input->post('kategori');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');

		$this->load->view('BarangKeluar/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

		$nomor = $this->input->post('nomor');
		$kategori = $this->input->post('kategori');
		$fk_bagian_id = $this->input->post('fk_bagian_id');

		$this->datatables->where('pb_barang_keluar.tahun_anggaran',$this->tahun);
		if($nomor){
			$this->datatables->where('pb_barang_keluar.nomor',$nomor);
		}
		if($kategori){
			$this->datatables->where('pb_barang_keluar.kategori',$kategori);
		}
		if($fk_bagian_id){
			$this->datatables->where('pb_barang_keluar.fk_bagian_id_dituju',$fk_bagian_id);
		}
        $this->datatables->select('pb_barang_keluar.id,ms_bagian.singkatan_bagian,nomor,kategori,kegiatan_bappeda,count(pb_barang_keluar_detail.id) total_barang');
        $this->datatables->select("DATE_FORMAT(tgl, '%d/%m/%Y') AS tgl", FALSE);
        $this->datatables->from("pb_barang_keluar");
        $this->datatables->join('ms_bagian','ms_bagian.id=pb_barang_keluar.fk_bagian_id_dituju','inner');
        $this->datatables->join('pb_barang_keluar_detail','pb_barang_keluar_detail.fk_barang_keluar_id=pb_barang_keluar.id','left');
        $this->datatables->group_by('fk_barang_keluar_id');
        $this->db->order_by("pb_barang_keluar.tgl,nomor", "desc");
        echo $this->datatables->generate();
	}

	public function getKegiatan(){
 		$fk_bagian_id_dituju=$_POST['fk_bagian_id_dituju'];
 		$fk_kegiatan_id=$_POST['fk_kegiatan_id'];
 		$keg = $this->MMsKegiatan->get(array('fk_bagian_id'=>$fk_bagian_id_dituju,'tahun'=>$this->tahun));

 		$data['kegiatan'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$keg as $val) {
 			$selected = $val['id']==$fk_kegiatan_id?'selected':'';
 			$data['kegiatan'] .= "<option $selected value=\"".$val['id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

 	public function getCariBarang() {
	    $id=$this->input->post('id');
		
		$hsl = $this->db->query("SELECT * FROM pb_pesanan_barang_detail WHERE id=$id")->row();

		$data['id_barang'] = $hsl->fk_barang_id;
		$data['nama_barang'] = $hsl->nm_brg_gabung;
		$data['satuan'] = $hsl->satuan;
		$data['qty_akhir'] = $hsl->qty_akhir;
		$data['qty_sisa'] = $hsl->sisa_stok_blm_diambil;
		$data['harga_satuan'] = number_format($hsl->harga_satuan_beli);
		
		echo json_encode($data); 
	}

	public function getCariDetailBrg(){
		$kategori=$this->input->post('kategori');
		$fk_bagian_id=$this->input->post('fk_bagian_id_dituju');
		if($fk_bagian_id==1){ //sekret
			$andWhere= "fk_bagian_id = 1";
		}else{
			$andWhere= "fk_bagian_id IN ($fk_bagian_id)";
			// $andWhere= "fk_bagian_id IN ($fk_bagian_id, 1)";
		}

		$que = "SELECT
					dt.*, b.singkatan_bagian, nama_rekanan, DATE_FORMAT(p.tgl_brg_dtg,'%d-%m-%Y') tgl_datang
				FROM
					pb_pesanan_barang_detail dt
					JOIN pb_pesanan_barang p ON p.id = dt.fk_pesanan_barang_id
					JOIN pb_ms_rekanan pmr ON pmr.id=p.fk_rekanan_id
					JOIN ms_bagian b on b.id=p.fk_bagian_id 
				WHERE
					sisa_stok_blm_diambil != 0 
					AND tahun_anggaran = '$this->tahun'
					AND perihal='$kategori'
					AND p.terima_pesanan='1'
					AND $andWhere
				ORDER BY dt.fk_barang_id,p.tgl_brg_dtg  asc ";
		$data['hasil']=$this->db->query($que)->result();
		
		echo $this->load->view('BarangKeluar/detailBrg',$data);
	}

	public function create(){
		$Bagian=null;
		if($this->level!='1'){
			$Bagian=$this->fkBagianId;
		}
		$data = array(
			'button' => 'Simpan',
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
		$data['arrKategoriBarang'] = $this->MMsKategoriBarang->get();
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pejabat_ppk'=>'1'));
		$data['arrPPTK'] = $this->help->ttd_pptk();

		$this->template->load('Home/template','BarangKeluar/form',$data);
	}

	public function update($id){
		$hsl = $this->MBarangKeluar->get(array('id'=>$id));
		$hsl = $hsl[0];

		$data = array(
			'button' => 'Update',
			'tgl' => set_value('tgl',$this->help->ReverseTgl($hsl['tgl'])),
			'nomor' => set_value('nomor',$hsl['nomor']),
			'fk_bagian_id_dituju' => set_value('fk_bagian_id_dituju',$hsl['fk_bagian_id_dituju']),
			'kategori' => set_value('kategori',$hsl['kategori']),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id',$hsl['fk_kegiatan_id']),
			'nama_ppk' => set_value('nama_ppk',$hsl['nama_ppk']),
			'nama_pejabat_pptk' => set_value('nama_pejabat_pptk',$hsl['nama_pejabat_pptk']),
			'id' => set_value('id',$id),
		);

		$data['dataDetail'] = $this->MBarangKeluar->getDetail(array('fk_barang_keluar_id'=>$id));
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrKategoriBarang'] = $this->MMsKategoriBarang->get();
		$data['arrMsSdm'] = $this->help->namaSdm(array('status'=>1,'pejabat_ppk'=>'1'));
		$data['arrPPTK'] = $this->help->ttd_pptk();

		$this->template->load('Home/template','BarangKeluar/form',$data);
	}

	public function save(){		
		$id = $this->input->post('id');
		$listBrgId = $this->input->post('listBrgId');
		if(empty($id) && !isset($listBrgId)){
			$this->session->set_flashdata('error', 'Detail Barang tidak boleh kosong.');
			redirect('BarangKeluar/create');
		}

		$tgl = $this->input->post('tgl');
		$data['tgl'] = $this->help->ReverseTgl($tgl);		
		$data['kategori'] = $this->input->post('kategori');
		$data['fk_bagian_id_dituju'] = $this->input->post('fk_bagian_id_dituju');

		$kegBppdId=$this->input->post('fk_kegiatan_id');
		$data['fk_kegiatan_id'] = $kegBppdId;
			$msKeg = $this->MMsKegiatan->get(array('id'=>$kegBppdId));
		$data['kegiatan_bappeda'] = $msKeg[0]['kegiatan'];

		// $ppkEx = explode('_', $this->input->post('nama_ppk'));
		// $data['nama_ppk'] = $ppkEx[0];
		// $data['nip_ppk'] = $ppkEx[1];
		// $data['pangkat_ppk'] = $ppkEx[2];
		// $data['jabatan_ppk'] = $ppkEx[3];

		$pptk = explode('_', $this->input->post('nama_pejabat_pptk'));
		$data['nama_pejabat_pptk'] = $pptk[0];
		$data['nip_pejabat_pptk'] = $pptk[1];
		$data['jabatan_pejabat_pptk'] = $pptk[2];
			
		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		if(empty($id)){
			$data['tahun_anggaran'] = $this->tahun;
			$tg=explode('-', $tgl);
			$whr = $tg[2].$tg[1].$tg[0];
			$que = "SELECT MAX(SUBSTRING(nomor, -2)) no_urut FROM pb_barang_keluar WHERE SUBSTRING(nomor, 1,8) = '$whr'";
			$hsl = $this->db->query($que)->row();
			if(!empty($hsl->no_urut)){
				$kodeBr = $hsl->no_urut+1;
				if(strlen($kodeBr)==1){
					$kodeBr = '0'.$kodeBr;
				}
			}else{
				$kodeBr = '01';
			}

			$data['nomor'] = $whr.$kodeBr;
				
			$pphp=$this->db->query("SELECT nama,nip FROM ms_sdm WHERE pphp=1")->row();
			$data['nama_pphp'] = $pphp->nama;
			$data['nip_pphp'] = $pphp->nip;

			$this->db->trans_start(); 

				$this->MBarangKeluar->insert($data);			
				$barangKeluarId = $this->db->insert_id();

				$brgNm = $this->input->post('listBrgNm');
				$qtySisa = $this->input->post('listQtySisa');
				$qtyAkhir = $this->input->post('listQtyAkhir');
				$satuan = $this->input->post('listSatuan');
				$hrgSat = $this->input->post('listHrgSat');
				$psnanBrgId = $this->input->post('listPsnanBrgId');
												
				foreach ($listBrgId as $key => $val) {
					$dataDetail[] = array(
						'fk_barang_keluar_id'=>$barangKeluarId,
						'fk_barang_id'=>$val,
						'nm_brg_gabung'=>$brgNm[$key],
						'qty'=>$qtySisa[$key],
						'satuan'=>$satuan[$key],
						'harga_satuan'=>str_replace(',', '', $hrgSat[$key]),
						'fk_pesanan_barang_detail_id'=>$psnanBrgId[$key],
					);

					$dataUpdateQty[] = array(
						'id'=>$psnanBrgId[$key],
						'sisa_stok_blm_diambil'=>$qtyAkhir[$key]-$qtySisa[$key],
					);

				}

				$this->db->update_batch('pb_pesanan_barang_detail', $dataUpdateQty, 'id');  //update sisa_stok_blm_diambil
				$this->db->insert_batch('pb_barang_keluar_detail', $dataDetail);

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

				$this->MBarangKeluar->update($id,$data);		

				$brgNm = $this->input->post('listBrgNm');
				$qtySisa = $this->input->post('listQtySisa');
				$qtyAkhir = $this->input->post('listQtyAkhir');
				$satuan = $this->input->post('listSatuan');
				$hrgSat = $this->input->post('listHrgSat');
				$psnanBrgId = $this->input->post('listPsnanBrgId');
				
				if(isset($listBrgId)){
					foreach ($listBrgId as $key => $val) {
						$dataDetail[] = array(
							'fk_barang_keluar_id'=>$id,
							'fk_barang_id'=>$val,
							'nm_brg_gabung'=>$brgNm[$key],
							'qty'=>$qtySisa[$key],
							'satuan'=>$satuan[$key],
							'harga_satuan'=>str_replace(',', '', $hrgSat[$key]),
							'fk_pesanan_barang_detail_id'=>$psnanBrgId[$key],
						);

						$dataUpdateQty[] = array(
							'id'=>$psnanBrgId[$key],
							'sisa_stok_blm_diambil'=>$qtyAkhir[$key]-$qtySisa[$key],
						);

					}

					$this->db->update_batch('pb_pesanan_barang_detail', $dataUpdateQty, 'id');  //update sisa_stok_blm_diambil
					$this->db->insert_batch('pb_barang_keluar_detail', $dataDetail);
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
        redirect('BarangKeluar');
	}

	public function delete($id){		
		$this->db->trans_start();

			$this->MBarangKeluar->deleteDetailAll($id);
			$result = $this->MBarangKeluar->delete($id);
			if($result){
	        	$this->session->set_flashdata('success', 'Barang Keluar berhasil dihapus.');
	        }else{
	        	$this->session->set_flashdata('error', 'Barang Keluar gagal dihapus.');
	        }
	    $this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
		}

        redirect('BarangKeluar');
	}

	public function deleteDetail($id){
		$dtl = $this->MBarangKeluar->getDetail(array('id'=>$id));
		$dtl=$dtl[0];

		// $cri = $this->MPesananBarang->getDetail(array('id'=>$dtl['fk_pesanan_barang_detail_id']));
		// $cri=$cri[0];
		
		$this->db->trans_start();
			// $data['sisa_stok_blm_diambil']=$dtl['qty']+$cri['sisa_stok_blm_diambil'];
			// $this->MPesananBarang->updateDetail($dtl['fk_pesanan_barang_detail_id'],$data);

			$result = $this->MBarangKeluar->deleteDetail($id);
			if($result){
	        	$this->session->set_flashdata('success', 'Detail Barang Keluar berhasil dihapus.');
	        }else{
	        	$this->session->set_flashdata('error', 'Detail Barang Keluar gagal dihapus.');
	        }
	    $this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		} 
		else {
		    $this->db->trans_commit();
		}

        redirect('BarangKeluar/update/'.$dtl['fk_barang_keluar_id']);
	}

	public function sbbk($id){
		$hsl = $this->MBarangKeluar->get(array('id'=>$id));
		$hsl = $hsl[0];

		$data['header'] = $this->help->headerLaporan();
		$data['hasil'] = $hsl;

		$bdg = $this->MMsBagian->get(array('id'=>$hsl['fk_bagian_id_dituju']));
		$data['Bagian'] = $bdg[0];
			 
		$data['detail'] = $this->MBarangKeluar->getDetail((array('fk_barang_keluar_id'=>$id)));

		$html=$this->load->view('BarangKeluar/cetakSBBK',$data,true);
		$title = 'SBBK';

		echo $html;
		// $this->pdf($title,$html,$this->help->folio_P(),true);
	}
	
	protected function pdf($title,$html,$page,$batas=false){
		// echo $html;
		if($batas){
			$mpdf = new mPDF('utf-8', $page);
		}else{
        	$mpdf = new mPDF('utf-8', $page, 0, '', 8, 8, 8, 8, 8, 8);
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
