<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsTarifLembur extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsTarifLembur');
	}

	public function index(){
		$this->template->load('Home/template','MsTarifLembur/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('id,kategori,golongan,pot_pph');
        $this->datatables->select('format(tarif,0)tarif');
        $this->datatables->select('format(uang_makan,0)uang_makan');
        $this->datatables->from("ms_tarif_lembur t");
        $this->db->order_by('id','asc');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsTarifLembur/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsTarifLembur/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'kategori' => set_value('kategori'),
			'golongan' => set_value('golongan'),
			'tarif' => set_value('tarif'),
			'uang_makan' => set_value('uang_makan'),
			'pot_pph' => set_value('pot_pph'),
			'id' => set_value('id'),
		);
			
		$this->template->load('Home/template','MsTarifLembur/form',$data);
	}

	public function update($id){
		$hsl = $this->MMsTarifLembur->get(array('id'=>$id));
		$hsl = $hsl[0];

		$data = array(
			'button' => 'Update',
			'kategori' => set_value('kategori',$hsl['kategori']),
			'golongan' => set_value('golongan',$hsl['golongan']),
			'tarif' => set_value('tarif',$hsl['tarif']),
			'uang_makan' => set_value('uang_makan',$hsl['uang_makan']),
			'pot_pph' => set_value('pot_pph',$hsl['pot_pph']),
			'id' => set_value('id',$hsl['id']),
		);

		$this->template->load('Home/template','MsTarifLembur/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');	
		$data['kategori'] = $this->input->post('kategori');
		$data['golongan'] = $this->input->post('golongan');
		$data['tarif'] = str_replace(',', '', $this->input->post('tarif'));
		$data['uang_makan'] = str_replace(',', '', $this->input->post('uang_makan'));
		$data['pot_pph'] = $this->input->post('pot_pph');

		if(empty($id)){
			$this->MMsTarifLembur->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsTarifLembur->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsTarifLembur');
	}

	public function delete($id){       
        $result = $this->MMsTarifLembur->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsTarifLembur');
	}

	public function golTarif(){
 		$golongan=$_POST['golongan'];
 		$kategori=$_POST['kategori'];

 		$data['hsl'] = "<option value=''>Pilih</option>\n";
 		if($kategori=='PNS'){
 				$selcIV = $golongan=='IV'?'selected':'';
 			$data['hsl'] .= "<option $selcIV value='IV'>IV</option>\n";
 				$selcIII = $golongan=='III'?'selected':'';
 			$data['hsl'] .= "<option $selcIII value='III'>III</option>\n";
 				$selcII = $golongan=='II'?'selected':'';
 			$data['hsl'] .= "<option $selcII value='II'>II</option>\n";
 				$selcI = $golongan=='I'?'selected':'';
 			$data['hsl'] .= "<option $selcI value='I'>I</option>\n";
 		}else if($kategori=='PPPK'){
 				$selcIX = $golongan=='IX'?'selected':'';
 			$data['hsl'] .= "<option $selcIX value='IX'>IX</option>\n";
 				$selcVII = $golongan=='VII'?'selected':'';
 			$data['hsl'] .= "<option $selcVII value='VII'>VII</option>\n";
 				$selcV = $golongan=='V'?'selected':'';
 			$data['hsl'] .= "<option $selcV value='V'>V</option>\n";
 				$selcI = $golongan=='I'?'selected':'';
 			$data['hsl'] .= "<option $selcI value='I'>I</option>\n";
 		}else{
 				$selcN = $golongan=='NON ASN'?'selected':'';
 			$data['hsl'] .= "<option $selcN value='NON ASN'>NON ASN</option>\n";
 		}

 		echo json_encode($data);
 	}

}
