<!doctype html>
<html>
    <head>
        <title>Surat Pesanan</title>
    </head>
    <body onload="window.print()" style="margin:1">
        <div class="responsive">
            <div style="padding-top:-23px"><?=$header?></div>
            <table  width="100%" style="font-size:11pt;line-height: 1.3;font-family:arial" border="0" cellspacing="-1">
                <tr>
                    <td style="width: 100px"></td>
                    <td style="width: 20px"></td>
                    <td style="width: 350px"></td>
                    <td colspan="2">Kediri, 
                        <?php
                            if($hasil['tgl_pesanan']){
                                $tglPsn = explode('-', $hasil['tgl_pesanan']);
                                echo $tglPsn[2].' '.$this->help->namaBulan($tglPsn[1]).' '.$tglPsn[0];
                            }
                        ?>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>021/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$bag->kode_bagian?>/<?=$hasil['tahun']?></td>
                    <td style="width: 63px">Kepada :</td>
                    <td></td>
                </tr>
                <tr>
                    <td valign="top">Sifat</td>
                    <td valign="top">:</td>
                    <td valign="top">Penting</td>
                    <td valign="top">Yth. Sdr. </td>
                    <td><?=$hasil['nama_penerima']?></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="vertical-align: top">Perihal</td>
                    <td style="vertical-align: top">:</td>
                    <!-- <td style="vertical-align: top"><b><u><?=!empty($hasil['perihal'])?$hasil['perihal']:$hasil['untuk_pembayaran']?></u></b></td> -->
                    <td style="vertical-align: top"><b><u><?=$hasil['untuk_pembayaran']?></u></b></td>
                    <td></td>
                    <td>di Tempat</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            </table>
            <br>
            <br>
            <table width="100%" style="font-family:arial">
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>S U R A T  -  P E S A N A N</u></b></td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:11pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Agar dilayani pengadaan <?=$hasil['untuk_pembayaran']?> untuk sub kegiatan <?=$hasil['kegiatan']?> pada <?=$bag->nama_bagian?> Kabupaten Kediri Tahun Anggaran <?=$hasil['tahun']?> dengan rincian sebagai berikut :</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td width="70px"></td>
                    <td>
                        <table border="1" width="90%" cellspacing="-1" style="font-size:10pt;border: 1px solid black; border-collapse: collapse;line-height: 2;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($hasil['jenis_belanja']=='Swakelola'){ ?>
                                    <tr>
                                        <td align="center">1.</td>
                                        <td> <?=$hasil['untuk_pembayaran']?></td>
                                        <td align="center"><?=$hasil['qty']?></td>
                                        <td align="center"><?=$hasil['satuan']?></td>
                                    </tr>
                                <?php }else{ ?>
                                    <?php $no=1;foreach ((array)$detail as $val) { ?>
                                        <tr>
                                            <td align="center"><?=$no++?></td>
                                            <td> <?=$val['uraian']?></td>
                                            <td align="center"><?=$val['jml']?></td>
                                            <td align="center"><?=$val['satuan']?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <br>
                <tr>
                    <td colspan="2" align="justify" style="font-size:11pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Demikian untuk menjadikan maklum dan perhatiannya.</td>
                </tr>
            </table>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:11pt;text-align: center">
                <tr>
                    <td width="50px"></td>
                    <td width="220px"></td>
                    <td width="100px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Sanggup Mengerjakan,</td>
                    <td></td>
                    <td>Pemesan,</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Penyedia</td>
                    <td></td>
                    <td>Pejabat Pembuat Komitmen</td>
                </tr>
                <tr>
                    <td height="70px">&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><u><?=$hasil['nama_penerima']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pejabat_ppk']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px"><?=$rekanan['nama_rekanan']?></td>
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