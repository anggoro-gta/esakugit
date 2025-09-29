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
                    <td>Sudah terima dari</td>
                    <td>:</td>
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
                    <td><?=$hasil['untuk_pembayaran']?>, sub kegiatan <?=$hasil['kegiatan']?> pada <?=$bag->nama_bagian?> Kabupaten Kediri, bagian bulan <?=$this->help->namaBulan($hasil['hr_bulan'])?>, dengan rincian sebagai berikut :
                    </td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:9pt;font-family:arial;line-height: 1.5;" border="1" cellspacing="-1">
              <thead>
                    <tr>
                        <th rowspan="3" width="30px">NO</th>
                        <th rowspan="3">NAMA</th>
                        <th colspan="5">JUMLAH PENERIMAAN</th>
                        <th colspan="5">JUMLAH PENGELUARAN</th>
                        <th rowspan="2">JUMLAH YANG<br>DITERIMAKAN</th>
                        <th rowspan="3" colspan="2" width="160px">TANDA TANGAN</th>
                    </tr>
                    <tr>
                        <th>HR KONTRAK</th>
                        <th>BPJS KES<br>PEMKAB (4%)</th>
                        <th>JKK (0,24%)</th>
                        <th>JKM (0,30%)</th>
                        <th>PENGHASILAN<br>KOTOR</th>
                        <th>BPJS KES<br>PEMKAB (4%)</th>
                        <th>BPJS KES<br>PESERTA (1%)</th>
                        <th>JKK (0,24%)</th>
                        <th>JKM (0,30%)</th>
                        <th>JUMLAH</th>
                    </tr>

                    <tr>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                        <th>(Rp.)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td height="15px"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="no_border_bottom"></td>
                        <td></td>
                    </tr>
                    <?php $no=1; $grandBruto=0; $grandBpjsKesPemkab=0; $grandBpjsKrjJKK=0; $grandBpjsKrjJKM=0; $grandBpjsKesPsrta=0; $grandHslanKtor=0; $grandJmlPngluaran=0; $grandJmlTrma=0; ?>
                    <?php foreach ($detail as $val) { ?>
                        <tr>
                            <td align="center"><?=$no?></td>
                            <td width="14%"><?=$val->nama?></td>
                            <td align="right"><?=number_format($val->nominal_bruto,2,",",".")?></td>        
                            <td align="right"><?=number_format($val->bpjs_kes_pemkab,2,",",".")?></td>        
                            <td align="right"><?=number_format($val->bpjs_krj_jkk,2,",",".")?></td>        
                            <td align="right"><?=number_format($val->bpjs_krj_jkm,2,",",".")?></td>        
                            <td align="right"><?=number_format($val->penghasilan_kotor,2,",",".")?></td>        
                            <td align="right"><?=number_format($val->bpjs_kes_pemkab,2,",",".")?></td>         
                            <td align="right"><?=number_format($val->bpjs_kes_peserta,2,",",".")?></td>        
                            <td align="right"><?=number_format($val->bpjs_krj_jkk,2,",",".")?></td>        
                            <td align="right"><?=number_format($val->bpjs_krj_jkm,2,",",".")?></td>       
                            <td align="right"><?=number_format($val->jml_pengeluaran,2,",",".")?></td>        
                            <td align="right"><?=number_format($val->jml_diterima,2,",",".")?></td>  
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
                            $grandBruto+=$val->nominal_bruto;
                            $grandBpjsKesPemkab+=$val->bpjs_kes_pemkab;
                            $grandBpjsKrjJKK+=$val->bpjs_krj_jkk;
                            $grandBpjsKrjJKM+=$val->bpjs_krj_jkm;
                            $grandHslanKtor+=$val->penghasilan_kotor;
                            $grandBpjsKesPsrta+=$val->bpjs_kes_peserta;
                            $grandJmlPngluaran+=$val->jml_pengeluaran;
                            $grandJmlTrma+=$val->jml_diterima;
                        } 
                    ?>
                    <tr>
                        <td align="center" colspan="2">Jumlah</td>
                        <td align="right" class="no_border_left"><?=number_format($grandBruto,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandBpjsKesPemkab,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandBpjsKrjJKK,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandBpjsKrjJKM,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandHslanKtor,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandBpjsKesPemkab,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandBpjsKesPsrta,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandBpjsKrjJKK,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandBpjsKrjJKM,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandJmlPngluaran,2,",",".")?></td>
                        <td align="right" class="no_border_left"><?=number_format($grandJmlTrma,2,",",".")?></td>
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