<!doctype html>
<html>
    <head>
        <title>Kwitansi All</title>
    </head>
    <body>
        <?php //$jmlKwi=count($detail); $noKwi=1; ?>
        <?php foreach ($hasil as $hsl) : ?>
            <?php
                $bndhrPmbntu=' Pembantu';
                // if($hsl['fk_bagian_id']==5 && strtotime($hsl['tgl_surat_tugas']) >= strtotime(date('2019-02-01'))){ //sementara utk Bagian ANDAT per bln Feb 2019
                //     $bndhrPmbntu='';
                // }
            ?>
            <?php foreach ($detail[$hsl['id']] as $dt) : ?>
            <div class="responsive">
                <table width='100%' style='font-family:arial;font-size:9pt' cellspacing='-2' border="0">
                    <tr>
                        <td valign='top' rowspan='5' width='50px' align="center"><img src="<?=base_url()?>image/kab_kediri.png" width='40px' height='50px'></td>
                        <td width='500px'>PEMERINTAH KABUPATEN KEDIRI</td>
                        <td rowspan='2' width='150px'></td>
                    </tr>
                    <tr>
                        <td>BADAN PERENCANAAN PEMBANGUNAN DAERAH</td>
                    </tr>
                    <tr>
                        <td>Jl. Soekarno Hatta No. 01 kediri Telp. (0354) 689995</td>
                        <td>Tahun Anggaran : <?=$hsl['tahun']?></td>
                    </tr>
                </table>
                <br>
                <table width="100%" style="font-size:9pt;text-align:center;font-family:arial">
                    <tr>
                        <td><b>K W I T A N S I</b></td>
                    </tr>
                    <tr>
                        <td>Nomor : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - <?=$dt['no_kwitansi'].'/'.$hsl['nama_bagian'].'.'.$hsl['singkatan_kegiatan'].'/'.$hsl['bulan'].'/'.$hsl['tahun']?></td>
                    </tr>
                    <hr style='margin-top:1px;color:black'><hr style='margin-top:-9px;color:black'>
                </table> 
                <?php
                    $isKuasa = 'Kuasa';
                    $jbtnKPA = $hsl['jabatan_pejabat_kpa'];
                    $namaKPA = $hsl['nama_pejabat_kpa'];
                    $nipKPA = $hsl['nip_pejabat_kpa'];
                    if(empty($jbtnKPA)){
                        $jbtnKPA = $hsl['jabatan_pejabat_pa'];
                        $namaKPA = $hsl['nama_pejabat_pa'];
                        $nipKPA = $hsl['nip_pejabat_pa'];
                    }
                    if(preg_match("/KEPALA BAPPEDA/i", $jbtnKPA)) {
                        $isKuasa = '';
                    }
                ?>
                <table width="100%" style="font-size:9pt;font-family:arial;margin-top:-7px" border="0">
                    <tr>
                        <td width="160px">Sudah Terima Dari</td>
                        <td width="10px" align="center">:</td>
                        <td colspan="4" width="300px"><?=$isKuasa?> Pengguna Anggaran</td>
                    </tr>
                    <tr>
                        <td>Uang Sebesar</td>
                        <td align="center">:</td>
                        <td colspan="4">Rp. <?=number_format($dt['total_akhirnya']) ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Untuk Pembayaran</td>
                        <td valign="top" align="center">:</td>
                        <td colspan="4">Biaya Perjalanan Dinas dalam rangka <?=$hsl['acara']?>, kegiatan <?=$hsl['kegiatan_bappeda']?>, pada tanggal 
                            <?php 
                                $tglST = explode('-', $hsl['tgl_berangkat']);
                                $tglTb = explode('-', $hsl['tgl_tiba']);
                                if(($hsl['tgl_berangkat']!=$hsl['tgl_tiba']) && ($tglST[1]==$tglTb[1])){
                                     echo $tglST[2].' s/d '.$tglTb[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0];
                                }else{
                                    echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]; 
                                
                                    if($hsl['tgl_berangkat']!=$hsl['tgl_tiba']){
                                        echo ' s/d '.' '.$tglTb[2].' '.$this->help->namaBulan($tglTb[1]).' '.$tglTb[0];
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Berdasarkan SPPD</td>
                        <td valign="top" align="center">:</td>
                        <td colspan="4"><?=$dt['eselon']=='2B'?'BUPATI':'KEPALA BAPPEDA';?> KABUPATEN KEDIRI</td>
                    </tr>
                    <tr>
                        <td valign="top">Nomor</td>
                        <td valign="top" align="center">:</td>
                        <td colspan="4">094/<?=$hsl['no_surat_tugas']?>/418.54/<?=$hsl['tahun']?></td>
                    </tr>
                    <tr>
                        <td valign="top">Tanggal Surat Tugas</td>
                        <td valign="top" align="center">:</td>
                        <td colspan="4"><?php $tglST = explode('-', $hsl['tgl_surat_tugas']);
                            echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Untuk perjalanan dinas dari</td>
                        <td valign="top" align="center">:</td>
                        <td valign="top">Bappeda Kab. kediri</td>
                        <td valign="top" width="10px" align="center">Ke</td>
                        <td valign="top" width="10px" align="center">:</td>
                        <td valign="top"><?=$hsl['kategori']=='DL'?ucwords(strtolower($hsl['kota'])).' ('.$hsl['tujuan_skpd'].')':$hsl['tujuan_skpd']?></td>
                    </tr>                
                    <tr>
                        <td valign="top">Terbilang</td>
                        <td valign="top" align="center">:</td>
                        <td colspan="4"><b><i>(=<?=$this->help->terbilang($dt['total_akhirnya'])?> Rupiah=)</i></b></td>
                    </tr>
                </table>   
                <br>
                <table width="100%" style="font-size:9pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                    <tr>
                        <td width="30%">SETUJU DIBAYAR</td>
                        <td width="30%">LUNAS DIBAYAR Tgl: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td width="30%">Kediri, 
                             <?php $tglRc = explode('-', $hsl['tgl_rincian']);
                            echo $tglRc[2].' '.$this->help->namaBulan($tglRc[1]).' '.$tglRc[0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?=$jbtnKPA?></td>
                        <td>Bendahara Pengeluaran <?=$bndhrPmbntu?></td>
                        <td>Yang Menerima</td>
                    </tr>
                    <tr>
                        <td>Selaku <?=$isKuasa?> Pengguna Anggaran</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr><td height="60px" colspan="3"></td></tr>
                    <tr>
                        <td><u><?=$namaKPA?></u></td>
                        <td><u><?=$hsl['nama_bendahara_pembantu']?></u></td>
                        <td><u><?=$dt['nama_sdm']?></u></td>
                    </tr>
                    <tr>
                        <td>NIP. <?=$nipKPA?></td>
                        <td>NIP. <?=$hsl['nip_bendahara_pembantu']?></td>
                        <td><?= $dt['nip']!='-'?"NIP. ".$dt['nip']:'';?></td>
                    </tr>
                </table>        
            </div>
            <?php //if($jmlKwi!=$noKwi){?>
                <pagebreak>
            <?php //} $noKwi++; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </body>
</html>