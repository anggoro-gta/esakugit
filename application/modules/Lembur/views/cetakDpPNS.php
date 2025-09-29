<!doctype html>
<html>
    <head>
        <title>Daftar Penerimaan Uang Lembur</title>
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
                    <td><b>UANG LEMBUR PADA HARI KERJA DAN HARI LIBUR</b></td>
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
            <table width="100%" class="bordersolid" style="font-size:10pt;font-family:tahoma;line-height: 2;" border="1" cellspacing="-1">
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
                        <th width="45px">JAM</th>
                        <th width="75px">JUMLAH</th>
                        <th width="55px">O/J</th>
                        <th width="45px">JML<br>HARI</th>
                        <th width="45px">JAM</th>
                        <th width="75px">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ((array)$detail as $val) { ?>
                        <?php
                            $nama=''; $subTot = 0; $subPph = 0; $subDiterima = 0;
                            foreach ($groupDetail[$val['fk_sdm_id']] as $val2) {
                                $tarifnya='-'; $jmlHari='-'; $jmlJam='-'; $jmlHriKrja='-'; $jmlHriKrjanya=0;
                                $jmlRow = count($groupDetail[$val['fk_sdm_id']]);
                                if($val2->is_libur=='Tidak'){
                                    $tarifnya=number_format($val2->tarif);
                                    $jmlHari=$val2->jml_hari;
                                    $jmlJam=$val2->jml_jam;
                                    $jmlHriKrjanya=$val2->tarif*$jmlHari*$jmlJam;
                                    $jmlHriKrja=number_format($jmlHriKrjanya);
                                }
                        ?>
                            <tr>
                                <?php if($nama!=$val['nama_sdm']){ ?>
                                    <td rowspan="<?=$jmlRow?>" align="center"><?=$no.'.'?></td>
                                    <td rowspan="<?=$jmlRow?>"><?=$val['nama_sdm']?></td>
                                    <td rowspan="<?=$jmlRow?>" align="center"><?=$val['golongan']?></td>
                                <?php } ?>
                                <td align="right"><?=$tarifnya?></td>
                                <td align="center"><?=$jmlHari?></td>
                                <td align="center"><?=$jmlJam?></td>
                                <td align="right"><?=$jmlHriKrja?></td>
                                <?php
                                    $tarifnya2='-'; $jmlHari2='-'; $jmlJam2='-'; $jmlHriKrja2='-'; $jmlHriKrjanya2=0;
                                    if($val2->is_libur=='Ya'){
                                        $tarifnya2=number_format($val2->tarif);
                                        $jmlHari2=$val2->jml_hari;
                                        $jmlJam2=$val2->jml_jam;
                                        $jmlHriKrjanya2=$val2->tarif*$jmlHari2*$jmlJam2;
                                        $jmlHriKrja2=number_format($jmlHriKrjanya2);
                                    }
                                ?>
                                <td align="right"><?=$tarifnya2?></td>
                                <td align="center"><?=$jmlHari2?></td>
                                <td align="center"><?=$jmlJam2?></td>
                                <td align="right"><?=$jmlHriKrja2?></td>
                                <?php
                                    $total = $jmlHriKrjanya+$jmlHriKrjanya2;
                                    $potPPh = ($total*$val['pph21'])/100;
                                    $jmlDtrma = $total-$potPPh;
                                    $subTot += $total;
                                    $grandTot += $total;
                                    $subPph += $potPPh;
                                    $grandPph += $potPPh;
                                    $subDiterima += $jmlDtrma;
                                    $grandDiterima += $jmlDtrma;

                                ?>
                                <td align="right"><?=number_format($total)?></td>
                                <td align="right"><?=number_format($potPPh)?></td>
                                <td align="right"><?=number_format($jmlDtrma)?></td>
                                <td class="no_border_bottom no_border_top"></td>
                            </tr>
                            <?php  
                                    $nama=$val['nama_sdm'];
                                }
                            ?>
                            <tr>
                                <td></td>
                                <td colspan="10" align="right"><b>Sub TOTAL</b> &nbsp;</td>
                                <td align="right"><b><?=number_format($subTot)?></b></td>
                                <td align="right"><b><?=number_format($subPph)?></b></td>
                                <td align="right"><b><?=number_format($subDiterima)?></b></td>
                                <?php
                                    // $noUrt = $no.'.';
                                    // if($no%2==0){
                                    //     $noUrt = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$no.'.';
                                    // }
                                ?>
                                <td class="no_border_top"><?=$no?>.</td>
                            </tr>
                            <?php 
                                $no++;
                            } ?>
                        <tr>
                            <td></td>
                            <td colspan="10" align="center"><b>GRAND TOTAL</b></td>
                            <td align="right"><b><?=number_format($grandTot)?></b></td>
                           <td align="right"><b><?=number_format($grandPph)?></b></td>
                            <td align="right"><b><?=number_format($grandDiterima)?></b></td>
                            <td></td>
                        </tr>
                </tbody>
            </table>
            <br>
           <!--  <table width="100%" style="font-size:11pt;line-height: 1;font-family:tahoma; text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td width="35%">Mengetahui/Menyetujui</td>
                    <td width="35%"></td>
                    <td width="35%">Lunas Dibayar</td>
                </tr>
                <?php
                    $jbtnKPA = $hasil['jabatan_pejabat_kpa'];
                    $namaKPA = $hasil['nama_pejabat_kpa'];
                    $nipKPA = $hasil['nip_pejabat_kpa'];
                    $meng = 'Kuasa Pengguna Anggaran';
                    if(empty($hasil['nama_pejabat_kpa'])){
                        $jbtnKPA = $hasil['jabatan_penandatangan_st'];
                        $namaKPA = $hasil['nama_penandatangan_st'];
                        $nipKPA = $hasil['nip_penandatangan_st'];
                        $meng = 'Pengguna Anggaran';
                    }
                ?>
                <tr>
                    <td><?=$meng?></td>
                    <td>Pejabat Pelaksana Teknis Kegiatan</td>
                    <td>Bendahara Pengeluaran Pembantu</td>
                </tr>
                <tr>
                    <td height="70px">&nbsp;</td>
                </tr>
                <tr>
                    <td><b><u><?=$namaKPA?></u></b></td>
                    <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                    <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                </tr>
                <tr>
                    <td>NIP. <?=$nipKPA?></td>
                    <td>NIP. <?=$hasil['nip_pejabat_pptk']?></td>
                    <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
                </tr>
            </table> -->
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
                <!-- <table width="100%" style="font-size:10pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                    <tr>
                        <td valign="bottom">Menyetujui</td>
                        <td valign="bottom">Menyetujui</td>
                        <td valign="bottom" align="left">LUNAS DIBAYAR<br>Tgl: ........................... </td>
                        <td valign="bottom" width="180px">Kediri, 
                             <?php $tglPs = explode('-', $hasil['tgl_kegiatan_sampai']);
                            echo $tglPs[2].' '.$this->help->namaBulan($tglPs[1]).' '.$tglPs[0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><?=$hasil['jabatan_pejabat_kpa']?></td>
                        <td valign="top">PPTK</td>
                        <td valign="top">Bendahara<br>Pengeluaran Pembantu</td>
                        <td valign="top">Penerima</td>
                    </tr>
                    <tr><td height="55px" colspan="3"></td></tr>
                    <tr>
                        <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                        <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                        <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                        <td><b><u><?=$pnrmNama[$i]?></u></b></td>
                    </tr>
                    <tr>
                        <td>NIP. <?=$hasil['nip_pejabat_kpa']?>&nbsp;</td>
                        <td>NIP. <?=$hasil['nip_pejabat_pptk']?>&nbsp;</td>
                        <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
                        <td><?=$pnrmNIP[$i]?></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="2" valign="bottom">Mengetahui</td>
                        <td colspan="2" valign="bottom">Mengetahui</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?=$hasil['jabatan_pejabat_pa']?></td>
                        <td colspan="2" valign="top">Bendahara Pengeluaran</td>
                    </tr>
                    <tr>
                        <td colspan="2" valign="bottom">Selaku PA,</td>
                        <td colspan="2" valign="bottom"></td>
                    </tr>
                    <tr><td height="55px" colspan="3"></td></tr>
                    <tr>
                        <td colspan="2"><b><u><?=$hasil['nama_pejabat_pa']?></u></b></td>
                        <td colspan="2"><b><u><?=$hasil['nama_bendahara']?></u></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">NIP. <?=$hasil['nip_pejabat_pa']?></td>
                        <td colspan="2">NIP. <?=$hasil['nip_bendahara']?>&nbsp;</td>
                    </tr>
                </table> --> 
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
.no_border_bottom{
    border-bottom: 0px solid #000;
}
.bordersolid{
    border: 1px solid black; border-collapse: collapse;
}
</style>