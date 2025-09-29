<!doctype html>
<html>
    <head>
        <title>Kwitansi Mamin</title>
    </head>
    <body>
        <?php for ($i=1; $i <= 3; $i++) { ?>
            <?php //if($nilaiUang[$i]!=0) { ?>
            <?php if($i=3) { ?>
                <div class="responsive">
                    <table width='100%' style='font-family:arial;font-size:9pt' cellspacing='-2' border="0">
                        <tr>
                            <td valign='top' rowspan='5' width='50px' align="center"><img src="<?=base_url()?>image/kab_kediri.png" width='40px' height='50px'></td>
                            <td width='500px'>PEMERINTAH KABUPATEN KEDIRI</td>
                            <td width='150px'>No. TBP : <?=$hasil['no_bku']?></td>
                        </tr>
                        <tr>
                            <td>SEKRETARIAT DAERAH</td>
                            <td>No. LPJ &nbsp;:</td>
                        </tr>
                        <tr>
                            <td>Jl. Soekarno Hatta No. 01 kediri Telp. (0354) 689901 - 689905</td>
                            <td>Tahun Anggaran : <?=$hasil['tahun']?></td>
                        </tr>
                        <!-- <tr>
                            <td></td>
                            <td>Pajak Daerah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?=!empty($tampilkan_pajak)?number_format($pajakDaerah[$i]):''?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>PPh 23 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?=!empty($tampilkan_pajak)?number_format($Pph23[$i]):''?></td>
                        </tr> -->
                    </table>
                    <br>
                    <table width="100%" style="font-size:11pt;text-align:center;font-family:arial">
                        <tr>
                            <td><b>K W I T A N S I</b></td>
                        </tr>
                        <hr style='margin-top:1px;color:black'><hr style='margin-top:-9px;color:black'>
                    </table> 
                    <table width="100%" style="font-size:9pt;font-family:arial;margin-top:-7px" border="0">
                        <tr>
                            <td valign="top">Kode Sub Kegiatan</td>
                            <td valign="top" align="center">:</td>
                            <td colspan="4"><?=$hasil['kode_kegiatan']?></td>
                        </tr>
                        <tr>
                            <td valign="top">Kode Rekening Belanja</td>
                            <td valign="top" align="center">:</td>
                            <td colspan="4"><?=$hasil['kode_rekening']?></td>
                        </tr>
                        <tr>
                            <td>NPWP</td>
                            <td align="center">:</td>
                            <td colspan="4"><?=$rekanan['npwp']?></td>
                        </tr>
                        <tr>
                            <td width="160px">Sudah Terima Dari</td>
                            <td width="10px" align="center">:</td>
                            <?php
                                $isKuasa = 'Kuasa '; 
                                // $isKuasa = ''; 
                                // if(empty($hasil['nama_pejabat_kpa'])){
                                //     $isKuasa = '';
                                // }
                            ?>
                            <td colspan="4" width="300px"><?=$isKuasa?> Pengguna Anggaran</td>
                        </tr>
                        <tr>
                            <td>Uang Sebesar</td>
                            <td align="center">:</td>
                            <td colspan="4">Rp. <?=number_format($nilaiUang[$i])?></td>
                        </tr>
                        <tr>
                            <td valign="top">Untuk Pembayaran</td>
                            <td valign="top" align="center">:</td>
                            <td colspan="4"><?=$untPmbyrn[$i].$hasil['perihal']?>, sub kegiatan <?=$hasil['kegiatan']?>, pada tanggal 
                                <?php 
                                    $tglST = explode('-', $hasil['tgl_kegiatan_dari']);
                                    $tglTb = explode('-', $hasil['tgl_kegiatan_sampai']);
                                    if(($hasil['tgl_kegiatan_dari']!=$hasil['tgl_kegiatan_sampai']) && ($tglST[1]==$tglTb[1])){
                                         echo $tglST[2].' s/d '.$tglTb[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0];
                                    }else{
                                        echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]; 
                                    
                                        if($hasil['tgl_kegiatan_dari']!=$hasil['tgl_kegiatan_sampai']){
                                            echo ' s/d '.' '.$tglTb[2].' '.$this->help->namaBulan($tglTb[1]).' '.$tglTb[0];
                                        }
                                    }
                                ?>, dengan rincian sebagai berikut :<br>
                                - Makan dan Minum <?=$jml_makan[$i]?> kotak x @<?=number_format($uang_makan[$i])?> = Rp. <?=number_format($nilaiUang[$i])?>
                                <br>
                                <br>
                                <table style="line-height: 0.8;" cellspacing="-1">
                                    <tr>
                                        <td>Pajak Daerah</td>
                                        <td>=</td>
                                        <td>Rp.</td>
                                        <td align="right"><?=number_format($pajakDaerah[$i])?></td>
                                    </tr>
                                    <tr>
                                        <td>PPh 23</td>
                                        <td>=</td>
                                        <td>Rp.</td>
                                        <td align="right"><?=number_format($Pph23[$i])?></td>
                                    </tr>
                                </table>
                                <br>
                            </td>
                        </tr>       
                        <tr>
                            <td valign="top">Terbilang</td>
                            <td valign="top" align="center">:</td>
                            <td colspan="4"><b><i>(=<?=$this->help->terbilang($nilaiUang[$i])?> Rupiah=)</i></b></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </table> 

                    <!-- <table width="110%" style="font-size:8pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                        <tr>
                            <?php $clsp='2'; if($hasil['nama_pejabat_kpa']){  $clsp=''; ?>
                                <td valign="bottom">Menyetujui,</td>
                            <?php } ?>
                            <td valign="bottom">Mengetahui,</td>
                            <td valign="bottom" align="center" >LUNAS DIBAYAR<br>Tgl: ........................... </td>
                            <td colspan="<?=$clsp?>" valign="bottom" width="180px">Kediri, 
                                <?php 
                                     $tglKwi = $hasil['tgl_kwitansi'];
                                     if($tglKwi){
                                        $tglPs = explode('-', $hasil['tgl_kwitansi']);
                                        echo $tglPs[2].' '.$this->help->namaBulan($tglPs[1]).' '.$tglPs[0]; 
                                    }else{
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <?php if($hasil['nama_pejabat_kpa']){ ?>
                                <td valign="top"><?=$hasil['jabatan_pejabat_kpa'].'<br>Selaku KPA,'?></td>
                            <?php } ?>
                            <td valign="top">PPTK</td>
                            <?php if(!empty($hasil['nama_bendahara_pembantu'])){ ?>
                                <td valign="top">Bendahara<br>Pengeluaran Pembantu</td>
                            <?php }else{ ?>
                                <td></td>
                            <?php } ?>
                            <td colspan="<?=$clsp?>" valign="top">Penerima</td>
                        </tr>
                        <tr><td height="55px" colspan="3"></td></tr>
                        <tr>
                            <?php if($hasil['nama_pejabat_kpa']){ ?>
                                <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                            <?php } ?>
                            <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                            <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                            <td colspan="<?=$clsp?>"><b><u><?=$rekanan['nama_pemilik']?></u></b></td>
                        </tr>
                        <tr>
                            <?php if($hasil['nama_pejabat_kpa']){ ?>
                                <td>NIP. <?=$hasil['nip_pejabat_kpa']?>&nbsp;</td>
                            <?php } ?>
                            <td>NIP. <?=$hasil['nip_pejabat_pptk']?>&nbsp;</td>
                            <?php if(!empty($hasil['nama_bendahara_pembantu'])){ ?>
                                <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
                            <?php } else{ ?>
                                <td></td>
                            <?php } ?>
                            <td colspan="<?=$clsp?>"><?=$rekanan['nama_rekanan']?></td>
                        </tr>
                    </table> -->
                    <table width="100%" style="font-size:8pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                        <tr>
                            <!-- <td width="50%" valign="bottom" align="center" >LUNAS DIBAYAR<br>Tgl: ........................... </td> -->
                            <td width="50%"></td>
                            <td colspan="<?=$clsp?>" valign="bottom" width="180px">Kediri, 
                                <?php 
                                     $tglKwi = $hasil['tgl_kwitansi'];
                                     if($tglKwi){
                                        $tglPs = explode('-', $hasil['tgl_kwitansi']);
                                        echo $tglPs[2].' '.$this->help->namaBulan($tglPs[1]).' '.$tglPs[0]; 
                                    }else{
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Bendahara<br>Pengeluaran Pembantu</td>
                            <td colspan="<?=$clsp?>" valign="top">Penerima</td>
                        </tr>
                        <tr><td height="55px" colspan="3"></td></tr>
                        <tr>
                            <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                            <td colspan="<?=$clsp?>"><b><u><?=$rekanan['nama_pemilik']?></u></b></td>
                        </tr>
                        <tr>
                            <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
                            <td colspan="<?=$clsp?>"><?=$rekanan['nama_rekanan']?></td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" style="font-size:8pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                        <tr>
                            <td width="50%" valign="bottom">Menyetujui,</td>
                            <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                                <td valign="bottom">Mengetahui,</td>   
                            <?php } ?>                            
                        </tr>
                        <tr>
                            <td valign="top"><?=$hasil['jabatan_pejabat_kpa'].'<br>Selaku KPA,'?></td>
                            <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                                <td valign="top">PPTK</td>
                            <?php } ?> 
                        </tr>
                        <tr><td height="55px" colspan="3"></td></tr>
                        <tr>
                            <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                            <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                                <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                            <?php } ?> 
                        </tr>
                        <tr>
                            <td>NIP. <?=$hasil['nip_pejabat_kpa']?>&nbsp;</td>
                            <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                                <td>NIP. <?=$hasil['nip_pejabat_pptk']?>&nbsp;</td>
                            <?php } ?> 
                        </tr>
                    </table>
                </div>
            <?php } ?>        
            <?php if ($i != 3 && $nilaiUang[$i]!=0){ ?>
                <pagebreak>
            <?php } ?>
        <?php } ?>
    </body>
</html>