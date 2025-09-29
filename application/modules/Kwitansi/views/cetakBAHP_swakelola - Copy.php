<!doctype html>
<html>
    <head>
        <title>BAHP</title>
    </head>
    <body onload="window.print()" style="margin:0">
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 2;">
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>BERITA ACARA HASIL PEMERIKSAAN (BAHP) SWAKELOLA</u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:13pt;padding-top: -6px">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun']?></td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        <?php $dt = explode('-', $hasil['tgl_kwitansi']); ?>
                        Pada hari ini <?= $this->help->namaHari($this->help->ReverseTgl($hasil['tgl_kwitansi']));?> Tanggal <?=$this->help->terbilang($dt[2])?> Bulan <?=$this->help->namaBulan($dt[1])?> Tahun <?=$this->help->terbilang($dt[0])?>, kami yang bertanda tangan dibawah ini :
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
                                <td><?=$hasil['nama_pengawas']?></td>
                            </tr>
                            <tr>
                                <td valign="top">Jabatan</td>
                                <td valign="top">:</td>
                                <td valign="top">Tim Pengawas</td>
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
                        Yang ditetapkan berdasarkan Keputusan Pengguna Anggaran Bappeda Kabupaten Kediri Nomor : 
                        <?=$hasil['no_sk_pengawas_swakelola']?> 
                        <?php 
                            if($hasil['tgl_sk_pengawas_swakelola']){
                                $ba = explode('-', $hasil['tgl_sk_pengawas_swakelola']);
                                echo ' Tanggal '.$ba[0].' '.$this->help->namaBulan($ba[1]).' '.$ba[2];
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
                                if((int)$hasil['banyaknya_uang'] <= 10000000){
                                    $dasar = "pesanan";
                                }
                        ?>
                        Tim Pengawas telah memeriksa pekerjaan swakelola dengan teliti hasil pekerjaan swakelola berdasarkan <?=$dasar?> Nomor  021/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun']?> tanggal <?=$tglPsn ?> dengan hasil pemeriksaan dinyatakan baik (sebagaimana terlampir) sesuai dengan Kontrak.
                    </td>
                </tr>
            </table>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
                <tr>
                    <td width="50px"></td>
                    <td width="450px"></td>
                    <td width="100px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tim Pelaksana</td>
                    <td></td>
                    <td>Tim Pengawas</td>
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
                    <td><b><u><?=$hasil['nama_penerima']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pengawas']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px"><?=$hasil['jabatan_penerima']?></td>
                    <td></td>
                    <td style="padding-top: -3px"><?=$hasil['nip_pengawas']=='-'?'':'NIP. '.$hasil['nip_pengawas']?></td>
                </tr>
            </table>

            <!-- <pagebreak> -->

            <table width="100%" style="font-family:arial;line-height: 2; page-break-before: always;">
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:12pt;"><b><u>LAMPIRAN BERITA ACARA HASIL PEMERIKSAAN (BAHP) SWAKELOLA</u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:12pt;padding-top: -6px">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun']?></td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td width="40px"></td>
                    <td>
                        <table border="1" width="100%" cellspacing="-1" style="font-size:11pt; border: 1px solid black; border-collapse: collapse;">
                            <tr>
                                <th>No.</th>
                                <th>Uraian</th>
                                <th>Volume</th>
                                <th>Satuan</th>
                                <th>Jumlah<br>(Rp)</th>
                                <th>Kondisi</th>
                            </tr>
                            <?php $no=1; //foreach ($detail as $val): ?>
                                <tr>
                                    <td valign="top" align="center">1.</td>
                                    <td valign="top"><?=$hasil['untuk_pembayaran'];?></td>
                                    <td valign="top" align="center"><?=number_format($hasil['qty'],0,',','.');?></td>
                                    <td valign="top" align="center"><?=$hasil['satuan'];?></td>
                                    <td valign="top" align="center"><?=number_format($hasil['banyaknya_uang'],0,',','.');?></td>
                                    <td valign="top" align="center">Baik</td>
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
                    <td width="450px"></td>
                    <td width="100px"></td>
                    <td>Kediri, <?= $dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tim Pelaksana</td>
                    <td></td>
                    <td>Tim Pengawas</td>
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
                    <td><b><u><?=$hasil['nama_penerima']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pengawas']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px"><?=$hasil['jabatan_penerima']?></td>
                    <td></td>
                    <td style="padding-top: -3px"><?=$hasil['nip_pengawas']=='-'?'':'NIP. '.$hasil['nip_pengawas']?></td>
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