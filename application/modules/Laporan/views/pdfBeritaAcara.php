<!doctype html>
<html>
    <head>
        <title>Laporan Berita Acara</title>
    </head>
    <body>
        <div class="responsive">
            <?php $noKat=1; foreach ((array)$kategori as $kat) { ?>
                <?=$header?>
                <br>
                <table width="100%" style="font-family:arial;line-height: 1.5;">
                    <tr><td height="30px"></td></tr>
                    <tr>
                        <td colspan="2" align="center" style="font-size:12pt;"><b><u>Lampiran Berita Acara Stock Opname</u></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="font-size:12pt;padding-top: -8px">Nomor : 900/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$tahun?></td>
                    </tr>
                    <tr><td height="50px"></td></tr>
                </table>
                <table border="0" width="100%" cellspacing="-1" style="font-size:11pt;">
                    <tr>
                        <td><b>Nama Barang : <?=$kat->perihal?></b></td>
                    </tr>
                    <tr><td height="10px"></td></tr>
                </table>
                <table class="bordersolid" border="1" width="100%" cellspacing="-1" style="font-size:11pt;font-family:arial;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga<br>Satuan (Rp)</th>
                            <th>Jumlah (Rp)</th>
                            <th>Ket.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $noBrg=1; $totalPerkategori=0; foreach ((array)$hasil[$kat->id_perihal] as $valBrg){ ?>
                            <?php
                                $jmlBrgMsk = $saldoAwal[$valBrg->fk_barang_id]->tot_qty_sa+$pengadaan1Thn[$valBrg->fk_barang_id]->tot_qty_sa;
                                $jmlBrgaKluar = $barangKeluar1Thn[$valBrg->fk_barang_id]->tot_qty;
                                $sisa = $jmlBrgMsk-$jmlBrgaKluar;   
                                if($sisa>0){
                                    $jml2 = $hargaBarang[$valBrg->fk_barang_id]->tot_harga_masuk-$barangKeluar1Thn[$valBrg->fk_barang_id]->tot_harga_keluar;  

                                        //perubahan 2021 langsung dikalikan
                                    // $jml2 = $hargaBarang[$valBrg->fk_barang_id]->harga_satuan_beli*$sisa;
                                    $totalPerkategori+=$jml2; 

                                    $hrgSatBli = $hargaBarang[$valBrg->fk_barang_id]->hrg_sat_beli_trkhir;
                                    if(empty($hargaBarang[$valBrg->fk_barang_id]->hrg_sat_beli_trkhir)){
                                        $hrgSatBli = $hargaBarang[$valBrg->fk_barang_id]->harga_satuan_beli;
                                    }                      
                            ?>  
                                <tr>
                                    <td style="text-align: center"><?=$noBrg++;?></td>
                                    <td><?=$valBrg->nm_brg_gabung?></td>
                                    <td style="text-align: center"><?=$sisa?></td>
                                    <td style="text-align: center"><?=$valBrg->satuan?></td>
                                    <td style="text-align: right"><?=number_format($hrgSatBli)?></td>
                                    <td style="text-align: right"><?=number_format($jml2)?></td>
                                    <td></td>
                                </tr>
                            <?php  } ?>
                        <?php  } ?>
                        <tr>
                            <td></td>
                            <td><b>JUMLAH</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right"><b><?=number_format($totalPerkategori)?></b></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <table border="0" width="100%" cellspacing="-1" style="font-size:11pt;text-align: center; page-break-after: always;">
                    <tr>
                        <td width="50px">&nbsp;</td>
                        <td width="300px"></td>
                        <td width="20px"></td>
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
                        <td>Pengurus Barang</td>
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
                <pagebreak>
            <?php } ?>

            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1.5;">
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:12pt;"><b><u>BERITA ACARA STOCK OPNAME</u></b></td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:12pt;padding-top: -8px">Nomor : 900/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$tahun?></td>
                </tr>
                <tr><td height="50px"></td></tr>
            </table>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;font-family:arial;line-height: 1.5;">
                <tr>
                    <td width="20px"></td>
                    <td colspan="5" align="justify">
                        <?php $dt = explode('-', $tanggal2); ?>
                        Pada hari ini <b><?= $this->help->namaHari($tanggal2);?></b> Tanggal <b><?=$dt[0]?></b> Bulan <b><?=$this->help->namaBulan($dt[1])?></b> Tahun <b><?=$dt[2]?></b>, kami yang bertanda tangan dibawah ini :
                    </td>
                    <td width="20px"></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td></td>
                    <td width="150px">Nama</td>
                    <td width="20px">:</td>
                    <td colspan="3"><?=$nama_pjphp?></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIP</td>
                    <td>:</td>
                    <td colspan="3"><?=$nip_pjphp?></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td width="150px">Pangkat/Gol</td>
                    <td width="20px">:</td>
                    <td colspan="3"><?=!empty($gol_baru)?$gol_baru:$gol?></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td colspan="3">Pengurus Barang Bappeda Kab. Kediri</td>
                    <td></td>
                </tr>
                <tr>
                   <td></td>
                    <td>Alamat Kantor</td>
                    <td>:</td>
                    <td colspan="3">Jl. Soekarno Hatta Nomor 1 Kediri</td>
                    <td></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td width="20px"></td>
                    <td colspan="5" align="justify">
                        Telah melakukan perhitungan persediaan atau stock opname pada Bappeda Kabupaten Kediri sampai dengan tanggal <?=$dt[0]?> <?=$this->help->namaBulan($dt[1])?> <?=$dt[2]?> dengan perincian sebagaimana terlampir.
                    </td>
                    <td></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td width="20px"></td>
                    <td colspan="5" align="justify">
                        Demikian Berita Acara ini dibuat dalam rangkap secukupnya untuk dipergunakan sebagaimana mestinya.
                    </td>
                    <td></td>
                </tr>
            </table>
            <br>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;font-family:arial;text-align: center">
                <tr>
                    <td width="50px">&nbsp;</td>
                    <td width="250px"></td>
                    <td width="50px"></td>
                    <td></td>
                </tr>               
                <tr>
                    <td></td>
                    <td><?=$jabatan_ksb_keu?></td>
                    <td></td>
                    <td>Pengurus Barang</td>
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
                    <td><b><u><?=$nama_ksb_keu?></u></b></td>
                    <td></td>
                    <td><b><u><?=$nama_pjphp?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$nip_ksb_keu?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$nip_pjphp?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" align="center">Mengetahui,</td>
                </tr>                
                <tr>
                    <td colspan="4" align="center"><?=$jabatan_kepala?> KAB. KEDIRI</td>
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
                    <td colspan="4"><b><u><?=$nama_kepala?></u></b></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top: -3px">NIP. <?=$nip_kepala?></td>
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