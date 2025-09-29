<!doctype html>
<html>
    <head>
        <title>Laporan Per Bulan</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt">
                <tr>
                    <th colspan="9">LAPORAN DAFTAR PERSEDIAAN<br>S/D 31 DESEMBER <?=$tahun;?></th> 
                </tr>
                <tr><th>&nbsp;</th></tr>
            </table>
            <table border="1" class="bordersolid" cellspacing="-1" width="100%" style="font-size:10px">
                <thead>
                    <tr>
                        <th style="text-align: center;vertical-align: middle;" width="20px" rowspan="2">NO</th>
                        <th style="text-align: center;vertical-align: middle;" colspan="2" rowspan="2">NAMA BARANG</th>
                        <th style="text-align: center;vertical-align: middle;" colspan="3">SISA AKHIR TAHUN <?=$tahun-1?> </th>
                        <th style="text-align: center;vertical-align: middle;" colspan="3">PENGADAAN TA <?=$tahun?></th>
                        <th width="100px" style="text-align: center;vertical-align: middle;" rowspan="2">JUMLAH PENGELUARAN<br><?=$tahun?></th>
                        <th style="text-align: center;vertical-align: middle;" colspan="3">SISA</th>
                        <th style="text-align: center;vertical-align: middle;" rowspan="2">KETERANGAN</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">Jml</th>
                        <th style="text-align: center;">Satuan</th>
                        <th style="text-align: center;">Nilai</th>
                        <th style="text-align: center;">Jml</th>
                        <th style="text-align: center;">Satuan</th>
                        <th style="text-align: center;">Nilai</th>
                        <th style="text-align: center;">Jml</th>
                        <th style="text-align: center;">Harga<br>Satuan</th>
                        <th style="text-align: center;">Nilai</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">1</th>
                        <th style="text-align: center;" colspan="2">2</th>
                        <th style="text-align: center;" colspan="2">3</th>
                        <th style="text-align: center;">4</th>
                        <th style="text-align: center;" colspan="2">5</th>
                        <th style="text-align: center;">6</th>
                        <th style="text-align: center;">7</th>
                        <th style="text-align: center;">8=3+5-7</th>
                        <th style="text-align: center;">9</th>
                        <th style="text-align: center;">10</th>                        
                        <th style="text-align: center;">11</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $no=1; ?>
                    <?php $grandTotal=0; foreach ((array)$kategori as $val): ?>
                        <tr>
                            <td style="text-align: center; background-color: #D3D1D0"><b><?=$no++?></b></td>
                            <td style="background-color: #D3D1D0" width="20px"></td>
                            <td style="background-color: #D3D1D0"> &nbsp; <b><?=strtoupper($val->perihal)?></b></td>
                            <td style="background-color: #D3D1D0" colspan="11"></td>
                        </tr>
                        <?php $totalPerkategori=0; $noBrg=1; foreach ((array)$hasil[$val->id_perihal] as $valBrg){ ?>
                            <tr>
                                <td></td>
                                <td style="text-align: center"><?=$noBrg++?></td>
                                <td><?=$valBrg->nm_brg_gabung?></td>
                                <td style="text-align: center"><?=$saldoAwal[$valBrg->fk_barang_id]->tot_qty_sa?></td>
                                <td style="text-align: center"><?=$saldoAwal[$valBrg->fk_barang_id]->satuan?></td>
                                <td style="text-align: right"><?=!empty($saldoAwal[$valBrg->fk_barang_id]->tot_awal_beli)?number_format($saldoAwal[$valBrg->fk_barang_id]->tot_awal_beli):''?></td>
                                <td style="text-align: center"><?=$pengadaan1Thn[$valBrg->fk_barang_id]->tot_qty_sa?></td>
                                <td style="text-align: center"><?=$pengadaan1Thn[$valBrg->fk_barang_id]->satuan?></td>
                                <td style="text-align: right"><?=!empty($pengadaan1Thn[$valBrg->fk_barang_id]->tot_satuan_beli)?number_format($pengadaan1Thn[$valBrg->fk_barang_id]->tot_satuan_beli):''?></td>
                                <?php
                                    $jmlBrgMsk = $saldoAwal[$valBrg->fk_barang_id]->tot_qty_sa+$pengadaan1Thn[$valBrg->fk_barang_id]->tot_qty_sa;
                                    // $satuan = $saldoAwal[$valBrg->fk_barang_id]->satuan;
                                    // if($satuan){
                                    //     $satuan = $satuan;
                                    // }else{
                                    //     $satuan = $pengadaan1Thn[$valBrg->fk_barang_id]->satuan;
                                    // }
                                
                                    $jmlBrgaKluar = $barangKeluar1Thn[$valBrg->fk_barang_id]->tot_qty;
                                    $sisa = $jmlBrgMsk-$jmlBrgaKluar;
                                ?>
                                <td style="text-align: center"><?=$jmlBrgaKluar?></td>
                                <td style="text-align: center"><?=$sisa?></td>
                                <?php
                                    $hrgSatBli = $hargaBarang[$valBrg->fk_barang_id]->hrg_sat_beli_trkhir;
                                    if(empty($hargaBarang[$valBrg->fk_barang_id]->hrg_sat_beli_trkhir)){
                                        $hrgSatBli = $hargaBarang[$valBrg->fk_barang_id]->harga_satuan_beli;
                                    }
                                ?>
                                <td style="text-align: right;"><?=$sisa==0?'':number_format($hrgSatBli)?></td>
                                <?php 
                                    if($sisa>0){
                                        $jml2 = $hargaBarang[$valBrg->fk_barang_id]->tot_harga_masuk-$barangKeluar1Thn[$valBrg->fk_barang_id]->tot_harga_keluar; 
                                        
                                            //perubahan 2021 langsung dikalikan
                                        // $jml2 = $hargaBarang[$valBrg->fk_barang_id]->harga_satuan_beli*$sisa;

                                        $totalPerkategori+=$jml2;
                                    }
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
                        <td style="text-align: right;"><b><?=number_format($grandTotal)?></b></td>
                        <td></td>
                    </tr>
                </tbody>              
            </table> 
            <table border="0" width="100%" cellspacing="-1" style="font-size:10pt;text-align: center">
                <tr>
                    <td width="50px">&nbsp;</td>
                    <td width="400px"></td>
                    <td width="150px"></td>
                    <td width="200px"></td>
                    <td></td>
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
                    <td>Pengurus Barang</td>
                    <td>Bendahara Pengeluaran</td>
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
                    <td><b><u><?=$nama_pngrs?></u></b></td>
                    <td><b><u><?=$nama_bndhra?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$nip_kepala?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$nip_pngrs?></td>
                    <td style="padding-top: -3px">NIP. <?=$nip_bndhra?></td>
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