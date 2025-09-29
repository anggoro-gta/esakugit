<!doctype html>
<html>
    <head>
        <title>Laporan Per Bulan</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt">
                <tr>
                    <th colspan="9">LAPORAN DAFTAR PERSEDIAAN S/D 31 DESEMBER <?=$tahun;?></th> 
                </tr>
                <tr><th>&nbsp;</th></tr>
            </table>
            <table border="1" cellspacing="-1" width="100%" style="font-size:10px">
                <thead>
                    <tr>
                        <th style="text-align: center;vertical-align: middle;" width="20px">NO</th>
                        <th style="text-align: center;vertical-align: middle;" colspan="2">NAMA BARANG</th>
                        <th style="text-align: center;vertical-align: middle;" colspan="2">SALDO AWAL PER 1 JANUARI TAHUN <?=$tahun?> </th>
                        <th style="text-align: center;vertical-align: middle;" colspan="2">PENGADAAN JANUARI S/D DESEMBER <?=$tahun?></th>
                        <th style="text-align: center;vertical-align: middle;" colspan="2">JUMLAH</th>
                        <th style="text-align: center;vertical-align: middle;" colspan="2">PENGELUARAN JANUARI S/D DESEMBER <?=$tahun?></th>
                        <th style="text-align: center;vertical-align: middle;" colspan="2">SISA</th>
                        <th style="text-align: center;vertical-align: middle;">HARGA<br>SATUAN</th>
                        <th style="text-align: center;vertical-align: middle;">JUMLAH</th>
                        <th style="text-align: center;vertical-align: middle;">KETERANGAN</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">1</th>
                        <th style="text-align: center;" colspan="2">2</th>
                        <th style="text-align: center;" colspan="2">3</th>
                        <th style="text-align: center;" colspan="2">4</th>
                        <th style="text-align: center;" colspan="2">5=3+4</th>
                        <th style="text-align: center;" colspan="2">6</th>
                        <th style="text-align: center;" colspan="2">7=5-6</th>                        
                        <th style="text-align: center;">8</th>
                        <th style="text-align: center;">9</th>
                        <th style="text-align: center;">10</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $no=1; ?>
                    <?php $grandTotal=0; foreach ((array)$kategori as $val): ?>
                        <tr>
                            <td style="text-align: center; background-color: #D3D1D0"><b><?=$no++?></b></td>
                            <td style="background-color: #D3D1D0" width="20px"></td>
                            <td style="background-color: #D3D1D0"> &nbsp; <b><?=strtoupper($val->perihal)?></b></td>
                            <td style="background-color: #D3D1D0" colspan="13"></td>
                        </tr>
                        <?php $totalPerkategori=0; $noBrg=1; foreach ((array)$hasil[$val->id_perihal] as $valBrg){ ?>
                            <tr>
                                <td></td>
                                <td style="text-align: center"><?=$noBrg++?></td>
                                <td><?=$valBrg->nm_brg_gabung?></td>
                                <td style="text-align: center"><?=$saldoAwal[$valBrg->fk_barang_id]->tot_qty_sa?></td>
                                <td style="text-align: center"><?=$saldoAwal[$valBrg->fk_barang_id]->satuan?></td>
                                <td style="text-align: center"><?=$pengadaan1Thn[$valBrg->fk_barang_id]->tot_qty_sa?></td>
                                <td style="text-align: center"><?=$pengadaan1Thn[$valBrg->fk_barang_id]->satuan?></td>
                                <?php
                                    $jml = $saldoAwal[$valBrg->fk_barang_id]->tot_qty_sa+$pengadaan1Thn[$valBrg->fk_barang_id]->tot_qty_sa;
                                    $satuan = $saldoAwal[$valBrg->fk_barang_id]->satuan;
                                    if($satuan){
                                        $satuan = $satuan;
                                    }else{
                                        $satuan = $pengadaan1Thn[$valBrg->fk_barang_id]->satuan;
                                    }
                                ?>
                                <td style="text-align: center"><?=$jml?></td>
                                <td style="text-align: center"><?=$satuan?></td>
                                <?php
                                    $jmlBrgaKluar = $barangKeluar1Thn[$valBrg->fk_barang_id]->tot_qty;
                                    $sisa = $jml-$jmlBrgaKluar;
                                ?>
                                <td style="text-align: center"><?=$jmlBrgaKluar?></td>
                                <td style="text-align: center"><?=$barangKeluar1Thn[$valBrg->fk_barang_id]->satuan?></td>
                                <td style="text-align: center"><?=$sisa?></td>
                                <td style="text-align: center"><?=$satuan?></td>
                                <td style="text-align: right;"><?=$sisa==0?'':number_format($hargaBarang[$valBrg->fk_barang_id]->harga_satuan_beli)?></td>
                                <?php 
                                    $jml2 = $hargaBarang[$valBrg->fk_barang_id]->tot_harga_masuk-$barangKeluar1Thn[$valBrg->fk_barang_id]->tot_harga_keluar;
                                    $totalPerkategori+=$jml2;
                                ?>
                                <td style="text-align: right;"><?=$sisa==0?'':number_format($jml2)?></td>
                                <td style="text-align: center"></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <th>TOTAL</th>
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
                            <td style="text-align: right;"><b><?=number_format($totalPerkategori)?></b></td>
                            <td></td>
                        </tr>
                        <?php $grandTotal+=$totalPerkategori; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>GRAND TOTAL</th>
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
                        <td style="text-align: right;"><b><?=number_format($grandTotal)?></b></td>
                        <td></td>
                    </tr>
                </tbody>              
            </table> 
            <table border="0" width="100%" cellspacing="-1" style="font-size:10pt;text-align: center">
                <tr>
                    <td width="100px">&nbsp;</td>
                    <td width="400px"></td>
                    <td width="150px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Kediri, <?=$tanggal?></td>
                </tr> 
                <tr>
                    <td></td>
                    <td>Mengetahui,</td>
                    <td></td>
                    <td></td>
                </tr>                
                <tr>
                    <td></td>
                    <td><?=$jabatan_kepala?> KAB. KEDIRI</td>
                    <td></td>
                    <td>Penyimpan Barang</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><u><?=$nama_kepala?></u></b></td>
                    <td></td>
                    <td><b><u><?=$nama_pjphp?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$nip_kepala?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$nip_pjphp?></td>
                </tr>
            </table>
        </div>
    </body>
</html>