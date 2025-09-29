<!doctype html>
<html>
    <head>
        <title>SPP</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt">
                <tr>
                    <th>SURAT PENGAJUAN PENCAIRAN</th> 
                </tr>
                <?php if(isset($hslBid)){ ?>
                    <tr>
                        <th><?=strtoupper($hslBid->nama_bagian)?></th> 
                    </tr>
                <?php } ?>
                <tr>
                    <th>SEKRETARIAT DAERAH KABUPATEN KEDIRI</th> 
                </tr>
                <?php
                    $tgl = explode('-', $hasil->tgl_pencairan);
                ?>
                <tr>
                    <th>Tanggal <?=$tgl[2].' '.$this->help->namaBulan($tgl[1]).' '.$tgl[0]?> </th> 
                </tr>
            </table>
            <table border="1" cellspacing="0" width="100%" style="font-size:9px;line-height: 2">
                <thead>
                    <tr>
                        <th rowspan="2">KODE REKENING</th>
                        <th rowspan="2" width="50%">URAIAN</th>
                        <th rowspan="2" width="90px">ANGGARAN<br>TAHUN INI</th>
                        <th rowspan="2" width="90px">JUMLAH PENGAJUAN<br>S/D SEBELUMNYA</th>
                        <th rowspan="2" width="90px">JUMLAH PENGAJUAN<br>SEKARANG</th>
                        <th colspan="2">JUMLAH REALISASI<br>S/D SEKARANG</th>
                        <th rowspan="2" width="90px">SISA<br>ANGGARAN</th>
                    </tr>
                    <tr>
                        <th width="90px">Rp.</th>
                        <th>%</th>
                    </tr>
                </thead>  
                <tbody>
                    <?php foreach((array)$hslProg as $val) :?>
                        <tr>
                            <td><?=$val->kode_prog?></td>
                            <td><b><?=$val->program_utama?></b></td>
                            <?php
                                $anggaran_prog = $val->tot_anggaran_prog;
                                if($jenis_anggaran=='per_perbup1'){
                                    $anggaran_prog = $val->tot_angg_perbup1_prog;
                                }
                                if($jenis_anggaran=='per_perbup2'){
                                    $anggaran_prog = $val->tot_angg_perbup2_prog;
                                }
                                if($jenis_anggaran=='per_perbup3'){
                                    $anggaran_prog = $val->tot_angg_perbup3_prog;
                                }
                                if($jenis_anggaran=='per_perbup4'){
                                    $anggaran_prog = $val->tot_angg_perbup4_prog;
                                }
                                if($jenis_anggaran=='pak'){
                                    $anggaran_prog = $val->tot_anggaran_pak_prog;
                                }
                            ?>
                            <td style="text-align: right"><?=number_format($anggaran_prog)?></td>
                            <?php $pngjLalu=$arrLaluPjd[$val->id_prog]+$arrLaluRkp[$val->id_prog];?>
                            <td style="text-align: right"><?=number_format($pngjLalu)?></td>
                            <?php $pngSkrg=$arrSkrgPjd[$val->id_prog]+$arrSkrgRkp[$val->id_prog];?>
                            <td style="text-align: right"><?=number_format($pngSkrg)?></td>
                            <td style="text-align: right;"><?=number_format($pngjLalu+$pngSkrg)?></td>
                            <td style="text-align: center"><?=!empty($anggaran_prog)?number_format((($pngjLalu+$pngSkrg)/$anggaran_prog)*100,2):'0'?> %</td>
                            <td style="text-align: right;"><?=number_format($anggaran_prog-($pngjLalu+$pngSkrg))?></td>
                            <?php foreach ((array)$arrKeg[$val->id_prog] as $valKeg) { ?>
                                <tr>
                                   <td><?=$valKeg->kode_keg?></td>
                                    <td><b><i><?=$valKeg->nama_program?></i></b></td>
                                    <?php
                                        $anggaran_keg = $valKeg->tot_anggaran_keg;
                                        if($jenis_anggaran=='per_perbup1'){
                                            $anggaran_keg = $valKeg->tot_angg_perbup1_keg;
                                        }
                                        if($jenis_anggaran=='per_perbup2'){
                                            $anggaran_keg = $valKeg->tot_angg_perbup2_keg;
                                        }
                                        if($jenis_anggaran=='per_perbup3'){
                                            $anggaran_keg = $valKeg->tot_angg_perbup3_keg;
                                        }
                                        if($jenis_anggaran=='per_perbup4'){
                                            $anggaran_keg = $valKeg->tot_angg_perbup4_keg;
                                        }
                                        if($jenis_anggaran=='pak'){
                                            $anggaran_keg = $valKeg->tot_anggaran_pak_keg;
                                        }
                                    ?>
                                    <td style="text-align: right"><?=number_format($anggaran_keg)?></td>
                                    <?php $pngjLaluKeg=$arrLaluPjdKeg[$valKeg->id_keg]+$arrLaluRkpKeg[$valKeg->id_keg];?>
                                    <td style="text-align: right"><?=number_format($pngjLaluKeg)?></td>
                                    <?php $pngSkrgKeg=$arrSkrgPjdKeg[$valKeg->id_keg]+$arrSkrgRkpKeg[$valKeg->id_keg];?>
                                    <td style="text-align: right"><?=number_format($pngSkrgKeg)?></td>
                                    <td style="text-align: right;"><?=number_format($pngjLaluKeg+$pngSkrgKeg)?></td>
                                    <td style="text-align: center"><?=!empty($anggaran_keg)?number_format((($pngjLaluKeg+$pngSkrgKeg)/$anggaran_keg)*100,2):'0'?> %</td>
                                    <td style="text-align: right;"><?=number_format($anggaran_keg-($pngjLaluKeg+$pngSkrgKeg))?></td>

                                    <?php foreach ((array)$arrSubKeg[$valKeg->id_keg] as $valSub) { ?>
                                        <tr>
                                            <td><?=$valSub->kode_sub_keg?></td>
                                            <td><b><?=$valSub->kegiatan?></b></td>
                                            <?php
                                                $anggaran_subKeg = $valSub->tot_anggaran_sub_keg;
                                                if($jenis_anggaran=='per_perbup1'){
                                                    $anggaran_subKeg = $valSub->tot_angg_perbup1_sub_keg;
                                                }
                                                if($jenis_anggaran=='per_perbup2'){
                                                    $anggaran_subKeg = $valSub->tot_angg_perbup2_sub_keg;
                                                }
                                                if($jenis_anggaran=='per_perbup3'){
                                                    $anggaran_subKeg = $valSub->tot_angg_perbup3_sub_keg;
                                                }
                                                if($jenis_anggaran=='per_perbup4'){
                                                    $anggaran_subKeg = $valSub->tot_angg_perbup4_sub_keg;
                                                }
                                                if($jenis_anggaran=='pak'){
                                                    $anggaran_subKeg = $valSub->tot_anggaran_pak_sub_keg;
                                                }
                                            ?>
                                            <td style="text-align: right"><?=number_format($anggaran_subKeg)?></td>
                                            <?php $pngjLaluSubKeg=$arrLaluPjdSubKeg[$valSub->id_sub_keg]+$arrLaluRkpSubKeg[$valSub->id_sub_keg];?>
                                            <td style="text-align: right"><?=number_format($pngjLaluSubKeg)?></td>
                                            <?php $pngSkrgSubKeg=$arrSkrgPjdSubKeg[$valSub->id_sub_keg]+$arrSkrgRkpSubKeg[$valSub->id_sub_keg];?>
                                            <td style="text-align: right"><?=number_format($pngSkrgSubKeg)?></td>
                                            <td style="text-align: right;"><?=number_format($pngjLaluSubKeg+$pngSkrgSubKeg)?></td>
                                            <td style="text-align: center"><?=!empty($anggaran_subKeg)?number_format((($pngjLaluSubKeg+$pngSkrgSubKeg)/$anggaran_subKeg)*100,2):'0'?> %</td>
                                            <td style="text-align: right;"><?=number_format($anggaran_subKeg-($pngjLaluSubKeg+$pngSkrgSubKeg))?></td>
                                            <?php foreach ((array)$arrRekBlj[$valSub->id_sub_keg] as $valRek) { ?>
                                                <tr>
                                                    <td><?=$valRek->kode_rek_belanja?></td>
                                                    <td><?=$valRek->nama_rek_belanja?></td>
                                                    <?php
                                                        $anggaran_rek_blj = $valRek->anggaran;
                                                        if($jenis_anggaran=='per_perbup1'){
                                                            $anggaran_rek_blj = $valRek->anggaran_per_perbup1;
                                                        }
                                                        if($jenis_anggaran=='per_perbup2'){
                                                            $anggaran_rek_blj = $valRek->anggaran_per_perbup2;
                                                        }
                                                        if($jenis_anggaran=='per_perbup3'){
                                                            $anggaran_rek_blj = $valRek->anggaran_per_perbup3;
                                                        }
                                                        if($jenis_anggaran=='per_perbup4'){
                                                            $anggaran_rek_blj = $valRek->anggaran_per_perbup4;
                                                        }
                                                        if($jenis_anggaran=='pak'){
                                                            $anggaran_rek_blj = $valRek->anggaran_pak;
                                                        }
                                                    ?>
                                                    <td style="text-align: right"><?=number_format($anggaran_rek_blj)?></td>
                                                    <?php $pngjLaluRekBlj=$arrLaluPjdRekBlj[$valRek->id_rek]+$arrLaluRkpRekBlj[$valRek->id_rek];?>
                                                    <td style="text-align: right"><?=number_format($pngjLaluRekBlj)?></td>
                                                    <?php $pngSkrgRekBlj=$arrSkrgPjdRekBlj[$valRek->id_rek]+$arrSkrgRkpRekBlj[$valRek->id_rek];?>
                                                    <td style="text-align: right"><?=number_format($pngSkrgRekBlj)?></td>
                                                    <td style="text-align: right;"><?=number_format($pngjLaluRekBlj+$pngSkrgRekBlj)?></td>
                                                    <td style="text-align: center"><?=!empty($anggaran_rek_blj)?number_format((($pngjLaluRekBlj+$pngSkrgRekBlj)/$anggaran_rek_blj)*100,2):'0'?> %</td>
                                                    <td style="text-align: right;"><?=number_format($anggaran_rek_blj-($pngjLaluRekBlj+$pngSkrgRekBlj))?></td>
                                                </tr>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tr>
                    <?php endforeach;?>
               </tbody>
            </table>
            <br>
            <table width="100%" style="font-size:10pt;font-family:arial;line-height: 1;text-align: center" border="0" cellspacing="-1"> 
                <tr>
                    <td width="50%"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><?=$hasil->nama_pejabat_pptk2?'PEJABAT PELAKSANA TEKNIS KEGIATAN':''?></td>
                    <td>PEJABAT PELAKSANA TEKNIS KEGIATAN</td>
                </tr>
                <tr><td height="60px"></td></tr>
                <tr>
                    <td><b><u><?=$hasil->nama_pejabat_pptk2?$hasil->nama_pejabat_pptk2:''?></u></b></td>
                    <td><b><u><?=$hasil->nama_pejabat_pptk?></u></b></td>
                </tr>
                <tr>
                    <td><?=$hasil->nip_pejabat_pptk2?'NIP. '.$hasil->nip_pejabat_pptk2:''?></td>
                    <td>NIP. <?=$hasil->nip_pejabat_pptk?></td>
                </tr>
            </table>
        </div>
    </body>
</html>