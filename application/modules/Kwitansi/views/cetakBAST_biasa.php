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
                    <td colspan="2"  align="center" style="font-size:13pt;">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$bag->kode_bagian?>/<?=$hasil['tahun']?></td>
                </tr>
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                    <?php //if($hasil['tgl_kwitansi']){ ?>
                        <?php $dt = explode('-', $hasil['tgl_kwitansi']); ?>
                        <!-- Pada hari ini <?= $this->help->namaHari($this->help->ReverseTgl($hasil['tgl_kwitansi']));?> Tanggal <?=$this->help->terbilang($dt[2])?> Bulan <?=$this->help->namaBulan($dt[1])?> Tahun <?=$this->help->terbilang($dt[0])?>, bertempat di Kediri, kami yang bertanda tangan dibawah ini : -->
                        Pada hari ini &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bulan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tahun &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, bertempat di Kediri, kami yang bertanda tangan dibawah ini :
                    <?php //} ?>
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
                                <td valign="top">SKPD</td>
                                <td valign="top">:</td>
                                <td valign="top"><?=ucwords(strtolower($bag->nama_bagian))?> Kabupaten Kediri</td>
                            </tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" align="justify">
                                    Berdasarkan SK Penetapan PPK Nomor : 
                                    <!-- <?= !empty($kepPPK->nomor)?$kepPPK->nomor:'' ?>  -->
                                    <?php //$ba = explode('-', $kepPPK->tgl_awal); 
                                        // if($kepPPK->tgl_awal){
                                        //   echo ' Tanggal '.$ba[2].' '.$this->help->namaBulan($ba[1]).' '.$ba[0].', yang selanjutnya disebut PIHAK PERTAMA;';
                                        // }else{
                                            echo "<br>, yang selanjutnya disebut PIHAK PERTAMA;";
                                        // }
                                    ?>                                
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
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
                                    Selaku Penyedia <?=$hasil['jenis_belanja']=='Barang'?'Barang':'Jasa'?>, yang selanjutnya disebut sebagai PIHAK KEDUA;
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
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
                            <tr>
                                <td colspan="4" align="justify">
                                    Berdasarkan <?= $dasar?> Pengadaan <?=!empty($hasil['sub_jenis_belanja'])?$hasil['sub_jenis_belanja']:$hasil['jenis_belanja']?> nomor : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$bag->kode_bagian?>/<?=$hasil['tahun']?> tanggal : <?= $psn[2].' '.$this->help->namaBulan($psn[1]).' '.$psn[0];?> dengan spesifikasi sebagai berikut :
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
                                            <th width="60%">Uraian <?=$hasil['jenis_belanja']=='Barang'?'Barang':'Pekerjaan'?> dan Spesifikasi Teknis</th>
                                            <th><?=$hasil['jenis_belanja']=='Barang'?'Jumlah Barang':'Kuantitas'?></th>
                                        </tr> 
                                        <?php $no=1;foreach ((array)$detail as $val) { ?>
                                            <tr>
                                                <td align="center"><?=$no++?></td>
                                                <td> <?=$val['uraian']?></td>
                                                <td align="center"><?=$val['jml']?></td>
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
                        Pihak Kedua telah menyerahkan <?=$hasil['jenis_belanja']=='Barang'?'Barang':'Hasil Pekerjaan'?> tersebut di atas kepada Pihak Pertama, dan Pihak Pertama telah melakukan pemeriksaan dan menerima <?=$hasil['jenis_belanja']=='Barang'?'Barang':'Hasil Pekerjaan'?> tersebut.
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
                    <td><b><u><?=$hasil['nama_penerima']?></u></b></td>
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