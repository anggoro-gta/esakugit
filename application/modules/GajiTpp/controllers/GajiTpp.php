<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GajiTpp extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->library('M_pdf');
		$this->load->model('MGajiTpp');
		$this->load->model('MMsBagian');
		$this->load->model('MMsProgram');
		$this->load->model('MMsKegiatan');
		$this->load->model('MMsRekeningBelanja');
		$this->load->model('MMsSdm');
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
		$this->template->load('Home/template','GajiTpp/list',$data);
	}


	public function getListDetail(){
		$data['buttonCreate'] = $this->input->post('buttonCreate');
		$data['bulan'] = $this->input->post('bulan');
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');
		$data['fk_program_id'] = $this->input->post('fk_program_id');
		$data['fk_kegiatan_id'] = $this->input->post('fk_kegiatan_id');
		$data['arrBulan'] = $this->help->namaBulan();
		$data['arrMsBagian'] = $this->arrBagian();

		$this->load->view('GajiTpp/listDetail',$data);
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
			$this->datatables->where("t_gaji_tpp.spj_bulan",$bulan);
		}
		// if($fk_bagian_id){
		// 	$this->datatables->where('t_gaji_tpp.fk_bagian_id',$fk_bagian_id);
		// }
		// if($fk_program_id){
		// 	$this->datatables->where('t_gaji_tpp.fk_program_id',$fk_program_id);
		// }
		// if($fk_kegiatan_id){
		// 	$this->datatables->where('t_gaji_tpp.fk_kegiatan_id',$fk_kegiatan_id);
		// }		

        $this->datatables->select('t_gaji_tpp.id,t_gaji_tpp.spj_bulan,nama_rekening');
         $this->datatables->select("FORMAT(pengajuan_sekarang,0) AS pengajuan_sekarang", FALSE);
        $this->datatables->from("t_gaji_tpp");
        // $this->datatables->join('t_rekap_dana','t_rekap_dana.id=t_gaji_tpp.fk_rekap_dana_id','left');
        // $this->datatables->join('ms_rekening_belanja','ms_rekening_belanja.id=t_rekap_dana.fk_rekening_belanja_id','left');
        $this->db->order_by("t_gaji_tpp.spj_bulan", "desc");
        echo $this->datatables->generate();
	}

	public function getCariRekeningBelanja(){
 		$fk_kegiatan_id=$this->input->post('fk_kegiatan_id');
 		$fk_rekening_belanja_id=$this->input->post('fk_rekening_belanja_id');
 		$fk_bagian_id=$this->input->post('fk_bagian_id');

 		$que = "SELECT rb.id,kode_rek_belanja,nama_rek_belanja FROM ms_rekening_belanja rb INNER JOIN ms_kegiatan kb ON kb.id=rb.fk_kegiatan_id WHERE kb.tahun=$this->tahun AND kb.fk_bagian_id=$fk_bagian_id AND rb.fk_kegiatan_id=$fk_kegiatan_id"; 	
 		$hasil = $this->db->query($que)->result_array();

 		$data['nama_rek'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hasil as $val) {
 			$selected = $val['id']==$fk_rekening_belanja_id?'selected':'';
 			$data['nama_rek'] .= "<option $selected value=\"".$val['id']."\">".$val['kode_rek_belanja'].' ['.$val['nama_rek_belanja'].']'."</option>\n";
 		}
 		echo json_encode($data);
 	}

	public function getCariRealisasiAnggaran(){
		$spj_bulan = $this->input->post('spj_bulan');
		$fk_rekening_belanja_id = $this->input->post('fk_rekening_belanja_id');

		$bulanMinSatu = (int)$spj_bulan-1;
		if(strlen($bulanMinSatu)==1){
			$bulanMinSatu = '0'.$bulanMinSatu;
		}

		if($fk_rekening_belanja_id){
			$que = "SELECT jml_dana,pengajuan_sekarang FROM t_rekap_dana
					WHERE spj_bulan='$bulanMinSatu' AND fk_rekening_belanja_id=$fk_rekening_belanja_id ORDER BY pengajuan_sekarang DESC";
			$hsl = $this->db->query($que)->row();
			$jmlDna=$hsl->jml_dana;

			if(!isset($hsl)){
				$cri = $this->db->query("SELECT anggaran,anggaran_pak FROM ms_rekening_belanja WHERE id=$fk_rekening_belanja_id")->row();
				$jmlDna=$cri->anggaran;
				if(!empty($cri->anggaran_pak)){
					$jmlDna=$cri->anggaran_pak;
				}
			}

			$sisaKas = $jmlDna-$hsl->pengajuan_sekarang;

			$data['jml_dana']=number_format($jmlDna);
			$data['pengajuan_sebelum']=number_format($hsl->pengajuan_sekarang);
			$data['sisa_kas']=number_format($sisaKas);
		
		}else{
			$data['jml_dana']='';
			$data['pengajuan_sebelum']='';
			$data['sisa_kas']='';
		}

		echo json_encode($data);
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'tahun' => set_value('tahun',$this->tahun),
			'spj_bulan' => set_value('spj_bulan'),
			'fk_rekap_dana_id' => set_value('fk_rekap_dana_id'),
			'fk_program_id' => set_value('fk_program_id'),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id'),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id'),
			'pengajuan_sekarang' => set_value('pengajuan_sekarang'),
			'jml_dana' => set_value('jml_dana'),
			'pengajuan_sebelum' => set_value('pengajuan_sebelum'),
			'sisa_kas' => set_value('sisa_kas'),
			'id' => set_value('id'),
		);

		$this->template->load('Home/template','GajiTpp/form',$data);
	}

	public function update($id){
		$hsl = $this->MGajiTpp->get(array('id'=>$id));
		$hsl = $hsl[0];

		$data = array(
			'button' => 'Update',
			'tahun' => set_value('tahun',$hsl['tahun']),
			'spj_bulan' => set_value('spj_bulan',$hsl['spj_bulan']),
			'fk_rekap_dana_id' => set_value('fk_rekap_dana_id',$hsl['fk_rekap_dana_id']),
			'fk_program_id' => set_value('fk_program_id',$hsl['fk_program_id']),
			'fk_kegiatan_id' => set_value('fk_kegiatan_id',$hsl['fk_kegiatan_id']),
			'fk_rekening_belanja_id' => set_value('fk_rekening_belanja_id',$hsl['fk_rekening_belanja_id']),
			'pengajuan_sekarang' => set_value('pengajuan_sekarang',$hsl['pengajuan_sekarang']),
			
			'id' => set_value('id',$id),
		);

		$rekapId = $hsl['fk_rekap_dana_id'];
		$que = "SELECT jml_dana,pengajuan_sebelum,sisa_kas FROM t_rekap_dana WHERE id='$rekapId' ";
		$hsl = $this->db->query($que)->row();
		$data['jml_dana']=$hsl->jml_dana;
		$data['pengajuan_sebelum']=$hsl->pengajuan_sebelum;
		$data['sisa_kas']=$hsl->sisa_kas;

		$this->template->load('Home/template','GajiTpp/form',$data);
	}

	public function save(){		
		$id = $this->input->post('id');
		$data['tahun'] = $this->input->post('tahun');
			$spj_bulan = $this->input->post('spj_bulan');
		$data['spj_bulan'] = $spj_bulan;

			$prgId=$this->input->post('fk_program_id');
		$data['fk_program_id'] = $prgId;
			$msPrg = $this->MMsProgram->get(array('id'=>$prgId));
		$data['nama_program'] = $msPrg[0]['nama_program'];

		$kegBppdId=$this->input->post('fk_kegiatan_id');
		$data['fk_kegiatan_id'] = $kegBppdId;
			$msKeg = $this->MMsKegiatan->get(array('id'=>$kegBppdId));
		$data['kegiatan'] = $msKeg[0]['kegiatan'];

		$rekBlnj=$this->input->post('fk_rekening_belanja_id');
		$data['fk_rekening_belanja_id'] = $rekBlnj;
			$msRek = $this->MMsRekeningBelanja->get(array('id'=>$rekBlnj));
		$data['nama_rekening'] = $msRek[0]['nama_rek_belanja'];

				$pengajuan_sekarang=str_replace(',', '', $this->input->post('pengajuan_sekarang'));
		$data['pengajuan_sekarang'] = $pengajuan_sekarang;

			$user_act = $this->session->id;
			$time_act = date('Y-m-d H:i:s');
		$data['user_act'] = $user_act;
		$data['time_act'] = $time_act;

				$jml_dana=str_replace(',', '', $this->input->post('jml_dana'));
				$pengajuan_sebelum=str_replace(',', '', $this->input->post('pengajuan_sebelum'));
				$sisa_kas=str_replace(',', '', $this->input->post('sisa_kas'));

		if(empty($id)){
			$this->db->trans_start(); 

				$que = "insert into t_rekap_dana (dari_tabel,spj_bulan,status_pencairan,fk_bagian_id,fk_kegiatan_id,fk_rekening_belanja_id,info_no_bku,jml_dana,pengajuan_sebelum,pengajuan_sekarang,sisa_kas,user_act,time_act)
					values('t_gaji_tpp','$spj_bulan',1,1,$kegBppdId,$rekBlnj,'9999',$jml_dana,$pengajuan_sebelum,$pengajuan_sekarang,$sisa_kas,$user_act,'$time_act')";
				$this->db->query($que);
				$data['fk_rekap_dana_id'] =$this->db->insert_id();
				
				$this->MGajiTpp->insert($data);

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
			$fkRekapDanaId = $this->input->post('fk_rekap_dana_id');

			$this->db->trans_start(); 
			
				$dataRekapDana = array(
				        'jml_dana' => $jml_dana,
				        'pengajuan_sebelum' => $pengajuan_sebelum,
				        'pengajuan_sekarang' => $pengajuan_sekarang,
				        'sisa_kas' => $sisa_kas
				);

				$this->db->where('id', $fkRekapDanaId);
				$this->db->update('t_rekap_dana', $dataRekapDana);

				$this->MGajiTpp->update($id,$data);	

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

        redirect('GajiTpp');
	}

	public function delete($id){   
		$hsl = $this->MGajiTpp->get(array('id'=>$id));
		$rekapId = $hsl[0]['fk_rekap_dana_id'];

        $cek = $this->db->query("DELETE FROM t_rekap_dana WHERE id=$rekapId");        

		$result = $this->MGajiTpp->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data gagal dihapus.');
        }

        redirect('GajiTpp/'.$link);
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

}
