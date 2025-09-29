<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsBarang extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MMsBarang');
		$this->load->model('MMsKategoriBarang');
		$this->tahun = $this->session->userdata("tahun");
	}

	public function index(){
		$this->template->load('Home/template','MsBarang/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        $this->datatables->where("masa_thn_awal <=",$this->tahun);
        $this->datatables->where("masa_thn_akhir >=",$this->tahun);

        $this->datatables->select('id,masa_thn_awal,masa_thn_akhir,kode_barang,nama_barang,merk,spesifikasi,satuan,std_harga_satuan,nama_kategori,terima_pesanan,stok_global');
        $this->db->order_by('kode_barang','asc');
        $this->datatables->from("v_pb_ms_barang");
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('MsBarang/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('MsBarang/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'masa_thn_awal' => set_value('masa_thn_awal'),
			'masa_thn_akhir' => set_value('masa_thn_akhir'),
			'kode_barang' => set_value('kode_barang'),
			'fk_kategori_barang_id' => set_value('fk_kategori_barang_id'),
			'nama_barang' => set_value('nama_barang'),
			'merk' => set_value('merk'),
			'spesifikasi' => set_value('spesifikasi'),
			'satuan' => set_value('satuan'),
			'std_harga_satuan' => set_value('std_harga_satuan'),
			'id' => set_value('id'),
		);

		$data['arrKategoriBarang'] = $this->MMsKategoriBarang->get(array('status'=>1));
		$this->template->load('Home/template','MsBarang/form',$data);
	}

	public function update($id){
		$kat = $this->MMsBarang->get(array('id'=>$id));
		$kat = $kat[0];

		$data = array(
			'button' => 'Update',
			'masa_thn_awal' => set_value('masa_thn_awal',$kat['masa_thn_awal']),
			'masa_thn_akhir' => set_value('masa_thn_akhir',$kat['masa_thn_akhir']),
			'kode_barang' => set_value('kode_barang',$kat['kode_barang']),
			'fk_kategori_barang_id' => set_value('fk_kategori_barang_id',$kat['fk_kategori_barang_id']),
			'nama_barang' => set_value('nama_barang',$kat['nama_barang']),
			'merk' => set_value('merk',$kat['merk']),
			'spesifikasi' => set_value('spesifikasi',$kat['spesifikasi']),
			'satuan' => set_value('satuan',$kat['satuan']),
			'std_harga_satuan' => set_value('std_harga_satuan',$kat['std_harga_satuan']),
			'id' => set_value('id',$kat['id']),
		);

		$data['arrKategoriBarang'] = $this->MMsKategoriBarang->get();
		$this->template->load('Home/template','MsBarang/form',$data);
	}

	public function save(){
		$id = $this->input->post('id');
		$data['masa_thn_awal'] = $this->input->post('masa_thn_awal');
		$data['masa_thn_akhir'] = $this->input->post('masa_thn_akhir');
		$data['kode_barang'] = $this->input->post('kode_barang');
		$data['fk_kategori_barang_id'] = $this->input->post('fk_kategori_barang_id');
		$data['nama_barang'] = $this->input->post('nama_barang');
		$data['merk'] = $this->input->post('merk');
		$data['spesifikasi'] = $this->input->post('spesifikasi');
		$data['satuan'] = $this->input->post('satuan');
		$data['std_harga_satuan'] = str_replace(',', '', $this->input->post('std_harga_satuan'));
		$data['user_act'] = $this->session->id;
		$data['time_act'] = date('Y-m-d H:i:s');

		if(empty($id)){
			$data['user_init'] = $this->session->id;
			$data['time_init'] = date('Y-m-d H:i:s');
			$this->MMsBarang->insert($data);
			$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
		
		}else{
			$this->MMsBarang->update($id,$data);
			$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
		}
		
        redirect('MsBarang');
	}

	public function delete($id){       
        $result = $this->MMsBarang->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('MsBarang');
	}
}
