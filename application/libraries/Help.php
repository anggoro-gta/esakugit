<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help {
	public function __construct(){
      $this->ci =& get_instance();
    }

	public function labelnya(){
		return 'Isian dengan tanda (<span style="color:red">*</span>) tidak boleh kosong';
	}

	public function MoneyToDouble($num) {
        if (substr($num, 0, 1) == '(') {
            $num = '-'.preg_replace('/[\(\)]/', '', $num);
        }

        return $num = (double) str_replace(',', '', $num);
    }

    public function ReverseTgl($tgl) {
        $tgl = explode('-', $tgl);
        if (count($tgl) != 3)
            return $tgl[0];
        $tmp = '';
        for ($i = count($tgl) - 1; $i >= 0; $i--) {
            $tmp .= $tgl[$i] . '-';
        }
        $tmp = substr($tmp, 0, strlen($tmp) - 1);
        $tgl = $tmp;
        //$tgl[2] . '-' . $tgl[1] . '-' . $tgl[0];
        return $tgl;
    }

    public function namaBulan($x=null) { 
        $bulan = array(
                    '01'=>'Januari',
                    '02'=>'Februari',
                    '03'=>'Maret',
                    '04'=>'April',
                    '05'=>'Mei',
                    '06'=>'Juni',
                    '07'=>'Juli',
                    '08'=>'Agustus',
                    '09'=>'September',
                    '10'=>'Oktober',
                    '11'=>'November',
                    '12'=>'Desember'
                );
        if($x){
            return $bulan[$x];
        }
        
        return $bulan;
    }

    public function singkatanBulan($x=null) { 
        $bulan = array(
                    '01'=>'Jan',
                    '02'=>'Feb',
                    '03'=>'Mar',
                    '04'=>'Apr',
                    '05'=>'Mei',
                    '06'=>'Juni',
                    '07'=>'Juli',
                    '08'=>'Agst',
                    '09'=>'Sep',
                    '10'=>'Okt',
                    '11'=>'Nov',
                    '12'=>'Des'
                );
        if($x){
            return $bulan[$x];
        }
        
        return $bulan;
    }

    public function namaHari($tgl) { 
        $tbt = explode('-', $tgl);
        $info=date('w', mktime(0,0,0,$tbt[1],$tbt[0],$tbt[2]));    
        switch($info){
            case '0': return "Minggu"; break;
            case '1': return "Senin"; break;
            case '2': return "Selasa"; break;
            case '3': return "Rabu"; break;
            case '4': return "Kamis"; break;
            case '5': return "Jum'at"; break;
            case '6': return "Sabtu"; break;
        };
    }

    public function terbilang ($angka) {
        $angka = (float)$angka;
        $bilangan = array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas');
        if ($angka < 12) {
            return $bilangan[$angka];
        } else if ($angka < 20) {
            return $bilangan[$angka - 10] . ' Belas';
        } else if ($angka < 100) {
            $hasil_bagi = (int)($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($angka < 200) { return sprintf('Seratus %s', $this->terbilang($angka - 100));
        } else if ($angka < 1000) { $hasil_bagi = (int)($angka / 100); $hasil_mod = $angka % 100; return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
        } else if ($angka < 2000) { return trim(sprintf('Seribu %s', $this->terbilang($angka - 1000)));
        } else if ($angka < 1000000) { $hasil_bagi = (int)($angka / 1000); $hasil_mod = $angka % 1000; return sprintf('%s Ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
        } else if ($angka < 1000000000) { $hasil_bagi = (int)($angka / 1000000); $hasil_mod = $angka % 1000000; return trim(sprintf('%s Juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000) { $hasil_bagi = (int)($angka / 1000000000); $hasil_mod = fmod($angka, 1000000000); return trim(sprintf('%s Milyar %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000000) { $hasil_bagi = $angka / 1000000000000; $hasil_mod = fmod($angka, 1000000000000); return trim(sprintf('%s Triliun %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else {
            return 'Data Salah';
        }
    }

    function pembulatanSeratus($uang){
        $ratusan = substr($uang, -2);
        if($ratusan==00){
            $akhir = $uang;
        }else{
            $akhir = $uang + (100-$ratusan);            
        }

        return $akhir;
    }

    public function namaSdm($andWhere=null,$fk_bagian_id=null){
        $this->ci->db->select("ms_sdm.id,ms_sdm.fk_bagian_id,ms_sdm.fk_jabatan_id,ms_sdm.pejabat_kpa,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,tmt_jabatan_baru,eselon,CONCAT_WS('',status_jabatan,' ',jabatan) jabatan,CONCAT_WS('',status_jabatan_baru,' ',jabatan_baru)jabatan_baru,nama_bagian");
        $this->ci->db->from("ms_sdm");
        $this->ci->db->join('ms_jabatan', "ms_jabatan.id = ms_sdm.fk_jabatan_id", 'left');
        $this->ci->db->join('ms_bagian', "ms_bagian.id = ms_sdm.fk_bagian_id", 'left');
        $this->ci->db->order_by('status_pegawai,urut_ttd','asc');
        $this->ci->db->order_by('pegawai_setda','desc');
        if (!empty($andWhere)) {
            $this->ci->db->where($andWhere);
        }

        // if ($fk_bagian_id) {
        //     $where2 = "(ms_sdm.fk_bagian_id=$fk_bagian_id OR ms_sdm.fk_bagian_id_baru=$fk_bagian_id)";
        //     $this->ci->db->where($where2);
        // }

        return $this->ci->db->get()->result_array();
    }

    public function ttd_atasan($fk_bagian_id=null){
        // $que = "SELECT s.id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,jabatan,j.urut_ttd,jabatan_baru FROM ms_sdm s
                // JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
                // WHERE s.`status` = 1 AND j.eselon IN ( '2A', '2B', '3A', '3B' ) OR (j.eselon='4A' AND SUBSTR(jabatan,1,3)='Plt') OR (j.id=26)
                // ORDER BY urut_ttd";
        $andWhere='';
        if(!empty($fk_bagian_id)) {
            $andWhere = " AND (s.fk_bagian_id=$fk_bagian_id OR s.fk_bagian_id_baru=$fk_bagian_id OR j.eselon IN ('1','2A','2B') OR jb.eselon IN ('1','2A','2B'))";
        }
        $que = "SELECT s.id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru, status_jabatan,status_jabatan_baru,
                CONCAT_WS('',status_jabatan,' ',jabatan) jabatan,CONCAT_WS('',status_jabatan_baru,' ',jabatan_baru)jabatan_baru,tmt_jabatan_baru,
                CASE WHEN jabatan_baru IS NULL THEN j.urut_ttd ELSE jb.urut_ttd END AS urut_ttd
                FROM ms_sdm s
                JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
                LEFT JOIN ms_jabatan jb ON jb.id = s.fk_jabatan_id_baru
                WHERE s.`status` = 1 AND (j.eselon IN ('1','2A', '2B', '3A', '3B' ) OR jb.eselon IN ('1', '2A', '2B', '3A', '3B' )) $andWhere
                ORDER BY urut_ttd";
        return $this->ci->db->query($que)->result();    
    }

    public function ttd_pa(){
        $que = "SELECT s.id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,j.urut_ttd,CONCAT_WS('',status_jabatan,' ',jabatan) jabatan,CONCAT_WS('',status_jabatan_baru,' ',jabatan_baru)jabatan_baru FROM ms_sdm s
                JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
                WHERE j.`id` = 3 AND s.`status`=1";
        return $this->ci->db->query($que)->result();    
    }

    public function ttd_kpa($fk_bagian_id=null){
        $andWhere='';
        if(!empty($fk_bagian_id)) {
            $andWhere = " AND (s.fk_bagian_id=$fk_bagian_id OR s.fk_bagian_id_baru=$fk_bagian_id)";
        }
        $que = "SELECT s.id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,j.urut_ttd,CONCAT_WS('',status_jabatan,' ',jabatan) jabatan,CONCAT_WS('',status_jabatan_baru,' ',jabatan_baru)jabatan_baru,tmt_jabatan_baru
                FROM ms_sdm s
                JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
                LEFT JOIN ms_jabatan jb ON jb.id = s.fk_jabatan_id_baru
                -- WHERE s.`status` = 1 AND (j.eselon IN ( '3A','3B') OR jb.eselon IN ('3A', '3B' ) OR (j.eselon='4A' AND SUBSTR(jabatan,1,3)='Plt') )
                WHERE s.`status` = 1 AND pejabat_kpa=1 $andWhere
                ORDER BY urut_ttd ";
        return $this->ci->db->query($que)->result();    
    }

    public function ttd_ppk(){
        $que = "SELECT s.id,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,j.urut_ttd,CONCAT_WS('',status_jabatan,' ',jabatan) jabatan,CONCAT_WS('',status_jabatan_baru,' ',jabatan_baru)jabatan_baru,tmt_jabatan_baru
                FROM ms_sdm s
                JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
                LEFT JOIN ms_jabatan jb ON jb.id = s.fk_jabatan_id_baru
                -- WHERE s.`status` = 1 AND (j.eselon IN ( '3A','3B') OR jb.eselon IN ('3A', '3B' ) OR (j.eselon='4A' AND SUBSTR(jabatan,1,3)='Plt') )
                WHERE s.`status` = 1 AND pejabat_ppk=1
                ORDER BY urut_ttd ";
        return $this->ci->db->query($que)->result();    
    }

    public function ttd_bendahara($tahun){
        $que = "SELECT id,nama,nip,jabatan,jabatan_baru FROM ms_sdm
                WHERE bendahara=1 AND status=1 ";
                // AND (YEAR(bendahara_mulai) <= '$tahun' AND YEAR(bendahara_sampai) >= '$tahun')
        return $this->ci->db->query($que)->result();    
    }

    public function ttd_pptk($fk_bagian_id=null){
        $andWhere='';
        if(!empty($fk_bagian_id)) {
            $andWhere = " AND (s.fk_bagian_id=$fk_bagian_id OR s.fk_bagian_id_baru=$fk_bagian_id)";
        }

        $que = "SELECT s.id,jb.eselon eselon_baru,j.eselon,nama,nip,gol_pangkat,gol_pangkat_baru,tmt_gol_pangkat_baru,CONCAT_WS('',status_jabatan,' ',jabatan) jabatan,CONCAT_WS('',status_jabatan_baru,' ',jabatan_baru)jabatan_baru,j.urut_ttd FROM ms_sdm s
                LEFT JOIN ms_jabatan j ON j.id = s.fk_jabatan_id 
                LEFT JOIN ms_jabatan jb ON jb.id = s.fk_jabatan_id_baru
            -- WHERE s.`status` = 1 AND pegawai_setda=1 AND (j.eselon IN ( '4A') OR jb.eselon IN ( '4A') OR (j.eselon='6' AND SUBSTR(jabatan,1,3)='Plt') OR (jb.eselon='6' AND SUBSTR(jabatan_baru,1,3)='Plt')) 
                WHERE s.`status` = 1 AND pejabat_pptk=1 $andWhere
                ORDER BY urut_ttd ";
        return $this->ci->db->query($que)->result();    
    }

    public function headerLaporan(){
        $html = " 
            <table width='100%' style='text-align:center;font-family:arial' cellspacing='-2' >
                <tr>
                    <td valign='top' rowspan='5' width='90px'><img src='".base_url()."image/kab_kediri.png' width='73px' height='90px'></td>
                    <td style='font-size:12pt' colspan='2'> PEMERINTAH KABUPATEN KEDIRI</td>
                    <td rowspan='5' width='50px'></td>
                </tr>
                <tr>
                    <td style='font-size:16pt' colspan='2'><b>SEKRETARIAT DAERAH</b></td>
                </tr>
                <tr>
                    <td style='font-size:10pt' colspan='2'>Jalan Soekarno Hatta Nomor 1, Kecamatan Ngasem, Kabupaten Kediri 64182</td>
                </tr>
                <tr>
                    <td style='font-size:10pt' colspan='2'>Telepon (0354) 689901–689905</td>
                </tr>
                <tr>
                    <td style='font-size:10pt' colspan='2'>Laman : <u>www.kedirikab.go.id</u></td>
                </tr>
            </table>
            <hr class='bordersolid' style='color:black'>
            <hr class='bordersolid' style='margin-top:-11px;height:3px;color:black'>
        ";

        return $html;
    }

    public function headerBagian($namaBag){
        $html = " 
            <table width='100%' style='text-align:center;font-family:arial' cellspacing='-2'>
                <tr>
                    <td valign='top' rowspan='5' width='90px'><img src='".base_url()."image/kab_kediri.png' width='73px' height='90px'></td>
                    <td style='font-size:16pt'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>SEKRETARIAT DAERAH KABUPATEN KEDIRI</b></td>
                    <td rowspan='5' width='50px'></td>
                </tr>
                <tr>
                    <td style='font-size:17pt' colspan='2'><b>".$namaBag."</b></td>
                </tr>
                <tr>
                    <td style='font-size:12pt' colspan='2'>Jl. Soekarno Hatta No. 1 kediri Telp. (0354) 689901 - 689905</td>
                </tr>
                <tr>
                    <td style='font-size:12pt' colspan='2'>Website : <u>www.kedirikab.go.id</u></td>
                </tr>
                <tr>
                    <td colspan='2'>K E D I R I</td>
                </tr>
                <tr>
                    <td colspan='3' style='text-align:right;font-size:12pt'>Kode Pos : 64182</td>
                </tr>
            </table>
            <hr class='bordersolid' style='color:black'>
            <hr class='bordersolid' style='margin-top:-11px;height:3px;color:black'>
        ";

        return $html;
    }

    public function headerLaporanBupati(){
        $html = " 
            <table width='100%' style='text-align:center;font-family:arial' cellspacing='-2'>
                <tr>
                    <td><img src='".base_url()."image/logo_garuda.png' width='90px' height='90px'></td>
                </tr>
                <tr>
                    <td style='font-size:17pt'><b>BUPATI KEDIRI</b></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
            </table>
        ";

        return $html;
    }

    public function folio_P(){
        return array(216,330);
    }

    public function folio_L(){
        return array(330,216);
    }

    public function f5_P(){
        return array(165,210);
    }

    public function f5_L(){
        return array(210,165);
    }

}