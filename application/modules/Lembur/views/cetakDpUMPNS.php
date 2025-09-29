<!doctype html>
<html>
    <head>
        <title>Daftar Penerimaan Uang Makan Lembur</title>
    </head>
    <body>
        <div class="responsive">
            <!-- <table>
                <tr>
                    <td style="font-size: 9pt">No : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$hasil['singkatan_kegiatan']?>/<?=$hasil['bulan']?>/<?=$hasil['tahun']?></td>
                </tr>
            </table>
            <table width="100%" style="font-size:11pt;text-align:center;font-family:tahoma;line-height: 1;">
                <tr>
                    <td><b>DAFTAR PENERIMAAN</b></td>
                </tr>
                 <tr>
                    <td><b>UANG MAKAN LEMBUR PADA HARI KERJA DAN HARI LIBUR</b></td>
                </tr>
                 <tr>
                    <td><b>DALAM RANGKA <?=strtoupper($hasil['perihal'])?></b></td>
                </tr>                
                 <tr>
                    <td><b>KEGIATAN <?=strtoupper($hasil['kegiatan_bappeda'])?></b></td>
                </tr>
            </table> -->
            <table width="100%" style="font-size:12pt;text-align:center;font-family:tahoma;line-height: 1.2;">
                <tr>
                    <td><b>K W I T A N S I</b></td>
                </tr>
                 <tr>
                    <td><b>TAHUN ANGGARAN <?=strtoupper($hasil['tahun'])?></b></td>
                </tr>                
                 <tr>
                    <td>Nomor : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - <?='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?><?='/'.$hasil['singkatan_bagian'].'.'.$hasil['singkatan_kegiatan'].'/'?>
                        <?=!empty($hasil['bulan'])?$hasil['bulan']:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?>
                        <?='/'.$hasil['tahun']?>
                    </td>
                </tr>
            </table>
            <br>    
            <table width="100%" style="font-size:11pt;font-family:tahoma;line-height: 1.2;">
                <tr>
                    <td width="180px">Sudah Terima Dari</td>
                    <td width="20px">:</td>
                    <?php
                        $isKuasa = 'Kuasa '; 
                        if(empty($hasil['nama_pejabat_kpa'])){
                            $isKuasa = '';
                        }
                    ?>
                    <td><?=$isKuasa?> Pengguna Anggaran Bappeda Kabupaten Kediri</td>
                </tr>
                <tr>
                    <td>Banyaknya uang</td>
                    <td>:</td>
                    <td>== <?=$this->help->terbilang($nilaiUang)?> Rupiah ==</td>
                </tr>
                <tr>
                    <td valign="top">Untuk Pembayaran</td>
                    <td valign="top">:</td>
                    <td valign="top" align="justify">
                        <?=$untPmbyrn.$hasil['perihal']?>, kegiatan <?=$hasil['kegiatan_bappeda']?>, pada tanggal 
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
                        ?>
                    </td>
                </tr>
            </table>
            <br>            
            <table width="100%" class="bordersolid" style="font-size:10pt;font-family:tahoma;line-height: 3;" border="1" cellspacing="-1">
                <thead>
                    <tr>
                        <th rowspan="3" width="40px">No.</th>
                        <th rowspan="3" width="225px">Nama</th>
                        <th rowspan="3" width="50px">Gol</th>
                        <th colspan="4">Rincian Penerimaan</th>
                        <th colspan="4">Rincian Penerimaan</th>
                        <th rowspan="3" width="90px">TOTAL</th>
                        <th rowspan="3" width="90px">Potongan<br>PPh21</th>
                        <th rowspan="3" width="90px">Jumlah yang<br>Diterimakan</th>
                        <th rowspan="3" width="130px">Tanda Tangan</th>
                    </tr>
                    <tr>
                        <th colspan="4">Hari Kerja</th>
                        <th colspan="4">Hari Libur</th>
                    </tr>
                    <tr>
                        <th width="55px">O/J</th>
                        <th width="45px">JML<br>HARI</th>
                        <th width="45px">JML<br>MKN</th>
                        <th width="75px">JUMLAH</th>
                        <th width="55px">O/J</th>
                        <th width="45px">JML<br>HARI</th>
                        <th width="45px">JML<br>MKN</th>
                        <th width="75px">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($detail as $val) { ?>
                        <tr>
                            <td align="center"><?=$no.'.'?></td>
                            <td><?=$val['nama_sdm']?></td>
                            <td align="center"><?=$val['golongan']?></td>
                            <?php
                                $jmlHriKrjanya=''; $jmlHriKrjanya2=''; 
                                $uangMkn='-'; $jmlHari='-'; $jmlMkn='-'; $jmlHriKrja='-'; $jmlHriKrjanya=0;
                                foreach ($groupDetail[$val['fk_sdm_id']] as $val2) {
                                    if($val2->is_libur=='Tidak'){
                                        $uangMkn=number_format($val2->uang_makan);
                                        $jmlHari=$val2->jml_hari;
                                        $jmlMkn=$val2->jml_makan;
                                        $jmlHriKrjanya=$val2->jumlah;
                                        $jmlHriKrja=number_format($jmlHriKrjanya);
                                    }
                                }
                            ?>
                            <td align="right"><?=$uangMkn?></td>
                            <td align="center"><?=$jmlHari?></td>
                            <td align="center"><?=$jmlMkn?></td>
                            <td align="right"><?=$jmlHriKrja?></td>
                            <?php
                                $uangMkn2='-'; $jmlHari2='-'; $jmlMkn2='-'; $jmlHriKrja2='-'; $jmlHriKrjanya2=0;
                                foreach ($groupDetail[$val['fk_sdm_id']] as $val3) {
                                    if($val3->is_libur=='Ya'){
                                        $uangMkn2=number_format($val3->uang_makan);
                                        $jmlHari2=$val3->jml_hari;
                                        $jmlMkn2=$val3->jml_makan;
                                        $jmlHriKrjanya2=$val3->jumlah;
                                        $jmlHriKrja2=number_format($jmlHriKrjanya2);
                                    }
                                }
                            ?>
                            <td align="right"><?=$uangMkn2?></td>
                            <td align="center"><?=$jmlHari2?></td>
                            <td align="center"><?=$jmlMkn2?></td>
                            <td align="right"><?=$jmlHriKrja2?></td>
                            <?php
                                $total = $jmlHriKrjanya+$jmlHriKrjanya2;
                                $potPPh = ($total*$val['pph21'])/100;
                                $jmlDtrma = $total-$potPPh;
                            ?>
                            <td align="right"><?=number_format($total)?></td>
                            <td align="right"><?=number_format($potPPh)?></td>
                            <td align="right"><?=number_format($jmlDtrma)?></td>
                            <?php
                                $algn = '';
                                if($no%2==0){
                                    $algn = "center";
                                }
                            ?>
                            <td style="text-align: <?=$algn?>"><?=$no?>.</td>
                        </tr>
                    <?php 
                            $no++;                             
                            $totJmlHriKrjanya += $jmlHriKrjanya;
                            $totJmlHriKrjanya2 += $jmlHriKrjanya2;
                            $totalSemua = $totJmlHriKrjanya+$totJmlHriKrjanya2;
                            $totPotPph += $potPPh;
                            $totJmlDtrma += $jmlDtrma;
                        } 
                    ?>
                    <tr>
                        <td></td>
                        <td colspan="5" align="center"><b>TOTAL</b></td>
                        <td align="right"><b><?=number_format($totJmlHriKrjanya)?></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="right"><b><?=number_format($totJmlHriKrjanya2)?></b></td>
                        <td align="right"><b><?=number_format($totalSemua)?></b></td>
                        <td align="right"><b><?=number_format($totPotPph)?></b></td>
                        <td align="right"><b><?=number_format($totJmlDtrma)?></b></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <?php if($hasil['fk_bagian_id']==1){ ?> <!-- sekretariat -->
                <table width="100%" style="font-size:10pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                    <tr>
                        <td valign="bottom"></td>
                        <td valign="bottom"></td>
                        <td valign="bottom"></td>
                        <td valign="bottom">Kediri, 
                             <?php $tglPs = explode('-', $hasil['tgl_kegiatan_sampai']);
                            echo $tglPs[2].' '.$this->help->namaBulan($tglPs[1]).' '.$tglPs[0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="bottom" width="200px">Mengetahui / Menyetujui</td>
                        <td valign="bottom" width="200px">Menyetujui</td>
                        <td valign="bottom" width="200px">Mengetahui</td>
                        <td valign="bottom" width="200px">Lunas Dibayar</td>
                    </tr>                    
                    <tr>
                        <td valign="top"><?=$isKuasa?> Pengguna Anggaran</td>
                        <td valign="top">PPTK</td>
                        <td valign="top">Bendahara Pengeluaran</td>
                        <td valign="top">Bendahara Pengeluaran Pembantu</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td height="55px"></td>
                    </tr>
                    <tr>
                        <td><b><u><?=$hasil['nama_pejabat_pa']?></u></b></td>
                        <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                        <td><b><u><?=$hasil['nama_bendahara']?></u></b></td>
                        <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                    </tr>
                    <tr>
                        <td>NIP. <?=$hasil['nip_pejabat_pa']?></td>
                        <td>NIP. <?=$hasil['nip_pejabat_pptk']?></td>
                        <td>NIP. <?=$hasil['nip_bendahara']?></td>
                        <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
                    </tr>
                </table> 
            <?php } else { ?>
                <table width="100%" style="font-size:10pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                    <tr>
                        <td valign="bottom"></td>
                        <td valign="bottom"></td>
                        <td valign="bottom"></td>
                        <td valign="bottom"></td>
                        <td valign="bottom">Kediri, 
                             <?php $tglPs = explode('-', $hasil['tgl_kegiatan_sampai']);
                            echo $tglPs[2].' '.$this->help->namaBulan($tglPs[1]).' '.$tglPs[0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="bottom" width="200px">Mengetahui</td>
                        <td valign="bottom" width="200px">Menyetujui</td>
                        <td valign="bottom" width="200px">Menyetujui</td>
                        <td valign="bottom" width="200px">Mengetahui</td>
                        <td valign="bottom" width="200px">Lunas Dibayar</td>
                    </tr>                    
                    <tr>
                        <td valign="top">Pengguna Anggaran</td>
                        <td valign="top">Kuasa Pengguna Anggaran</td>
                        <td valign="top">PPTK</td>
                        <td valign="top">Bendahara Pengeluaran</td>
                        <td valign="top">Bendahara Pengeluaran Pembantu</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td height="55px"></td>
                    </tr>
                    <tr>
                        <td><b><u><?=$hasil['nama_pejabat_pa']?></u></b></td>
                        <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                        <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                        <td><b><u><?=$hasil['nama_bendahara']?></u></b></td>
                        <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                    </tr>
                    <tr>
                        <td>NIP. <?=$hasil['nip_pejabat_pa']?></td>
                        <td>NIP. <?=$hasil['nip_pejabat_kpa']?></td>
                        <td>NIP. <?=$hasil['nip_pejabat_pptk']?></td>
                        <td>NIP. <?=$hasil['nip_bendahara']?></td>
                        <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
                    </tr>
                </table>
            <?php } ?>
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
.border_bottom{
    border-bottom: 1px solid black;
}
.bordersolid{
    border: 1px solid black; border-collapse: collapse;
}
</style>