<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('MUser');
		$this->load->model('MMsBagian');
	}

	public function index(){
		$this->template->load('Home/template','Users/list',false);
	}

	public function getDatatables(){
		header('Content-Type: application/json');
        
        $this->datatables->select('users.id,username,nama_lengkap,level,nama_bagian,blokir,last_login,nama_level');
        $this->datatables->from("users");
        $this->datatables->join('ms_bagian', "ms_bagian.id = users.fk_bagian_id", 'left');
        $this->datatables->join('ms_level', "ms_level.id = users.level", 'inner');
        $this->db->order_by("fk_bagian_id", "asc");
        // $this->datatables->where('for_user=1 or for_user is null');
        $this->datatables->add_column('action', '<div class="btn-group">'.anchor(site_url('Users/update/$1'),'<i title="edit" class="glyphicon glyphicon-edit icon-white"></i>','class="btn btn-xs btn-success"').anchor(site_url('Users/delete/$1'),'<i title="hapus" class="glyphicon glyphicon-trash icon-white"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Apakah anda yakin?\')"').'</div>', 'id');

        echo $this->datatables->generate();
	}

	public function create(){
		$data = array(
			'button' => 'Simpan',
			'username' => set_value('username'),
			'password' => set_value('password'),
			'nama_lengkap' => set_value('nama_lengkap'),
			'level' => set_value('level'),
			'fk_bagian_id' => set_value('fk_bagian_id'),
			'blokir' => set_value('blokir'),
			'id' => set_value('id'),
		);

		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrMsLevel'] = $this->db->query("select * from ms_level")->result_array();
		$this->template->load('Home/template','Users/form',$data);
	}

	public function update($id){
		$usr = $this->MUser->get(array('id'=>$id));
		$usr = $usr[0];

		$data = array(
			'button' => 'Update',
			'username' => set_value('username',$usr['username']),
			'nama_lengkap' => set_value('nama_lengkap',$usr['nama_lengkap']),
			'level' => set_value('level',$usr['level']),
			'fk_bagian_id' => set_value('fk_bagian_id',$usr['fk_bagian_id']),
			'blokir' => set_value('blokir',$usr['blokir']),
			'id' => set_value('id',$usr['id']),
		);

		$data['arrMsBagian'] = $this->MMsBagian->get();
		$data['arrMsLevel'] = $this->db->query("select * from ms_level")->result_array();
		$this->template->load('Home/template','Users/form',$data);
	}

	public function save(){
		if($this->session->level==1){
			$id = $this->input->post('id');
			$data['username'] = $this->input->post('username');
			$data['nama_lengkap'] = $this->input->post('nama_lengkap');
			$data['level'] = $this->input->post('level');
			$bag = $this->input->post('fk_bagian_id');
			if($bag){
				$data['fk_bagian_id'] = $bag;
			}
			$data['blokir'] = $this->input->post('blokir');
			$data['user_act'] = $this->session->id;
			$data['time_act'] = date('Y-m-d H:i:s');	
			if($this->session->level!=1){
				$data['for_user'] = '1';	
			}

			if(empty($id)){
				$data['password'] = md5($this->input->post('password'));
				$this->MUser->insert($data);
				$this->session->set_flashdata('success', 'Data Berhasil disimpan.');
			
			}else{
				$reset_password = $this->input->post('reset_password');
				if($reset_password){
					$data['password'] = md5('123456');
				}
				$this->MUser->update($id,$data);
				$this->session->set_flashdata('success', 'Data Berhasil diupdate.');
			}
		}else{
			$this->session->set_flashdata('error', 'Anda tidak mempunyai hak untuk proses update.');
		}
		
        redirect('Users');
	}

	public function delete($id){   
        $result = $this->MUser->delete($id);
		if($result){
        	$this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }else{
        	$this->session->set_flashdata('error', 'Data hanya bisa diupdate');
        }

        redirect('Users');
	}

	public function ubahPswd(){
		$data = array(
			'pswdLama' => set_value('pswdLama'),
			'pswdBaru' => set_value('pswdBaru'),
			'ulangiPswdBaru' => set_value('ulangiPswdBaru'),
		);
		if(isset($_POST['pswdBaru'])){
			$pswdLama = $this->input->post('pswdLama');
			$pswdBaru = $this->input->post('pswdBaru');
			$ulangiPswdBaru = $this->input->post('ulangiPswdBaru');
			
			if(md5($pswdLama) != $this->session->password){
				$this->session->set_flashdata('error', 'Password Lama tidak sesuai.');
				$error = true;
			}else if($pswdBaru != $ulangiPswdBaru){
				$this->session->set_flashdata('error', 'Ulangi Password Baru harus sama dengan Password baru.');
				$error = true;
			}else{
				$dataUpdate['password'] = md5($pswdBaru);
				$dataUpdate['user_act'] = $this->session->id;
				$dataUpdate['time_act'] = date('Y-m-d H:i:s');
				$this->MUser->update($this->session->id,$dataUpdate);
				$error = false;
				$this->session->set_flashdata('success', 'Password Berhasil diubah, silahkan logout dan login kembali dengan password yg baru.');
			}

			if($error){
				$data = array(
					'pswdLama' => set_value('pswdLama',$pswdLama),
					'pswdBaru' => set_value('pswdBaru',$pswdBaru),
					'ulangiPswdBaru' => set_value('ulangiPswdBaru',$ulangiPswdBaru),
				);
			}else{
				$data['pswdLama']='';
				$data['pswdBaru']='';
				$data['ulangiPswdBaru']='';
			}
		}

		$this->template->load('Home/template','Users/formUbahPswd',$data);
	}
}
