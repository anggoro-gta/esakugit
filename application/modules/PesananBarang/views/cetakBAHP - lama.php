<!doctype html>
<html>
    <head>
        <title>BAHP</title>
    </head>
    <body>
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 2;">
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>BERITA ACARA HASIL PEMERIKSAAN (BAHP) BARANG</u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:13pt;padding-top: -6px">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun_anggaran']?></td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        <?php $dt = explode('-', $hasil['tgl_brg_dtg']); ?>
                        Pada hari ini <?= $this->help->namaHari($this->help->ReverseTgl($hasil['tgl_brg_dtg']));?> Tanggal <?=$this->help->terbilang($dt[2])?> Bulan <?=$this->help->namaBulan($dt[1])?> Tahun <?=$this->help->terbilang($dt[0])?>, kami yang bertanda tangan dibawah ini :
                    </td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td width="40px"></td>
                    <td>
                        <table border="0" width="90%" cellspacing="-1" style="font-size:12pt;">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><?=$hasil['nama_ppk']?></td>
                            </tr>
                            <tr>
                                <td valign="top">Jabatan</td>
                                <td valign="top">:</td>
                                <td valign="top">Pejabat Pembuat Komitmen</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>Jl. Soekarno-Hatta No. I Kediri</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <br>
                <tr>
                    <td></td>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        Yang ditetapkan berdasarkan Keputusan Pengguna Anggaran Bappeda Kabupaten Kediri Nomor : <?= !empty($kepPPK->nomor)?$kepPPK->nomor:'' ?> 
                        <?php $ba = explode('-', $kepPPK->tgl_awal); 
                            if($kepPPK->tgl_awal){
                              echo ' Tanggal '.$ba[2].' '.$this->help->namaBulan($ba[1]).' '.$ba[0];
                            }
                        ?>
                    </td>
                </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        <?php $psn = explode('-', $hasil['tgl_pesanan']); 
                              $tglPsn =  $psn[2].' '.$this->help->namaBulan($psn[1]).' '.$psn[0];
                                $dasar = "kontrak";
                                if((int)$total_nilai <= 10000000){
                                    $dasar = "pesanan";
                                }
                        ?>
                        Pejabat Pembuat Komitmen telah memeriksa barang-barang dengan teliti hasil pekerjaan Pengadaan Barang berdasarkan <?=$dasar?> Nomor  021/<?=!empty($hasil['nomor'])?$hasil['nomor']:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?>/418.54/<?=$hasil['tahun_anggaran']?> tanggal <?=$tglPsn ?> dengan hasil pemeriksaan dinyatakan baik (sebagaimana terlampir) sesuai dengan Kontrak.
                    </td>
                </tr>
            </table>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
                <tr>
                    <td width="50px"></td>
                    <td width="260px"></td>
                    <td width="100px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?=$rekanan['nama_rekanan']?></td>
                    <td></td>
                    <td>Pejabat Pembuat Komitmen</td>
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
                    <td><b><u><?=$rekanan['nama_pimpinan']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_ppk']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px"><?=$rekanan['jabatan']?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_ppk']?></td>
                </tr>
            </table>

            <!-- <pagebreak> -->

            <table width="100%" style="font-family:arial;line-height: 2; page-break-before: always;">
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:12pt;"><b><u>LAMPIRAN BERITA ACARA HASIL PEMERIKSAAN (BAHP) BARANG</u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:12pt;padding-top: -6px">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun_anggaran']?></td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td width="40px"></td>
                    <td>
                        <table border="1" width="100%" cellspacing="-1" style="font-size:11pt; border: 1px solid black; border-collapse: collapse;">
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang dan Spesifikasi</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Satuan (Rp)</th>
                                <th>Jumlah (Rp)</th>
                                <th>Kondisi</th>
                            </tr>
                            <?php $no=1; foreach ($detail as $val): ?>
                                <?php 
                                    $qtyAkhr = $val['qty_akhir'];

                                    $hrgSatBru = 0;
                                    if((int)$total_nilai >= 1000000){
                                        // $hrgSatBru = ($val['harga_satuan_beli']*(10/100));
                                    }
                                    $qtyAkhr = $val['qty_akhir'];
                                    $hrgSat = $val['harga_satuan_beli']+$hrgSatBru;
                                    $jml = $qtyAkhr*$hrgSat; 
                                ?>
                                <tr>
                                    <td valign="top" align="center"><?=$no++;?></td>
                                    <td valign="top"><?=$val['nm_brg_gabung'];?></td>
                                    <td valign="top" align="center"><?=$qtyAkhr;?></td>
                                    <td valign="top" align="right"><?=number_format($hrgSat);?></td>
                                    <td valign="top" align="right"><?=number_format($jml);?></td>
                                    <td valign="top" align="center">Baik</td>
                                </tr>
                                <?php 
                                    $totQtyAkhr += $qtyAkhr;
                                    $totHrgSat += $hrgSat;
                                    $totJml += $jml; 
                                ?>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2" align="center">Jumlah</td>
                                <td align="center"><?=$totQtyAkhr?></td>
                                <td align="right"></td>
                                <td align="right"><?=number_format($totJml)?></td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <br>                
            </table>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
                <tr><td height="20px"></td></tr>
                <tr>
                    <td width="50px"></td>
                    <td width="260px"></td>
                    <td width="100px"></td>
                    <td>Kediri, <?= $dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?=$rekanan['nama_rekanan']?></td>
                    <td></td>
                    <td>Pejabat Pembuat Komitmen</td>
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
                    <td><b><u><?=$rekanan['nama_pimpinan']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_ppk']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px"><?=$rekanan['jabatan']?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_ppk']?></td>
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