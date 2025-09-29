<!doctype html>
<html>
    <head>
        <title>Rekap <?=$$title?></title>
    </head>
    <body>
        <div class="responsive">
            <table width="35%" style="font-size:9pt;font-family:Tahoma, sans-serif;line-height: 1;" border="1" class="bordersolid" cellspacing="-1">
                <tr>
                    <td width="115px">&nbsp;No. Kwitansi</td>
                    <td width="7px" class="no_border_right"></td>
                    <td class="no_border_left"><?=$info_no_bku.' / '.$hasil->singkat_keg.' / '.$hasil->spj_bulan.' / '.$hasil->tahun?></td>
                </tr>
                <tr>
                    <td>&nbsp;Kode Sub Keg-Rek.</td>
                    <td class="no_border_right"></td>
                    <td class="no_border_left"><?=$hasil->kode_rek_belanja?></td>
                </tr>
                <tr>
                    <td valign="top">&nbsp;Uraian</td>
                    <td class="no_border_right"></td>
                    <td class="no_border_left"><?=$hasil->nama_rek_belanja?></td>
                </tr>
            </table>
            <br>
           <table width="100%" style="font-size:13pt;font-family:Tahoma, sans-serif;line-height: 1;text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td><b>REKAPITULASI <?=strtoupper($hasil->nama_rek_belanja)?></b></td>
                </tr>
                <tr>
                    <td><b>SUB KEGIATAN <?=strtoupper($hasil->kegiatan)?></b></td>
                </tr>
                <tr>
                    <td><b><?=$bag->nama_bagian?> KABUPATEN KEDIRI TAHUN ANGGARAN <?=$hasil->tahun?></b></td>
                </tr>
           </table>
           <br>
           <table width="27%" style="font-size:10pt;font-family:Tahoma, sans-serif;line-height: 1.2;" border="0" cellspacing="-1">
                <tr>
                    <td width="130px">Jumlah Dana</td>
                    <td width="10px">:</td>
                    <td width="20px">Rp.</td>
                    <td width="85px" align="right"><?=number_format($hasil->jml_dana,2,",",".")?></td>
                </tr>
                <tr>
                    <td>Pengajuan sebelumnya</td>
                    <td>:</td>
                    <td>Rp.</td>
                    <td align="right"><?=number_format($hasil->pengajuan_sebelum,2,",",".")?></td>
                </tr>
                <tr>
                    <td>Pengajuan sekarang</td>
                    <td>:</td>
                    <td>Rp.</td>
                    <td align="right" class="border_bottom"><?=number_format($hasil->pengajuan_sekarang,2,",",".")?></td>
                </tr>
                <tr>
                    <td>Sisa Dana</td>
                    <td>:</td>
                    <td>Rp.</td>
                    <td align="right"><?=number_format($hasil->sisa_kas,2,",",".")?></td>
                </tr>
           </table>
           <br>
           <table width="100%" style="font-size:10pt;font-family:Tahoma, sans-serif;line-height: 1.2;" border="1" class="bordersolid" cellspacing="-1">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th colspan="2">TANGGAL</th>
                        <th rowspan="2">NOMOR KWITANSI</th>
                        <th rowspan="2">URAIAN</th>
                        <th colspan="2">PENERIMAAN</th>
                        <th colspan="2">PENGELUARAN</th>
                    </tr>
                    <tr>
                        <th>SESUAI<br>RENCANA</th>
                        <th>LUNAS<br>DIBAYAR</th>
                        <th>KEGIATAN<br>(Rp)</th>
                        <th>PAJAK<br>(Rp)</th>
                        <th>KEGIATAN<br>(Rp)</th>
                        <th>PAJAK<br>(Rp)</th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td width="100px"></td>
                        <td width="100px"></td>
                        <td width="280px"></td>
                        <td></td>
                        <td align="right"><?=number_format($hasil->pengajuan_sekarang,2,",",".")?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>                    
                    <?php $no=1; $totPajak=''; $pjakSblm='';?>
                    <?php foreach ($detail as $val) { ?>
                        <tr>
                            <td valign="top" align="center" width="30px"><?=$no?></td>
                            <td valign="top" align="center"><?php
                                $tgl=explode('-', $val->tgl_kwitansi);
                                echo $tgl[2].' '.$this->help->singkatanBulan($tgl[1]).' '.$tgl[0];
                            ?></td>
                            <td valign="top" align="center"><?php
                                $tglR=explode('-', $tgl_rekap);
                                echo $tglR[0].' '.$this->help->singkatanBulan($tglR[1]).' '.$tglR[2];
                            ?></td>
                            <td valign="top" align="center"><?=$hasil->no_bku.' / '.$hasil->no_bku.' - '.$val->no_kwitansi_rekap.' / '.$hasil->singkat_keg.' / '.$hasil->spj_bulan.' / '.$hasil->tahun?></td>
                            <td valign="top"><?=$val->untuk_pembayaran?></td>
                            <td></td>
                            <td></td>
                            <td valign="top" align="right"><?=number_format($val->tot_bruto,2,",",".")?></td>
                            <td></td>
                        </tr>
                        <?php if($hasil->kategori=='KONTRAK'){ ?>
                            <tr> 
                                <?php $no_nya = $no+1; ?>
                                <td align="center"><?=$no_nya?></td>  
                                <td align="center"><?=$tgl[2].' '.$this->help->singkatanBulan($tgl[1]).' '.$tgl[0];?></td>  
                                <td></td>                            
                                <td></td>                            
                                <td>Tunjangan BPJS Kesehatan (4%)</td>
                                <td></td>
                                <td align="right"><?=number_format($val->tot_bpjs_kes_pemkab,2,",",".")?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <?php $no_nya = $no_nya+1; ?>
                                <td align="center"><?=$no_nya?></td>  
                                <td align="center"><?=$tgl[2].' '.$this->help->singkatanBulan($tgl[1]).' '.$tgl[0];?></td>  
                                <td></td>                            
                                <td></td>                            
                                <td>Diterima Potongan BPJS Kesehatan (1%) </td>
                                <td></td>
                                <td align="right"><?=number_format($val->tot_bpjs_kes_peserta,2,",",".")?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <?php $no_nya = $no_nya+1; ?>
                                <td align="center"><?=$no_nya?></td>  
                                <td align="center"><?=$tgl[2].' '.$this->help->singkatanBulan($tgl[1]).' '.$tgl[0];?></td>  
                                <td></td>                            
                                <td></td>                            
                                <td>Tunjangan BPJS Ketenagakerjaan JKK (0,24%) </td>
                                <td></td>
                                <td align="right"><?=number_format($val->tot_bpjs_krj_jkk,2,",",".")?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <?php $no_nya = $no_nya+1; ?>
                                <td align="center"><?=$no_nya?></td>  
                                <td align="center"><?=$tgl[2].' '.$this->help->singkatanBulan($tgl[1]).' '.$tgl[0];?></td>  
                                <td></td>                            
                                <td></td>                            
                                <td>Tunjangan BPJS Ketenagakerjaan JKM (0,30%) </td>
                                <td></td>
                                <td align="right"><?=number_format($val->tot_bpjs_krj_jkm,2,",",".")?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr> 
                                <?php $no_nya = $no_nya+1; ?>
                                <td align="center"><?=$no_nya?></td>  
                                <td></td>                            
                                <td align="center"><?=$tglR[0].' '.$this->help->singkatanBulan($tglR[1]).' '.$tglR[2];?></td>  
                                <td></td>                            
                                <td>Dibayarkan Tunjangan BPJS Kesehatan (4%)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right"><?=number_format($val->tot_bpjs_kes_pemkab,2,",",".")?></td>
                            </tr>
                            <tr>
                                <?php $no_nya = $no_nya+1; ?>
                                <td align="center"><?=$no_nya?></td>  
                                <td></td>                            
                                <td align="center"><?=$tglR[0].' '.$this->help->singkatanBulan($tglR[1]).' '.$tglR[2];?></td> 
                                <td></td>                            
                                <td>Dibayarkan Tunjangan BPJS Kesehatan (1%)  </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right"><?=number_format($val->tot_bpjs_kes_peserta,2,",",".")?></td>
                            </tr>
                            <tr>
                                <?php $no_nya = $no_nya+1; ?>
                                <td align="center"><?=$no_nya?></td>  
                                <td></td>                            
                                <td align="center"><?=$tglR[0].' '.$this->help->singkatanBulan($tglR[1]).' '.$tglR[2];?></td> 
                                <td></td>                            
                                <td>Dibayarkan Tunjangan BPJS Ketenagakerjaan JKK (0,24%)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right"><?=number_format($val->tot_bpjs_krj_jkk,2,",",".")?></td>
                            </tr>
                            <tr>
                                <?php $no_nya = $no_nya+1; ?>
                                <td align="center"><?=$no_nya?></td>  
                                <td></td>                            
                                <td align="center"><?=$tglR[0].' '.$this->help->singkatanBulan($tglR[1]).' '.$tglR[2];?></td> 
                                <td></td>                            
                                <td>Dibayarkan Tunjangan BPJS Ketenagakerjaan JKM (0,30%)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right"><?=number_format($val->tot_bpjs_krj_jkm,2,",",".")?></td>
                            </tr>
                            <?php $totPajak += ($val->tot_bpjs_kes_pemkab+$val->tot_bpjs_kes_peserta+$val->tot_bpjs_krj_jkk+$val->tot_bpjs_krj_jkm); $pjakSblm = $hasil->pajak_bpjs;?>

                        <?php } else{  ?> <!-- KEGIATAN/NARASUMBER -->
                            <tr> 
                                <?php $no_nya = $no+1; ?>
                                <td align="center"><?=$no_nya?></td>  
                                <td align="center"><?=$tgl[2].' '.$this->help->singkatanBulan($tgl[1]).' '.$tgl[0];?></td>  
                                <td></td>                            
                                <td></td>                            
                                <td>Diterima PPh 21 atas belanja HR</td>
                                <td></td>
                                <td align="right"><?=number_format($val->tot_pajak_kegiatan,2,",",".")?></td>
                                <td></td>
                                <td></td>
                            </tr>                            
                            <?php $totPajak += ($val->tot_pajak_kegiatan); $pjakSblm = $hasil->pajak_kegiatan; ?>
                        <?php } ?>
                    <?php $no=$no_nya+1; } ?>
                    <?php if($hasil->kategori!='KONTRAK'){ ?>
                        <tr> 
                            <?php $no_nya = $no_nya+1; ?>
                            <td align="center"><?=$no_nya?></td>  
                            <td></td>                            
                            <td align="center"><?=$tglR[0].' '.$this->help->singkatanBulan($tglR[1]).' '.$tglR[2];?></td> 
                            <td></td>                            
                            <td>Dibayar PPh 21 atas belanja HR</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><?=number_format($totPajak,2,",",".")?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4"></td>
                        <td align="right">JUMLAH BULAN INI &nbsp;</td>
                        <td align="right"><?=number_format($hasil->pengajuan_sekarang,2,",",".")?></td>
                        <td align="right"><?=number_format($totPajak,2,",",".")?></td>
                        <td align="right"><?=number_format($hasil->pengajuan_sekarang,2,",",".")?></td>
                        <td align="right"><?=number_format($totPajak,2,",",".")?></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td align="right">JUMLAH BULAN LALU &nbsp;</td>
                        <td align="right"><?=number_format($hasil->pengajuan_sebelum,2,",",".")?></td>
                        <td align="right"><?=number_format($pjakSblm,2,",",".")?></td>
                        <td align="right"><?=number_format($hasil->pengajuan_sebelum,2,",",".")?></td>
                        <td align="right"><?=number_format($pjakSblm,2,",",".")?></td>
                    </tr>                    
                    <tr>
                        <td colspan="4"></td>
                        <td align="right">JUMLAH SAMPAI DENGAN BULAN INI &nbsp;</td>
                        <td align="right"><?=number_format($hasil->pengajuan_sekarang+$hasil->pengajuan_sebelum,2,",",".")?></td>
                        <td align="right"><?=number_format($totPajak+$pjakSblm,2,",",".")?></td>
                        <td align="right"><?=number_format($hasil->pengajuan_sekarang+$hasil->pengajuan_sebelum,2,",",".")?></td>
                        <td align="right"><?=number_format($totPajak+$pjakSblm,2,",",".")?></td>
                    </tr>                                       
                    <tr>
                        <td colspan="4"></td>
                        <td align="right">S A L D O &nbsp;</td>
                        <td align="right"></td>
                        <td align="right"></td>
                        <td align="right">-</td>
                        <td align="right">-</td>
                    </tr>
                </tbody>
           </table>
           <br>
           <table width="100%" style="font-size:10pt;font-family:arial;line-height: 1;text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td width="50%">&nbsp;</td>
                    <td>Kediri, 
                        <?php $tglPs = explode('-', $tgl_rekap);
                        echo $tglPs[0].' '.$this->help->namaBulan($tglPs[1]).' '.$tglPs[2]; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Mengetahui,</td>
                </tr>
                <tr>
                    <td></td>
                    <td>PEJABAT PELAKSANA TEKNIS KEGIATAN</td>
                </tr>
                <tr><td height="70px"></td></tr>
                <tr>
                    <td></td>
                    <td><b><u><?=$hasil->nama_pejabat_pptk?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIP. <?=$hasil->nip_pejabat_pptk?></td>
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
.border_bottom{
    border-bottom: 1px solid #000;
}
.bordersolid{
    border: 1px solid black; border-collapse: collapse;
}
</style>