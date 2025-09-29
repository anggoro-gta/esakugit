<!doctype html>
<html>
    <head>
        <title>BAST-PPK</title>
    </head>
    <body>
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1.5;">
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>BERITA ACARA SERAH TERIMA<br>PEJABAT PEMBUAT KOMITMEN (BAST-PPK) BARANG</u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:13pt;">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun_anggaran']?></td>
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
                    <td colspan="2">
                        <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;">
                            <tr>
                                <td width="30px">1.</td>
                                <td width="110px">Nama</td>
                                <td width="20px">:</td>
                                <td><?=$hasil['nama_ppk']?></td>
                            </tr>
                            <tr>
                                <td valign="top"></td>
                                <td valign="top">Jabatan</td>
                                <td valign="top">:</td>
                                <td valign="top">Pejabat Pembuat Komitmen pada <?=$hasil['fk_bagian_id']==1?'Bagian':'';?> <?=$bdg['nama_bagian']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>Jl. Soekarno-Hatta No. I Kediri</td>
                            </tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" align="justify">
                                    Yang ditetapkan berdasarkan Keputusan Pengguna Anggaran Bappeda Kabupaten Kediri Nomor : <?= !empty($kepPPK->nomor)?$kepPPK->nomor:'' ?> 
                                     <?php $ba = explode('-', $kepPPK->tgl_awal); 
                                        if($kepPPK->tgl_awal){
                                          echo ' Tanggal '.$ba[2].' '.$this->help->namaBulan($ba[1]).' '.$ba[0].', yang selanjutnya disebut Pihak Kesatu;';
                                        }else{
                                            echo "<br>, yang selanjutnya disebut Pihak Kesatu;";
                                        }
                                    ?>                                   
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td width="30px">2.</td>
                                <td width="110px">Nama</td>
                                <td width="20px">:</td>
                                <td><?=$rekanan['nama_pimpinan']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td><?=$rekanan['jabatan']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td valign="top">Alamat</td>
                                <td valign="top">:</td>
                                <td valign="top"><?=$rekanan['alamat'].', '.$rekanan['kab_kota']?></td>
                            </tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" align="justify">
                                    Selaku penyedia, yang selanjutnya disebut Pihak Kedua;
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" align="justify">
                                    Pihak Kedua telah menyelesaikan dan menyerahkan kepada pihak kesatu hasil pekerjaan pengadaan barang sesuai dengan berita acara hasil pemeriksaan barang tanggal <?= $dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0];?> Nomor 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun_anggaran']?> sebagaimana daftar terlampir.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>  
                <tr><td height="50px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        Demikian berita acara ini dibuat untuk dipergunakan sebagaimana mestinya.
                    </td>
                </tr>   
                <tr><td>&nbsp;</td></tr>           
            </table>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
                <tr>
                    <td width="50px"></td>
                    <td width="300px"></td>
                    <td width="100px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pihak Kesatu</td>
                    <td></td>
                    <td>Pihak Kedua</td>
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
                    <td><b><u><?=$hasil['nama_ppk']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$rekanan['nama_pimpinan']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_ppk']?></td>
                    <td></td>
                    <td style="padding-top: -3px"><?=$rekanan['jabatan']?></td>
                </tr>
            </table>

            <!-- <pagebreak> -->

            <table width="100%" style="font-family:arial;line-height: 2; page-break-before: always;">
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:12pt;"><b><u>LAMPIRAN BERITA ACARA SERAH TERIMA <br> PEJABAT PEMBUAT KOMITMEN (BAST-PPK) BARANG</u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:12pt;padding-top: -6px">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun_anggaran']?></td>
                </tr>
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2">
                        <table border="1" width="100%" cellspacing="-1" style="font-size:11pt;line-height: 1.2; border: 1px solid black; border-collapse: collapse;" align="center">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2" width="200px">Nama Barang dan Spesifikasi</th>
                                <th colspan="2">Kontrak</th>
                                <th colspan="3">Jumlah</th>
                                <th rowspan="2">Keterangan</th>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor</th>
                                <th>Jml Barang</th>
                                <th>Harga<br>Satuan (Rp)</th>
                                <th>Jumlah<br>(Rp)</th>
                            </tr>
                            <?php $no=1; foreach ($detail as $val): ?>
                                <?php 
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
                                    <td><?=$val['nm_brg_gabung'];?></td>
                                    <td valign="top"><?=$this->help->ReverseTgl($hasil['tgl_kontrak']);?></td>
                                    <td valign="top"><?=$hasil['no_kontrak'];?></td>
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
                                <td colspan="4" align="center">Jumlah</td>
                                <td align="center"><?=$totQtyAkhr?></td>
                                <td align="right"></td>
                                <td align="right"><?=number_format($totJml)?></td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>              
            </table>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
                <!-- <tr><td height="20px"></td></tr> -->
                <tr>
                    <td width="50px"></td>
                    <td width="300px"></td>
                    <td width="100px"></td>
                    <td>Kediri, <?= $dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pihak Kesatu</td>
                    <td></td>
                    <td>Pihak Kedua</td>
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
                    <td><b><u><?=$hasil['nama_ppk']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$rekanan['nama_pimpinan']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_ppk']?></td>
                    <td></td>
                    <td style="padding-top: -3px"><?=$rekanan['jabatan']?></td>
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