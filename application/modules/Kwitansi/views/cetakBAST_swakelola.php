<!doctype html>
<html>
    <head>
        <title>BAST-PPK</title>
    </head>
    <body onload="window.print()" style="margin:0">
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1.5;">
                <tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>BERITA ACARA SERAH TERIMA<br>PEJABAT PEMBUAT KOMITMEN (BAST-PPK) <?=strtoupper($hasil['jenis_belanja'])?></u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:13pt;">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$bag->kode_bagian?>/<?=$hasil['tahun']?></td>
                </tr>
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        <?php $dt = explode('-', $hasil['tgl_kwitansi']); ?>
                        <!-- Pada hari ini <?= $this->help->namaHari($this->help->ReverseTgl($hasil['tgl_kwitansi']));?> Tanggal <?=$this->help->terbilang($dt[2])?> Bulan <?=$this->help->namaBulan($dt[1])?> Tahun <?=$this->help->terbilang($dt[0])?>, kami yang bertanda tangan dibawah ini : -->
                        Pada hari ini &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bulan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tahun &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, bertempat di Kediri, kami yang bertanda tangan dibawah ini :
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;">
                            <tr>
                                <td width="30px">1.</td>
                                <td width="110px">Nama</td>
                                <td width="20px">:</td>
                                <td><?=$hasil['nama_pejabat_kpa']?></td>
                            </tr>
                            <tr>
                                <td valign="top"></td>
                                <td valign="top">Jabatan</td>
                                <td valign="top">:</td>
                                <td valign="top">Pejabat Pembuat Komitmen</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>Jl. Soekarno-Hatta No. I Kediri</td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" align="justify">
                                    Yang ditetapkan berdasarkan Keputusan Kuasa Pengguna Anggaran <?=$bag->nama_bagian?> Kabupaten Kediri Nomor : 
                                    <!-- <?= !empty($kepPPK->nomor)?$kepPPK->nomor:'' ?>  -->
                                    <?php $ba = explode('-', $kepPPK->tgl_awal); 
                                        // if($kepPPK->tgl_awal){
                                        //   echo ' Tanggal '.$ba[2].' '.$this->help->namaBulan($ba[1]).' '.$ba[0].', yang selanjutnya disebut Pihak Kesatu;';
                                        // }else{
                                            echo "<br>, yang selanjutnya disebut Pihak Kesatu;";
                                        // }
                                    ?>                                
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td width="30px">2.</td>
                                <td width="110px">Nama</td>
                                <td width="20px">:</td>
                                <td><?=$hasil['nama_penerima']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td><?=$hasil['jabatan_penerima']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td valign="top">Alamat</td>
                                <td valign="top">:</td>
                                <td valign="top"><?=$hasil['alamat_penerima']?></td>
                            </tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" align="justify">
                                    yang selanjutnya disebut Pihak Kedua;
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" align="justify">
                                    Pihak Kesatu telah menerima dengan baik hasil pekerjaan yang telah diserahkan oleh Pihak Kedua sesuai dengan berita acara hasil pemeriksaan <?=$hasil['jenis_belanja']?> Nomor: 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$bag->kode_bagian?>/<?=$hasil['tahun']?> tanggal <?= $dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0];?> sebagai berikut.
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <table border="1" width="100%" cellspacing="-1" style="font-size:11pt;line-height: 1.2; border: 1px solid black; border-collapse: collapse;" align="center">
                                        <tr>
                                            <th rowspan="2">No.</th>
                                            <th rowspan="2" width="200px">Uraian</th>
                                            <th colspan="2">Kontrak</th>
                                            <th colspan="3">Jumlah</th>
                                            <th rowspan="2">Keterangan</th>
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nomor</th>
                                            <th>Volume</th>
                                            <th>Satuan</th>
                                            <th>Jumlah<br>(Rp)</th>
                                        </tr>
                                        <tr>
                                            <td valign="top" align="center">1.</td>
                                            <td><?=$hasil['untuk_pembayaran'];?></td>
                                            <td valign="top"></td>
                                            <td valign="top"></td>
                                            <td valign="top" align="center"><?=number_format($hasil['qty'],0,',','.');?></td>
                                            <td valign="top" align="center"><?=$hasil['satuan'];?></td>
                                            <td valign="top" align="center"><?=number_format($hasil['banyaknya_uang'],0,',','.');?></td>
                                            <td valign="top" align="center">Baik</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr> 
                        </table>
                    </td>
                </tr>  
                <tr><td height="20px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        Demikian berita acara ini dibuat untuk dipergunakan sebagaimana mestinya.
                    </td>
                </tr>             
            </table>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
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
                    <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_penerima']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_pejabat_kpa']?></td>
                    <td></td>
                    <td style="padding-top: -3px"></td>
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