<!doctype html>
<html>
    <head>
        <title>Rekap Pjd</title>
    </head>
    <body>
        <?php
            $kat=' Dalam Kota ';
            if($kategori=='DL'){
                $kat=' Biasa ';
            }

            $isTP3 = false;
            $judul = 'PERJALANAN DINAS'.strtoupper($kat); 
            $kodeKeg = $keg['kode_kegiatan'].' - '.$kode_rek_belanja;    
            $uraian = "Belanja Perjalanan Dinas".$kat;               
            
        ?>
        <div class="responsive">
            <table border="1" class="bordersolid" cellspacing="-1" width="30%" style="font-size:10px;font-family:arial;padding-top: -30px;">
                <tr>
                    <td colspan="2" width="130px">No. Kwitansi</td>
                    <td>&nbsp;<?=$info_no_bku.' / '.$hasil[0]['nama_bagian'].'.'.$hasil[0]['singkatan_kegiatan'].' / '.$bulan.' / '.$tahun?></td>
                </tr>
                <tr>
                    <td colspan="2">Kode Sub Kegiatan - Rek. Belanja</td>
                    <td>&nbsp;<?=$kodeKeg?></td>
                </tr>
                <tr>
                    <td colspan="2">Uraian</td>
                    <td>&nbsp;<?=$uraian?></td>
                </tr>
            </table>
            <table width="100%" style="font-size:9pt;font-family:arial">                
                <tr><td colspan="12">&nbsp;</td></tr>
                <tr>
                    <th colspan="12">REKAPITULASI BELANJA <?=$judul?></th> 
                </tr>
                <tr>
                    <th colspan="12">SUB KEGIATAN <?=strtoupper($keg['kegiatan']) ?></th> 
                </tr>
                <tr>
                    <th colspan="12"><?=$bag->nama_bagian?> KABUPATEN KEDIRI TAHUN ANGGARAN <?=$tahun?></th>
                </tr>
                <tr><td colspan="12">&nbsp;</td></tr>
            </table>
            <table border="0" cellspacing="0" width="20%" style="font-size:9px;font-family:arial">
                <tr>
                    <td width="110px">Jumlah Dana</td>
                    <td width="5px">:</td>
                    <td width="10px">Rp.</td>
                    <td width="90px" align="right"><?=number_format($dana->jml_dana)?></td>
                </tr>
                <tr>
                    <td>Pengajuan Sebelumnya</td>
                    <td>:</td>
                    <td>Rp.</td>
                    <td align="right"><?=number_format($dana->pengajuan_sebelum)?></td>
                </tr>
                <tr>
                    <td>Pengajuan Sekarang</td>
                    <td>:</td>
                    <td>Rp.</td>
                    <td align="right"><?=number_format($dana->pengajuan_sekarang)?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2" style="padding-top: -5px;"><hr style="border: 0.5px solid black; border-collapse: collapse;"></td>
                </tr>
                <tr>
                    <td style="padding-top: -7px">Sisa Anggaran</td>
                    <td style="padding-top: -7px">:</td>
                    <td style="padding-top: -7px">Rp.</td>
                    <td align="right" style="padding-top: -7px"><?=number_format($dana->sisa_kas)?></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            </table>
            <table class="bordersolid" border="1" cellspacing="-1" width="100%" style="line-height: 1.2;font-size:9px;font-family:arial">
                <thead>
                    <tr>
                        <td align="center" style="width:30px">NO</td>
                        <td align="center" style="width:175px">NO. KWITANSI</td>
                        <td align="center" style="width:165px">NAMA / NIP</td>
                        <td align="center" style="width:50px">GOL</td>
                        <td align="center" style="width:165px">JABATAN</td>
                        <td align="center" style="width:90px">TANGGAL</td>
                        <td align="center" style="width:165px">TUJUAN</td>
                        <td align="center" style="width:165px">KEGIATAN / ACARA</td>
                        <td align="center" style="width:160px">UANG HARIAN dan REPRESENTASI (Rp)</td>
                        <td align="center" style="width:60px">TRANSPORT PP (Rp)</td>
                        <td align="center" style="width:60px">PENGINAPAN (Rp)</td>
                        <td align="center" style="width:60px">KONTRIBUSI (Rp)</td>
                        <td align="center" style="width:60px">JUMLAH PENERIMAAN (Rp)</td>
                    </tr>
                    <tr>
                        <td align="center">1</td>
                        <td align="center">2</td>
                        <td align="center">3</td>
                        <td align="center">4</td>
                        <td align="center">5</td>
                        <td align="center">6</td>
                        <td align="center">7</td>
                        <td align="center">8</td>
                        <td align="center">9</td>
                        <td align="center">10</td>
                        <td align="center">11</td>
                        <td align="center">12</td>
                        <td align="center">13</td>
                    </tr>
                    <tr>
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
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $pjdId=''; $no=1; $totAwal=0; $totTransport=0; $totPenginapan=0; $totSemua=0; ?>
                    <?php foreach ($hasil as $val): ?>
                    <tr>
                        <td valign="top" align="center"><?=$no++?></td>
                        <td valign="top">. . . <?='/'.$val['nama_bagian'].'.'.$val['singkatan_kegiatan'].'/'.$bulan.'/'.$tahun?></td>
                        <td valign="top"><?=$val['nama_sdm']?><?=$val['nip']!='-'?'<br>NIP. '.$val['nip']:''?></td>
                        <td valign="top" align="center">
                            <?php 
                                $gl=explode('(', $val['pangkat_gol']);
                                $gll=explode(')', $gl[1]);
                                echo $gll[0];
                            ?>
                        </td>
                        <td valign="top" align="center"><?=$val['jabatan']?></td>
                        <?php if($pjdId!=$val['fk_pjd_id']){?>
                            <td valign="top" align="center" rowspan="<?=count($hasilGroup[$val['fk_pjd_id']])?>">
                                <?php
                                    $brk=explode('-', $val['tgl_berangkat']);
                                    $tba=explode('-', $val['tgl_tiba']);
                                    if($val['tgl_berangkat']==$val['tgl_tiba']){
                                        echo $brk[2].' '.$this->help->namaBulan($brk[1]).' '.$brk[0];
                                    }else{
                                        if($brk[1]==$tba[1]){
                                            echo $brk[2].' s/d '.$tba[2].' '.$this->help->namaBulan($brk[1]).' '.$brk[0];
                                        }else{
                                            echo $brk[2].' '.$this->help->namaBulan($brk[1]).' s/d '.$tba[2].' '.$this->help->namaBulan($tba[1]).' '.$brk[0];
                                        }
                                    }
                                ?>
                            </td>
                            <td valign="top" align="center" rowspan="<?=count($hasilGroup[$val['fk_pjd_id']])?>"><?=$val['kategori']=='DL'?$val['kota']:$val['kota'].' ('.$val['tujuan_skpd'].')'?></td>
                            <td valign="top" align="center" rowspan="<?=count($hasilGroup[$val['fk_pjd_id']])?>"><?=$val['acara']?></td>
                        <?php } ?>
                        <td valign="top" align="right">
                            <?php $jmlTrma=0; foreach ($hasilDetail[$val['fk_pjd_id']][$val['fk_sdm_id']] as $dt) : ?>
                               <?=number_format($dt['tarif'])?> x <?=$dt['hari']?> Hari x <?=$dt['persen']?>% 
                                <?=!empty($dt['representasi'])?'<br>+ ('.number_format($dt['representasi']).' x '.$dt['hari'].' Hari)':'';?>
                               = <?=number_format($dt['total'])?>
                               <?php $totAwal+=$dt['total']; $jmlTrma+=$dt['total']; ?>
                               <br> 
                            <?php endforeach; ?>  
                        </td>
                        <td valign="top" align="right">
                            <?php $trspt=0; foreach ($hasilDetail[$val['fk_pjd_id']][$val['fk_sdm_id']] as $dt2) : ?>
                               <?=empty($dt2['transport'])?'':number_format($dt2['transport'])?>
                               <?php $totTransport+=$dt2['transport']; $trspt+=$dt2['transport']; ?>
                               <br> 
                            <?php endforeach; ?>  
                        </td>
                        <td valign="top" align="right">
                            <?php if(!$isTP3){ ?>
                                <?php $pngnpn=0; foreach ($hasilDetail[$val['fk_pjd_id']][$val['fk_sdm_id']] as $dt3) : ?>
                                   <?=empty($dt3['penginapan'])?'':number_format($dt3['penginapan'])?>
                                   <?php $totPenginapan+=$dt3['penginapan']; $pngnpn+=$dt3['penginapan'];?>
                                   <br> 
                                <?php endforeach; ?> 
                            <?php } ?> 
                        </td>
                        <td valign="top" align="right">
                            <?php if(!$isTP3){ ?>
                                <?php $kntribsi=0; foreach ($hasilDetail[$val['fk_pjd_id']][$val['fk_sdm_id']] as $dt4) : ?>
                                   <?=empty($dt4['kontribusi'])?'':number_format($dt4['kontribusi'])?>
                                   <?php $totKontribusi+=$dt4['kontribusi']; $kntribsi+=$dt4['kontribusi'];?>
                                   <br> 
                                <?php endforeach; ?> 
                            <?php } ?> 
                        </td>
                        <td valign="top" align="right">
                            <?php foreach ($hasilDetail[$val['fk_pjd_id']][$val['fk_sdm_id']] as $dt5) : ?>
                               <!-- <?= number_format($dt5['total_akhir'])?> -->
                               <?php $totSemua+=$dt5['total_akhir'];?>
                               <!-- <br>  -->
                            <?php endforeach; ?>
                            <?php
                                $smttl = $jmlTrma+$trspt+$pngnpn+$kntribsi;
                                // $totSemua+=$smttl;
                                echo number_format($smttl);
                            ?>
                        </td>
                    </tr>
                    <?php $pjdId=$val['fk_pjd_id']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td colspan="7" align="right">JUMLAH &nbsp;</td>
                        <td align="right"><?=number_format($totAwal)?></td>
                        <td align="right"><?=!empty($totTransport)? number_format($totTransport):'';?></td>
                        <td align="right"><?=!empty($totPenginapan)? number_format($totPenginapan):'';?></td>
                        <td align="right"><?=!empty($totKontribusi)? number_format($totKontribusi):'';?></td>
                        <td align="right"><?=number_format($totSemua)?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="7" align="right">JUMLAH BULAN LALU &nbsp;</td>
                        <td></td>
                        <td align="right"></td>
                        <td align="right"></td>
                        <td align="right"></td>
                        <td align="right"><?=number_format($dana->pengajuan_sebelum)?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="7" align="right">JUMLAH SAMPAI DENGAN BULAN INI &nbsp;</td>
                        <td></td>
                        <td align="right"></td>
                        <td align="right"></td>
                        <td align="right"></td>
                        <td align="right"><?=number_format($totSemua+$dana->pengajuan_sebelum)?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table border="0" cellspacing="-1" width="100%" style="line-height: 1;font-size:9px;font-family:arial">
                <tr>
                    <td width="60px">&nbsp;</td>
                    <td width="200px">&nbsp;</td>
                    <td width="200px">&nbsp;</td>
                    <td width="200px" align="center">&nbsp;Kediri,
                    <?php
                        $ct=explode('-', $tgl_cetak);
                        echo $ct[0].' '.$this->help->namaBulan($ct[1]).' '.$ct[2];
                    ?>
                    </td>
                    <td width="60px" align="center"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="center">Mengetahui</td>
                    <td></td>
                </tr>
                <tr>
                    <!-- <td align="center"><?=$pa?>PENGGUNA ANGGARAN</td> -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="center">PEJABAT PELAKSANA TEKNIS KEGIATAN</td>
                    <td></td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="center"><b><u><?=$nama_pejabat_pptk?></u></b></td>
                    <td></td>
                </tr>
                <tr>
                    <!-- <td align="center">NIP. <?=$kpa[0]['nip']?></td> -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="center">NIP. <?=$nip_pejabat_pptk?></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </body>
</html>
<style type="text/css">
    .bordersolid{
        border: 1px solid black; border-collapse: collapse;
    }
</style>