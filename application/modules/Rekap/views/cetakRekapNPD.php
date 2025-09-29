<!doctype html>
<html>
    <head>
        <title>NPD <?=$title?></title>
    </head>
    <body>
        <div class="responsive">
           <table width="100%" style="font-size:14pt;font-family:Tahoma, sans-serif;line-height: 1;text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td><b>PEMERINTAH KABUPATEN KEDIRI</b></td>
                </tr>
                <tr>
                    <td><b>NOTA PENCAIRAN DANA</b></td>
                </tr>
           </table>
           <br>
           <table width="100%" style="font-size:11pt;font-family:Tahoma, sans-serif;line-height: 1.2;" border="0" cellspacing="-1">
                <tr>
                    <td width="120px">Kepada</td>
                    <td width="10px">:</td>
                    <td><?=$pjbt->jabatan_pejabat_kpa?></td>
                </tr>
                <tr>
                    <td>Dari</td>
                    <td>:</td>
                    <td><?=$bidang->nama_bagian?></td>
                </tr>
                <tr>
                    <td>PPTK</td>
                    <td>:</td>
                    <td><?=$pjbt->nama_pejabat_pptk?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$bulan.' '.$tahun?></td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>:</td>
                    <td>Segera</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>1 (satu) bendel TNT</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td>Pengajuan Pencairan Dana Ganti Uang Bulan <?=$bulan?> Tahun <?=$tahun?></td>
                </tr>
           </table>
           <br>
           <table class="bordersolid" border="1" cellspacing="-1" width="100%" style="line-height: 1.2;font-size:10pt;font-family:arial">
                <thead>
                    <tr>
                        <th align="center" style="width:30px">NO.</th>
                        <th align="center" style="width:100px">TGl. KWITANSI</th>
                        <th align="center" style="width:80px">NO. BUKTI</th>
                        <th align="center" style="width:80px">KODE REK.</th>
                        <th align="center" style="width:200px">URAIAN</th>
                        <th align="center" style="width:80px">PENERIMAAN</th>
                        <th align="center" style="width:80px">PENGELUARAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; $nmProg='';$nmKeg='';$nmRek=''; $totPngjuan=0; $totPpn=0; $totPph21=0; $totPph22=0; $totPph23=0; 
                        $pjkDaerah=0; $totTunjBpjs=0;
                    ?>
                    <!-- kwitansi -->
                    <?php foreach ((array)$hslKwitansi as $valKw) { ?>
                        <?php if($nmProg!=$valKw->nama_program) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valKw->kode_program.' '.$valKw->nama_program?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmProg=$valKw->nama_program; ?>
                        <?php } ?>
                        <?php if($nmKeg!=$valKw->kegiatan) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valKw->kode_kegiatan.' '.$valKw->kegiatan?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmKeg=$valKw->kegiatan; ?>
                        <?php } ?>
                        <?php if($nmRek!=$valKw->nama_rek_belanja) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valKw->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmRek=$valKw->nama_rek_belanja; ?>
                        <?php } ?>
                        <tr>
                            <td align="center"><?=$no++;?></td>
                            <td align="center"><?=$title?></td>
                            <td><?=$valKw->no_bku?></td>
                            <td><?=$valKw->kode_rekening?></td>
                            <td><?=$valKw->untuk_pembayaran?></td>
                            <td></td>
                            <td align="right"><?=number_format($valKw->pengajuan_sekarang,0,",",".")?></td>
                        </tr>
                        <?php if($valKw->ppn){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPN</td>
                                <td align="right"><?=number_format($valKw->ppn,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php if($valKw->pph_21){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPh 21</td>
                                <td align="right"><?=number_format($valKw->pph_21,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php if($valKw->pph_22){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPh 22</td>
                                <td align="right"><?=number_format($valKw->pph_22,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php if($valKw->pph_23){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPh 23</td>
                                <td align="right"><?=number_format($valKw->pph_23,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php if($valKw->pjk_daerah){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Pajak Daerah</td>
                                <td align="right"><?=number_format($valKw->pjk_daerah,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php $totPngjuan += $valKw->pengajuan_sekarang; $totPpn += $valKw->ppn; $totPph21 += $valKw->pph_21; 
                            $totPph22 += $valKw->pph_22; $totPph23 += $valKw->pph_23; $pjkDaerah += $valKw->pjk_daerah;
                        ?>
                    <?php } ?>
                    <!-- lembur -->
                    <?php foreach ((array)$hslEntriLmbr as $valLm) { ?>
                        <?php if($nmProg!=$valLm->nama_program) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valLm->kode_program.' '.$valLm->nama_program?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmProg=$valLm->nama_program; ?>
                        <?php } ?>
                        <?php if($nmKeg!=$valLm->kegiatan) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valLm->kode_kegiatan.' '.$valLm->kegiatan?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmKeg=$valLm->kegiatan; ?>
                        <?php } ?>
                        <?php if($nmRek!=$valLm->nama_rek_belanja) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valLm->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmRek=$valLm->nama_rek_belanja; ?>
                        <?php } ?>
                        <tr>
                            <td align="center"><?=$no++;?></td>
                            <td align="center"><?=$title?></td>
                            <td><?=$valLm->no_bku?></td>
                            <td><?=$valLm->kode_rekening?></td>
                            <td><?=$valLm->perihal?></td>
                            <td></td>
                            <td align="right"><?=number_format($valLm->banyaknya_uang,0,",",".")?></td>
                        </tr>
                        <?php if($valLm->pph21nya){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPh 21</td>
                                <td align="right"><?=number_format($valLm->pph21nya,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php $totPngjuan += $valLm->banyaknya_uang; $totPph21 += $valLm->pph21nya; ?>
                    <?php } ?>
                    <?php foreach ((array)$hslRapat as $valRpt) { ?>
                        <?php if($nmProg!=$valRpt->nama_program) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valRpt->kode_program.' '.$valRpt->nama_program?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmProg=$valRpt->nama_program; ?>
                        <?php } ?>
                        <?php if($nmKeg!=$valRpt->kegiatan) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valRpt->kode_kegiatan.' '.$valRpt->kegiatan?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmKeg=$valRpt->kegiatan; ?>
                        <?php } ?>
                        <?php if($nmRek!=$valRpt->nama_rek_belanja) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valRpt->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmRek=$valRpt->nama_rek_belanja; ?>
                        <?php } ?>
                        <tr>
                            <td align="center"><?=$no++;?></td>
                            <td align="center"><?=$title?></td>
                            <td><?=$valRpt->no_bku?></td>
                            <td><?=$valRpt->kode_rekening?></td>
                            <td><?=$valRpt->acara?></td>
                            <td></td>
                            <td align="right"><?=number_format($valRpt->banyaknya_uang,0,",",".")?></td>
                        </tr>
                        <?php if($valRpt->pph_23){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPh 23</td>
                                <td align="right"><?=number_format($valRpt->pph_23,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php if($valRpt->pajak_daerah){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Pajak Daerah</td>
                                <td align="right"><?=number_format($valRpt->pajak_daerah,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php $totPngjuan += $valRpt->banyaknya_uang; $totPph23 += $valRpt->pph_23; $pjkDaerah += $valRpt->pajak_daerah;
                        ?>
                    <?php } ?>
                    <?php foreach ((array)$hslHonor as $valHr) { ?>
                        <?php if($nmProg!=$valHr->nama_program) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valHr->kode_program.' '.$valHr->nama_program?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmProg=$valHr->nama_program; ?>
                        <?php } ?>
                        <?php if($nmKeg!=$valHr->kegiatan) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valHr->kode_kegiatan.' '.$valHr->kegiatan?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmKeg=$valHr->kegiatan; ?>
                        <?php } ?>
                        <?php if($nmRek!=$valHr->nama_rek_belanja) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valHr->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmRek=$valHr->nama_rek_belanja; ?>
                        <?php } ?>
                        <tr>
                            <td align="center"><?=$no++;?></td>
                            <td align="center"><?=$title?></td>
                            <td><?=$valHr->no_bku?></td>
                            <td><?=$valHr->kode_rekening?></td>
                            <td><?=$valHr->untuk_pembayaran?></td>
                            <td></td>
                            <td align="right"><?=number_format($valHr->tot_bruto,0,",",".")?></td>
                        </tr>
                        <?php if($valHr->tot_pph21){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPh 21</td>
                                <td align="right"><?=number_format($valHr->tot_pph21,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php if($valHr->tot_bpjs_kes_pemkab){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Tunjangan BPJS Kesehatan + Ketenagakerjaan</td>
                                <?php $totTunj = $valHr->tot_bpjs_kes_pemkab+$valHr->tot_bpjs_krj_jkk+$valHr->tot_bpjs_krj_jkm+$valHr->tot_bpjs_kes_peserta; ?>
                                <td align="right"><?=number_format($totTunj,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php $totPngjuan += $valHr->tot_bruto; $totPph21 += $valHr->tot_pph21; $totTunjBpjs+=$totTunj; ?>
                    <?php } ?>
                    <?php foreach ((array)$hslPjd as $valPj) { ?>
                        <?php if($nmProg!=$valPj->nama_program) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valPj->kode_program.' '.$valPj->nama_program?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmProg=$valPj->nama_program; ?>
                        <?php } ?>
                        <?php if($nmKeg!=$valPj->kegiatan) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valPj->kode_kegiatan.' '.$valPj->kegiatan?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmKeg=$valPj->kegiatan; ?>
                        <?php } ?>
                        <?php if($nmRek!=$valPj->nama_rek_belanja) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valPj->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmRek=$valPj->nama_rek_belanja; ?>
                        <?php } ?>
                        <tr>
                            <td align="center"><?=$no++;?></td>
                            <td align="center"><?=$title?></td>
                            <td><?=$valPj->no_bku?></td>
                            <td><?=$valPj->kode_rekening?></td>
                            <td><?=$valPj->acara?></td>
                            <td></td>
                            <td align="right"><?=number_format($valPj->pengajuan_sekarang,0,",",".")?></td>
                        </tr>
                        <?php $totPngjuan += $valPj->pengajuan_sekarang; ?>
                    <?php } ?>
                    <?php foreach ((array)$hslBrg as $valBrg) { ?>
                        <?php if($nmProg!=$valBrg->nama_program) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valBrg->kode_program.' '.$valBrg->nama_program?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmProg=$valBrg->nama_program; ?>
                        <?php } ?>
                        <?php if($nmKeg!=$valBrg->kegiatan) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valBrg->kode_kegiatan.' '.$valBrg->kegiatan?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmKeg=$valBrg->kegiatan; ?>
                        <?php } ?>
                        <?php if($nmRek!=$valBrg->nama_rek_belanja) { ?>
                            <tr>
                                <td></td>
                                <td colspan="4"><?=$valBrg->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $nmRek=$valBrg->nama_rek_belanja; ?>
                        <?php } ?>
                        <tr>
                            <td align="center"><?=$no++;?></td>
                            <td align="center"><?=$title?></td>
                            <td><?=$valBrg->no_bku?></td>
                            <td><?=$valBrg->kode_rekening?></td>
                            <td><?=$valBrg->untuk_pembayaran?></td>
                            <td></td>
                            <td align="right"><?=number_format($valBrg->banyaknya_uang,0,",",".")?></td>
                        </tr>
                        <?php
                            $totAll = $valBrg->banyaknya_uang;  

                            $ppn = 0;
                            $nilaipph22=0;
                            $nilaipph23=0;
                            foreach ((array)json_decode($valBrg->jenis_pajak) as $valBrg2) {
                                if($valBrg2=='PPN'){
                                    $ppn1=11;
                                    $PmbgiPpn1=111;
                                    $ppn10Persen = $totAll*($ppn1/$PmbgiPpn1);
                                    $ppn = $this->help->pembulatanSeratus(ceil($ppn10Persen));
                                }
                                if($valBrg2=='PPH_22'){
                                    if($valBrg->npwp=='' || $valBrg->npwp=='-'){ //tidak punya npwp
                                        $nilaipph22 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(3/100)));
                                    }else{
                                        $nilaipph22 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(1.5/100)));
                                    }
                                }
                                if($valBrg2=='PPH_23'){
                                    if($valBrg->npwp=='' || $valBrg->npwp=='-'){ //tidak punya npwp
                                        $nilaipph23 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(4/100)));
                                    }else{
                                        $nilaipph23 = $this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(2/100)));
                                    }
                                }
                            }
                        ?>
                        <?php if($ppn > 0){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPN</td>
                                <td align="right"><?=number_format($ppn,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php if($nilaipph22 > 0){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPh 22</td>
                                <td align="right"><?=number_format($nilaipph22,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php if($nilaipph23 > 0){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>PPh 23</td>
                                <td align="right"><?=number_format($nilaipph23,0,",",".")?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        <?php $totPngjuan += $valBrg->banyaknya_uang; $totPpn += $ppn; $totPph22 += $nilaipph22; $totPph23 += $nilaipph23; ?>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="center" colspan="2"><b>TOTAL</b></td>
                        <?php $totPajak = $totPpn+$totPph21+$totPph22+$totPph23+$pjkDaerah+$totTunjBpjs; ?>
                        <td align="right"><b><?=number_format($totPajak,0,",",".")?></b></td>
                        <td align="right"><b><?=number_format($totPngjuan,0,",",".")?></b></td>
                    </tr>
                </tfoot>
            </table>
            <br>
            <table border="0" cellspacing="-1" width="50%" style="line-height: 1.2;font-size:10pt;font-family:arial">
                <tr>
                    <td colspan="5"><b>Kas di bendahara pengeluaran terdiri dari :</b></td>
                </tr>
                <tr>
                    <td width="50px" align="center">a.</td>
                    <td width="100px">PPh 21</td>
                    <td width="10px">:</td>
                    <td align="right"><?=number_format($totPph21,0,",",".")?></td>
                    <td width="70px">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center">b.</td>
                    <td>PPh 22</td>
                    <td>:</td>
                    <td align="right"><?=number_format($totPph22,0,",",".")?></td>
                </tr>
                <tr>
                    <td align="center">c.</td>
                    <td>PPh 23 Final</td>
                    <td>:</td>
                    <td align="right"><?=number_format($totPph23,0,",",".")?></td>
                </tr>
                <tr>
                    <td align="center">d.</td>
                    <td>PPN</td>
                    <td>:</td>
                    <td align="right"><?=number_format($totPpn,0,",",".")?></td>
                </tr>
                <?php 
                    $clsBrdr = "border_bottom";
                    if($totTunjBpjs>0){
                        $clsBrdr = "";
                    }
                ?> 
                <tr>
                    <td align="center">e.</td>
                    <td class="<?=$clsBrdr?>">Pajak Daerah</td>
                    <td class="<?=$clsBrdr?>">:</td>
                    <td class="<?=$clsBrdr?>" align="right"><?=number_format($pjkDaerah,0,",",".")?></td>
                </tr>
                <?php if($totTunjBpjs>0){ ?>
                    <tr>
                        <td align="center">f.</td>
                        <td class="border_bottom">Tunjangan Bpjs</td>
                        <td class="border_bottom">:</td>
                        <td class="border_bottom" align="right"><?=number_format($totTunjBpjs,0,",",".")?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td align="center"></td>
                    <td><b>Total Pajak</b></td>
                    <td><b>:</b></td>
                    <td align="right"><b><?=number_format($totPajak,0,",",".")?></b></td>
                </tr>
            </table>
            <br>
            <table border="0" cellspacing="-1" width="100%" style="line-height: 1;font-size:11pt;font-family:arial">
                <tr>
                    <td width="50%">&nbsp;</td>
                    <td align="center">Pejabat Pelaksana Teknis Kegiatan</td>
                </tr>
                <tr><td height='80px'>&nbsp;</td></tr>
                <tr>
                    <td></td>
                    <td align="center"><b><u><?=$pjbt->nama_pejabat_pptk?></u></b></td>
                </tr>
                 <tr>
                    <td></td>
                    <td align="center">NIP. <?=$pjbt->nip_pejabat_pptk?></td>
                </tr>
            </table>
        </div>
    </body>
</html>
<style type="text/css">
    .bordersolid{
        border: 1px solid black; border-collapse: collapse;
    }
    .border_bottom{
        border-bottom: 1px solid #000;
    }
</style>