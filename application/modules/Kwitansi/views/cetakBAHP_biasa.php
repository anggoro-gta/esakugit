<!doctype html>
<html>
    <head>
        <title>BAP</title>
    </head>
    <body onload="window.print()" style="margin:1">
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1.6;" border="0">
                <tr><td height="10px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>BERITA ACARA PEMERIKSAAN <?=!empty($hasil['sub_jenis_belanja'])?strtoupper($hasil['sub_jenis_belanja']):strtoupper($hasil['jenis_belanja'])?></u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:13pt;padding-top: -6px">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$bag->kode_bagian?>/<?=$hasil['tahun']?></td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        <?php //if($hasil['tgl_kwitansi']){ ?>
                            <?php $dt = explode('-', $hasil['tgl_kwitansi']); ?>
                            <!-- Pada hari ini <?= $this->help->namaHari($this->help->ReverseTgl($hasil['tgl_kwitansi']));?> Tanggal <?=$this->help->terbilang($dt[2])?> Bulan <?=$this->help->namaBulan($dt[1])?> Tahun <?=$this->help->terbilang($dt[0])?>,  -->
                            Pada hari ini &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bulan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tahun &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;,
                            bertempat di Kediri, kami yang bertanda tangan dibawah ini :
                        <?php //} ?>
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
                                <td><?=$hasil['nama_pejabat_ppk']?></td>
                            </tr>
                            <tr>
                                <td valign="top">Jabatan</td>
                                <td valign="top">:</td>
                                <td valign="top">Pejabat Pembuat Komitmen</td>
                            </tr>
                            <tr>
                                <td valign="top">SKPD</td>
                                <td valign="top">:</td>
                                <td valign="top"><?=ucwords(strtolower($bag->nama_bagian))?> Kabupaten Kediri</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <br>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                         Berdasarkan SK Penetapan PPK Nomor : 
                        <!-- <?= !empty($kepPPK->nomor)?$kepPPK->nomor:'' ?> 
                        <?php $ba = explode('-', $kepPPK->tgl_awal); 
                            if($kepPPK->tgl_awal){
                              echo ' Tanggal '.$ba[2].' '.$this->help->namaBulan($ba[1]).' '.$ba[0];
                            }
                        ?> -->
                    </td>
                </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        <?php 
                            $tglPsn = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            $psn = explode('-', $hasil['tgl_pesanan']); 
                            if($hasil['tgl_pesanan']){
                                $tglPsn =  $psn[2].' '.$this->help->namaBulan($psn[1]).' '.$psn[0];                                
                            }
                            $dasar = "Kontrak";
                            if((int)$hasil['banyaknya_uang'] <= 50000000){
                                $dasar = "Surat Pesanan";
                            }
                        ?>
                        Telah melaksanakan pemeriksaan terhadap <?=!empty($hasil['sub_jenis_belanja'])?$hasil['sub_jenis_belanja']:$hasil['jenis_belanja']?> berdasarkan <?=$dasar?> Pengadaan <?=!empty($hasil['sub_jenis_belanja'])?$hasil['sub_jenis_belanja']:$hasil['jenis_belanja']?> Nomor  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$bag->kode_bagian?>/<?=$hasil['tahun']?> tanggal <?=$tglPsn ?> dengan spesifikasi sebagai berikut:
                    </td>
                </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                    <td></td>
                    <td>
                        <table border="1" width="100%" cellspacing="-1" style="font-size:11pt; border: 1px solid black; border-collapse: collapse;">
                            <tr>
                                <th>No.</th>
                                <th>Uraian <?=$hasil['jenis_belanja']=='Barang'?'Barang':'Pekerjaan'?> dan Spesifikasi Teknis</th>
                                <th><?=$hasil['jenis_belanja']=='Barang'?'Jumlah Barang':'Kuantitas'?></th>
                                <!-- <th>Satuan</th>
                                <th>Jumlah (Rp)</th> -->
                                <th>Hasil Pemeriksaan</th>
                            </tr>
                            <?php $no=1;foreach ((array)$detail as $val) { ?>
                                <tr>
                                    <td align="center"><?=$no++?></td>
                                    <td> <?=$val['uraian']?></td>
                                    <td align="center"><?=$val['jml']?></td>
                                    <!-- <td align="center"><?=$val['satuan']?></td> -->
                                    <td valign="top" align="center">Sesuai dengan <?=$dasar?></td>
                                </tr>
                            <?php } ?>
                        </table>
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
                    <td></td>
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
                    <td><b><u></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pejabat_ppk']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px"></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_pejabat_ppk']?></td>
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