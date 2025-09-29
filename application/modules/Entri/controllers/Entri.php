<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entri extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MEntri');
		$this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsKegiatanOrang');
		$this->load->model('MMsHariLibur');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrBulan'] = $this->help->namaBulan();
		$this->template->load('Home/template','Entri/list',$data);
	}

	public function getKegiatan(){
 		$fk_bagian_id=$_POST['fk_bagian_id'];
 		$fk_program_id=$_POST['fk_program_id'];
 		$keg = $this->MMsKegiatan->get(array('fk_bagian_id'=>$fk_bagian_id,'fk_program_id'=>$fk_program_id,'tahun'=>$this->tahun));

 		$data['kegiatan'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$keg as $val) {
 			$data['kegiatan'] .= "<option value=\"".$val['id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

	public function getListDetail(){
		$data['nomor'] = $this->input->post('nomor');
		$data['bulan'] = $this->input->post('bulan');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');

		$this->load->view('Entri/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

        $tahun = $this->tahun;
		$nomor = $this->input->post('nomor');
		$bulan = $this->input->post('bulan');
		$fk_bagian_id = $this->input->post('fk_bagian_id');
		$fk_program_id = $this->input->post('fk_program_id');
		$fk_kegiatan_id = $this->input->post('fk_kegiatan_id');

		$this->datatables->where('t_entri.tahun',$tahun);
		if($nomor){
			$this->datatables->where('t_entri.nomor',$nomor);
		}
		if($bulan){
			$this->datatables->where('t_entri.bulan',$bulan);
		}
		if($fk_bagian_id){
			$this->datatables->where('t_entri.fk_bagian_id',$fk_bagian_id);
		}
		if($fk_program_id){
			$this->datatables->where('t_entri.fk_program_id',$fk_program_id);
		}
		if($fk_kegiatan_id){
			$this->datatables->where('t_entri.fk_kegiatan_id',$fk_kegiatan_id);
		}
        $this->datatables->select('t_entri.id,t_entri.tahun,nama_gu,bulan,nama_bagian,nama_program,kegiatan,count(t_entri_detail.id) total_spj,nomor,catatan,max(fk_kegiatan_orang_id) fk_kegiatan_orang_id,max(DATE_FORMAT(tgl, "%d/%m/%Y")) tglnya');
        $this->datatables->from("t_entri");
        $this->datatables->join('t_entri_detail','t_entri_detail.fk_entri_id=t_entri.id','left');
        $this->datatables->join('ms_bagian','ms_bagian.id=t_entri.fk_bagian_id','inner');
        $this->datatables->join('ms_program','ms_program.id=t_entri.fk_program_id','inner');
        $this->datatables->join('ms_kegiatan_bappeda','ms_kegiatan_bappeda.id=t_entri.fk_kegiatan_id','inner');
        $this->datatables->group_by('fk_entri_id');
        $this->db->order_by("bulan", "desc");
        $this->db->order_by("nama_gu,nomor", "asc");
        echo $this->datatables->generate();
	}

	public function cariDataDetail(){
		$id = $this->input->post('id');
		$que = "select nama_sdm,nama_kegiatan_orang,tgl from t_entri_detail where id=$id";
		$dat = $this->db->query($que)->row();

		$data['nama'] = $dat->nama_sdm;
		$data['keg_orang'] = $dat->nama_kegiatan_orang;
		$data['tgl'] = $this->help->ReverseTgl($dat->tgl);

		echo json_encode($data);
	}

	public function create(){
		// $que = "select CASE WHEN nomor is null THEN 1 ELSE max(CAST(nomor AS UNSIGNED INTEGER))+1 END nomor from t_entri";
		// $dat = $this->db->query($que)->row();
		// $data['nomor'] = $dat->nomor;	
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrMsSdm'] = $this->MMsSdm->get(array('status'=>1,'pegawai_bappeda'=>1));
		$data['arrMsKegOrg'] = $this->MMsKegiatanOrang->get();

		$this->template->load('Home/template','Entri/form',$data);
	}

	public function cariGU(){
		$tahun = $this->tahun;
		$bulan = $this->input->post('bulan');
		$dataGU = $this->db->query("SELECT nama FROM t_entri_gu WHERE tahun='$tahun' AND bulan='$bulan' ORDER BY nama")->result_array();

		$data['namaGU'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$dataGU as $val) {
 			$data['namaGU'] .= "<option value=\"".$val['nama']."\">".$val['nama']."</option>\n";
 		}
 		echo json_encode($data);
	}

	public function cekTglLibur(){
		$tgl = $this->help->ReverseTgl($this->input->post('tgl'));
		$hsl ='sukses';
		foreach ($this->MMsHariLibur->get() as $val) {
			if($val['tanggal']==$tgl){
				$hsl = $val['keterangan'];
			}
		}
		$data['hasil'] = $hsl;
		echo json_encode($data);
	}

	// public function cariNama(){
	// 	$id_sdm = $this->input->post('id_sdm');
	// 	$idKegOrg = $this->input->post('idKegiatanOrangB');
	// 	$tglB = $this->help->ReverseTgl($this->input->post('tglB'));
		
	// 	$ql="select fk_kegiatan_orang_id,nama_kegiatan_orang,nama_bagian,nama_program,mk.kegiatan,t.bulan,ko.singkatan from t_entri_detail td 
	// 		join t_entri t on t.id=td.fk_entri_id
	// 		join ms_bagian mb on mb.id=t.fk_bagian_id
	// 		join ms_program mp on mp.id=t.fk_program_id
	// 		join ms_kegiatan_bappeda mk on mk.id=t.fk_kegiatan_id
	// 		join ms_kegiatan_orang ko on ko.id=td.fk_kegiatan_orang_id
	// 		where td.fk_sdm_id=$id_sdm AND td.tgl='$tglB'";
	// 	$cek = $this->db->query($ql)->result();

	// 	$hslCek='';
	// 	if(isset($cek)){
	// 		foreach ($cek as $val) {
	// 			// if($idKegOrg==1){ //DL
	// 			// 	$hslCek='Sudah ada kegiatan orang di Bagian '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', '.$val->singkatan.', Kegiatan '.$val->kegiatan;
	// 			// }
	// 			if($val->fk_kegiatan_orang_id==1){ //DL
	// 				$hslCek='Sudah ada kegiatan Perjalanan Dinas Luar Daerah '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Kegiatan '.$val->kegiatan;
	// 			}
	// 			if($idKegOrg!=4 && $val->fk_kegiatan_orang_id==2){ //DD boleh sama lembur
	// 				$hslCek='Sudah ada kegiatan Perjalanan Dinas Dalam Daerah '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Kegiatan '.$val->kegiatan;
	// 			}
	// 			if($idKegOrg!=3 && $idKegOrg!=4 && $val->fk_kegiatan_orang_id==3){ //rapat dan lembur boleh
	// 				$hslCek='Sudah ada kegiatan Rapat di '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Kegiatan '.$val->kegiatan;
	// 			}
	// 			if($idKegOrg!=3 && $val->fk_kegiatan_orang_id==4){ //Lembur dan rapat boleh
	// 				$hslCek='Sudah ada kegiatan Lembur di '.$val->nama_bagian.', '.$this->help->namaBulan($val->bulan).', Kegiatan '.$val->kegiatan;
	// 			}
	// 		}			
	// 	}

	// 	$nma = $this->MMsSdm->get(array('id'=>$id_sdm));
	// 	$kg = $this->MMsKegiatanOrang->get(array('id'=>$idKegOrg));

	// 	$data['hslCek'] = $hslCek;
	// 	$data['nama'] = $nma[0]['nama'];
	// 	$data['keg'] = $kg[0]['kegiatan'];
	// 	$data['fk_bagian_id'] = $nma[0]['fk_bagian_id'];
	// 	echo json_encode($data);
	// }

	public function cariNama(){
		$id_sdm = $this->input->post('id_sdm');
		$tglIndo =$this->input->post('tglB');
		$tgl = $this->help->ReverseTgl($tglIndo);
		$idKegOrg = $this->input->post('idKegiatanOrangB');

		$que = "SELECT p.id,kategori,nama_bagian,bulan,kegiatan_bappeda,tgl_sp_berangkat FROM t_pjd p INNER JOIN t_pjd_detail pd ON pd.fk_pjd_id=p.id WHERE pd.fk_sdm_id=$id_sdm AND (tgl_berangkat='$tgl' OR tgl_tiba='$tgl' OR tgl_tengah_1='$tgl' OR tgl_tengah_2='$tgl')";
		$cekDL= $this->db->query($que)->row();

		$hslCek=''; $ktgri=''; $hslCekRpt=''; $rptLbh3Kli='';
		if(isset($cekDL)){
			if($cekDL->kategori=='DL'){
				$bln = !empty($cekDL->bulan)?$this->help->namaBulan($cekDL->bulan):'';
				$hslCek='Sudah ada kegiatan Perjalanan Dinas '.$cekDL->kategori.' '.$cekDL->nama_bagian.', '.$bln.', Sub Kegiatan '.$cekDL->kegiatan_bappeda.', Jam Berangkat '.$cekDL->tgl_sp_berangkat.' (Error ID pjd_detail : '.$cekDL->id.')';
				$ktgri = 'DL';
			}
			if($cekDL->kategori=='DD'){	
				$bln = !empty($cekDL->bulan)?$this->help->namaBulan($cekDL->bulan):'';
				$hslCek='Sudah ada kegiatan Perjalanan Dinas '.$cekDL->kategori.' '.$cekDL->nama_bagian.', '.$bln.', Sub Kegiatan '.$cekDL->kegiatan_bappeda.' (Error ID pjd_detail : '.$cekDL->id.')';
				$ktgri = 'DD';
			}
		}else{
			$celLmbr = "SELECT td.id,spj_bulan,singkatan_bagian,kegiatan_bappeda FROM t_entri_lembur_detail td INNER JOIN t_entri_lembur t ON t.id=td.fk_entri_lembur_id WHERE fk_sdm_id=$id_sdm AND tgl='$tgl'";
			$cekLmbr= $this->db->query($celLmbr)->row();
			if(isset($cekLmbr)){
				$hslCek='Sudah ada kegiatan Lembur '.$cekLmbr->singkatan_bagian.', Bulan '.$this->help->namaBulan($cekLmbr->spj_bulan).', Sub Kegiatan '.$cekLmbr->kegiatan_bappeda.' (Error ID lembur_detail : '.$cekLmbr->id.')';
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

		$nma = $this->MMsSdm->get(array('id'=>$id_sdm));
		$data['nama'] = $nma[0]['nama'];

		$kg = $this->MMsKegiatanOrang->get(array('id'=>$idKegOrg));
		$data['keg'] = $kg[0]['kegiatan'];
			
		$data['kategori'] = $ktgri;
		$data['hslCek'] = $hslCek;

		$data['rptLbh3Kli'] = $rptLbh3Kli;
		$data['hslCekRpt'] = $hslCekRpt;
		$data['fk_bagian_id'] = $nma[0]['fk_bagian_id'];

		echo json_encode($data);

	}

	public function save(){		
		// $keg_orang = $this->input->post('kegiatan_orang');		

		$listSdmId = $this->input->post('listSdmId');
		if(!isset($listSdmId)){
			$this->session->set_flashdata('error', 'Detail Kegiatan Orang tidak boleh kosong.');
			redirect('Entri/create');
		}
		
		$data['nomor'] = $this->input->post('nomor');
		$data['catatan'] = $this->input->post('catatan');
		$data['tahun'] = $this->tahun;
		$data['bulan'] = $this->input->post('bulan');
		$data['nama_gu'] = $this->input->post('nama_gu');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');		
		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		$this->db->trans_start(); 

			$this->MEntri->insert($data);				
			$spjId = $this->db->insert_id();

			$namaSdm = $this->input->post('listNamaSdm');
			$KegiatanOrangID = $this->input->post('listKegiatanOrangID');
			$namaKegiatanOrang = $this->input->post('listNamaKegiatanOrang');
			$fkBagianCurrent = $this->input->post('listFkBagianCurrent');
			$tgl = $this->input->post('listTgl');
			
			foreach ($listSdmId as $key => $val) {

				$dataDetail[] = array(
							'fk_entri_id'=>$spjId,
							'fk_sdm_id'=>$val,
							'nama_sdm'=>$namaSdm[$key],
							'fk_kegiatan_orang_id'=>$KegiatanOrangID[$key],
							'nama_kegiatan_orang'=>$namaKegiatanOrang[$key],
							'fk_bagian_current'=>$fkBagianCurrent[$key],
							'tgl'=>$this->help->ReverseTgl($tgl[$key]),
						);
			}
			$this->db->insert_batch('t_entri_detail', $dataDetail);

		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		}
        redirect('Entri');
	}

	public function delete($id){   
		$this->db->trans_start();  
			$this->MEntri->deleteAllDetail($id);
			$result = $this->MEntri->delete($id);
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

        redirect('Entri');
	}

	public function detail($id){
		$que="	SELECT t.*,mb.nama_bagian,mp.nama_program,kb.kegiatan FROM t_entri t
				INNER JOIN ms_bagian mb ON mb.id=t.fk_bagian_id
				INNER JOIN ms_program mp ON mp.id=t.fk_program_id
				INNER JOIN ms_kegiatan_bappeda kb ON kb.id=t.fk_kegiatan_id
				WHERE t.id=$id
			";
		$data['entrySpj'] = $this->db->query($que)->row();
		
		$dtl = $this->MEntri->getDetail((array('fk_entri_id'=>$id)));
		$data['detail'] = $dtl;

		$this->template->load('Home/template','Entri/viewDetail',$data);
	}

	public function edit($id){
		$que="	SELECT t.*,mb.nama_bagian,mp.nama_program,kb.kegiatan FROM t_entri t
				INNER JOIN ms_bagian mb ON mb.id=t.fk_bagian_id
				INNER JOIN ms_program mp ON mp.id=t.fk_program_id
				INNER JOIN ms_kegiatan_bappeda kb ON kb.id=t.fk_kegiatan_id
				WHERE t.id=$id
			";
		$data['entrySpj'] = $this->db->query($que)->row();
		
		$dtl = $this->MEntri->getDetail((array('fk_entri_id'=>$id)));
		$data['detail'] = $dtl;

		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrMsSdm'] = $this->MMsSdm->get(array('status'=>1,'pegawai_bappeda'=>1));
		$data['arrMsKegOrg'] = $this->MMsKegiatanOrang->get();

		$this->template->load('Home/template','Entri/edit',$data);
	}

	public function deleteDetail($fkSpjId, $id){
		$result = $this->MEntri->deleteDetail($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data Detail gagal dihapus.');
        }
        redirect('Entri/edit/'.$fkSpjId);
	}

	public function update(){
		$spjId = $this->input->post('fk_entri_id');
		$listSdmId = $this->input->post('listSdmId');
		// if(!isset($listSdmId)){
		// 	redirect('Entri/create');
		// }

		$data['nomor'] = $this->input->post('nomor');
		$data['nama_gu'] = $this->input->post('nama_gu');
		$data['bulan'] = $this->input->post('bulan');
		$data['catatan'] = $this->input->post('catatan');
		$this->MEntri->update($spjId,$data);
		
		if($listSdmId){
			$namaSdm = $this->input->post('listNamaSdm');
			$KegiatanOrangID = $this->input->post('listKegiatanOrangID');
			$namaKegiatanOrang = $this->input->post('listNamaKegiatanOrang');
			$fkBagianCurrent = $this->input->post('listFkBagianCurrent');
			$tgl = $this->input->post('listTgl');
			
			foreach ($listSdmId as $key => $val) {

				$dataDetail[] = array(
							'fk_entri_id'=>$spjId,
							'fk_sdm_id'=>$val,
							'nama_sdm'=>$namaSdm[$key],
							'fk_kegiatan_orang_id'=>$KegiatanOrangID[$key],
							'nama_kegiatan_orang'=>$namaKegiatanOrang[$key],
							'fk_bagian_current'=>$fkBagianCurrent[$key],
							'tgl'=>$this->help->ReverseTgl($tgl[$key]),
						);
			}
			$this->db->insert_batch('t_entri_detail', $dataDetail);
		}

		$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
        redirect('Entri');
	}


 	public function getCariNomor(){
 		$kegiatan_orang=$_POST['kegiatan_orang'];
 		$fk_kegiatan_id=$_POST['fk_kegiatan_id'];
 		// $nama_gu=$_POST['nama_gu'];
 		$fk_bagian_id=$_POST['fk_bagian_id'];
 		$bulan=$_POST['bulan'];
 		$tahun=$this->tahun;

 		$kegOrg = $this->db->query("SELECT singkatan FROM ms_kegiatan_orang WHERE id=$kegiatan_orang ")->row();
 		$kegBpd = $this->db->query("SELECT singkatan FROM ms_kegiatan_bappeda WHERE id=$fk_kegiatan_id ")->row();
 		$Bagian = $this->db->query("SELECT singkatan_bagian FROM ms_bagian WHERE id=$fk_bagian_id ")->row();
 		
 		$nom = $kegOrg->singkatan.'/'.$Bagian->singkatan_bagian.'.'.$kegBpd->singkatan.'/'.$bulan.'/'.$tahun;

 		if($kegiatan_orang==3 || $kegiatan_orang==4){ //rapat/lembur
 			$qwu = "SELECT nomor 
					FROM t_entri t
					JOIN t_entri_detail td ON td.fk_entri_id=t.id
					WHERE tahun = '$tahun' AND bulan = '$bulan' AND fk_bagian_id = $fk_bagian_id AND fk_kegiatan_id = $fk_kegiatan_id AND fk_kegiatan_orang_id=$kegiatan_orang
					ORDER BY t.id DESC 
					LIMIT 1";
 			$cari = $this->db->query($qwu)->row(); 
 			$nom = '1';		 			
 			if(isset($cari)){
 				$ck = explode('/', $cari->nomor);
 				
 				if($kegiatan_orang==3){ //rapat
 					$no = substr($ck[0], 5);
 				}
 				if($kegiatan_orang==4){ //lembur
 					$no = substr($ck[0], 6);
 				}
 				$nom = $no+1;
 			}
 			$nom = $kegOrg->singkatan.$nom.'/'.$Bagian->singkatan_bagian.'.'.$kegBpd->singkatan.'/'.$bulan.'/'.$tahun;
 		}

 		// $data['nom']=$nom.'/'.$nama_gu;	 		
 		$data['nom']=$nom;	 		

 		echo json_encode($data);
 	}

}
