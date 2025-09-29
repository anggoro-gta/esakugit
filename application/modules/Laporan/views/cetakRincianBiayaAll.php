<!doctype html>
<html>
    <head>
        <title>Rincian Biaya Perjalanan Dinas</title>
    </head>
    <body>
        <?php foreach ($hasil as $hsl) : ?>
            <?php
                $bndhrPmbntu=' Pembantu';
                if($hsl['fk_bagian_id']==5 && strtotime($hsl['tgl_surat_tugas']) >= strtotime(date('2019-02-01'))){ //sementara utk Bagian ANDAT per bln Feb 2019
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
                    <tr>
                        <td width="200px">LAMPIRAN SPT NOMOR</td>
                        <td width="10px">:</td>
                        <td>094/<?=$hsl['no_surat_tugas']?>/418.54/<?=$hsl['tahun']?></td>
                    </tr>
                    <tr>
                        <td>TANGGAL</td>
                        <td>:</td>
                        <td><?php $tglST = explode('-', $hsl['tgl_surat_tugas']);
                            echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]; ?>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Tujuan</td>
                        <td>:</td>
                        <td><?=$hsl['kategori']=='DL'?ucwords(strtolower($hsl['kota'])).' ('.$hsl['tujuan_skpd'].')':$hsl['tujuan_skpd']?></td>
                    </tr> -->
                    <tr><td></td></tr>
                </table>
                <table width="100%" style="font-size:9pt;font-family:arial;line-height: 1.3;" border="1" cellspacing="-1">
                    <tr>
                        <td rowspan="2" width="30px" align="center">No.</td>
                        <td rowspan="2" width="" align="center">NAMA</td>
                        <td rowspan="2" width="" align="center">ESELON/<br>GOLONGAN</td>
                        <td rowspan="2" width="" align="center">JUMLAH HARI</td>
                        <td width="" align="center" colspan="7">RINCIAN BIAYA PERJALANAN DINAS</td>
                        <td rowspan="2" width="" align="center">TANDA TANGAN</td>
                    </tr>
                    <tr>
                        <td align="center">Uang Harian</td>
                        <td align="center">Persen</td>
                        <td align="center">Uang Representasi</td>
                        <td align="center">Biaya/Sewa Penginapan</td>
                        <td align="center">Biaya Transpor</td>
                        <td align="center">Biaya<br>lain-lain</td>
                        <td align="center">Jumlah</td>
                    </tr>
                    <?php $grandTotal=0; $no=1; foreach ($detailAll[$hsl['id']] as $key => $dtl) {
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
                            <td class="no_border_bottom" valign="top" align="center">
                                <?php foreach ($dtl as $dt2) : ?>
                                    <?=$dt2['persen']?>%<br>
                                <?php endforeach; ?>
                            </td>
                            <td class="no_border_bottom" valign="top" align="right">
                                <?php foreach ($dtl as $dt2) : ?>
                                    <?=!empty($dt2['representasi'])?number_format($dt2['representasi']):''?><br>
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
                                <!-- <?php foreach ($dtl as $dt2) : ?>
                                    <?=!empty($dt2['kontribusi'])?number_format($dt2['kontribusi']):''?><br>
                                <?php endforeach; ?> -->
                            </td>
                            <td class="no_border_bottom" class="no_border_bottom" valign="top" align="right">
                                <?php foreach ($dtl as $dt2) : 
                                    $total = (($dt2['tarif']*$dt2['hari']*$dt2['persen'])/100)+($dt2['representasi']*$dt2['hari'])+$dt2['penginapan']+$dt2['transport'];

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
                            <td class="no_border_top"></td>
                            <td colspan="6" align="right">Sub Total &nbsp; </td>
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
                        <td><b><?=number_format($grandTotal)?></b></td>
                        <td></td>
                    </tr>                
                </table>
                <br>
                <table width="100%" style="font-size:9pt;font-family:arial;line-height: 1.3;text-align: center" border="0" cellspacing="-1">
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>Kediri, <?php $tglST = explode('-', $hsl['tgl_rincian']);
                            echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Bendahara<br>Pengeluaran</td>
                        <td valign="top">PPTK</td>
                        <td valign="top">Bendahara<br>Pengeluaran Pembantu</td>
                    </tr>
                    <tr><td height="60px" colspan="2"></td></tr>
                    <tr>
                        <td><b><u><?=$hsl['nama_bendahara']?></u></b></td>
                        <td><b><u><?=$hsl['nama_pejabat_pptk']?></u></b></td>
                        <td><b><u><?=$hsl['nama_bendahara_pembantu']?></u></b></td>
                    </tr>
                    <tr>
                        <td style="padding-top: -3px">NIP. <?=$hsl['nip_bendahara']?></td>
                        <td style="padding-top: -3px">NIP. <?=$hsl['nip_pejabat_pptk']?></td>
                        <td style="padding-top: -3px">NIP. <?=$hsl['nip_bendahara_pembantu']?></td>
                    </tr>
                </table>
                <br>
                <table width="100%" style="font-size:9pt;font-family:arial;line-height: 1.3;text-align: center" border="0" cellspacing="-1">
                    <tr>
                        <td valign="top">Setuju dibayar,<br><?=ucwords(strtolower($hsl['jabatan_pejabat_pa']))?><br>Selaku PA</td>
                        <?php if($hsl['nama_pejabat_kpa']){ ?>
                            <td valign="top">Setuju dibayar,<br>KPA</td>
                        <?php } ?>
                    </tr>
                    <tr><td height="60px"></td></tr>
                    <tr>
                        <td><b><u><?=$hsl['nama_pejabat_pa']?></u></b></td>
                        <?php if($hsl['nama_pejabat_kpa']){ ?>
                            <td><b><u><?=$hsl['nama_pejabat_kpa']?></u></b></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td style="padding-top: -3px">NIP. <?=$hsl['nip_pejabat_pa']?> </td>
                        <?php if($hsl['nama_pejabat_kpa']){ ?>
                            <td style="padding-top: -3px">NIP. <?=$hsl['nip_pejabat_kpa']?></td>
                        <?php } ?>
                    </tr>
                </table>
            </div>
            <pagebreak>
        <?php endforeach; ?>
    </body>
</html>