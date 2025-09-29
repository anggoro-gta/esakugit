<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EntriSpj extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MEntriGu');
		$this->load->model('MMsBagian');
		$this->load->model('MMsKegiatan');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$this->template->load('Home/template','EntriSpj/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');

        $this->datatables->select('t_entri_gu.id,t_entri_gu.nama,status_spj,count(t_entri_gu_detail.id) jml_kegiatan');
        $this->datatables->from("t_entri_gu");
        $this->datatables->join('t_entri_gu_detail','t_entri_gu_detail.fk_entri_gu_id=t_entri_gu.id','inner');
        $this->datatables->where('t_entri_gu.tahun',$this->tahun);
        $this->datatables->group_by('fk_entri_gu_id');

        echo $this->datatables->generate();
	}

	public function getKegiatan(){
 		$Bagian=$_POST['Bagian'];
 		$keg = $this->MMsKegiatan->get(array('fk_bagian_id'=>$Bagian,'tahun'=>$this->tahun));

 		$data['kegiatan'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$keg as $val) {
 			$data['kegiatan'] .= "<option value=\"".$val['id']."\">".$val['kegiatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}

	public function proses($id){
		$gu= $this->MEntriGu->get(array('id'=>$id));
		$data['entriGu'] = $gu[0];
		
		$dtl = $this->MEntriGu->getDetail((array('fk_entri_gu_id'=>$id)));
		$data['detail'] = $dtl;
		$data['status'] = $this->db->query("SELECT id,keterangan FROM status_warna_spj ")->result();

		$this->template->load('Home/template','EntriSpj/viewDetail',$data);
	}

	public function save(){			
		$id = $this->input->post('id');
		$idDetail = $this->input->post('idDetail');
		$status_spj_detail = $this->input->post('status_spj_detail');
		// die(var_dump($this->input->post()));
		
		$data['status_spj'] = 1;	
		$data['user_spj'] = $this->session->id;
		$data['time_spj'] = date('Y-m-d H:i:s');

		$this->db->trans_start(); 

			$this->MEntriGu->update($id,$data);			
			
			foreach ($idDetail as $key => $val) {
				$stt = $status_spj_detail[$key]==''?null:$status_spj_detail[$key];
				$dataDetail[] = array(
							'id'=>$val,
							'status_spj_detail'=>$stt,
						);
			}
			$this->db->update_batch('t_entri_gu_detail', $dataDetail,'id');

		$this->db->trans_complete();			
		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Data Gagal disimpan.');
		} 
		else {
		    $this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		}
        redirect('EntriSpj');
	}

	public function detail($id){
		$gu= $this->MEntriGu->get(array('id'=>$id));
		$data['entriGu'] = $gu[0];
		
		$que = "select t.*,sw.warna,sw.keterangan from t_entri_gu_detail t inner join status_warna_spj sw on sw.id=t.status_spj_detail where fk_entri_gu_id='$id' order by fk_bagian_id asc "; 
		$data['detail'] = $this->db->query($que)->result_array();

		$this->template->load('Home/template','EntriSpj/view',$data);
	}

}
