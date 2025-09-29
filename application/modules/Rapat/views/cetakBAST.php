<!doctype html>
<html>
    <head>
        <title>BAST</title>
    </head>
    <body onload="window.print()" style="margin:0">
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1.5;">
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>BERITA ACARA SERAH TERIMA <?=!empty($hasil['sub_jenis_belanja'])?strtoupper($hasil['sub_jenis_belanja']):strtoupper($hasil['jenis_belanja'])?></u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:13pt;">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun']?></td>
                </tr>
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        <?php $dt = explode('-', $hasil['tgl_kwitansi']); ?>
                        Pada hari ini <?= $this->help->namaHari($this->help->ReverseTgl($hasil['tgl_kwitansi']));?> Tanggal <?=$this->help->terbilang($dt[2])?> Bulan <?=$this->help->namaBulan($dt[1])?> Tahun <?=$this->help->terbilang($dt[0])?>, bertempat di Kediri, kami yang bertanda tangan dibawah ini :
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
                                <td><?=$hasil['nama_pejabat_ppk']?></td>
                            </tr>
                            <tr>
                                <td valign="top"></td>
                                <td valign="top">Jabatan</td>
                                <td valign="top">:</td>
                                <td valign="top">Pejabat Pembuat Komitmen</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>SKPD</td>
                                <td>:</td>
                                <td>BAPPEDA Kabupaten Kediri</td>
                            </tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" align="justify">
                                    Berdasarkan SK Penetapan PPK Nomor : 
                                    <?= !empty($kepPPK->nomor)?$kepPPK->nomor:'' ?> 
                                    <?php $ba = explode('-', $kepPPK->tgl_awal); 
                                        if($kepPPK->tgl_awal){
                                          echo ' Tanggal '.$ba[2].' '.$this->help->namaBulan($ba[1]).' '.$ba[0].', yang selanjutnya disebut PIHAK PERTAMA;';
                                        }else{
                                            echo "<br>, yang selanjutnya disebut PIHAK PERTAMA;";
                                        }
                                    ?>                                
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td width="30px">2.</td>
                                <td width="110px">Nama</td>
                                <td width="20px">:</td>
                                <td><?=$rekanan['nama_pemilik']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td><?=$rekanan['jabatan']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td valign="top">Badan Usaha</td>
                                <td valign="top">:</td>
                                <td valign="top"><?=$rekanan['nama_rekanan']?></td>
                            </tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" align="justify">
                                    Selaku Penyedia Jasa, yang selanjutnya disebut sebagai PIHAK KEDUA;
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <?php 
                                $tglPsn = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                $psn = explode('-', $hasil['tgl']); 
                                if($hasil['tgl']){
                                    $tglPsn =  $psn[2].' '.$this->help->namaBulan($psn[1]).' '.$psn[0];                                
                                }
                                $dasar = "Kontrak";
                                if((int)$hasil['banyaknya_uang'] <= 50000000){
                                    $dasar = "Surat Pesanan";
                                }
                            ?>
                            <tr>
                                <td colspan="4" align="justify">
                                    Berdasarkan <?= $dasar?> Pengadaan Jasa Lainnya nomor : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun']?> tanggal : <?= $psn[2].' '.$this->help->namaBulan($psn[1]).' '.$psn[0];?> dengan spesifikasi sebagai berikut :
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <table border="1" width="100%" cellspacing="-1" style="font-size:11pt;line-height: 1.5; border: 1px solid black; border-collapse: collapse;" align="center">
                                        <tr>
                                        <th>No.</th>
                                        <th>Uraian Pekerjaan dan Spesifikasi Teknis</th>
                                        <th>Kuantitas</th>
                                        <th>Hasil Pemeriksaan</th>
                                    </tr>
                                    <?php $no=1; if($hasil['harga_mamin'] > 0){ ?>
                                        <tr>
                                            <td align="center"><?=$no?></td>
                                            <td>Makan dan Minum</td>
                                            <td align="center"><?=$hasil['jml_peserta']?></td>
                                            <td valign="top" align="center">Sesuai dengan <?=$dasar?></td>
                                        </tr>
                                    <?php $no++; } ?>
                                    <?php if($hasil['harga_snack'] > 0){ ?>
                                        <tr>
                                            <td align="center"><?=$no?></td>
                                            <td>Snack</td>
                                            <td align="center"><?=$hasil['jml_peserta']?></td>
                                            <td valign="top" align="center">Sesuai dengan <?=$dasar?></td>
                                        </tr>
                                    <?php } ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>  
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        Pihak Kedua telah menyerahkan Barang tersebut di atas kepada Pihak Pertama, dan Pihak Pertama telah melakukan pemeriksaan dan menerima Barang tersebut.
                    </td>
                </tr>  
                <tr><td>&nbsp;</td></tr>           
            </table>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
                <tr>
                    <td width="50px"></td>
                    <td width="250px"></td>
                    <td width="50px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>PIHAK KEDUA</td>
                    <td></td>
                    <td>PIHAK PERTAMA</td>
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
                    <td><b><u><?=$rekanan['nama_pemilik']?></u></b></td>
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