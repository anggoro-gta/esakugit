<!doctype html>
<html>
    <head>
        <title>TNT</title>
    </head>
    <body>
        <style type="text/css">
            .formatText{
                mso-number-format:"\@";
            }
        </style>
        <div class="responsive">
            <table width="100%" style="font-size:11pt">
                <tr>
                    <th colspan="20">PENGAJUAN BELANJA TRANSAKSI NON TUNAI</th> 
                </tr>
                <tr>
                    <th colspan="20"><?=strtoupper($Bagian[0]['nama_bagian'])?></th> 
                </tr>
                <tr>
                    <th colspan="20">SEKRETARIAT KABUPATEN KEDIRI</th> 
                </tr>
                    <?php $tgl = explode('-', $hasil->tgl_pencairan); ?>
                <tr>
                    <th colspan="20">Tanggal <?=$tgl[2].' '.$this->help->namaBulan($tgl[1]).' '.$tgl[0]?> </th> 
                </tr>
            </table>
            <table border="1" class="bordersolid" cellspacing="-1" width="100%" style="font-size:9px;line-height: 2">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Rekening</th>
                        <th>Uraian Belanja</th>
                        <th>Nominal Bruto (Rp)</th>
                        <th>PPh 21</th>
                        <th>PPh 22</th>
                        <th>PPh 23</th>
                        <th>PPN</th>
                        <th>Pajak Daerah</th>
                        <th>Tunjangan Bpjs<br>Kesehatan (4%)</th>
                        <th>Potongan Tunjangan<br>Bpjs Kesehatan (1%)</th>
                        <th>JKK (0,24%)</th>
                        <th>JKM (0,30%)</th>
                        <th>Nominal Netto (Rp)</th>
                        <th>Nama Pihak Ketiga<br>(CV/PT/Perorangan)</th>
                        <th>Nama Bank</th>
                        <th>No Rek Bank</th>
                        <th>NPWP</th>
                        <th>Keterangan</th>
                        <th>Sub Kegiatan</th>
                    </tr>
                </thead>  
                <tbody>
                    <?php $no=1; $totBruto=0; $totPph21=0; $totPph22=0; $totPph23=0; $totPpn=0; $totPjkDaerah=0; $totBpjsKesPmkb=0; $totBpjsKesPsrta=0; $totJKK=0; $totJKM=0; $totNetto=0; ?>
                    <?php foreach ((array)$dataPjd as $valPjd) { ?>
                        <tr>
                            <td align="center"><?=$no++?></td>
                            <td><?=$valPjd->kode_rek_belanja?></td>
                            <td><?=$valPjd->nama_rek_belanja?></td>
                            <td align="right"><?=($isExcel)?$valPjd->total_akhir:number_format($valPjd->total_akhir)?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><?=($isExcel)?$valPjd->total_akhir:number_format($valPjd->total_akhir)?></td>
                            <td><?=$valPjd->nama_rekening?></td>
                            <td><?=$valPjd->nama_bank?></td>
                            <td class="formatText"><?=$valPjd->no_rekening?></td>
                            <td><?=$valPjd->npwp?></td>
                            <td align="center"><?=$valPjd->kategori?></td>
                            <td align="center"><?=$valPjd->singkatan?></td>
                        </tr>
                        <?php 
                            $totBruto+=$valPjd->total_akhir; 
                            $totNetto+=$valPjd->total_akhir; 
                        ?>
                    <?php } ?>
                    <?php foreach ((array)$dataHr as $valHr) { ?>
                        <tr>
                            <td align="center"><?=$no++?></td>
                            <td><?=$valHr->kode_rek_belanja?></td>
                            <td><?=$valHr->nama_rek_belanja?></td>
                            <td align="right"><?=($isExcel)?$valHr->total_bruto:number_format($valHr->total_bruto)?></td>
                            <td align="right"><?=($isExcel)?$valHr->pajak21:number_format($valHr->pajak21)?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><?=($isExcel)?$valHr->bpjs_kes_pemkab:number_format($valHr->bpjs_kes_pemkab)?></td>
                            <td align="right"><?=($isExcel)?$valHr->bpjs_kes_peserta:number_format($valHr->bpjs_kes_peserta)?></td>
                            <td align="right"><?=($isExcel)?$valHr->bpjs_krj_jkk:number_format($valHr->bpjs_krj_jkk)?></td>
                            <td align="right"><?=($isExcel)?$valHr->bpjs_krj_jkm:number_format($valHr->bpjs_krj_jkm)?></td>
                            <td align="right"><?=($isExcel)?$valHr->jml_diterima:number_format($valHr->jml_diterima)?></td>
                            <td><?=!empty($valHr->nama_rekening)?$valHr->nama_rekening:$valHr->nama_narsum?></td>
                            <td><?=!empty($valHr->nama_bank)?$valHr->nama_bank:$valHr->nama_bank_narsum?></td>
                            <td class="formatText"><?=!empty($valHr->no_rekening)?$valHr->no_rekening:$valHr->no_rekening_narsum?></td>
                            <td><?=!empty($valHr->npwp)?$valHr->npwp:$valHr->npwp_narsum?></td>
                            <td align="center"><?=$valHr->kategori?></td>
                            <td align="center"><?=$valHr->singkatan?></td>
                        </tr>
                        <?php 
                            $totBruto+=$valHr->total_bruto; 
                            $totPph21+=$valHr->pajak21;
                            $totBpjsKesPmkb+=$valHr->bpjs_kes_pemkab;
                            $totBpjsKesPsrta+=$valHr->bpjs_kes_peserta;
                            $totJKK+=$valHr->bpjs_krj_jkk;
                            $totJKM+=$valHr->bpjs_krj_jkm;
                            $totNetto+=$valHr->jml_diterima;
                        ?>
                    <?php } ?>
                    <?php foreach ((array)$dataLmbr as $valLbr) { ?>
                        <tr>
                            <td align="center"><?=$no++?></td>
                            <td><?=$valLbr->kode_rek_belanja?></td>
                            <td><?=$valLbr->nama_rek_belanja?></td>
                            <td align="right"><?=($isExcel)?$valLbr->pengajuan_sekarang:number_format($valLbr->pengajuan_sekarang)?></td>
                            <td></td>
                            <td></td>
                            <td align="right"><?=($isExcel)?$valLbr->pph23_skrg:number_format($valLbr->pph23_skrg)?></td>
                            <td></td>
                            <td align="right"><?=($isExcel)?$valLbr->pjk_daerah_skrg:number_format($valLbr->pjk_daerah_skrg)?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                $netLbr = $valLbr->pengajuan_sekarang-($valLbr->pph23_skrg+$valLbr->pjk_daerah_skrg);
                            ?>
                            <td align="right"><?=($isExcel)?$netLbr:number_format($netLbr)?></td>
                            <td><?=$valLbr->nama_pemilik?></td>
                            <td><?=$valLbr->nama_bank?></td>
                            <td class="formatText"><?=$valLbr->no_rekening?></td>
                            <td><?=$valLbr->npwp?></td>
                            <td align="center">Mamin Lembur</td>
                            <td align="center"><?=$valLbr->singkatan_kegiatan?></td>
                        </tr>
                        <?php 
                            $totBruto+=$valLbr->pengajuan_sekarang; 
                            $totPph23+=$valLbr->pph23_skrg; 
                            $totPjkDaerah+=$valLbr->pjk_daerah_skrg; 
                            $totNetto+=$netLbr; 
                        ?>
                    <?php } ?>
                    <?php if(!empty($dataRpt[0]->id)){ ?>
                        <?php foreach ((array)$dataRpt as $valRpt) { ?>
                            <tr>
                                <td align="center"><?=$no++?></td>
                                <td><?=$valRpt->kode_rek_belanja?></td>
                                <td><?=$valRpt->nama_rek_belanja?></td>
                                <td align="right"><?=($isExcel)?$valRpt->total:number_format($valRpt->total)?></td>
                                <td></td>
                                <td></td>
                                <td align="right"><?=($isExcel)?$valRpt->tot_pph23:number_format($valRpt->tot_pph23)?></td>
                                <td></td>
                                <td align="right"><?=($isExcel)?$valRpt->tot_pajak_daerah:number_format($valRpt->tot_pajak_daerah)?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <?php
                                    $netRpt = $valRpt->total-($valRpt->tot_pph23+$valRpt->tot_pajak_daerah);
                                ?>
                                <td align="right"><?=($isExcel)?$netRpt:number_format($netRpt)?></td>
                                <td><?=$valRpt->nama_pemilik?></td>
                                <td><?=$valRpt->nama_bank?></td>
                                <td class="formatText"><?=$valRpt->no_rekening?></td>
                                <td><?=$valRpt->npwp?></td>
                                <td align="center">Mamin Rapat</td>
                                <td align="center"><?=$valRpt->singkatan_kegiatan?></td>
                            </tr>
                            <?php 
                                $totBruto+=$valRpt->total; 
                                $totPph23+=$valRpt->tot_pph23; 
                                $totPjkDaerah+=$valRpt->tot_pajak_daerah; 
                                $totNetto+=$netRpt; 
                            ?>
                        <?php } ?>
                    <?php } ?>
                    <?php foreach ((array)$dataAtk as $valAtk) { ?>
                        <tr>
                            <td align="center"><?=$no++?></td>
                            <td><?=$valAtk->kode_rek_belanja?></td>
                            <td><?=$valAtk->nama_rek_belanja?></td>
                            <td align="right"><?=($isExcel)?$valAtk->pengajuan_sekarang:number_format($valAtk->pengajuan_sekarang)?></td>
                            <td></td>
                            <td align="right"><?=($isExcel)?$valAtk->pph22_skrg:number_format($valAtk->pph22_skrg)?></td>
                            <td align="right"><?=($isExcel)?$valAtk->pph23_skrg:number_format($valAtk->pph23_skrg)?></td>
                            <td align="right"><?=($isExcel)?$valAtk->ppn_skrg:number_format($valAtk->ppn_skrg)?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                $netAtk = $valAtk->pengajuan_sekarang-($valAtk->pph22_skrg+$valAtk->pph23_skrg+$valAtk->ppn_skrg);
                            ?>
                            <td align="right"><?=($isExcel)?$netAtk:number_format($netAtk)?></td>
                            <td><?=$valAtk->nama_pimpinan?></td>
                            <td><?=$valAtk->nama_bank?></td>
                            <td class="formatText"><?=$valAtk->no_rekening?></td>
                            <td><?=$valAtk->npwp?></td>
                            <td align="center">ATK</td>
                            <td align="center"><?=$valAtk->singkatan?></td>
                        </tr>
                        <?php 
                            $totBruto+=$valAtk->pengajuan_sekarang; 
                            $totPph22+=$valAtk->pph22_skrg;
                            $totPph23+=$valAtk->pph23_skrg; 
                            $totPpn+=$valAtk->ppn_skrg; 
                            $totNetto+=$netAtk; 
                        ?>
                    <?php } ?>
                    <?php foreach ((array)$dataBrglainnya as $valBrg) { ?>
                        <tr>
                            <td align="center"><?=$no++?></td>
                            <td><?=$valBrg->kode_rek_belanja?></td>
                            <td><?=$valBrg->nama_rek_belanja?></td>
                            <td align="right"><?=($isExcel)?$valBrg->banyaknya_uang:number_format($valBrg->banyaknya_uang)?></td>
                            <td></td>
                            <td align="right"><?=($isExcel)?$valBrg->pph_22:number_format($valBrg->pph_22)?></td>
                            <td></td>
                            <td align="right"><?=($isExcel)?$valBrg->ppn:number_format($valBrg->ppn)?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                $netBrg = $valBrg->banyaknya_uang-($valBrg->pph_22+$valBrg->ppn);
                            ?>
                            <td align="right"><?=($isExcel)?$netBrg:number_format($netBrg)?></td>
                            <td><?=$valBrg->atas_nama_rekening?></td>
                            <td><?=$valBrg->nama_bank?></td>
                            <td class="formatText"><?=$valBrg->no_rekening?></td>
                            <td><?=$valBrg->npwp?></td>
                            <td align="center">Barang Lainnya</td>
                            <td align="center"><?=$valBrg->singkatan_kegiatan?></td>
                        </tr>
                        <?php 
                            $totBruto+=$valBrg->banyaknya_uang; 
                            $totPph22+=$valBrg->pph_22;
                            $totPpn+=$valBrg->ppn; 
                            $totNetto+=$netBrg; 
                        ?>
                    <?php } ?>
                    <?php foreach ((array)$dataJasaLainnya as $valJasa) { ?>
                        <tr>
                            <td align="center"><?=$no++?></td>
                            <td><?=$valJasa->kode_rek_belanja?></td>
                            <td><?=$valJasa->nama_rek_belanja?></td>
                            <td align="right"><?=($isExcel)?$valJasa->banyaknya_uang:number_format($valJasa->banyaknya_uang)?></td>
                            <td></td>
                            <td></td>
                            <td align="right"><?=($isExcel)?$valJasa->pph_23:number_format($valJasa->pph_23)?></td>
                            <td align="right"><?=($isExcel)?$valJasa->ppn:number_format($valJasa->ppn)?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                $netJasa = $valJasa->banyaknya_uang-($valJasa->pph_23+$valJasa->ppn);
                            ?>
                            <td align="right"><?=($isExcel)?$netJasa:number_format($netJasa)?></td>
                            <td><?=$valJasa->atas_nama_rekening?></td>
                            <td><?=$valJasa->nama_bank?></td>
                            <td class="formatText"><?=$valJasa->no_rekening?></td>
                            <td><?=$valJasa->npwp?></td>
                            <td align="center">Jasa Lainnya</td>
                            <td align="center"><?=$valJasa->singkatan_kegiatan?></td>
                        </tr>
                        <?php 
                            $totBruto+=$valJasa->banyaknya_uang; 
                            $totPph23+=$valJasa->pph_23; 
                            $totPpn+=$valJasa->ppn; 
                            $totNetto+=$netJasa; 
                        ?>
                    <?php } ?>
                    <?php foreach ((array)$dataSwa as $valSwa) { ?>
                        <tr>
                            <td align="center"><?=$no++?></td>
                            <td><?=$valSwa->kode_rek_belanja?></td>
                            <td><?=$valSwa->nama_rek_belanja?></td>
                            <td align="right"><?=($isExcel)?$valSwa->banyaknya_uang:number_format($valSwa->banyaknya_uang)?></td>
                            <td></td>
                            <td></td>
                            <td align="right"><?=($isExcel)?$valSwa->pph_23:number_format($valSwa->pph_23)?></td>
                            <td align="right"><?=($isExcel)?$valSwa->ppn:number_format($valSwa->ppn)?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php
                                $netSwa = $valSwa->banyaknya_uang-($valSwa->pph_23+$valSwa->ppn);
                            ?>
                            <td align="right"><?=($isExcel)?$netSwa:number_format($netSwa)?></td>
                            <td><?=$valSwa->atas_nama_rekening?></td>
                            <td><?=$valSwa->nama_bank?></td>
                            <td class="formatText"><?=$valSwa->no_rekening?></td>
                            <td><?=$valSwa->npwp?></td>
                            <td align="center">Swakelola</td>
                            <td align="center"><?=$valSwa->singkatan_kegiatan?></td>
                        </tr>
                        <?php 
                            $totBruto+=$valSwa->banyaknya_uang; 
                            $totPph23+=$valSwa->pph_23; 
                            $totPpn+=$valSwa->ppn; 
                            $totNetto+=$netSwa; 
                        ?>
                    <?php } ?>
                    <tr>
                        <th colspan="3">Jumlah</th>
                        <td align="right"><b><?=($isExcel)?$totBruto:number_format($totBruto)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totPph21:number_format($totPph21)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totPph22:number_format($totPph22)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totPph23:number_format($totPph23)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totPpn:number_format($totPpn)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totPjkDaerah:number_format($totPjkDaerah)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totBpjsKesPmkb:number_format($totBpjsKesPmkb)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totBpjsKesPsrta:number_format($totBpjsKesPsrta)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totJKK:number_format($totJKK)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totJKM:number_format($totJKM)?></b></td>
                        <td align="right"><b><?=($isExcel)?$totNetto:number_format($totNetto)?></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>                    
            </table>
            <br>
            <?php if (!$isExcel){ ?>
                <table width="100%" style="font-size:10pt;font-family:arial;line-height: 1;text-align: center" border="0" cellspacing="-1"> 
                    <?php
                        $widthnya='50%';
                        if($hasil->nama_pejabat_pptk2){
                            $widthnya='35%';
                        }
                    ?>
                    <tr>
                        <td width="<?=$widthnya?>"><?=$hasil->jabatan_pejabat_kpa?><br>Selaku KPA,</td>
                        <!-- <td width="<?=$widthnya?>">PPTK</td>
                        <?php if($hasil->nama_pejabat_pptk2){ ?>
                            <td width="<?=$widthnya?>">PPTK</td>
                        <?php } ?> -->
                        <td>Bendahara Pengeluaran Pembantu</td>
                    </tr>
                    <tr><td height="60px"></td></tr>
                    <tr>
                        <td><b><u><?=$hasil->nama_pejabat_kpa?></u></b></td>
                        <!-- <td><b><u><?=$hasil->nama_pejabat_pptk?></u></b></td>
                        <?php if($hasil->nama_pejabat_pptk2){ ?>
                            <td><b><u><?=$hasil->nama_pejabat_pptk2?></u></b></td>
                        <?php } ?> -->
                        <td><b><u><?=$hasil->nama_bendahara_pembantu?></u></b></td>
                    </tr>
                    <tr>
                        <td>NIP. <?=$hasil->nip_pejabat_kpa?></td>
                        <!-- <td>NIP. <?=$hasil->nip_pejabat_pptk?></td>
                        <?php if($hasil->nama_pejabat_pptk2){ ?>
                            <td>NIP. <?=$hasil->nip_pejabat_pptk2?></td>
                        <?php } ?> -->
                        <td>NIP. <?=$hasil->nip_bendahara_pembantu?></td>
                    </tr>
                </table>
            <?php } ?>
        </div>
    </body>
</html>
<style type="text/css">
    .bordersolid{
        border: 1px solid black; border-collapse: collapse;
    }
</style>