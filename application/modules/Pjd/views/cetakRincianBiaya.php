<!doctype html>
<html>
    <head>
        <title>Rincian Biaya Perjalanan Dinas</title>
    </head>
    <body onload="window.print()" style="margin:0">
        <?php
            $bndhrPmbntu=' Pembantu';
            if($hasil['fk_bagian_id']==5 && strtotime($hasil['tgl_surat_tugas']) >= strtotime(date('2019-02-01'))){ //sementara utk Bagian ANDAT per bln Feb 2019
                $bndhrPmbntu='';
            }
        ?>
        <div class="responsive">
            <table width="100%" style="font-size:12pt;text-align:center;font-family:arial;">
                <tr>
                    <td><b><u>RINCIAN BIAYA PERJALANAN DINAS</u></b></td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:9pt;font-family:arial" border="0">
                <!-- <tr>
                    <td width="200px">LAMPIRAN SPT NOMOR</td>
                    <td width="10px">:</td>
                    <td>
                        <?php
                            $no_st = '090/'.$hasil['no_surat_tugas'].'/'.$kelAss->kode_bagian.'/'.$hasil['tahun'];
                            if($hasil['asal_surat_tugas']=='Luar'){
                                $no_st = $hasil['no_surat_tugas'];
                            }
                            echo $no_st;
                        ?>                                
                    </td>
                </tr> -->
                <tr>
                    <td width="200px">TANGGAL</td>
                    <td width="10px">:</td>
                    <td>
                    <!-- <?php $tglST = explode('-', $hasil['tgl_surat_tugas']);
                        echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]; ?> -->
                    </td>
                </tr>
                <tr>
                    <td>TUJUAN</td>
                    <td>:</td>
                    <td><?=$hasil['kategori']=='DL'?ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')':$hasil['tujuan_skpd']?></td>
                </tr>
                <tr><td></td></tr>
            </table>
            <table class="bordersolid" width="100%" style="font-size:9pt;font-family:arial;line-height: 1.3;" border="1" cellspacing="-1">
                <tr>
                    <td rowspan="3" width="30px" align="center">No.</td>
                    <td rowspan="3" width="" align="center">NAMA</td>
                    <td rowspan="3" width="" align="center">ESELON/<br>GOLONGAN</td>
                    <td rowspan="3" width="" align="center">Jml<br>Hari</td>
                    <td width="" align="center" colspan="8">RINCIAN BIAYA PERJALANAN DINAS</td>
                    <td rowspan="3" width="" align="center">TANDA TANGAN</td>
                </tr>
                <tr>
                    <td align="center" colspan="2">Uang Harian</td>
                    <td align="center" colspan="2">Uang Representasi</td>
                    <td align="center" rowspan="2">Biaya/Sewa Penginapan</td>
                    <td align="center" rowspan="2">Biaya Transpor</td>
                    <td align="center" rowspan="2">Biaya<br>Kontribusi</td>
                    <td align="center" rowspan="2">Jumlah</td>
                </tr>
                <tr>
                    <td align="center">Tarif</td>
                    <!-- <td align="center">Persen</td> -->
                    <td align="center">Total</td>
                    <td align="center">Tarif</td>
                    <td align="center">Total</td>
                </tr>
                <?php $no=1; foreach ($detailAll as $key => $dtl) {
                         $dtl0= $dtl[0];
                ?>
                    <tr>
                        <td class="no_border_bottom" valign="top" align="center"><?=$no++?></td>
                        <td class="no_border_bottom" valign="top"><?=$dtl0['nama_sdm']?><?=strlen($dtl0['nama_sdm'])<=15?'<br>&nbsp;':''?></td>
                        <td class="no_border_bottom" valign="top"><?=$dtl0['pangkat_gol']?></td>
                        <td class="no_border_bottom" valign="top" align="center">
                            <?php foreach ($dtl as $dt2) : ?>
                                <?=$dt2['hari']?><br>
                            <?php endforeach; ?>
                        </td>
                        <td class="no_border_bottom" valign="top" align="center">
                            <?php foreach ($dtl as $dt2) : ?>
                                <?=number_format($dt2['tarif'])?><br>
                            <?php endforeach; ?>
                        </td>
                        <!-- <td class="no_border_bottom" valign="top" align="center">
                            <?php foreach ($dtl as $dt2) : ?>
                                <?=$dt2['persen']?>%<br>
                            <?php endforeach; ?>
                        </td> -->
                        <td class="no_border_bottom" valign="top" align="center">
                            <?php foreach ($dtl as $dt2) : ?>
                                <!-- <?=number_format(($dt2['tarif']*$dt2['hari']*$dt2['persen'])/100)?><br> -->
                                <?=number_format(($dt2['tarif']*$dt2['hari']))?><br>
                            <?php endforeach; ?>
                        </td>
                        <td class="no_border_bottom" valign="top" align="right">
                            <?php foreach ($dtl as $dt2) : ?>
                                <?=!empty($dt2['representasi'])?number_format($dt2['representasi']):''?><br>
                            <?php endforeach; ?>
                        </td>
                        <td class="no_border_bottom" valign="top" align="right">
                            <?php foreach ($dtl as $dt2) : ?>
                                <?=!empty($dt2['representasi'])?number_format($dt2['representasi']*$dt2['hari']):''?><br>
                            <?php endforeach; ?>
                        </td>
                        <td class="no_border_bottom" valign="top" align="right">
                            <?php foreach ($dtl as $dt2) : ?>
                                <?=!empty($dt2['penginapan'])?number_format($dt2['penginapan']):''?><br>
                            <?php endforeach; ?>
                        </td>
                        <td class="no_border_bottom" valign="top" align="right">
                            <?php foreach ($dtl as $dt2) : ?>
                                <?=!empty($dt2['transport'])?number_format($dt2['transport']):''?><br>
                            <?php endforeach; ?>
                        </td>
                        <td class="no_border_bottom" valign="top" align="right">
                            <?php foreach ($dtl as $dt2) : ?>
                                <?=!empty($dt2['kontribusi'])?number_format($dt2['kontribusi']):''?><br>
                            <?php endforeach; ?>
                        </td>
                        <td class="no_border_bottom" class="no_border_bottom" valign="top" align="right">
                            <?php foreach ($dtl as $dt2) : 
                                $total = (($dt2['tarif']*$dt2['hari']))+($dt2['representasi']*$dt2['hari'])+$dt2['penginapan']+$dt2['transport']+$dt2['kontribusi'];

                                $subTotal += $total;
                            ?>
                                <?=number_format($total)?><br>
                            <?php endforeach; ?>
                        </td>
                        <td class="no_border_bottom"></td>
                    </tr>
                    <tr>
                        <td class="no_border_top"></td>
                        <td class="no_border_top"></td>
                        <td class="no_border_top"></td>
                        <td colspan="8" align="right">Sub Total &nbsp; </td>
                        <td align="right"><?=number_format($subTotal)?></td>
                        <td class="no_border_top"></td>
                    </tr>
                <?php $grandTotal+=$subTotal; $subTotal=0; } ?>
                <tr>
                    <td></td>
                    <td><b>TOTAL</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right"><b><?=number_format($grandTotal)?></b></td>
                    <td></td>
                </tr>                
            </table>
            <br>
            <table width="100%" style="font-size:8.5pt;font-family:arial;line-height: 1;text-align: center" border="0" cellspacing="-1">
                <?php 
                    $pmbntu='';
                    if($hasil['nama_bendahara_pembantu']){ 
                        $pmbntu='ada';
                    }
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <?php if(!empty($pmbntu)){ ?>
                        <td></td>
                    <?php } ?>
                    <td>Kediri, 
                        <?php 
                            $tglRnci = $hasil['tgl_rincian'];
                            if($tglRnci){
                                $tglRc = explode('-', $tglRnci);
                                echo $tglRc[2].' '.$this->help->namaBulan($tglRc[1]).' '.$tglRc[0]; 
                            }else{
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Menyetujui,<br><?=$hasil['jabatan_pejabat_kpa']?><br>Selaku KPA</td>
                    <td valign="top">
                        <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                            Mengetahui, <br>Pejabat Pelaksana Teknis Kegiatan
                        <?php } ?>
                    </td>
                    <?php if(!empty($pmbntu)){ ?>
                        <td valign="top">Bendahara Pengeluaran<br>Pembantu</td>
                    <?php } ?>
                </tr>
                <tr><td height="60px" colspan="2"></td></tr>
                <tr>
                    <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                    <td>
                        <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                            <b><u><?=$hasil['nama_pejabat_pptk']?></u></b>
                        <?php } ?>
                    </td>
                    <?php if(!empty($pmbntu)){ ?>
                        <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>NIP. <?=$hasil['nip_pejabat_kpa']?> </td>
                    <td>
                        <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                            NIP. <?=$hasil['nip_pejabat_pptk']?>
                        <?php } ?>
                    </td>
                    <?php if(!empty($pmbntu)){ ?>
                        <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
                    <?php } ?>
                </tr>
            </table>
            <!-- <br> -->
            <!-- <table width="100%" style="font-size:9pt;font-family:arial;line-height: 1;text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td valign="top">Setuju dibayar,<br><?=ucwords(strtolower($hasil['jabatan_pejabat_pa']))?><br>Selaku PA</td>
                    
                </tr>
                <tr><td height="60px"></td></tr>
                <tr>
                    <td><b><u><?=$hasil['nama_pejabat_pa']?></u></b></td>
                    <?php if($hasil['nama_pejabat_kpa']){ ?>
                        <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_pejabat_pa']?> </td>
                    <?php if($hasil['nama_pejabat_kpa']){ ?>
                        <td style="padding-top: -3px">NIP. <?=$hasil['nip_pejabat_kpa']?></td>
                    <?php } ?>
                </tr>
            </table> -->
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