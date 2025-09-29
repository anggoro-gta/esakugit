<!doctype html>
<html>
    <head>
        <title>Halaman 1</title>
    </head>
    <body onload="window.print()" style="margin:0">
        <div class="responsive">
            <?=$header?>
            <table style="font-size:9pt;font-family:arial;padding-top: -10px" cellspacing="-2">
                <tr>
                    <td style="width: 500px"></td>
                    <td style="width: 100px">Tahun Anggaran</td>
                    <td style="width: 15px">:</td>
                    <td><?=$hasil['tahun']?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Lembar ke</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kode Nomor</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>090/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$kelAss->kode_bagian.'/'.$hasil['tahun']?></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            </table>
            <table width="100%" style="font-size:13pt;text-align:center;font-family:arial">
                <tr>
                    <td><b><u>SURAT PERJALANAN DINAS</u> (SPD)</b></td>
                </tr>
            </table>
            <br>
            <table class="bordersolid" width="100%" style="font-size:11pt;line-height: 1.3;" border="1" cellspacing="-1">
                <tr>
                    <td width="40px" align="center" valign="top">1</td>
                    <td width="38%" valign="top">Pengguna Anggaran / Kuasa Pengguna Anggaran </td>
                    <?php
                        // $esl = $detail[0]['eselon'];
                        // if($esl=='2A' || $esl=='2B' || $esl=='3A'){
                        //     $brwng = 'BUPATI';
                        // }else{
                        //     $brwng = $bagn->nama_bagian;
                        // }
                    ?>
                    <td valign="top" colspan="2">Kuasa Pengguna Anggaran</td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td>Nama/NIP Pegawai yang melaksanakan perjalanan dinas</td>
                    <td colspan="2"><?=$detail[0]['nama_sdm']?></td>
                </tr>
                <tr>
                    <td align="center" valign="top">3</td>
                    <td>a. Pangkat dan Golongan <br> b. Jabatan / Instansi <br> c. Tingkat Biaya Perjalanan Dinas
                    </td>
                    <td colspan="2">
                        <?php 
                            echo "a. ".$detail[0]['pangkat_gol'];
                            echo "<br>";
                            echo "b.".$detail[0]['jabatan'];
                            echo "<br>";
                            echo "c.";
                        ?>
                    </td>
                </tr>                
                <tr>
                    <td align="center" valign="top">4</td>
                    <td valign="top">Maksud Perjalanan Dinas</td>
                    <td colspan="2"><?=$hasil['acara']?></td>
                </tr>
                <tr>
                    <td align="center">5</td>
                    <td>Alat Angkut yang dipergunakan</td>
                    <td colspan="2"><?=$hasil['alat_transportasi']?></td>
                </tr>
                <tr>
                    <td align="center" valign="top">6</td>
                    <td valign="top">
                        a. Tempat Berangkat
                        <br>
                        b. Tempat Tujuan
                    </td>
                    <td colspan="2">
                        a. Pemerintah Kab. Kediri
                        <br>
                        b. <?=$hasil['kategori']=='DD'?$hasil['tujuan_skpd']:ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')'?>
                    </td>
                </tr>  
                <tr>
                    <td align="center" valign="top">7</td>
                    <td valign="top">
                        a. Lama Perjalanan Dinas
                        <br>
                        b. Tanggal berangkat
                        <br>
                        c. Tanggal harus kembali
                    </td>
                    <td colspan="2">
                        <?php 
                            $brgkt = $hasil['tgl_berangkat'];
                            $tiba = $hasil['tgl_tiba'];
                            $tgl1=date_create($brgkt);
                            $tgl2=date_create($tiba);
                            $diff = date_diff($tgl1,$tgl2);
                            $jmlHari = $diff->d+1;

                            $brk = explode('-', $brgkt);
                            $tba = explode('-', $tiba);
                        ?>
                        a. <?=$jmlHari?> (<?=strtolower($this->help->terbilang($jmlHari))?>) Hari
                        <br>
                        b. <?=$brk[2].' '.$this->help->namaBulan($brk[1]).' '.$brk[0]?>
                        <br>
                        c. <?=$tba[2].' '.$this->help->namaBulan($tba[1]).' '.$tba[0]?>
                    </td>
                </tr>        
                <tr>
                    <?php 
                    $nama = '<u>Pengikut : Nama</u>';
                    $np = '<u>NIP</u>';
                    $ket = '<u>Keterangan</u>';
                    foreach ((array)$detail as $val):
                        if($detail[0]['fk_sdm_id'] != $val['fk_sdm_id']){
                            $tb ='';
                            if(strlen($val['jabatan']) > 34){
                                // $tb = "<br>";
                            }
                            $nama .= $val['nama_sdm']."<br>"; 
                            $ckNip = $val['nip']!='-'?$val['nip']:'';
                            $np .= "<br>".$ckNip.$tb; 
                            $ket .= "<br>".$val['jabatan']; 
                        }else{
                            $nama .= "<br>&nbsp;";
                            if(($hasil['urut_ttd_sppd']=='1' || $hasil['urut_ttd_sppd']=='2') && $hasil['fk_bagian_id']=='1'){
                                // $nama .= "<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;";
                                // $np .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                        } 
                    endforeach; ?>
                    <td  align="center" valign="top">8</td>
                    <td valign="top">
                        <?=$nama?>
                    </td>
                    <td valign="top">
                        <?=$np?>
                    </td>
                    <td valign="top">
                        <?=$ket?>
                    </td>
                </tr> 
                <tr>
                    <td align="center" valign="top">9</td>
                    <td valign="top">Pembebanan Anggaran
                        <br>
                        a. SKPD
                        <br>
                        b. Akun
                    </td>
                    <td colspan="2" valign="top">
                        <br>
                        a. <?=$bagn->nama_bagian?>
                    </td>
                </tr>  
                <tr>
                    <td align="center">10</td>
                    <td>Keterangan lain - lain</td>
                    <td colspan="2"></td>
                </tr>  
            </table>
            <br>
            <table width="100%" style="font-size:11pt;">
                <tr>
                    <td width="400px"></td>
                    <td>Dikeluarkan di</td>
                    <td style="width: 10px">:</td>
                    <td>KEDIRI</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>
                    <?php
                        $tglST = explode('-', $hasil['tgl_surat_tugas']);
                        if($tglST[2]!='00'){
                            // echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0];
                        }
                    ?>                        
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" style="padding-top: -15px"><hr class="bordersolid" style="color:black"></td>
                </tr>
                <tr>
                    <td></td>
                    <?php
                        $ttdJudul = '';
                        if($hasil['urut_ttd_sppd']=='1'){
                            $ttdJudul = $hasil['jabatan_ttd_sppd'];
                        }else if($hasil['urut_ttd_sppd']=='2'){
                            $ttdJudul = 'a.n. BUPATI KEDIRI <br> '.$hasil['jabatan_ttd_sppd'];
                        }else if($hasil['urut_ttd_sppd']=='3'){
                            $ttdJudul = 'a.n. BUPATI KEDIRI <br> SEKRETARIS DAERAH <br>u.b.<br> '.$hasil['jabatan_ttd_sppd'];
                        }else if($hasil['urut_ttd_sppd']=='4'){
                            $ttdJudul = 'a.n. BUPATI KEDIRI <br>'.strtoupper($kelAss->kelompok_asisten).'<br>u.b.<br> '.$hasil['jabatan_ttd_sppd'];
                        }
                    ?>
                    <!-- <td align="center" colspan="3"><?=$ttdJudul?></td> -->
                    <td align="center" colspan="3">Kuasa Pengguna Anggaran</td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="3"><u><b><?=$hasil['nama_pejabat_kpa']?></b></u></td>
                </tr>
                <!-- <tr>
                    <td></td>
                    <td align="center" colspan="3">
                        <?php
                            $gol = explode('(', $hasil['pangkat_ttd_sppd']);
                            echo $gol[0];
                        ?>
                    </td>
                </tr> -->
                <tr>
                    <td></td>
                    <td align="center" colspan="3">NIP. <?=$hasil['nip_pejabat_kpa']?></td>
                </tr>
            </table>
        </div>
    </body>
</html>
<style type="text/css">
.border_all{
    border: 1px solid #000;
}
.no_border_right{
    border-right: 0px solid #000;
}
.no_border_left{
    border-left: 0px solid #000;
}
.no_border_top{
    border-top: 0px solid #000;
}
.no_border_bottom{
    border-bottom: 0px solid #000;
}
.bordersolid{
    border: 1px solid black; border-collapse: collapse;
}
</style>