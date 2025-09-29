<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsSdm extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsSdm');
		$this->load->model('MMsBagian');
		$this->load->model('MMsJabatan');
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
		$this->template->load('Home/template','MsSdm/list',$data);
	}

	public function getListDetail(){
		$data['fk_bagian_id'] = $this->input->post('fk_bagian_id');

		$this->load->view('MsSdm/listDetail',$data);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
		$fk_bagian_id = $this->input->post('fk_bagian_id');        

        if($fk_bagian_id){
			$this->datatables->where('ms_sdm.fk_bagian_id',$fk_bagian_id);
		}
        $this->datatables->select('ms_sdm.id,nama,nip,gol_pangkat,jabatan,nama_bagian,pejabat_kpa,pejabat_ppk,bendahara,bendahara_pembantu,pphp,status_pegawai,gol_pangkat_baru,jabatan_baru,status_jabatan,status_jabatan_baru,no_rekening,nama_rekening,npwp,nama_bank');
        $this->datatables->select("(CASE WHEN ms_sdm.status=1 THEN 'Aktif' ELSE 'Tidak Aktif' END) AS nama_status");
        $this->datatables->select("DATE_FORMAT(tmt_gol_pangkat_baru, '%d/%m/%Y') AS tmt_gol_pangkat_baru", FALSE);
        $this->datatables->from("ms_sdm");
        $this->datatables->join('ms_bagian', "ms_bagian.id = ms_sdm.fk_bagian_id", 'left');
        $this->datatables->join('ms_jabatan', "ms_jabatan.id = ms_sdm.fk_jabatan_id", 'left');
        $this->db->order_by('pegawai_setda,status','desc');
        $this->db->order_by('eselon,nama_bagian,nama_jabatan,gol_pangkat,nip','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsSdm/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsSdm/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$Bagian=null;
		if($this->level!='1'){
			$Bagian=$this->fkBagianId;
		}
		$data = array(
			'button' => 'Simpan',
			'fk_bagian_id' => set_value('fk_bagian_id',$Bagian),
			'nama' => set_value('nama'),
			'nip' => set_value('nip'),
			'gol_pangkat' => set_value('gol_pangkat'),
			'fk_jabatan_id' => set_value('fk_jabatan_id'),
			'status_jabatan' => set_value('status_jabatan'),
			'status_jabatan_baru' => set_value('status_jabatan_baru'),
			'gol_pangkat_baru' => set_value('gol_pangkat_baru'),
			'tmt_gol_pangkat_baru' => set_value('tmt_gol_pangkat_baru'),
			'fk_bagian_id_baru' => set_value('fk_bagian_id_baru'),
			'fk_jabatan_id_baru' => set_value('fk_jabatan_id_baru'),
			'jabatan_baru' => set_value('jabatan_baru'),
			'tmt_jabatan_baru' => set_value('tmt_jabatan_baru'),
			'status_pegawai' => set_value('status_pegawai'),
			'status' => set_value('status'),
			'pejabat_kpa' => set_value('pejabat_kpa'),
			'pejabat_ppk' => set_value('pejabat_ppk'),
			'pejabat_pptk' => set_value('pejabat_pptk'),
			'bendahara_bappeda' => set_value('bendahara_bappeda'),
			'bendahara_pembantu' => set_value('bendahara_pembantu'),
			'pphp' => set_value('pphp'),
			'pegawai_setda' => set_value('pegawai_setda'),
			'jabatan_kegiatan' => set_value('jabatan_kegiatan'),
			'nama_bank' => set_value('nama_bank'),
			'no_rekening' => set_value('no_rekening'),
			'nama_rekening' => set_value('nama_rekening'),
			'npwp' => set_value('npwp'),
			'id' => set_value('id'),
		);
		$data['arrMsBagianBaru'] = $this->MMsBagian->get();
		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrPngktGol'] = $this->db->query("SELECT * FROM ms_pangkat_golongan")->result();
		$this->template->load('Home/template','MsSdm/form',$data);
	}

	public function update($id){
		$kat = $this->MMsSdm->get(array('id'=>$id));
		$kat = $kat[0];

		$fkBagian=$kat['fk_bagian_id'];
		if($this->level != 1){
			if($fkBagian!=$this->fkBagianId){
				show_404();
			}
		}

		$data = array(
			'button' => 'Update',
			'fk_bagian_id' => set_value('fk_bagian_id',$kat['fk_bagian_id']),
			'nama' => set_value('nama',$kat['nama']),
			'nip' => set_value('nip',$kat['nip']),
			'gol_pangkat' => set_value('gol_pangkat',$kat['gol_pangkat']),
			'fk_jabatan_id' => set_value('fk_jabatan_id',$kat['fk_jabatan_id']),
			'status_jabatan' => set_value('status_jabatan',$kat['status_jabatan']),
			'status_jabatan_baru' => set_value('status_jabatan_baru',$kat['status_jabatan_baru']),
			'gol_pangkat_baru' => set_value('gol_pangkat_baru',$kat['gol_pangkat_baru']),
			'tmt_gol_pangkat_baru' => set_value('tmt_gol_pangkat_baru',$this->help->ReverseTgl($kat['tmt_gol_pangkat_baru'])),
			'status_pegawai' => set_value('status_pegawai',$kat['status_pegawai']),
			'status' => set_value('status',$kat['status']),
			'pejabat_kpa' => set_value('pejabat_kpa',$kat['pejabat_kpa']),
			'pejabat_ppk' => set_value('pejabat_ppk',$kat['pejabat_ppk']),
			'pejabat_pptk' => set_value('pejabat_pptk',$kat['pejabat_pptk']),
			'bendahara_bappeda' => set_value('bendahara_bappeda',$kat['bendahara']),
			'bendahara_pembantu' => set_value('bendahara_pembantu',$kat['bendahara_pembantu']),
			'pphp' => set_value('pphp',$kat['pphp']),
			'pegawai_setda' => set_value('pegawai_setda',$kat['pegawai_setda']),
			'jabatan_kegiatan' => set_value('jabatan_kegiatan',$kat['jabatan_kegiatan']),
			'fk_bagian_id_baru' => set_value('fk_bagian_id_baru',$kat['fk_bagian_id_baru']),
			'fk_jabatan_id_baru' => set_value('fk_jabatan_id_baru',$kat['fk_jabatan_id_baru']),
			'tmt_jabatan_baru' => set_value('tmt_jabatan_baru',$this->help->ReverseTgl($kat['tmt_jabatan_baru'])),
			'nama_bank' => set_value('nama_bank',$kat['nama_bank']),
			'no_rekening' => set_value('no_rekening',$kat['no_rekening']),
			'nama_rekening' => set_value('nama_rekening',$kat['nama_rekening']),
			'npwp' => set_value('npwp',$kat['npwp']),
			'id' => set_value('id',$kat['id']),
		);
		$data['arrMsBagianBaru'] = $this->MMsBagian->get();
		$data['arrMsBagian'] = $this->arrBagian();
		$data['arrPngktGol'] = $this->db->query("SELECT * FROM ms_pangkat_golongan")->result();
		$this->template->load('Home/template','MsSdm/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');		
		$nip = $this->input->post('nip');

		$fkBagian=$this->input->post('fk_bagian_id');
		if(empty($fkBagian)){
			$fkBagian=null;
		}
		$data['nip'] = $nip;
		$data['fk_bagian_id'] = $fkBagian;
		$data['nama'] = $this->input->post('nama');
		$data['status_jabatan'] = $this->input->post('status_jabatan');
		$data['status_jabatan_baru'] = $this->input->post('status_jabatan_baru');
		$data['gol_pangkat'] = $this->input->post('gol_pangkat');
		$data['jabatan_kegiatan'] = $this->input->post('jabatan_kegiatan');
		$data['nama_bank'] = $this->input->post('nama_bank');
		$data['no_rekening'] = $this->input->post('no_rekening');
		$data['nama_rekening'] = $this->input->post('nama_rekening');
		$data['npwp'] = $this->input->post('npwp');
			$jbtn = $this->input->post('fk_jabatan_id');
		if($jbtn){
			$jab = explode('_', $jbtn);
			$data['fk_jabatan_id'] = $jab[0];
			$data['jabatan'] = $jab[1];
		}

		$data['gol_pangkat_baru'] = $this->input->post('gol_pangkat_baru');
		$tmtGolBaru=$this->input->post('tmt_gol_pangkat_baru');
		if($tmtGolBaru){
			$tmtGolBaru=$this->help->ReverseTgl($tmtGolBaru);
		}else{
			$tmtGolBaru=null;
		}
		$data['tmt_gol_pangkat_baru'] = $tmtGolBaru;

		$data['status_pegawai'] = $this->input->post('status_pegawai');
		$data['status'] = $this->input->post('status');

		$data['fk_bagian_id_baru'] = $this->input->post('fk_bagian_id_baru');
		$jabBaru = explode('_', $this->input->post('fk_jabatan_id_baru'));
		$data['fk_jabatan_id_baru'] = $jabBaru[0];
		$data['jabatan_baru'] = $jabBaru[1];

		$tmtJabBaru=$this->input->post('tmt_jabatan_baru');
		if($tmtJabBaru){
			$tmtJabBaru=$this->help->ReverseTgl($tmtJabBaru);
		}else{
			$tmtJabBaru=null;
		}
		$data['tmt_jabatan_baru'] = $tmtJabBaru;

		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		$pejabat_kpa = $this->input->post('pejabat_kpa');
		if($pejabat_kpa){
			$kpa = 1;
		}else{
			$kpa = 0;
		}
		$data['pejabat_kpa'] = $kpa;

		$pejabat_ppk = $this->input->post('pejabat_ppk');
		if($pejabat_ppk){
			$ppk = 1;
		}else{
			$ppk = 0;
		}
		$data['pejabat_ppk'] = $ppk;

		$pejabat_pptk = $this->input->post('pejabat_pptk');
		if($pejabat_pptk){
			$pptk = 1;
		}else{
			$pptk = 0;
		}
		$data['pejabat_pptk'] = $pptk;

		$bendahara_bappeda = $this->input->post('bendahara_bappeda');
		if($bendahara_bappeda){
			$bndBppd = 1;
		}else{
			$bndBppd = 0;
		}
		$data['bendahara'] = $bndBppd;

		$bendahara_pembantu = $this->input->post('bendahara_pembantu');
		if($bendahara_pembantu){
			$pmb = 1;
		}else{
			$pmb = 0;
		}
		$data['bendahara_pembantu'] = $pmb;

		$pphp = $this->input->post('pphp');
		if($pphp){
			$pphp2 = 1;
		}else{
			$pphp2 = 0;
		}
		$data['pphp'] = $pphp2;

		$pegawai_setda = $this->input->post('pegawai_setda');
		if($pegawai_setda){
			$pegawai_setda2 = 1;
		}else{
			$pegawai_setda2 = 0;
		}
		$data['pegawai_setda'] = $pegawai_setda2;

		if(empty($id)){
			if(strlen($nip) > 10){
				$cek = $this->MMsSdm->get(array('nip'=>$nip));
				if(isset($cek)){
					$this->session->set_flashdata('warning', 'Data Sudah Ada Di Sistem.');
					redirect('MsSdm');
				}
			}

			$this->MMsSdm->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsSdm->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsSdm');
	}

	public function delete($id){       
        $result = $this->MMsSdm->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsSdm');
	}

	public function getJabatan(){
 		$fk_bagian_id=$_POST['fk_bagian_id'];
 		$fk_jabatan_id=$_POST['fk_jabatan_id'];
 		$bag=null;
 		if($fk_bagian_id){
 			$bag=$fk_bagian_id;
 		}
 		$hsl = $this->MMsJabatan->get(array('fk_bagian_id'=>$bag));

 		$data['arrJabatan'] = "<option value=''>Pilih</option>\n";
 		foreach ((array)$hsl as $val) {
 			$selected = $val['id']==$fk_jabatan_id?'selected':'';
 			$data['arrJabatan'] .= "<option $selected value=\"".$val['id'].'_'.$val['nama_jabatan']."\">".$val['nama_jabatan']."</option>\n";
 		}
 		echo json_encode($data);
 	}
}
