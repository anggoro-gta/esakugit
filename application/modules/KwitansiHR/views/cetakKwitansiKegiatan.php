<!doctype html>
<html>
    <head>
        <title>Kwitansi HR</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:10pt;font-family:arial;line-height: 1;">
                <tr>
                    <td width="80%">&nbsp;</td>
                    <td width="70px">No. TBP</td>
                    <td width="10px">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>NO. LPJ</td>
                    <td>:</td>
                    <td></td>
                </tr>
            </table>
            <table width="100%" style="font-size:12pt;text-align:center;font-family:arial;line-height: 1;">
                <tr>
                    <td style="font-size:16pt"><b>K W I T A N S I</b></td>
                </tr>
                <tr>
                    <td><b>TAHUN ANGGARAN <?=$hasil['tahun']?></b></td>
                </tr>
            </table>
            <br>
            <?php
                // $isKuasa = 'Kuasa '; 
                // if(empty($hasil['nama_pejabat_kpa'])){
                //     $isKuasa = '';
                // }
            ?>
            <table width="100%" style="font-size:12pt;font-family:arial;line-height: 1;">
                <tr>
                    <td width="190px">Kode Sub Kegiatan</td>
                    <td width="20px">:</td>
                    <td><?=$hasil['kode_kegiatan']?></td>
                </tr>
                <tr>
                    <td>Kode Rekening Belanja</td>
                    <td>:</td>
                    <td><?=$hasil['kode_rekening']?></td>
                </tr>
                <tr>
                    <td width="170px">Sudah terima dari</td>
                    <td width="20px">:</td>
                    <td>Kuasa Pengguna Anggaran <?=$bag->nama_bagian?> Kabupaten Kediri</td>
                </tr>
                <tr>
                    <td>Banyaknya uang</td>
                    <td>:</td>
                    <td><i>==(<?=$this->help->terbilang($total_bruto)?> Rupiah)==</i></td>
                </tr>
                <tr>
                    <td valign="top">Untuk pembayaran</td>
                    <td valign="top">:</td>
                    <td><?=$hasil['untuk_pembayaran']?>, sub kegiatan <?=$hasil['kegiatan']?> pada <?=$bag->nama_bagian?> Kabupaten Kediri,
                            <?php $widthnya='40px';
                                if($detail[0]->jabatan_kegiatan!='Narasumber'){ 
                                    $widthnya='15px';
                            ?>
                                <?php if($hasil['hr_bulan']){?>
                                    bagian bulan <?=$this->help->namaBulan($hasil['hr_bulan'])?>,
                                <?php } ?>
                            <?php } ?>
                        dengan rincian sebagai berikut :
                    </td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:9pt;font-family:arial;line-height: 1.5;" border="1" cellspacing="-1">
              <thead>
                    <tr>
                        <th width="40px">NO</th>
                        <th>NAMA</th>
                        <th>JABATAN DALAM KEGIATAN</th>
                        <th colspan="7">JUMLAH PENERIMAAN<br>(Rp.)</th>
                        <th colspan="5">PPh PS. 21<br>(Rp.)</th>
                        <th colspan="2" width="130px">JUMLAH YANG DITERIMAKAN</th>
                        <th colspan="2" width="180px">TANDA TANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td height="15px"></td>
                        <td></td>
                        <td></td>
                        <td colspan="7"></td>
                        <td colspan="5"></td>
                        <td colspan="2"></td>
                        <td class="no_border_bottom"></td>
                        <td></td>
                    </tr>
                    <?php $no=1; $grandBruto=0; $grandPajak=0; $grandDiterima=0; ?>
                    <?php foreach ($detail as $val) { ?>
                        <tr>
                            <td align="center"><?=$no?></td>
                            <td width="20%"><?=$val->nama?></td>
                            <td align="center"><?=$val->jabatan_kegiatan?></td>
                            <td width="30px" style="text-align: center" class="no_border_right">Rp.</td>
                            <?php 
                                $widthNarsum='0';
                                if($hasil['kategori']=='NARASUMBER'){ 
                                    $widthNarsum='15%';
                                }
                            ?>
                            <td align="right" class="no_border_right no_border_left" width="<?=$widthNarsum?>"> <!-- no_border_right no_border_left -->
                                <?php if($hasil['kategori']=='NARASUMBER'){ ?>
                                    <?=number_format($val->nominal_bruto,0,",",".")?>
                                    x
                                    <?=$val->persen_kali?>% =
                                <?php } ?>
                                <?=number_format($val->sub_total_bruto,0,",",".")?>                                    
                            </td>
                            <td width="15px" style="text-align: center" class="no_border_right no_border_left">x</td>
                            <td width="<?=$widthnya?>" class="no_border_right no_border_left"><?=$val->jml_kali.' '.$hasil['satuan_narsum']?></td>
                            <td width="15px" class="no_border_right no_border_left">=</td>                            
                            <td width="25px" class="no_border_right no_border_left">Rp.</td>
                                <?php $totBruto = $val->sub_total_bruto*$val->jml_kali;?>
                            <td align="right" class="no_border_left"><?=number_format($totBruto,0,",",".")?></td>
                            <td width="10px" style="text-align: center" class="no_border_right">x</td>
                            <td width="15px" style="text-align: center" class="no_border_right no_border_left"><?=$val->pajak_persen?>%</td>
                            <td width="10px" class="no_border_right no_border_left">=</td> 
                            <td width="25px" class="no_border_right no_border_left">Rp.</td>
                                <?php $totPjkPph = ($totBruto*$val->pajak_persen)/100;?>
                            <td align="right" class="no_border_left"><?=number_format($totPjkPph,0,",",".")?></td>
                            <td width="30px" style="text-align: center" class="no_border_right no_border_left">Rp.</td>
                                <?php $totDiterima = $totBruto-$totPjkPph;?>
                            <td align="right" class="no_border_left"><?=number_format($totDiterima,0,",",".")?></td>
                            <?php
                                $no1=$no.'.';
                                $no2="";
                                $btm1 = '';
                                $top1 = 'no_border_top';
                                $btm2 = 'no_border_bottom';
                                $top2 = '';
                                if($no%2==0){
                                    $no1 = "";
                                    $no2 = $no.'.';
                                    $btm1 = 'no_border_bottom';
                                    $btm2 = '';
                                    $top2 = 'no_border_top';
                                }
                            ?>
                            <td class="<?=$btm1?> <?=$top1?>"><?=$no1?></td>
                            <td class="<?=$btm2?> <?=$top2?>"><?=$no2?></td>
                        </tr>
                    <?php 
                            $no=$no+1; 
                            $grandBruto+=$totBruto;
                            $grandPajak+=$totPjkPph;
                            $grandDiterima+=$totDiterima;
                        } 
                    ?>
                    <tr>
                        <td align="center" colspan="3">Jumlah</td>
                        <td align="center" class="no_border_right" colspan="6"></td>
                        <td align="right" class="no_border_left"><?=number_format($grandBruto,0,",",".")?></td>
                        <td class="no_border_right" colspan="4"></td>
                        <td align="right" class="no_border_left"><?=number_format($grandPajak,0,",",".")?></td>
                        <td class="no_border_right"></td>
                        <td align="right" class="no_border_left"><?=number_format($grandDiterima,0,",",".")?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table width="100%" style="font-size:10pt;font-family:arial;line-height: 1;text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td width="22%"></td>
                    <td width="22%"></td>
                    <?php if(empty($pmbntu)){ ?>
                        <td width="20%">Kediri, 
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
                    <?php }else{ ?>
                        <td width="20%"></td>
                        <td width="20%">Kediri, 
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
                    <?php } ?>
                </tr>
                <tr>
                    <td>Menyetujui</td>
                    <td>
                        <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                            Mengetahui,
                        <?php } ?>
                    </td>
                    <?php if(!empty($pmbntu)){ ?>
                        <td></td>
                    <?php } ?>
                    <td>Lunas Dibayar</td>
                </tr>
                <tr>
                    <td><?=$hasil['jabatan_pejabat_kpa']?><br>Selaku KPA,</td>
                    <td>
                        <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                            PEJABAT PELAKSANA TEKNIS KEGIATAN
                        <?php } ?>
                    </td>
                    <td>BENDAHARA<br>PENGELUARAN PEMBANTU</td>
                </tr>
                <tr><td height="60px"></td></tr>
                <tr>
                    <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                    <td>
                        <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                            <b><u><?=$hasil['nama_pejabat_pptk']?></u></b>
                        <?php } ?>
                    </td>
                    <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                </tr>
                <tr>
                    <td>NIP. <?=$hasil['nip_pejabat_kpa']?></td>
                    <td>
                        <?php if(!empty($hasil['nama_pejabat_pptk'])){ ?>
                            NIP. <?=$hasil['nip_pejabat_pptk']?>
                        <?php } ?>
                    </td>
                    <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
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