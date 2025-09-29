<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();

	}

	public function index(){
		$data['aa'] = array();
		$this->load->view('login2',$data);
	}

	public function prosesLogin(){
		$user = str_replace("'", "", htmlspecialchars($this->input->post('username'), ENT_QUOTES));
		$pass = str_replace("'", "", htmlspecialchars(md5($this->input->post('password')), ENT_QUOTES));
		$tahun = $this->input->post('tahun');

		$this->db->select('*')->from('users')->where(array('blokir'=>'N', 'username'=>$user,'password'=>$pass));
		$hasil = $this->db->get()->row();
		if(isset($hasil)){
			$andWhere='';
			// if($hasil->level!=1){
			// 	$andWhere=" and for_user=1"; //user verifikasi
			// }
			$que = "select * from users where blokir='N' and username='$user' and password='$pass' $andWhere ";
			$hasil2 = $this->db->query($que)->row();
			if(isset($hasil2)){
				$datetime = date('Y-m-d H:i:s');
				$this->db->query("update users set last_login='$datetime' where id=".$hasil2->id);
				$this->db->query("insert users_history(fk_users_id,ipaddress,time_act) values(".$hasil2->id.",'".$this->input->ip_address()."','".$datetime."') ");

				$data['id'] = $hasil2->id;
				$data['username'] = $hasil2->username;
				$data['password'] = $hasil2->password;
				$data['nama_lengkap'] = $hasil2->nama_lengkap;
				$data['level'] = $hasil2->level;
				$data['fk_bagian_id'] = $hasil2->fk_bagian_id;
				$data['for_user'] = $hasil2->for_user;
				$data['tahun'] = $tahun;

				$this->session->set_userdata($data);

				redirect('Home');
			}else{
				$this->session->set_flashdata('error', 'username atau password anda salah.');
	            redirect('Auth');
	        }
		}else{
			$this->session->set_flashdata('error', 'username atau password anda salah.');
            redirect('Auth');
		}
	}

	function logout(){
        $this->session->sess_destroy();
        redirect('Auth');
        // $url = 'http://'.$_SERVER['HTTP_HOST'].'/opd';
        header("Location: $url");
    }
}
